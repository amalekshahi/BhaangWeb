<?php
/*
    backend.php
    param
    cmd = publish/update/test/
    acctID = accountID
    progID = programID
    mode = test
*/
require_once 'commonUtil.php';

session_start();

function UpdateMAMLSchedule($xml,$doc)
{
    $xpath = new DOMXpath($xml);
    // scan for at most 10 email
    $ret = array();
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
    }
    return array(
        "Maml"=> $xml->saveHTML(),
        "UpdateDetail" => $ret,
    );
}

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
if($cmd!="publish" and $cmd!="update" and $cmd!="test"){
    echo json_encode( 
        array(
            'success'=>false,
            'message'=>"Unknown command [$cmd]",
        ));
    exit;
}

if($cmd=="test"){
    $doc = couchDB_Get("/$dbName/$progID");
    
    $publishProgramID = GetMamlProgramID($acctID,$progID);
    $mamlName = "checkInMAML/".$acctID."_".$publishProgramID.".maml";
    $publishMamlContent = file_get_contents($mamlName);
    $xml = new DOMDocument();
    $xml->loadXML($publishMamlContent);
/*    $xpath = new DOMXpath($xml);
    $node = $xpath->query("//Schedule/Subject[starts-with(text(),'Email')]")->item(0);
    $scheduleNode  = $node->parentNode;
    $startNode = $scheduleNode->getElementsByTagName("Start")->item(0);
    $subject = $node->nodeValue;
    $setDateTime = date('Y/m/d H:i:s');
    $startNode->setAttribute("DateTime",$setDateTime);
    $scheduleNode->setAttribute("TimeZone","Pacific Standard Time");*/
    //$programNode = $xml->getElementsByTagName('Program')->item(0);
    $emailList = UpdateMAMLSchedule($xml,$doc);
    echo json_encode( 
        array(
            'success'=>true,
            'cmd'=>$cmd,
            'publishProgramID'=>$publishProgramID,  
            //'scheduleNode'=>$xml->saveHTML($scheduleNode),
            //'startNode'=>$xml->saveHTML($startNode),
            'emailList'=>$emailList,
            //'publishMamlContent'=>$publishMamlContent,
            
            //'node'=>print_r($node,true),
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
    $ticket = GetTicketBySession();
    // Update Republish mode
    $publishProgramID = GetMamlProgramID($acctID,$progID);
    $publishMAML = GetPublishedMAML($acctID,$progID);
    $checkOutRet = checkoutProgram($ticket, $acctID, $publishProgramID);	
    // Make sure check out success
    if(!$checkOutRet['success']){
        $undoRet = UndoProgramChanges($ticket, $publishProgramID);	
        $checkOutRet = checkoutProgram($ticket, $acctID, $publishProgramID);	
    }
    $checkOutMAML = $checkOutRet['Maml'];
    // Do some work here
    $xml = new DOMDocument();
    $xml->loadXML($checkOutMAML);
    $updateResult = UpdateMAMLSchedule($xml,$doc);
    $updateMAML = $updateResult["Maml"];
    //CheckIn
    $checkInRet = checkinProgram($ticket,$updateMAML);
    if($checkInRet['success']){
        echo json_encode( 
            array(
                'success'=>true,
                'message'=>"Update Done",
                'publishProgramID'=>$publishProgramID,
                'ticket'=>$ticket,            
                //'checkOutMAML'=>$checkOutMAML,
                //'checkOutRet'=>$checkOutRet,
                'checkInRet'=>$checkInRet,
                //'undoRet'=>$undoRet,
                'updateResult'=>$updateResult,
            ));
    }else{
        echo json_encode( 
            array(
                'success'=>false,
                'message'=>"Update fail",
                'publishProgramID'=>$publishProgramID,
                'ticket'=>$ticket,            
                'checkOutMAML'=>$checkOutMAML,
                'checkOutRet'=>$checkOutRet,
                'checkInRet'=>$checkInRet,
                'undoRet'=>$undoRet,
                'updateResult'=>$updateResult,
            ));
    }
}
exit;
?>
