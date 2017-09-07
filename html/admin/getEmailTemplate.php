<?php
/*
    getEmailTemplate.php
    param
    blueprint
    scopeName (default = "config")
    resource (default = "emails";
    as  (Ex, 2  will change all EMIL1-XXX to EMAIL2-XXXX)
*/
#require '/var/www/html/vendor/autoload.php';
#require_once 'global.php';
require_once 'commonUtil.php';

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

session_start();

if(empty($_REQUEST['blueprint'])){
    echo json_encode( 
        array(
            'success'=>false,
            'message'=>"param blueprint is needed",
        ));
    exit;
}
$scopeName = $_REQUEST['scopeName'];
if(empty($scopeName)){
    $scopeName = "config";
}

$resourceName = $_REQUEST['resource'];
if(empty($resourceName)){
    $resourceName = "emails";
}


$asEmail = $_REQUEST['as'];
$requestBlueprint = $_REQUEST['blueprint'];

$masterTemplate = couchDB_Get("/master/templates");
//$blueprints = json_decode(file_get_contents("conf/template.conf"));
$blueprints = $masterTemplate->blueprints;
// check if we have this blueprint
$flgFound = false;
foreach($blueprints as $blueprint)
{
    if($blueprint->campaignType == $requestBlueprint){
        $flgFound = true;
    }
}
if(!$flgFound){
     echo json_encode( 
        array(
            'success'=>false,
            'message'=>"blueprint $requestBlueprint not found",
        ));
    exit;
}

$default = couchDB_Get("/master/Default_".$requestBlueprint,true);
if($default['error'] == "not_found"){
    echo json_encode( 
        array(
            'success'=>false,
            'message'=>"DB at /master/Default_".$requestBlueprint."not found",
        ));
    exit;
}

$accountID = $_SESSION['ACCOUNTID'];
$accountInfo = couchDB_Get("/db$accountID/UserInfo",true);
MergeArrayWithArray($accountInfo,$default);

$configs = $masterTemplate->{$resourceName};

$ret = array();
$number = 0;
foreach($configs as $config)
{
    // check disabled field
    if(array_key_exists("disabled",$config)){
        if($config->disabled){
            continue;
        }
    }
    // check subdir
    if(array_key_exists("subdir",$config)){
        $fileName = "templates/".$resourceName."/".$config->subdir."/".$config->file;
    }else{
        $fileName = "templates/".$resourceName."/".$config->file;
    }
    $fileContentRaw = file_get_contents($fileName);
    if(!empty($asEmail)){
        // change EMAIL1 to $asEmail
        $fileContentRaw = str_replace('EMAIL1-',"EMAIL".$asEmail."-",$fileContentRaw);
        
    }
    
    //change <viewStyle> to <style>
    $fileContent = $fileContentRaw;
    // Handle [[REMOVE 
    $fileContent = preg_replace('/\[\[REMOVE ([^\]]*)\]\]/',"",$fileContent);
    $fileContentRaw = preg_replace('/\[\[REMOVE ([^\]]*)\]\]/',"$1",$fileContentRaw);
    
    $fileContentRaw = str_replace("<aview","<a",$fileContentRaw);
    $fileContentRaw = str_replace("aview>","a>",$fileContentRaw);

    
    //Remove {{RAW 
    $fileContent = str_replace("{{RAW ","{{",$fileContent);
    
    
    $number = $number + 1;    
    $editTag = '<summernote airMode ng-model="'.$scopeName.'[\'$1\']" editor="editor'.$number.'" on-image-upload="imageUpload(files,\'editor'.$number.'\')"></summernote>';
    // Replace {{EMAIL}} with proper summernote tag
    $content = preg_replace('/\{{(EMAIL[^\}]*)}\}/',$editTag ,$fileContent);
    
    $noneEditTag = '{{'.$scopeName.'[\'$1\']}}';
    // Replace other tag with normal tag
    $content = preg_replace('/\{{([^\}]*)}\}/',$noneEditTag ,$content);
    

    $ret[] = array(
        "fileName"=>$fileName,
        "title"=> $config->title,
        "contentRaw"=> $fileContentRaw,
        "content"=> $content,
        "accountInfo"=>$accountInfo,
        "accountID"=>$accountID,
        "subdir"=>$config->subdir,
    );
}

//$testResult = preg_replace('/\[\[REMOVE ([^\]]*)\]\]/',"$1","aa [[REMOVE xxx\n]] bb");
echo json_encode(
        array(
            //'testResult'=>$testResult,
            'config'=>$accountInfo,
            'templates'=>$ret,
            'resourceName'=>$resourceName,
        )
    );
?>