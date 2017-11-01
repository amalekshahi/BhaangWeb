<?php
    date_default_timezone_set('UTC');
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
?>
	<!DOCTYPE html>
	<html ng-app="myApp">

	<head>
		<?php include "header.php"; ?>
	</head>
	<body class="fixed-sidebar">
		<?php include "afterBody.php"; ?>
		<script>
			// welcome.js need this
			var dbName = "<?php echo $dbName; ?>";
		    var myApp = angular.module('myApp', ['angularMoment','davinci', 'localytics.directives']);
		</script>
    <script src="js/welcome.js"></script>
		<div id="wrapper">
			<!-- left wrapper -->
			<?php include 'leftWrapper.php'; ?>
			<!-- /end left wrapper -->
			<div id="page-wrapper" class="gray-bg">
				<div class="row border-bottom">
					<nav class="navbar navbar-static-top" role="navigation">
						<!-- top wrapper -->
						<?php include 'topWrapper.php'; ?>
						<!-- / top wrapper -->
					</nav>
				</div>

				<!-- content -->
				<div class="wrapper wrapper-content animated fadeInRight" ng-controller="myCtrl" style="padding-bottom: 0px;padding-top: 0px;" ng-cloak>
					<div class="row">
						<div class="col-lg-12">
							<div class="text-center m-t-lg">
								<div class="jumbotron" style="background: url('https://s3.amazonaws.com/mindfiredavinci/img/background_black_gradient-min.jpg') no-repeat center center; margin-bottom: 0px; padding-top: 30px;padding-bottom: 30px;">
									<h1 style="color:white;"><strong>Hi, I'm Da Vinci.</strong></h1>
									<h4 style="color:white;">&reg; Your Marketing AI.</h4>
									<p><a class="btn btn-primary dim btn-lg" href="pickBlueprint.php" role="button"><i class="fa fa-spin fa-plus"></i> <span ng-if="numberOfCampaigns===0">CREATE MY FIRST CAMPAIGN</span><span ng-if="numberOfCampaigns===1">CREATE A CAMPAIGN</span></a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div ng-controller="myCtrl" ng-cloak>
					<!-- Some strange bug with empty arrays required me to use 1 or 0 to decide whether or not to display the table [Dave] -->
					<div class="row" id="myCtrl" ng-if="numberOfCampaigns===1">
						<div class="col-lg-12">
							<div class="wrapper wrapper-content">
								<div class="ibox">
									<div class="ibox-title">
										<h5><i class="fa fa-paper-plane-o" style="color:orange"></i> Your Most Recent Campaigns</h5>
													<div class="pull-right">
																<a class="btn btn-success btn-xs" href="myCampaigns.php"><i aria-hidden="true" class="fa fa-external-link"></i> SEE ALL MY CAMPAIGNS</a>
                            </div>
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

											<table class="table table-hover" style="margin-bottom: 0px;">
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
															<small>Modified <span am-time-ago="item.lastEditDate"></span></small>
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
										<!--
										<div class="text-center">
											<a class="btn btn-success btn-xs" href="myCampaigns.php"><i aria-hidden="true" class="fa fa-external-link"></i> SEE ALL MY CAMPAIGNS</a>
										</div>
										-->
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row" id="myCtrl" ng-if="numberOfCampaigns===0">
						<div class="col-lg-12">
							<div class="wrapper wrapper-content">
								<div class="ibox">
									<div class="ibox-title">
										<h5><i class="fa fa-paper-plane-o" style="color:orange"></i> Welcome to Da Vinci.</h5>
									</div>
									<div class="social-feed-box">

                <div class="social-avatar">
                    <a href="" class="pull-left">
                        <img alt="image" src="https://www.mindfireinc.com/static/images/david-rosendahl.jpg">
                    </a>
                    <div class="media-body">
                        <a href="mailto:daver@mindfireinc.com">
                            David Rosendahl, Co-Founder 
                        </a>
                        <small class="text-muted">Earlier Today</small>
                    </div>
                </div>
                <div class="social-body">
											<p>Hi <?php echo $USERNAME;?>, I'm Dave.  We built Da Vinci to help you generate more leads and sales using techniques previously only available to large companies and high-tech nerds (we consider ourselves in that group so don't take offense!).</p>											
											</p>Here are a few tips to get you started:</p>
											<ul>
												
											<li>Click any of the navigation items on the left and take a quick look at the various options.</li>
											<li>Create a quick sample campaign to get a feel for what's going on here.</li>
											<li>[Note for Kushal] Please suggest appropriate content based on your experience.  I have no problem if you replace me as the face of this, too.</li>
											</ul>

											<p>If you need any help, use the chat box (found on every page), email us a <a href="mailto:support@mindfireinc.com">support@mindfireinc.com</a> or call us at (877) 560-3473 and press option 2 from the main menu.</p>

                    
                </div>
            </div>
									
								</div>
							</div>
						</div>
					</div>
				</div>

				<!--/ content -->
				<div class="footer fixed">
					<!-- footer -->
					<?php include 'footer.php'; ?>
					<!-- / footer -->
				</div>
			</div>
			<!--  end page-wrapper -->
		</div>
	</body>

	</html>