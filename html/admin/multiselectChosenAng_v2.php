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
    <meta charset="utf-8" />
    <title>AngularJS Plunker</title>
    <link data-require="chosen@*" data-semver="1.0.0" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.min.css" />
    <script data-require="jquery@*" data-semver="2.2.0" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script data-require="chosen@*" data-semver="1.0.0" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.jquery.min.js"></script>
    <script data-require="chosen@*" data-semver="1.0.0" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.proto.min.js"></script>
    
    <!-- <script src="https://code.angularjs.org/1.4.9/angular.min.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    <script src="https://rawgit.com/leocaseiro/angular-chosen/master/dist/angular-chosen.min.js"></script>
    <!-- <style>select {width: 400px;}</style> -->
    <!-- <script src="app.js"></script> -->
	<script type="text/JavaScript" src="global.js?n=1"></script> 
  </head>

<body ng-controller="MainCtrl">
<!-- 
<select chosen multiple placeholder-text-multiple="'Choose a List...'" ng-model="filterList" ng-options = "option['LIST-NAME'] for option in audience.items"  style="width:400px;" id="fillList">
	 <option value=""></option>
</select>
 -->

<select chosen multiple placeholder-text-multiple="'Choose a List...'" ng-model="filterList" ng-options = "s.id as s.listname for s in states"  style="width:400px;" id="fillList">
	 <option value=""></option>
</select>
<br><br>
<button class="btn btn-primary" type="button" ng-click="ArrangeFilter()">test</button>
<input type="hidden" name="EMAIL1-FILTER"  id="EMAIL1-FILTER" value=""><br>
<!-- 
<hr>
      <select multiple        chosen        ng-model="state"        ng-options="s.id as s.title for s in states1" style="width:400px;" >
		  <option value=""></option>
		</select>
 -->  
</body>
<script>

var dbName = "<?php echo $dbName; ?>";

var app = angular.module('myApp', ['localytics.directives']);

app.controller('MainCtrl',function($scope,$http) {

			$scope.state = [4,2];
			$scope.states1 = [
				{id: 1, title: 'Alaska'},
				{id: 2, title: 'Arizona'},
				{id: 3, title: 'Arkansas'},
				{id: 4, title: 'California'}
 		   ];			

			$scope.LoadAudience = function() {               				

				$scope.filterList = ["f31711a4f8a49122046ed172246d83e2"]; 
                $http.get("/couchdb/" + dbName +'/audienceLists').then(function(response) {
								$scope.masterAu  = response.data; 								
								 if (typeof $scope.masterAu.items == 'undefined') {
								   $scope.masterAu.items = [];
								 } 
								 $scope.audience  = angular.copy($scope.masterAu);	
								 $scope.states = []; 								 
								 for (var i = 0; i < $scope.audience.items.length; i++) {
										$scope.fItems = { 
											id : $scope.audience.items[i].contactID, 
											listname : $scope.audience.items[i]['LIST-NAME'] 
										}; 										
										$scope.states.push($scope.fItems);
								 }
								 alert("states = "+$scope.states); 
                });
            };		
			$scope.LoadAudience(); 

			$scope.ArrangeFilter = function() {	
					
					$scope.AuFilter  = angular.copy($scope.masterAu);
					var auCnt = 0; 
					var auOpr = ""; 
					var allRule=""; 
					var selList=[]; 
					for (var i = 0; i < $scope.filterList.length; i++) {
						var indx = $scope.AuFilter.items.getIndexByValue('contactID',$scope.filterList[i]);
						selList.push($scope.filterList[i]); 
						$scope.auItem = $scope.AuFilter.items[indx];
						var auItemOpr = $scope.auItem['LIST-OPERATOR']; 
						auOpr += "("; 
						var arrItem = $scope.auItem['LIST-ARRAY']; 	
						if (typeof $scope.auItem['LIST-ARRAY'] != 'undefined') {
											var itemRule = ""; 
											for (var k = 0; k < arrItem.length; k++) {		
													auCnt++; 
													//alert(arrItem[k]); 
													if(arrItem[k] !=null ){
														itemRule = itemRule+'<Criteria Row=\"' +auCnt+ '\" Field=\"'+arrItem[k].Field+'\" Operator=\"'+arrItem[k].Operator+'\" Value=\"'+arrItem[k].Value+'\" />' ; 
													}				
													auOpr += auCnt ; 
													var opr = "&amp;"
													if(arrItem[k].JoinOperator == "or")	opr ="|"; 												
													if(k < arrItem.length-1)		auOpr += opr;  	

											} // end for k
											//alert(itemRule ); 
											allRule += itemRule; 																				
						}		
						auOpr += ")";
						if(i < $scope.filterList.length-1)		auOpr += "|";  
					}//end for i
					
					alert("selected = "+selList); 

					var auRule = "<Filter CriteriaJoinOperator=\""+auOpr+"\">"+allRule+"</Filter>" ; 
					$("#EMAIL1-FILTER").val(auRule);
					//$scope.campaign['EMAIL1-FILTER']  = auRule; 
					alert( "val = " + $("#EMAIL1-FILTER").val() ); 					
			};	

			$(".my_select_box").chosen({placeholder_text_multiple: "Choose a List...",width: "400px;",display_selected_options:true});
			$('.my_select_box').on('change', function() {
			    $scope.ArrangeFilter(); 
			});

});


</script>


</html>
