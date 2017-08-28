<?php
/*
    dbUtil.php
    - cmd   update
    - path
    - field
    - value
    - where "arrayField.fieldName=asasasasasas"
    
    Ex https://web2xmm.com/admin/dbUtil.php?path=db228/campaignlist&cmd=update&field=A&value=D&where=campaigns.campaignID%3Dee1c6f578edd6806cf4d14c21cce0766&1
*/
#require '/var/www/html/vendor/autoload.php';
#require_once 'global.php';
require_once 'commonUtil.php';
$cmd = $_REQUEST['cmd'];
$path = $_REQUEST['path'];
$field = $_REQUEST['field'];
$value = $_REQUEST['value'];
$where = $_REQUEST['where'];


if(empty($cmd) || empty($path) ||empty($field) ||empty($value)){
    echo json_encode( 
        array(
            'success'=>false,
            'message'=>"Parameter not correct cmd,path,field,value",
        ));
    exit;
}

//$doc = couchDB_Update($path,$field,$value,$where);
/*$dateTimeNow = date('Y/m/d H:i:s');
$param = array(
    "status"=>"publish",
    "publishDate"=>$dateTimeNow,
);*/
$param = array(
    "$field"=>$value,
);

$doc = couchDB_UpdateEx($path,$param,$where);
echo $doc;
?>
