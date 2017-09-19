<?php
require_once '../vendor/autoload.php';
require_once 'global.php';

use Aws\S3\S3Client;

$configFile = "conf/davinci.json";
$URLRenderFormat = "##URL SRC=\"{{url}}\"##";
$MISSINGRenderFormat = "MISSING-{{value}}";
$AWSFormatURL = "https://bkktest.s3.amazonaws.com/{{fileName}}";
$AWSFormatFileName = "/tmp/{{fileName}}";
$LocalFormatURL = "https://web2xmm.com/admin/images/{{fileName}}";
$LocalFormatFileName = "/var/www/html/admin/images/{{fileName}}";
$databaseEndpoint = "http://web2xmm.com:5984";	//"http://localhost:5984"
//$databaseEndpoint = "http://localhost:5984/couchdb"

$davinciConf = davinciSetConfig();

function davinciSetConfig()
{
    global $configFile;
    global $databaseEndpoint;
    $data = file_get_contents($configFile);    
    if(!empty($data)){
        $doc = json_decode($data,false);
        $databaseEndpoint = $doc->databaseEndPoint;
    }
    return $data;
}
function couchDB_Get($path,$asArray = false)
{
    global $databaseEndpoint;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $databaseEndpoint . $path);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-type: application/json',
            'Accept: */*'
    ));
    $response = curl_exec($ch);
    //echo($response);
    $doc = json_decode($response,$asArray);
    //print_r($response);
    return $doc;
}


function couchDB_CreateDatabase($dbName)
{
    global $databaseEndpoint;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $databaseEndpoint."/".$dbName);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
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

function couchDB_Save($dbName,$doc)
{
    global $databaseEndpoint;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $databaseEndpoint . $dbName);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-type: application/json',
            'Accept: */*'
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($doc));
    $response = curl_exec($ch);
    //echo($response);
    $doc = json_decode($response);
    //print_r($response);
    return $doc;
}

function couchDB_Update($path,$field,$value,$where){
    $doc = couchDB_Get("/$path",true);
    if(empty($doc["_id"])){
        return json_encode( 
            array(
                'success'=>false,
                'message'=>"Document not found $path",
            )
        );
    }
    
    // check if we have where
    if(!empty($where)){ 
        //print_r($where);
        preg_match_all('/(.*)\.(.*)=(.*)/', $where, $matches, PREG_PATTERN_ORDER);
        //echo "<hr>";
        //print_r($matches);
        $whereArray = $matches[1][0];
        $whereField = $matches[2][0];
        $whereValue = $matches[3][0];
        //print_r($whereArray);
        
        //print_r($doc);
        if (!is_array($doc[$whereArray])){
            return json_encode( 
                array(
                    'success'=>false,
                    'message'=>"$whereArray is not array",
                ));
        }
        for($i = 0;$i<count($doc[$whereArray]);$i++){
            if($doc[$whereArray][$i][$whereField] == $whereValue){
                //print_r($doc[$whereArray][$i]);
                $doc[$whereArray][$i][$field] = $value;
                $ret = couchDB_Save("/$path",$doc);
                //print_r($ret);
                return json_encode( 
                    array(
                        'success'=>true,
                        'message'=>"Done",
                        'detail'=>$ret,
                    ));
            }
        }
        // Not found 
        return json_encode( 
            array(
                'success'=>false,
                'message'=>"record not found where $whereField = $whereValue",
            ));
    }else{
        $doc[$field] = $value;
        //print_r($doc);
        $ret = couchDB_Save("/$path",$doc);
        //print_r($ret);
        return json_encode( 
            array(
                'success'=>true,
                'message'=>"Done",
                'detail'=>$ret,
            ));
    }
}

