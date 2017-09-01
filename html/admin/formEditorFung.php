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
		
		<div class="gray-bg" id="page-wrapper">
			<div class="row wrapper border-bottom white-bg page-heading">
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
			</div>
			<div class="mail-box-header">
    			<div class="pull-right tooltip-demo">
    			    <a class="btn btn-white" data-placement="top" data-toggle="tooltip" href="mailbox.html" title="Leave without saving"><i class="fa fa-ban"></i> Cancel</a> <button class="btn btn-primary" name="action" type="submit" value="saveEmail" ng-click="SaveForm();"><i class="fa fa-floppy-o"></i> Save Form</button>
    			</div>
				<!-- <select ng-model="selectedForm" ng-change="SelectChanged({{x.formName}})" ng-options = "x['formName'] for x in deflist.items">
				<option value=""></option>
				<select> -->
    		    <h3>Form Name: <!-- <a data-pk="2" data-title="Email Name" data-type="text" data-url="" href="#" id="email_subject">eBook D/L Form</a> --><select id="selectForm" ng-model="selectedForm" ng-change="SelectChanged(this.selectedForm)">
					<option ng-repeat="x in deflist.items" value="{{x.formName}}" selected={{x.formSelected}}>{{x.formName}}</option>					
				</select>
				</h3>
				<!-- <div class="alerttest" style="color:red;"></div> -->
			</div>	

			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
					<div class="col-lg-4">
						<div class="ibox">
							<div class="ibox-content">
								<h3>Available Contact Fields</h3>
								<p class="small"><i class="fa fa-hand-o-up"></i> Drag from here to your form, or back again.</p>
								<ul class="sortable-list connectList agile-list" id="available_fields" >
									<li class="info-element" id="{{d.fieldID}}" ng-repeat="d in defItem">{{d.label}}
										<div class="agile-detail">
											<a class="pull-right btn btn-xs btn-white" href="#" data-toggle="modal" data-target="#{{d.fieldID}}Modal"><i class="fa fa-cog"></i> Settings</a> <i class="fa fa-pencil-square-o"></i> Text line 
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
														<button type="button" class="btn btn-primary" ng-click="">Save changes</button>
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

								<!-- <div class="input-group">
									<input class="input input-sm form-control" placeholder="New field name ..." type="text"> <span class="input-group-btn"><button class="btn btn-sm btn-white" type="button"><span class="input-group-btn"><i class="fa fa-plus"></i> Create New Field</span></button></span>
								</div> -->
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
									<li class="success-element"  id="{{s.fieldID}}" ng-repeat="s in selectItem">{{s.label}}<small ng-if="s.required=='Yes'"> <i aria-hidden="true" class="fa fa-star-o" style="color:red"></i></small>
										<div class="agile-detail">
											<a class="pull-right btn btn-xs btn-white" href="#" data-toggle="modal" data-target="#{{s.fieldID}}Modal"><i class="fa fa-cog"></i> Settings</a> <i class="fa fa-pencil-square-o"></i> Text line 
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
														<p>Required?: <select id="{{s.fieldID}}Require"><option value="Yes">Yes<option value="No" selected>No</select></p>
														<p>Pre-fill if already known or Don't display if known : <select  id="{{s.fieldID}}Prefill" ><option value="Yes">Yes<option value="No" selected>No</select></p>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
														<button type="button" class="btn btn-primary">Save changes</button>
													</div>
												</div>
											</div>
										</div>
									</li>
									<!-- <li class="success-element" id="##firstname##">First Name
										<div class="agile-detail">
											<a class="pull-right btn btn-xs btn-white" href="#"><i class="fa fa-cog"></i> Settings</a> <i class="fa fa-pencil-square-o"></i> Text line 
										</div>
									</li> -->
								</ul>
							</div>
							</div>
						</div>
					</div>
					
					<div class="col-lg-4">
						<div class="ibox">
							<div class="ibox-content">
								<h3>Preview & Edit Labels & Text</h3>
								
								<div class="well" id="selectedFromHTML">
												<style type="text/css">.input-sm{ border: 1px solid #ccc;}</style>
												<form action="/send?a=download" id="rzForm" method="post" name="rzForm" novalidate="">
													<fieldset>													
															<div><p class="lead">Download your eBook:</p></div>
															<div id="summer">
																<div class="form-group">
																	<label><div><textarea class="summernote" id="summernote" name="LANDINGPAGE-BODY-TEXT">Email <span style="color:red;">&#42;</span></label></textarea></div> <input class="form-control input-sm" name="email" required="" type="text" value="">
																</div>
																<div class="form-group">
																	<label><div><textarea class="summernote" id="summernote" name="LANDINGPAGE-BODY-TEXT">First Name <span style="color:red;">&#42;</span></label></textarea></div> <input class="form-control input-sm" name="firstname" required="" type="text" value="">
																</div>
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
                            

				<div class="row">
					<div class="col-lg-12">
						<h4>Serialized Output</h4>
						<p>Here are the sortable fields in a string array:</p>
						<div class="output p-m m white-bg"></div>
						<!-- <div class="outputhtml p-m m white-bg"></div>
						<div class="outputhtml2 p-m m white-bg"></div> -->
					</div>
				</div>
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
	<!-- Touch Punch - Touch Event Support for jQuery UI -->	 
	<script src="js/plugins/touchpunch/jquery.ui.touch-punch.min.js"></script> 
	
    <!-- SUMMERNOTE -->
    <script src="js/plugins/summernote/summernote.min.js"></script>
    <!-- X-editable -->
    <script src="js/plugins/bootstrap-editable/boostrap-editable.js"></script>	 	
	<script src="js/inspinia.js"></script> 
	<script src="js/plugins/pace/pace.min.js"></script> 
	<script type="text/JavaScript" src="global.js?n=1"></script> 
	
	
	<!-- Custom and plugin javascript -->	 
	<script>

    $.fn.editable.defaults.mode = 'inline';
    $.fn.editableform.buttons  = 
        '<button type="button" class="btn btn-primary btn-sm editable-submit"><i class="glyphicon glyphicon-ok"></i></button>'+
        '<button type="button" class="btn btn-default btn-sm editable-cancel"><i class="glyphicon glyphicon-remove"></i></button>'+
        '<button type="button" class="btn btn-default btn-sm editable-off"><i class="glyphicon glyphicon-trash"></i></button>';

	   //postform
	$(document).ready(function(){
				
				$('#email_name').editable();
				$('#email_subject').editable();

				$('.summernote').summernote({
				  airMode: true,
				  popover: {}
				});
		

	           $("#available_fields, #form_fields, #completed").sortable({
	               connectWith: ".connectList",
	               update: function( event, ui ) {

	                   var available_fields = $( "#available_fields" ).sortable( "toArray" );
	                   var form_fields = $( "#form_fields" ).sortable( "toArray" );
	                   var completed = $( "#completed" ).sortable( "toArray" );
						
						var summerdivtxt = ''; 						
						for(i=0;i<form_fields.length;i++){
							summerdivtxt += '<div class="form-group"><label><div><textarea class="summernote" id="summernote" name="LANDINGPAGE-BODY-TEXT">Email</label></textarea></div> <input class="form-control input-sm" name="email" required="" type="text" value=""></div>'
						}
						$('#summer').html(summerdivtxt); 		
						$('.summernote').summernote({
						  airMode: true,
						  popover: {}
						});				
						var tempArr = []; 
						for(i=0;i<form_fields.length;i++){
							var flabel = $(document.getElementById(form_fields[i]+"Label")).val();	
							var frequire = $(document.getElementById(form_fields[i]+"Require")).val();	
							var fprefill = $(document.getElementById(form_fields[i]+"Prefill")).val();	
							//add array
							tempArr.push({"fileID":form_fields[i], "label": flabel,"required": frequire,"prepropulated": fprefill,"fieldType": "textbox" }); 

							$('.summernote').eq(i).summernote('code',flabel+' <span style="color:red;">&#42;</span>'); 
						}//end for i
						angular.element(document.getElementById('myCtrl')).scope().myCopyItem('fieldLists',tempArr);
	                    $('.output').html(" form_fields = "+form_fields);
	               }
	           }).disableSelection();			 
//			  alert( $('.summernote').eq(1).summernote('code') ); 
	}); // end document.ready(); 

var fID = getParameterByName("fID");
fID = "a1"; 
var indx = -1; 
var defIndx = -1; 
var dbName = "<?php echo $dbName; ?>";
var myApp = angular.module('myApp',  ['summernote',"ngFileUpload"]);
myApp.controller('myCtrl',function($scope,$http) {
			
			$scope.SaveForm = function() {
                  //alert($('#selectedFromHTML').html()); 
				  var txt = $('#selectedFromHTML').html(); 
//				  txt = "html xxxx"; 
				  $scope.myCopyItem('formHTML',txt);
				  $http.put('/couchdb/' + dbName +'/formLibrary',  $scope.frmlist).then(function(response){
						 $scope.LoadSelect(); 
						 alert("Save success");
//						 $scope.state['Save'] = "Save";
					});         
            };

			$scope.myCopyItem = function (ItemName,data) {
				if(indx != -1)
					$scope.frmlist.items[indx][ItemName] = data; 
				else
					$scope.selectItem[ItemName] = data; 
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
							$scope.defItem = $scope.deflist.items[defIndx]['fieldLists']; 

				},function(errResponse){
							if (errResponse.status == 404) {
								$scope.deflist = {items:[]};
							}
                });
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
			
			$scope.LoadStart();
});


	</script>

</body>
</html>