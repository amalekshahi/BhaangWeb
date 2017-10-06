<?php
require_once 'commonUtil.php';

$callback = $_GET['callback'];
$email = $_GET["email"];
$pwd = $_GET["pwd"];
$accountID = $_GET["accountID"];
$accountName = $_GET["accountName"];
$mode = $_GET["mode"];


$loadmore = "";
$errorMessage = "";
$authToken = "";


if ($accountID == "") {
	$SelectedAccountID = null;
} else {
	$SelectedAccountID = $accountID;
}

if ($mode == 'login') {
	$FieldNames = getxmediaAPICouchDB($accountName);
    //$FieldNames = getxmediaAPI($accountName);
	$PartnerGuid = $FieldNames[0];
	$PartnerPassword = $FieldNames[1]; 

	if ($PartnerGuid != '') {
        //create database 
        $dbName = getDatabaseName($accountID,$accountName);
        $doc = couchDB_CreateDatabase($dbName);   
        if(empty($doc->error)||($doc->error == "file_exists")){


            session_start();
            $_SESSION['ACCOUNTID'] = $accountID;
            $_SESSION['ACCOUNNAME'] = $accountName;
            $_SESSION['EMAIL'] = $email;
            $_SESSION['PWD'] = $pwd;
            $_SESSION['PARTNERGUID'] = $PartnerGuid;
            $_SESSION['PARTNERPASSWORD'] = $PartnerPassword;
            $_SESSION['login'] = true;
            $_SESSION['DBNAME'] = $dbName;
		
						// Dave added this to handle Da Vinci Gatekeeper flags
						$config = file_get_contents("./gatekeeper/gatekeeper.json");
						$gates = json_decode($config, TRUE); // Load the current gatekeeper config
						
						foreach ($gates as $g) { // Create the array of gates for this user in format gate_name = TRUE or gate_name = FALSE.
							$_SESSION['GATES'][$g['Code_Nick']] = strpos($g['Who_Can_See'], $email) !== FALSE ? "TRUE" : "FALSE";
						}	
					
						//$_SESSION['GATES'] = "yo!"; 
						// End of gates logic

			$ticket = getTicket($accountID, $email, $pwd, $PartnerGuid, $PartnerPassword);
			$username = GetUserinfo("", $ticket);


			$_SESSION['USERNAME'] = $username;

            echo $callback, '(', json_encode( array('success'=>true, 'PartnerGuid'=>$PartnerGuid, 'PartnerPassword'=>$PartnerPassword, 'Doc'=>$doc, 'username'=>$username)), ')';
        }else{
            echo $callback, '(', json_encode( array('success'=>false, 'message'=>'Cannot create database '.$dbName, 'Doc'=>$doc)), ')';
        }
	} else {
		echo $callback, '(', json_encode( array('success'=>false, 'message'=>'Cannot find PartnerGuid')), ')';
	}
	
} else {
	$authRequest = array
	(
		"SelectedAccountID" => $SelectedAccountID,
		"Email" => $email, 
		"Password" => $pwd, 
		//"PartnerGuid" => "CampaignLauncherAPIUser", 
		//"PartnerPassword" => "4e98af380d523688c0504e98af3="
		"PartnerGuid" => "", 
		"PartnerPassword" => ""
        
	);

	$authResponse = callService("userservice/Authenticate", $authRequest);

	//$userTicket = $authResponse->{"Credentials"}->{"Ticket"};
	//echo "userTicket=$userTicket<br>";
	$ErrorCode = $authResponse->{"Result"}->{"ErrorCode"};
	if ($ErrorCode == "") {
		
		$AvailableAccountList = $authResponse->{"AvailableAccountList"};
		$AccountNumber = Sizeof($AvailableAccountList);
		$isFound = true;

		//$AccountNames = getxmediaAPIaccount();
        
        $AccountNames = getxmediaAPIaccountCouchDB();
		
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
		$errorMessage = 'Bad username or password.';
	}

	if( !$isFound ) {
		echo $callback, '(', json_encode( array('success'=>false, 'message'=>$errorMessage)), ')';
		exit;
	} 
    
    echo $callback, '(',
    json_encode( array(
        'success'   => true,
        'loadmore'  => $loadmore,
        'authToken' => $authToken,
        'mps'=>$mpArray,
        'authRequest'=>$authRequest,
        'authResponse'=>$authResponse,
        'AccountNames'=>$AccountNames,
        'doc'=>$doc,
        'databaseEndpoint'=>$databaseEndpoint,
    )), ')';

	//echoCallbackString( $callback, $loadmore, $authToken, $mpArray);

}





