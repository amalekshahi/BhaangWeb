<?php
date_default_timezone_set('America/Los_Angeles');
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

function UndoProgramChanges($TEST, $userTicket, $ProgramID){	
	$undoRequest   = array
	(
		
		"Credentials" => array
		(
			"Ticket" => $userTicket        
		),
		"ProgramID" => $ProgramID,
		"MamlFormat" => 0
	);
	$undoResponse = callService("programservice/UndoProgramChanges", $undoRequest);
	$ErrorCode = $undoResponse->{"Result"}->{"ErrorCode"};
	$Maml = "";
	$errorMessage = "";
	if ($ErrorCode == "") {
		$MamlArray = $undoResponse->{"Maml"};
		
		foreach ($MamlArray as $MamlChr) {
			$Maml .= chr($MamlChr);
		}
		$success = true;
	} else {
		$errorMessage = "undoResponse ERROR : <br> ErrorMessage -> ".$undoResponse->{"Result"}->{"ErrorMessage"}.'<br>'.
		"ExceptionMessage : ".$undoResponse->{"Result"}->{"ExceptionMessage"};
		$success = false;	
		
		
	}

	$result = json_encode( array('success'=>$success, 'ticket' => $userTicket, 'Maml' => $Maml, 'errorMessage' => $errorMessage));

	return $result;
}

$ticket = getTicket($ACCOUNTID, $EMAIL, $PWD, $PARTNERGUID, $PARTNERPASSWORD);

$result = UndoProgramChanges($TEST, $ticket, $ProgramID);

echo $result;
