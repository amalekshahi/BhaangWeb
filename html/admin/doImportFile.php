<?php
date_default_timezone_set('America/Los_Angeles');
session_start();
require_once 'commonUtil.php';


$itemCount = $_GET['itemCount'];
$headerValue = $_GET['headerValue']; 	
$importName = $_GET['importName']; 	
$fileName = $_GET['uploadFileName'];
	
//$file = IMPORTPATH.'importFile/'.$fileName;
$file = 'import/importFile/'.$fileName;

$delimiter = ",";

$recordCount = "0";
	
$arr2 = explode($delimiter, $headerValue); 

for ($i = 0; $i < $itemCount; $i++) {
	$headerTemp = trim($arr2[$i]);
	
	$strTemp = trim($_GET['fieldoption'.$i]);
	
	$Mapping = $Mapping . "[" . $headerTemp . "][" . $strTemp . "];";

}
$Mapping = substr($Mapping, 0, -1);
	
$ACCOUNTID = $_SESSION['ACCOUNTID'];
$EMAIL = $_SESSION['EMAIL'];
$PWD = $_SESSION['PWD'];
$PARTNERGUID = $_SESSION['PARTNERGUID'];
$PARTNERPASSWORD = $_SESSION['PARTNERPASSWORD'];
$ACCOUNNAME = $_SESSION['ACCOUNNAME'];

$ticket = getTicket($ACCOUNTID, $EMAIL, $PWD, $PARTNERGUID, $PARTNERPASSWORD);
$errorMessage = ImportContacts($TEST, $fileName, $Mapping, $importName, $ticket, $EMAIL, $file, $recordCount, 'immportFile', $ACCOUNNAME);

if ($errorMessage == '') {
	$errorMessage = "Please check your email for the results.";
	$success = true;
} else {
	$success = false;
}


echo json_encode( array('success'=>$success, 'message' => $errorMessage));

?>


