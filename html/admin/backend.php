<?php
/*
    backend.php
    param
    cmd = publish/update/test/copy/userinfo
    acctID = accountID
    progID = programID
    mode = test
    name = new campaignName (only for copy)
*/
require_once 'commonUtil.php';

function CleanDocument($doc)
{
    unset($doc->_rev);
    unset($doc->_id);
}

session_start();

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
$dateTimeNow = GetStringTimeStamp(); //gmdate('Y-m-d\TH:i:s\Z', time()); 
if($cmd!="publish" and $cmd!="update" and $cmd!="test" and $cmd!="copy" and $cmd!="userinfo"){
    echo json_encode( 
        array(
            'success'=>false,
            'message'=>"Unknown command [$cmd]",
        ));
    exit;
}
// GetUser Info with default
if($cmd=="userinfo"){
    $doc = couchDB_Get("/$dbName/UserInfo");
    $default = false;
    if(!empty($doc->error)){
        //not found need to return from default
        $default = true;
        $doc = couchDB_Get("/master/Default_UserInfo");
        if(!empty($doc->error)){
            echo json_encode( 
                array(
                    'success'=>false,
                    'cmd'=>$cmd,
                    'message'=>"Default_UserInfo not found",
                )
            );
            exit;
        }
        CleanDocument($doc);
    }
    echo json_encode( 
        array(
            'success'=>true,
            'cmd'=>$cmd,
            'doc'=>$doc,
            'default'=>$default,
            'dbName'=>$dbName,
        )
    );
    exit;
}
// Copy campaign
if($cmd=="copy"){
    //
    $doc = couchDB_Get("/$dbName/$progID");        
    if(empty($doc->_id)){
        echo json_encode( 
            array(
                'success'=>false,
                'cmd'=>$cmd,
                'message'=>"Document not found /$dbName/$progID",
            ));
        exit;
    }
    
    $newCampaignName = $_REQUEST['name'];
    if(empty($newCampaignName)){
        if($mode == "junk"){
            $newCampaignName = $doc->campaignName . " (COPY) " . $dateTimeNow;
        }else{
            echo json_encode( 
                array(
                    'success'=>false,
                    'cmd'=>$cmd,
                    'message'=>"param name for newCampaignName not found",
                ));
            exit; 
        }        
    }
    
    $newProgID = md5($newCampaignName);    
    // remove _rev _id
    unset($doc->_rev);
    unset($doc->_id);
    // clear status,publishProgramID,publishDate
    $doc->status = "";
    $doc->publishProgramID = "";
    $doc->publishDate = "";
    // set new campaignID campaignName
    $doc->campaignID = $newProgID;
    $doc->campaignName = $newCampaignName;
    $addRet = AddNewCampaign($dbName,$doc);
    echo json_encode( 
        array(
            'success'=>$addRet["success"],
            'cmd'=>$cmd,
            'newCampaignName'=>$newCampaignName,
            'newProgID'=>$newProgID,
            'doc'=>$doc,
            'addRet' => $addRet,
        )
    );
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
