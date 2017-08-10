<?php
require_once 'commonUtil.php';

function getVariables($data)
{
    preg_match_all('/\{{(.*?)\}}/', $data, $matches, PREG_PATTERN_ORDER);
    $aValue0 = $matches[0];
    $aValue1 = $matches[1];
    // somehow unique_array not work using hash instead.
    $hash = array();
    $ret = array();
    for($i = 0;$i<count($aValue0);$i++){
        $value0 = $aValue0[$i];
        $value1 = $aValue1[$i];
        if(array_key_exists($value0,$hash)){
        }else{
            array_push($ret,$value1);
        }
    }
    return $ret;
}

$tmaml = file_get_contents("maml/EmailMarketing_NO_LandingPage.TAML-v2.maml");
$vars = getVariables($tmaml);
$textLineTemplate = file_get_contents("conf/text-line.html");
$textAreadTemplate = file_get_contents("conf/text-area.html");
$imageTemplate = file_get_contents("conf/image.html");
$data = "";
foreach($vars as $var){
    if(!ctype_lower(substr($var,0,1))){
        if(startsWith($var,"URL ")){
            $var = substr($var,4);
        }
        $template = "{{var}}";
        $aSplit = split("-",$var);
        $varName = $aSplit[count($aSplit)-1];
        //dump_r($var);        
        if(startsWith($var,"TEXT-LINE")){
            $template = file_get_contents("conf/TEXT-LINE.html");
            
        }
        if(startsWith($var,"TEXT-AREA")){
            $template = file_get_contents("conf/TEXT-AREA.html");
        }
        if(startsWith($var,"IMAGE")){
            $template = file_get_contents("conf/IMAGE.html");
        }
        $line = str_replace("{{var}}",$var,$template);
        $line = str_replace("{{varName}}",$varName,$line);
        $data = $data . $line;
    }
}

$textLineTemplate = file_get_contents("conf/form.html");
$output = str_replace("{{data}}",$data,$textLineTemplate);
echo $output;

/*
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
                'detail'=>$resp,
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
*/
?>
