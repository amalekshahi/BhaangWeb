<?php
require_once 'commonUtil.php';

$mainFolder = $_GET['mainFolder'];		// "Images" 
$dbName = $_GET['initAccID'];     //"17124"; 
$folderName = $_GET['folderName']; 

$resultURL = s3_createFolder_asset($dbName,$mainFolder,$folderName); 
if($resultURL != "" ){
	//echo "*****result = true[". $resultURL ."] ****"; 
	$result = array(
		'success'=>true,	
		'resultURL'=>$resultURL,	
		'dbName'=>$dbName,
		'mainFolder'=>$mainFolder,
	); 
	echo json_encode($result); 
}else{
	echo json_encode( array('success'=>false));
}

?>