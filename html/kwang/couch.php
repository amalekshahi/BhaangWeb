<?php

require 'vendor/autoload.php';

$client = new CouchPHP\Client('http://127.0.0.1:5984/', 'bhaang');
var_dump($client);

for( $x = 0 ; $x < 10 ; $x++ ) {
	$doc  = new CouchPHP\Document(array(
		'schema' => 'test',
		'value' => 1234,
	));
	$doc->insert();
}

?>
