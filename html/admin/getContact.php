<?php
date_default_timezone_set('America/Los_Angeles');
session_start();
require_once 'commonUtil.php';

$LISTDEFINITION = $_GET['LISTDEFINITION'];
$cid = $_GET['cid'];
$TEST = $_GET['test'];
//$LISTDEFINITION = "<Filter CriteriaJoinOperator=\"&amp;\"><Criteria Row=\"1\" Field=\"State\" Operator=\"Equal\" Value=\"CA\" /></Filter>";

$ACCOUNTID = $_SESSION['ACCOUNTID'];
$EMAIL = $_SESSION['EMAIL'];
$PWD = $_SESSION['PWD'];
$PARTNERGUID = $_SESSION['PARTNERGUID'];
$PARTNERPASSWORD = $_SESSION['PARTNERPASSWORD'];
$ACCOUNNAME = $_SESSION['ACCOUNNAME'];

if ($cid == '-1') {
	$LISTDEFINITION = "<Filter CriteriaJoinOperator=\"&amp;\" />";
}	

if ($TEST == 't') {
	echo "$LISTDEFINITION<br>";
}

$ticket = getTicket($ACCOUNTID, $EMAIL, $PWD, $PARTNERGUID, $PARTNERPASSWORD);

$result = GetContact($TEST, $ticket, $LISTDEFINITION, $ACCOUNTID);

echo $result;
