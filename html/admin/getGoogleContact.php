<?php

include 'global.php';

$callback = @$_GET['callback'];
$access_token = $_GET['access_token'];
$TEST = $_GET['test'];



if ($TEST == 't') {
	echo $access_token;
	echo "<br>";
}

$url = "https://www.google.com/m8/feeds/contacts/default/full?access_token=$access_token&alt=json";

$fileContent = file_get_contents($url);

$arr = (array) json_decode($fileContent, true);

$contactArray = array();
$name = "";
$email = "";
$contact = "";

foreach ($arr as $k=>$v){    
	foreach ($v as $k1=>$v1){
		if ($k1 == 'entry') {
			$name = "";
			$email = "";	
			
			foreach ($v1 as $k2=>$v2){
				foreach ($v2 as $k3=>$v3){
					if ($k3 == 'title') {
						foreach ($v3 as $k4=>$v4){

							$firstname == "";
							$lastname == "";
							if ($k4 == '$t') {
								$name = $v4;								
								$pieces = explode(" ", $name);
								$size = sizeof($pieces);
								if ($TEST == 't') {
									echo "name = $name <br>\n";
									echo "size = $size <br>\n";
									var_dump($pieces);
									echo "<br>\n";									
								}
								if ($size == 2) {
									$firstname = $pieces[0];
									$lastname = $pieces[1];
								} else if ($size == 1) {
									$firstname = $pieces[0];
									$lastname == "";
								} else {
									$firstname == "";
									$lastname == "";
								}
							}
						}
					} else if ($k3 == 'gd$email') {
						foreach ($v3 as $k4=>$v4){
							foreach ($v4 as $k5=>$v5){
								if ($k5 == 'address') {
									$email = $v5;
								} if ($k5 == 'primary') {
									$primary = $v5;
								}
							}
						}
					}
					
				}
				if ($primary == '') {
					$contactArray[] = array($firstname, $lastname, $email);
					$contact .= '"'.$firstname.'","'.$lastname.'","'.$email.'"'."\n";
				}
				$firstname = "";
				$lastname = "";
				$email = "";
				$primary = "";
			}			
		}
	}
}

$recordCount = sizeof($contactArray);

$importTime = date("YmdHis");
$errorMessage = '';

if ($contact != '') {
	$contact = '"firstname","lastname","email"'."\n".$contact;
	$Mapping = "[firstname][firstname];[lastname][lastname];[email][email]";
	
	$FileName = $importTime.".csv";

	$importName = "google_".$importTime;

	$file = IMPORTPATH."google/".$FileName;
	
	file_put_contents($file, $contact);

	$ACCOUNTID = $_SESSION['ACCOUNTID'];
	$EMAIL = $_SESSION['EMAIL'];
	$PWD = $_SESSION['PWD'];
	$PARTNERGUID = $_SESSION['PARTNERGUID'];
	$PARTNERPASSWORD = $_SESSION['PARTNERPASSWORD'];
	$ACCOUNNAME = $_SESSION['ACCOUNNAME'];

	$ticket = getTicket($ACCOUNTID, $EMAIL, $PWD, $PARTNERGUID, $PARTNERPASSWORD);
	

	$errorMessage = ImportContacts($TEST, $FileName, $Mapping, $importName, $ticket, $EMAIL, $file, $recordCount, 'google', $ACCOUNNAME);

	if ($TEST == 't') {
		echo "file : $file<br>\n";
		echo "ticket : $ticket<br>\n";
		echo "errorMessage : $errorMessage<br>\n";
	}
}
if ($TEST == 't') {
	echo "======================<br>\n";
	var_dump($contact);
	echo "======================<br>\n";
}
echo $callback, '(', json_encode( array(
        'success'       => true,
        'message'       => $errorMessage,
		'recordCount'	=> $recordCount
    )), ')';

