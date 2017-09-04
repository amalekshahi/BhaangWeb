<?php
require 'vendor/autoload.php';
require 'commonUtil.php';

$MAML = file_get_contents("template.txt");
$data = json_decode(file_get_contents("template.json"));

//wPrint(json_render($MAML,$data));

class myStudioRenderPrefixHandler extends StudioRenderPrefixHandler
{
    function valueFilter($value)
    {
        return "{" . $value . "}";
    }
}

$s = new StudioRenderPrefixHandler();
$m = new myStudioRenderPrefixHandler();
wPrint(studio_render($MAML,$data,$m));

?>
