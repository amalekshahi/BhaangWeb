<?php

require_once '../vendor/autoload.php';
require_once 'global.php';


use Aws\S3\S3Client;



$s3 = S3Client::factory(array(
    'key'    => AWSKEY,
    'secret' => AWSSECRET
));


$bucket = AWSBUCKET;

$objects = $s3->getListObjectsIterator(array(
    "Bucket" => $bucket,
	"Prefix" => "tmp/1809/prod/"
));

foreach ($objects as $object) {
    echo $object['Key'] . "<br>";
}


?>