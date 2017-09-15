<?php
    date_default_timezone_set('America/Los_Angeles');
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
    <script src="https://www.gstatic.com/charts/loader.js" type="text/javascript"></script>
</head>
<body class="">
    <script>
        //Kwang create myAPP here so all step can access it.
        var dbName = "<?php echo $dbName; ?>";
		var accountID = "<?php echo $accountID; ?>";
		var myApp = angular.module('myApp', ["xeditable","summernote","uiSwitch"]);
    </script>

<div id="wrapper">
	<!-- left wrapper -->
	<div w3-include-html="leftWrapper.php"></div>
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
								<button class="btn btn-xs btn-white active" type="button">Lifetime</button> <button class="btn btn-xs btn-white" type="button">Today</button> <button class="btn btn-xs btn-white" type="button">Yesterday</button> <button class="btn btn-xs btn-white" type="button">Last 7 Days</button> <button class="btn btn-xs btn-white" type="button">Last 14 Days</button> <button class="btn btn-xs btn-white" type="button">Last 30 Days</button>
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
                            <h2 class="font-bold">44,231</h2>
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
                            <h2 class="font-bold">27,123</h2>
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
                            <h2 class="font-bold">3,132</h2>
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
                            <h2 class="font-bold">1,287</h2>
                        </div>
                    </div>
                </div>
						
					</div>
				    <div class="ibox-content"><p>Your open rate (17%) is above the Da Vinci average.  Keep up the good work!</p>
				    <p>However, your conversion rate (4%) is about 20% under the average.</p><p>You can <a href="">get feedback in the Da Vinci community forum</a>, or <a href="">talk to an expert to get some help</a>.</p>
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
								<button class="btn btn-xs btn-white active" type="button">Lifetime</button> <button class="btn btn-xs btn-white" type="button">Today</button> <button class="btn btn-xs btn-white" type="button">Yesterday</button> <button class="btn btn-xs btn-white" type="button">Last 7 Days</button> <button class="btn btn-xs btn-white" type="button">Last 14 Days</button> <button class="btn btn-xs btn-white" type="button">Last 30 Days</button>
							</div>
						</div>
					</div>
					<div class="ibox-content">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>
										<th style="width:5%">From</th>
										<th style="width:25%">Email Name</th>
										<th style="width:10%"># Sent</th>
										<th style="width:10%">Opens</th>
										<th style="width:10%">Clicked</th>
										<th style="width:10%">Unsub</th>
										<th style="width:10%">Conversions</th>
										<th style="width:20%">&nbsp;</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td style="vertical-align: middle;"><img class="img-circle" src="https://media.licdn.com/mpr/mpr/shrinknp_400_400/p/4/000/15d/357/1e3bb50.jpg" style="width: 70%;">&nbsp;</td>
										<td style="vertical-align: middle;">Email #1: Sent to Everyone<br>
										<small>Sent Thursday August 17 at 2:15 PM</small></td>
										<td style="vertical-align: middle;">24,340</td>
										<td style="vertical-align: middle;">11,223</td>
										<td style="vertical-align: middle;">4,213</td>
										<td style="vertical-align: middle;">2,987</td>
										<td style="vertical-align: middle;">801</td>
										<td style="vertical-align: middle;">
											<a class="btn btn-white btn-xs"><i aria-hidden="true" class="fa fa-search-plus" style="color:green"></i> DETAILS</a>
										</td>
									</tr>
									<tr>
										<td style="vertical-align: middle;"><img class="img-circle" src="http://www.mindfireinc.com/static/images/david-rosendahl.jpg" style="width: 70%;"></td>
										<td style="vertical-align: middle;">Email #2: Sent to Non-Openers<br>
										<small>Sent Saturday August 19 at 8:15 AM</small></td>
										<td style="vertical-align: middle;">21,340</td>
										<td style="vertical-align: middle;">9,332</td>
										<td style="vertical-align: middle;">3,473</td>
										<td style="vertical-align: middle;">1,324</td>
										<td style="vertical-align: middle;">403</td>
										<td style="vertical-align: middle;">
											<a class="btn btn-white btn-xs"><i aria-hidden="true" class="fa fa-search-plus" style="color:green"></i> DETAILS</a>
										</td>
									</tr>
									<tr>
										<td style="vertical-align: middle;"><img class="img-circle" src="https://media.licdn.com/mpr/mpr/shrinknp_400_400/p/4/000/15d/357/1e3bb50.jpg" style="width: 70%;"></td>
										<td style="vertical-align: middle;">Email #3: Sent to Non-Clickers<br>
										<small>Sent Monday August 20 at 4:15 AM</small></td>
										<td style="vertical-align: middle;">17,182</td>
										<td style="vertical-align: middle;">3,232</td>
										<td style="vertical-align: middle;">2,642</td>
										<td style="vertical-align: middle;">1,188</td>
										<td style="vertical-align: middle;">201</td>
										<td style="vertical-align: middle;">
											<a class="btn btn-white btn-xs"><i aria-hidden="true" class="fa fa-search-plus" style="color:green"></i> DETAILS</a>
										</td>
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
			<div w3-include-html="footer.php"></div>
			<!-- / footer -->			
			</div>
        </div>
    </div><!--  end page-wrapper -->
</div>
	
	<script src="js/w3data.js"></script>	
	<script>w3IncludeHTML();</script>
    <!-- <script src="js/jquery-3.1.1.min.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
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
    <script>
		var campaignID = getParameterByName("campaignID");    
		$(document).ready(function() {
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawStuff);
        });
		myApp.controller('myCtrl',function($scope,$http) {
            $scope.Reset = function(alert) {
				$scope.campaign  = angular.copy($scope.master);
				if (alert) {
					$scope.$apply();
					$scope.SelectChanged('viewEmail1','templateEmail1');
					$scope.sendersChanged('textSender1');
                    // Kwang clear form state
                    $scope.clearFormState();
					swal("Cancel!", "You are back to previous version.", "success");
				}
            };        
            $scope.Load = function() {
                $http.get("/couchdb/" + dbName +'/'+campaignID+"?"+new Date().toString()).then(function(response) {
                    $scope.master  = response.data;
                    $scope.campaign  = angular.copy($scope.master);
                    $scope.Reset();
                },function(errResponse){
                    swal(errResponse.statusText);
                });
            };
            
            $scope.Load();
		});
        function drawStuff() {
          var data = new google.visualization.arrayToDataTable([
            ['Step', 'People'],
            ["Targeted People", 44231],
            ["Email Opens", 27123],
            ["Clicks to Blog Post", 3132],
            ["Completed Conversions", 1287],
          ]);

          var options = {
            width: 800,
            legend: { position: 'right' },
            chart: {
              title: '',
              subtitle: '' },
            axes: {
              x: {
                0: { side: 'top', label: 'Funnel Step'} // Top x-axis.
              },
              y: {
                0: { side: 'bottom', label: '# of Unique People'} // Top x-axis.
              }
              
            },
            bar: { groupWidth: "90%" }
          };

          var chart = new google.charts.Bar(document.getElementById('top_x_div'));
          // Convert the Classic options to Material options.
          chart.draw(data, google.charts.Bar.convertOptions(options));
        };
    </script>
</body>

</html>
    
