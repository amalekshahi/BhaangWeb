<?php

require '/var/www/html/vendor/autoload.php';

use Aws\S3\S3Client;




$client = S3Client::factory(array(
    'credentials' => array(
        'key'    => 'AKIAI6F2I2ZMHWIA4E7A',
        'secret' => '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',
    )
));


/*
// Get the client from the builder by namespace
$client = $aws->get('S3');
*/


$result = $client->listBuckets();

foreach ($result['Buckets'] as $bucket) {
    // Each Bucket value will contain a Name and CreationDate
    echo "{$bucket['Name']} - {$bucket['CreationDate']}\n";
}


/*


// Upload an object by streaming the contents of a file
// $pathToFile should be absolute path to a file on disk
$result = $client->putObject(array(
    'Bucket'     => $bucket,
    'Key'        => 'data_from_file.txt',
    'SourceFile' => $pathToFile,
    'Metadata'   => array(
        'Foo' => 'abc',
        'Baz' => '123'
    )
));

// We can poll the object until it is accessible
$client->waitUntil('ObjectExists', array(
    'Bucket' => $this->bucket,
    'Key'    => 'data_from_file.txt'
));

*/