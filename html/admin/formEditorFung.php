<?php
    date_default_timezone_set('America/Los_Angeles');
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
    $dbName = $_SESSION['DBNAME'];
    $accountID = $_SESSION['ACCOUNTID'];
    $accountName = $_SESSION['ACCOUNNAME'];
?>

<!-- ***************************************************
THIS PAGE USE  <ng-view>
formEditorEdit.html
formEditorNew.html
*************************************************** -->

<!DOCTYPE html>
<html ng-app="myApp">
<head>
	<title>Form Builder</title>
    <?php include "header.php"; ?>	    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>     
</head>

<body>

<div id="wrapper">
<!-- left wrapper -->
	  <nav class="navbar-default navbar-static-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav metismenu" id="side-menu">     				
					  <li class="nav-header">
						<div class="dropdown profile-element">
								<a data-toggle="dropdown" class="dropdown-toggle">
								<span class="clear"> <span class="block m-t-xs"><a href="myProfileSettings.php"><strong class="font-bold"><br><br><br><br></strong></a></span>
								 </span> 
								 </span> </a>
						</div>
						<div class="logo-element">DV</div>
					</li>
					<li>
						<a href="welcome.php"><i class="fa fa-th-large"></i> <span class="nav-label">Home</span></a>
					</li>
					<li>
						<a href="pickBlueprint.php"><i class="fa fa-plus"></i> <span class="nav-label">Create a Campaign</span></a>
					</li>
					<li>
						<a href="myCampaigns.php"><i class="fa fa-paper-plane-o"></i> <span class="nav-label">My Campaigns</span></a>
					</li>
					 <li>
						<a href="assetLibrary.php"><i class="fa fa-files-o"></i> <span class="nav-label">Asset Library<span class="label label-warning pull-right">NEW</span></a>
					</li>    
					<li>
						<a href="audiences.php"><i class="fa fa-address-book"></i> <span class="nav-label">Audiences</span></a>
					</li>
					<li>
						<a href="accountSetting.php"><i class="fa fa-wrench"></i> <span class="nav-label">Settings</span></a>
					</li>
					<li>
						<a href="helpCenter.php"><i class="fa fa-question-circle"></i> <span class="nav-label">Help Center & Live Chat</span></a>
					</li>
				</ul>
			</div>
		</nav>
<!-- left wrapper -->
<div class="gray-bg" id="page-wrapper">
<!-- top wrapper -->
			<div class="row wrapper border-bottom white-bg page-heading">
				<div class="col-lg-10">
					<h2>Form Builder</h2>
					<ol class="breadcrumb">
						<li>
							<a href="dv.php?page=formLibrary">Create a Form</a>
						</li>
						<li class="active"><strong></strong></li>
					</ol>
				</div>
				<div class="col-lg-2"></div>
			</div>
<!-- top wrapper -->

<div ng-view></div>
	


</div><!-- page-wrapper -->
</div><!-- wrapper -->


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
	<script src="js/moment.js"></script>
 	<script src="js/jquery.md5.js"></script>	
	<script src="js/davinci.js"></script>

<script>
	
var fID = getParameterByName("fID");
//fID = "a1"; 
var indx = -1; 
var defIndx = -1; 
var dbName = "<?php echo $dbName; ?>";

var myApp = angular.module("myApp", ["ngRoute"]);
myApp.config(function($routeProvider) {
	$routeProvider
	.when("/", {
		templateUrl : "formEditorEditFung.html"
	})
	.when("/new", {
		templateUrl : "formEditorNewFung.html"
	});		 
});

