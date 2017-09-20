<!doctype html>
<html ng-app="myApp">
 <head>
	<title>FFF</title>
    <?php include "header.php"; ?>	    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>    

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<script src="js/jquery-3.1.1.min.js"></script>   
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>
<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
</head>
 <body>

<div ng-view></div>


    


<!-- Mainly scripts -->
	<script src="js/jquery-3.1.1.min.js"></script> 	
	<script src="js/bootstrap.min.js"></script> 
	<script src="js/plugins/metisMenu/jquery.metisMenu.js">	</script> 
	<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script> 
	<!-- jquery UI -->	 
	<script src="js/plugins/jquery-ui/jquery-ui.min.js"></script> 	
	<!-- X-editable -->
    <script src="js/plugins/bootstrap-editable/boostrap-editable.js"></script>	 	
	<script src="js/inspinia.js"></script> 
	<script src="js/plugins/pace/pace.min.js"></script> 
	<script type="text/JavaScript" src="global.js?n=1"></script> 	
	<!-- Custom and plugin javascript -->	 
 	<script src="js/jquery.md5.js"></script>	
	<script src="js/davinci.js"></script>

<script>

var myApp = angular.module("myApp", ["ngRoute"]);

myApp.config(function($routeProvider) {
	$routeProvider
	.when("/", {
		templateUrl : "globalAngular1.html"
	})
	.when("/new", {
		templateUrl : "globalAngular2.html"
	});		 
});



myApp.service('DisconnectService', ['$rootScope','$http', function($rootScope,$http) {
    this.disconnect = function() {
        console.log('disconnect');
    };

	this.GetFormHTML = function(codeType,fieldType,fieldID,fieldName,label,required,prepopulated,optionArr) {					
					$rootScope.tmpReq = ""; 
					$rootScope.tmpPrepop=""; 
					$rootScope.redstar = ""; 		
					if(required == "Yes"){
							$rootScope.tmpReq = ' required="" '; 
							$rootScope.redstar += '<span style="color:red;">&#42;</span>'	; 
					}
					if(prepopulated == "Yes"){
							$rootScope.tmpPrepop = '##'+fieldName+'##'; 						
					}

					$rootScope.tmphtml ='<div class="form-group"><label>'+label+'</label>'+$rootScope.redstar ;
					if(fieldType == "textbox" || fieldType == "email" || fieldType == "mobile" || fieldType == "phone"){
							$rootScope.tmphtml += ' <input class="form-control input-sm" name="'+label+'" '+$rootScope.tmpReq+' type="text" value="'+$rootScope.tmpPrepop+'"> '; 

					}else if(fieldType == "hidden"){						
							$rootScope.tmphtml += ' <input type="hidden" name="'+label+' value="'+$rootScope.tmpPrepop+'"> '; 

					}else if(fieldType == "state"){
							$rootScope.tmphtml += "<br>"+getStateBox($rootScope.tmpReq,$rootScope.tmpPrepop); 

					}else if(fieldType == "country"){
							$rootScope.tmphtml += "<br>"+getCountryBox($rootScope.tmpReq,$rootScope.tmpPrepop); 

					}else if(fieldType == "dropdown"){
					if(optionArr != 'undefined'){
						if(fieldName !="Question1" ){
							$rootScope.tmphtml += ' <input class="form-control input-sm" name="'+label+'" '+$rootScope.tmpReq+' type="text" value="'+$rootScope.tmpPrepop+'"> '; 

						}else{

							$rootScope.tmphtml += ' <select name="'+label+' class="form-control input-sm"> '; 		

							alert("["+fieldName +"] = " +  $rootScope.dropdownOpt[fieldName] );		

							$rootScope.tmphtml += $rootScope.dropdownOpt[fieldName];												
							
							$rootScope.tmphtml += '</select> '; 

						}
					}//if optionArr

					}else if(fieldType == "datetime"){
							var datename = fieldID+"_DATE"; 								
							if(codeType == "HTML"){
								$rootScope.tmphtml += ' <script>$(document).ready(function(){$("#'+datename +' .input-group.date").datepicker({todayBtn: "linked",keyboardNavigation: false,forceParse: false,calendarWeeks: true,autoclose: true});}); <\/script>' ;
							}
							$rootScope.tmphtml += '<div class="form-group" id="'+datename+'"><div class="input-group date"><span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control input-sm" value=""></div></div>' ; 

								
					}else if(fieldType == "radio"){
						$rootScope.tmphtml += ' <input class="form-control input-sm" name="'+label+'" '+$rootScope.tmpReq+' type="text" value="'+$rootScope.tmpPrepop+'"> '; 
						//fungEdit
						//	$rootScope.tmphtml += ' <input type="hidden" name="'+label+' value="'+$rootScope.tmpPrepop+'"> '; 
					}
					$rootScope.tmphtml +="</div>"; 
        };//GetFormHTML

	this.GetDropdownOpt = function() {
					//fungEdit#36
					$http.get("/couchdb/master/Default_FormDropdown"+"?"+new Date().toString()).then(function(response) {
								$rootScope.masterDD  = response.data; 
								if (typeof $rootScope.masterDD == 'undefined') {
								   $rootScope.masterDD = "";
								} 
								$rootScope.dropdownOpt  = angular.copy($rootScope.masterDD);									
								alert("run get drop down finish = "+$rootScope.dropdownOpt.Question1); 
					},function(errResponse){
								if (errResponse.status == 404) {
									$rootScope.dropdownlist = ""; 									
								}							
					});						
				
        };// GetDropdownOpt

		


}]);
                                  
myApp.controller('Ctrl1', ['$scope', 'DisconnectService','$http', function($scope,service,$http) {
	service.GetDropdownOpt(); 
    $scope.disconnect = function() {
		service.GetFormHTML("","dropdown","Question1","Question1","what is your prefer?","Yes","Yes",""); 
		//service.disconnect();
										//(codeType,fieldType,fieldID,fieldName,label,required,prepopulated,optionArr
/*
		$.when( service.GetDropdownOpt() ).then(function() {
    		service.GetFormHTML("","dropdown","Question1","Question1","what is your prefer?","Yes","Yes",""); 
		});	
*/ 
    };
}]);

myApp.controller('Ctrl2', ['$scope', 'DisconnectService', function($scope, service) {
    $scope.disconnect = function() {
        service.disconnect();
    };
}]);

</script>
 </body>
</html>
