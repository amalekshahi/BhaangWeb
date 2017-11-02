<?php
    date_default_timezone_set('UTC');
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
    $dbName = $_SESSION['DBNAME'];
    $accountID = $_SESSION['ACCOUNTID'];
    $accountName = $_SESSION['ACCOUNNAME'];
?>
	<!doctype html>
	<html ng-app="myApp">

	<head>
		<?php include "header.php"; ?>
		<script src="js/date.format.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.7.0/sweetalert2.css" rel="stylesheet">
		<script src="https://www.gstatic.com/charts/loader.js" type="text/javascript"></script>
	</head>

	<body class="">
		<script>
			//Kwang create myAPP here so all step can access it.
			var dbName = "<?php echo $dbName; ?>";
			var accountID = "<?php echo $accountID; ?>";
			var myApp = angular.module('myApp', ["xeditable", "summernote", "uiSwitch"]);
		</script>

		<div id="wrapper">
			<!-- left wrapper -->
			<?php include 'leftWrapper.php'; ?>
			<!-- /end left wrapper -->
			<div id="page-wrapper" class="gray-bg" ng-controller="myCtrl">
				<div class="row border-bottom">
					<nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
						<!-- top wrapper -->
						<?php include 'topWrapper.php'; ?>
						<!-- / top wrapper -->
					</nav>
				</div>
				<!-- content -->
				<div class="wrapper wrapper-content animated fadeInRight" ng-cloak>
					<div class="row">
						<div class="col-lg-9">
							<div class="ibox">
								<div class="ibox-title">
									<h5>{{campaign.campaignName}}: Funnel Performance</h5>
									<div class="pull-right">
										<div class="btn-group">
											<button class="btn btn-xs btn-white" type="button" ng-click="LoadSummary('Lifetime')">Lifetime</button> 
											<button class="btn btn-xs btn-white" type="button" ng-click="LoadSummary('Today')">Today</button> 
											<button class="btn btn-xs btn-white" type="button" ng-click="LoadSummary('Yesterday')">Yesterday</button> 
											<button class="btn btn-xs btn-white" type="button" ng-click="LoadSummary('7Days')">Last 7 Days</button> 
											<button class="btn btn-xs btn-white" type="button" ng-click="LoadSummary('14Days')">Last 14 Days</button> 
											<button class="btn btn-xs btn-white" type="button" ng-click="LoadSummary('30Days')">Last 30 Days</button>
										</div>
									</div>
								</div>
								<div class="ibox-content">
									<div id="top_x_div" style="width: 800px; height: 600px;"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="ibox">
								<div class="ibox-title">
									<h5>{{campaign.campaignName}} At-a-Glance</h5>
								</div>
								<div class="ibox-content">
									<div class="widget style1 navy-bg">
										<div class="row">
											<div class="col-xs-4">
												<i class="fa fa-users fa-5x"></i>
											</div>
											<div class="col-xs-8 text-right">
												<span> Targeted People </span>
												<h2 class="font-bold">{{campaign.reportSumarySent | number}}</h2>
											</div>
										</div>
									</div>
									<div class="widget style1 green-bg">
										<div class="row">
											<div class="col-xs-4">
												<i class="fa fa-envelope-o fa-5x"></i>
											</div>
											<div class="col-xs-8 text-right">
												<span> Delivered </span>
												<h2 class="font-bold">{{campaign.reportSumaryDelivered | number}} ({{campaign.reportSumaryDeliveredRate | number:0}}%)</h2>
											</div>
										</div>
									</div>
									<div class="widget style1 lazur-bg">
										<div class="row">
											<div class="col-xs-4">
												<i class="fa fa-envelope-open-o fa-5x"></i>
											</div>
											<div class="col-xs-8 text-right">
												<span> Opens </span>
												<h2 class="font-bold">{{campaign.reportSumaryOpened | number}} ({{campaign.reportSumaryOpenedRate | number:0}}%)</h2>
											</div>
										</div>
									</div>
									<div class="widget style1 yellow-bg">
										<div class="row">
											<div class="col-xs-4">
												<i class="fa fa-mouse-pointer fa-5x"></i>
											</div>
											<div class="col-xs-8 text-right">
												<span> Clicks to Blog Post </span>
												<h2 class="font-bold">{{campaign.reportSumaryClicked | number}} ({{campaign.reportSumaryClickedRate | number:0}}%)</h2>
											</div>
										</div>
									</div>
									<div class="widget style1 red-bg">
										<div class="row">
											<div class="col-xs-4">
												<i class="fa fa-dot-circle-o fa-5x"></i>
											</div>
											<div class="col-xs-8 text-right">
												<span> Conversions </span>
												<h2 class="font-bold">{{campaign.reportSumaryConversions | number}} ({{campaign.reportSumaryConversionsRate | number:0}}%)</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="ibox float-e-margins">
								<div class="ibox-content" style="padding-bottom: 10px;">
									<div class="chat-element">
                        <a href="#" class="pull-left">
                            <img alt="image" class="img-circle" src="http://www.freeiconspng.com/uploads/results-icon-png-17.png">
                        </a>
                        <div class="media-body ">
                            <small class="pull-right text-navy">1m ago</small>
                            <strong>How to Read Your Results</strong>
                            <p class="m-b-xs">Across <strong>{{campaign.numberOfEmailsSent | number}}</strong> Emails, you targeted a total of <strong>{{campaign.reportSumarySent | number}}</strong> unique People,   
															with <strong>{{campaign.reportSumaryDelivered | number}}</strong> People successfully receiving your Email (a <strong>{{campaign.reportSumaryDeliveredRate | number:0}}%</strong> delivery rate).
															Of those, <strong>{{campaign.reportSumaryOpened | number}}</strong> People <strong>({{campaign.reportSumaryOpenedRate | number:0}}%)</strong> opened an Email, with <strong>{{campaign.reportSumaryClicked | number}}</strong> People <strong>({{campaign.reportSumaryClickedRate | number:0}}%)</strong> clicking to your Blog Post.  
															Of those that clicked to your Blog Post, you achieved <strong>{{campaign.reportSumaryConversions | number}}</strong> conversions <strong>({{campaign.reportSumaryConversionsRate | number:0}}%)</strong>.</p>
                            <small class="text-muted">Each of these figures counts each person only once.</small>
                        </div>
                    </div>
										<div class="chat-element">
                        <a href="#" class="pull-left">
                            <img alt="image" class="img-circle" src="https://cdn.iconscout.com/public/images/icon/premium/png-512/analysis-optimization-search-view-vision-eye-36578f54fab1befd-512x512.png">
                        </a>
                        <div class="media-body ">
                            <small class="pull-right text-navy">1m ago</small>
                            <strong>Analysis</strong>
                            <p class="m-b-xs">Your delivery rate ({{campaign.reportSumaryDeliveredRate | number:0}}%) and open rate ({{campaign.reportSumaryOpenedRate | number:0}}%) are below the Da Vinci average. Darn!  You can <a href="">get feedback in the Da Vinci community forum</a>, or <a href="">talk to an expert to get some help</a>.</p>
                            <small class="text-muted">Data pulled from a sample of 1,375 Email campaigns.</small>
                        </div>
                    </div>									
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="ibox float-e-margins">
								<div class="ibox-title">
									<h5>How Are Your Emails Performing?</h5>
									<div class="pull-right">
										<div class="btn-group">
											<button class="btn btn-xs btn-white" type="button" ng-click="LoadReport('Lifetime')">Lifetime</button>
											<button class="btn btn-xs btn-white" type="button" ng-click="LoadReport('Today')">Today</button>
											<button class="btn btn-xs btn-white" type="button" ng-click="LoadReport('Yesterday')">Yesterday</button>
											<button class="btn btn-xs btn-white" type="button" ng-click="LoadReport('7Days')">Last 7 Days</button>
											<button class="btn btn-xs btn-white" type="button" ng-click="LoadReport('14Days')">Last 14 Days</button>
											<button class="btn btn-xs btn-white" type="button" ng-click="LoadReport('30Days')">Last 30 Days</button>
										</div>
									</div>
								</div>
								<div class="ibox-content">
									<div class="table-responsive" id="reportDiv">
										<table class="table table-hover">
											<thead>
												<tr>
													<th style="width:5%"></th>
													<th style="width:25%">Email Name</th>
													<th style="width:10%"># Sent</th>
													<th style="width:10%">Delivered</th>
													<th style="width:10%">Opens</th>
													<th style="width:10%">Clicked</th>
													<th style="width:10%">Unsubscribes</th>
													<th style="width:10%">Conversions</th>
													<th style="width:20%">&nbsp;</th>
												</tr>
											</thead>
											<tbody>
												<tr ng-repeat="item in campaign.report">
													<td style="vertical-align: middle;"><img class="img-circle" src="" style="width: 70%;">&nbsp;</td>
													<td style="vertical-align: middle;">{{item.emailName}}<br>
														<small>{{item.emailSent}}</small><br>
														<small>From {{item.emailFrom}}</small>
													</td>
													<td style="vertical-align: middle;">{{item.Sent | number}}</td>
													<td style="vertical-align: middle;">{{item.Delivered | number}} ({{item.DeliveredRate | number:0}}%)</td>
													<td style="vertical-align: middle;">{{item.Opened | number}} ({{item.OpenedRate | number:0}}%)</td>
													<td style="vertical-align: middle;">{{item.Clicked | number}} ({{item.ClickedRate | number:0}}%)</td>
													<td style="vertical-align: middle;">{{item.Unsubscribed | number}} ({{item.UnsubscribedRate | number:0}}%)</td>
													<td style="vertical-align: middle;">{{item.Conversions | number}} ({{item.ConversionsRate | number:0}}%)</td>
													<!-- Removed for now
									<td style="vertical-align: middle;">
										<a class="btn btn-white btn-xs"><i aria-hidden="true" class="fa fa-search-plus" style="color:green"></i> DETAILS</a>
									</td>
									-->
												</tr>
											</tbody>
										</table>
									</div>
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
			</div>
			<!--  end page-wrapper -->
		</div>


		<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
		<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		<script type="text/JavaScript" src="global.js?n=1"></script>

		<!-- Custom and plugin javascript -->
		<script src="js/inspinia.js"></script>
		<script src="js/plugins/pace/pace.min.js"></script>
		<script src="js/davinci.js"></script>

		<!-- Chosen -->
		<script src="js/plugins/chosen/chosen.jquery.js"></script>

		<!-- X-editable -->
		<script src="js/plugins/bootstrap-editable/boostrap-editable.js"></script>

		<!-- Clipboard -->
		<script src="js/plugins/clipboard/clipboard.min.js"></script>

		<!-- clockpicker -->
		<script src="js/plugins/clockpicker/clockpicker.js"></script>

		<!-- datepicker -->
		<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

		<!-- Sweet alert -->
		<script src="css/sweet/sweetalert-dev.js"></script>

		<!-- TouchSpin -->
		<script src="js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

		<!-- Page-Level Scripts -->
		<script src="js/jquery.md5.js"></script>
		<script src="js/davinci.js"></script>
		<script>
			var campaignID = getParameterByName("campaignID");
			$(document).ready(function() {
				google.charts.load('current', {
					'packages': ['bar']
				});
				google.charts.setOnLoadCallback(drawStuff);
			});
			myApp.controller('myCtrl', function($scope, $http) {
				$scope.Reset = function(alert) {
					$scope.campaign = angular.copy($scope.master);
					if (alert) {
						$scope.$apply();
						$scope.SelectChanged('viewEmail1', 'templateEmail1');
						$scope.sendersChanged('textSender1');
						// Kwang clear form state
						$scope.clearFormState();
						swal("Cancel!", "You are back to previous version.", "success");
					}
				};
				$scope.Load = function() {
					$http.get(dbEndPoint + "/" + dbName + '/' + campaignID + "?" + new Date().toString()).then(function(response) {
						$scope.master = response.data;
						$scope.campaign = angular.copy($scope.master);
						$scope.LoadReport('30Days');
						$scope.LoadSummary('30Days');
						$scope.Reset();
					}, function(errResponse) {
						swal(errResponse.statusText);
					});
				};


				$scope.LoadReport = function(mode) {

					var td = UTCDateTimeMDT();
					var fd = setfromdate(mode);
					var sendfrom = $scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMNAME'];
					//alert(mode+','+fd);
					$http({
						method: 'GET',
						url: 'getReportEmail.php' + "?programID=" + $scope.campaign.publishProgramID + "&campaignName=" + $scope.campaign.campaignName + "&fd=" + fd + "&td=" + td + "&nocache=" + new Date().toString()
					}).then(function(response) {
						if (response.data.success == false) {
							//var errorMessage = prettyStudioErrorMessage(response.data.detail.Result.ErrorMessage);
							//swal("fail");
						} else {
							var campaignType = $scope.campaign.campaignType;
							$scope.campaign.report = [];
							var report = response.data.rows;
							$scope.campaign.numberOfEmailsSent = "3";
							
							for (var i = 0; i < report.length; i++) {
								var em = report[i].Email;
								var emailName = getEmailName(em, 'long', campaignType);
								var j = i + 1;
								var dt = '';
								if (campaignType == 'PromoteBlog') {
									if ((em == 'Email1') || (em == 'Email2') || (em == 'Email3')) {
										dt = 'Sent ' + ShowScheduleDateTime($scope.campaign['EMAIL' + j + '-SCHEDULE1-DATETIME']);
									}
								}
								$scope.campaign.report.push({
									"emailName": emailName,
									"emailSent": dt,
									"emailFrom": sendfrom,
									"Sent": report[i].Sent,
									"Delivered": report[i].Delivered,
									"DeliveredRate": 100 * (report[i].Delivered / report[i].Sent),
									"Opened": report[i].Opened,
									"OpenedRate": 100 * (report[i].Opened / report[i].Delivered),
									"Clicked": report[i].Clicked,
									"ClickedRate": 100 * (report[i].Clicked / report[i].Opened),
									"Unsubscribed": report[i].Unsubscribed,
									"UnsubscribedRate": 100 * (report[i].Unsubscribed / report[i].Opened),
									"Conversions": "0",
									"ConversionsRate": "0",
								});
							}
						}

					}, function(errResponse) {});

				}; // LoadReport


				$scope.LoadSummary = function(mode) {

					var td = UTCDateTimeMDT();
					var fd = setfromdate(mode);
					
					//alert(mode+','+fd);
					$http({
						method: 'GET',
						url: 'getReportEmailSummary.php' + "?programID=" + $scope.campaign.publishProgramID + "&campaignName=" + $scope.campaign.campaignName + "&fd=" + fd + "&td=" + td + "&nocache=" + new Date().toString()
					}).then(function(response) {
						if (response.data.success == false) {
							//var errorMessage = prettyStudioErrorMessage(response.data.detail.Result.ErrorMessage);
							//swal("fail");
						} else {
							$scope.campaign.reportSumary = [];
							$scope.campaign.reportSumarySent = response.data.rows[0].Sent;
							$scope.campaign.reportSumaryDelivered = response.data.rows[0].Delivered;
							$scope.campaign.reportSumaryDeliveredRate = 100 * (response.data.rows[0].Delivered / response.data.rows[0].Sent);
							$scope.campaign.reportSumaryOpened = response.data.rows[0].Opened;
							$scope.campaign.reportSumaryOpenedRate = 100 * (response.data.rows[0].Opened / response.data.rows[0].Delivered);
							$scope.campaign.reportSumaryClicked = response.data.rows[0].Clicked;
							$scope.campaign.reportSumaryClickedRate = 100 * (response.data.rows[0].Clicked / response.data.rows[0].Opened);
							$scope.campaign.reportSumaryUnsubscribed = response.data.rows[0].Unsubscribed;
							$scope.campaign.reportSumaryUnsubscribedRate = 100 * (response.data.rows[0].Unsubscribed / response.data.rows[0].Opened);
							$scope.campaign.reportSumaryConversions = '0';
							$scope.campaign.reportSumaryConversionsRate = '0';

							var data = new google.visualization.arrayToDataTable([
								['Step', 'People'],
								["Targeted People", $scope.campaign.reportSumarySent],
								["Email Opens", $scope.campaign.reportSumaryOpened],
								["Clicks to Blog Post", $scope.campaign.reportSumaryClicked],
								["Completed Conversions", $scope.campaign.reportSumaryConversions],
							]);
							var options = {
								width: 800,
								legend: {
									position: 'right'
								},
								chart: {
									title: '',
									subtitle: ''
								},
								axes: {
									x: {
										0: {
											side: 'top',
											label: 'Funnel Step'
										} // Top x-axis.
									},
									y: {
										0: {
											side: 'bottom',
											label: '# of Unique People'
										} // Top x-axis.
									}

								},
								bar: {
									groupWidth: "90%"
								}
							};

							var chart = new google.charts.Bar(document.getElementById('top_x_div'));
							// Convert the Classic options to Material options.
							chart.draw(data, google.charts.Bar.convertOptions(options));
						}

					}, function(errResponse) {});

				}; // LoadSummary

				$scope.Load();
			});

			function setfromdate(mode){
				var fd = UTCDateTimeMDT();
				var td = UTCDateTimeMDT();
				var tdate = toDate(td);

				if ((mode == '') || (mode == 'Today')) {

				} else if (mode == 'Lifetime') {
					fd = '01/01/1900';
				} else {
					if (mode == 'Yesterday') {
						fd = addDays(tdate, -1);
					} else if (mode == '7Days') {
						fd = addDays(tdate, -7);
					} else if (mode == '14Days') {
						fd = addDays(tdate, -14);
					} else if (mode == '30Days') {
						fd = addDays(tdate, -30);
					}
					fd = formatDateMDY(fd);
				}
				return fd;
			}
		</script>
	</body>

	</html>