myApp.controller('myCtrl',function($scope,$http) {
			$scope.state = {	"Save":"Save",	};
			$scope.defID = ""; 	
			$scope.tempArr = []; 
			$scope.SaveForm = function() {			
					$scope.state['Save'] = "Saving";				
					$scope.GenSelectedFromHTML(); 
					$scope.MyCopyItem('formHTML',$scope.selectedFromHTML);
					$scope.MyCopyItem('allFieldName',$scope.allFieldName); 
					var today = moment().format('MMM D, YYYY HH:mm:ss'); //with moment.js
					$scope.MyCopyItem('modifiedDate',today);	
					$scope.MyCopyItem('formType_DefID',$scope.defID);	

					$http.put('/couchdb/' + dbName +'/formLibrary',  $scope.frmlist).then(function(response){
							 $scope.LoadDefault('new'); 
							 //alert("Save success");
							 $scope.state['Save'] = "Save";

					});         
            };
			$scope.CopyScope = function (ItemName,data) {
				$scope[ItemName] = data; 
			};
			$scope.MyCopyItem = function (ItemName,data) {
				if(indx != -1)
					$scope.frmlist.items[indx][ItemName] = data; 
				else
					$scope.selectItem[ItemName] = data; 
			};

			$scope.LoadRightBlock = function() {
					var summerdivtxt = ''; 
					if(typeof $scope.selectItem != 'undefined') {
							for(i=0;i<$scope.selectItem.length;i++){								
									summerdivtxt += getFormCode($scope.selectItem[i].fieldType,$scope.selectItem[i].fieldID,$scope.selectItem[i].fieldName,$scope.selectItem[i].label,$scope.selectItem[i].required,$scope.selectItem[i].prepopulated,$scope.selectItem[i].option); 								
							}
					}
					$('#summerblock').html(summerdivtxt); 
            };
			
			$scope.LoadSelect = function() {                
				$http.get("/couchdb/" + dbName +'/formLibrary'+"?"+new Date().toString()).then(function(response) {
							$scope.master  = response.data; 
							if (typeof $scope.master.items == 'undefined') {
							   $scope.master.items = [];
							} 
							$scope.frmlist  = angular.copy($scope.master);
							indx = $scope.frmlist.items.getIndexByValue('formID',fID);		
							$scope.selectFrm = $scope.frmlist.items[indx];
							$scope.selectItem = $scope.frmlist.items[indx]['fieldLists']; 
							$scope.LoadRightBlock(); 
							$scope.tempArr = $scope.selectItem;  							
							$scope.defID = $scope.frmlist.items[indx]['formType_DefID']; 
							
				},function(errResponse){
							if (errResponse.status == 404) {
								$scope.frmlist = {items:[]};
							}							
                });				
            };

			$scope.LoadDefault = function(load) { 			
				if(load=="new"){
					$scope.LoadSelect(); 
				}
				$http.get("/couchdb/master/Default_FormLibrary"+"?"+new Date().toString()).then(function(response) {
							$scope.masterDef  = response.data; 
							if (typeof $scope.masterDef.items == 'undefined') {
							   $scope.masterDef.items = [];
							} 
							$scope.deflist  = angular.copy($scope.masterDef);

							if(typeof $scope.defID == 'undefined' || $scope.defID=="" ){								
								defIndx = $scope.deflist.items.getIndexByValue('defaultID',load);
							}else{
								defIndx = $scope.deflist.items.getIndexByValue('defaultID',$scope.defID);		
								//$scope.deflist.items[0]['fieldLists'].formSelected = ""; 
								$scope.deflist.items[defIndx]['fieldLists'].formSelected = "selected";
							}
							//$scope.defItem = $scope.deflist.items[defIndx]['fieldLists']; 						
							//alert(defIndx); 
							$scope.CheckDupOnLoad(defIndx); 

				},function(errResponse){
							if (errResponse.status == 404) {
								$scope.deflist = {items:[]};
							}
                });
            };

			$scope.CheckDupOnLoad = function(index) {
					if(index=="-1" ){		index= "0";	}
					if(typeof $scope.selectItem != 'undefined') {
							var defArr = []; 							
							for(i=0;i<$scope.deflist.items[index]['fieldLists'].length;i++){
									var isDup = false; 
									for(k=0;k<$scope.selectItem.length;k++){
											if($scope.deflist.items[index]['fieldLists'][i].fieldID == $scope.selectItem[k].fieldID){
												isDup = true; 
												break; 
											}else{
												isDup = false; 
											}
									}//for k
									if(!isDup){
											defArr.push($scope.deflist.items[index]['fieldLists'][i]); 
									}
							}//for i
							$scope.defItem = defArr; 
							$scope.defID = $scope.deflist.items[index]['defaultID'];
					}else{
							$scope.defItem = $scope.deflist.items[index]['fieldLists']; 	
							$scope.defID = $scope.deflist.items[index]['defaultID'];
					}
            };

			$scope.SelectChanged = function(defFrmID) { //
				$scope.defID = defFrmID; 
				$scope.LoadDefault(defFrmID);	//send DefID to reload Available field
				//$('.alerttest').html(" formtype = "+ftype);
            };			
			$scope.Reset = function() {                  

            };			

			$scope.SetRequire = function() {
                  var txt=$scope.selectItem;
            };	
				
			$scope.GenSelectedFromHTML = function() {
				reloadformfield('edit'); 
				var temphtml = ""; 
				var allFieldName =""; 
				for(i=0;i<$scope.tempArr.length;i++){
						
						allFieldName += $scope.tempArr[i].fieldName;
						if(i<$scope.tempArr.length-1){		allFieldName +=", ";		}				

						temphtml += getFormCode($scope.tempArr[i].fieldType,$scope.tempArr[i].fieldID,$scope.tempArr[i].fieldName,$scope.tempArr[i].label,$scope.tempArr[i].required,$scope.tempArr[i].prepopulated,$scope.tempArr[i].option); 					
				}//end for i
				$scope.allFieldName = allFieldName; 
				$scope.selectedFromHTML = '<div class="col-lg-4 ibox ibox-content well"><form action="#" id="rzForm" name="rzForm" method="post"><fieldset>'+temphtml+'<button class="btn btn-lg btn-block btn-warning" type="submit">Download Now!</button><p class="rz-required-note"><i>* Indicates a required field.<br>Answer all required fields to activate the button.</i></p> </fieldset></form><div>' ; 		
                  
            };// end GenSelectedFromHTML()		
			
			$scope.LoadDefault('new');				
});



