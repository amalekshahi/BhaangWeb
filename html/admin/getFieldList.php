<?php
date_default_timezone_set('America/Los_Angeles');
session_start();
require_once 'commonUtil.php';


$ACCOUNTID = $_SESSION['ACCOUNTID'];
$EMAIL = $_SESSION['EMAIL'];
$PWD = $_SESSION['PWD'];
$PARTNERGUID = $_SESSION['PARTNERGUID'];
$PARTNERPASSWORD = $_SESSION['PARTNERPASSWORD'];
$ACCOUNNAME = $_SESSION['ACCOUNNAME'];

$ticket = getTicket($ACCOUNTID, $EMAIL, $PWD, $PARTNERGUID, $PARTNERPASSWORD);
$FieldList = GetContactFieldList($TEST, $ticket);

$fieldOption = "<option value=\"\" ></option>";

for ($i = 0; $i < sizeOf($FieldList); $i++) {
	$strTemp = trim($FieldList[$i]["Name"]);
	$fieldOption .=  "<option value=\"$strTemp\" >$strTemp</option>";
}

echo json_encode( array('success'=>true, 'fieldOption' => $fieldOption));


