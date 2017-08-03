<?php
require 'vendor/autoload.php';
require 'commonUtil.php';
/*
    doc.php 
    - retrive json property from local couchDB database
    query strning:
    - path couchDB doucment path
        Ex path=/database/documentname/jsonAddress

*/

ini_set('display_errors', 1);
error_reporting(E_ALL);
$path = ($_REQUEST['path']);
if($path == ""){
    echo "Need Path";
    exit;
}
#echo "path = [" . $path . "]<br>";
$paths = explode("/",$path); 
#print_r($paths);
#echo "<br>";
if(count($paths) < 2){
    echo "Path < 2";
    exit;
}
# create Json notation
$jsonPath = "";
for($i=2;$i<count($paths);$i++){
    if($i>2){
        $jsonPath += ".";
    }
    $jsonPath .= $paths[$i];
}

$doc = couchDB_Get($paths[0] . '/' . $paths[1]);
$template = "{{" . $jsonPath . "}}";
echo json_render($template,$doc);
echo "<br>";
$obj = array(
    "field-1" => "value1",
    "array-1" => array("1","2","3"),
    "array-2" => array(
        array(
            "field-1" => "value1",
            "field-2" => "value2",
        ),
        array(
            "field-1" => "value1",
            "field-2" => "value2",
        ),
    ),
    "field-2" => array(
        "sub1" => array(
            "field-1" => "value1",
            "field-2" => "value2",
        ),
    ),
);

//var_dump(get_object_vars($obj));

?>