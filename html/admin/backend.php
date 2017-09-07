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

function UpdateMAML($xml,$doc)
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
        
        //OPEN-MY-EMAIL "OpenAlertLeadTrigger
        //$OpenAlertLeadTrigger = $xpath->query("//CampaignElement[@Name='OpenAlertLeadTrigger']")->item(0);
    }
    $OpenAlertLeadTrigger = DomSetAttribute($xpath,"//CampaignElement[@Name='OpenAlertLeadTrigger']","State",$doc->{'OPEN-MY-EMAIL'});
    $ClickAlertLeadTrigger = DomSetAttribute($xpath,"//CampaignElement[@Name='ClickAlertLeadTrigger']","State",$doc->{'VISIT-MY-BLOCK'});
    
    return array(
        "ContactUpdate" => $contactRet,
        "Maml"=> $xml->saveHTML(),
        "EmailUpdate" => $ret,
        "OpenAlertLeadTrigger" => $xml->saveHTML($OpenAlertLeadTrigger),
        "ClickAlertLeadTrigger" => $xml->saveHTML($ClickAlertLeadTrigger),
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
$dateTimeNow = gmdate('Y-m-d\TH:i:s\Z', time()); 
if($cmd!="publish" and $cmd!="update" and $cmd!="test"){
    echo json_encode( 
        array(
            'success'=>false,
            'message'=>"Unknown command [$cmd]",
        ));
    exit;
}

if($cmd=="test"){
    $doc = couchDB_Get("/$dbName/campaignlist",true);
    $ret = array();
    for($i=0;$i<count($doc['campaigns']);$i++){
        $lastEditDate =  $doc['campaigns'][$i]['lastEditDate'];
        $t = strtotime($lastEditDate);
        $doc['campaigns'][$i]['lastEditDate'] = gmdate('Y-m-d\TH:i:s\Z', $t); 
        $ret[] = $lastEditDate . "->" . $doc['campaigns'][$i]['lastEditDate'];       
    }
    $saveRet = couchDB_Save("/$dbName/campaignlist",$doc);
    echo json_encode( 
        array(
            'success'=>true,
            'cmd'=>$cmd,
            'publishProgramID'=>$publishProgramID,  
            //'scheduleNode'=>$xml->saveHTML($scheduleNode),
            //'startNode'=>$xml->saveHTML($startNode),
            'emailList'=>$emailList,
            'doc'=>$doc,
            'ret'=>$ret,
            'saveRet'=>$saveRet,
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
    $updateResult = UpdateMAML($xml,$doc);
    $updateMAML = $updateResult["Maml"];

    // save file for debug
    $republishReturnFileName = "publish/".$acctID."_".$progID."_republish.maml";
    file_put_contents($republishReturnFileName,$updateMAML);
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
