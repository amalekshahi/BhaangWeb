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
	</head>


	<body class="">
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

					<div class="wrapper wrapper-content animated fadeInRight">
						<div class="row">
							<div class="col-lg-12">
								<div class="text-center m-t-lg">
									<div class="jumbotron" style="background-color:#ffffff">
										<h1><strong>Audiences</strong></h1>
										<p>Add, search for, and create lists of your Contacts.</p>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Dave UI Love Starts Here and lasts forever ... -->

					<div class="row">
						<div class="col-lg-12">
							<div class="ibox float-e-margins">
								<div class="ibox-title">
									<h5>Your Contact Segments</strong></h5>
									<div class="ibox-tools">
											<a href="editContact.php?cid=new#!new" class="btn btn-primary btn-sm">+ Create New Segment</a>
									</div>
								</div>
								<div class="ibox-content">
									<table datatable="ng" dt-options="dtOptions" class="table table-striped table-bordered table-hover dataTables-example">
										<thead>
											<tr>
												<th>Segment Name</th>
												<th># Contacts</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<tr ng-repeat="item in audience.items | orderBy:'-lastEditDate'" ng-cloak>
												<td class="project-title"><a href="showContact.php?cid={{item.contactID}}">{{item['LIST-NAME']}}</a><br><small>{{item['LIST-DESCRIPTION']}}</small></td>
												<td class="project-title"><a href="showContact.php?cid={{item.contactID}}" target="_blank" ng-if="item['LIST-COUNT']>0"><i class="fa fa-users" ng-if="item['LIST-COUNT']>1" style="color:green"></i><i class="fa fa-user" ng-if="item['LIST-COUNT']==1"></i>
 
													
													<ng-pluralize count="item['LIST-COUNT']" 
																				when=	"{'0': 'No one.  How lonely!',
 													              	    	'one': 'See this 1 person',
                       													'other': 'See these {} people'}">
											  	</ng-pluralize>
													</a>
													<span ng-if="item['LIST-COUNT']==0"><small>No Contacts meet this Segment Definition</small></span>
												</td>
											<td>
											<a href="editContact.php?cid={{item.contactID}}" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit this Segment</a>	
											</td>	
											</tr>
										</tbody>
									</table>
								<div class="text-center">
										<a class="btn btn-success btn-xs" href="showContact.php?cid=-1" target="_blank"><i aria-hidden="true" class="fa fa-external-link"></i> SEE ALL MY CONTACTS</a>
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
									<h5>Add More Contacts</strong></h5>
									<div class="ibox-tools">
											<a href="importContact.php" class="btn btn-primary btn-sm"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Upload .CSV</a>
									</div>
								</div>
								<div class="ibox-content">Importing a CSV allows you to add and update Contacts stored in Da Vinci.  If an email address in your CSV matches an existing Contact, they will be updated with the mapped values.  Otherwise, a new Contact is created.
						</div>
					</div>

				</div>
			</div>

					<!-- End Dave Love -->



					<!-- Coa from here down -->
				<!--
					<div class="row">
						<div class="col-lg-12">
							<div class="wrapper" style="padding:0;">
								<div class="ibox" style="float: left;margin-bottom:0;">
									<div class="ibox-title">
										<div class="ibox-tools">
											<a href="importContact.php" class="btn btn-outline btn-success" style="margin-left:0;">Import Contact</a><a href="showContact.php?cid=-1" class="btn btn-outline btn-success" target="_blank"><i class="fa fa-external-link"></i> All</a>
										</div>
									</div>
								</div>
								<div class="ibox" style="margin-bottom:0;">
									<div class="ibox-title">
										<h5>Your Contact Segments</h5>
										<div class="ibox-tools">
											<a href="editContact.php?cid=new#!new" class="btn btn-primary btn-sm">+ Create New Segment</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				-->

		<!--
					<div class="row">
						<div class="col-lg-12">
							<div class="wrapper wrapper-content animated fadeInUp">
								<div class="project-list">
									<table class="table table-hover">
										<tbody>
											<tr ng-repeat="item in audience.items" ng-cloak>

												<td class="project-status" ng-if="item['LIST-COUNT']!=0">
													<span class="label label-primary">{{item['LIST-COUNT']}} person</span>
												</td>
												<td class="project-status" ng-if="item['LIST-COUNT']==0">
													<span class="label label-primary">No one!</span>
												</td>

												<td class="project-title" ng-if="item['LIST-COUNT']!=0">
													<a href="editContact.php?cid={{item.contactID}}">{{item['LIST-NAME']}}</a><br><small>{{item['LIST-DESCRIPTION']}}</small>
												</td>
												<td class="project-title" ng-if="item['LIST-COUNT']==0">
													<a href="editContact.php?cid={{item.contactID}}">No One</a><br><small>{{item['LIST-DESCRIPTION']}}</small>
												</td>

												<td class="project-completion">
													<small>{{item.contactDetail}}</small>
													<div class="progress progress-mini">
														<div style="width: 0%;" class="progress-bar"></div>
													</div>
												</td>
												<td class="project-actions">
													<a href="showContact.php?cid={{item.contactID}}" class="btn btn-white btn-sm" target="_blank"><i class="fa fa-external-link"></i> View </a>
												</td>
												<td class="project-actions">
													<a href="editContact.php?cid={{item.contactID}}" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>	
				

				</div>
		-->
							<!-- The End of Coa :) -->

		<div class="row">
			<div class="col-lg-12">
				<div class="wrapper wrapper-content animated fadeInUp">
				</div>
			</div>
		</div>
		
				<!-- myCtrl -->
				<!--/ content -->
				<div class="footer">
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
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
		<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

		<!-- Custom and plugin javascript -->
		<script src="js/inspinia.js"></script>
		<script src="js/plugins/pace/pace.min.js"></script>
		<!-- Page-Level Scripts -->
		<script>
			$(document).ready(function() {
				//angular.element('#myCtrl').scope.Load();
			});

			var dbName = "<?php echo $dbName; ?>";
			var myApp = angular.module('myApp', ["xeditable"]);
			myApp.controller('myCtrl', function($scope, $http) {
				$scope.Reset = function() {
					$scope.audience = angular.copy($scope.master);
				};
				$scope.Load = function() {
					$http.get("/couchdb/" + dbName + '/audienceLists' + "?" + new Date().toString()).then(function(response) {
						$scope.master = response.data;
						if (typeof $scope.master.items == 'undefined') {
							$scope.master.items = [];
						}
						$scope.Reset();

					}, function(errResponse) {
						if (errResponse.status == 404) {
							$scope.audience = {
								items: []
							};
						}
					});
				};

				$scope.Load();
			});

			function importContact() {
				window.location.href = "importContact.php";
			}
		</script>


	</body>

	</html>