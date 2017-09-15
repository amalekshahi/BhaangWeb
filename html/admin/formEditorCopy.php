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
	<script type="text/JavaScript" src="global.js?n=1"></script> 	
	<!-- <script src="js/moment.js"></script> -->
 	<script src="js/jquery.md5.js"></script>	
	<script src="js/davinci.js"></script>


<script>
var dbName = "<?php echo $dbName; ?>";
var fID = getParameterByName("fID");

var myApp = angular.module('myApp', []);

myApp.controller('myCtrl',function($scope,$http) {
			$scope.Reset = function() {
				 
			};
			$scope.LoadLibrary = function() {     
					
				$http.get("/couchdb/" + dbName +'/formLibrary'+"?"+new Date().toString()).then(function(response) {
							$scope.master  = response.data; 
							if (typeof $scope.master.items == 'undefined') {
							   $scope.master.items = [];
							} 
							$scope.frmlist  = angular.copy($scope.master);
							var indx = $scope.frmlist.items.getIndexByValue('formID',fID);		
							$scope.selectFrm = $scope.frmlist.items[indx];			
							
							var LName = $scope.selectFrm.formName; 
							var submission = "";
//							var modDate = moment().format('MMM D, YYYY HH:mm:ss'); //with moment.js  //modifiedDate
							var modDate = getCurrentDateTime(); 
							if(LName != ''){
								var keyword = LName+getCurrentDateTime();
								var resID = $.md5(keyword);      

								$scope.frmlist.items.push({
										"formID":resID,
										"formName":LName,
										"formType_DefID":$scope.selectFrm.formType_DefID,
										"submission":submission,
										"modifiedDate":modDate,
										"allFieldName":$scope.selectFrm.allFieldName,
										"formHTML":$scope.selectFrm.formHTML,
										"fieldLists":$scope.selectFrm.fieldLists
								});
								$scope.SaveCopy(resID); 
							}else{
								alert('ERROR[fail] 404'); 
							}
				},function(errResponse){
							if (errResponse.status == 404) {
								alert('ERROR[fail] 404'); 
							}							
                });				
            };
			$scope.SaveCopy = function(resID) {								
					$http.put('/couchdb/' + dbName +'/formLibrary',  $scope.frmlist).then(function(response){
						//window.location.href="formEditor.php?fID="+resID; 
						window.location.href="formLibrary.php" ; 
					});         
            };

			$scope.LoadLibrary();
});  

</script>



</body>
</html>
