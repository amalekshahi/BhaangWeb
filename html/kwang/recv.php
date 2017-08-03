<html>
<?php

require 'vendor/autoload.php';

use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");

//$code = 'Ma3e18db0-3b98-454c-f234-80d139a1d5c0';
$code = $_GET['code'];
//$state = $_GET['state'];

$guzzle = new \GuzzleHttp\Client();
$url = 'https://login.microsoftonline.com/common/oauth2/v2.0/token';
try{
$token = json_decode($guzzle->post($url, [
    'form_params' => [
        'client_id' => '1dd57f07-aac6-47f7-b3af-04d8fc3a6455',
        'client_secret' => 'bO6nQaTZttTTWNSJrPgKNMg',
	'code' => "$code",
        'grant_type' => 'authorization_code',
        'redirect_uri' => 'https://web2xmm.com/kwang/recv.php',
        'scope' => 'user.read mail.read contacts.read',
    ],
])->getBody()->getContents());
}catch(Exception $e){
		echo $e->getMessage();		
}

$accessToken = $token->access_token;

$graph = new Graph();
        $graph->setAccessToken($accessToken);

        try{
        $user = $graph->createRequest("GET", "/me")
                      ->setReturnType(Model\User::class)
                      ->execute();
	}catch(Exception $e){
		echo $e->getMessage(), "<br>";		
	}
echo "Contacts<br>";
	try{
            $contacts = $graph->createRequest("GET", "/me/contacts")
                      ->setReturnType(Model\Contact::class)
                      ->execute();
		for($x=0;$x<count($contacts);$x++)
  		{
  			echo json_encode($contacts[$x]);
  			echo "<br>";
  		}
		print_r($contacts);
	}catch(Exception $e){
		echo $e->getMessage(), "<br>";		
	}
?>
code=<?php echo $code ?><br>
token=<?php echo $accessToken ?><br>
me.GivenName=<?php echo $user->getGivenName() ?><br>
<?php var_dump($user) ?><br>
<?php var_dump($token) ?><br>
<?php var_dump($contacts) ?><br>
</html>
