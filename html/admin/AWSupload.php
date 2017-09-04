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

$client->registerStreamWrapper();


$data = date("YmdHis");
$filename = "$data.txt";
$SourceFile = AWSPATH.$filename;
file_put_contents($SourceFile, $data);
echo "$SourceFile<br>\n";


$keyname = 's3://'.AWSBUCKET.'/tmp/'.$filename;
$stream = fopen($keyname, 'x');
fwrite($stream, $data);
fclose($stream);

/*
$result = $client->listBuckets();
foreach ($result['Buckets'] as $bucket) {
    // Each Bucket value will contain a Name and CreationDate
    echo "{$bucket['Name']} - {$bucket['CreationDate']}<br>\n";
}
*/


// Upload an object by streaming the contents of a file
// $pathToFile should be absolute path to a file on disk


/*
$data = date("YmdHis");
$EMAIL = $_SESSION['EMAIL'];

$filename = "$data.txt";

$SourceFile = AWSPATH.$filename;
file_put_contents($SourceFile, $data);
echo "$SourceFile<br>\n";




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
*/



