<?php
#require '/var/www/html/vendor/autoload.php';
#require_once 'global.php';
require_once 'commonUtil.php';

session_start();

$_SESSION['ACCOUNTID'] = '228';
$_SESSION['ACCOUNNAME'] = 'CampaignLauncher';
$_SESSION['EMAIL'] = 'boonsom@mindfireinc.com';
$_SESSION['PWD'] = 'Atm12345#';
$_SESSION['PARTNERGUID'] = 'CampaignLauncherAPIUser';
$_SESSION['PARTNERPASSWORD'] = '4e98af380d523688c0504e98af3=';


$MAML = file_get_contents("maml/EmailMarketing_NO_LandingPage.TMAML-v5.maml");
$requestBlueprint = "PromoteBlog";

//$default = json_decode(file_get_contents("conf/".$requestBlueprint.".conf"),true);
$default = couchDB_Get("/master/Default_".$requestBlueprint,true);
//$MAML = $MAML . "{{RECURSIVE}} ";
//$json_str = file_get_contents("template.json");
//$data2 = json_decode($json_str);

//print_r($default );


//$data = couchDB_Get("/johnsample/88c3e7bba77a0ac58645d9635244b561");
$data = couchDB_Get("/johnsample/b134806d66b1bbf47e2b863815ff0324");

$data ->{'TEXT-AREA-ACCTID-PROGRAMID-EMAIL1CONTENT'} = file_get_contents("templates/emails/PLAIN-EMAIL.html");
$data ->{'EMAIL1-TOP-TEXT'} = "This is Email TOP Text";
// check default value

MergeStdClassWithArray($data,$default);
/*foreach($default as $key => $value){
    if(property_exists ( $data , $key )){
    }else{
        $data ->{$key} = $value;
    }
}*/
//print_r($data);



//$data->RECURSIVE = "RECURSIVE [{{RECURSIVE2}}] VALUE";
//$data->RECURSIVE2 = "RECURSIVE2 VALUE";
//wPrint("\n-----------------------------\n");
//var_dump($data);
//print_r($data);
//print_r($_SESSION);
//wPrint("\n-----------------------------\n");
//$userTicket = getStudioTicket();
//print_r($userTicket);
//wPrint("\n-----------------------------\n");
/*$doc = json_decode($data);
wPrint("\n-----------------------------\n");
var_dump($doc);
wPrint("\n-----------------------------\n");
print_r(convertToObject($data));
wPrint("\n-----------------------------\n");
wPrint(json_encode($data));
wPrint("\n-----------------------------\n");
print_r(json_decode(json_encode($data),FALSE));*/
//$data = json_decode(json_encode($data));
//wPrint($json_str);

//wPrint(json_encode($data) . "\n");
//wPrint(json_render($MAML,$data));

//wPrint($json_str);
//var_dump($data);
/*class myStudioRenderPrefixHandler extends StudioRenderPrefixHandler
{
    function valueFilter($value)
    {
        return "KKK" . $value;
    }
}
*/
//$s = new StudioRenderPrefixHandler();
//$m = new myStudioRenderPrefixHandler();

$finishMAML = studio_url_render($MAML,"accountID","programID",$data);
wPrint($finishMAML);

/*
$resp = publishMAML($finishMAML);
if(empty($resp->Result->ErrorCode)){
    wPrint("PublicSuccess");
}else{
    print_r($resp->Result);
}
*/
//print_r($resp);
/*
create_tmaml(
    "maml/Email Marketing with Landing Page Program Variables.maml",
    "maml/Email Marketing with Landing Page Program Variables.map",
    "maml/Email Marketing with Landing Page Program Variables.tmaml"
);
*/
?>