myApp.controller('myNewCtrl',function($rootScope,$scope,$http) {
			$scope.state = {	"Save":"Save",	};
			$scope.defID = ""; 	
			$scope.tempArr = []; 
			$scope.SaveNewForm = function() {							
					var LName = $('#frmName').val();			
					if(LName != ''){
						var keyword = LName+getCurrentDateTime();
						var conID = $.md5(keyword);      
						$scope.LoadSaveData(conID); 
					}else{
						$('.listNameAlt').html("Please fill Form Name");
					}
            };		

			$scope.LoadSaveData = function (formID) {
				$scope.GenSelectedFromHTML();  // create $scope.selectedFromHTML / $scope.allFieldName
				var frmName = $('#frmName').val(); 
				var frmtype_defID = $scope.defID; //formType_DefID 
				var submission = "";
				var modDate = moment().format('MMM D, YYYY HH:mm:ss'); //with moment.js  //modifiedDate
				var allfield = $scope.allFieldName; //allFieldName
				var formhtml = $scope.selectedFromHTML;  //formHTML

				$http.get("/couchdb/" + dbName +'/formLibrary'+"?"+new Date().toString()).then(function(response) {
							$rootScope.master  = response.data; 
							if (typeof $rootScope.master.items == 'undefined') {
									$rootScope.master.items = [];
							} 
							$scope.frmlist  = angular.copy($scope.master);
							$scope.frmlist  = angular.copy($rootScope.master);						 
							$scope.frmlist.items.push({
									"formID":formID,
									"formName":frmName,
									"formType_DefID":frmtype_defID,
									"submission":submission,
									"modifiedDate":modDate,
									"allFieldName":allfield,
									"formHTML":formhtml,
									"fieldLists":$scope.selectItem
							});
							$scope.SaveDB(formID); 
					},function(errResponse){
							if (errResponse.status == 404) {
									$scope.frmlist = {items:[]};
									$scope.frmlist.items.push({
										"formID":formID,
										"formName":frmName,
										"formType_DefID":frmtype_defID,
										"submission":submission,
										"modifiedDate":modDate,
										"allFieldName":allfield,
										"formHTML":formhtml,
										"fieldLists":$scope.selectItem
									});
									$scope.SaveDB(formID); 
							}
					});
			
            };

			$scope.SaveDB = function(cID) {					
                $scope.state['Save'] = "Saving";
				$http.put('/couchdb/' + dbName +'/formLibrary',  $scope.frmlist).then(function(response){
						 //alert("Save success");
						 window.location.href="formEditor.php?fID="+cID; 
						 //$scope.state['Save'] = "Save";

				});                    
			};

			$scope.CopyScope = function (ItemName,data) {
				$scope[ItemName] = data; 
			};
			$scope.MyCopyItem = function (ItemName,data) {
				if(indx != -1)
					$scope.frmlist.items[indx][ItemName] = data; 
				else
					$scope.selectItem[ItemName] = data; 
			};

			$scope.LoadRightBlock = function() {
					var summerdivtxt = ''; 
					if(typeof $scope.selectItem != 'undefined') {
							for(i=0;i<$scope.selectItem.length;i++){								
									summerdivtxt += getFormCode($scope.selectItem[i].fieldType,$scope.selectItem[i].fieldID,$scope.selectItem[i].fieldName,$scope.selectItem[i].label,$scope.selectItem[i].required,$scope.selectItem[i].prepopulated,$scope.selectItem[i].option); 								
							}
					}
					$('#summerblock').html(summerdivtxt); 
            };

			//Default Set Middle block From Start 
			$scope.LoadNewPageSelect = function() {                
				$scope.selectItem = [];	
				$scope.selectItem.push({"fieldID":"femail", "fieldName":"Email", "label": "Email","required": "Yes","prepopulated": "No","fieldType": "email" }); 
				$scope.selectItem.push({"fieldID":"fname", "fieldName":"First Name", "label": "First Name","required": "Yes","prepopulated": "No","fieldType": "textbox" }); 
				$scope.LoadRightBlock(); 
				$scope.tempArr = $scope.selectItem;  		
				
            };
			
			$scope.LoadNewPageDefault = function(load) { 			
				if(load=="new"){
					$scope.LoadNewPageSelect(); 
				}
				$http.get("/couchdb/master/Default_FormLibrary"+"?"+new Date().toString()).then(function(response) {
							$scope.masterDef  = response.data; 
							if (typeof $scope.masterDef.items == 'undefined') {
							   $scope.masterDef.items = [];
							} 
							$scope.deflist  = angular.copy($scope.masterDef);

							if(typeof $scope.defID == 'undefined' || $scope.defID=="" ){								
								defIndx = $scope.deflist.items.getIndexByValue('defaultID',load);								
							}else{
								defIndx = $scope.deflist.items.getIndexByValue('defaultID',$scope.defID);		
								//$scope.deflist.items[0]['fieldLists'].formSelected = ""; 
								$scope.deflist.items[defIndx]['fieldLists'].formSelected = "selected";
							}
							//$scope.defItem = $scope.deflist.items[defIndx]['fieldLists']; 						
							//alert(defIndx); 
							$scope.CheckDupOnLoad(defIndx); 
							
							if(load=='new'){
								/* //fung
									//set option on start
									var defaultVal = document.getElementById('femailPrepop').value;
									setOptionSelected("femailPrefill",defaultVal);
									defaultVal = document.getElementById('fnamePrepop').value;
									setOptionSelected("fnamePrefill",defaultVal);									
									*/ 
							}

				},function(errResponse){
							if (errResponse.status == 404) {
								$scope.deflist = {items:[]};
							}
                });
            };

			$scope.CheckDupOnLoad = function(index) {
					if(index=="-1" ){		index= "0";	}
					if(typeof $scope.selectItem != 'undefined') {
							var defArr = []; 							
							for(i=0;i<$scope.deflist.items[index]['fieldLists'].length;i++){
									var isDup = false; 
									for(k=0;k<$scope.selectItem.length;k++){
											if($scope.deflist.items[index]['fieldLists'][i].fieldID == $scope.selectItem[k].fieldID){
												isDup = true; 
												break; 
											}else{
												isDup = false; 
											}
									}//for k
									if(!isDup){
											defArr.push($scope.deflist.items[index]['fieldLists'][i]); 
									}
							}//for i
							$scope.defItem = defArr; 
							$scope.defID = $scope.deflist.items[index]['defaultID'];
					}else{
							$scope.defItem = $scope.deflist.items[index]['fieldLists']; 	
							$scope.defID = $scope.deflist.items[index]['defaultID'];
					}					
            };

			$scope.SelectChanged = function(defFrmID) { //
				$scope.defID = defFrmID; 
				$scope.LoadNewPageDefault(defFrmID);	//send DefID to reload Available field
				//$('.alerttest').html(" formtype = "+ftype);
            };			
			$scope.Reset = function() {                  

            };			

			$scope.SetRequire = function(selid,hidid) {
                  alert( document.getElementById(selid).val() );
                  alert( document.getElementById(hidid).val() );
            };	
				
			$scope.GenSelectedFromHTML = function() {
				reloadformfield('new'); 
				var temphtml = ""; 
				var allFieldName =""; 
				for(i=0;i<$scope.tempArr.length;i++){
						
						allFieldName += $scope.tempArr[i].fieldName;
						if(i<$scope.tempArr.length-1){		allFieldName +=", ";		}				

						temphtml += getFormCode($scope.tempArr[i].fieldType,$scope.tempArr[i].fieldID,$scope.tempArr[i].fieldName,$scope.tempArr[i].label,$scope.tempArr[i].required,$scope.tempArr[i].prepopulated,$scope.tempArr[i].option); 					
				}//end for i
				$scope.allFieldName = allFieldName; 
				$scope.selectedFromHTML = '<div class="col-lg-4 ibox ibox-content well"><form action="#" id="rzForm" name="rzForm" method="post"><fieldset>'+temphtml+'<button class="btn btn-lg btn-block btn-warning" type="submit">Download Now!</button><p class="rz-required-note"><i>* Indicates a required field.<br>Answer all required fields to activate the button.</i></p> </fieldset></form><div>' ; 		
                  
            };// end GenSelectedFromHTML()		

			$scope.LoadNewPageDefault('new');	
			
});

