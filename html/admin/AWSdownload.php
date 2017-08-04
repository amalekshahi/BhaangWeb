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


$client->registerStreamWrapper();

$keyname = 's3://'.AWSBUCKET.'/tmp/'.$filename;

// Download the body of the "key" object in the "bucket" bucket
$data = file_get_contents($keyname);
echo "file_get_contents<br>\n";
echo "$data<br>\n";

echo "fread<br>\n";



// Open a stream in read-only mode
if ($stream = fopen($keyname, 'r')) {
    // While the stream is still open
    while (!feof($stream)) {
        // Read 1024 bytes from the stream
        echo fread($stream, 1024);
    }
    // Be sure to close the stream resource when you're done with it
    fclose($stream);
}

/*
// Get an object using the getObject operation
$result = $client->getObject(array(
    'Bucket' => AWSBUCKET,
    'Key'    => '/tmp/'.$filename,
));


// The 'Body' value can be cast to a string
echo $result['Body'] . "\n";
*/