<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


$callback = @$_GET['callback'];

$cid = @$_GET['cid'];
$test = @$_GET['test'];
$resID = @$_GET['resID'];
$lastSSN = @$_GET['lastSSN'];
$accountNum = @$_GET['accountNum'];
$mode = @$_GET['mode']; // 'resid' or 'acctno'


if ($test == 't') {
	echo "test<br>\n";
}

$mode = strtolower($mode);
if ($mode == 'resid') {
	if ($resID == '') {
		if ($test == 't') {
			echo "blank resID<br>\n";
		}
		echo $callback, '(', json_encode(array('password'=>'notfound')) ,')';
		exit;
	}
} else if ($mode == 'acctno') {
	if ($accountNum == '') {
		if ($test == 't') {
			echo "blank acctno<br>\n";
		}
		echo $callback, '(', json_encode(array('password'=>'notfound')) ,')';
		exit;
	}
} else {
	if ($test == 't') {
		echo "blank data<br>\n";
	}
	echo $callback, '(', json_encode(array('password'=>'notfound')) ,')';
	exit;
}

define('CAMPAIGN_ID', $cid);

require_once('LWC_API/config.php');

$query = Query::Build();

if ($mode == 'acctno') {
	if ($accountNum != '') {
		$query = $query->andProp(ProspectProps::CUSTOM_02, $accountNum);
	}
} else {
	if ($resID != '') {
		$query = $query->andProp(ProspectProps::CUSTOM_01, $resID);
		$query = $query->andProp(ProspectProps::CUSTOM_04, $lastSSN);
	}
}

$props = new ProspectProps(ProspectProps::PASSWORD);
$props->add(ProspectProps::CUSTOM_13);
$props->add(ProspectProps::CUSTOM_02);
$prospect = Prospect::Get($query, $props, false, false);

if( !$prospect ) {
	echo $callback, '(', json_encode(array('password'=>'notfound')) ,')';
	exit;
}

$password = $prospect->getPassword();
$custom13 = $prospect->getCustom13();
$custom02 = $prospect->getCustom02();


echo $callback, '(', json_encode(array('password'=>$password)) ,')';

