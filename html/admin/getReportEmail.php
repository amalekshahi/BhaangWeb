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

	if ($PROGRAMID) {

		$reportURL = "https://studio.dashboard.mdl.io/api/Report//GetAdminReportData?rn=allprogram_allemail_detail&si=$PROGRAMID&ai=$ACCOUNTID&st=0&fd=$fd&td=$td&seed=false&datasourceType=redshift&token=$token";	

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
			$Program = $row1->{'Program'};
			$Email = $row1->{'Email'};
			$Sent = $row1->{'Sent'};
			$Delivered = $row1->{'Delivered'};
			$Opened = $row1->{'Opened'};
			$Clicked = $row1->{'Clicked'};
			$FailedToProcess = $row1->{'FailedToProcess'};
			$HardBounced = $row1->{'HardBounced'};
			$SoftBounced = $row1->{'SoftBounced'};
			$Suppressed = $row1->{'Suppressed'};
			$MarkedAsSpam = $row1->{'MarkedAsSpam'};
			$Unsubscribed = $row1->{'Unsubscribed'};			
			
			$group = array(					
				'Program'=>$Program,
				'Email'=>$Email,
				'Sent'=>$Sent,
				'Delivered'=>$Delivered,
				'Opened'=>$Opened,
				'Clicked'=>$Clicked,
				'FailedToProcess'=>$FailedToProcess,
				'HardBounced'=>$HardBounced,
				'SoftBounced'=>$SoftBounced,
				'Suppressed'=>$Suppressed,
				'MarkedAsSpam'=>$MarkedAsSpam,
				'Unsubscribed'=>$Unsubscribed
			);					
			$rows[] = $group;
			
		}
		$success = true;
		
	} else {
		$success = false;
		$rows = null;
	}
	
	$result = json_encode( array('success'=>$success, 'rows' => $rows, 'reportURL' => $reportURL));
	return $result;

}

$token = getToken($ACCOUNTID, $EMAIL, $PWD);
$result = GetCampaignReport($TEST, $ACCOUNTID, $PROGRAMID, $campaignName, $fd, $td, $token);

echo $result;
