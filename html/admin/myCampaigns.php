<?php
    date_default_timezone_set('America/Los_Angeles');
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
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
				<div w3-include-html="topWrapper.php"></div>
				<!-- / top wrapper -->
				</nav>
		</div>	
<!-- content -->       
        <div class="row" ng-controller="myCtrl">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>My Campaigns</h5>
                            <div class="ibox-tools">
                                <!--<a href="" class="btn btn-primary btn-xs">Create Folder</a>-->
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row m-b-sm m-t-sm">
                                <div class="col-md-1">
                                    <button type="button" id="loading-example-btn" class="btn btn-white btn-sm" ng-click="Load()"><i class="fa fa-refresh"></i> Refresh</button>
                                </div>
                                <div class="col-md-11">
                                    <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control" ng-model="searchText">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary" ng-click="Search()"> Go!</button></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-lg-12">
                                    <div class="wrapper wrapper-content animated fadeInUp">
                                        <div class="ibox">
                                            <div class="ibox-title">
                                                <h5>Recent Campaigns</h5>
                                                <div class="ibox-tools">
                                                    <!--<a href="" class="btn btn-primary btn-xs">Create Folder</a>-->
                                                </div>
                                            </div>
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
                                                            <tr ng-repeat="item in campaignlist.campaigns | filter: myFilter | orderBy:'-lastEditDate'" ng-cloak>
																<td class="project-status">
																	<a href="edit{{item.campaignType}}.php?campaign_id={{item.campaignID}}"><span class="label label-info">{{item.status}}</span></a>
																</td>
																<td class="project-title">
																	<a href="edit{{item.campaignType}}.php?campaign_id={{item.campaignID}}">{{item.campaignName}}</a> <small>({{item.campaignType}})</small>
																	<br/>
																	<small>Last Edited {{item.lastEditDate}} </small>
																</td>

																<td class="project-reach">
																	<medium>{{Random(10000)}}</medium><br><small class="text-muted">&nbsp;</small> 
																</td>
																<td class="project-completion">
																		<medium>{{Random(1000)}}</medium><br><small class="text-muted"><i class="fa fa-bullhorn"></i> Clicks to Blog Post</small>
																</td>
																<td class="project-completion">
																		<medium>{{Random(10)}}%</medium><br><small class="text-muted">Click-thru Rate</small>
																</td>
																<td class="project-actions">
																	<a href="edit{{item.campaignType}}.php?campaign_id={{item.campaignID}}" class="btn btn-white btn-sm"><i class="fa fa-clone" style="color:green"></i> Copy </a>
																	<a href="edit{{item.campaignType}}.php?campaign_id={{item.campaignID}}" class="btn btn-white btn-sm"><i class="fa fa-pencil" style="color:green"></i> Edit </a>
																</td>


																<!-- <td class="project-actions">
                                                                    <a href="edit{{item.campaignType}}.php?campaign_id={{item.campaignID}}" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                                                </td>
                                                                <td class="project-title">
                                                                    <a href="edit{{item.campaignType}}.php?action=editCampaign&campaign_id={{item.campaignID}}">{{item.campaignName}}</a> <small>({{item.campaignType}})</small>
                                                                    <br/>
                                                                    <small>Last Edited {{item.lastEditDate}} </small>
                                                                </td>
                                                                <td class="project-reach">
                                                                        <medium>Reach: {{Random(10000)}} people</medium>
                                                                        <div class="progress progress-mini">
                                                                            <div class="progress-bar" ng-style="{width : ( Random(100) + '%' ) }"></div>
                                                                        </div>
                                                                </td>
                                                                <td class="project-completion">
                                                                        <medium>Results:{{Random(500)}}  clicks to Blog Post ({{Random(100)}} % CTR)</medium>
                                                                        <div class="progress progress-mini">
                                                                            <div class="progress-bar" ng-style="{width : ( Random(100) + '%' ) }"></div>
                                                                        </div>
                                                                </td>
                                                                 <td class="project-status">
                                                                    <span class="label label-success">{{item.status}}</span>
                                                                </td> -->
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
<!--
                            <div class="project-list">
                                <table class="table table-hover">
                                    <tbody>
                                    