function couchDB_UpdateEx($path,$param,$where){
    $doc = couchDB_Get("/$path",true);
    if(empty($doc["_id"])){
        return json_encode( 
            array(
                'success'=>false,
                'message'=>"Document not found $path",
            )
        );
    }
    
    // check if we have where
    if(!empty($where)){ 
        //print_r($where);
        preg_match_all('/(.*)\.(.*)=(.*)/', $where, $matches, PREG_PATTERN_ORDER);
        //echo "<hr>";
        //print_r($matches);
        $whereArray = $matches[1][0];
        $whereField = $matches[2][0];
        $whereValue = $matches[3][0];
        //print_r($whereArray);
        
        //print_r($doc);
        if (!is_array($doc[$whereArray])){
            return json_encode( 
                array(
                    'success'=>false,
                    'message'=>"$whereArray is not array",
                ));
        }
        for($i = 0;$i<count($doc[$whereArray]);$i++){
            if($doc[$whereArray][$i][$whereField] == $whereValue){
                //print_r($doc[$whereArray][$i]);
                //$doc[$whereArray][$i][$field] = $value;
                $doc[$whereArray][$i] = array_merge($doc[$whereArray][$i],$param);
                $ret = couchDB_Save("/$path",$doc);
                //print_r($ret);
                return json_encode( 
                    array(
                        'success'=>true,
                        'message'=>"Done",
                        'detail'=>$ret,
                    ));
            }
        }
        // Not found 
        return json_encode( 
            array(
                'success'=>false,
                'message'=>"record not found where $whereField = $whereValue",
            ));
    }else{
        //$doc[$field] = $value;
        $doc = array_merge($doc,$param);
        //print_r($doc);
        $ret = couchDB_Save("/$path",$doc);
        //print_r($ret);
        return json_encode( 
            array(
                'success'=>true,
                'message'=>"Done",
                'detail'=>$ret,
            ));
    }
}








