<?php
date_default_timezone_set('America/Los_Angeles');
session_start();
require_once 'commonUtil.php';



$joinrow = $_GET['joinrow'];
$itemCount = $_GET['itemCount'];


//echo "$joinrow, $itemCount<br>";

$Filter = "";
$CriteriaRow = "";
$counter = 1;

for ($i = 1; $i < $itemCount; $i++) {
	
	$field = trim($_GET['fieldoption'.$i]);
	$op = trim($_GET['operatoroption'.$i]);
	$data = trim($_GET['filtervalue'.$i]);
	
	if ($field != "") {
		$CriteriaRow .= "<Criteria Row=\"$counter\" Field=\"$field\" Operator=\"$op\" Value=\"$data\" />";
		$counter++;
	}

	//echo "$row, $field, $op, $data<br>";
}

if ($joinrow == 'and') {
	$JoinOperator = "&amp;";
} else if ($joinrow == 'or') {
	$JoinOperator = "|";
}

$Filter = "<Filter CriteriaJoinOperator=\"$JoinOperator\">$CriteriaRow</Filter>";

echo json_encode( array('success'=>true, 'Filter' => $Filter));