<tr>
                                        <td class="project-actions">
                                            <a href="dv.php?page=editCampaign&amp;programNameHash=2a2f97925bf8a1d224d0d30ffeddbcf5" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                        </td>
                                        <td class="project-title">
                                            <a href="dv.php?page=editCampaign&amp;programNameHash=2a2f97925bf8a1d224d0d30ffeddbcf5">coatest002</a>
                                            <br>
                                            <small>Launched Tuesday, August 1st 2017 at 10:03 pm </small>
                                        </td>
                                        <td class="project-reach">
                                                <medium>Reach: 78,375 people</medium>
                                                <div class="progress progress-mini">
                                                    <div style="width: 78.375%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                        <td class="project-completion">
                                                <medium>Results: 1,479 clicks to Blog Post (1.89% CTR)</medium>
                                                <div class="progress progress-mini">
                                                    <div style="width: 1.89%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                         <td class="project-status">
                                            <span class="label label-success">Active</span>
                                        </td>
                                    </tr>
<tr>
                                        <td class="project-actions">
                                            <a href="dv.php?page=editCampaign&amp;programNameHash=2cff8ba8c1a377aec8acd532427610ef" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                        </td>
                                        <td class="project-title">
                                            <a href="dv.php?page=editCampaign&amp;programNameHash=2cff8ba8c1a377aec8acd532427610ef">KD101</a>
                                            <br>
                                            <small>Launched Tuesday, August 1st 2017 at 8:58 pm </small>
                                        </td>
                                        <td class="project-reach">
                                                <medium>Reach: 71,288 people</medium>
                                                <div class="progress progress-mini">
                                                    <div style="width: 71.288%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                        <td class="project-completion">
                                                <medium>Results: 938 clicks to Blog Post (1.32% CTR)</medium>
                                                <div class="progress progress-mini">
                                                    <div style="width: 1.32%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                         <td class="project-status">
                                            <span class="label label-success">Active</span>
                                        </td>
                                    </tr>
<tr>
                                        <td class="project-actions">
                                            <a href="dv.php?page=editCampaign&amp;programNameHash=28f39c7e007b2436adfa93341f4c7315" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                        </td>
                                        <td class="project-title">
                                            <a href="dv.php?page=editCampaign&amp;programNameHash=28f39c7e007b2436adfa93341f4c7315">New blog post promotion</a>
                                            <br>
                                            <small>Launched Tuesday, August 1st 2017 at 4:42 pm </small>
                                        </td>
                                        <td class="project-reach">
                                                <medium>Reach: 38,272 people</medium>
                                                <div class="progress progress-mini">
                                                    <div style="width: 38.272%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                        <td class="project-completion">
                                                <medium>Results: 850 clicks to Blog Post (2.22% CTR)</medium>
                                                <div class="progress progress-mini">
                                                    <div style="width: 2.22%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                         <td class="project-status">
                                            <span class="label label-success">Active</span>
                                        </td>
                                    </tr>
<tr>
                                        <td class="project-actions">
                                            <a href="dv.php?page=editCampaign&amp;programNameHash=7a0f5014ca1e1c3d618a629f764bb2b7" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                        </td>
                                        <td class="project-title">
                                            <a href="dv.php?page=editCampaign&amp;programNameHash=7a0f5014ca1e1c3d618a629f764bb2b7">Test</a>
                                            <br>
                                            <small>Launched Tuesday, August 1st 2017 at 3:54 pm </small>
                                        </td>
                                        <td class="project-reach">
                                                <medium>Reach: 69,564 people</medium>
                                                <div class="progress progress-mini">
                                                    <div style="width: 69.564%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                        <td class="project-completion">
                                                <medium>Results: 11,594 clicks to Blog Post (16.67% CTR)</medium>
                                                <div class="progress progress-mini">
                                                    <div style="width: 16.67%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                         <td class="project-status">
                                            <span class="label label-success">Active</span>
                                        </td>
                                    </tr>
