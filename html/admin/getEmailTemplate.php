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
$number = 0;
foreach($configs as $config)
{
    $number = $number + 1;
    $fileName = "templates/emails/".$config->file;
    $fileContentRaw = file_get_contents($fileName);
    //Replace {{RAW 
    $fileContent = str_replace("{{RAW ","{{",$fileContentRaw);
    if(!empty($asEmail)){
        // change EMAIL1 to $asEmail
        $fileContent = str_replace('{{EMAIL1-',"{{EMAIL".$asEmail."-",$fileContent);
    }
    
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
    );
}

echo json_encode(
        array(
            'config'=>$default,
            'templates'=>$ret,
        )
    );
?>