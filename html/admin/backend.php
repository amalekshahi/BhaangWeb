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

if($cmd!="publish" and $cmd!="update"){
    echo json_encode( 
        array(
            'success'=>false,
            'message'=>"Unknown command [$cmd]",
        ));
    exit;
}
//Read config file
$configs = json_decode(file_get_contents("conf/template.conf"));
//Read Document
$doc = couchDB_Get("/$acctID/$progID");
if(empty($doc->_id)){
    echo json_encode( 
        array(
            'success'=>false,
            'message'=>"Document not found /$acctID/$progID",
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
foreach ($configs as $item){
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
//dump_r($finishMAML);
if($cmd == "publish"){
    $resp = publishMAML($finishMAML);
    if(!empty($resp->Result->ErrorCode)){
        echo json_encode( 
            array(
                'success'=>false,
                'message'=>"Studio return error",
                'detail'=>$resp,
            ));
    }else{
        echo json_encode( 
            array(
                'success'=>true,
                'message'=>"Publish Done",
                //'detail'=>$resp,
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