<tr>
                                        <td class="project-actions">
                                            <a href="dv.php?page=editCampaign&amp;programNameHash=e760c009da8fb6e521e91dad035b5ba2" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                        </td>
                                        <td class="project-title">
                                            <a href="dv.php?page=editCampaign&amp;programNameHash=e760c009da8fb6e521e91dad035b5ba2">Test</a>
                                            <br>
                                            <small>Launched Tuesday, August 1st 2017 at 3:50 pm </small>
                                        </td>
                                        <td class="project-reach">
                                                <medium>Reach: 52,425 people</medium>
                                                <div class="progress progress-mini">
                                                    <div style="width: 52.425%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                        <td class="project-completion">
                                                <medium>Results: 1,691 clicks to Blog Post (3.23% CTR)</medium>
                                                <div class="progress progress-mini">
                                                    <div style="width: 3.23%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                         <td class="project-status">
                                            <span class="label label-success">Active</span>
                                        </td>
                                    </tr>
<tr>
                                        <td class="project-status">
                                            <span class="label label-primary">Active</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="project_detail.html">coatest002</a>
                                            <br>
                                            <small>Launched Tuesday, August 1st 2017 at 10:03 pm </small>
                                        </td>
                                        <td class="project-completion">
                                                <small>Clicks to Post: 792</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: 48%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                        <td class="project-actions">
                                            <a href="dv.php?page=editCampaign&amp;programNameHash=2a2f97925bf8a1d224d0d30ffeddbcf5" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                        </td>
                                    </tr>
<tr>
                                        <td class="project-status">
                                            <span class="label label-primary">Active</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="project_detail.html">KD101</a>
                                            <br>
                                            <small>Launched Tuesday, August 1st 2017 at 8:58 pm </small>
                                        </td>
                                        <td class="project-completion">
                                                <small>Clicks to Post: 792</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: 48%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                        <td class="project-actions">
                                            <a href="dv.php?page=editCampaign&amp;programNameHash=2cff8ba8c1a377aec8acd532427610ef" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                        </td>
                                    </tr>
<tr>
                                        <td class="project-status">
                                            <span class="label label-primary">Active</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="project_detail.html">New blog post promotion</a>
                                            <br>
                                            <small>Launched Tuesday, August 1st 2017 at 4:42 pm </small>
                                        </td>
                                        <td class="project-completion">
                                                <small>Clicks to Post: 792</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: 48%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                        <td class="project-actions">
                                            <a href="dv.php?page=editCampaign&amp;programNameHash=28f39c7e007b2436adfa93341f4c7315" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                        </td>
                                    </tr>
<tr>
                                        <td class="project-status">
                                            <span class="label label-primary">Active</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="project_detail.html">Test</a>
                                            <br>
                                            <small>Launched Tuesday, August 1st 2017 at 3:54 pm </small>
                                        </td>
                                        <td class="project-completion">
                                                <small>Clicks to Post: 792</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: 48%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                        <td class="project-actions">
                                            <a href="dv.php?page=editCampaign&amp;programNameHash=7a0f5014ca1e1c3d618a629f764bb2b7" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                        </td>
                                    </tr>
<tr>
                                        <td class="project-status">
                                            <span class="label label-primary">Active</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="project_detail.html">Test</a>
                                            <br>
                                            <small>Launched Tuesday, August 1st 2017 at 3:50 pm </small>
                                        </td>
                                        <td class="project-completion">
                                                <small>Clicks to Post: 792</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: 48%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                        <td class="project-actions">
                                            <a href="dv.php?page=editCampaign&amp;programNameHash=e760c009da8fb6e521e91dad035b5ba2" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                        </td>
                                    </tr>
