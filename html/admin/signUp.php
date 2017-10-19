<?php
    date_default_timezone_set('UTC');
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');    
    $dbName = $_SESSION['DBNAME'];
		$accountID = $_SESSION['ACCOUNTID'];
    $accountName = $_SESSION['ACCOUNNAME'];
		$gates = $_SESSION['GATES'];
?>
	<!DOCTYPE html>
	<html ng-app="myApp" style="height: 100%">

	<head>
		<?php include "header.php"; ?>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/angularjs-color-picker/3.4.8/angularjs-color-picker.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/angularjs-color-picker/3.4.8/themes/angularjs-color-picker-bootstrap.css" rel="stylesheet">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tinycolor/1.4.1/tinycolor.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/angularjs-color-picker/3.4.8/angularjs-color-picker.js"></script>
		</head>

	<body style="height: 100%">
		<script>
			//Kwang create myAPP here so all step can access it.
			var dbName = "<?php echo $dbName; ?>";
			var accountID = "<?php echo $accountID; ?>";
			var myApp = angular.module('myApp', ['ngFileUpload', 'davinci', 'localytics.directives','color.picker']);
		</script>

    <div class="row" style="height: 100%">
        <div class="col-lg-7" style="height: 100%; padding-right: 0px;">
            <div class="ibox float-e-margins" style="height: 100%">
                <div class="ibox-content" style="height: 100%">
									<h1><span class="text-navy">2 Simple Steps to Get Started</span></h1>
									<div class="well"><span class="label label-primary pull-right">$0/mo</span><h2>Starter Plan</h2>
									This plan includes up to 100 subscribers and unlimited email sends per month. All plans come with a money-back guarantee.</p></div>
									
									<p></p>
									<form method="get" class="form-horizontal">
                                <div class="form-group"><label class="col-sm-4 control-label"></label>
                                    <div class="col-sm-8">
																			<h3>First, we'll need some basic information to help set up your account.</h3>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Email Address</label>
                                    <div class="col-sm-8">
																			<input type="text" placeholder="you@email.com" class="form-control input-lg m-b">
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Password (at least 5 characters)</label>
                                    <div class="col-sm-8">
																			<input type="password" placeholder="pencil" class="form-control input-lg m-b">
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">How'd you find Da Vinci?</label>
                                    <div class="col-sm-8">
																			<textarea class="form-control" rows="3" class="form-control input-lg m-b"></textarea>
																			<p>
																				
																			</p>
																			<button class="btn btn-primary" type="submit">Next Step</button>
                                    </div>
                                </div>
                            </form>
							</div>
            </div>
        </div>
        <div class="col-lg-5" style="height: 100%; padding-left: 0px;">
            <div class="ibox float-e-margins" style="height: 100%; ">
                <div class="ibox-content" style="height: 100%;  align-items: center;  display: flex;  background: #ff6633">
									<blockquote class="testimonial">
													<q class="quote" style="color:white">We've seen 12x more leads since we started using Da Vinci. It's a must-have for any company.</q>
													<div class="attribution">
														<img class="img-rounded" src="https://daruaaogzxkn2.cloudfront.net/assets/ambassador-jeff-f9e2427426db1c88db92c6afeb1f83c4d68e67f35cdf7f120ef04b5e807b5e84.jpg" alt="Ambassador jeff" width="25" height="25">
														<span style="color:white">Mike Robinson, Summit Print & Mail</span>
													</div>
												</blockquote>
							</div>
            </div>
        </div>
    </div>
<!--
	<div class="footer">
		<?php include 'footer.php'; ?>
	</div>
-->
	<!--  end page-wrapper -->
	</div>

	<!-- Mainly scripts -->
	<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
	<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

	<!-- Custom and plugin javascript -->
	<script src="js/inspinia.js"></script>
	<script src="js/plugins/pace/pace.min.js"></script>
	<script src="js/davinci.js"></script>

	<script>
		var dbname = "<?php echo $dbName; ?>";
		var accountID = "<?php echo $accountID; ?>";
		var studioEmail = "<?php echo $email; ?>";
		var studioPassword = "<?php echo $pwd; ?>";
	</script>
	<script src="js/accountSetting.js"></script>

	</body>

	</html>