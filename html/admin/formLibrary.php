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
				<div w3-include-html="topWrapper.php"></div>
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
                          <h1><strong>Form Library</strong></h1>
                          <h4>Build your database by collecting user information.  Build once, use anywhere.</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Your Forms</h5>
                            <div class="ibox-tools">
                                <a href="formEditor.php" class="btn btn-primary btn">+ Create New Form</a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="project-list">

                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Form Name</th>
                                        <th># of Fields</th>
                                        <th>Fields</th>
                                        <th>Submissions</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="item in formLib.items" ng-cloak>
                                        <td class="project-reach">
                                                <medium>Active</medium><br><small class="text-muted">&nbsp;</small> 
                                        </td>
                                        <td class="project-title">
                                            <a href="formEditor.php?fID={{item.formID}}">{{item['formName']}}</a>
                                            <br/>
                                            <a href="formEditor.php?fID={{item.formID}}"><small class="text-muted">Last Modified {{item.modifiedDate}} </small></a>
                                        </td>
                                        <td class="project-reach">
                                                <medium>{{item.fieldLists.length}}</medium><br><small class="text-muted">&nbsp;</small> 
                                        </td>
                                        <td class="project-completion">
                                                <medium>{{item.allFieldName}}</medium><br><small class="text-muted">&nbsp;</small> 
                                                
                                            
                                        </td>
                                        <td class="project-completion">
                                                <medium>{{item.submission}}</medium><br><small class="text-muted">people submitted this form</small>
                                        </td>

                                        <td class="project-actions">
                                            <a href="formEditor.php" class="btn btn-white btn-sm"><i class="fa fa-clone" style="color:green"></i> Copy </a>
                                            <a href="formEditor.php?fID={{item.formID}}" class="btn btn-white btn-sm"><i class="fa fa-pencil" style="color:green"></i> Edit </a>
                                        </td>
                                        
                                    </tr>                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</div><!-- myCtrl -->
<!--/ content -->           
			<div class="footer fixed">
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

	 <!-- Page-Level Scripts -->

<script>
var dbName = "<?php echo $dbName; ?>";
var myApp = angular.module('myApp', ["xeditable"]);
myApp.controller('myCtrl',function($scope,$http) {
			$scope.Reset = function() {
				 
			};
			$scope.Load = function() {                
				$http.get("/couchdb/" + dbName +'/formLibrary'+"?"+new Date().toString()).then(function(response) {
					 $scope.master  = response.data; 
					 if (typeof $scope.master.items == 'undefined') {
					   $scope.master.items = [];
					 } 
					  $scope.formLib  = angular.copy($scope.master);

				},function(errResponse){
						if (errResponse.status == 404) {
							$scope.formLib = {items:[]};
						}
				});
			};

			$scope.Load();
});  

</script>



</body>
</html>
