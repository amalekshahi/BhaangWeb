<?php

date_default_timezone_set('America/Los_Angeles');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$DBNAME = 'FREEDOM';
$prospectID = '10';
$purl = 'jackryan';
$test = 't';


	//$con = mysql_connect('127.0.0.1', 'mfadmin', 'mk5ad1wq');
	$con = mysql_connect('127.0.0.1', 'root', '');
	if (!$con) {
		die('Could not connect: ' . mysql_error() ."<br>\n");
	}
	echo 'Connected successfully'."<br>\n";

	$db_selected = mysql_select_db($DBNAME,$con);

	$sql = "INSERT INTO repPost (createOn,prospectID,purl) VALUES (NOW(), '$prospectID', '$purl' )";
	$result = mysql_query($sql,$con);
	$id = mysql_insert_id();
	if ($test == 't') {	
		echo "ID of last inserted record is: $id <br>\n";
	}
	
	mysql_close($con);


?>