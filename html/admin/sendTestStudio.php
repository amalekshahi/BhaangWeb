<?php
date_default_timezone_set('America/Los_Angeles');
session_start();
require_once 'commonUtil.php';

$TEST = $_GET['test'];
$ContactID = $_REQUEST['ContactID'];
$HtmlContent = $_REQUEST['HtmlContent'];
$subject = $_REQUEST['subject'];
$FromName = $_REQUEST['FromName'];
$FromAddress = $_REQUEST['FromAddress'];

$ACCOUNTID = $_SESSION['ACCOUNTID'];
$EMAIL = $_SESSION['EMAIL'];
$PWD = $_SESSION['PWD'];
$PARTNERGUID = $_SESSION['PARTNERGUID'];
$PARTNERPASSWORD = $_SESSION['PARTNERPASSWORD'];
$ACCOUNNAME = $_SESSION['ACCOUNNAME'];

// encode html
$htmlContent = htmlspecialchars($HtmlContent, ENT_XML1);



$subjectContent = htmlspecialchars($subject);
//$ContactID = "75";
$PropertiesXML = "<Properties>  <Messages>    <Message Id=\"1\">      <ToAddress>##email##</ToAddress>      <FromName>$FromName</FromName>      <FromAddress>$FromAddress</FromAddress>      <ReplyTo>$FromAddress</ReplyTo>      <Subject>$subjectContent</Subject>      <HtmlContent>$htmlContent</HtmlContent>      <TextContent />    </Message>  </Messages></Properties>";

file_put_contents('xxx001.txt',$PropertiesXML);

function sendTest($TEST, $userTicket, $ContactID, $PropertiesXML){
	$errorMessage = '';
	

	$SendAppTestRequest   = array
	(
		
		"Credentials" => array
		(
			"Ticket" => $userTicket        
		),
	
		"ContactID" => $ContactID,
		"PropertiesXML" => $PropertiesXML,
		"ServiceTypeID" => 201
	);
	$SendAppTestResponse = callService("programservice/SendAppTest", $SendAppTestRequest);
	$ErrorCode = $SendAppTestResponse->{"Result"}->{"ErrorCode"};
	if ($ErrorCode == "") {
		$success = true;
	} else {
		$errorMessage = "SendAppTestResponse ERROR : <br> ErrorMessage -> ".$SendAppTestResponse->{"Result"}->{"ErrorMessage"}.'<br>'.
		"ExceptionMessage : ".$SendAppTestResponse->{"Result"}->{"ExceptionMessage"};
		//$errorMessage = "ImportResponse ERROR : <br> ErrorMessage -> ".$ImportResponse->{"Result"}->{"ErrorMessage"};
		//echo $errorMessage."<BR>";

		$success = false;
	}

	$result = json_encode( array(
		'success'=>$success, 
		'ticket' => $userTicket, 
		'ContactID' => $ContactID, 
		'PropertiesXML' => $PropertiesXML, 
		'errorMessage' => $errorMessage
	));

	return $result;

}

$userTicket = getTicket($ACCOUNTID, $EMAIL, $PWD, $PARTNERGUID, $PARTNERPASSWORD);
$result = sendTest($TEST, $userTicket, $ContactID, $PropertiesXML);

echo $result;
