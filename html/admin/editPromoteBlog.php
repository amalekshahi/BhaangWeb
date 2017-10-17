<?php
    date_default_timezone_set("UTC");
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
		$gates = $_SESSION['GATES'];
?>
	<!DOCTYPE html>
	<html ng-app="myApp">

	<head>
		<?php include "header.php"; ?>
		<script src="js/date.format.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.7.0/sweetalert2.css" rel="stylesheet">

		<!-- FooTable -->
		<link href="css/plugins/footable/footable.core.css" rel="stylesheet">

		<style>
			.editable-container.editable-inline,
			.editable-container.editable-inline .control-group.form-group,
			.editable-container.editable-inline .control-group.form-group .editable-input,
			.editable-container.editable-inline .control-group.form-group .editable-input textarea,
			.editable-container.editable-inline .control-group.form-group .editable-input select,
			.editable-container.editable-inline .control-group.form-group .editable-input input:not([type=radio]):not([type=checkbox]):not([type=submit]) {
				width: 550px!important;
				font-size: 14px;
				!important;
			}
			#editCampaignName.editable-click {
			  color: #fff;
			  border-color: #fff;
			}
			.campaign-title .editable-container.editable-inline,
			.campaign-title .editable-container.editable-inline .control-group.form-group,
			.campaign-title .editable-container.editable-inline .control-group.form-group .editable-input,
			.campaign-title .editable-container.editable-inline .control-group.form-group .editable-input textarea,
			.campaign-title .editable-container.editable-inline .control-group.form-group .editable-input select,
			.campaign-title .editable-container.editable-inline .control-group.form-group .editable-input input:not([type=radio]):not([type=checkbox]):not([type=submit]) {
				width: 440px !important;
				background-color: inherit;				
			}
			.btn.btn-default.btn-sm.editable-cancel {
				color: #676a6c;
			}
			.campaign-title .editable-container.editable-inline {
				margin-right: 87px !important;
			}
		</style>

	</head>

	<body class="fixed-sidebar">
		<script>
			//Kwang create myAPP here so all step can access it.
			var dbName = "<?php echo $dbName; ?>";
			var accountID = "<?php echo $accountID; ?>";
			var myApp = angular.module('myApp', ["localytics.directives", "xeditable", "summernote", "uiSwitch", "ngFileUpload"]);
		</script>

		<div id="wrapper">
			<!-- left wrapper -->
			<?php include 'leftWrapper.php'; ?>
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
						<div class="widget style1 blue-bg">
							<div class="row">
								<div class="col-xs-4">
									<i class="fa fa-bullhorn fa-5x"></i>
								</div>
								<div class="col-xs-8 text-right campaign-title">
									<span> Promote a Blog Post </span>
									<h2 class="font-bold"><a data-pk="2" data-title="Email Name" data-type="text" data-url="" href="#" id="editCampaignName" e-maxlength="50"></a></h2>
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
												<?php if ($gates['revamped_schedule'] == "TRUE") { echo "<a class='btn btn-white btn-bitbucket btn-xs' href='editPromoteBlog_revamped_schedule.php?campaign_id={{campaignID}}'><i class='fa fa-flag' aria-hidden='true' style='color:red'></i> Switch to the New Layout</a>"; }?>
												<a class="fullscreen-link"><i class="fa fa-expand"></i> Toggle distraction-free mode</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<!--<a class="btn btn-white btn-bitbucket btn-xs"><i aria-hidden="true" class="fa fa-pause" style="color:orange"></i> PAUSE CAMPAIGN</a>-->
												<a class="btn btn-white btn-bitbucket btn-xs" ng-click="DuplicateCampaignClick()"><i aria-hidden="true" class="fa fa-clone" style="color:green"></i> DUPLICATE CAMPAIGN</a>

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
																	<i aria-hidden="true" class="fa fa-check-circle fa-lg" style="color:green" ng-show="step1Done"></i> Identify the Targeted Blog Post</a></h4>
																</div>
																<div class="col-sm-9">
																	<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseOne">
                                  <small class="m-l-sm" ng-show="campaign['URL-BLOG-POST-UTM']"><i aria-hidden="true" class="fa fa-crosshairs fa-lg" ng-show="campaign['URL-BLOG-POST-URL']"></i> {{campaign['URL-BLOG-POST-URL']}}?{{campaign['URL-BLOG-POST-UTM']}}</small>
                                  <small class="m-l-sm" ng-hide="campaign['URL-BLOG-POST-UTM']"><i aria-hidden="true" class="fa fa-crosshairs fa-lg" ng-show="campaign['URL-BLOG-POST-URL']"></i> {{campaign['URL-BLOG-POST-URL']}}</small> </a></h4>
																</div>
															</div>
														</div>
														<div class="panel-collapse collapse" id="collapseOne">
															<div class="panel-body">
																<div class="ibox-content">
																	<form class="form-horizontal">
																		<div class="form-group">
																			<label class="col-sm-2 control-label">Blog Post URL</label>
																			<div class="col-sm-10">
																				<input class="form-control" name="URL-BLOG-POST-URL" placeholder="http://www.you-blog-post.com/page.html" type="text" ng-model="campaign['URL-BLOG-POST-URL']"><span class="help-block m-b-none">Enter the URL to the post you wish to promote. We'll use this link in your emails.</span>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="col-sm-2 control-label">URL Parameters (optional)</label>
																			<div class="col-sm-10">
																				<input class="form-control" name="URL-BLOG-POST-UTM" placeholder="utm_medium=email&utm_source=Blog&utm_campaign=My+Blog&utm_term=Read" type="text" ng-model="campaign['URL-BLOG-POST-UTM']"><span class="help-block m-b-none">URL parameters you specify here (like UTM tags used by Google Analytics) are appended to your Blog Post URL. <a href="https://support.google.com/analytics/answer/1033863" target="_new">Learn more about UTM here</a>.</span>
																			</div>
																		</div>
																		<div class="hr-line-dashed"></div>
																		<a href="#conversion_tracking" data-toggle="collapse"><mark style="background-color: dark-yellow;"><strong><i aria-hidden="true" class="fa fa-lightbulb-o"></i> OPTIONAL: Track Conversions</strong></mark>  <small>Conversions are steps that a person takes on your site (after visiting your Blog Post URL) that you would like to track such as visits, sign ups or downloads. This turns passive readers into active Leads.</small></a>
																		<div ng-class="{ 'collapse' : !campaign['CONVERSION-URL-MATCHING-RULE'] || campaign['CONVERSION-URL-MATCHING-RULE']=='' || campaign['CONVERSION-URL-MATCHING-RULE']=='Do not track conversions'}" id="conversion_tracking">

																			<!--
																			<div class="alert alert-success" role="alert">
																				<h3><i aria-hidden="true" class="fa fa-lightbulb-o"></i> OPTIONAL: Track Conversions Generated By This Post</h3>Mr. Da Vinci recommends that within your Blog Post you have at least one Call to Action (CTA). Your CTA turns passive visitors
																				into engaged Leads. If you have a CTA within your blog post, add it below. This enables Da Vinci to track the number of conversions generated by this Post.
																				<p></p>
																			</div>
																			-->
																			<div>
																				<p>

																				</p>
																			</div>
																			<div class="form-group">
																				<label class="col-sm-2 control-label">Conversion URL</label>
																				<div class="col-sm-2">
																					<select class="form-control m-b" name="CONVERSION-URL-MATCHING-RULE" ng-model="campaign['CONVERSION-URL-MATCHING-RULE']">
																			<option value="Do not track conversions">
																				
																			</option>			
																			<option value="Contains">
																				Contains
																			</option>
																			<option value="StartsWith">
																				Starts With
																			</option>
																			<option value="Exact">
																				Exact
																			</option>
																		</select>
																				</div>
																				<div class="col-sm-8">
																					<input class="form-control" name="CONVERSION-URL" placeholder="/blog/success.html" type="text" ng-model="campaign['CONVERSION-URL']"><span class="help-block m-b-none">Enter the full URL of the destination page where you want to count a visit as a conversion event; for example, the 'Thank You' page someone arrives at after filling out a form. We recommend excluding 'http' or 'https'. Only include 'www' if 'www' appears in your URL as visitors would see it when they come to your page</span>
																				</div>
																			</div>
																			<div class="form-group">
																				<label class="col-sm-2 control-label">Conversion Name</label>
																				<div class="col-sm-10">
																					<input class="form-control" name="CONVERSION-NAME" placeholder="Describe your list for easy future reference" type="text" ng-model="campaign['CONVERSION-NAME']"><span class="help-block m-b-none">Give your conversion action a name. You'll see this in your Reporting Funnel.</span>
																				</div>
																			</div>
																		</div>
																		<div class="hr-line-dashed"></div>
																		<div class="form-group">
																			<div class="col-sm-4 col-sm-offset-2">
																				<!--<input type="hidden" name="programNameHash" value="{{programNameHash}}">-->
																				<input name="programNameHash" type="hidden" value="{{programNameHash}}"> <button class="btn btn-primary" ng-click="Save()"><i class="fa fa-floppy-o" ng-show="state['Save'] == 'Save'"></i><span ng-show="state['Save'] == 'Saving'"><i class="glyphicon glyphicon-refresh spinning"></i></span> {{state['Save']}} </button>																				<button class="btn btn-white" ng-click="Cancel()"><i class="fa fa-ban"></i> Cancel</button>
																			</div>
																		</div>
																	</form>
																</div>
															</div>
														</div>
													</div>
													<div class="panel">
														<?php include "editPromoteBlog_step2.php"; ?>
													</div>
													<div class="panel">
														<?php include "editPromoteBlog_step3.php"; ?>
													</div>
													<div class="panel panel-default">
														<?php include "editPromoteBlog_step4.php"; ?>
													</div>
												</div>
												<div style="float:right;">
													<button class="btn btn-primary" ng-disabled="!CanPublish()" ng-click="Publish()"><i class="fa fa-paper-plane" ng-show="state['Publish'] == 'Launch Program'">></i><span ng-show="state['Publish'] != 'Launch Program'"><i class="glyphicon glyphicon-refresh spinning"></i></span> {{state['Publish']}}</button>
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
							<div class="ibox-content" id="reportDiv">
								
							</div>
						</div>
					</div>
				</div>
				<!--/ content -->
				<div class="footer">
					<!-- footer -->
					<?php include 'footer.php'; ?>
					<!-- / footer -->
				</div>
			</div>
			<!--  end page-wrapper -->
		</div>
		<!--<script src="js/bootstrap.min.js"></script>-->
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

		<!-- Page-Level Scripts -->
		<script src="js/jquery.md5.js"></script>
		<script src="js/editPromoteBlog.js"></script>

		<!-- FooTable -->
		<script src="js/plugins/footable/footable.all.min.js"></script>
	</body>

	</html>