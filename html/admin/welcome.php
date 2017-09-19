<?php
    date_default_timezone_set('America/Los_Angeles');
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
?><!DOCTYPE html>
	<html ng-app="myApp">

	<head>
		<?php include "header.php"; ?>
	</head>


	<body class="">
        <?php include "afterBody.php"; ?>
		<div id="wrapper">
			<!-- left wrapper -->
            <?php include 'leftWrapper.php'; ?>
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
				<div class="wrapper wrapper-content animated fadeInRight">
					<div class="row">
						<div class="col-lg-12">
							<div class="text-center m-t-lg">
								<div class="jumbotron" style="background: url('https://s3.amazonaws.com/mindfiredavinci/img/background_black_gradient-min.jpg') no-repeat center center;">
									<h1 style="color:white;"><strong>Hi, I'm Da Vinci.</strong></h1>
									<h4 style="color:white;">&reg; Your Marketing AI.</h4>
									<p><a class="btn btn-primary dim btn-lg" href="pickBlueprint.php" role="button"><i class="fa fa-spin fa-plus"></i> CREATE A CAMPAIGN</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row" ng-controller="myCtrl" id="myCtrl">
					<div class="col-lg-12">
						<div class="wrapper wrapper-content animated fadeInUp">
							<div class="ibox">
								<div class="ibox-title">
									<h5><i class="fa fa-paper-plane-o" style="color:orange"></i> Your Most Recent Campaigns</h5>
									<!--
													<div class="ibox-tools">
	                              <a class="btn btn-primary btn-xs" href=""><i aria-hidden="true" class="fa fa-external-link"></i> SEE ALL MY CAMPAIGNS</a>
                            </div>
													-->
								</div>
								<!--
											<div class="ibox-content">
                            <div class="row m-b-sm m-t-sm">
                                <div class="col-md-6">
                                    <div class="input-group"><input type="text" placeholder="Start typing what you're looking for ..." class="input-sm form-control" ng-model="searchText">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary" ng-click="Search()"> Search</button></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
											-->
								<div class="ibox-content">


									<!--<div class="row m-b-sm m-t-sm">
                                <div class="col-md-1">
                                    <button type="button" id="loading-example-btn" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
                                </div>
                                <div class="col-md-11">
                                    <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                                </div>
                            </div>-->

									<div class="project-list">

										<table class="table table-hover">
											<tbody>
												<thead>
													<tr>
														<th>Status</th>
														<th>Campaign Name</th>
														<th>Reach (People)</th>
														<th>Results</th>
														<th>&nbsp;</th>
														<th>&nbsp;</th>
													</tr>
												</thead>
												<tr ng-repeat="item in campaignlist.campaigns | orderBy:'-lastEditDate' | filter:searchText | limitTo:3" ng-cloak ng-click="goToLink(item)">
													<td class="project-status">
														<span class="badge badge-published"><span class="badge badge-published"><i class="fa fa-rss"></i> {{item.status=='Edit' ? 'LIVE' : 'DRAFT'}}</span></span>
													</td>
													<td class="project-title">
														<strong>{{item.campaignName}}</strong> <small>({{item.campaignType=='PromoteBlog' ? 'Promote a Blog Post' : 'Promote an eBook'}})</small>
														<br/>
														<!-- Roll back to this <span am-time-ago="message.time"></span> once timestamp issue is resolved -->
														<small>Modified {{item.lastEditDate | amDateFormat:'MMMM Do YYYY, h:mm a'}}
                                                        (<span am-time-ago="item.lastEditDate"></span>)</small>
													</td>

													<td class="project-reach">
														<medium>{{Random(10000)|number}}</medium><br><small class="text-muted">&nbsp;</small>
													</td>
													<td class="project-completion">
														<medium>{{Random(1000)}}</medium><br><small class="text-muted"><i class="fa fa-bullhorn"></i> Clicks to Blog Post</small>
													</td>
													<td class="project-completion">
														<medium>{{Random(10)}}%</medium><br><small class="text-muted">Click-thru Rate</small>
													</td>
													<td class="project-actions">
														<!--<a href="edit{{item.campaignType}}.php?campaign_id={{item.campaignID}}" class="btn btn-white btn-sm" data-toggle="tooltip" title="Copy feature coming soon."><i class="fa fa-clone" style="color:green"></i> Copy </a>-->
														<a href="edit{{item.campaignType}}.php?campaign_id={{item.campaignID}}" class="btn btn-white btn-sm"><i class="fa fa-pencil" style="color:green"></i> Edit </a>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="text-center">
										<a class="btn btn-success btn-xs" href="myCampaigns.php"><i aria-hidden="true" class="fa fa-external-link"></i> SEE ALL MY CAMPAIGNS</a>
									</div>
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
			<!--  end page-wrapper -->
		</div>

		<!-- Mainly scripts -->
		<!--<script src="js/w3data.js"></script>
		<script>
			w3IncludeHTML();
		</script>-->
		<!--<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>-->
		<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
		<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

		<!-- Custom and plugin javascript -->
		<script src="js/inspinia.js"></script>
		<script src="js/plugins/pace/pace.min.js"></script>
		<script src="js/davinci.js"></script>
		<!-- already include in header.php
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>-->
		<script src="https://cdn.jsdelivr.net/angular.moment/1.0.1/angular-moment.min.js"></script>

		<!-- Page-Level Scripts -->
        <script>
            // welcome.js need this
            var dbName = "<?php echo $dbName; ?>";
        </script>
		<script src="js/welcome.js"></script>
	</body>

	</html>