function setOptionSelected(ename,defaultVal){		
			var eid = document.getElementById(ename);
			if(eid != "undefined"){
				$("#"+ename).find("option").each(function () {
					if ($(this).val() == defaultVal) {
						$(this).prop("selected", "selected");
					}
				});
//				$("#"+ename).find("option").each(function () {					alert(ename +" = " + $(this).val()); 				});
				
			}
}

function reloadformfield(page){	
						   var form_fields = $( "#form_fields" ).sortable( "toArray" );				   
							var summerdivtxt = ''; 				//display right block 
							var tempArr=[]; 
							for(i=0;i<form_fields.length;i++){							
								var fFieldName = $(document.getElementById(form_fields[i]+"FieldName")).val();	
								var fFieldType = $(document.getElementById(form_fields[i]+"FieldType")).val();	
								var flabel = $(document.getElementById(form_fields[i]+"Label")).val();	
								var frequire = $(document.getElementById(form_fields[i]+"Require")).val();	
								var fprefill = $(document.getElementById(form_fields[i]+"Prefill")).val();	
								var fprepop = $(document.getElementById(form_fields[i]+"Prepop")).val();	
								var freq = $(document.getElementById(form_fields[i]+"Req")).val();	
								//add array
								tempArr.push({"fieldID":form_fields[i], "fieldName":fFieldName, "label": flabel,"required": frequire,"prepopulated": fprefill,"fieldType": fFieldType }); 
								summerdivtxt += getFormCode("textbox",form_fields[i],fFieldName,flabel,frequire,fprefill,""); 	
							}//end for i
							if(page=='new'){
								angular.element(document.getElementById('myNewCtrl')).scope().CopyScope('selectItem',tempArr);
								angular.element(document.getElementById('myNewCtrl')).scope().CopyScope('tempArr',tempArr);		
							}else{
								angular.element(document.getElementById('myCtrl')).scope().MyCopyItem('fieldLists',tempArr);
								angular.element(document.getElementById('myCtrl')).scope().CopyScope('tempArr',tempArr);
							}
							$('#summerblock').html(summerdivtxt); 		
}

