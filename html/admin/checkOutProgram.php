<?php
date_default_timezone_set('UTC');
session_start();
require_once 'commonUtil.php';

$ProgramID = $_GET['ProgramID'];
$TEST = $_GET['test'];

$ACCOUNTID = $_SESSION['ACCOUNTID'];
$EMAIL = $_SESSION['EMAIL'];
$PWD = $_SESSION['PWD'];
$PARTNERGUID = $_SESSION['PARTNERGUID'];
$PARTNERPASSWORD = $_SESSION['PARTNERPASSWORD'];
$ACCOUNNAME = $_SESSION['ACCOUNNAME'];



if ($TEST == 't') {
	echo "ProgramID : $ProgramID<br>";
}

function checkoutProgram($TEST, $userTicket, $ACCOUNTID, $ProgramID){	
	$checkoutRequest   = array
	(
		
		"Credentials" => array
		(
			"Ticket" => $userTicket        
		),
		"ProgramID" => $ProgramID,
		"MamlFormat" => 0
	);
	$checkoutResponse = callService("programservice/CheckoutProgram", $checkoutRequest);
	$ErrorCode = $checkoutResponse->{"Result"}->{"ErrorCode"};
	$Maml = "";
	$errorMessage = "";
	if ($ErrorCode == "") {
		$MamlArray = $checkoutResponse->{"Maml"};
		
		foreach ($MamlArray as $MamlChr) {
			$Maml .= chr($MamlChr);
		}
		//$file = ROOT_DIR."checkInMAML/".$ACCOUNTID."_".$ProgramID.".maml";
		$file = "checkInMAML/".$ACCOUNTID."_".$ProgramID.".maml";
		file_put_contents( $file, $Maml );			
		$success = true;
	} else {
		$errorMessage = "checkoutResponse ERROR : <br> ErrorMessage -> ".$checkoutResponse->{"Result"}->{"ErrorMessage"}.'<br>'.
		"ExceptionMessage : ".$checkoutResponse->{"Result"}->{"ExceptionMessage"};
		$success = false;	
		
		
	}

	$result = json_encode( array('success'=>$success, 'ticket' => $userTicket, 'Maml' => $Maml, 'errorMessage' => $errorMessage));

	return $result;
}

$ticket = getTicket($ACCOUNTID, $EMAIL, $PWD, $PARTNERGUID, $PARTNERPASSWORD);

$result = checkoutProgram($TEST, $ticket, $ACCOUNTID, $ProgramID);

echo $result;
