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
											Configuration is stored in <code>/gatekeeper/gatekeeper.json</code>.  Add as many flags as you need and give access accordingly.  The above UI needs to update the json (not done yet).
										</p>
										<p>
											Once the json is configured, add <code>$gates = $_SESSION['GATES'];</code> to the top of the .php where you need to use flags.  Then use the syntax show below.
										</p>
										<p>
											<span><strong>PHP</strong>: <code>if (gatekeeper_allowed('revamped_schedule')) { run_this_new_code(); } else { run_this_old_code(); } // Just sample.  Not done with this yet</code></span>
										</p>
										<p>
											<span><strong>HTML/Angularjs</strong>: <code>ng-show="&lt?php echo $gates['revamped_schedule']?&gt"</code></span>
										</p>
									</div>
									<hr/>
									<div>
										<h3>Your Current Flags & Examples (look in gatekeeper.php)</h3>
										<p>Current Gatekeeper Flags for <?php echo $email ?>: <code><?php print_r($gates); ?></code></p>
										<p>Your access to <code>revamped_schedule</code> is <?php echo $gates['revamped_schedule']?></p>
										<p>Your access to <code>dummy2</code> is true <?php echo $gates['dummy2']?></p>
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