<tr>
                                        <td class="project-status">
                                            <span class="label label-primary">Active</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="project_detail.html">Test</a>
                                            <br>
                                            <small>Launched Tuesday, August 1st 2017 at 3:47 pm </small>
                                        </td>
                                        <td class="project-completion">
                                                <small>Clicks to Post: 792</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: 48%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                        <td class="project-actions">
                                            <a href="dv.php?page=editCampaign&amp;programNameHash=494a7a3dfb5530ca386ff8decc9dbe57" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                        </td>
                                    </tr>
<tr>
                                        <td class="project-status">
                                            <span class="label label-primary">Active</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="project_detail.html">Test</a>
                                            <br>
                                            <small>Launched Tuesday, August 1st 2017 at 3:45 pm </small>
                                        </td>
                                        <td class="project-completion">
                                                <small>Clicks to Post: 792</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: 48%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                        <td class="project-actions">
                                            <a href="dv.php?page=editCampaign&amp;programNameHash=b263a7ee51e21d169f369587e1e02e82" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                        </td>
                                    </tr>
<tr>
                                        <td class="project-status">
                                            <span class="label label-primary">Active</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="project_detail.html">Dave's test </a>
                                            <br>
                                            <small>Launched Tuesday, August 1st 2017 at 3:40 pm </small>
                                        </td>
                                        <td class="project-completion">
                                                <small>Clicks to Post: 792</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: 48%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                        <td class="project-actions">
                                            <a href="dv.php?page=editCampaign&amp;programNameHash=d0692891f3abe48ead0bb1a2e174909c" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                        </td>
                                    </tr>
<tr>
                                        <td class="project-status">
                                            <span class="label label-primary">Active</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="project_detail.html">Moe Campaign</a>
                                            <br>
                                            <small>Launched Tuesday, August 1st 2017 at 11:23 am </small>
                                        </td>
                                        <td class="project-completion">
                                                <small>Clicks to Post: 792</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: 48%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                        <td class="project-actions">
                                            <a href="dv.php?page=editCampaign&amp;programNameHash=339cf893333b49c5214d0945c5794dc0" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                        </td>
                                    </tr>
<tr>
                                        <td class="project-status">
                                            <span class="label label-primary">Active</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="project_detail.html">test001</a>
                                            <br>
                                            <small>Launched Monday, July 31st 2017 at 11:45 pm </small>
                                        </td>
                                        <td class="project-completion">
                                                <small>Clicks to Post: 792</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: 48%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                        <td class="project-actions">
                                            <a href="dv.php?page=editCampaign&amp;programNameHash=5f31641a76d99e7502bdc6af002fd4f4" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>-->
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
		</div><!--  end page-wrapper -->
</div>

    <!-- Mainly scripts -->
	<script src="js/w3data.js"></script>	
	<script>w3IncludeHTML();</script>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	
    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>
    <script src="js/davinci.js"></script>
    <!-- Page-Level Scripts -->
    <script>
		var dbName = "<?php echo $dbName; ?>";
		var myApp = angular.module('myApp', []);
		myApp.controller('myCtrl',function($scope,$http) {
			$scope.Reset = function() {
                  $scope.campaignlist  = angular.copy($scope.master);
            };
			$scope.Load = function() {
                $http.get("/couchdb/" + dbName +'/campaignlist').then(function(response) {
                     $scope.master  = response.data; 
                     if (typeof $scope.master.campaigns == 'undefined') {
                        $scope.master.campaigns = [];
                     }
                     $scope.Reset();
                });
            };
            $scope.Random = function(range){
                return Math.floor((Math.random() * range) + 1); 
            };
            $scope.Search = function(){
                //alert($scope.searchText);
                $scope.Load();
            };
            $scope.myFilter = function(item){
                if (typeof $scope.searchText == 'undefined') {
                    return true;
                }
                if ($scope.searchText == '') {
                    return true;
                }
                if (item.campaignName.startsWith($scope.searchText)){
                    return true;
                }
                return false;
            };
			$scope.Load();
		});
    </script>	

</body>

</html>
