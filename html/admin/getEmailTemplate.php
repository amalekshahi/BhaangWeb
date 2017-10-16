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



function DoSummerNote($fileContent,$scopeName,$number)
{
    $editTag = '<summernote airMode config="smnOptions" ng-model="'.$scopeName.'[\'$1\']" editor="editor'.$number.'" on-image-upload="imageUpload(files,\'editor'.$number.'\')"></summernote>';
    // Replace {{SUMMERNOTE(XXXXXX)}} with proper summernote tag
    $content = preg_replace('/\{{SUMMERNOTE\(([^\}]*)\)}\}/',$editTag ,$fileContent);    
    return $content;
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
        break;
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

//$configs = $masterTemplate->{$resourceName};
$configs = $blueprint->{$resourceName};

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
    
    $fileContent = $fileContentRaw;
    // Handle [[REMOVE  to remove data from DV view
    $fileContent = preg_replace('/\[\[REMOVE ([^\]]*)\]\]/',"",$fileContent);
    $fileContentRaw = preg_replace('/\[\[REMOVE ([^\]]*)\]\]/',"$1",$fileContentRaw);
    // Handle [[ADD  to add data to DV view
    $fileContent = preg_replace('/\[\[ADD ([^\]]*)\]\]/',"$1",$fileContent);
    $fileContentRaw = preg_replace('/\[\[ADD ([^\]]*)\]\]/',"",$fileContentRaw);
    
    //TODO: remove this and handle with <a[[ADD view]] instead.
    $fileContentRaw = str_replace("<aview","<a",$fileContentRaw);
    $fileContentRaw = str_replace("aview>","a>",$fileContentRaw);

    /*  
        Below only process for DV view
    */
    //Remove {{RAW 
    $content = str_replace("{{RAW ","{{",$fileContent);
    
    
    $number = $number + 1;    
    //TODO: remove this and handle with DoSummerNote instead
    $editTag = '<summernote airMode config="smnOptions" ng-model="'.$scopeName.'[\'$1\']" editor="editor'.$number.'" on-image-upload="imageUpload(files,\'editor'.$number.'\')"></summernote>';
    // Replace {{EMAIL}} with proper summernote tag
    $content = preg_replace('/\{{(EMAIL[^\}]*)}\}/',$editTag ,$content);
    
    //SUMMERNOTE()
    $content = DoSummerNote($content,$scopeName,$number);
    
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
        "blueprint"=>$blueprint,
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