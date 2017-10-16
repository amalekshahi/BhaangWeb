<?php
date_default_timezone_set('UTC');
session_start();
require_once 'commonUtil.php';



$email = $_GET['email'];
$result = ForgotPassword("", $email);

echo $result;
