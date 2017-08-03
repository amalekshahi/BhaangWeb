<?php


date_default_timezone_set('America/Los_Angeles');
require('config.php');


ini_set("memory_limit", "-1");





function callService($endpoint, $request)
{
	$request_string = json_encode($request); 

	$service = curl_init('http://studio.mdl.io/REST/'.$endpoint);                                                                      
	curl_setopt($service, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($service, CURLOPT_POSTFIELDS, $request_string);                                                                  
	curl_setopt($service, CURLOPT_RETURNTRANSFER, true);                                                                      
	curl_setopt($service, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',                                                                                
		'Content-Length: ' . strlen($request_string))                                                                       
	);                                                                                                                   
	$response_string = curl_exec($service);

	$response = json_decode($response_string);
	return($response);
}


function getTicket($SelectedAccountID, $email, $pwd, $PartnerGuid = "CampaignLauncherAPIUser", $PartnerPassword = "4e98af380d523688c0504e98af3=") {
	$authRequest = array
	(
		"SelectedAccountID" => $SelectedAccountID,
		"Email" => $email, 
		"Password" => $pwd, 
		"PartnerGuid" => $PartnerGuid, 
		"PartnerPassword" => $PartnerPassword
	);

	$authResponse = callService("userservice/Authenticate", $authRequest);

	$userTicket = $authResponse->{"Credentials"}->{"Ticket"};

	$ErrorCode = $authResponse->{"Result"}->{"ErrorCode"};
	if ($ErrorCode == "") {	
		
	} else {
		$errorMessage = "Authenticate ERROR : ".$authResponse->{"Result"}->{"ErrorMessage"};
		$userTicket = '';
	}

	return $userTicket;
}


function getxmediaAPI($account) {
	$sqltxt = "select * from xmediaAPI where accountname = ? limit 1";
	$row2 = DB::QueryExecuteMulti($sqltxt, $account);


	$FieldNames = array();
	
	if ($row2) {
		foreach( $row2 as $row1 ) {			
			$FieldNames[] = $row1['PartnerGuid'];
			$FieldNames[] = $row1['PartnerPwd'];
		}
	} else {
		$FieldNames[] = '';
		$FieldNames[] = '';
	}
	return $FieldNames;
}

function getxmediaAPIaccount() {
	$sqltxt = "select * from xmediaAPI";
	$row2 = DB::QueryExecuteMulti($sqltxt);
	$AccountNames = array();
	
	if ($row2) {
		foreach( $row2 as $row1 ) {			
			$r1 = $row1['accountname'];
			$AccountNames[] = $r1;
		}
	}
	return $AccountNames;
}


function ImportContacts($TEST, $FileName, $Mapping, $importName, $userTicket, $email, $file, $recordCount, $importType, $accountName) {
	$output = file_get_contents($file);
	$byteArr = str_split($output);
	foreach ($byteArr as $key=>$val) { 
		$byteArr[$key] = ord($val); 
	}

	$ImportRequest   = array
	(
		"FileName" => $FileName,
		"Filterable" => true,
		"Mapping" => $Mapping,
		"Mode" => 1,
		"Name" => $importName,
		"NotificationEmail" => $email,
		"CSV" => $byteArr,
		"Credentials" => array
		(
			"Ticket" => $userTicket        
		),
		"CsvFormat" => 1
	);
	$ImportResponse = callService("contactservice/ImportContacts", $ImportRequest);
	$ErrorCode = $ImportResponse->{"Result"}->{"ErrorCode"};
	if ($ErrorCode == "") {
		$errorMessage = '';

		
	} else {
		$errorMessage = "ImportResponse ERROR : <br> ErrorMessage -> ".$ImportResponse->{"Result"}->{"ErrorMessage"}.'<br>'.
		"ExceptionMessage : ".$ImportResponse->{"Result"}->{"ExceptionMessage"};
		//$errorMessage = "ImportResponse ERROR : <br> ErrorMessage -> ".$ImportResponse->{"Result"}->{"ErrorMessage"};
	}

	$sql = 'INSERT INTO MF_importContact (id, importTime, importType, filename, email, errorMessage, recordCount, accountName) VALUES (NULL, NOW(), ?, ?, ?, ?, ?, ?)';
	if ($TEST == 't') {
		echo "sql : $sql<br>\n";
		echo "importType, FileName, email, errorMessage, recordCount, accountName<br>\n";
		echo "$importType, $FileName, $email, $errorMessage, $recordCount, $accountName<br>\n";
	}

	DB::QueryExecute($sql, $importType, $FileName, $email, $errorMessage, $recordCount, $accountName);

	return $errorMessage;
}


function saveListInfo($TEST, $email, $accountName, $ListName, $ListDescription, $ListDefinition, $recordCount) {
	

	$sql = 'INSERT INTO MF_importList (id, createTime, updateTime, email, accountName, ListName, ListDescription, ListDefinition, recordCount) VALUES (NULL, NOW(), NOW(), ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE updateTime=NOW(), ListName=?, ListDescription=?, ListDefinition=?, recordCount=?';
	if ($TEST == 't') {
		echo "sql : $sql<br>\n";
		echo "email, accountName, ListName, ListDescription, ListDefinition, recordCount<br>\n";
		echo "$email, $accountName, $ListName, $ListDescription, $ListDefinition, $recordCount, $ListName, $ListDescription, $ListDefinition<br>\n";
	}

	DB::QueryExecute($sql, $importType, $FileName, $email, $errorMessage, $recordCount, $accountName);

	return $errorMessage;
}