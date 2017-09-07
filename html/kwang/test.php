<?php
require 'vendor/autoload.php';

use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
//COA
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");
error_log( "Hello, errors!" );

	echo "My PHP\n";

$tenantId = 'common';
$guzzle = new \GuzzleHttp\Client();
$url = 'https://login.microsoftonline.com/' . $tenantId . '/oauth2/token?api-version=1.0';
$token = json_decode($guzzle->post($url, [
    'form_params' => [
        'client_id' => '1dd57f07-aac6-47f7-b3af-04d8fc3a6455',
        'client_secret' => 'bO6nQaTZttTTWNSJrPgKNMg',
        'resource' => 'https://graph.microsoft.com/',
        'grant_type' => 'client_credentials',
	'redirect_uri' => 'http://localhost:8000/oauth.php',
	'scope' => 'user.read mail.read',
    ],
])->getBody()->getContents());

$accessToken = $token->access_token;

	echo "accessToken= $accessToken\n";
        $graph = new Graph();
        $graph->setAccessToken($accessToken);

        $user = $graph->createRequest("GET", "/me")
                      ->setReturnType(Model\User::class)
                      ->execute();

        echo "Hello, I am $user->getGivenName() ";
?>
