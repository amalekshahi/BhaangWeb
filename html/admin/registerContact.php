<?php
date_default_timezone_set('UTC');
session_start();
require_once 'commonUtil.php';

$callback = $_GET['callback'];
$firstname = $_GET['firstname'];
$lastname = $_GET['lastname']; 	
$email = $_GET['email']; 	
$TEST = $_GET['test'];


$ACCOUNTID = $_SESSION['ACCOUNTID'];
$EMAIL = $_SESSION['EMAIL'];
$PWD = $_SESSION['PWD'];
$PARTNERGUID = $_SESSION['PARTNERGUID'];
$PARTNERPASSWORD = $_SESSION['PARTNERPASSWORD'];
$ACCOUNNAME = $_SESSION['ACCOUNNAME'];

$userTicket = getTicket($ACCOUNTID, $EMAIL, $PWD, $PARTNERGUID, $PARTNERPASSWORD);
	
$addContact  = array // The new Contact array; I grabbed this from Dustin's email
 		(
			"Credentials" => array
			(
				"Ticket" => $userTicket
			), 
			"KeyValueList" => array(
				array("Key" => "firstname", "Value" => $firstname),
				array("Key" => "lastname", "Value" => $lastname),
				array("Key" => "email", "Value" => $email),
				array("Key" => "isseed", "Value" => 'True')							
			)
		);


$newContact = callService("contactservice/CreateContact", $addContact);


$ErrorCode = $newContact->{"Result"}->{"ErrorCode"};
$errorMessage = "";
$purl = "";

if ($ErrorCode == "") {
	$purl=$newContact->{'Purl'}; // The Contact's newly issued PURL	
	$errorMessage = "$firstname $lastname was added.  Let's do another!";
	$success = true;
	
} else {
	$errorMessage = $newContact->{"Result"}->{"ExceptionMessage"};	
	$success = false;
}

echo json_encode( array('success'=>$success, 'message' => $errorMessage, 'purl' => $purl));



?>


