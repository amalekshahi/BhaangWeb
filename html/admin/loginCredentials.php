<?php
if( !@$_SESSION['login'] ){
	header('Location: login.html');
    exit;
}
$dbName = $_SESSION['DBNAME'];
$accountID = $_SESSION['ACCOUNTID'];
$accountName = $_SESSION['ACCOUNNAME'];
$email = $_SESSION['EMAIL'];
$pwd = $_SESSION['PWD'];
$USERNAME = $_SESSION['USERNAME'];
?>