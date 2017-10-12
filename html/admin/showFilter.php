<?php
date_default_timezone_set('UTC');
session_start();
require_once 'commonUtil.php';



$joinrow = $_GET['joinrow'];
$itemCount = $_GET['itemCount'];
$LISTDEFINITION = $_GET['LISTDEFINITION'];
$TEST = $_GET['test'];
$tabData = "";

$OperatorArray = Array("Equal","NotEqual","After","AfterEqual","Before","BeforeEqual","Contains","NotContains","StartsWith","NotStartsWith","EndsWith","NotEndsWith");

$OperatorTextArray = Array("Is","Is not","Greater than","Greater than or equal to","Less than","Less than or equal to","Contains","Does not contain","Starts with","Does not start with","Ends with","Does not end with");




/*
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
*/


$OperatorOption = 
		"<option value=\"\" ></option>".
		"<option value=\"Equal\" >Is</option>".
		"<option value=\"NotEqual\" >Is not</option>".
		"<option value=\"After\" >Greater than</option>".
		"<option value=\"AfterEqual\" >Greater than or equal to</option>".
		"<option value=\"Before\" >Less than</option>".
		"<option value=\"BeforeEqual\" >Less than or equal to</option>".
		"<option value=\"Contains\" >Contains</option>".
		"<option value=\"NotContains\" >Does not contain</option>".
		"<option value=\"StartsWith\" >Starts with</option>".
		"<option value=\"NotStartsWith\" >Does not start with</option>".
		"<option value=\"EndsWith\" >Ends with</option>".
		"<option value=\"NotEndsWith\" >Does not end with</option>";

$ACCOUNTID = $_SESSION['ACCOUNTID'];
$EMAIL = $_SESSION['EMAIL'];
$PWD = $_SESSION['PWD'];
$PARTNERGUID = $_SESSION['PARTNERGUID'];
$PARTNERPASSWORD = $_SESSION['PARTNERPASSWORD'];
$ACCOUNNAME = $_SESSION['ACCOUNNAME'];

$ticket = getTicket($ACCOUNTID, $EMAIL, $PWD, $PARTNERGUID, $PARTNERPASSWORD);
$FieldList = GetContactFieldList($TEST, $ticket);


