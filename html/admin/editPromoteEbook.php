<?php
    date_default_timezone_set("UTC");
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
    $dbName = $_SESSION['DBNAME'];
    $accountID = $_SESSION['ACCOUNTID'];
    $accountName = $_SESSION['ACCOUNNAME'];
	$LANDINGPAGEDOMAIN = "http://dv{{campaign['accountID']}}.m.mdl.io/{{campaign['campaignID']}}";
?>

	<!DOCTYPE html>
	<html ng-app="myApp">
	<head>
		<?php include "header.php"; ?>
		<script src="js/date.format.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.7.0/sweetalert2.css" rel="stylesheet">
		<style type="text/css">
			.fileinput-filename{white-space: nowrap;text-overflow: ellipsis;width: calc(100% - 20px);}
		</style>
	</head>

	<body class="">
		<script>
			//Kwang create myAPP here so all step can access it.
			var dbName = "<?php echo $dbName; ?>";
			var accountID = "<?php echo $accountID; ?>";
			var myApp = angular.module('myApp', ["localytics.directives", "xeditable", "summernote", "uiSwitch", "ngFileUpload"]);
		</script>

		<div id="wrapper">
			<!-- left wrapper -->
			<?php include "leftWrapper.php"; ?>
			<!-- /end left wrapper -->
			<div id="page-wrapper" class="gray-bg" ng-controller="myCtrl">
                <!--EMAIL1-SCHEDULE1-DATETIME={{campaign['EMAIL1-SCHEDULE1-DATETIME']}}<br>
                EMAIL1CONTENT={{campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL1CONTENT']}}<br>
                EMAIL2-SCHEDULE1-DATETIME={{campaign['EMAIL2-SCHEDULE1-DATETIME']}}<br>
                EMAIL2CONTENT={{campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL2CONTENT']}}<br>
                EMAIL3-SCHEDULE1-DATETIME={{campaign['EMAIL3-SCHEDULE1-DATETIME']}}<br>
                EMAIL31CONTENT={{campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL3CONTENT']}}<br>-->
				<div class="row border-bottom">
					<nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
						<!-- top wrapper -->
                        <?php include 'topWrapper.php'; ?>
						<!-- / top wrapper -->
					</nav>
				</div>

				<!-- content -->

				<div class="row" ng-cloak>
					<div class="col-lg-12">
						<div class="widget style1 red-bg">
							<div class="row">
								<div class="col-xs-4">
									<i class="fa fa-book fa-5x"></i>
								</div>
								<div class="col-xs-8 text-right">
									<span> Promote an eBook </span>
									<h2 class="font-bold">{{campaign.campaignName}}</h2>
								</div>

							</div>
						</div>

						<div class="ibox float-e-margins">
							<div class="row">
								<div class="col-lg-12">
									<div class="ibox float-e-margins">
										<div class="ibox-title">
											<h5><i class="fa fa-rocket" aria-hidden="true" style="color:black"></i> Your Campaign Settings <small class="m-l-sm"></small></h5>
											<div class="ibox-tools">
												<a class="fullscreen-link"><i class="fa fa-expand"></i> Toggle distraction-free mode</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<!--<a class="btn btn-white btn-bitbucket btn-xs"><i aria-hidden="true" class="fa fa-pause" style="color:orange"></i> PAUSE CAMPAIGN</a>-->
												<a class="btn btn-white btn-bitbucket btn-xs"  ng-click="DuplicateCampaignClick()"><i aria-hidden="true" class="fa fa-clone" style="color:green"></i> DUPLICATE CAMPAIGN</a>

											</div>
										</div>
										<div class="ibox-content">
											<div class="panel-body">
												<div class="panel-group" id="accordion">
													<div class="panel panel-default">
														<div class="panel-heading">
															<div class="row">
																<div class="col-sm-3">
																	<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseOne"><span class="badge" ng-show="!step1Done">1</span>
																	<i aria-hidden="true" class="fa fa-check-circle fa-lg" style="color:green" ng-show="step1Done"></i> Configure Your eBook</a></h4>
																</div>
																<div class="col-sm-9">
																	<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseOne">
                                  <small class="m-l-sm" ng-show="campaign['URL-eBOOK-NAME']"><i aria-hidden="true" class="fa fa-crosshairs fa-lg" ng-show="campaign['URL-eBOOK-NAME']"></i> {{campaign['URL-eBOOK-NAME']}}</small> </a></h4>
																</div>
															</div>
														</div>
														<div class="panel-collapse collapse" id="collapseOne">
															<div class="panel-body">
																<div class="ibox-content">
																	<form action="" class="form-horizontal" method="post">
																		<div class="form-group">
																			<label class="col-sm-2 control-label">eBook Name</label>
																			<div class="col-sm-10">
																				<input class="form-control" placeholder="Crime and Punishment" type="text" ng-model="campaign['URL-eBOOK-NAME']"><span class="help-block m-b-none">Enter the name of your eBook. This will appear on your landing page and other key areas.</span>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="col-sm-2 control-label">eBook Hosting Location</label>
																			<div class="col-sm-10">
																				<div class="fileinput fileinput-new input-group col-sm-6" data-provides="fileinput">
																					<div class="form-control" data-trigger="fileinput">
																						<i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span>
																					</div><span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Upload your eBook</span> <span class="fileinput-exists">Change</span> <input name="eBookFile" id="eBookFile" type="file"></span> <a class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput" href="#">Remove</a>
																				</div>
																				<p class="text-muted">Or specify the URL it is hosted at:</p><input class="form-control" placeholder="http://www.s3.com" type="text" ng-model="campaign['URL-eBOOK-LOCATION']"><span class="help-block m-b-none">This can be any web-accessible location like: <a href="https://s3-us-west-1.amazonaws.com/marketingmfi/USPS_10_Steps_to_Help_Create_a_Successful_Direct_Mail_Campaign.pdf" target="_new"><code><small>https://s3-us-west-1.amazonaws.com/marketingmfi/USPS_10_Steps_to_Help_Create_a_Successful_Direct_Mail_Campaign.pdf</small></code></a></span>
																			</div>
																		</div>
																	</form>
																</div>
																<div class="hr-line-dashed"></div>
																<div class="form-group">
																	<div class="col-sm-4 col-sm-offset-2">
																		<!--<input type="hidden" name="programNameHash" value="{{programNameHash}}">-->
																		<input name="programNameHash" type="hidden" value="{{programNameHash}}"><button class="btn btn-primary" ng-click="uploadBeforeSave()"><i class="fa fa-floppy-o" ng-show="state['Save'] == 'Save'"></i><span ng-show="state['Save'] == 'Saving'"><i class="glyphicon glyphicon-refresh spinning"></i></span> {{state['Save']}} </button> <button class="btn btn-white" ng-click="Cancel()"><i class="fa fa-ban"></i> Cancel</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="panel panel-default">
														<?php include "editPromoteEbook_step2.php"; ?>
													</div>
													<div class="panel">
														<?php include "editPromoteEbook_step3.php"; ?>
													</div>
													<div class="panel">
														<?php include "editPromoteEbook_step4.php"; ?>
													</div>
													<div class="panel panel-default">
														<?php include "editPromoteEbook_step5.php"; ?>
													</div>
												</div>
												<div style="float:right;">
                                                    <!--NO NEED ANYMORE
													<button class="btn btn-primary" ng-disabled="!CanPublish()" ng-click="Publish()"><i class="fa fa-paper-plane" ng-show="state['Publish'] == 'Launch Program'">></i><span ng-show="state['Publish'] != 'Launch Program'"><i class="glyphicon glyphicon-refresh spinning"></i></span> {{state['Publish']}}</button> -->
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="ibox float-e-margins">
							<div class="ibox-title">
								<h5><i aria-hidden="true" class="fa fa-bar-chart" style="color:black"></i> Performance Snapshot</h5>
								<div class="ibox-tools">
									<button class="btn btn-white btn-xs" ng-click="ViewReport()"><i aria-hidden="true" class="fa fa-external-link" style="color:blue"></i> VIEW MORE PERFORMANCE REPORTS</button>
									<a class="collapse-link">
                        	<i class="fa fa-chevron-up"></i>
                        </a>
								</div>
							</div>
							<div class="ibox-content">
								<div class="row">
									<div class="col-xs-3">
										<small class="stats-label"><i aria-hidden="true" class="fa fa-users" style="color:green"></i> Targeted People</small>
										<h2>643</h2>
									</div>
									<div class="col-xs-3">
										<small class="stats-label"><i aria-hidden="true" class="fa fa-envelope-open-o" style="color:blue"></i> Opens</small>
										<h2>64 (17%)</h2>
									</div>
									<div class="col-xs-3">
										<small class="stats-label"><i aria-hidden="true" class="fa fa-mouse-pointer" style="color:purple"></i> Clicks to Blog Post</small>
										<h2>13 (11%)</h2>
									</div>
									<div class="col-xs-3">
										<small class="stats-label"><i aria-hidden="true" class="fa fa-times-circle" style="color:red"></i> Unsubscribes</small>
										<h2>2 (1%)</h2>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--/ content -->
				<div class="footer">
					<!-- footer -->
					<?php include "footer.php"; ?>
					<!-- / footer -->
				</div>
			</div>
			<!--  end page-wrapper -->
		</div>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
		<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		<script type="text/JavaScript" src="global.js?n=1"></script>

		<!-- Custom and plugin javascript -->
		<script src="js/inspinia.js"></script>
		<script src="js/plugins/pace/pace.min.js"></script>
		<script src="js/davinci.js"></script>

		<!-- Chosen -->
		<!-- <script src="js/plugins/chosen/chosen.jquery.js"></script> -->

		<!-- X-editable -->
		<script src="js/plugins/bootstrap-editable/boostrap-editable.js"></script>

		<!-- Clipboard -->
		<script src="js/plugins/clipboard/clipboard.min.js"></script>

		<!-- clockpicker -->
		<script src="js/plugins/clockpicker/clockpicker.js"></script>

		<!-- datepicker -->
		<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

		<!-- Sweet alert -->
		<!--<script src="css/sweet/sweetalert-dev.js"></script>-->
        <!-- user version 2 to support modal input -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.7.0/sweetalert2.min.js"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.7.0/sweetalert2.common.js"></script>-->

		<!-- TouchSpin -->
		<script src="js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

		<!-- Jasny -->
		<script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>

		<!-- Page-Level Scripts -->
		<script src="js/jquery.md5.js"></script>
		<script src="js/editPromoteEbook.js"></script>

	</body>

	</html>