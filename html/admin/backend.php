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
date_default_timezone_set("UTC"); 

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
$execTime = array();
$start_time = microtime(true);


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
    $bluePrint = $doc->campaignType;
    $default = couchDB_Get("/master/Default_".$bluePrint);
    
    $newProgID = md5($newCampaignName);    
    // remove _rev _id
    unset($doc->_rev);
    unset($doc->_id);
    // clear status,publishProgramID,publishDate
    $doc->status = "";
    $doc->publishProgramID = "";
    $doc->publishDate = "";
    // copy schedule audience - schedule from default
    $clearToDefault = array();
    foreach ($doc as $key => $value) {
        //echo "$key => $value\n";
        $mret1 = preg_match("#^EMAIL-FILTER(.*)$#i", $key);
        $mret2 = preg_match("#^EMAIL[0-9]+-WAIT(.*)$#i", $key);
        $mret3 = preg_match("#^EMAIL[0-9]+-SCHEDULE[0-9]+(.*)$#i", $key);
        $mret4 = preg_match("#^EMAIL[0-9]+-FILTER(.*)$#i", $key);       
        $mret5 = preg_match("#^filterSelected(.*)$#i", $key);       
        if($mret1 + $mret2 + $mret3 + $mret4 + $mret5!=0){
            //if(property_exists($default,$key)){
                $clearToDefault[] = $key;            
                $doc->$key = $default->$key;
            //}
        }
    }
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
            'default'=>$default,
            //'addRet' => $addRet,
            'clearToDefault'=>$clearToDefault,
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
$execTime['GetTemplate'] = microtime(true) - $start_time;$start_time = microtime(true);
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
$execTime['Read Document'] = microtime(true) - $start_time;$start_time = microtime(true);
//print_r($configs);
//echo "<hr><br>";
//print_r($doc);
//echo "<hr><br>";
$campaignType = $doc->campaignType;
// find maml 
//echo($campaignType);
$templateName = "";
$mamlInfoName = "";
foreach ($blueprints as $item){
    if($item->campaignType == $campaignType){
        //echo "Found $item->campaignType $item->template";
        $templateName = $item->template;
        $mamlInfoName = $item->mamlInfo;
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

/*if($mode == "junk"){
    if(empty($mamlInfoName)){
        $mamlInfoName = "PromoteBlog.json";
    }
}*/
if(empty($mamlInfoName)){
    $mamlInfoName = "PromoteBlog.json";
}

$mamlInfoFileName = "maml/$mamlInfoName";
$mamlInfo = json_decode(file_get_contents($mamlInfoFileName));
if(json_last_error() != JSON_ERROR_NONE){
    echo json_encode( 
        array(
            'success'=>false,
            'cmd'=>$cmd,
            'mamlInfoFileName'=>$mamlInfoFileName,
            'message'=>'Json Error '.json_last_error_msg(),
        ));
    exit;
}

$tmaml = file_get_contents($templateFileName);
$execTime['GetTemplateMAML'] = microtime(true) - $start_time;$start_time = microtime(true);
if($mode == "junk"){
    $t = time();
    $doc->campaignName = $doc->campaignName."_".$dateTimeNow;
    $doc->campaignID = $doc->campaignID."_".$t;
    
}
if($mode == "mamlInfo"){
    /*$mamlInfo = json_decode(file_get_contents($mamlInfoFileName));
    if(json_last_error() != JSON_ERROR_NONE){
        echo json_encode( 
            array(
                'success'=>false,
                'cmd'=>$cmd,
                'mamlInfoFileName'=>$mamlInfoFileName,
                'message'=>'Json Error '.json_last_error_msg(),
            ));
        exit;
    }*/
    $ret = RenderByMamlInfo($mamlInfo,$tmaml,$acctID,$progID,$doc);
    echo json_encode($ret);
    exit;
}
$renderMode = "studio_url_render";
if(!empty($doc->publishProgramID)){
    $cmd = "update";
}else{
    $cmd = "publish";
}
//dump_r($finishMAML);
if($cmd == "publish"){
    // check if we have $mamlInfoName
    if(!empty($mamlInfoName)){
        $renderMode = "RenderByMamlInfo ".$mamlInfoFileName;
        $RenderByMamlInfoRet = RenderByMamlInfo($mamlInfo,$tmaml,$acctID,$progID,$doc);
        $finishMAML = $RenderByMamlInfoRet['xml'];
        $updateMAML = $finishMAML;
    }else{
        $studio_url_render_ret = studio_url_render2($tmaml,$acctID,$progID,$doc);
        $finishMAML = $studio_url_render_ret['template'];
        $xml = new DOMDocument();
        $xml->loadXML($finishMAML);
        $updateResult = UpdateMAML($xml,$doc,$campaignType);
        $updateMAML = $updateResult["Maml"];
    }
    
    $execTime['StudioRender'] = microtime(true) - $start_time;$start_time = microtime(true);

    //Save Publish file to debug
    $publishFileName = "publish/".$acctID."_".$progID.".maml";
    file_put_contents($publishFileName,$finishMAML);
    $execTime['header'] = microtime(true) - $start_time;$start_time = microtime(true);

    $resp = publishMAML($updateMAML);
    //$resp = publishMAML($finishMAML);
    if(!empty($resp->Result->ErrorCode)){
        echo json_encode( 
            array(
                'success'=>false,
                'cmd'=>$cmd,
                'message'=>"Studio return error",
                'RenderByMamlInfoRet'=>$RenderByMamlInfoRet,
                'mamlInfo'=>$mamlInfo,
                //'finishMAML'=>$finishMAML,
                "renderMode"=>$renderMode,                
                'detail'=>$resp,
                'templateFileName'=>$templateFileName,
                'maml'=>$publishFileName,
                'mode'=>$mode,
                "publishDate"=>$dateTimeNow,
                "updateMAML"=>$updateMAML,
            ));
        exit;
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
                'cmd'=>$cmd,
                'message'=>"Publish Done",
                "renderMode"=>$renderMode,                
                'detail'=>$resp,
                'detailCampaignList'=>$docCampaignList,
                'detailDoc'=>$docUpdate,
                "publishProgramID"=>$publishProgramID,
                "updateMAML"=>"$updateMAML",
            ));
        exit;
    }
    
}else{
    
    $ticket = GetTicketBySession();
    $execTime['GetTicketBySession'] = microtime(true) - $start_time;$start_time = microtime(true);
    $publishProgramID = $doc->publishProgramID; 
    if(empty($publishProgramID)){
        echo json_encode( 
            array(
                'success'=>false,
                'cmd'=>$cmd,
                'message'=>"Publish Program ID Not found ",
                'time'=>$execTime,
                'publishProgramID'=>$publishProgramID,
                'ticket'=>$ticket,            
                'doc'=>$doc,
        ));
        exit;      
    }
    $execTime['GetPublishedMAM'] = microtime(true) - $start_time;$start_time = microtime(true);
    $checkOutRet = checkoutProgram($ticket, $acctID, $publishProgramID);	
    $execTime['checkoutProgram'] = microtime(true) - $start_time;$start_time = microtime(true);
    
    // Make sure check out success
    
    if(!$checkOutRet['success']){
        $undoRet = UndoProgramChanges($ticket, $publishProgramID);	
        $checkOutRet = checkoutProgram($ticket, $acctID, $publishProgramID);	
    }
    $execTime['checkoutProgram2'] = microtime(true) - $start_time;$start_time = microtime(true);
    
    if(!$checkOutRet['success']){
        // something wrong
        echo json_encode( 
            array(
                'success'=>false,
                'cmd'=>$cmd,
                'message'=>$checkOutRet['errorMessage'],
                'time'=>$execTime,
                'mode'=>"DEBUG",
                'publishProgramID'=>$publishProgramID,
                'ticket'=>$ticket,            
                'checkOutRet'=>$checkOutRet,
                //'publishMAML'=>$publishMAML,
                'checkOutMAML'=>$checkOutMAML,
        ));
        exit;        
    }
    $checkOutMAML = $checkOutRet['Maml'];

    if(!empty($mamlInfoName)){
        $renderMode = "RenderByMamlInfo ".$mamlInfoFileName;
        $updateResult = RenderByMamlInfo($mamlInfo,$checkOutMAML,$acctID,$progID,$doc);
        $updateMAML = $updateResult['xml'];
    }else{
        // Just render to update s3 content
        $studio_url_render_ret = studio_url_render2($tmaml,$acctID,$progID,$doc);
        //$finishMAML = $studio_url_render_ret['template'];
        // Do some work here
        $xml = new DOMDocument();
        $xml->loadXML($checkOutMAML);
        $updateResult = UpdateMAML($xml,$doc,$campaignType);
        $updateMAML = $updateResult["Maml"];
    }
    //$execTime['StudioRender'] = microtime(true) - $start_time;$start_time = microtime(true);    
    
    $execTime['UpdateMAML'] = microtime(true) - $start_time;$start_time = microtime(true);
    // Check if we publish before and has the same content
    $republishReturnFileName = "publish/".$acctID."_".$progID."_republish.maml";
    $prevPublish = file_get_contents($republishReturnFileName);
    // remove checkoutID
    $prevPublish = preg_replace('/CheckOutId="[0-9]+"/','', $prevPublish);
    $currentPublish = preg_replace('/CheckOutId="[0-9]+"/','', $updateMAML);
    if($currentPublish == $prevPublish){
        $undoRet = UndoProgramChanges($ticket, $publishProgramID);	
        echo json_encode( 
            array(
                'success'=>true,
                'cmd'=>$cmd,
                'time'=> $execTime,
                'renderMode'=>$renderMode,
                'message'=>"Update Done (not need to publish)",
                'publishProgramID'=>$publishProgramID,
                'ticket'=>$ticket,            
                'updateResult'=>$updateResult,
                'undoRet'=>$undoRet,
                
        ));
        exit;   
    }
    file_put_contents("publish/".$acctID."_".$progID."prev_republish.maml",$prevPublish);
    // save file for debug
    file_put_contents($republishReturnFileName,$updateMAML);
    //CheckIn    
    $checkInRet = checkinProgram($ticket,$updateMAML);
    $execTime['checkinProgram'] = microtime(true) - $start_time;$start_time = microtime(true);
    /*echo json_encode( 
        array(
            'mode'=>"DEBUG",
            'publishProgramID'=>$publishProgramID,
            'ticket'=>$ticket,            
            //'checkOutMAML'=>$checkOutMAML,
            //'checkOutRet'=>$checkOutRet,
            //'checkInRet'=>$checkInRet,
            //'undoRet'=>$undoRet,
            'updateResult'=>$updateResult,
            'campaignType'=>$campaignType,
    ));
    exit;*/
    
    if($checkInRet['success']){
        echo json_encode( 
            array(
                'success'=>true,
                'cmd'=>$cmd,
                'time'=> $execTime,
                'renderMode'=>$renderMode,
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
                'cmd'=>$cmd,
                'time'=> $execTime,
                'renderMode'=>$renderMode,
                'message'=>"Update fail",
                'publishProgramID'=>$publishProgramID,
                'ticket'=>$ticket,            
                'checkOutMAML'=>$checkOutMAML,
                'checkOutRet'=>$checkOutRet,
                'checkInRet'=>$checkInRet,
                'undoRet'=>$undoRet,
                'updateResult'=>$updateResult,
                'updateMAML'=>$updateMAML,
            ));
    }
}
exit;
?>
