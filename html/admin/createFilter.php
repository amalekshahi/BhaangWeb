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
$CriteriaJoinOperator = "";

if ($joinrow == 'and') {
	$JoinOperator = "&amp;";
} else if ($joinrow == 'or') {
	$JoinOperator = "|";
}

for ($i = 1; $i < $itemCount; $i++) {
	
	$field = trim($_GET['fieldoption'.$i]);
	$op = trim($_GET['operatoroption'.$i]);
	$data = trim($_GET['filtervalue'.$i]);
	
	if ($field != "") {
		$CriteriaRow .= "<Criteria Row=\"$counter\" Field=\"$field\" Operator=\"$op\" Value=\"$data\" />";		
		
		$array3 = array();
		$array3{'Row'} = $counter;
		$array3['Field'] = $field;
		$array3['Operator'] = $op;
		$array3['Value'] = $data;
		$array3['JoinOperator'] = $joinrow;
		$CriteriaJoinOperator .= $counter.$JoinOperator;

		$filterArray[] = $array3;

		$counter++;
	}

	//echo "$row, $field, $op, $data<br>";
}



$l1 = strlen($CriteriaJoinOperator);
$l2 = strlen($JoinOperator);

$CriteriaJoinOperator = substr($CriteriaJoinOperator, 0, 0-$l2);

$Filter = "<Filter CriteriaJoinOperator=\"$JoinOperator\">$CriteriaRow</Filter>";

echo json_encode( array('success'=>true, 'Filter' => $Filter, 'filterArray' => $filterArray, 'CriteriaJoinOperator' => $CriteriaJoinOperator, 'JoinOperator' => $joinrow));
