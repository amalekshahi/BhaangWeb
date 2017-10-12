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

function checkinProgram($TEST, $userTicket, $ACCOUNTID, $ProgramID, $data){

	//$file = ROOT_DIR."checkInMAML/".$ACCOUNTID."_".$ProgramID.".maml";
	$file = "checkInMAML/".$ACCOUNTID."_".$ProgramID.".maml";
	$data = file_get_contents($file, true);


	// test change content
	//echo "data 1 : $data <br><br><br>";
	//$data = str_replace('aaaaaaaaaa', time()."&lt;br/&gt;".'aaaaaaaaaa'."&lt;br/&gt;", $data);
	//echo "data 2 : $data <br><br><br>";
	
	$byteArr = array();
	for($i = 0; $i < strlen($data); $i++) {
		$byteArr[$i] = ord($data[$i]); 
	}

	$checkinRequest   = array
	(
		
		"Credentials" => array
		(
			"Ticket" => $userTicket        
		),
		"MamlFormat" => 0,
		"CheckoutAfterCheckin" => "false",
		"Comments" => "",
		"Maml" => $byteArr
	);
	$checkinResponse = callService("programservice/CheckinProgram", $checkinRequest);
	$ErrorCode = $checkinResponse->{"Result"}->{"ErrorCode"};
	$Maml = "";
	$errorMessage = "";
	if ($ErrorCode == "") {
		$MamlArray = $checkinResponse->{"Maml"};
		
		foreach ($MamlArray as $MamlChr) {
			$Maml .= chr($MamlChr);
		}
		$success = true;
	} else {
		$errorMessage = "checkinResponse ERROR : <br> ErrorMessage -> ".$checkinResponse->{"Result"}->{"ErrorMessage"}.'<br>'.
		"ExceptionMessage : ".$checkinResponse->{"Result"}->{"ExceptionMessage"};
		$success = false;	
		
		
	}

	$result = json_encode( array('success'=>$success, 'ticket' => $userTicket, 'Maml' => $Maml, 'errorMessage' => $errorMessage));

	return $result;
}

$ticket = getTicket($ACCOUNTID, $EMAIL, $PWD, $PARTNERGUID, $PARTNERPASSWORD);



$result = checkinProgram($TEST, $ticket, $ACCOUNTID, $ProgramID, $data);

echo $result;
