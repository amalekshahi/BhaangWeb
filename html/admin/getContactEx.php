<?php
ini_set("memory_limit","-1");
set_time_limit(0);
date_default_timezone_set('UTC');
session_start();
require_once 'commonUtil.php';

$LISTDEFINITION = $_GET['LISTDEFINITION'];
$cid = $_GET['cid'];
$COUNTONLY = $_GET['COUNTONLY'];

$ACCOUNTID = $_SESSION['ACCOUNTID'];
$EMAIL = $_SESSION['EMAIL'];
$PWD = $_SESSION['PWD'];
$PARTNERGUID = $_SESSION['PARTNERGUID'];
$PARTNERPASSWORD = $_SESSION['PARTNERPASSWORD'];
$ACCOUNNAME = $_SESSION['ACCOUNNAME'];

$draw = $_GET['draw']; 
$limit = $_GET['length'];
$page = $_GET['start']; 

if(empty($limit)){
    $limit = 10;
}

if(empty($page)){
    $page = 0;
}else{
    $page = $page/$limit;
}

if ($cid == '-1') {
	$LISTDEFINITION = "<Filter CriteriaJoinOperator=\"&amp;\" />";
}	

$ticket = getTicket($ACCOUNTID, $EMAIL, $PWD, $PARTNERGUID, $PARTNERPASSWORD);
// Get ContactCount becuase the one that return with GetContactsByPage is not reliable (change to 0 after couple of call)
$contactCount = GetContactCount("",$ticket,$LISTDEFINITION,$ACCOUNTID);
if(!empty($COUNTONLY)){
    echo json_encode(
        array(
            'success'=>true,
            'recordsTotal'=>$contactCount,
        )
    );
    exit;
}

$result = GetContactEx($ticket, $LISTDEFINITION,$ACCOUNTID, $draw,$page,$limit);
$result["recordsTotal"] = $contactCount;
$result["recordsFiltered"] = $contactCount;

echo json_encode($result);


function GetContactEx($userTicket, $filter,$ACCOUNTID,$draw,$page,$limit){	
	
	$FieldNames = array("FirstName","LastName","Email","Phone","Address1","City","State","Zip");
	$result = GetContactWithFieldsEx($userTicket, $filter,$ACCOUNTID,$FieldNames,$draw,$page,$limit);
	return $result;
}

function GetContactWithFieldsEx($userTicket, $filter,$ACCOUNTID, $FieldNames,$draw,$page,$limit){
    $start_time = microtime(true);
    $execTime = array();

	$Contact = "";
	$rows = array();
	$Contactarray = array();
	$columns = array();
	$errorMessage = '';
    
    if(empty($draw)){
        // full mode
        $limit = 2147483647;
        $page = 0;
    }

	$ContactListRequest   = array
	(
		"Credentials" => array
		(
			"Ticket" => $userTicket        
		),
        "Account_ID" => $ACCOUNTID,
		"FieldNames" => $FieldNames,
		"Filter" => $filter,
        "MaxRows" => $limit,
        "StartRowIndex" => $page,   // actually this is page index rowindex = StartRowIndex*MaxRows
	);
	$ContactListResponse = callService("contactservice/GetContactsByPage", $ContactListRequest);
	$ErrorCode = $ContactListResponse->{"Result"}->{"ErrorCode"};
	if ($ErrorCode == "") {
		/*$Contacts = $ContactListResponse->{"Contacts"};
        

		
		foreach ($Contacts as $chr) {
			$Contact .= chr($chr);
		}

		*/

		$t = date("mdY-His",time());
		$tmpName = $t.'.csv';
		$filename = 'import/contactFile/'.$tmpName;
		$Contact = $ContactListResponse->{"ContactsCsv"};
        $totalContact = $ContactListResponse->{"ContactsCount"};
		file_put_contents( $filename, $Contact);			
        
		$Contactarray = array_map("str_getcsv", explode("\n", $Contact));
        // Remove Header
		array_splice($Contactarray, 0, 1);
        // Remove last empty record
        array_splice($Contactarray, -1, 1);

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
    
    $i=0;
    foreach( $Contactarray as $row ) {	
        //$responce[rows[$i]['id']=$i;
        //$responce->rows[$i]['cell']=$row;
        $i++;
    }

    $execTime['GetContactWithFields'] = microtime(true) - $start_time;$start_time = microtime(true);
	$result = array(
            'success'=>$success,
            'ticket' => $userTicket,
            'data' => $Contactarray,
            'columns' => $columns,
            'errorMessage' => $errorMessage,
            'filename' => $filename,
            'tmpName' => $tmpName,
            'execTime'=>$execTime,
            //'totalContact'=>$totalContact,
            //"recordsTotal" => $totalContact,
            //"recordsFiltered" => $totalContact,
            "draw" => $draw,
            "ContactListResponse"=>$ContactListResponse,
            "limit" => $limit,
            "page" => $page,
    );
	return $result;

}

