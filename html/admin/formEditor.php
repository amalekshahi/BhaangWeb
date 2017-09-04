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
	<title>Form Builder</title>
	<!-- Toastr style -->
	<!-- <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet"> -->
    <?php include "header.php"; ?>	    
</head>


<body>
<div ng-controller="myCtrl" id="myCtrl">
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
						<div class="logo-element">
							DV
						</div>
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
			<div class="row wrapper border-bottom white-bg page-heading">
<!-- top wrapper -->
				<div class="col-lg-10">
					<h2>Form Builder</h2>
					<ol class="breadcrumb">
						<li>
							<a href="dv.php?page=formLibrary">Create a Form</a>
						</li>
						<li class="active"><strong>eBook D/L Form</strong></li>
					</ol>
				</div>
				<div class="col-lg-2"></div>
<!-- top wrapper -->
			</div>
			<div class="mail-box-header">
    			<div class="pull-right tooltip-demo">
    			    <a class="btn btn-white" data-placement="top" data-toggle="tooltip" href="formLibrary.php" title="Leave without saving"><i class="fa fa-ban"></i> Cancel</a> <button class="btn btn-primary" name="action" type="submit" value="saveEmail" ng-click="SaveForm();"><i class="fa fa-floppy-o"></i> Save Form</button>
    			</div>			
    		    <h3>Form Name: <select id="selectForm" ng-model="selectedForm" ng-change="SelectChanged(this.selectedForm)" ng-cloak>
					<option ng-repeat="x in deflist.items" value="{{x.formName}}" selected={{x.formSelected}}>{{x.formName}}</option>					
				</select>
				</h3>
			</div>	

			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
					<div class="col-lg-4">
						<div class="ibox">
							<div class="ibox-content">
								<h3>Available Contact Fields</h3>
								<p class="small"><i class="fa fa-hand-o-up"></i> Drag from here to your form, or back again.</p>
								<ul class="sortable-list connectList agile-list" id="available_fields" >
									<li class="info-element" id="{{d.fieldID}}" ng-repeat="d in defItem" ng-cloak>{{d.label}}
										<div class="agile-detail">
											<a class="pull-right btn btn-xs btn-white" href="#" data-toggle="modal" data-target="#{{d.fieldID}}Modal"><i class="fa fa-cog"></i> Settings</a>
											<small ng-if="d.fieldType=='textbox'"><i class="fa fa-pencil-square-o"></i> Text line</small>
											<small ng-if="d.fieldType=='email'"><i class="fa fa-envelope"></i> Text line</small>											
											<small ng-if="d.fieldType=='phone'"> <i class="fa fa-phone"></i> US Phone #</small>
											<small ng-if="d.fieldType=='mobile'"> <i class="fa fa-mobile"></i> US Phone #</small>
											<small ng-if="d.fieldType=='dropdown'"> <i class="fa fa-caret-square-o-down"></i> Drop-down List</small>
											<small ng-if="d.fieldType=='hidden'"> <i class="fa fa-user-secret"></i> Hidden Field</small>
											<small ng-if="d.fieldType=='datetime'"> <i class="fa fa-calendar"></i> Datetime</small>	
										</div>
										<div class="modal inmodal fade" id="{{d.fieldID}}Modal" tabindex="-1" role="dialog"  aria-hidden="true">
											<div class="modal-dialog modal-sm">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
														<h4 class="modal-title">Field Settings For: {{d.label}}</h4>
													</div>
													<div class="modal-body">
														<p>Label: <input type="text" id="{{d.fieldID}}Label"  value="{{d.label}}"></p>
														<p>Required?: <select id="{{d.fieldID}}Require"><option value="Yes">Yes<option value="No" selected>No</select></p>
														<p>Pre-fill if already known or Don't display if known : <select  id="{{d.fieldID}}Prefill" ><option value="Yes">Yes<option value="No" selected>No</select></p>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
														<!-- <button type="button" class="btn btn-primary" ng-click="">Save changes</button> -->
													</div>
												</div>
											</div>
										</div>
									</li>
								</ul> 

								<div class="input-group">
                                    <input type="text" placeholder="Add a Field. " class="input input-sm form-control">
                                    <span class="input-group-btn">
                                            <button type="button" class="btn btn-sm btn-white"> <i class="fa fa-plus"></i> Add Field</button>
                                    </span>
                                </div>								
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="ibox">
						    <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                 <h5>Form: eBook D/L Form</h5><div class="alerttest2" style="color:red;"></div>
                                    <div class="ibox-tools">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-wrench"></i> Form Options
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a href="#">Change Form's Theme</a>
                                            </li>
                                            <li><a href="#">Modify Form's Button</a>
                                            </li>
                                        </ul>
                                    </div>   
                                </div>
                            
							<div class="ibox-content">
								<p class="small"><i class="fa fa-hand-o-up"></i> Re-order your fields, or pull them to the left to remove them.</p>
								<ul class="sortable-list connectList agile-list" id="form_fields">									
									<li class="success-element"  id="{{s.fieldID}}" ng-repeat="s in selectItem" ng-cloak>{{s.label}}<small ng-if="s.required=='Yes'"> <i aria-hidden="true" class="fa fa-star-o" style="color:red"></i></small>
										<div class="agile-detail">
											<a class="pull-right btn btn-xs btn-white" href="#" data-toggle="modal" data-target="#{{s.fieldID}}Modal"><i class="fa fa-cog"></i> Settings</a>
											<small ng-if="s.fieldType=='textbox'"><i class="fa fa-pencil-square-o"></i> Text line</small>
											<small ng-if="s.fieldType=='email'"><i class="fa fa-envelope"></i> Text line</small>											
											<small ng-if="s.fieldType=='phone'"> <i class="fa fa-phone"></i> US Phone #</small>
											<small ng-if="s.fieldType=='mobile'"> <i class="fa fa-mobile"></i> US Phone #</small>
											<small ng-if="s.fieldType=='dropdown'"> <i class="fa fa-caret-square-o-down"></i> Drop-down List</small>
											<small ng-if="s.fieldType=='hidden'"> <i class="fa fa-user-secret"></i> Hidden Field</small>
											<small ng-if="s.fieldType=='datetime'"> <i class="fa fa-calendar"></i> Datetime</small>											
										</div>
										<div class="modal inmodal fade" id="{{s.fieldID}}Modal" tabindex="-1" role="dialog"  aria-hidden="true">
											<div class="modal-dialog modal-sm">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
														<h4 class="modal-title">Field Settings For: {{s.label}}</h4>
													</div>
													<div class="modal-body">
														<p>Label: <input type="text" id="{{s.fieldID}}Label" value="{{s.label}}"></p>
														<p>Required?: <select id="{{s.fieldID}}Require" ng-model="s.required" ng-change=SetRequire();><option value="Yes">Yes<option value="No" selected>No</select></p>
														<p>Pre-fill if already known or Don't display if known : <select  id="{{s.fieldID}}Prefill"  ng-model="s.prepopulated"><option value="Yes">Yes<option value="No" selected>No</select></p>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
														<!-- <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button> -->
													</div>
												</div>
											</div>
										</div>
									</li>
								</ul>
							</div>
							</div>
						</div>
					</div>
					
					<div class="col-lg-4">
						<div class="ibox">
							<div class="ibox-content">
								<h3>Preview & Edit Labels & Text</h3>
								
								<div class="well">
												<style type="text/css">.input-sm{ border: 1px solid #ccc;}</style>
												<form action="/send?a=download" id="rzForm" method="post" name="rzForm" novalidate="">
													<fieldset>													
															<div><p class="lead">Download your eBook:</p></div>
															<div id="summerblock">													
															</div><!-- end summer bind -->
															<button class="btn btn-lg btn-block btn-warning" type="submit">Download Now!</button>
															<div>
																<p class="rz-required-note" style="text-align: right;"><i><div>* Indicates a required field.<br>
																Answer all required fields to activate the button.</div></i></p>
															</div>
													</fieldset>
												</form>	
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>                 

				<!-- <div class="row">
					<div class="col-lg-12">
						<h4>Serialized Output</h4>
						<p>Here are the sortable fields in a string array:</p>
						<div class="output p-m m white-bg"></div>
						<!-- <div class="outputhtml p-m m white-bg"></div>
						<div class="outputhtml2 p-m m white-bg"></div> -->
					</div>
				</div> -->
			</div>
		</div>
	</div>
</div>	<!-- myCtrl -->
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

<script>
	
var fID = getParameterByName("fID");
//fID = "a1"; 
var indx = -1; 
var defIndx = -1; 
var dbName = "<?php echo $dbName; ?>";
var myApp = angular.module('myApp',  []);

myApp.controller('myCtrl',function($scope,$http) {
			$scope.tempArr = []; 
			$scope.SaveForm = function() {					
					$scope.GenSelectedFromHTML(); 
					var txt = $scope.selectedFromHTML; 
					$scope.MyCopyItem('formHTML',txt);
					var txt2 = $scope.allFieldName; 
					$scope.MyCopyItem('allFieldName',$scope.allFieldName); 
					var today = moment().format('MMM D, YYYY HH:mm:ss'); //with moment.js
					$scope.MyCopyItem('modifiedDate',today);	

					$http.put('/couchdb/' + dbName +'/formLibrary',  $scope.frmlist).then(function(response){
							 $scope.LoadSelect(); 
							 $scope.LoadDefault(); 
							 alert("Save success");
	//						 $scope.state['Save'] = "Save";

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
								/*
								var tmpLab = $scope.selectItem[i].label; 
								var required = $scope.selectItem[i].required; 
								summerdivtxt += '<div class="form-group"><label>'+tmpLab+'</label>'; 
								if(required == "Yes"){
									summerdivtxt += '<span style="color:red;">&#42;</span>'	; 
								}
								summerdivtxt += '<input class="form-control input-sm" name="'+tmpLab+'" required="" type="text" value=""></div>' ; 							
								*/ 
summerdivtxt += getFormCode($scope.selectItem[i].fieldType,$scope.selectItem[i].fieldID,$scope.selectItem[i].label,$scope.selectItem[i].required,$scope.selectItem[i].prepopulated,$scope.selectItem[i].option); 								
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
							$scope.selectItem = $scope.frmlist.items[indx]['fieldLists']; 
							$scope.LoadRightBlock(); 
							$scope.tempArr = $scope.selectItem;  

				},function(errResponse){
							if (errResponse.status == 404) {
								$scope.frmlist = {items:[]};
							}
                });

            };

			$scope.LoadDefault = function(defID) {                
				$http.get("/couchdb/" + dbName +'/formDefaultList'+"?"+new Date().toString()).then(function(response) {
							$scope.masterDef  = response.data; 
							if (typeof $scope.masterDef.items == 'undefined') {
							   $scope.masterDef.items = [];
							} 
							$scope.deflist  = angular.copy($scope.masterDef);
							if(typeof defID == 'undefined' || defID=="" ){
								defIndx = 0; 
							}else{
								defIndx = $scope.deflist.items.getIndexByValue('defaultID',defID);		
								$scope.deflist.items[0]['fieldLists'].formSelected = ""; 
								$scope.deflist.items[defIndx]['fieldLists'].formSelected = "selected";

							}
							//$scope.defItem = $scope.deflist.items[defIndx]['fieldLists']; 						
							$scope.CheckDupOnLoad(); 

				},function(errResponse){
							if (errResponse.status == 404) {
								$scope.deflist = {items:[]};
							}
                });
            };

			$scope.CheckDupOnLoad = function(ftype) {
					if(typeof $scope.selectItem != 'undefined') {
							var defArr = []; 							
							for(i=0;i<$scope.deflist.items[defIndx]['fieldLists'].length;i++){
									var isDup = false; 
									for(k=0;k<$scope.selectItem.length;k++){
											if($scope.deflist.items[defIndx]['fieldLists'][i].fieldID == $scope.selectItem[k].fieldID){
												isDup = true; 
												break; 
											}else{
												isDup = false; 
											}
									}//for k
									if(!isDup){
											defArr.push($scope.deflist.items[defIndx]['fieldLists'][i]); 
									}
							}//for i
							$scope.defItem = defArr; 
					}else{
							$scope.defItem = $scope.deflist.items[defIndx]['fieldLists']; 	
					}
            };

			$scope.SelectChanged = function(ftype) {
				$('.alerttest').html(" formtype = "+ftype);
            };

			$scope.LoadStart = function() {
				$scope.LoadSelect(); 
				$scope.LoadDefault(); 				
            };
			
			$scope.Reset = function() {                  

            };			

			$scope.SetRequire = function() {
                  var txt=$scope.selectItem;

            };	
				
			$scope.GenSelectedFromHTML = function() {
				var temphtml = ""; 
				var allFieldName =""; 
				for(i=0;i<$scope.tempArr.length;i++){
						
						allFieldName += $scope.tempArr[i].label;
						if(i<$scope.tempArr.length-1){		allFieldName +=",";		}				

						temphtml = getFormCode($scope.tempArr[i].fieldType,$scope.tempArr[i].fieldID,$scope.tempArr[i].label,$scope.tempArr[i].required,$scope.tempArr[i].prepopulated,$scope.tempArr[i].option); 					
				}//end for i
				$scope.allFieldName = allFieldName; 
				$scope.selectedFromHTML = '<div class="col-lg-4 ibox ibox-content well"><form action="#" id="rzForm" name="rzForm" method="post"><fieldset>'+temphtml+'<button class="btn btn-lg btn-block btn-warning" type="submit">Download Now!</button><p class="rz-required-note"><i>* Indicates a required field.<br>Answer all required fields to activate the button.</i></p> </fieldset></form><div>' ; 		
                  
            };// end GenSelectedFromHTML()
			
			$scope.LoadStart();
});

$(document).ready(function(){

	           $("#available_fields, #form_fields, #completed").sortable({
	               connectWith: ".connectList",
	               update: function( event, ui ) {

	                   var available_fields = $( "#available_fields" ).sortable( "toArray" );
	                   var form_fields = $( "#form_fields" ).sortable( "toArray" );
	                   var completed = $( "#completed" ).sortable( "toArray" );			
					   						
						var summerdivtxt = ''; 				//display right block 

						var tempArr=[]; 
						for(i=0;i<form_fields.length;i++){							
							var flabel = $(document.getElementById(form_fields[i]+"Label")).val();	
							var frequire = $(document.getElementById(form_fields[i]+"Require")).val();	
							var fprefill = $(document.getElementById(form_fields[i]+"Prefill")).val();	
							//add array
							tempArr.push({"fieldID":form_fields[i], "label": flabel,"required": frequire,"prepopulated": fprefill,"fieldType": "textbox" }); 
							
							summerdivtxt += getFormCode("textbox",form_fields[i],flabel,frequire,fprefill,""); 
							//summerdivtxt += '<div class="form-group"><label>'+flabel+'</label><input class="form-control input-sm" name="'+flabel+'" required="" type="text" value=""></div>' ; 


						}//end for i
						angular.element(document.getElementById('myCtrl')).scope().MyCopyItem('fieldLists',tempArr);
						angular.element(document.getElementById('myCtrl')).scope().CopyScope('tempArr',tempArr);
	                    $('.output').html(" form_fields = "+form_fields);	
						//$('.output').html("Available Fields: " + window.JSON.stringify(available_fields) + "<br/>" + "Form Fields: " + window.JSON.stringify(form_fields) + "<br/>");
						
						$('#summerblock').html(summerdivtxt); 		

	               }
	           }).disableSelection();			 

}); // end document.ready(); 

function getFormCode(fieldType,fieldID,label,required,prepopulated,option){	
		var tmpReq = ""; 
		var tmpPrepop=""; 
		var redstar = ""; 		
		if(required == "Yes"){
				tmpReq = ' required="" '; 
				redstar += '<span style="color:red;">&#42;</span>'	; 
		}
		if(prepopulated == "Yes"){
				tmpPrepop = '##'+label+'##'; 						
		}

	    var temphtml ='<div class="form-group"><label>'+label+'</label>'+redstar ;
		if(fieldType == "textbox" || fieldType == "email" || fieldType == "mobile" || fieldType == "phone"){
				temphtml += ' <input class="form-control input-sm" name="'+label+'" '+tmpReq+' type="text" value="'+tmpPrepop+'"> '; 

		}else if(fieldType == "hidden"){						
				temphtml += ' <input type="hidden" name="'+label+' value="'+tmpPrepop+'"> '; 

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


</script>

</body>
</html>