function getDatabaseName($acctID,$acctName)
{
    return  "db" . $acctID;
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
    for($loop = 0;$loop < 3; $loop++){
    //while(true){
        preg_match_all('/\{{(.*?)\}}/', $template, $matches, PREG_PATTERN_ORDER);
        $aValue0 = $matches[0];
        $aValue1 = $matches[1];
        // somehow unique_array not work using hash instead.
        $hash = array();
        if(count($aValue0) == 0){
            break;
        }
        for($i = 0;$i<count($aValue0);$i++){
            $value0 = $aValue0[$i];
            $value1 = $aValue1[$i];
            $renderDirect = true;
            $renderRaw = false;
            //wPrint("-- $value0 $value1\n");
            if(startsWith($value1,"URL ")){
                $renderDirect = false;
                $value1 = substr($value1,4);
                //wPrint("-- change to $value1\n");
            }
            if(startsWith($value1,"RAW ")){
                $renderRaw = true;
                $value1 = substr($value1,4);
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
                        //Render content before publish to S3
                        $renderedContent = studio_url_render($data->$value1,$acctID,$progID,$data);
                        $s3Url = s3_put_contents($filename,$renderedContent,array("$acctID"=>$acctID,"$progID"=>$progID));
                        //$s3Url = s3_put_contents($filename,$data->$value1,array("$acctID"=>$acctID,"$progID"=>$progID));
                        $renderValue = str_replace("{{url}}", "$s3Url", $URLRenderFormat);
                    }
                    $xmlSave = $renderValue;
                    if($renderRaw==false){
                        $xmlSave = htmlspecialchars($renderValue);
                    }
                    $template = str_replace("$value0", "$xmlSave", $template);
                }else{
                    $missingValue = str_replace("{{value}}","$value1",$MISSINGRenderFormat);
                    $xmlSave = $missingValue;
                    if($renderRaw==false){
                        $xmlSave = htmlspecialchars($missingValue);
                    }
                    //$xmlSave = htmlspecialchars($missingValue);
                    $template = str_replace("$value0", "$xmlSave", $template);
                }
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

function MergeStdClassWithArray($data,$default)
{
    foreach($default as $key => $value){
        if(property_exists ( $data , $key )){
        }else{
            $data ->{$key} = $value;
        }
    }
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
    //return getTicket($_SESSION['ACCOUNTID'], $_SESSION['EMAIL'],$_SESSION['PWD']);
	return getTicket($_SESSION['ACCOUNTID'], $_SESSION['EMAIL'],$_SESSION['PWD'], $_SESSION['PARTNERGUID'], $_SESSION['PARTNERPASSWORD']);
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

function GetMamlProgramID($acctID,$progID)
{
    //$publishReturnFileName = "publish/".$acctID."_".$progID."_return.maml";
    //$publishMamlContent = file_get_contents($publishReturnFileName);
    $publishMamlContent = GetPublishedMAML($acctID,$progID);
    $xml = new DOMDocument();
    $xml->loadXML($publishMamlContent);
    $xpath = new DOMXpath($xml);
    $node = $xpath->query("/Program")->item(0);
    //$programNode = $xml->getElementsByTagName('Program')->item(0);
    return $node->getAttribute('DbId');
}

function GetPublishedMAML($acctID,$progID)
{
     $publishReturnFileName = "publish/".$acctID."_".$progID."_return.maml";
     $publishMamlContent = file_get_contents($publishReturnFileName);
     return($publishMamlContent);
}

function checkoutProgram($userTicket, $ACCOUNTID, $PublishProgramID){	
	$checkoutRequest   = array
	(
		
		"Credentials" => array
		(
			"Ticket" => $userTicket        
		),
		"ProgramID" => $PublishProgramID,
		"MamlFormat" => 0
	);
	$checkoutResponse = callService("programservice/CheckoutProgram", $checkoutRequest);
	$ErrorCode = $checkoutResponse->{"Result"}->{"ErrorCode"};
	$Maml = "";
	$errorMessage = "";
	if ($ErrorCode == "") {
		$MamlArray = $checkoutResponse->{"Maml"};
		
		foreach ($MamlArray as $MamlChr) {
			$Maml .= chr($MamlChr);
		}
		$file = "checkInMAML/".$ACCOUNTID."_".$PublishProgramID.".maml";
		file_put_contents( $file, $Maml );			
		$success = true;
	} else {
		$errorMessage = "checkoutResponse ERROR : <br> ErrorMessage -> ".$checkoutResponse->{"Result"}->{"ErrorMessage"}.'<br>'.
		"ExceptionMessage : ".$checkoutResponse->{"Result"}->{"ExceptionMessage"};
		$success = false;	
	}

	$result = array('success'=>$success, 'ticket' => $userTicket, 'Maml' => $Maml, 'errorMessage' => $errorMessage);
	return $result;
}

function checkinProgram($userTicket,$data){

	//$file = ROOT_DIR."checkInMAML/".$ACCOUNTID."_".$PublishProgramID.".maml";
	//$data = file_get_contents($file, true);


	// test change content
	//echo "data 1 : $data <br><br><br>";
	//$data = str_replace('aaaaaaaaaa', time()."&lt;br/&gt;".'aaaaaaaaaa'."&lt;br/&gt;", $data);
	//echo "data 2 : $data <br><br><br>";
	
	$byteArr = array();
	for($i = 0; $i < strlen($data); $i++) {
		$byteArr[$i] = ord($data[$i]); 
	}

	$checkinRequest   = array
	(
		
		"Credentials" => array
		(
			"Ticket" => $userTicket        
		),
		"MamlFormat" => 0,
		"CheckoutAfterCheckin" => "false",
		"Comments" => "",
		"Maml" => $byteArr
	);
	$checkinResponse = callService("programservice/CheckinProgram", $checkinRequest);
	$ErrorCode = $checkinResponse->{"Result"}->{"ErrorCode"};
	$Maml = "";
	$errorMessage = "";
	if ($ErrorCode == "") {
		$MamlArray = $checkinResponse->{"Maml"};
		
		foreach ($MamlArray as $MamlChr) {
			$Maml .= chr($MamlChr);
		}
		$success = true;
	} else {
		$errorMessage = "checkinResponse ERROR : <br> ErrorMessage -> ".$checkinResponse->{"Result"}->{"ErrorMessage"}.'<br>'.
		"ExceptionMessage : ".$checkinResponse->{"Result"}->{"ExceptionMessage"};
		$success = false;	
	}

	$result = array('success'=>$success, 'ticket' => $userTicket, 'Maml' => $Maml, 'errorMessage' => $errorMessage);
	return $result;
}


function UndoProgramChanges($userTicket, $PublishProgramID){	
	$undoRequest   = array
	(
		
		"Credentials" => array
		(
			"Ticket" => $userTicket        
		),
		"ProgramID" => $PublishProgramID,
		"MamlFormat" => 0
	);
	$undoResponse = callService("programservice/UndoProgramChanges", $undoRequest);
	$ErrorCode = $undoResponse->{"Result"}->{"ErrorCode"};
	$Maml = "";
	$errorMessage = "";
	if ($ErrorCode == "") {
		$MamlArray = $undoResponse->{"Maml"};
		
		foreach ($MamlArray as $MamlChr) {
			$Maml .= chr($MamlChr);
		}
		$success = true;
	} else {
		$errorMessage = "undoResponse ERROR : <br> ErrorMessage -> ".$undoResponse->{"Result"}->{"ErrorMessage"}.'<br>'.
		"ExceptionMessage : ".$undoResponse->{"Result"}->{"ExceptionMessage"};
		$success = false;	
	}

	$result = array('success'=>$success, 'ticket' => $userTicket, 'Maml' => $Maml, 'errorMessage' => $errorMessage);
	return $result;
}

function GetTicketBySession()
{
    $ACCOUNTID = $_SESSION['ACCOUNTID'];
    $EMAIL = $_SESSION['EMAIL'];
    $PWD = $_SESSION['PWD'];
    $PARTNERGUID = $_SESSION['PARTNERGUID'];
    $PARTNERPASSWORD = $_SESSION['PARTNERPASSWORD'];
    return getTicket($ACCOUNTID, $EMAIL, $PWD, $PARTNERGUID, $PARTNERPASSWORD);
}



function echoCallbackString($callback, $loadmore='', $authToken = '', $mpArray){
    echo $callback, '(',
    json_encode( array(
        'success'   => true,
        'loadmore'  => $loadmore,
        'authToken' => $authToken,
        'mps'=>$mpArray
    )), ')';
}

function UpdateMAMLPromoteBlog($xml,$doc)
{
    $xpath = new DOMXpath($xml);
    // scan for at most 10 email
    $ret = array();
    $contactRet = array();
    for($i=1;$i<10;$i++){
        // check if $doc is define 
        $scheduleDateTimeName = 'EMAIL'.$i.'-SCHEDULE1-DATETIME';
        $timeZoneName = 'EMAIL'.$i.'-SCHEDULE1-TIMEZONE';
        if(property_exists($doc,$scheduleDateTimeName)){
            // check if not default value
            $DateTimeValue = $doc->{$scheduleDateTimeName};
            $TimeZoneValue = $doc->{$timeZoneName};
            if($DateTimeValue!="" && $DateTimeValue!="01/01/2050 08:00:00 AM"){
                $subjectText = "Email".$i."Schedule";
                //$ret[] = $i;
                $node = $xpath->query("//Schedule/Subject[starts-with(text(),'".$subjectText."')]")->item(0);
                $scheduleNode  = $node->parentNode;
                $startNode = $scheduleNode->getElementsByTagName("Start")->item(0);
                $startNode->setAttribute("DateTime",$DateTimeValue);
                $scheduleNode->setAttribute("TimeZone",$TimeZoneValue);
                $ret[] = $xml->saveHTML($scheduleNode);
            }
        }
        
        //Find Contact nodes
        $contactText = "Email".$i."Contacts";
        $nodeList = $xpath->query("//CampaignElement[@Name='".$contactText."']");
        $CriteriaJoinOperatorValue = $doc->{'EMAIL-FILTER-JOINOPERATOR'};
        $CriteriaXML = $doc->{'EMAIL-FILTER-CRITERIAROW'};
        if ($nodeList->length > 0) {
            $node = $nodeList->item(0);
            $filterNode = $node->getElementsByTagName("Filter")->item(0);
            
            /* delete criteria node */
            $deleteList = array();
            $criteriaNodes = $filterNode->getElementsByTagName("Criteria");
            foreach ($criteriaNodes as $n) {
                $deleteList[] = $n;
            }
            foreach ($deleteList as $n) {
                $filterNode->removeChild($n);
            }
            
            //Set attribute
            $filterNode->setAttribute("CriteriaJoinOperator",$CriteriaJoinOperatorValue);
            
            //add criteria
            $f = $xml->createDocumentFragment();
            $f->appendXML($CriteriaXML);
            $filterNode->appendChild($f);
            
            $contactRet[] = $xml->saveHTML($filterNode);
        }
        
        //OPEN-MY-EMAIL "OpenAlertLeadTrigger
        //$OpenAlertLeadTrigger = $xpath->query("//CampaignElement[@Name='OpenAlertLeadTrigger']")->item(0);
    }
    $OpenAlertLeadTrigger = DomSetAttribute($xpath,"//CampaignElement[@Name='OpenAlertLeadTrigger']","State",$doc->{'OPEN-MY-EMAIL'});
    $ClickAlertLeadTrigger = DomSetAttribute($xpath,"//CampaignElement[@Name='ClickAlertLeadTrigger']","State",$doc->{'VISIT-MY-BLOCK'});
    
    return array(
        "type" => "PromoteBlog",
        "ContactUpdate" => $contactRet,
        "Maml"=> $xml->saveHTML(),
        "EmailUpdate" => $ret,
        "OpenAlertLeadTrigger" => $xml->saveHTML($OpenAlertLeadTrigger),
        "ClickAlertLeadTrigger" => $xml->saveHTML($ClickAlertLeadTrigger),
    );
}

function UpdateMAMLPromoteEbook($xml,$doc)
{
    $xpath = new DOMXpath($xml);
    // scan for at most 10 email
    $ret = array();
    for($i=1;$i<10;$i++){
        // check if $doc is define 
        $scheduleDayName = 'EMAIL'.$i.'-SCHEDULE1-DAYS';
        $scheduleHourName = 'EMAIL'.$i.'-SCHEDULE1-HOURS';
        $scheduleMinName = 'EMAIL'.$i.'-SCHEDULE1-MINS';
        $scheduleStateName = 'EMAIL'.$i.'-STATE';
        if(property_exists($doc,$scheduleDayName)){
            $subjectText = "Email".$i."Schedule";
            DomSetAttribute($xpath,"//CampaignElement[@Name='Email".$i."']/Schedules/Schedule/Start","Days",$doc->$scheduleDayName);
            DomSetAttribute($xpath,"//CampaignElement[@Name='Email".$i."']/Schedules/Schedule/Start","Hours",$doc->$scheduleHourName);
            DomSetAttribute($xpath,"//CampaignElement[@Name='Email".$i."']/Schedules/Schedule/Start","Mins",$doc->$scheduleMinName);
            DomSetAttribute($xpath,"//CampaignElement[@Name='Email".$i."']","State",$doc->$scheduleStateName);
            $node = $xpath->query("//CampaignElement[@Name='Email".$i."']")->item(0);            
            $ret[] = $xml->saveHTML($node);
        }
        //OPEN-MY-EMAIL "OpenAlertLeadTrigger
        //$OpenAlertLeadTrigger = $xpath->query("//CampaignElement[@Name='OpenAlertLeadTrigger']")->item(0);
    }
    $visitMyEBook = DomSetAttribute($xpath,"//CampaignElement[@Name='VisitAlertLeadTrigger']","State",$doc->{'VISIT-MY-EBOOK'});
    $downloadMyEBook = DomSetAttribute($xpath,"//CampaignElement[@Name='DownloadAlertLeadTrigger']","State",$doc->{'DOWNLOAD-MY-EBOOK'});
    //$OpenAlertLeadTrigger = DomSetAttribute($xpath,"//CampaignElement[@Name='OpenAlertLeadTrigger']","State",$doc->{'OPEN-MY-EMAIL'});
    //$ClickAlertLeadTrigger = DomSetAttribute($xpath,"//CampaignElement[@Name='ClickAlertLeadTrigger']","State",$doc->{'VISIT-MY-BLOCK'});
    
    return array(
        "type" => "PromoteEbook",
        "EmailUpdate" => $ret,
        "VisitAlertLeadTrigger" => $xml->saveHTML($visitMyEBook),
        "DownloadAlertLeadTrigger" => $xml->saveHTML($downloadMyEBook),
        "Maml"=> $xml->saveHTML(),                
    );
}

function UpdateMAML($xml,$doc,$campaignType)
{
    if($campaignType == "PromoteBlog"){
        return UpdateMAMLPromoteBlog($xml,$doc);
    }
    if($campaignType == "PromoteEbook"){
        return UpdateMAMLPromoteEbook($xml,$doc);
    }
    return array(
        "success" => false,
        "message"=> "campaignType not found ".$campaignType,
    );
}

function AddNewCampaign($dbName,$doc)
{
    //Check if we have this ID before
    $campaignListDoc = couchDB_Get("/$dbName/campaignlist",true);
    for($i=0;$i<count($campaignListDoc['campaigns']);$i++){
        $campaignID =  $campaignListDoc['campaigns'][$i]['campaignID'];
        if($campaignID == $doc->campaignID){
            return array(
                    'success'=>false,
                    'message'=>"duplicate campaign ID found in campaignList  ".$campaignID ,
            );
        }
    }
    // Save Document
    $saveRet = couchDB_Save("/$dbName/".$doc->campaignID,$doc);
    if(!empty($saveRet->error)){
        return array(
                'success'=>false,
                'message'=>"duplicate campaign ID found in document ".$doc->campaignID ,
        );
    }
    // Add and Save campaignList
    $dateTimeNow = GetStringTimeStamp();
    $campaignListDoc['campaigns'][] = array(
        "campaignID" => $doc->campaignID,
        "accountID"  => $doc->accountID,
        "campaignName"  =>  $doc->campaignName,
        "createDate"  => $dateTimeNow,
        "lastEditDate"  => $dateTimeNow,
        "status"  => "Edit",
        "campaignType"  => $doc->campaignType,
    );
    $saveCampaignListRet = couchDB_Save("/$dbName/campaignlist",$campaignListDoc);
    return array(
        'success'=>true,
        "saveRet"=>$saveRet,
        "saveCampaignListRet"=>$saveCampaignListRet,
    );
}

function DomSetAttribute($xpath,$path,$attr,$value)
{
    $nodes = $xpath->query($path);
    if ($nodes->length > 0) {
        $node = $nodes->item(0);
        $node->setAttribute($attr,$value);
        return $node;
    }
    return null;
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

function GetStringTimeStamp()
{
    return gmdate('Y-m-d\TH:i:s\Z', time()); 
}

?>