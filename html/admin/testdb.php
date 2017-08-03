
<?php
require_once('class.DB.php');
include 'global.php';


$FileName = '20170731051845.csv';
$email = 'boonsom@mindfireinc.com';
$errorMessage = '';
$recordCount ='5';
$importType = 'google';

$sql = 'INSERT INTO importContact (id, importTime, importType, filename, email, errorMessage, recordCount) VALUES (NULL, NOW(), ?, ?, ?, ?, ?)';

	echo "sql : $sql<br>\n";
	echo "$importType, $FileName, $email, $errorMessage, $recordCount<br>\n";

	DB::QueryExecute($sql, $importType, $FileName, $email, $errorMessage, $recordCount);