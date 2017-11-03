<?php
require_once 'commonUtil.php';
$folder = "/".$_GET['initFolder'];		// "/Images";
$dbName = $_GET['initAccID'];     //"17124"; 

//echo "start"; 

$fileArrs = s3_get_asset($dbName,$folder); 

//echo "<br><br> fileArrs = " . $fileArrs. "<br>"; 

$genFileArr = array(); 
$i = 0; 	
foreach ($fileArrs as $fileArr) {	
		//echo  "fileArr = " . $fileArr["fname"] . "<br>"; 
		
		$namefile = $fileArr["fname"]  ; 
		$namepath = $fileArr["fpath"]  ;  // >>  tmp/17124/stage/Images/
		$nameFilePath = $namepath . $namefile; 		
		
		//echo $nameFilePath."<br>"; 

		$fullnamefile = str_replace("{{fileName}}", "$nameFilePath", $AWSFormatURL);

		$fileDetail = array("fileName"=>$fullnamefile,"friendlyName"=>$namefile); 
		array_push($genFileArr,array(
			"ID"=>"s3".$i,
			"Name"=>$fileDetail,
			"Thumbnail"=>$fullnamefile,
			"Description"=>"This one is picture description.",
			"Type"=>"Image",
			"Size"=>$fileArr["fsize"],
			"URI"=>$fullnamefile,
			"fpath"=>$nameFilePath,
			"fname"=>$namefile,
			"Dimensions"=>"99 x 71"
		)); 
		$i++;
}//end for

echo json_encode(array('success'=>true,'fileLists'=>$genFileArr));



?>