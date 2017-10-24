<?php
require_once 'commonUtil.php';
$folder = "/".$_GET['initFolder'];		// "/Images";
$dbName = $_GET['initAccID'];     //"17124"; 

$fileArr = s3_get_asset($dbName,$folder); 

$genFileArr = array(); 
for($i=0;$i<count($fileArr);$i++){		

		$namefile = $fileArr[$i]; 
		//$nameFilePath = "https://bkktest.s3.amazonaws.com/tmp/17124/stage/Images/"; 
		//echo $AWSFormatURL."<br>"; 
		$fullnamefile = str_replace("{{fileName}}", "$namefile", $AWSFormatURL);
		$fileDetail = array("fileName"=>$fullnamefile,"friendlyName"=>$namefile); 
		array_push($genFileArr,array(
			"ID"=>"sthree".$i,
			"Name"=>$fileDetail,
			"Thumbnail"=>$fullnamefile,
			"Description"=>"This one is picture description.",
			"Type"=>"Image",
			"Size"=>"11K",
			"URI"=>$fullnamefile,
			"Dimensions"=>"99 x 71"
		)); 
		
}//end for

echo json_encode(array('success'=>true,'fileLists'=>$genFileArr));



?>