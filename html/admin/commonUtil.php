<?php
require_once '../vendor/autoload.php';
require_once 'global.php';

use Aws\S3\S3Client;
use Guzzle\Service\Resource\Model; 


$configFile = "conf/davinci.json";
$URLRenderFormat = "##URL SRC=\"{{url}}\"##";
$MISSINGRenderFormat = "MISSING-{{value}}";
$AWSFormatURL = "https://bkktest.s3.amazonaws.com/{{fileName}}";
$AWSFormatFileName = "/stage/{{fileName}}";
$AWSAssetFileName = "/{{pathUpload}}/{{fileName}}";
$AWSAssetPath = "/{{pathUpload}}";
$LocalFormatURL = "https://web2xmm.com/admin/images/{{fileName}}";
$LocalFormatFileName = "/var/www/html/admin/images/{{fileName}}";
$databaseEndpoint = "http://web2xmm.com:5984";	//"http://localhost:5984"
//$databaseEndpoint = "http://localhost:5984/couchdb"

$davinciConf = davinciSetConfig();


function davinciSetConfig()
{
    global $configFile;
    global $databaseEndpoint;
    global $AWSFormatFileName;
	global $AWSAssetFileName; 
	global $AWSAssetPath;
	global $serverMode;
    $data = file_get_contents($configFile);    
    if(!empty($data)){
        $doc = json_decode($data,false);
        $databaseEndpoint = $doc->databaseEndPoint;
		$serverMode = $doc->serverName;
		$serverMode = strtolower($serverMode);	
        if(!empty($doc->s3Path)){
            $AWSFormatFileName = $doc->s3Path . "/{{fileName}}";				
        }
        if(!empty($doc->s3Server)){
			//echo "asset path = "; 
			
			$AWSAssetPath = $doc->s3Path . "/{{dbname}}" .$doc->s3Server ; // "tmp/dbname/server"
			$AWSAssetFileName = $AWSAssetPath . $AWSAssetFileName; 	

//			$AWSAssetFileName = $doc->s3Path . "/{{dbname}}" .$doc->s3Server . $AWSAssetFileName; 
			//echo "\n$AWSAssetFileName\n"; 
        }
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
            if(startsWith($value1,"SUMMERNOTE(")){
                $value1 = substr($value1,11);
                $value1 = str_replace(")","",$value1);
            }
            if(startsWith($value1,"SUMMERNOTETEXT(")){
                $value1 = substr($value1,15);
                $value1 = str_replace(")","",$value1);
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

function studio_url_render2($template,$acctID,$progID,$data,$urlFormat=NULL)
{
    global $URLRenderFormat;
    global $MISSINGRenderFormat;
    $start_time = microtime(true);
    $s3_time = 0;
    $s3_detail = array();
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
                        $studio_url_render_ret = studio_url_render2($data->$value1,$acctID,$progID,$data);
                        $renderedContent = $studio_url_render_ret['template'];
                        $s3_start_time = microtime(true);
                        $s3Url = s3_put_contents($filename,$renderedContent,array("$acctID"=>$acctID,"$progID"=>$progID));
                        $s3_time = $s3_time +  microtime(true) - $s3_start_time;
                        $s3_detail[] = array(
                            "time"=> microtime(true) - $s3_start_time,
                            "url"=> $filename,
                        );
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
    return array(
        "total_time"=>  microtime(true)- $start_time,
        "s3_time"=> $s3_time,
        "s3_detail" => $s3_detail,
        "loop"=>$loop,
        "template"=>$template,
    );
}

function GenerateS3FileName($fieldName,$acctID,$progID,$suffix)
{
    if (preg_match('/PROGRAMID/',$fieldName)){
        $filename = str_replace("ACCTID",$acctID,$fieldName);
        $filename = str_replace("PROGRAMID",$progID,$filename);
        $filename = $filename . $suffix;
    }else{
        $filename = $fieldName . "-" . $acctID . "-" . $progID . $suffix;
    }
    return $filename;
}

function RenderByMamlInfo($mamlInfo,$tmaml,$acctID,$progID,$doc)
{
    $cacheFileName = "cache/".$acctID."_".$progID."_s3cache.json";
    $cache = array();
    if(file_exists($cacheFileName)){
        $cache = json_decode(file_get_contents($cacheFileName),true);
    }
    $xml = new DOMDocument();
    $xml->loadXML($tmaml);
    $xpath = new DOMXpath($xml);
    // iterate true data 
    $renderErrors = array();
    $renderSuccess = array();
    //handle Doms
    foreach($mamlInfo->doms as $dom){
        $attributeName = $dom->attribute;
        $xpathName = $dom->xpath;
        $valueFormat = $dom->value;
        $value = studio_url_render($valueFormat,$acctID,$progID,$doc);
        $nodeRet = DomSetAttribute($xpath,$xpathName,$attributeName,$value);
        if($nodeRet == null){
            $renderErrors[] = $xpathName.": Not found";
        }else{
            $renderSuccess[] = $valueFormat.":".$xml->saveHTML($nodeRet);
        }
    }
    //handle Fields
    foreach($mamlInfo->fields as $field){
        $numloop = 1;
        $startloop = 1;
        if(property_exists($field,"loop")){
            $numloop = $field->loop;
        }
        if(property_exists($field,"start")){
            $startloop = $field->start;
        }
        
        for($i=$startloop;$i<=$numloop;$i++){
            $fieldName = str_replace("#","".$i,$field->name);
            $xpathName = str_replace("#","".$i,$field->xpath);
            if(property_exists($doc,$fieldName)){
                $value = $doc->{$fieldName};
                if(property_exists($field,"htmldecode")){
                    if($field->htmldecode){
                        $value = html_entity_decode($value);
                    }
                }
                if(!empty($field->attribute)){
                    if($field->type == "LINK"){
                        $renderedContent = studio_url_render($value,$acctID,$progID,$doc);
                        $contentMD5 = md5($renderedContent);
                        /*if($cache[$filename] == $contentMD5){
                            $renderSuccess[] = $fieldName.": skip by s3 cache";
                            continue;
                        }*/
                        $filename = GenerateS3FileName($fieldName,$acctID,$progID,".html");
                        $s3Url = s3_put_contents($filename,$renderedContent,array("$acctID"=>$acctID,"$progID"=>$progID));
                        $value = $s3Url;
                        $cache[$filename] = $contentMD5;
                    }
                    $nodeRet = DomSetAttribute($xpath,$xpathName,$field->attribute,$value);
                    if(!empty($nodeRet)){
                        if($fieldName!="campaignName"){ // cmapaignName is whole file (skip this)
                            $renderSuccess[] = $fieldName.":".$xml->saveHTML($nodeRet);
                        }
                    }else{
                        $renderErrors[] = $xpathName." not found " . $startloop . ":". $i .":". $numloop ;
                    }
                }else{
                    if($field->type == "NODE"){
                        if(property_exists($field,"deleteAll")){
                            if($field->deleteAll){
                                DomDeleteAllChildren($xpath,$xpathName);
                            }
                        }
                        if(property_exists($field,"deleteNode")){
                            $deleteNodeName = $field->deleteNode;
                            DomDeleteChildNode($xpath,$xpathName,$deleteNodeName);
                        }
                        
                        
                        /* delete criteria node */
                        /*$deleteList = array();
                        $criteriaNodes = $filterNode->getElementsByTagName("Criteria");
                        foreach ($criteriaNodes as $n) {
                            $deleteList[] = $n;
                        }
                        foreach ($deleteList as $n) {
                            $filterNode->removeChild($n);
                        }
                        
                        //Set attribute
                        $filterNode->setAttribute("CriteriaJoinOperator",$CriteriaJoinOperatorValue);
                        */
                        //add criteria
                        //DomSetText($xpath,$xpathName,"");
                        $nodeRet = DomAddNode($xml,$xpath,$xpathName,$value);
                    }else{
                        if($field->type == "URL"){
                            //Render content before publish to S3
                            $renderedContent = studio_url_render($value,$acctID,$progID,$doc);
                            $contentMD5 = md5($renderedContent);
                            /*if($cache[$filename] == $contentMD5){
                                $renderSuccess[] = $fieldName.": skip by s3 cache";
                                continue;
                            }*/
                            $filename = GenerateS3FileName($fieldName,$acctID,$progID,".html");                            
                            $s3Url = s3_put_contents($filename,$renderedContent,array("$acctID"=>$acctID,"$progID"=>$progID));
                            $value = str_replace("{{url}}", "$s3Url","##URL SRC=\"{{url}}\"##");
                            $cache[$filename] =$contentMD5;
                        }else if($field->type == "LINK"){
                            //Render content before publish to S3
                            $renderedContent = studio_url_render($value,$acctID,$progID,$doc);
                            $contentMD5 = md5($renderedContent);
                            /*if($cache[$filename] == $contentMD5){
                                $renderSuccess[] = $fieldName.": skip by s3 cache";
                                continue;
                            }*/
                            $filename = GenerateS3FileName($fieldName,$acctID,$progID,".html");                            
                            $s3Url = s3_put_contents($filename,$renderedContent,array("$acctID"=>$acctID,"$progID"=>$progID));
                            $value = $s3Url;
                            $cache[$filename] = $contentMD5;
                        }else{
                            $renderedContent = studio_url_render($value,$acctID,$progID,$doc);
                            $value = $renderedContent;
                        }
                        $nodeRet = DomSetText($xpath,$xpathName,$value);
                    }
                    if(!empty($nodeRet)){
                        $renderSuccess[] = $fieldName.":".$xml->saveHTML($nodeRet);
                    }else{
                        $renderErrors[] = $xpathName." not found " . $startloop . ":". $i .":". $numloop ;
                    }
                }
            }else{
                $renderErrors[] =  "Field ".$fieldName." not found";
            }
        }
    }
    //save s3 cache
    file_put_contents($cacheFileName,json_encode($cache));
    $xmlResult = $xml->saveHTML();
    // change MFInput back to Input from DomAddNode
    $xmlResult = str_replace("MFInput", "Input",$xmlResult);
    // Render {{}} that might be left
    $xmlResult = studio_url_render($xmlResult,$acctID,$progID,$doc);
    return 
        array(
            'success'=>true,
            'cmd'=>$cmd,
            'mode'=>$mode,
            'mamlInfoFileName'=>$mamlInfoFileName,
            'mamlInfo'=>$mamlInfo,
            'renderErrors'=>$renderErrors,
            'renderSuccess'=>$renderSuccess,
            'doc' => $doc,
            'xml'=>$xmlResult,
            'cache'=>$cache,
        );
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

function MergeArrayWithArray(& $data,$default)
{
    foreach($default as $key => $value){
        if (!array_key_exists($key,$data)) {
            //echo "Merge $key<br>\n";
            $data[$key] = $value;
        }
    }
    //print_r($data);
}

function MergeStdClassWithStdClass($data,$default,$override = false)
{
    foreach(get_object_vars($default) as $key => $value) {
        if(property_exists ( $data , $key )){
            if($override){
                $data ->{$key} = $value;
            }
        }else{
            $data ->{$key} = $value;
        }
    }
}

function CleanDocument($doc)
{
    unset($doc->_rev);
    unset($doc->_id);
}

function GetUserInfoFromDB($dbName)
{
    $docDefault = couchDB_Get("/master/Default_UserInfo");

    $doc = couchDB_Get("/$dbName/UserInfo");
    $default = false;
    if(!empty($doc->error)){
        //not found need to return from default
        $default = true;
        /*$doc = couchDB_Get("/master/Default_UserInfo");
        if(!empty($doc->error)){
            return  array(
                    'success'=>false,
                    'message'=>"Default_UserInfo not found",
                );
        }*/
        $doc = $docDefault;
        CleanDocument($doc);
    }else{
        MergeStdClassWithStdClass($doc,$docDefault,false);
    }
    return array(
            'success'=>true,
            'doc'=>$doc,
            'default'=>$default,
            'dbName'=>$dbName,
            'docDefault'=>$docDefault,
    );
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

function s3_exists($absolutePath)
{
		$client = S3Client::factory(array(
			'credentials' => array(
				'key'    => AWSKEY,
				'secret' => AWSSECRET,
			)
		));
		//echo "exist-path = " . $absolutePath . "\n----" ; 
		$result = $client->doesObjectExist( AWSBUCKET, $absolutePath);
		return $result;        
}


function s3_createFolder_asset($dbName,$mainFolder,$folderName) 
{	
		global $AWSAssetPath; 
	    $awsPath = str_replace("{{dbname}}", "$dbName", $AWSAssetPath);	
		$awsPath = str_replace("/tmp", "tmp", $awsPath);	
		$awsPath = $awsPath . "/" . $mainFolder . "/"; 
		//echo "<br>awsPath = $awsPath<br>"; 
		$client = S3Client::factory(array(
			'credentials' => array(
				'key'    => AWSKEY,
				'secret' => AWSSECRET,
			)
		));
		 $result = $client->putObject(array(
            'Bucket' => AWSBUCKET, // Defines name of Bucket
            'Key' => $awsPath . $folderName."/", //Defines Folder name
            'Body' => "",
            'ACL' => 'public-read' // Defines Permission to that folder
        ));		
		//var_dump($result['ObjectURL']); 
		return  $result['ObjectURL']; 

}// ends3_createFolder_asset


function s3_delete_asset($dbName,$absolutefilepath) 
{
//		echo "\n<br>absolutefilepath = $absolutefilepath<br>\n"; 
		$client = S3Client::factory(array(
			'credentials' => array(
				'key'    => AWSKEY,
				'secret' => AWSSECRET,
			)
		));
		$result = null;
		try {			
			$result = $client->deleteObject(array(	
				"Bucket" => AWSBUCKET,
				"Key" =>  $absolutefilepath,
			));
			//var_dump("vardump = ["+$result+"]]]]"); 
		} catch (Exception $e) {
			echo "ERROR::>>>>".$e->getMessage(); 			
			return $e->getMessage() ; 
		}
		//echo "****marker=[".$result['DeleteMarker'] . "]-----" ;
		return $result['DeleteMarker'];

}//end s3_delete_asset

function s3_get_asset($dbName,$folder)
{
		global $AWSAssetPath; 
	    $path = str_replace("{{dbname}}", "$dbName", $AWSAssetPath);	
		$path = str_replace("/tmp", "tmp", $path);	
		$path = $path . $folder; 
		//echo "<br>path = $path<br>"; 
		$client = S3Client::factory(array(
			'credentials' => array(
				'key'    => AWSKEY,
				'secret' => AWSSECRET,
			)
		));

		$objects = $client->getListObjectsIterator(array(	
			"Bucket" => AWSBUCKET,
			"Prefix" =>  $path
		));
		if (empty($objects)) {
			 //echo json_encode( array('success'=>false));
			 return array(); 
		}else{
			$fileArr = array() ; 
			$cnt=0; 
			$size=0; 
			
			foreach ($objects as $object) {
				$cnt ++; 
				$filename = basename($object['Key']); 
				if($cnt > 1 ){
					$size = $size+$object['Size'];
					$sizeTxt = formatSizeUnits($size);					
					$data = array('fpath' => $path . "/" ,'fname' => $filename , 'fsize' =>$sizeTxt);
					//array_push($fileArr, $path . "/". $filename); 
					array_push($fileArr,$data); 
					//echo  "<br>" . $filename . " = ". $sizeTxt . "<br>"; 
				}
			}
			return $fileArr;			
		}
}//end s3_get_asset();

function s3_put_asset($fileName,$data,$dbName,$pathUpload,$metaData=array())
{
	global $AWSAssetFileName;
    $path = str_replace("{{dbname}}", "$dbName", $AWSAssetFileName);	
	$path = str_replace("{{pathUpload}}", "$pathUpload", $path);
    $path = str_replace("{{fileName}}", "$fileName", $path);
	echo "asset PATH = " . $path . "\n"; 

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
		'CacheControl'  => 'max-age=0',
        'Metadata'   => $metaData,
    ));
    return $result['ObjectURL'];
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
		'CacheControl'  => 'max-age=0',
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
            if($node->getElementsByTagName("Filter")->length > 0){
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

function DomGetAttribute($xpath,$path,$attr)
{
    $nodes = $xpath->query($path);
    if ($nodes->length > 0) {
        $node = $nodes->item(0);
        return $node->getAttribute($attr);
    }
    return null;
}

function DomSetText($xpath,$path,$value)
{
    $nodes = $xpath->query($path);
    if ($nodes->length > 0) {
        $node = $nodes->item(0);
        $node->nodeValue = $value;
        return $node;
    }
    return null;
}

function DomAddNode($xml,$xpath,$path,$value)
{
    $nodes = $xpath->query($path);
    if ($nodes->length > 0) {
        $node = $nodes->item(0);
        $f = $xml->createDocumentFragment();
        // Somehow php dom does not like <Input>
        // so we change to <MFInput> and will change back later after serialize to xml string
        $data = str_replace("Input", "MFInput", $value);

        $f->appendXML($data);
        /*
        $docB = new DomDocument();
        // Somehow php dom does not like <Input>
        // so we change to <MFInput> and will change back later after serialize to xml string
        $data = str_replace("Input", "MFInput", $value);
        $docB->loadXML($data);
        $f = $xml->importNode($docB->documentElement, true);
        */
        $node->appendChild($f);
        return $node;
    }
    return null;
}

function DomCount($xpath,$path)
{
    $nodes = $xpath->query($path);
    return $nodes->length;
}

function DomDeleteAllChildren($xpath,$path)
{
    $nodes = $xpath->query($path);
    if ($nodes->length > 0) {
        $node = $nodes->item(0);
        deleteChildren($node);
    }
}

function DomDeleteChildNode($xpath,$path,$nodeName)
{
    $nodes = $xpath->query($path);
    if ($nodes->length > 0) {
        $node = $nodes->item(0);
        $criteriaNodes = $node->getElementsByTagName($nodeName);
        foreach ($criteriaNodes as $n) {
            $deleteList[] = $n;
        }
        foreach ($deleteList as $n) {
            $node->removeChild($n);
        }
    }
}

function GetContentVariableList($xpath)
{
    $ContentVariables = array();
    $nodes = $xpath->query("//ContentVariables/ContentVariable");
    for($i=0;$i<$nodes->length;$i++){
        $node = $nodes->item($i);
        $ContentVariables[] = $node->getAttribute("Name");
    }
    return $ContentVariables;
}

function deleteNode($node) { 
    deleteChildren($node); 
    $parent = $node->parentNode; 
    $oldnode = $parent->removeChild($node);
    return $oldnode;
} 

function deleteChildren($node) { 
    while (isset($node->firstChild)) { 
        deleteChildren($node->firstChild); 
        $node->removeChild($node->firstChild); 
    } 
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
function formatSizeUnits($bytes) {
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }
    return $bytes;
}

?>