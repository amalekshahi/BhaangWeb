<?php

include 'global.php';

$callback = $_GET['callback'];
$email = $_GET["email"];
$pwd = $_GET["pwd"];
$accountID = $_GET["accountID"];
$accountName = $_GET["accountName"];
$mode = $_GET["mode"];


$loadmore = "";
$errorMessage = "";
$authToken = "";

function echoCallbackString($callback, $loadmore='', $authToken = '', $mpArray){
	
		echo $callback, '(',
        json_encode( array(
            'success'   => true,
			'loadmore'  => $loadmore,
			'authToken' => $authToken,
			'mps'=>$mpArray
        )), ')';
			
}


if ($accountID == "") {
	$SelectedAccountID = null;
} else {
	$SelectedAccountID = $accountID;
}

if ($mode == 'login') {
	$FieldNames = getxmediaAPI($accountName);
	$PartnerGuid = $FieldNames[0];
	$PartnerPassword = $FieldNames[1]; 

	if ($PartnerGuid != '') {
		 session_start();
		$_SESSION['ACCOUNTID'] = $accountID;
		$_SESSION['ACCOUNNAME'] = $accountName;
		$_SESSION['EMAIL'] = $email;
		$_SESSION['PWD'] = $pwd;
		$_SESSION['PARTNERGUID'] = $PartnerGuid;
		$_SESSION['PARTNERPASSWORD'] = $PartnerPassword;
		$_SESSION['login'] = true;
		echo $callback, '(', json_encode( array('success'=>true, 'PartnerGuid'=>$PartnerGuid, 'PartnerPassword'=>$PartnerPassword)), ')';
	} else {
		echo $callback, '(', json_encode( array('success'=>false, 'message'=>'Cannot find PartnerGuid')), ')';
	}
	
} else {
	$authRequest = array
	(
		"SelectedAccountID" => $SelectedAccountID,
		"Email" => $email, 
		"Password" => $pwd, 
		"PartnerGuid" => "CampaignLauncherAPIUser", 
		"PartnerPassword" => "4e98af380d523688c0504e98af3="
	);

	$authResponse = callService("userservice/Authenticate", $authRequest);

	$userTicket = $authResponse->{"Credentials"}->{"Ticket"};
	//echo "userTicket=$userTicket<br>";
	$ErrorCode = $authResponse->{"Result"}->{"ErrorCode"};
	if ($ErrorCode == "") {
		
		$AvailableAccountList = $authResponse->{"AvailableAccountList"};
		$AccountNumber = Sizeof($AvailableAccountList);
		$isFound = true;

		$AccountNames = getxmediaAPIaccount();
		
		$loadmore = "Yes";
			
		foreach ($AvailableAccountList as $x){
			foreach ($AccountNames as $y){
				$y = strtolower($y);
				$z = strtolower($x->{'Value'});
				if ($y == $z) {
					$mpArray[] = array($x->{'Key'}, $x->{'Value'});
				}
			}
			
		}
		sort($mpArray);	
		
	} else {
		//$errorMessage = $authResponse->{"Result"}->{"ErrorMessage"};
		$errorMessage = 'Incorrect username or password.';
		
		
	}

	if( !$isFound ) {
		echo $callback, '(', json_encode( array('success'=>false, 'message'=>$errorMessage)), ')';
		exit;
	} 

	echoCallbackString( $callback, $loadmore, $authToken, $mpArray);

}





