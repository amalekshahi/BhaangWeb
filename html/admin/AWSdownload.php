<?php

require '/var/www/html/vendor/autoload.php';

include 'global.php';

use Aws\S3\S3Client;

$client = S3Client::factory(array(
    'credentials' => array(
        'key'    => AWSKEY,
        'secret' => AWSSECRET,
    )
));


$filename = '20170802023151.txt';

// Get an object using the getObject operation
$result = $client->getObject(array(
    'Bucket' => AWSBUCKET,
    'Key'    => '/tmp/'.$filename,
));


// The 'Body' value can be cast to a string
echo $result['Body'] . "\n";
