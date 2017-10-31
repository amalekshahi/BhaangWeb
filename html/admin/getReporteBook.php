<?php
ini_set("memory_limit","-1");
set_time_limit(0);
date_default_timezone_set('UTC');
session_start();
require_once 'commonUtil.php';

$campaignName = $_GET['campaignName'];
$PROGRAMID = $_GET['programID'];
$fd = $_GET['fd'];
$td = $_GET['td'];
//$campaignName = 'coatest-blog-101003';
//$campaignName = 'coatest-ebook-092502';
$TEST = $_GET['test'];

$ACCOUNTID = $_SESSION['ACCOUNTID'];
$EMAIL = $_SESSION['EMAIL'];
$PWD = $_SESSION['PWD'];

//echo "$ACCOUNTID<br>";


function GetCampaignReport($TEST, $ACCOUNTID, $PROGRAMID, $campaignName, $fd, $td, $token){	
	$download = '0';
	$welcome = '0';
	$Reach = '0';
	$conversion = '0';

	if ($PROGRAMID) {

		$reportURL = "https://studio.dashboard.mdl.io/api/Report//GetAdminReportData?rn=allprogram_allmspagesl_summary&si=$PROGRAMID&ai=$ACCOUNTID&st=0&fd=$fd&td=$td&seed=false&datasourceType=redshift&token=$token";	

		$ch = curl_init($reportURL);

		//curl_setopt($ch, CURLOPT_MUTE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$rows = curl_exec($ch);

		curl_close($ch);
			//var_dump($rows);
			//echo "<br>";
		$jsonRow = json_decode($rows);
			//var_dump($jsonRow);
			//echo "<br>";
		$rows = array();
		
		foreach( $jsonRow as $row1 ) {	
			//var_dump($row1);
			//echo "<br>";			
			$Page = $row1->{'Page'};
			$Visitors = $row1->{'Visitors'};
			$Submits = $row1->{'Submits'};
			$Clicks = $row1->{'Clicks'};
			$Responses = $row1->{'Responses'};		
			$PageUpper = strtoupper($Page);
			if ($PageUpper == 'WELCOME.HTML') {
				$orderid = '1';
				$welcome = $Visitors;
			} else if ($PageUpper == 'DOWNLOAD.HTML') {
				$orderid = '2';
				$download = $Clicks;
			} else {
				$orderid = '3';
			}
			

			//Reach should be visitors and % conversion should be Clicks on download.html divided by visits to Welcome.html

			$group = array(					
				'orderid'=>$orderid,
				'Page'=>$Page,
				'Visitors'=>$Visitors,
				'Submits'=>$Submits,
				'Clicks'=>$Clicks,
				'Responses'=>$Responses
			);					
			$rows[] = $group;
			
		}
		$success = true;
		
	} else {
		$success = false;
		$rows = null;
	}
	
	if ( ($download!=0) && ($welcome!=0) ) {
		$Reach = $welcome;
		if ($welcome!=0) {
			//$download = 2; $welcome = 3;
			$conversion = ($download * 100) / $welcome;
			$conversion = round($conversion, 2);
		} else {
			$conversion = '0.00';
		}
	}
	
	$result = json_encode( array('success'=>$success, 'rows' => $rows, 'Reach' => $Reach, 'conversion' => $conversion, 'download' => $download, 'welcome' => $welcome));
	return $result;

}

$token = getToken($ACCOUNTID, $EMAIL, $PWD);
$result = GetCampaignReport($TEST, $ACCOUNTID, $PROGRAMID, $campaignName, $fd, $td, $token);

echo $result;
