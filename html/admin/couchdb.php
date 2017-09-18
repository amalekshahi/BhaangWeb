<?php
/*
    couchdb.php
    param
    couchdb.php/datapath
*/
require_once 'commonUtil.php';
date_default_timezone_set("UTC"); 
$pathInfo = $_SERVER['PATH_INFO']; 
$method = $_SERVER['REQUEST_METHOD'];
if($method=="GET"){
    $ret = couchDB_Get($pathInfo,true);
    echo json_encode($ret);
    exit;
}
if($method=="PUT"){
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    
    $ret = couchDB_Save($pathInfo,$request,true);
    echo json_encode($ret);
    exit;
}

echo json_encode( 
    array(
        'success'=>true,
        'pathInfo'=>$pathInfo,
        'method'=>$method,
 ));
exit;
