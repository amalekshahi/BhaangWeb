<?php

date_default_timezone_set('America/Los_Angeles');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

define('ROOTDIR', 'LWC_API/');
require_once(ROOTDIR.'com/MindFireInc/Database/class.DB.php');

$DBSERVER = '127.0.0.1';
$DBNAME = 'FREEDOM';
//$DBUSER = 'mfadmin';
//$DBPASS = 'mk5ad1wq';

$DBUSER = 'root';
$DBPASS = '';


//$DBNAME = 'applaud';
//$DBUSER = 'app327_307';
//$DBPASS = 'MindFire307';

DB::$SERVER = $DBSERVER;
DB::$DATABASE = $DBNAME;
DB::$USERNAME = $DBUSER;
DB::$PASSWORD = $DBPASS;

$callback = @$_GET['callback'];
$prospectID = @$_GET['prospectID'];
$cid = @$_GET['cid'];
$purl = @$_GET['purl'];
$test = @$_GET['test'];

if ($test == 't') {
	echo "prospectID = $prospectID<br>"; 
	echo "purl = $purl<br>";
}


function saveToLog($test, $DBSERVER, $DBNAME, $DBUSER, $DBPASS, $prospectID, $purl, $cid ) {
	if ($test == 't') {
		echo "saveToLog Start<br>";		
		echo "DBSERVER = $DBSERVER<br>"; 
		echo "DBNAME = $DBNAME<br>";
		echo "DBUSER = $DBUSER<br>";
		echo "DBPASS = $DBPASS<br>";
	}
	$id = "-1";
	$con = mysql_connect($DBSERVER, $DBUSER, $DBPASS);
	if (!$con) {
		if ($test == 't') {
			echo "Could not connect<br>";	
		}
 		die('Could not connect: ' . mysql_error());
	} else {
		if ($test == 't') {
			echo "Could connect<br>";	
		}
	}
	
	
	$db_selected = mysql_select_db($DBNAME,$con);

	$tableName = 'repPost';
	if ($cid) {
		$tableName = $tableName.$cid;
	}


	$sql = "INSERT INTO $tableName (createOn,prospectID,purl) VALUES (NOW(), '$prospectID', '$purl' )";
	$result = mysql_query($sql,$con);
	$id = mysql_insert_id();
	if ($test == 't') {	
		echo "ID of last inserted record is: $id <br>";
	}
	
	mysql_close($con);

	return $id;

}

function getRepEmail($test, $repid, $cid) {
	$repEmail = '';
	
	$id = $repid % 5;
	if ($id == 0) {
		$id = 5;
	}
	if ($test == 't') {
		echo "getRepEmail id : $id<br>";	
	}

	$tableName = 'repEmail';
	if ($cid) {
		$tableName = $tableName.$cid;
	}

	$lists = DB::QueryExecute("SELECT * FROM $tableName WHERE repID=?", $id);
	if ($lists) {
		$repEmail = $lists['repEmail'];	
	}

	return $repEmail;
}


if ($prospectID == '') {
	echo $callback, '(', json_encode(array('logID'=>'-1')) ,')';
	exit;
} 

$logID = saveToLog($test, $DBSERVER, $DBNAME, $DBUSER, $DBPASS, $prospectID, $purl, $cid );
$repEmail = getRepEmail($test, $logID, $cid);

echo $callback, '(', json_encode(array('logID'=>$logID , 'repEmail'=>$repEmail)) ,')';