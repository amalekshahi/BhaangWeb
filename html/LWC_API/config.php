<?php
 
// It's best to copy the API to your project's root directory.
// Set this to your project's root directory.
define('ROOTDIR', 'LWC_API/');

require_once(ROOTDIR.'com/MindFireInc/LookWhosClicking/class.LWC.php');
require_once(ROOTDIR.'com/MindFireInc/Database/class.DB.php');
//require_once(ROOTDIR.'libs/phpmailer/class.phpmailer-lite.php');

// Change setting for each campaign.
LWC::API_KEY('RC8DZJKAVEQX3HSW');
LWC::CLIENT_ID(327);
LWC::CAMPAIGN_ID(CAMPAIGN_ID);
LWC::WSDL('http://cd.lwcdirect.com/services/LWC?wsdl');
// Outputs debugging info to the screen.
LWC::Debug(false);

// The API uses this to log errors for debugging.
// Helpful to include in your own code.
Log::loggingLevel(LOG::LEVEL_ERROR);
Log::logDirPath(ROOTDIR.'logs/');



