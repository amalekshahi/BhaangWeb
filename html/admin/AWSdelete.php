<?php

require '../vendor/autoload.php';

include 'global.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\Exception\S3Exception;

$client = S3Client::factory(array(
    'credentials' => array(
        'key'    => AWSKEY,
        'secret' => AWSSECRET,
    )
));

echo AWSKEY;
echo "<br>\n";
echo AWSSECRET;
echo "<br>\n";
echo AWSBUCKET;
echo "<br>\n";

$filename = 'eBOOK-f8690893-fe2d-4832-a73c-79535818a9b3.jpg';
$filename = 'xxx.jpg';

echo $filename;
echo "<br>\n";

try {
    $result = $client->deleteObject(array(
	    'Bucket' => AWSBUCKET,
		'Key'    => '/tmp/'.$filename
	));
} catch (S3Exception $e) {
    // Catch an S3 specific exception.
	echo "Catch an S3 specific exception.<br>\n";
    echo $e->getMessage();
} catch (AwsException $e) {
    // This catches the more generic AwsException. You can grab information
    // from the exception using methods of the exception object.
	echo "This catches the more generic AwsException.<br>\n";
    echo $e->getAwsRequestId() . "<br>\n";
    echo $e->getAwsErrorType() . "<br>\n";
    echo $e->getAwsErrorCode() . "<br>\n";
}

// The 'Body' value can be cast to a string
echo "The 'Body' value can be cast to a string<br>\n";
var_dump($result);
echo "<br>\n";

echo "The following objects were deleted successfully:<br>\n";
foreach ($result['Deleted'] as $object) {
    echo "Key: {$object['Key']}, VersionId: {$object['VersionId']}<br>\n";
}

echo "<br>\nThe following objects could not be deleted:<br>\n";
foreach ($result['Errors'] as $object) {
    echo "Key: {$object['Key']}, VersionId: {$object['VersionId']}<br>\n";
}  



$filename = '16916-defButtonColor.html';
$filename = 'xxx.html';

$response = $client->doesObjectExist(AWSBUCKET, '/tmp/'.$filename);

// Success? (Boolean, not a CFResponse object)
echo "doesObjectExist<br>\n";
var_dump($response);
echo "<br>\n";


