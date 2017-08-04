<?php
#require '/var/www/html/vendor/autoload.php';
#require_once 'global.php';
require_once 'commonUtil.php';

$MAML = file_get_contents("maml/Email Marketing with Landing Page Program Variables.tmaml");
$json_str = file_get_contents("template.json");
$data = json_decode($json_str);
//wPrint(json_encode($data) . "\n");
//wPrint(json_render($MAML,$data));

//wPrint($json_str);
//var_dump($data);
class myStudioRenderPrefixHandler extends StudioRenderPrefixHandler
{
    function valueFilter($value)
    {
        return "KKK" . $value;
    }
}

$s = new StudioRenderPrefixHandler();
$m = new myStudioRenderPrefixHandler();
//wPrint(studio_render($MAML,$data,$m));
wPrint(studio_url_render($MAML,"accountID","programID",$data));
/*
create_tmaml(
    "maml/Email Marketing with Landing Page Program Variables.maml",
    "maml/Email Marketing with Landing Page Program Variables.map",
    "maml/Email Marketing with Landing Page Program Variables.tmaml"
);
*/
?>