$counter = 1;
$CriteriaJoinOperator = "";



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

	$joinrow = xml_attribute($xml, 'CriteriaJoinOperator');
	if ($TEST == 't') {
		echo "joinrow : $joinrow<br>";
	}
	$JoinOperator = "and";
	$JoinOp = "&amp;";
	if ($joinrow == '|') {
		$JoinOperator = "or";
		$JoinOp = "|";
	}

	$array0=object2array($xml); 
	if ($TEST == 't') {
		echo "filterArray<br>";
		var_dump($array0);
		echo "<br>";		
		echo "<br>";		
		echo "<br>";		
		echo "<br>";		
		echo "<br>";
	}

	foreach ($array0 as $array1) {
		if ($TEST == 't') {
			echo "array1<br>";
			var_dump($array1);
			echo "<br>=============<br>";	
		}

		foreach ($array1 as $array2) {
			if ($TEST == 't') {
				echo "array2<br>";
				var_dump($array2);
				echo "<br>=============<br>";	
			}

			if (array_key_exists('Row', $array2)) {
				if ($TEST == 't') {
					echo "Row is in array2....<br><br><br>";  
				}
				$array3 = $array2;
				$Row = $array3{'Row'};
				$Field = $array3['Field'];
				$Operator = $array3['Operator'];
				$Value = $array3['Value'];
				$array3['JoinOperator'] = $JoinOperator;
				$CriteriaJoinOperator .= $counter.$JoinOp;
				$counter++;
				if ($TEST == 't') {
					echo "Row: $Row <br>";
					echo "Field: $Field <br>";
					echo "Operator: $Operator <br>";
					echo "Value: $Value <br>";
					
				}
				$OperatorOption = "<option value=\"\" ></option>";
				for ($i = 0; $i < sizeOf($OperatorArray); $i++) {
				//foreach ($OperatorArray as $strTemp){
					$strTemp = $OperatorArray[$i];
					$textTemp = $OperatorTextArray[$i];
					$strTempLower = strtolower($strTemp);
					$arrtmp = strtolower($Operator);					
					if ($arrtmp == $strTempLower) {
						$selected = 'selected';
					} else {
						$selected = '';
					}
					$OperatorOption .=  "<option value=\"$strTemp\" $selected>$textTemp</option>";
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
					"<td><select name=\"operatoroption".$Row."\" id=\"operatoroption".$Row."\" style=\"width: 200px;\">".$OperatorOption."</select></td>".
					"<td><input type=\"text\" name=\"filtervalue".$Row."\" id=\"filtervalue".$Row."\" value='$Value'></td>".
					"<td><input type=\"button\" value=\"Delete\" onclick=\"delRow(this,".$Row.")\"></td>".
					"</tr>";

				

				$filterArray[] = $array3;
			} else {
				if ($TEST == 't') {
					echo "Row is not in array2....<br><br><br>";  
				}
				foreach ($array2 as $array3) {
					if ($TEST == 't') {
						echo "array3<br>";
						var_dump($array3);
						echo "<br>=============<br>";	
					}
					$Row = $array3{'Row'};
					$Field = $array3['Field'];
					$Operator = $array3['Operator'];
					$Value = $array3['Value'];
					$array3['JoinOperator'] = $JoinOperator;
					$CriteriaJoinOperator .= $counter.$JoinOp;
					$counter++;
					if ($TEST == 't') {
						echo "Row: $Row <br>";
						echo "Field: $Field <br>";
						echo "Operator: $Operator <br>";
						echo "Value: $Value <br>";
						
					}
					$OperatorOption = "<option value=\"\" ></option>";
					for ($i = 0; $i < sizeOf($OperatorArray); $i++) {
						//foreach ($OperatorArray as $strTemp){
						$strTemp = $OperatorArray[$i];
						$textTemp = $OperatorTextArray[$i];
						$strTempLower = strtolower($strTemp);
						$arrtmp = strtolower($Operator);					
						if ($arrtmp == $strTempLower) {
							$selected = 'selected';
						} else {
							$selected = '';
						}
						$OperatorOption .=  "<option value=\"$strTemp\" $selected>$textTemp</option>";
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
						"<td><select name=\"fieldoption".$Row."\" id=\"fieldoption".$Row."\" >".$fieldOption."</select></td>".
						"<td><select name=\"operatoroption".$Row."\" id=\"operatoroption".$Row."\" style=\"width: 200px;\">".$OperatorOption."</select></td>".
						"<td><input type=\"text\" name=\"filtervalue".$Row."\" id=\"filtervalue".$Row."\" value='$Value'></td>".
						"<td><input type=\"button\" value=\"Delete\" onclick=\"delRow(this,".$Row.")\"></td>".
						"</tr>";

					$filterArray[] = $array3;
				}
			}		
			
		}
	}	
}



$l1 = strlen($CriteriaJoinOperator);
$l2 = strlen($JoinOp);

//$Filter = "<Filter CriteriaJoinOperator=\"$JoinOperator\">$CriteriaRow</Filter>";
if ($TEST == 't') {
	echo "1 CriteriaJoinOperator : $CriteriaJoinOperator<br>";
	echo "1 strlen : $l1, $l2<br>";
}

$CriteriaJoinOperator = substr($CriteriaJoinOperator, 0, 0-$l2);

if ($TEST == 't') {
	echo "2 CriteriaJoinOperator : $CriteriaJoinOperator<br>";
}

echo json_encode( array('success'=>true, 'tabData' => $tabData, 'JoinOperator' => $JoinOperator, 'counter' => $counter, 'filterArray' => $filterArray, 'CriteriaJoinOperator' => $CriteriaJoinOperator));
