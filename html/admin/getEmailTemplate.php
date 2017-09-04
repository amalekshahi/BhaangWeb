<?php
/*
    getEmailTemplate.php
    param
    blueprint
    scopeName (default = "config")
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

//Read default 
//echo "HAHA";
//$c = file_get_contents("conf/".$requestBlueprint.".conf");
//echo $c;
//$default = json_decode(file_get_contents("conf/".$requestBlueprint.".conf"),true);
$default = couchDB_Get("/master/Default_".$requestBlueprint,true);

$accountID = $_SESSION['ACCOUNTID'];
$accountInfo = couchDB_Get("/db$accountID/UserInfo",true);
//if(!empty($_REQUEST['dbg'])){
MergeArrayWithArray($accountInfo,$default);
//    print_r($default);
//    exit;
//};
//print_r($default);
//Read config file

$configs = $masterTemplate->emails;
//$configs = json_decode(file_get_contents("templates/emails/list.json"));
//print_r($configs);

$ret = array();
$number = 0;
foreach($configs as $config)
{
    $number = $number + 1;
    $fileName = "templates/emails/".$config->file;
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
    
    $editTag = '<summernote airMode ng-model="'.$scopeName.'[\'$1\']" editor="editor'.$number.'" on-image-upload="imageUpload(files,\'editor'.$number.'\')"></summernote>';
    // Replace {{EMAIL}} with proper summernote tag
    $content = preg_replace('/\{{(EMAIL[^\}]*)}\}/',$editTag ,$fileContent);
    
    $noneEditTag = '{{'.$scopeName.'[\'$1\']}}';
    // Replace other tag with normal tag
    $content = preg_replace('/\{{([^\}]*)}\}/',$noneEditTag ,$content);
    

    $ret[] = array(
        "title"=> $config->title,
        "contentRaw"=> $fileContentRaw,
        "content"=> $content,
        "accountInfo"=>$accountInfo,
        "accountID"=>$accountID,
        "newDefault"=>$newDefault,
    );
}

$testResult = preg_replace('/\[\[REMOVE ([^\]]*)\]\]/',"$1","aa [[REMOVE xxx\n]] bb");
echo json_encode(
        array(
            'testResult'=>$testResult,
            'config'=>$accountInfo,
            'templates'=>$ret,
        )
    );
?>