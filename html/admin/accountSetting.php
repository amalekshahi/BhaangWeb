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
<div ng-controller="myCtrl">
        <div class="row wrapper border-bottom white-bg page-heading" >
            <div class="col-lg-10">
                <h2>Account Settings</h2>
                <ol class="breadcrumb">
                    <li><a href="welcome.html">Home</a></li>
                    <li><strong><a>Settings</a></strong></li>                    
                </ol>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Let's get to know each other. <small>A few simple questions from a complex man.</small></h5>
                            <div class="ibox-tools">								
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <!-- <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a>
                                    </li>
                                    <li><a href="#">Config option 2</a>
                                    </li>
                                </ul> -->
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form name="myForm" method="post" class="form-horizontal">
                                <div><h2>Studio Credentials</h2></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Studio Username</label>
                                    <div class="col-sm-10">									
									
									<input type="text" class="form-control" placeholder="you@something.com" name="studio_username" ng-model="studioEmail" readonly>
									<!-- <input type="text" ng-model="userinfo.username"> -->
									<span class="help-block m-b-none">Your studio username.</span></div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Studio Password</label>
                                    <div class="col-sm-10">									
									
									<input type="password" class="form-control" placeholder="You want some cool stuff?" name="studio_password"  ng-model="studioPassword" readonly>
									<span class="help-block m-b-none">Shhh.  I won't tell anyone.</span>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>


                                <div><h2>3rd Party Applications</h2></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Google Analytics Tracking Code</label>
                                    <div class="col-sm-10">
									
									<input type="text" class="form-control" placeholder="UA-83447148-1" name="google_tracking_code" ng-model="userinfo.GoogleAccessToken">
									<span class="help-block m-b-none">Find your tracking ID and tracking code snippet.</span></div>
                                </div>

                                
								<div class="form-group"><label class="col-sm-2 control-label">Facebook Pixel ID</label>
                                    <div class="col-sm-10">
									
									<input type="text" class="form-control" placeholder="120261521652622" name="facebook_pixel_id" ng-model="userinfo.FaceBookAccessToken">
									<span class="help-block m-b-none">Shhh.  I won't tell anyone.</span>
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>                                
                                <div><h2>Marketing Settings</h2></div>
                                
								
								<div class="form-group"><label class="col-sm-2 control-label">From Email</label>
                                    <div class="col-sm-10">
									<input type="text" class="form-control" placeholder="you@something.com" name="defFromAdd" ng-model="userinfo.defFromAdd">
									<span class="help-block m-b-none">The email you're sending from (and to which people will reply).</span></div>
                                </div>
                               
								
								<div class="form-group"><label class="col-sm-2 control-label">From Email Name</label>
                                    <div class="col-sm-10">
									<input type="text" class="form-control" placeholder="Bill Gates" name="defFromName" ng-model="userinfo.defFromName">
									<span class="help-block m-b-none">What do they call you?</span>
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Unsubscribe Link</label>
                                    <div class="col-sm-10">
									<input type="text" class="form-control" placeholder="http://domain/unsubscribe" name="defUnsubscribe" ng-model="userinfo.defUnsubscribe">
									<span class="help-block m-b-none">How to unsubscribe?</span>
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>            
                                
								<div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <input type="hidden" name="action" value="saveProfileSettings">
                                        <button ng-disabled="myForm.$pristine" class="btn btn-primary" ng-click="Save()" ><i class="fa fa-floppy-o" ng-show="state['SaveAccountSetting'] == 'Save'"></i><span ng-show="state['SaveAccountSetting'] == 'Saving'"><i class="glyphicon glyphicon-refresh spinning"></i></span> {{state['SaveAccountSetting']}}</button>
                                        <button ng-disabled="myForm.$pristine" class="btn btn-white" ng-click="Cancel()"><i class="fa fa-ban"></i> Cancel</button>
                                    </div>
                                </div>
                                <div ng-show="saveSuccess && myForm.$pristine"  ng-cloak>
                                    <div class="alert alert-success">
                                    <strong> Success! </strong> Save success.
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            
            </div>        
</div><!-- myCtrl -->
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
<!--  -->
<script>
	var dbname = "<?php echo $dbName; ?>";
    var studioEmail = "<?php echo $email; ?>";
    var studioPassword = "<?php echo $pwd; ?>";
    var myApp = angular.module('myApp', []);
    myApp.controller('myCtrl',function($scope,$http) {
		$scope.Reset = function() {				 
                  $scope.userinfo  = angular.copy($scope.master);
                  $scope.myForm.$setPristine();
				  //$scope.fuser = $scope.userinfo.username;
				  //$scope.fadd = $scope.userinfo.defFromAdd;			
		};
		$scope.Load = function() {
                $scope.studioEmail = studioEmail;
                $scope.studioPassword = studioPassword;
                $scope.state = {
                    "SaveAccountSetting":"Save",
                };
				//alert("load");				
				$http.get("/couchdb/" + dbname + "/UserInfo").then(function(response) {
					 $scope.master  = response.data; 
					 if (typeof $scope.master.items == 'undefined') {
					   $scope.master.items = [];
					 } 
					 $scope.Reset();
				});
                
		};		

		$scope.Save = function() {
			//$http.put('/couchdb/' + data.username +'/userinfo', $scope.userinfo).then(function(response){
                $scope.state['SaveAccountSetting'] = "Saving";
				$http.put("/couchdb/" + dbname + "/UserInfo", $scope.userinfo).then(function(response){
					  $scope.data = response.data;          
					  $scope.Load();
                      $scope.saveSuccess = true;
                      $scope.state['SaveAccountSetting'] = "Save";
				 },function(response){
                      alert("ERROR: can not save!!!");	
                      $scope.state['SaveAccountSetting'] = "Save";                      
				});         

		};		
        
        $scope.Cancel = function(){
            $scope.Load();
            $scope.saveSuccess = false;
        };
		
		$scope.Load();

    });// end myApp.controller(myCtrl)
</script>

</body>

</html>
