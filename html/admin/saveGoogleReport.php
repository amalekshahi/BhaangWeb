<?php
date_default_timezone_set('UTC');

$formattedJson = $_GET['formattedJson'];

	
$t = date("Ymd-His",time());
$tmpName = $t.'.json';
$filename = 'import/google/'.$tmpName;

file_put_contents( $filename, $formattedJson);			

$errorMessage = "";
$success = true;

//	$filename = 'import/google/20171003-064814.json';
//	$formattedJson = file_get_contents($filename); 

$arr = (array) json_decode($formattedJson, true);
$reportArray = array();
$reportStr = '';
foreach ($arr as $k=>$v){  
	if ($k == 'rows') {
		foreach ($v as $k1=>$v1){			
			$datetime = $v1[1];

			$url = parse_url($v1[0]);
			$path = $url['path'];
			$query = $url['query'];
			
			parse_str($query, $param);
			$campaignID = $param['campaignID'];
			$contactID = $param['contactID'];
			$source = $param['source'];


			$reportArray[] = array(
				"path" => $path, 
				"campaignID" => $campaignID, 
				"contactID" => $contactID, 
				"source" => $source, 
				"datetime" => $datetime
			);
			$reportStr = $reportStr.'"'.$path.'","'.$campaignID.'","'.$contactID.'","'.$source.'","'.$datetime.'"'.PHP_EOL;
		}
	}	
}

if ($reportStr != "") {
	$reportStr = '"path","campaignID","contactID","source","datetime"'.PHP_EOL.$reportStr;
}

echo json_encode( array('success'=>$success, 'filename' => $filename, 'reportStr' => $reportStr, 'reportArray' => $reportArray, 'errorMessage' => $errorMessage));

?>


