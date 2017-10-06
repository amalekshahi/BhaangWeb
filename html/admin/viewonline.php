<?php
    date_default_timezone_set('UTC');
    
	require '../vendor/autoload.php';

    include 'global.php';
    $inputFile = $_GET['inputFile'];
	//$inputFile = "https://bkktest.s3.amazonaws.com/tmp/TEXT-AREA-16916-21e0a8487d1f66b365b9d664ac04b2d1-EMAIL1CONTENT.html";
	//echo "inputFile : $inputFile<br>";

	use Aws\S3\S3Client;

	$client = S3Client::factory(array(
		'credentials' => array(
			'key'    => AWSKEY,
			'secret' => AWSSECRET,
		)
	));


	//$filename = 'TEXT-AREA-16916-eaabb37a10b772779f4c90a8bef4bd8b-EMAIL1CONTENT.html';
	$filename = basename($inputFile);

	//echo "filename : $filename<br>";


	$client->registerStreamWrapper();

	$keyname = 's3://'.AWSBUCKET.'/tmp/'.$filename;

	//echo "keyname : $keyname<br>";

	// Download the body of the "key" object in the "bucket" bucket
	$s3Content = file_get_contents($keyname);
	$s3Content = str_replace("<tr id=\"viewonlineRow\">", "<tr id=\"viewonlineRow\" style=\"display: none;\">", $s3Content);


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <title></title>
  <meta name="Generator" content="EditPlus">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  
 </head>

 <body>
  <?php echo $s3Content; ?>   
 </body>
</html>
