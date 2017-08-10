<?php
require_once '/var/www/html/vendor/autoload.php';
require_once 'global.php';

use Aws\S3\S3Client;

$URLRenderFormat = "##URL SRC=\"{{url}}\"##";
$MISSINGRenderFormat = "MISSING-{{value}}";
$AWSFormatURL = "https://bkktest.s3.amazonaws.com/{{fileName}}";
$AWSFormatFileName = "/tmp/{{fileName}}";
$LocalFormatURL = "https://web2xmm.com/admin/images/{{fileName}}";
$LocalFormatFileName = "/var/www/html/admin/images/{{fileName}}";

function couchDB_Get($path)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:5984' . $path);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-type: application/json',
            'Accept: */*'
    ));
    $response = curl_exec($ch);
    //echo($response);
    $doc = json_decode($response);
    //print_r($response);
    return $doc;
}

/*
    Simple json to template render using Mustache syntax
    - json dot notation
*/
function json_render($template,$data)
{
    $m = new Mustache_Engine;
    return $m->render($template,$data);
}

class StudioRenderPrefixHandler 
{
    var $prefixMapper = array(
            "URL" => "##SRC URL=\"http://s3.com/xxxx/yyyy/{{value}}.html\" ##",
    );
    
    function __construct($prefixMapper = NULL)
    {		
        if(is_null($prefixMapper) == false){
            $this->prefixMapper = $prefixMapper;
        }
    }		
    
    function onRenderPrefix($prefix,$value)
    {
        //wPrint("prefix=$prefix\n");
        $valueResult = $this->valueFilter($value);
        $mapResult = $this->prefixMapper[$prefix];
        $mapResult = str_replace("{{value}}", "$valueResult", $mapResult);
        //wPrint("$mapResult\n");
        return $mapResult;
    }
    
    function valueFilter($value)
    {
        return $value;
    }
}


/*
    Support
    - {{jsonDotNotation}}
    - {{PREFIX-jsonDotNotation}} with StudioRenderPrefixHandler
*/
function studio_render($template,$data,$handler)
{
    // pre render URL case
    preg_match_all('/\{{([^-\}]+)-(.*?)\}}/', $template, $matches, PREG_PATTERN_ORDER);
    for($i = 0;$i<count($matches[0]);$i++){
        $value0 = $matches[0][$i];
        $value1 = $matches[1][$i];
        $value2 = $matches[2][$i];
        $result = $handler->onRenderPrefix($value1,$value2);
        $template = str_replace("$value0", "$result", $template);
    }
    //wPrint("$template\n");
    return json_render($template,$data);
}

/*
    Support
    - direct as "TEXT-LINE-ACCTID-PROGRAMID-BUSINESSNAME"
    - url src as "URL TEXT-LINE-ACCTID-PROGRAMID-BUSINESSNAME"
*/
function studio_url_render($template,$acctID,$progID,$data,$urlFormat=NULL)
{
    global $URLRenderFormat;
    global $MISSINGRenderFormat;

    if(is_null($urlFormat) == true){    
        $urlFormat = $URLRenderFormat;
    }
    preg_match_all('/\{{(.*?)\}}/', $template, $matches, PREG_PATTERN_ORDER);
    $aValue0 = $matches[0];
    $aValue1 = $matches[1];
    // somehow unique_array not work using hash instead.
    $hash = array();
    for($i = 0;$i<count($aValue0);$i++){
        $value0 = $aValue0[$i];
        $value1 = $aValue1[$i];
        $renderDirect = true;
        //wPrint("-- $value0 $value1\n");
        if(startsWith($value1,"URL ")){
            $renderDirect = false;
            $value1 = substr($value1,4);
            //wPrint("-- change to $value1\n");
        }
        if(array_key_exists($value0,$hash)){
        }else{
            $hash[$value0] = $value1;
            //wPrint("$value0 $value1\n");
            
            $filename = str_replace("ACCTID",$acctID,$value1);
            $filename = str_replace("PROGRAMID",$progID,$filename);
            $renderValue = "";
            if(property_exists($data,"$value1")){
                if($renderDirect){
                    $renderValue = $data->$value1;                
                }else{
                    $filename = $filename . ".html";
                    $s3Url = s3_put_contents($filename,$data->$value1,array("$acctID"=>$acctID,"$progID"=>$progID));
                    $renderValue = str_replace("{{url}}", "$s3Url", $URLRenderFormat);
                }
                
                $xmlSave = htmlspecialchars($renderValue);
                $template = str_replace("$value0", "$xmlSave", $template);
            }else{
                $missingValue = str_replace("{{value}}","$value1",$MISSINGRenderFormat);
                $xmlSave = htmlspecialchars($missingValue);
                $template = str_replace("$value0", "$xmlSave", $template);
            }
        }
    }
    return $template;
}

function RenderFileName($acctID,$progID,$filename)
{
    $filename = str_replace("ACCTID",$acctID,$filename);
    $filename = str_replace("PROGRAMID",$progID,$filename);
    return $filename;
}

function isAssoc(array $arr)
{
    if (array() === $arr) return false;
    return array_keys($arr) !== range(0, count($arr) - 1);
}

