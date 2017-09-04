<html>
<?php

require '/var/www/html/vendor/autoload.php';

include 'global.php';

use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
//ini_set("log_errors", 1);
//ini_set("error_log", "/tmp/php-error.log");

//$code = 'Ma3e18db0-3b98-454c-f234-80d139a1d5c0';
$code = $_GET['code'];
//$state = $_GET['state'];

$test = $_GET['test'];


define("TEST", $test);
		

if (TEST == 't') {
	echo $code;
	echo "<br>";
}

$guzzle = new \GuzzleHttp\Client();
$url = 'https://login.microsoftonline.com/common/oauth2/v2.0/token';
try{
$token = json_decode($guzzle->post($url, [
    'form_params' => [
        'client_id' => '1dd57f07-aac6-47f7-b3af-04d8fc3a6455',
        'client_secret' => 'bO6nQaTZttTTWNSJrPgKNMg',
	'code' => "$code",
        'grant_type' => 'authorization_code',
        'redirect_uri' => 'https://web2xmm.com/admin/recvMScontact.php',
        'scope' => 'user.read mail.read contacts.read',
    ],
])->getBody()->getContents());
}catch(Exception $e){
	if (TEST == 't') {
		echo $e->getMessage();		
	}
}

if (TEST == 't') {
	echo "token<br>";
	var_dump($token);
  	echo "<br>";
	echo "<br>";
	echo "<br>";
}

$accessToken = $token->access_token;

$contactArray = array();
$name = "";
$email = "";
$contact = "";


$graph = new Graph();
	$graph->setAccessToken($accessToken);

	try{
	$user = $graph->createRequest("GET", "/me")
				  ->setReturnType(Model\User::class)
				  ->execute();
}catch(Exception $e){
	if (TEST == 't') {
		echo $e->getMessage(), "<br>";		
	}
}
if (TEST == 't') {
	echo "Contacts<br>";
}
try{
		$contacts = $graph->createRequest("GET", "/me/contacts")
				  ->setReturnType(Model\Contact::class)
				  ->execute();			
		

		for($x=0;$x<count($contacts);$x++) {
			
			$c = $contacts[$x];

			$displayName = $c->getDisplayName();
			$email = $c->getEmailAddresses();
			

			$pieces = explode(" ", $displayName);
			$size = sizeof($pieces);
			if (TEST == 't') {
				echo "displayName = $displayName <br>\n";
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

			if ($email != '') {
				$contactArray[] = array($firstname, $lastname, $email);
				$contact .= '"'.$firstname.'","'.$lastname.'","'.$email.'"'."\n";
			}

		}

		

	
}catch(Exception $e){
	if (TEST == 't') {
		echo $e->getMessage(), "<br>";		
	}
}


$recordCount = sizeof($contactArray);

$importTime = date("YmdHis");
$errorMessage = '';

if ($contact != '') {
	$contact = '"firstname","lastname","email"'."\n".$contact;
	$Mapping = "[firstname][firstname];[lastname][lastname];[email][email]";
	
	$FileName = $importTime.".csv";

	$importName = "microsoft".$importTime;

	$file = IMPORTPATH."microsoft/".$FileName;
	
	file_put_contents($file, $contact);

	$ticket = getTicket(ACCOUNTID, EMAIL, PWD, PARTNERGUID, PARTNERPASSWORD);
	

	$errorMessage = ImportContacts($FileName, $Mapping, $importName, $ticket, EMAIL, $file, $recordCount, 'microsoft', ACCOUNNAME);

	if (TEST == 't') {
		echo "file : $file<br>\n";
		echo "ticket : $ticket<br>\n";
		echo "errorMessage : $errorMessage<br>\n";
	}
}
if (TEST == 't') {
	echo "======================<br>\n";
	var_dump($contact);
	echo "======================<br>\n";
}

?>
<!-- code=<?php echo $code ?><br>
token=<?php echo $accessToken ?><br>
me.GivenName=<?php echo $user->getGivenName() ?><br>
<?php var_dump($user) ?><br>
<?php var_dump($token) ?><br>
<?php var_dump($contacts) ?><br> -->
<br> record : <?php echo $recordCount ?><br>

</html>