function getFormCode(fieldType,fieldID,fieldName,label,required,prepopulated,option){	
		var tmpReq = ""; 
		var tmpPrepop=""; 
		var redstar = ""; 		
		if(required == "Yes"){
				tmpReq = ' required="" '; 
				redstar += '<span style="color:red;">&#42;</span>'	; 
		}
		if(prepopulated == "Yes"){
				tmpPrepop = '##'+fieldName+'##'; 						
		}

	    var temphtml ='<div class="form-group"><label>'+label+'</label>'+redstar ;
		if(fieldType == "textbox" || fieldType == "email" || fieldType == "mobile" || fieldType == "phone"){
				temphtml += ' <input class="form-control input-sm" name="'+label+'" '+tmpReq+' type="text" value="'+tmpPrepop+'"> '; 

		}else if(fieldType == "hidden"){						
				temphtml += ' <input type="hidden" name="'+label+' value="'+tmpPrepop+'"> '; 

		}else if(fieldType == "state"){
				temphtml += getStateBox(); 

/*		}else if(fieldType == "country"){
				temphtml += getStateBox(); 
*/ 
		}else if(fieldType == "dropdown"){
				temphtml += ' <select name="'+label+'> '+option+'</select> '; 

		}else if(fieldType == "datetime"){
				var datename = fieldID+"_DATE"; 							
				temphtml += ' <script>$(document).ready(function(){$("#'+datename +' .input-group.date").datepicker({todayBtn: "linked",keyboardNavigation: false,forceParse: false,calendarWeeks: true,autoclose: true});}); < /script>  ' ;

				temphtml += '<div class="form-group" id="'+datename+'"><label>'+label+'</label><div class="input-group date"><span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value=""></div></div>' ; 
					
		}else if(fieldType == "radio"){
				temphtml += ' <input type="hidden" name="'+label+' value="'+tmpPrepop+'"> '; 
		}
		temphtml +="</div>"; 

		//var summerdivtxt += '<label>'+label+'</label>'+redstar+'<input class="form-control input-sm" name="'+label+'" '+tmpReq+' type="text" value="'+tmpPrepop+'"></div>' ; 
		return  temphtml;         
};


