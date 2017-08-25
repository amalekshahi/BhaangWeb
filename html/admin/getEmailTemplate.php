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

//print_r($default);
//Read config file

$configs = $masterTemplate->emails;
//$configs = json_decode(file_get_contents("templates/emails/list.json"));
//print_r($configs);

$ret = array();
foreach($configs as $config)
{
    $fileName = "templates/emails/".$config->file;
    $fileContent = file_get_contents($fileName);
    if(!empty($asEmail)){
        // change EMAIL1 to $asEmail
        $fileContent = str_replace('{{EMAIL1-',"{{EMAIL".$asEmail."-",$fileContent);
    }
    
    $editTag = '<summernote airMode ng-model="'.$scopeName.'[\'$1\']"></summernote>';
    // Replace {{XXXX}} with proper summernote tag
    $content = preg_replace('/\{{([^\}]*)}\}/',$editTag ,$fileContent);
    $ret[] = array(
        "title"=> $config->title,
        "contentRaw"=> $fileContent,
        "content"=> $content,
    );
}

echo json_encode(
        array(
            'config'=>$default,
            'templates'=>$ret,
        )
    );
?>