//$func = function($name,$value)
//{
//    print "$name => $value<br>";
//};
//
//IterateObject($obj,"obj",$func);
function IterateObject($obj,$parent,$func)
{
    if (is_array($obj))
    {
        if(isAssoc($obj)){
            foreach($obj as $key => $value) {
                if(is_array($value)){
                    if(isAssoc($value)){
                        $prefix = ".$key";
                        IterateObject($value,"$parent$prefix",$func);
                    }else{
                        for($i=0;$i<count($value);$i++){
                            $prefix = ".$key"."[".$i."]";
                            IterateObject($value[$i],"$parent$prefix",$func);
                        }
                    }
                }else{
                     $func("$parent.$key",$value);
                }
            }
        }else{
            for($i=0;$i<count($value);$i++){
                $prefix = "[".$i."]";
                IterateObject($value[$i],"$parent$prefix",$func);
            }
        }
    }else if(is_object($obj)){
        foreach($obj as $key => $value) {
            if(is_array($value)){
                if(isAssoc($value)){
                    $prefix = ".$key";
                    IterateObject($value,"$parent$prefix",$func);
                }else{
                    for($i=0;$i<count($value);$i++){
                        $prefix = ".$key"."[".$i."]";
                        IterateObject($value[$i],"$parent$prefix",$func);
                    }
                }
            }else if(is_object($obj)){
                
            }else{
                 $func("$parent.$key",$value);
            }
        }
    }else {
        $func("$parent",$obj);    
    }
};

function local_put_contents($fileName,$data,$metaData=array())
{
    global $LocalFormatFileName;
    global $LocalFormatURL;
    
    $localFileName = str_replace("{{fileName}}", "$fileName", $LocalFormatFileName);
    file_put_contents($localFileName,$data);
    $url = str_replace("{{fileName}}", "$fileName", $LocalFormatURL);
    return $url;
}

function s3_put_contents($fileName,$data,$metaData=array())
{
    global $AWSFormatFileName;
    $path = str_replace("{{fileName}}", "$fileName", $AWSFormatFileName);
    $client = S3Client::factory(array(
        'credentials' => array(
            'key'    => AWSKEY,
            'secret' => AWSSECRET,
        )
    ));
    $result = $client->putObject(array(
        'Bucket'     => AWSBUCKET,
        'Key'        => $path,
        'Body'        => $data,
        'ACL'		 => 'public-read',
        'Metadata'   => $metaData,
    ));
    return $result['ObjectURL'];
}

function s3_get_contents($path)
{
    $client = S3Client::factory(array(
        'credentials' => array(
            'key'    => AWSKEY,
            'secret' => AWSSECRET,
        )
    ));
    // Get an object using the getObject operation
    $result = $client->getObject(array(
        'Bucket' => AWSBUCKET,
        'Key'    => $path,
    ));
    // The 'Body' value can be cast to a string
    return $result['Body'];
}

function studio_variable_extract($data)
{
    preg_match_all('/##([^#]+)##/', $data, $matches, PREG_PATTERN_ORDER);
    wPrint("Num Match =" . count($matches[0]) . "\n");
    for($i = 0;$i<count($matches[0]);$i++){
        $value0 = $matches[0][$i];
        $value1 = $matches[1][$i];
        wPrint("$value0  =>  $value1\n");
    }
}

function create_tmaml($mamlFileName,$mapFileName,$outputFileName)
{
    $maml = file_get_contents($mamlFileName);    
    $map_lines = file($mapFileName); 
    $map = array();
    foreach($map_lines as $line){
        $line = trim($line, "\n"); 
        $line = preg_replace('/\s+/', ' ', $line);
        $items = explode(" ",$line);
        //$map[] = array($items[0] => $items[1]);
        //wPrint("$items[0] $items[1]\n");
        array_push($map,$items[0],$items[1]);
        $maml = str_replace("##" . $items[0] . "##",$items[1], $maml);
        //$map[$items[0]] = $items[1];
    };
    file_put_contents($outputFileName,$maml);
    
    wPrint("create_tmaml " . strlen($maml) . "\n");
}

function startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

function getStudioTicket() { 
    return getTicket($_SESSION['ACCOUNTID'], $_SESSION['EMAIL'],$_SESSION['PWD']);
}


function publishMAML($MAML) {
    
	$byteArray = array();
	for($i = 0; $i < strlen($MAML); $i++) {
		$byteArray[$i] = ord($MAML[$i]); 
	}
    $userTicket = getStudioTicket();
    $publish = array(
    	"Maml"					=> $byteArray,
    	"MamlFormat"			=> 0,
    	"EnforcePublish"        => true,
    	"Credentials"			=>  array
            (
                "Ticket" => $userTicket        
            ),
    );
    		
    $publishResponse = callService("programservice/PublishProgram", $publish);
    return $publishResponse;
}


function wPrint($data)
{
    echo nl2br($data);
}

function wPrintLine($data)
{
    echo nl2br($data . "\n");
}

function dump_r($data)
{
    print_r($data);echo "<br>";
}


?>