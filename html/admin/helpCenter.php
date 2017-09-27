<?php
    date_default_timezone_set('America/Los_Angeles');
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
    $dbName = $_SESSION['DBNAME'];
    $accountID = $_SESSION['ACCOUNTID'];
    $accountName = $_SESSION['ACCOUNNAME'];
?>

	<!DOCTYPE html>
		<html ng-app="myApp">

	<head>
		<?php include "header.php"; ?>
		<script>
			// welcome.js need this
			var dbName = "<?php echo $dbName; ?>";
			var myApp = angular.module('myApp', ['angularMoment', 'davinci', 'localytics.directives']);
		</script>
		<script src="js/welcome.js"></script>
	</head>

	<body class="fixed-sidebar">
		<!-- hhhh -->
		<div id="wrapper">
			<!-- left wrapper -->
			<div w3-include-html="leftWrapper.php"></div>
			<!-- /end left wrapper -->
			<div id="page-wrapper" class="gray-bg">
				<div class="row border-bottom">
					<nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
						<!-- top wrapper -->
						<?php include 'topWrapper.php'; ?>
						<!-- / top wrapper -->
					</nav>
				</div>
				<!-- content -->
				<div ng-controller="myCtrl">
					<div class="row">
						<div class="col-lg-12">
							<div class="wrapper wrapper-content animated fadeInRight">
								<div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-question-circle fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Advice and answers from the MindFire Team </span>
                            <h2 class="font-bold">Da Vinci Help Center</h2>
                        </div>
                    </div>
                </div>
								<div class="ibox-content forum-container">
									<div class="forum-item">
										<div class="row">
											<div class="col-md-10">
												<div class="forum-icon">
													<i class="fa fa-calendar-check-o"></i>
												</div><a class="forum-item-title" href="fileManager.php">Getting Started</a>
												<div class="forum-sub-title">
													Easy steps to get up and running with Da Vinci -- quickly.
												</div>
											</div>
											<div class="col-md-1 forum-info">
												<span class="views-number">4</span>
												<div>
													<small>articles in this collection</small>
												</div>
											</div>
											<div class="col-md-1 forum-info">
												<span class="views-number"></span>
												<div>
													<small></small>
												</div>
											</div>
										</div>
									</div>
									<div class="forum-item">
										<div class="row">
											<div class="col-md-10">
												<div class="forum-icon">
													<i class="fa fa-money"></i>
												</div><a class="forum-item-title" href="formLibrary.php">Blueprint QuickStart Guides</a>
												<div class="forum-sub-title">
													Get insider info on how to create more leads, more quickly.
												</div>
											</div>
											<div class="col-md-1 forum-info">
												<span class="views-number">2</span>
												<div>
													<small>articles in this collection</small>
												</div>
											</div>
											<div class="col-md-1 forum-info">
												<span class="views-number"></span>
												<div>
													<small></small>
												</div>
											</div>
										</div>
									</div>

								</div>
								<!-- ibox-content -->


							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="ibox float-e-margins">
								<div class="ibox-title">
									<h5>Talk to Someone</h5>
									<div ibox-tools></div>
								</div>
								<div class="ibox-content">
									<ul class="list-group">
										<li class="list-group-item">
											<span class="badge badge-primary">&nbsp;(877) 560-3473&nbsp;</span> Monday - Friday, 6am - 5pm Pacific
										</li>
										<li class="list-group-item ">
											<span class="badge badge-warning">&nbsp;support@mindfireinc.com&nbsp;</span> Open a support ticket
										</li>
										<li class="list-group-item">
											<span class="badge badge-danger">&nbsp;@mindfireinc&nbsp;</span> Quick answers to short questions
										</li>
										<li class="list-group-item">
											<span class="badge badge-success">&nbsp;Every page&nbsp;</span> Online chat
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="ibox float-e-margins">
								<div class="ibox-title">
									<h5>Sign-Up for Free Training</h5>

									<div ibox-tools></div>
								</div>
								<div class="ibox-content">
									Looking to learn more? Sign up for our weekly training sessions.
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="ibox float-e-margins">
								<div class="ibox-title">
									<h5>System Status</h5>
									<span class="pull-right"><button type="button" class="btn btn-default btn-xs"><i class="fa fa-circle" aria-hidden="true" style="color:green"></i> ALL SYSTEMS OPERATIONAL</button></span>								<div ibox-tools></div>
								</div>
								<div class="ibox-content">
									Subscribe to receive system notifications here.
								</div>
							</div>
						</div>
					</div>


				</div>



				<!--/ content -->
				<div class="footer fixed">
					<!-- footer -->
					<div w3-include-html="footer.php"></div>
					<!-- / footer -->
				</div>
			</div>
			<!--  end page-wrapper -->
		</div>

		<!-- Mainly scripts -->
		<script src="js/w3data.js"></script>
		<script>
			w3IncludeHTML();
		</script>

		<!-- Page-Level Scripts -->


	</body>

	</html>