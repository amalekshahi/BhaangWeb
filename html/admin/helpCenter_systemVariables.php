<?php
    date_default_timezone_set('UTC');
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
    $dbName = $_SESSION['DBNAME'];
    $accountID = $_SESSION['ACCOUNTID'];
    $accountName = $_SESSION['ACCOUNNAME'];
?>

	<!DOCTYPE html>
	<html ng-app="systemVariables" ng-lock>

	<head>
		<?php include "header.php"; ?>
		<script>
			// welcome.js need this
			var dbName = "<?php echo $dbName; ?>";
		</script>
	</head>

	<body class="fixed-sidebar">
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
				<div class="wrapper wrapper-content  animated fadeInRight article" ng-controller="variables">
					<div class="row">
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
						<div class="col-lg-12">
							<div class="ibox">
								<div class="ibox-content" style="padding-top: 10px;">
									<div class="text-center article-title" style="margin-bottom: 5px; margin-top: 0px">
										<h1>Personalized Variables Available for
											<?php echo $accountName; ?>
										</h1>
									</div>
									<p>
										There are a variety of variables available to you for use in personalizing your marketing communication. They are:
									</p>
									<table class="footable table table-hover toggle-arrow-tiny" data-page-size="15">
										<thead>
											<tr>
												<th data-toggle="true"> Field</th>
												<th data-toggle="true"> Description</th>
												<th data-toggle="true"> Shortcode</th>
												<th data-toggle="true"> </th>
											</tr>
										</thead>
										<tbody>
											<tr ng-if="nofile=='yes'">
												<td colspan='5'>No file exists.</td>
											</tr>
											<tr ng-repeat="var in variables | filter:search">
												<td>{{var.FieldName}}</td>
												<td>{{var.Description}}</td>
												<td><code>##{{var.FieldName}}##</code></td>
												<td class="text-right">
													<div class="ibox-tools">
														<a class="dropdown-toggle" data-toggle="dropdown" href="#">
															<button class="btn btn-white btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mark as read"><i class="fa fa-clipboard" aria-hidden="true"></i> Copy to Clipboard</button>  
														</a>
														<!-- </div> -->
													</div>
												</td>
											</tr>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="6">
													<ul class="pagination pull-right"></ul>
												</td>
											</tr>
										</tfoot>
									</table>
									<hr>
									<div class="row">
										<div class="col-md-6">
											<h5>Tags:</h5>
											<button class="btn btn-primary btn-xs" type="button">Variables</button>
											<button class="btn btn-white btn-xs" type="button">Media</button>
										</div>
										<div class="col-md-6">
										</div>
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
		<script src="js/systemVariables.js"></script>
	</body>
	</html>