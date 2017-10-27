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
$search = $_GET['search'];


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
/*    $LISTDEFINITION = <<<'KKK'
<Filter CriteriaJoinOperator="&amp;">
    <Criteria Row="1" Field="z_Customer_Status" Operator="NotEqual" Value="Active" />
    <Criteria Row="2" Field="sfapp_HasOptedOutOfEmail" Operator="NotEqual" Value="1" />
    <Criteria Row="3" Field="Email" Operator="Contains" Value="@" />
</Filter>
KKK;*/
}	

$FieldNames = array("FirstName","LastName","Email","Phone","Address1","City","State","Zip");
$LISTDEFINITION = BuildFilter($LISTDEFINITION,$search['value'],$FieldNames);

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



$result = GetContactWithFieldsEx($ticket,$LISTDEFINITION,$ACCOUNTID,$FieldNames,$draw,$page,$limit,$search['value']);
$result["recordsTotal"] = $contactCount;
$result["recordsFiltered"] = $contactCount;
$result["GET"] = $_GET;

echo json_encode($result);

function BuildFilter($filter,$searchValue,$FieldNames)
{
    $xml = new DOMDocument();    
    if(!empty($searchValue)){
        $xml->loadXML($filter);
        $xpath = new DOMXpath($xml);
        $orgCriteriaCount = DomCount($xpath,"//Criteria");
        $nextIndex = $orgCriteriaCount+1;
        $moreXML = "";
        $moreJoin = "";
        $orgJoin = "";
        $orgJoinOperator = DomGetAttribute($xpath,"/Filter","CriteriaJoinOperator");
        if($orgJoinOperator == "&" || $orgJoinOperator == "|"){
            for($i=1;$i<=$orgCriteriaCount;$i++){
                if($orgJoin == ""){
                    $orgJoin .= "$i";
                }else{
                    $orgJoin .= $orgJoinOperator . "$i";
                }
            }
            if($orgJoin!=""){
                $orgJoin = "($orgJoin)";
            }
        }
        foreach($FieldNames as $fieldName){
            $moreXML .= "<Criteria Row=\"$nextIndex\" Field=\"$fieldName\" Operator=\"Contains\" Value=\"$searchValue\" />\n";
            if($moreJoin == ""){
                $moreJoin .= "$nextIndex";
            }else{
                $moreJoin .= "|$nextIndex";
            }
            $nextIndex += 1;
        }
        $moreJoin = "($moreJoin)";
        if($orgJoinOperator == "&" || $orgJoinOperator == "|"){
            if($orgJoin!=""){
                $finalJoin = $orgJoin . "&" .  $moreJoin;    
            }else{
                $finalJoin = $moreJoin;    
            }
        }else{
            $finalJoin = $orgJoinOperator . "&" .  $moreJoin;    
        }
        DomSetAttribute($xpath,"/Filter","CriteriaJoinOperator",$finalJoin);
        $newfilter = str_replace('</Filter>',$moreXML.'</Filter>', $xml->saveHTML());
        $filter = $newfilter;
    }
    return $filter;
}


function GetContactEx($userTicket, $filter,$ACCOUNTID,$draw,$page,$limit,$searchValue){	
	
	$FieldNames = array("FirstName","LastName","Email","Phone","Address1","City","State","Zip");
	$result = GetContactWithFieldsEx($userTicket, $filter,$ACCOUNTID,$FieldNames,$draw,$page,$limit,$searchValue);
	return $result;
}

function GetContactWithFieldsEx($userTicket, $filter,$ACCOUNTID, $FieldNames,$draw,$page,$limit,$searchValue){
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
    /*
    $xml = new DOMDocument();    
    if(!empty($searchValue)){
        $xml->loadXML($filter);
        $xpath = new DOMXpath($xml);
        $orgCriteriaCount = DomCount($xpath,"//Criteria");
        $nextIndex = $orgCriteriaCount+1;
        $moreXML = "";
        $moreJoin = "";
        $orgJoin = "";
        $orgJoinOperator = DomGetAttribute($xpath,"/Filter","CriteriaJoinOperator");
        if($orgJoinOperator == "&"){
            for($i=1;$i<=$orgCriteriaCount;$i++){
                if($orgJoin == ""){
                    $orgJoin .= "$i";
                }else{
                    $orgJoin .= "&$i";
                }
            }
            $orgJoin = "($orgJoin)";
        }
        foreach($FieldNames as $fieldName){
            $moreXML .= "<Criteria Row=\"$nextIndex\" Field=\"$fieldName\" Operator=\"Contains\" Value=\"$searchValue\" />\n";
            if($moreJoin == ""){
                $moreJoin .= "$nextIndex";
            }else{
                $moreJoin .= "|$nextIndex";
            }
            $nextIndex += 1;
        }
        $moreJoin = "($moreJoin)";
        if($orgJoinOperator == "&"){
            $finalJoin = $orgJoin . "&" .  $moreJoin;    
        }else{
            $finalJoin = $orgJoinOperator . "&" .  $moreJoin;    
        }
        DomSetAttribute($xpath,"/Filter","CriteriaJoinOperator",$finalJoin);
        $newfilter = str_replace('</Filter>',$moreXML.'</Filter>', $xml->saveHTML());
        $filter = $newfilter;
    }
    */
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
            "filter" => $filter,
            "search" => $searchValue,
            //"xml" => $xml->saveHTML(),
            //"orgCriteriaCount" => $orgCriteriaCount,
            //"moreXML" => $moreXML,
            //"finalJoin" => $finalJoin,
            //"orgJoinOperator" => $orgJoinOperator,
            //"newfilter" => $newfilter,
    );
	return $result;

}

