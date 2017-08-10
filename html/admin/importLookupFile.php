<?php
ini_set('upload_max_filesize', '50MB');

date_default_timezone_set('America/Los_Angeles');
set_time_limit(600);

require_once('class.uploader.php');




include 'global.php';


$message = '';







$upload = new Uploader(ROOT_DIR.'mailFiles');

$upload->upload();

if( !$upload->isValid() ) {
	$message = '<span style="color:red">' .implode('<br>', $upload->getMessages() ). '</span>';
} else {
	$fileInfo = $upload->getUpload()->getFileInfo();
	$fileName = $fileInfo['fileUpload']['name'];
	$filePath = ROOT_DIR.'mailFiles/'.$fileName;
	

	$delimiter = ',';
	
	$message = $rowCount .' files were imported and updated into the '.$listName.' ['.$uploadType.'].';	

	
}





?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Upload Result :: NSM Leads</title>
<link rel="stylesheet" type="text/css" href="admin.css">
</head>

<body>

<div class="frame">
	<div class="results">
		<h2>Logic Upload Results</h2>
		<p><?php echo $message; ?></p>
		<p>Your file has been loaded to the server. Depending on your file size, it may not take many minutes due to additional data verification. When the verification is complete, you will receive an email with results. You can also view the status of your uploads by clicking the link below.</p>
	    <p>&nbsp;</p>
	    <p><a href="uploaderLookup.php">Upload another Logic...</a></p>
    </div>
</div>


</body>
</html>
