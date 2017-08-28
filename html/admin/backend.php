<?php
/*
    backend.php
    param
    cmd = publish/update
    acctID = accountID
    progID = programID
    mode = test
*/
require_once 'commonUtil.php';

session_start();
if($_REQUEST['mode']=="test"){
    $_SESSION['ACCOUNTID'] = '228';
    $_SESSION['ACCOUNNAME'] = 'CampaignLauncher';
    $_SESSION['EMAIL'] = 'boonsom@mindfireinc.com';
    $_SESSION['PWD'] = 'Atm12345#';
    $_SESSION['PARTNERGUID'] = 'CampaignLauncherAPIUser';
    $_SESSION['PARTNERPASSWORD'] = '4e98af380d523688c0504e98af3=';
};

if(empty($_SESSION['EMAIL'])){
    echo json_encode( 
        array(
            'success'=>false,
            'message'=>"Session Not found",
        ));
    exit;
}

if (empty($_REQUEST['cmd']) or  empty($_REQUEST['acctID']) or empty($_REQUEST['progID'])){
    echo json_encode( 
        array(
            'success'=>false,
            'message'=>"Incorrect paramter",
        ));
    exit;
}


$acctID = $_REQUEST['acctID'];
$progID = $_REQUEST['progID'];
$cmd = $_REQUEST['cmd'];
$dbName = getDatabaseName($acctID,"");
if($cmd!="publish" and $cmd!="update"){
    echo json_encode( 
        array(
            'success'=>false,
            'message'=>"Unknown command [$cmd]",
        ));
    exit;
}
//Read config file
//$configs = json_decode(file_get_contents("conf/template.conf"));
$masterTemplate = couchDB_Get("/master/templates");
$blueprints = $masterTemplate->blueprints;

//Read Document
$doc = couchDB_Get("/$dbName/$progID");
if(empty($doc->_id)){
    echo json_encode( 
        array(
            'success'=>false,
            'message'=>"Document not found /$dbName/$progID",
        ));
    exit;
}
//print_r($configs);
//echo "<hr><br>";
//print_r($doc);
//echo "<hr><br>";
$campaignType = $doc->campaignType;
// find maml 
//echo($campaignType);
$templateName = "";
foreach ($blueprints as $item){
    if($item->campaignType == $campaignType){
        //echo "Found $item->campaignType $item->template";
        $templateName = $item->template;
    }
}
if($templateName == ""){
    echo json_encode( 
        array(
            'success'=>false,
            'message'=>"Template not found for campaignType [$campaignType]",
        ));
    exit;
}

$templateFileName = "maml/$templateName";
$tmaml = file_get_contents($templateFileName);

//Render and upload to S3 if necessary
$finishMAML = studio_url_render($tmaml,$acctID,$progID,$doc);
$publishFileName = "publish/".$acctID."_".$progID.".maml";
file_put_contents($publishFileName,$finishMAML);
//dump_r($finishMAML);
if($cmd == "publish"){
    $resp = publishMAML($finishMAML);
    if(!empty($resp->Result->ErrorCode)){
        echo json_encode( 
            array(
                'success'=>false,
                'message'=>"Studio return error",
                'detail'=>$resp,
                'templateFileName'=>$templateFileName,
                'maml'=>$publishFileName,
            ));
    }else{
        $dateTimeNow = date('Y/m/d H:i:s');

        $param = array(
            "status"=>"publish",
            "publishDate"=>$dateTimeNow,
        );
        // Save to document status in campaign 
        //$docCampaignList = couchDB_Update("$dbName/campaignlist","status","publish","campaigns.campaignID=$progID");
        $docCampaignList = couchDB_Update("$dbName/campaignlist",$param,"campaigns.campaignID=$progID");
        // Update document status
        
        //$docUpdate = couchDB_Update("$dbName/$progID","status","publish");
        $docUpdate = couchDB_UpdateEx("$dbName/$progID",$param);
        echo json_encode( 
            array(
                'success'=>true,
                'message'=>"Publish Done",
                'detail'=>$docCampaignList,
                'detail2'=>$docUpdate,
            ));
    }
    
}else{
    echo json_encode( 
        array(
            'success'=>true,
            'message'=>"Update Done",
        ));
}
exit;
?>
