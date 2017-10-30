<?php
require_once 'commonUtil.php';

//$pathFileName = tmp/17124/stage/Images/filename.xxx
$pathFileName = $_GET['initPathFileName'];		
$dbName = $_GET['initAccID'];     //"17124"; 

//echo "<br>path = $pathFileName<br>"; 

$resultDelete = s3_delete_asset($dbName,$pathFileName); 
if($resultDelete){
	$result1 = s3_exists($pathFileName); 
}
if($result1){
        echo json_encode( array('success'=>false));
}else{
	$result = array(
		'success'=>true,	
		'dbName'=>$dbName,
		'pathFileName'=>$pathFileName,
	); 
	echo json_encode($result); 
}

?>