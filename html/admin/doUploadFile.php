<?php
date_default_timezone_set('America/Los_Angeles');
session_start();
require_once 'commonUtil.php';

    /*
        Apache will use /tmp/systemtmp-xxxx as /tmp
        So, php in apache can not access real /tmp
    */
    //print_r($_FILES);
	$message = "";
	$ticket = "";
	$TEST = "";
	$FieldList = array();
	$headerdiv = "";
	$tmpName = "";
	if(!empty($_FILES['file']['name'])){
        $uploadFilename = $_FILES['file']['name'];
        $ext = pathinfo($uploadFilename, PATHINFO_EXTENSION);
        $meta = $_POST;
        $imgSrc = "";
        $sourceFile = $_FILES['file']['tmp_name'];
        $filename = basename($sourceFile) . ".$ext";
        if(!empty($meta['fileName'])){
            $providedFileName = $meta['fileName'];
            $filename = $providedFileName . ".$ext";
        }
        if($imgSrc == ""){
            //$value = file_get_contents($sourceFile);

			$t = date("mdY-His",time());
			$tmpName = $t.'_'.$uploadFilename;
			$filename = IMPORTPATH.'importFile/'.$tmpName;

			if (!copy($sourceFile, $filename)) {
				$message =  "failed to copy $sourceFile to $filename...<br>";
				echo json_encode( array('success'=>false, 'message' => $message));
				exit;
			}
			$rows = file($sourceFile);
			$str = $rows[0];
			$headerValue = $str;

			$arr = explode(",", $str); 
			
			$delimiter = ",";

			//echo "delimiter:$delimiter<br>";		

			$ACCOUNTID = $_SESSION['ACCOUNTID'];
			$EMAIL = $_SESSION['EMAIL'];
			$PWD = $_SESSION['PWD'];
			$PARTNERGUID = $_SESSION['PARTNERGUID'];
			$PARTNERPASSWORD = $_SESSION['PARTNERPASSWORD'];
			$ACCOUNNAME = $_SESSION['ACCOUNNAME'];

			$ticket = getTicket($ACCOUNTID, $EMAIL, $PWD, $PARTNERGUID, $PARTNERPASSWORD);
			

			$FieldList = GetContactFieldList($TEST, $ticket);
			$fieldOption = "";
			$headerdiv = "";
			$itemCount = sizeOf($arr);
			
			
			$line1 = "";
			$line2 = "";
			for ($j = 0; $j < $itemCount; $j++) {
				$arrtmp = strtolower(trim($arr[$j]));
				$line1 .= "<td>".trim($arr[$j])."</td>";
				$line2 .= "<td><select name=\"fieldoption$j\" id=\"fieldoption$j\">";
				$fieldOption = "<option value=\"\" >Skip</option>";
				for ($i = 0; $i < sizeOf($FieldList); $i++) {
					$strTemp = trim($FieldList[$i]["Name"]);
					$strTempLower = strtolower($strTemp);					
					if ($arrtmp == $strTempLower) {
						$selected = 'selected';
					} else {
						$selected = '';
					}
					$fieldOption .=  "<option value=\"$strTemp\" $selected>$strTemp</option>";
				}
				$line2 .= $fieldOption."</select></td>";	
			}
			$headerdiv = "
			<table id=\"headertable\">
				<tr>".$line1."</tr>
				<tr>".$line2."</tr>
			</table>";
            
        }

        echo json_encode( 
            array(
                'success'=>true,
                'fileName'=>$filename,
                'imgSrc' => $imgSrc,
				'message' => $message,
				'tmpName' => $tmpName,
				'headerdiv' => $headerdiv,
				'itemCount' => $itemCount,
				'headerValue' => $headerValue
            )
        );
	}else{
        echo json_encode( array('success'=>false, 'message' => $message));
    }
?>

