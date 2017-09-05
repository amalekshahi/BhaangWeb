<?php
/*
    backend.php
    param
    cmd = publish/update/getID
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
$mode = $_REQUEST['mode'];
$dbName = getDatabaseName($acctID,"");
//$dateTimeNow = date('Y/m/d H:i:s');
$dateTimeNow = gmdate('Y/m/d H:i:s T', time()); 
if($cmd!="publish" and $cmd!="update" and $cmd!="getID"){
    echo json_encode( 
        array(
            'success'=>false,
            'message'=>"Unknown command [$cmd]",
        ));
    exit;
}

if($cmd=="getID"){
    $publishProgramID = GetMamlProgramID($acctID,$progID);
/*    $publishReturnFileName = "publish/".$acctID."_".$progID."_return.maml";
    $publishMamlContent = file_get_contents($publishReturnFileName);
    $xml = new DOMDocument();
    $xml->loadXML($publishMamlContent);
    $xpath = new DOMXpath($xml);
    $node = $xpath->query("/Program")->item(0);
    //$programNode = $xml->getElementsByTagName('Program')->item(0);
    echo json_encode( 
        array(
            'success'=>true,
            'cmd'=>$cmd,
            'publishProgramID'=>$node->getAttribute('DbId'),       
            //'tbody'=>print_r($programNode,true),                 
            'date'=>$dateTimeNow,           
            'publishMamlContent'=>$publishMamlContent,
            //'publishProgramID'=>$programNode->getAttribute('DbId'),
        ));*/
     echo json_encode( 
        array(
            'success'=>true,
            'cmd'=>$cmd,
            'publishProgramID'=>$publishProgramID,       
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

if($mode == "junk"){
    $t = time();
    $doc->campaignName = $doc->campaignName."_".$dateTimeNow;
    $doc->campaignID = $doc->campaignID."_".$t;
    
}
$finishMAML = studio_url_render($tmaml,$acctID,$progID,$doc);
//Render and upload to S3 if necessary


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
                'mode'=>$mode,
                "publishDate"=>$dateTimeNow,
            ));
    }else{
        //convert byte array maml  and save to file
        $returnMaml = implode(array_map("chr", $resp->Maml));
        $publishReturnFileName = "publish/".$acctID."_".$progID."_return.maml";
        file_put_contents($publishReturnFileName,$returnMaml);
        
        //Get publish programID from that file 
        $publishProgramID = GetMamlProgramID($acctID,$progID);
    
        $param = array(
            "status"=>"publish",
            "publishDate"=>$dateTimeNow,
            "publishProgramID"=>$publishProgramID,
        );
        // Save to document status in campaign 
        //$docCampaignList = couchDB_Update("$dbName/campaignlist","status","publish","campaigns.campaignID=$progID");
        $docCampaignList = couchDB_Update("$dbName/campaignlist",$param,"campaigns.campaignID=$progID");
        // Update document status
        
        //$docUpdate = couchDB_Update("$dbName/$progID","status","publish");
        $docUpdate = couchDB_UpdateEx("$dbName/$progID",$param);
        
        $resp->Maml = $returnMaml;
        echo json_encode( 
            array(
                'success'=>true,
                'message'=>"Publish Done",
                'detail'=>$resp,
                'detailCampaignList'=>$docCampaignList,
                'detailDoc'=>$docUpdate,
                //'returnMaml'=>$returnMaml,
                "publishProgramID"=>$publishProgramID,
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