function getStateBox(){
		var stateHTML ='<select style="font-size: 16px" name="State" id="State">'; 
			  stateHTML +='<option value="">Choose Your State</option>';
			  stateHTML +='<option value="AL">Alabama</option>';
			  stateHTML +='<option value="AK">Alaska</option>';
			  stateHTML +='<option value="AB">Alberta</option>';
			  stateHTML +='<option value="AZ">Arizona</option>';
			  stateHTML +='<option value="AR">Arkansas</option>';
			  stateHTML +='<option value="BC">British Columbia</option>';
			  stateHTML +='<option value="CA">California</option>';
			  stateHTML +='<option value="CO">Colorado</option>';
			  stateHTML +='<option value="CT">Connecticut</option>';
			  stateHTML +='<option value="DE">Delaware</option>';
			  stateHTML +='<option value="DC">District of Columbia</option>';
			  stateHTML +='<option value="FL">Florida</option>';
			  stateHTML +='<option value="GA">Georgia</option>';
			  stateHTML +='<option value="HI">Hawaii</option>';
			  stateHTML +='<option value="ID">Idaho</option>';
			  stateHTML +='<option value="IL">Illinois</option>';
			  stateHTML +='<option value="IN">Indiana</option>';
			  stateHTML +='<option value="IA">Iowa</option>';
			  stateHTML +='<option value="KS">Kansas</option>';
			  stateHTML +='<option value="KY">Kentucky</option>';
			  stateHTML +='<option value="LA">Louisiana</option>';
			  stateHTML +='<option value="ME">Maine</option>';
			  stateHTML +='<option value="MB">Manitoba</option>';
			  stateHTML +='<option value="MD">Maryland</option>';
			  stateHTML +='<option value="MA">Massachusetts</option>';
			  stateHTML +='<option value="MI">Michigan</option>';
			  stateHTML +='<option value="MN">Minnesota</option>';
			  stateHTML +='<option value="MS">Mississippi</option>';
			  stateHTML +='<option value="MO">Missouri</option>';
			  stateHTML +='<option value="MT">Montana</option>';
			  stateHTML +='<option value="NE">Nebraska</option>';
			  stateHTML +='<option value="NV">Nevada</option>';
			  stateHTML +='<option value="NB">New Brunswick</option>';
			  stateHTML +='<option value="NH">New Hampshire</option>';
			  stateHTML +='<option value="NJ">New Jersey</option>';
			  stateHTML +='<option value="NM">New Mexico</option>';
			  stateHTML +='<option value="NY">New York</option>';
			  stateHTML +='<option value="NF">Newfoundland & Labrador</option>';
			  stateHTML +='<option value="NC">North Carolina</option>';
			  stateHTML +='<option value="ND">North Dakota</option>';
			  stateHTML +='<option value="NW">Northwest Territories</option>';
			  stateHTML +='<option value="NS">Nova Scotia</option>';
			  stateHTML +='<option value="NU">Nunavut</option>';
			  stateHTML +='<option value="OH">Ohio</option>';
			  stateHTML +='<option value="OK">Oklahoma</option>';
			  stateHTML +='<option value="ON">Ontario</option>';
			  stateHTML +='<option value="OR">Oregon</option>';
			  stateHTML +='<option value="PA">Pennsylvania</option>';
			  stateHTML +='<option value="PE">Prince Edward Island</option>';
			  stateHTML +='<option value="QC">Quebec</option>';
			  stateHTML +='<option value="RI">Rhode Island</option>';
			  stateHTML +='<option value="SK">Saskatchewan</option>';
			  stateHTML +='<option value="SC">South Carolina</option>';
			  stateHTML +='<option value="SD">South Dakota</option>';
			  stateHTML +='<option value="TN">Tennessee</option>';
			  stateHTML +='<option value="TX">Texas</option>';
			  stateHTML +='<option value="UT">Utah</option>';
			  stateHTML +='<option value="VT">Vermont</option>';
			  stateHTML +='<option value="VA">Virginia</option>';
			  stateHTML +='<option value="WA">Washington</option>';
			  stateHTML +='<option value="WV">West Virginia</option>';
			  stateHTML +='<option value="WI">Wisconsin</option>';
			  stateHTML +='<option value="WY">Wyoming</option>';
			  stateHTML +='<option value="YU">Yukon</option>';
			  stateHTML +='<option value="OT">Other</option>';
			  stateHTML +='</select>';
			  return stateHTML; 
}
</script>

</body>
</html>