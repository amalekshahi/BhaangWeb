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


function GetContactFieldList($TEST, $userTicket){
	$rows = array();
	$GetContactFieldListRequest   = array
	(
		
		"Credentials" => array
		(
			"Ticket" => $userTicket        
		),
		"Type" => 0
	);
	$GetContactFieldListResponse = callService("contactservice/GetContactFieldList", $GetContactFieldListRequest);
	$ErrorCode = $GetContactFieldListResponse->{"Result"}->{"ErrorCode"};
	if ($ErrorCode == "") {
		$ImportList = $GetContactFieldListResponse->{"FieldList"};
		foreach ($ImportList as $x){
			//echo "Name = ".$ImportList->{'Name'}."<br>";
			$importName = $x->{'Name'};
			if ($importName != '') {
				$group = array(					
					'Name'=>$x->{'Name'}
				);					
				$rows[] = $group;
			}			
		}
		array_sort($rows, 'Name', SORT_ASC);
	} else {
		$errorMessage = "GetContactFieldListResponse ERROR : <br> ErrorMessage -> ".$GetContactFieldListResponse->{"Result"}->{"ErrorMessage"}.'<br>'.
		"ExceptionMessage : ".$GetContactFieldListResponse->{"Result"}->{"ExceptionMessage"};

		echo $errorMessage;
		
	}

	return $rows;
}


function GetContactCount($TEST, $userTicket, $filter, $ACCOUNTID){
	$rows = array();
	$Count = "0";
	$ContactListCountRequest   = array
	(
		
		"Credentials" => array
		(
			"Ticket" => $userTicket        
		),
		"Account_ID" => $ACCOUNTID,
		"Filter" => $filter
	);
	$ContactListCountResponse = callService("contactservice/GetContactListCount", $ContactListCountRequest);
	$ErrorCode = $ContactListCountResponse->{"Result"}->{"ErrorCode"};
	if ($ErrorCode == "") {
		$Count = $ContactListCountResponse->{"Count"};		
	} else {
		$errorMessage = "ContactListCountResponse ERROR : <br> ErrorMessage -> ".$ContactListCountResponse->{"Result"}->{"ErrorMessage"}.'<br>'.
		"ExceptionMessage : ".$ContactListCountResponse->{"Result"}->{"ExceptionMessage"};		
	}

	return $Count;
}

function GetContact($TEST, $userTicket, $filter, $ACCOUNTID){
	$Contact = "";
	$rows = array();
	$Contactarray = array();
	$columns = array();
	$errorMessage = '';

	$FieldNames = array("FirstName","LastName","Email","Phone","Address1","City","State","Zip");
	

	$ContactListRequest   = array
	(
		
		"Credentials" => array
		(
			"Ticket" => $userTicket        
		),
	
		"FieldNames" => $FieldNames,
		"Filter" => $filter,
		"OutputType" => 1,
	);
	$ContactListResponse = callService("contactservice/GetContactList", $ContactListRequest);
	$ErrorCode = $ContactListResponse->{"Result"}->{"ErrorCode"};
	if ($ErrorCode == "") {
		$Contacts = $ContactListResponse->{"Contacts"};


		
		foreach ($Contacts as $chr) {
			$Contact .= chr($chr);
		}

		


		$t = date("mdY-His",time());
		$tmpName = $t.'.csv';
		$filename = IMPORTPATH.'contactFile/'.$tmpName;
		$Contact = trim($Contact);

		file_put_contents( $filename, $Contact);			

		$Contactarray = array_map("str_getcsv", explode("\n", $Contact));
		array_splice($Contactarray, 0, 1);

		$columns = rtrim(strtok($Contact, "\n"));
		
		$arr = explode(",", $columns);
		$columns = array();
		if ($arr) {
			foreach( $arr as $row1 ) {	
				$arr1 = array(					
					'title'=>$row1
				);	
				$columns[] = $arr1;
			}
		}
		$success = true;
		
		

	} else {
		$errorMessage = "ContactListResponse ERROR : <br> ErrorMessage -> ".$ContactListResponse->{"Result"}->{"ErrorMessage"}.'<br>'.
		"ExceptionMessage : ".$ContactListResponse->{"Result"}->{"ExceptionMessage"};
		//$errorMessage = "ImportResponse ERROR : <br> ErrorMessage -> ".$ImportResponse->{"Result"}->{"ErrorMessage"};
		//echo $errorMessage."<BR>";

		$success = false;
	}

	$result = json_encode( array('success'=>$success, 'ticket' => $userTicket, 'Contact' => $Contactarray, 'columns' => $columns, 'errorMessage' => $errorMessage, 'filename' => $filename, 'tmpName' => $tmpName));

	return $result;

}

