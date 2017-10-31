<?php

date_default_timezone_set('UTC');
session_start();
require_once 'commonUtil.php';


$ACCOUNTID = $_SESSION['ACCOUNTID'];
$EMAIL = $_SESSION['EMAIL'];
$PWD = $_SESSION['PWD'];
$PARTNERGUID = $_SESSION['PARTNERGUID'];
$PARTNERPASSWORD = $_SESSION['PARTNERPASSWORD'];
$ACCOUNNAME = $_SESSION['ACCOUNNAME'];

	

	// setup data.
	$environment = "https://studio.dashboard.mdl.io/api/Report/";	

	$ClientIP = "";
	$PROGRAMID = 134;
	$CampaignID = 0;
	$OutboundID = 0;
	$InboundID = 0;
	$rn = "media";
	$fd = "01/01/2011";
	$td = "05/30/2015";
	$seed = "true";
	$menu = "true";
	$pb = "true";
	$filter = "true";
	
	// Get token
	$tokenReq = array(
        "AccountID"=> $ACCOUNTID,
        "ClientIP"=> $ClientIP,
		"UserEmail"=> $EMAIL,
        "UserPass"=> $PWD

    );
	

	
	$tokenRes = callReportService($environment,"Authenticate", $tokenReq);
	$token = $tokenRes->{"Token"};
	echo "<br>token = $token<br>";
	
	// run report			
	
	$url = "https://studio.dashboard.mdl.io/api/Report//GetAdminReportData?rn=allprogram_allemail_detail&si=$PROGRAMID&ai=$ACCOUNTID&st=0&fd=01/01/2017&td=12/31/2017&seed=false&datasourceType=redshift&token=$token";

	echo "<br>url = ".$url."<br>";

	
	//header("Location: $url"); /* Redirect browser */