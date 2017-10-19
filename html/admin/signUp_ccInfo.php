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
			var myApp = angular.module('myApp', ['ngFileUpload', 'davinci', 'localytics.directives', 'color.picker']);
		</script>

		<div class="row" style="height: 100%">
			<div class="col-lg-7" style="height: 100%; padding-right: 0px;">
				<div class="ibox float-e-margins" style="height: 100%">
					<div class="ibox-content" style="height: 100%">
						<h1><span class="text-navy">Almost Done ... </span></h1>
						<div class="well"><span class="label label-primary pull-right">$0/mo</span>
							<h2>Starter Plan</h2>
							This plan includes up to 100 subscribers and unlimited email sends per month. All plans come with a money-back guarantee.</p>
						</div>
						<p></p>
						<div id="collapseTwo" class="panel-collapse collapse in" aria-expanded="true" style="">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-4">
										<h2 style="margin-top: 0px;">Your Starter Plan Awaits</h2>
										<strong>Just enter the billing information for this account and we’ll get started.</strong><br>
										<p class="m-t">We ask for your credit card to prevent interruption of service should you exceed your plan limits. Your credit card will not be charged as long as you remain on the free plan.</p>
									</div>
									<div class="col-md-8">
										<form role="form" id="payment-form">
											<div class="row">
												<div class="col-xs-12">
													<div class="form-group">
														<label>Credit Card Number</label>
														<div class="input-group">
															<input type="text" class="form-control" name="Number" placeholder="4128 1234 1234 1234" required="">
															<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-7 col-md-7">
													<div class="form-group">
														<label>Expiration Date</label>
														<input type="text" class="form-control" name="Expiry" placeholder="MM / YY" required="">
													</div>
												</div>
												<div class="col-xs-5 col-md-5 pull-right">
													<div class="form-group">
														<label>CV CODE</label>
														<input type="text" class="form-control" name="CVC" placeholder="CVC" required="">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12">
													<div class="form-group">
														<label>Name on Card</label>
														<input type="text" class="form-control" name="nameCard" placeholder="Leo Da Vinci">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12">
													<button class="btn btn-primary" type="submit">Start Using Da Vinci</button>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="alert alert-danger" role="alert">You are signing up for a free plan and will not be charged unless you exceed your plan limits. You can cancel anytime.</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-5" style="height: 100%; padding-left: 0px;">
				<div class="ibox float-e-margins" style="height: 100%; ">
					<div class="ibox-content" style="height: 100%;  align-items: center;  display: flex;  background: #ff6633">
						<blockquote class="testimonial">
							<q class="quote" style="color:white">There’s no risk and you can cancel anytime with a single click from your dashboard. All plans come with a money-back guarantee.</q>
							<div class="attribution">
								<img class="img-rounded" src="https://daruaaogzxkn2.cloudfront.net/assets/ambassador-jeff-f9e2427426db1c88db92c6afeb1f83c4d68e67f35cdf7f120ef04b5e807b5e84.jpg" alt="Ambassador jeff" width="25" height="25">
								<span style="color:white">Kushal Dutta, MindFire</span>
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