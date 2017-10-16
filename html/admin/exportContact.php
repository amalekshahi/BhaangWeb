<?php
date_default_timezone_set('UTC');
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

$output = json_decode($result);
$tmpName = $output->tmpName;

$content = "Click <a href='https://web2xmm.com/admin/import/contactFile/$tmpName'>here</a> or check your email to download the exported file.";
$subject = "Your Export file.";


mail($EMAIL, $subject, $content);			

echo $result;




/*


$output = json_decode($result);
$filename = $output->filename;

$output = file_get_contents($filename);
$output = trim($output);

sleep(3);

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"exportData.csv\"");

echo $output;

/*
$filename = $result->filename;

echo filename : $filename;
echo "<BR>";

$output = file_get_contents($filename, true);

//header("Content-type: application/octet-stream");
//header("Content-Disposition: attachment; filename=\"exportData.csv\"");

echo $output;
*/