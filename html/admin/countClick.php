<?php
date_default_timezone_set('America/Los_Angeles');
session_start();
require_once 'commonUtil.php';

$LISTDEFINITION = $_GET['LIST-DEFINITION'];


$ACCOUNTID = $_SESSION['ACCOUNTID'];
$EMAIL = $_SESSION['EMAIL'];
$PWD = $_SESSION['PWD'];
$PARTNERGUID = $_SESSION['PARTNERGUID'];
$PARTNERPASSWORD = $_SESSION['PARTNERPASSWORD'];
$ACCOUNNAME = $_SESSION['ACCOUNNAME'];

$ticket = getTicket($ACCOUNTID, $EMAIL, $PWD, $PARTNERGUID, $PARTNERPASSWORD);

$count = GetContactCount($TEST, $ticket, $LISTDEFINITION, $ACCOUNTID);

echo json_encode( array('success'=>true, 'count' => $count));
