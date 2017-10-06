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
	<html ng-app="gatekeeper">

	<head>
		<?php include "header.php"; ?>
		<script src="js/gatekeeper.js"></script>
	</head>

	<body class="fixed-sidebar" ng-controller="gatekeeperController">
		<div id="wrapper">
			<?php include 'leftWrapper.php'; ?>
			<div id="page-wrapper" class="gray-bg">
				<div class="row border-bottom">
					<nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
						<!-- top wrapper -->
						<?php include 'topWrapper.php'; ?>
						<!-- / top wrapper -->
					</nav>
				</div>
				<!-- content -->
				<div>
					<div class="row">
						<?php echo "gates: "; print_r($gates); ?>
						<div class="col-lg-12">
							<div class="wrapper wrapper-content animated fadeInRight">
								<div class="widget style1 navy-bg">
									<div class="row">
										<div class="col-xs-4">
											<i class="fa fa-codepen fa-5x"></i>
										</div>
										<div class="col-xs-8 text-right">
											<span> Deployment and release feature toggles </span>
											<h2 class="font-bold">Da Vinci Gatekeeper</h2>
										</div>
									</div>
								</div>
								<div class="ibox-content forum-container" ng-repeat="gate in gates">
									<div class="forum-item">
										<div class="row">
											<div class="col-md-6">
												<div class="forum-icon">
													<i class="fa fa-code" aria-hidden="true"></i>
												</div><a class="forum-item-title" href="fileManager.php">{{gate.Name}}</a>
												<div class="forum-sub-title">
													{{gate.Description}}
												</div>

											</div>
											<div class="col-md-2 forum-info">
												<span class="forum-item-title"><strong>Code Nick</strong></span>
												<div>
													<small><code>{{gate.Code_Nick}}</code></small>
												</div>
											</div>
											<div class="col-md-2 forum-info">
												<span class="forum-item-title"><strong>Status</strong></span>
												<div>
													<small>{{gate.Status}}</small>
												</div>
											</div>
											<div class="col-md-2 forum-info">
												<span class="forum-item-title"><strong></strong></span>
												<div>
													<button class="btn btn-primary" type="submit">Save changes</button>
												</div>
											</div>

										</div>
										<div class="row">
											<div class="col-md-12">

												<div>
													<p>

													</p>
												</div>

												<div class="forum-icon">
													&nbsp;
												</div>
												<h5>Who can see this feature? <small> Enter a comma separated list of usernames, or * to give everyone access.</small></h5>
												<div class="forum-sub-title">
													<input type="text" class="form-control" ng-model="gate.Who_Can_See">
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- ibox-content -->
								<div class="ibox-content forum-container">
									<div>
										<h3>How to Use Gatekeeper <small>Instructions for php and HTML/angularjs</small></h3>
										<p>
											<span><strong>PHP</strong>: <code>if (gatekeeper_allowed('revamped_schedule')) { run_this_new_code(); } else { run_this_old_code(); }</code></span>
										</p>
										<p>
											<span><strong>HTML/angularjs</strong>: <code>ng-show="revamped_schedule"</code></span>
										</p>
									</div>
									<hr/>
									<div>
										<h3>Current Gatekeeper Flags for <?php echo $email ?> <?php print_r($gates); ?></h3>
										<p>Your access to revamped_schedule is <span ng-show="<?php $gates['revamped_schedule']?>">true</span></p>
										<p>Your access to dummy2 is true</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!--/ content -->
				<div class="footer fixed">
					<?php include 'footer.php'; ?>
				</div>
			</div>
			<!--  end page-wrapper -->
		</div>
	</body>

	</html>