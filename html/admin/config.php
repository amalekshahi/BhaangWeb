<?php

require_once('class.DB.php');

define("IMPORTPATH", "/var/www/html/admin/import/");
define("BACKUPPATH", "/var/www/html/admin/backup/");

//define("ACCOUNTID", "228");
//define("ACCOUNNAME", "CampaignLauncher");
//define("EMAIL", "boonsom@mindfireinc.com");
//define("PWD", "Atm12345#");
//define("PARTNERGUID", "CampaignLauncherAPIUser");
//define("PARTNERPASSWORD", "4e98af380d523688c0504e98af3=");

session_start();

$_SESSION['ACCOUNTID'] = '228';
$_SESSION['ACCOUNNAME'] = 'CampaignLauncher';
$_SESSION['EMAIL'] = 'boonsom@mindfireinc.com';
$_SESSION['PWD'] = 'Atm12345#';
$_SESSION['PARTNERGUID'] = 'CampaignLauncherAPIUser';
$_SESSION['PARTNERPASSWORD'] = '4e98af380d523688c0504e98af3=';

define("AWSKEY", "AKIAI6F2I2ZMHWIA4E7A");
define("AWSSECRET", "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");
define("AWSBUCKET", "bkktest");
define("AWSPATH", "/var/www/html/admin/aws/");

$DBSERVER = '127.0.0.1';
$DBNAME = 'studioPortal';
$DBUSER = 'root';
$DBPASS = 'freedom0323';

DB::$SERVER = $DBSERVER;
DB::$DATABASE = $DBNAME;
DB::$USERNAME = $DBUSER;
DB::$PASSWORD = $DBPASS;
