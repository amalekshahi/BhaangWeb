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

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<script src="js/jquery-3.1.1.min.js"></script>   
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>
<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
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
	<!-- <script src="js/moment.js"></script> -->
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
		templateUrl : "formEditorEdit.html"
	})
	.when("/new", {
		templateUrl : "formEditorNew.html"
	});		 
});

myApp.run(function($globalScope) {

		$globalScope.Func = function() {
					alert("I'm global foo!");
        };

		$globalScope.GetDropdownOpt = function() {
					//fungEdit#36
					//$http.get("/couchdb/master/Default_FormDropdown'+"?"+new Date().toString()).then(function(response) {
					$http.get("/couchdb/" + dbName +'/Default_FormDropdown'+"?"+new Date().toString()).then(function(response) {
								$globalScope.masterDD  = response.data; 
								if (typeof $globalScope.masterDD == 'undefined') {
								   $globalScope.masterDD = ;
								} 
								$globalScope.dropdownOpt  = angular.copy($globalScope.masterDD);									
								
					},function(errResponse){
								if (errResponse.status == 404) {
									$globalScope.dropdownlist = ""; 									
								}							
					});						
				
        };// GetDropdownOpt

		
        $globalScope.GetFormHTML = function(codeType,fieldType,fieldID,fieldName,label,required,prepopulated,optionArr) {
					$globalScope.tmpReq = ""; 
					$globalScope.tmpPrepop=""; 
					$globalScope.redstar = ""; 		
					if(required == "Yes"){
							$globalScope.tmpReq = ' required="" '; 
							$globalScope.redstar += '<span style="color:red;">&#42;</span>'	; 
					}
					if(prepopulated == "Yes"){
							$globalScope.tmpPrepop = '##'+fieldName+'##'; 						
					}

					$globalScope.tmphtml ='<div class="form-group"><label>'+label+'</label>'+$globalScope.redstar ;
					if(fieldType == "textbox" || fieldType == "email" || fieldType == "mobile" || fieldType == "phone"){
							$globalScope.tmphtml += ' <input class="form-control input-sm" name="'+label+'" '+$globalScope.tmpReq+' type="text" value="'+$globalScope.tmpPrepop+'"> '; 

					}else if(fieldType == "hidden"){						
							$globalScope.tmphtml += ' <input type="hidden" name="'+label+' value="'+$globalScope.tmpPrepop+'"> '; 

					}else if(fieldType == "state"){
							$globalScope.tmphtml += "<br>"+getStateBox($globalScope.tmpReq,$globalScope.tmpPrepop); 

					}else if(fieldType == "country"){
							$globalScope.tmphtml += "<br>"+getCountryBox($globalScope.tmpReq,$globalScope.tmpPrepop); 

					}else if(fieldType == "dropdown"){
					if(optionArr != 'undefined'){
						if(fieldName !="Question1" ){

							$globalScope.tmphtml += ' <input class="form-control input-sm" name="'+label+'" '+$globalScope.tmpReq+' type="text" value="'+$globalScope.tmpPrepop+'"> '; 

						}else{

							$globalScope.tmphtml += ' <select name="'+label+' class="form-control input-sm"> '; 		
								
							GetDropdownOpt(); 
*****							$globalScope.dropdownOpt.
							$globalScope.tmphtml += ; 		
							
					
							$globalScope.tmphtml += '</select> '; 

						}
					}//if optionArr

					}else if(fieldType == "datetime"){
							var datename = fieldID+"_DATE"; 								
							if(codeType == "HTML"){
								$globalScope.tmphtml += ' <script>$(document).ready(function(){$("#'+datename +' .input-group.date").datepicker({todayBtn: "linked",keyboardNavigation: false,forceParse: false,calendarWeeks: true,autoclose: true});}); <\/script>' ;
							}
							$globalScope.tmphtml += '<div class="form-group" id="'+datename+'"><div class="input-group date"><span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control input-sm" value=""></div></div>' ; 

								
					}else if(fieldType == "radio"){
						$globalScope.tmphtml += ' <input class="form-control input-sm" name="'+label+'" '+$globalScope.tmpReq+' type="text" value="'+$globalScope.tmpPrepop+'"> '; 
						//fungEdit
						//	$globalScope.tmphtml += ' <input type="hidden" name="'+label+' value="'+$globalScope.tmpPrepop+'"> '; 
					}
					$globalScope.tmphtml +="</div>"; 
        };//GetFormHTML


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
//					var today = moment().format('MMM D, YYYY HH:mm:ss'); //with moment.js
					var today = getCurrentDateTime(); 
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
					var darray = []; 
					if(typeof $scope.selectItem != 'undefined') {

							for(i=0;i<$scope.selectItem.length;i++){								
									summerdivtxt += getFormCode("",$scope.selectItem[i].fieldType,$scope.selectItem[i].fieldID,$scope.selectItem[i].fieldName,$scope.selectItem[i].label,$scope.selectItem[i].required,$scope.selectItem[i].prepopulated,$scope.selectItem[i].option); 
									if($scope.selectItem[i].fieldType == 'datetime'){
											var datename = $scope.selectItem[i].fieldID+"_DATE"; 
											darray.push(datename); 											
									}
							}//end for i
					}
					$('#summerblock').html(summerdivtxt); 
					if(darray.length > 0 ){
						for(k=0;k<darray.length;k++){
							runScriptDate(darray[i]); 
						}
					}
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
//fungEdit#36			
				//$http.get("/couchdb/master/Default_FormLibrary"+"?"+new Date().toString()).then(function(response) {
				$http.get("/couchdb/" + dbName +'/mastertest'+"?"+new Date().toString()).then(function(response) {

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
				//$scope.defID = defFrmID; 
				$scope.LoadDefault($scope.defID);	//send DefID to reload Available field
//$scope.LoadDefault(defFrmID);	//send DefID to reload Available field
				//$('.alerttest').html(" formtype = "+ftype);
            };								
			$scope.Reset = function() {

            };
			
			$scope.getOptions = function(fieldid) {


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

						temphtml += getFormCode("HTML",$scope.tempArr[i].fieldType,$scope.tempArr[i].fieldID,$scope.tempArr[i].fieldName,$scope.tempArr[i].label,$scope.tempArr[i].required,$scope.tempArr[i].prepopulated,$scope.tempArr[i].option); 					
				}//end for i
				$scope.allFieldName = allFieldName; 
				$scope.selectedFromHTML = '<form action="#" id="rzForm" name="rzForm" method="post"><fieldset>'+temphtml+'<button class="btn btn-lg btn-block btn-warning" type="submit">Download Now!</button><p class="rz-required-note"><i>* Indicates a required field.<br>Answer all required fields to activate the button.</i></p> </fieldset></form>' ; 		
                  
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
//				var modDate = moment().format('MMM D, YYYY HH:mm:ss'); //with moment.js  //modifiedDate
				var modDate = getCurrentDateTime(); 
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
					var darray = []; 
					if(typeof $scope.selectItem != 'undefined') {
							for(i=0;i<$scope.selectItem.length;i++){								
									summerdivtxt += getFormCode("",$scope.selectItem[i].fieldType,$scope.selectItem[i].fieldID,$scope.selectItem[i].fieldName,$scope.selectItem[i].label,$scope.selectItem[i].required,$scope.selectItem[i].prepopulated,$scope.selectItem[i].option); 
									if($scope.selectItem[i].fieldType == 'datetime'){
											var datename = $scope.selectItem[i].fieldID+"_DATE"; 
											darray.push(datename); 											
									}
							}
					}
					$('#summerblock').html(summerdivtxt); 
					if(darray.length > 0 ){
						for(k=0;k<darray.length;k++){
							runScriptDate(darray[i]); 
						}
					}
            };

			//Default Set Middle block From Start 
			$scope.LoadNewPageSelect = function() {                
				$scope.selectItem = [];	
				$scope.selectItem.push({"fieldID":"femail", "fieldName":"Email", "label": "Email","required": "No","prepopulated": "No","fieldType": "email" }); 
				$scope.selectItem.push({"fieldID":"fname", "fieldName":"First Name", "label": "First Name","required": "No","prepopulated": "No","fieldType": "textbox" }); 
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
				//$scope.defID = defFrmID; 
//				$scope.LoadNewPageDefault(defFrmID);	//send DefID to reload Available field
				$scope.LoadNewPageDefault($scope.defID);	//send DefID to reload Available field
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

						temphtml += getFormCode("HTML",$scope.tempArr[i].fieldType,$scope.tempArr[i].fieldID,$scope.tempArr[i].fieldName,$scope.tempArr[i].label,$scope.tempArr[i].required,$scope.tempArr[i].prepopulated,$scope.tempArr[i].option); 					
				}//end for i
				$scope.allFieldName = allFieldName; 
				$scope.selectedFromHTML = '<form action="#" id="rzForm" name="rzForm" method="post"><fieldset>'+temphtml+'<button class="btn btn-lg btn-block btn-warning" type="submit">Download Now!</button><p class="rz-required-note"><i>* Indicates a required field.<br>Answer all required fields to activate the button.</i></p> </fieldset></form>' ; 		
                  
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
			summerdivtxt += getFormCode("",fFieldType,form_fields[i],fFieldName,flabel,frequire,fprefill,""); 	
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
//codeType = "HTML" plus gen <script> tag in code
function getFormCode(codeType,fieldType,fieldID,fieldName,label,required,prepopulated,optionArr){	
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
				temphtml += "<br>"+getStateBox(tmpReq,tmpPrepop); 

		}else if(fieldType == "country"){
				temphtml += "<br>"+getCountryBox(tmpReq,tmpPrepop); 

		}else if(fieldType == "dropdown"){
		if(optionArr != 'undefined'){
			if(fieldName !="Question1" ){

				temphtml += ' <input class="form-control input-sm" name="'+label+'" '+tmpReq+' type="text" value="'+tmpPrepop+'"> '; 

			}else{

				temphtml += ' <select name="'+label+' class="form-control input-sm"> '; 
				alert(fieldID); 
					
				//getdropdown(fieldID); 
				
		
				temphtml += '</select> '; 

			}
		}//if optionArr

		}else if(fieldType == "datetime"){
				var datename = fieldID+"_DATE"; 								
				if(codeType == "HTML"){
					temphtml += ' <script>$(document).ready(function(){$("#'+datename +' .input-group.date").datepicker({todayBtn: "linked",keyboardNavigation: false,forceParse: false,calendarWeeks: true,autoclose: true});}); <\/script>' ;
				}
				temphtml += '<div class="form-group" id="'+datename+'"><div class="input-group date"><span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control input-sm" value=""></div></div>' ; 

					
		}else if(fieldType == "radio"){
			temphtml += ' <input class="form-control input-sm" name="'+label+'" '+tmpReq+' type="text" value="'+tmpPrepop+'"> '; 
			//fungEdit
			//	temphtml += ' <input type="hidden" name="'+label+' value="'+tmpPrepop+'"> '; 
		}
		temphtml +="</div>"; 
		return  temphtml;         
};

function getStateBox(tmpReq,tmpPrepop){
		var stateHTML ='<select class="form-control input-sm" name="State" id="State" value="'+tmpPrepop+'">'; 
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

function getCountryBox(tmpReq,tmpPrepop){
	var countryHTML = '<select class="form-control input-sm" name="country" id="Country" value="'+tmpPrepop+'">'; 
	      countryHTML += '<option value="">Choose Your Country</option>';
	      countryHTML += '<option value="US">United States</option>';
	      countryHTML += '<option value="CA">Canada</option>';
	      countryHTML += '<option value="AF">Afghanistan</option>';
	      countryHTML += '<option value="AL">Albania</option>';
	      countryHTML += '<option value="DZ">Algeria</option>';
	      countryHTML += '<option value="AS">American Samoa</option>';
	      countryHTML += '<option value="AD">Andorra</option>';
	      countryHTML += '<option value="AO">Angola</option>';
	      countryHTML += '<option value="AI">Anguilla</option>';
	      countryHTML += '<option value="AQ">Antarctica</option>';
	      countryHTML += '<option value="AG">Antigua and Barbuda</option>';
	      countryHTML += '<option value="AR">Argentina</option>';
	      countryHTML += '<option value="AM">Armenia</option>';
	      countryHTML += '<option value="AW">Aruba</option>';
	      countryHTML += '<option value="AU">Australia</option>';
	      countryHTML += '<option value="AT">Austria</option>';
	      countryHTML += '<option value="AZ">Azerbaijan</option>';
	      countryHTML += '<option value="BS">Bahamas</option>';
	      countryHTML += '<option value="BH">Bahrain</option>';
	      countryHTML += '<option value="BD">Bangladesh</option>';
	      countryHTML += '<option value="BB">Barbados</option>';
	      countryHTML += '<option value="BY">Belarus</option>';
	      countryHTML += '<option value="BE">Belgium</option>';
	      countryHTML += '<option value="BZ">Belize</option>';
	      countryHTML += '<option value="BJ">Benin</option>';
	      countryHTML += '<option value="BM">Bermuda</option>';
	      countryHTML += '<option value="BT">Bhutan</option>';
	      countryHTML += '<option value="BO">Bolivia</option>';
	      countryHTML += '<option value="BA">Bosnia and Herzegowina</option>';
	      countryHTML += '<option value="BW">Botswana</option>';
	      countryHTML += '<option value="BV">Bouvet Island</option>';
	      countryHTML += '<option value="BR">Brazil</option>';
	      countryHTML += '<option value="IO">British Indian Ocean Territory</option>';
	      countryHTML += '<option value="BN">Brunei Darussalam</option>';
	      countryHTML += '<option value="BG">Bulgaria</option>';
	      countryHTML += '<option value="BF">Burkina Faso</option>';
	      countryHTML += '<option value="BI">Burundi</option>';
	      countryHTML += '<option value="KH">Cambodia</option>';
	      countryHTML += '<option value="CM">Cameroon</option>';
	      countryHTML += '<option value="CV">Cape Verde</option>';
	      countryHTML += '<option value="KY">Cayman Islands</option>';
	      countryHTML += '<option value="CF">Central African Republic</option>';
	      countryHTML += '<option value="TD">Chad</option>';
	      countryHTML += '<option value="CL">Chile</option>';
	      countryHTML += '<option value="CN">China</option>';
	      countryHTML += '<option value="CX">Christmas Island</option>';
	      countryHTML += '<option value="CC">Cocos (Keeling) Islands</option>';
	      countryHTML += '<option value="CO">Colombia</option>';
	      countryHTML += '<option value="KM">Comoros</option>';
	      countryHTML += '<option value="CG">Congo</option>';
	      countryHTML += '<option value="CD">Congo, the Democratic Republic of the</option>';
	      countryHTML += '<option value="CK">Cook Islands</option>';
	      countryHTML += '<option value="CR">Costa Rica</option>';
	      countryHTML += '<option value="CI">Cote d&acute;Ivoire</option>';
	      countryHTML += '<option value="HR">Croatia (Hrvatska)</option>';
	      countryHTML += '<option value="CU">Cuba</option>';
	      countryHTML += '<option value="CY">Cyprus</option>';
	      countryHTML += '<option value="CZ">Czech Republic</option>';
	      countryHTML += '<option value="DK">Denmark</option>';
	      countryHTML += '<option value="DJ">Djibouti</option>';
	      countryHTML += '<option value="DM">Dominica</option>';
	      countryHTML += '<option value="DO">Dominican Republic</option>';
	      countryHTML += '<option value="TP">East Timor</option>';
	      countryHTML += '<option value="EC">Ecuador</option>';
	      countryHTML += '<option value="EG">Egypt</option>';
	      countryHTML += '<option value="SV">El Salvador</option>';
	      countryHTML += '<option value="GQ">Equatorial Guinea</option>';
	      countryHTML += '<option value="ER">Eritrea</option>';
	      countryHTML += '<option value="EE">Estonia</option>';
	      countryHTML += '<option value="ET">Ethiopia</option>';
	      countryHTML += '<option value="FK">Falkland Islands (Malvinas)</option>';
	      countryHTML += '<option value="FO">Faroe Islands</option>';
	      countryHTML += '<option value="FJ">Fiji</option>';
	      countryHTML += '<option value="FI">Finland</option>';
	      countryHTML += '<option value="FR">France</option>';
	      countryHTML += '<option value="FX">France, Metropolitan</option>';
	      countryHTML += '<option value="GF">French Guiana</option>';
	      countryHTML += '<option value="PF">French Polynesia</option>';
	      countryHTML += '<option value="TF">French Southern Territories</option>';
	      countryHTML += '<option value="GA">Gabon</option>';
	      countryHTML += '<option value="GM">Gambia</option>';
	      countryHTML += '<option value="GE">Georgia</option>';
	      countryHTML += '<option value="DE">Germany</option>';
	      countryHTML += '<option value="GH">Ghana</option>';
	      countryHTML += '<option value="GI">Gibraltar</option>';
	      countryHTML += '<option value="GR">Greece</option>';
	      countryHTML += '<option value="GL">Greenland</option>';
	      countryHTML += '<option value="GD">Grenada</option>';
	      countryHTML += '<option value="GP">Guadeloupe</option>';
	      countryHTML += '<option value="GU">Guam</option>';
	      countryHTML += '<option value="GT">Guatemala</option>';
	      countryHTML += '<option value="GN">Guinea</option>';
	      countryHTML += '<option value="GW">Guinea-Bissau</option>';
	      countryHTML += '<option value="GY">Guyana</option>';
	      countryHTML += '<option value="HT">Haiti</option>';
	      countryHTML += '<option value="HM">Heard and Mc Donald Islands</option>';
	      countryHTML += '<option value="VA">Holy See (Vatican City State)</option>';
	      countryHTML += '<option value="HN">Honduras</option>';
	      countryHTML += '<option value="HK">Hong Kong</option>';
	      countryHTML += '<option value="HU">Hungary</option>';
	      countryHTML += '<option value="IS">Iceland</option>';
	      countryHTML += '<option value="IN">India</option>';
	      countryHTML += '<option value="ID">Indonesia</option>';
	      countryHTML += '<option value="IR">Iran (Islamic Republic of)</option>';
	      countryHTML += '<option value="IQ">Iraq</option>';
	      countryHTML += '<option value="IE">Ireland</option>';
	      countryHTML += '<option value="IL">Israel</option>';
	      countryHTML += '<option value="IT">Italy</option>';
	      countryHTML += '<option value="JM">Jamaica</option>';
	      countryHTML += '<option value="JP">Japan</option>';
	      countryHTML += '<option value="JO">Jordan</option>';
	      countryHTML += '<option value="KZ">Kazakhstan</option>';
	      countryHTML += '<option value="KE">Kenya</option>';
	      countryHTML += '<option value="KI">Kiribati</option>';
	      countryHTML += '<option value="KP">Korea, Democratic People&acute;s Republic of</option>';
	      countryHTML += '<option value="KR">Korea, Republic of</option>';
	      countryHTML += '<option value="KW">Kuwait</option>';
	      countryHTML += '<option value="KG">Kyrgyzstan</option>';
	      countryHTML += '<option value="LA">Lao People&acute;s Democratic Republic</option>';
	      countryHTML += '<option value="LV">Latvia</option>';
	      countryHTML += '<option value="LB">Lebanon</option>';
	      countryHTML += '<option value="LS">Lesotho</option>';
	      countryHTML += '<option value="LR">Liberia</option>';
	      countryHTML += '<option value="LY">Libyan Arab Jamahiriya</option>';
	      countryHTML += '<option value="LI">Liechtenstein</option>';
	      countryHTML += '<option value="LT">Lithuania</option>';
	      countryHTML += '<option value="LU">Luxembourg</option>';
	      countryHTML += '<option value="MO">Macau</option>';
	      countryHTML += '<option value="MK">Macedonia, The Former Yugoslav Republic of</option>';
	      countryHTML += '<option value="MG">Madagascar</option>';
	      countryHTML += '<option value="MW">Malawi</option>';
	      countryHTML += '<option value="MY">Malaysia</option>';
	      countryHTML += '<option value="MV">Maldives</option>';
	      countryHTML += '<option value="ML">Mali</option>';
	      countryHTML += '<option value="MT">Malta</option>';
	      countryHTML += '<option value="MH">Marshall Islands</option>';
	      countryHTML += '<option value="MQ">Martinique</option>';
	      countryHTML += '<option value="MR">Mauritania</option>';
	      countryHTML += '<option value="MU">Mauritius</option>';
	      countryHTML += '<option value="YT">Mayotte</option>';
	      countryHTML += '<option value="MX">Mexico</option>';
	      countryHTML += '<option value="FM">Micronesia, Federated States of</option>';
	      countryHTML += '<option value="MD">Moldova, Republic of</option>';
	      countryHTML += '<option value="MC">Monaco</option>';
	      countryHTML += '<option value="MN">Mongolia</option>';
	      countryHTML += '<option value="MS">Montserrat</option>';
	      countryHTML += '<option value="MA">Morocco</option>';
	      countryHTML += '<option value="MZ">Mozambique</option>';
	      countryHTML += '<option value="MM">Myanmar</option>';
	      countryHTML += '<option value="NA">Namibia</option>';
	      countryHTML += '<option value="NR">Nauru</option>';
	      countryHTML += '<option value="NP">Nepal</option>';
	      countryHTML += '<option value="NL">Netherlands</option>';
	      countryHTML += '<option value="AN">Netherlands Antilles</option>';
	      countryHTML += '<option value="NC">New Caledonia</option>';
	      countryHTML += '<option value="NZ">New Zealand</option>';
	      countryHTML += '<option value="NI">Nicaragua</option>';
	      countryHTML += '<option value="NE">Niger</option>';
	      countryHTML += '<option value="NG">Nigeria</option>';
	      countryHTML += '<option value="NU">Niue</option>';
	      countryHTML += '<option value="NF">Norfolk Island</option>';
	      countryHTML += '<option value="MP">Northern Mariana Islands</option>';
	      countryHTML += '<option value="NO">Norway</option>';
	      countryHTML += '<option value="OM">Oman</option>';
	      countryHTML += '<option value="PK">Pakistan</option>';
	      countryHTML += '<option value="PW">Palau</option>';
	      countryHTML += '<option value="PA">Panama</option>';
	      countryHTML += '<option value="PG">Papua New Guinea</option>';
	      countryHTML += '<option value="PY">Paraguay</option>';
	      countryHTML += '<option value="PE">Peru</option>';
	      countryHTML += '<option value="PH">Philippines</option>';
	      countryHTML += '<option value="PN">Pitcairn</option>';
	      countryHTML += '<option value="PL">Poland</option>';
	      countryHTML += '<option value="PT">Portugal</option>';
	      countryHTML += '<option value="PR">Puerto Rico</option>';
	      countryHTML += '<option value="QA">Qatar</option>';
	      countryHTML += '<option value="RE">Reunion</option>';
	      countryHTML += '<option value="RO">Romania</option>';
	      countryHTML += '<option value="RU">Russian Federation</option>';
	      countryHTML += '<option value="RW">Rwanda</option>';
	      countryHTML += '<option value="KN">Saint Kitts and Nevis</option>';
	      countryHTML += '<option value="LC">Saint LUCIA</option>';
	      countryHTML += '<option value="VC">Saint Vincent and the Grenadines</option>';
	      countryHTML += '<option value="WS">Samoa</option>';
	      countryHTML += '<option value="SM">San Marino</option>';
	      countryHTML += '<option value="ST">Sao Tome and Principe</option>';
	      countryHTML += '<option value="SA">Saudi Arabia</option>';
	      countryHTML += '<option value="SN">Senegal</option>';
	      countryHTML += '<option value="SC">Seychelles</option>';
	      countryHTML += '<option value="SL">Sierra Leone</option>';
	      countryHTML += '<option value="SG">Singapore</option>';
	      countryHTML += '<option value="SK">Slovakia (Slovak Republic)</option>';
	      countryHTML += '<option value="SI">Slovenia</option>';
	      countryHTML += '<option value="SB">Solomon Islands</option>';
	      countryHTML += '<option value="SO">Somalia</option>';
	      countryHTML += '<option value="ZA">South Africa</option>';
	      countryHTML += '<option value="GS">South Georgia and the South Sandwich Islands</option>';
	      countryHTML += '<option value="ES">Spain</option>';
	      countryHTML += '<option value="LK">Sri Lanka</option>';
	      countryHTML += '<option value="SH">St. Helena</option>';
	      countryHTML += '<option value="PM">St. Pierre and Miquelon</option>';
	      countryHTML += '<option value="SD">Sudan</option>';
	      countryHTML += '<option value="SR">Suriname</option>';
	      countryHTML += '<option value="SJ">Svalbard and Jan Mayen Islands</option>';
	      countryHTML += '<option value="SZ">Swaziland</option>';
	      countryHTML += '<option value="SE">Sweden</option>';
	      countryHTML += '<option value="CH">Switzerland</option>';
	      countryHTML += '<option value="SY">Syrian Arab Republic</option>';
	      countryHTML += '<option value="TW">Taiwan, Province of China</option>';
	      countryHTML += '<option value="TJ">Tajikistan</option>';
	      countryHTML += '<option value="TZ">Tanzania, United Republic of</option>';
	      countryHTML += '<option value="TH">Thailand</option>';
	      countryHTML += '<option value="TG">Togo</option>';
	      countryHTML += '<option value="TK">Tokelau</option>';
	      countryHTML += '<option value="TO">Tonga</option>';
	      countryHTML += '<option value="TT">Trinidad and Tobago</option>';
	      countryHTML += '<option value="TN">Tunisia</option>';
	      countryHTML += '<option value="TR">Turkey</option>';
	      countryHTML += '<option value="TM">Turkmenistan</option>';
	      countryHTML += '<option value="TC">Turks and Caicos Islands</option>';
	      countryHTML += '<option value="TV">Tuvalu</option>';
	      countryHTML += '<option value="UG">Uganda</option>';
	      countryHTML += '<option value="UA">Ukraine</option>';
	      countryHTML += '<option value="AE">United Arab Emirates</option>';
	      countryHTML += '<option value="GB">United Kingdom</option>';
	      countryHTML += '<option value="UM">United States Minor Outlying Islands</option>';
	      countryHTML += '<option value="UY">Uruguay</option>';
	      countryHTML += '<option value="UZ">Uzbekistan</option>';
	      countryHTML += '<option value="VU">Vanuatu</option>';
	      countryHTML += '<option value="VE">Venezuela</option>';
	      countryHTML += '<option value="VN">Viet Nam</option>';
	      countryHTML += '<option value="VG">Virgin Islands (British)</option>';
	      countryHTML += '<option value="VI">Virgin Islands (U.S.)</option>';
	      countryHTML += '<option value="WF">Wallis and Futuna Islands</option>';
	      countryHTML += '<option value="EH">Western Sahara</option>';
	      countryHTML += '<option value="YE">Yemen</option>';
	      countryHTML += '<option value="YU">Yugoslavia</option>';
	      countryHTML += '<option value="ZM">Zambia</option>';
	      countryHTML += '<option value="ZW">Zimbabwe</option>';
	      countryHTML += '</select>';
	      return countryHTML;

}


function runScriptDate(dateID){
	 $("#"+dateID+" .input-group.date").datepicker({todayBtn: "linked",keyboardNavigation: false,forceParse: false,calendarWeeks: true,autoclose: true});
}

</script>

</body>
</html>