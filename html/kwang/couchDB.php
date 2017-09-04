<?php
//phpinfo();

if (isset($_GET["path"])) {
	$path = $_GET["path"];
}else{ 
	$path = ""; 
}
$ch = curl_init();


//echo var_dump($ch) . "\n"; 
curl_setopt($ch, CURLOPT_URL, 'http://localhost:5984/' . $path);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-type: application/json',
	'Accept: */*'
));

$response = curl_exec($ch);
if (curl_errno ( $ch )) {
    echo "[" . curl_error ( $ch ) . "]";
    curl_close ( $ch );
    exit ();
}
curl_close($ch);
echo $response;
?>