function saveListInfo($TEST, $email, $accountName, $ListName, $ListDescription, $ListDefinition, $recordCount) {
	

	$sql = 'INSERT INTO MF_importList (id, createTime, updateTime, email, accountName, ListName, ListDescription, ListDefinition, recordCount) VALUES (NULL, NOW(), NOW(), ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE updateTime=NOW(), ListName=?, ListDescription=?, ListDefinition=?, recordCount=?';
	if ($TEST == 't') {
		echo "sql : $sql<br>\n";
		echo "email, accountName, ListName, ListDescription, ListDefinition, recordCount<br>\n";
		echo "$email, $accountName, $ListName, $ListDescription, $ListDefinition, $recordCount, $ListName, $ListDescription, $ListDefinition<br>\n";
	}

	//DB::QueryExecute($sql, $importType, $FileName, $email, $errorMessage, $recordCount, $accountName);

	return $errorMessage;
}

function array_sort($array, $on, $order=SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

function mapOperator($op) {
	$ret = 'Contains';
	if ($op == 'eq') {
		$ret = 'Equal';
	} else if ($op == 'ne') {
		$ret = 'NotEqual';
	} else if ($op == 'bw') {
		$ret = 'StartsWith';
	} else if ($op == 'bn') {
		$ret = 'NotStartsWith';
	} else if ($op == 'ew') {
		$ret = 'EndsWith';
	} else if ($op == 'en') {
		$ret = 'NotEndsWith';
	} else if ($op == 'cn') {
		$ret = 'Contains';
	} else if ($op == 'nc') {
		$ret = 'NotContains';
	} else if ($op == 'lt') {
		$ret = 'Before';
	} else if ($op == 'le') {
		$ret = 'BeforeEqual';
	} else if ($op == 'gt') {
		$ret = 'After';
	} else if ($op == 'ge') {
		$ret = 'AfterEqual';
	} else if ($op == 'in') {
		$ret = 'Contains';
	} else if ($op == 'ni') {
		$ret = 'NotContains';
	}

	return $ret;

}


function getJsonFilter($jsonFilters) {
	$Filter = '';

	if ($jsonFilters) {
		$JoinOperator = "";
		$CriteriaRow = "";

		$row = 0;

		
		
		$JoinOperator = $jsonFilters->{"groupOp"};
		if ($JoinOperator == 'AND') {
			$JoinOperator = "&amp;";
		} else if ($JoinOperator == 'OR') {
			$JoinOperator = "|";
		}

		$rules = $jsonFilters->{"rules"};
		foreach ($rules as $rule) {
			$field	= $rule->{"field"};
			$op		= $rule->{"op"};
			//$op		= mapOperator($op);
			$data	= $rule->{"data"};
			//echo "field = $field, op = $op, data = $data<br>";
			$row++;
			$CriteriaRow1 .= "Criteria Row=\"$row\" Field=\"$field\" Operator=\"$op\" Value=\"$data\" <br>";
			$CriteriaRow .= "<Criteria Row=\"$row\" Field=\"$field\" Operator=\"$op\" Value=\"$data\" />";
			
		}
		
		
			
		

		$Filter = "<Filter CriteriaJoinOperator=\"$JoinOperator\">$CriteriaRow</Filter>";
		$CriteriaRow1 = "Filter CriteriaJoinOperator=\"$JoinOperator\" $CriteriaRow1 Filter<br>";
		
	} else {
		$CriteriaRow1 = "Filter CriteriaJoinOperator=\"&amp;\" <br>";		
		$Filter = "<Filter CriteriaJoinOperator=\"&amp;\" />";		

		//echo "CriteriaRow1 = $CriteriaRow1<br>";
	}
	
	//echo "JoinOperator = $JoinOperator<br>CriteriaRow1 = $CriteriaRow1<br>";
	
	
	
	return $Filter;

}


function GetTimeZone($TEST, $userTicket){
	$rows = array();
	$Count = "0";
	$TimeZoneRequest   = array
	(
		
		"Credentials" => array
		(
			"Ticket" => $userTicket        
		)
	);
	$TimeZoneResponse = callService("programservice/GetTimeZone", $TimeZoneRequest);
	$ErrorCode = $TimeZoneResponse->{"Result"}->{"ErrorCode"};
	if ($ErrorCode == "") {
		$TimeZoneList = $TimeZoneResponse->{"TimeZoneList"};		
	} else {
		$errorMessage = "TimeZoneResponse ERROR : <br> ErrorMessage -> ".$TimeZoneResponse->{"Result"}->{"ErrorMessage"}.'<br>'.
		"ExceptionMessage : ".$TimeZoneResponse->{"Result"}->{"ExceptionMessage"};		
	}

	return $TimeZoneList;
}