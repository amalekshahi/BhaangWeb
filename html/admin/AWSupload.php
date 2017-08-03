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


/*
$result = $client->listBuckets();
foreach ($result['Buckets'] as $bucket) {
    // Each Bucket value will contain a Name and CreationDate
    echo "{$bucket['Name']} - {$bucket['CreationDate']}<br>\n";
}
*/


// Upload an object by streaming the contents of a file
// $pathToFile should be absolute path to a file on disk

$data = date("YmdHis");
$EMAIL = $_SESSION['EMAIL'];

$filename = "$data.txt";

$SourceFile = AWSPATH.$filename;
file_put_contents($SourceFile, $data);

$result = $client->putObject(array(
    'Bucket'     => AWSBUCKET,
    'Key'        => '/tmp/'.$filename,
    'SourceFile' => $SourceFile,
	'ACL'		 => 'public-read',
    'Metadata'   => array(
        'uploader' => $EMAIL
    )
));

echo $result['ObjectURL'] . "<br>\n";

echo "$SourceFile<br>\n";

