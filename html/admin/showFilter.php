<?php
date_default_timezone_set('America/Los_Angeles');
session_start();
require_once 'commonUtil.php';



$joinrow = $_GET['joinrow'];
$itemCount = $_GET['itemCount'];
$LISTDEFINITION = $_GET['LISTDEFINITION'];
$TEST = $_GET['test'];
$tabData = "";

$OperatorArray = Array("After","AfterEqual","Before","BeforeEqual","Contains","EndsWith","Equal","NotContains","NotEndsWith","NotEqual","NotStartsWith","StartsWith");

$OperatorOption = "<option value=\"\" ></option>".
		"<option value=\"After\" >After</option>".
		"<option value=\"AfterEqual\" >AfterEqual</option>".
		"<option value=\"Before\" >Before</option>".
		"<option value=\"BeforeEqual\" >BeforeEqual</option>".
		"<option value=\"Contains\" >Contains</option>".
		"<option value=\"EndsWith\" >EndsWith</option>".
		"<option value=\"Equal\" >Equal</option>".
		"<option value=\"NotContains\" >NotContains</option>".
		"<option value=\"NotEndsWith\" >NotEndsWith</option>".
		"<option value=\"NotEqual\" >NotEqual</option>".
		"<option value=\"NotStartsWith\" >NotStartsWith</option>".
		"<option value=\"StartsWith\" >StartsWith</option>";


$ACCOUNTID = $_SESSION['ACCOUNTID'];
$EMAIL = $_SESSION['EMAIL'];
$PWD = $_SESSION['PWD'];
$PARTNERGUID = $_SESSION['PARTNERGUID'];
$PARTNERPASSWORD = $_SESSION['PARTNERPASSWORD'];
$ACCOUNNAME = $_SESSION['ACCOUNNAME'];

$ticket = getTicket($ACCOUNTID, $EMAIL, $PWD, $PARTNERGUID, $PARTNERPASSWORD);
$FieldList = GetContactFieldList($TEST, $ticket);


$counter = 1;

function xml_attribute($object, $attribute)
{
    if(isset($object[$attribute]))
        return (string) $object[$attribute];
}


if ($TEST == 't') {
	echo "LISTDEFINITION : $LISTDEFINITION<br>";
}

if ($LISTDEFINITION == '') {
	
} else {

	
	$xml=simplexml_load_string($LISTDEFINITION);
	if ($TEST == 't') {
		var_dump($xml);
		echo "<br>";		
		echo "<br>";		
		echo "<br>";		
		echo "<br>";		
		echo "<br>";			
	}

	foreach ($xml as $elements) {
		$Row = $elements['Row'];
		$Field = $elements['Field'];
		$Operator = $elements['Operator'];
		$Value = $elements['Value'];
		$counter++;

		$OperatorOption = "<option value=\"\" ></option>";
		foreach ($OperatorArray as $strTemp){
			$strTempLower = strtolower($strTemp);
            $arrtmp = strtolower($Operator);					
			if ($arrtmp == $strTempLower) {
				$selected = 'selected';
			} else {
				$selected = '';
			}
			$OperatorOption .=  "<option value=\"$strTemp\" $selected>$strTemp</option>";
        } 
		
		$fieldOption = "<option value=\"\" ></option>";
		for ($i = 0; $i < sizeOf($FieldList); $i++) {
			$strTemp = trim($FieldList[$i]["Name"]);
			$strTempLower = strtolower($strTemp);					
			$arrtmp = strtolower($Field);					
			if ($arrtmp == $strTempLower) {
				$selected = 'selected';
			} else {
				$selected = '';
			}
			$fieldOption .=  "<option value=\"$strTemp\" $selected>$strTemp</option>";
		}

		$tabData .= "<tr>".
			"<td>".$Row."<input type=\"hidden\" name=\"rownumber".$Row."\" id=\"rownumber".$Row." value='".$Row."'\"></td>".
			"<td><select name=\"fieldoption".$Row."\" id=\"fieldoption".$Row."\">".$fieldOption."</select></td>".
			"<td><select name=\"operatoroption".$Row."\" id=\"operatoroption".$Row."\">".$OperatorOption."</select></td>".
			"<td><input type=\"text\" name=\"filtervalue".$Row."\" id=\"filtervalue".$Row."\" value='$Value'></td>".
			"<td><input type=\"button\" value=\"Del\" onclick=\"delRow(this,".$Row.")\"></td>".
			"</tr>";
	}

	$joinrow = xml_attribute($xml, 'CriteriaJoinOperator');
	if ($TEST == 't') {
		echo "joinrow : $joinrow<br>";
	}


}



$JoinOperator = "and";
if ($joinrow == '|') {
	$JoinOperator = "or";
}

$Filter = "<Filter CriteriaJoinOperator=\"$JoinOperator\">$CriteriaRow</Filter>";

echo json_encode( array('success'=>true, 'tabData' => $tabData, 'JoinOperator' => $JoinOperator, 'counter' => $counter));
