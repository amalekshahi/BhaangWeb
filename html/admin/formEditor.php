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
	<link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <?php include "header.php"; ?>	
    <script type="text/javascript">
			var postForm = function() {
				var content = $('[name="content"]').html($('#summernote').code());
				
			}
    </script>    
<style>    
    .hover { 
		border: 2px solid transparent;
	}
	.hover:hover {
	    text-shadow: 2px 2px 20px red;
	    border: 2px dashed red;
	 }
</style>
</head>


<body>
<div ng-controller="myCtrl">
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
    			    <a class="btn btn-white" data-placement="top" data-toggle="tooltip" href="mailbox.html" title="Leave without saving"><i class="fa fa-ban"></i> Cancel</a> <button class="btn btn-primary" name="action" type="submit" value="saveEmail"><i class="fa fa-floppy-o"></i> Save Form</button>
    			</div>
    		    <h3>Form Name: <a data-pk="2" data-title="Email Name" data-type="text" data-url="" href="#" id="email_subject">eBook D/L Form</a></h3>
			</div>	

			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
					<div class="col-lg-4">
						<div class="ibox">
							<div class="ibox-content">
								<h3>Available Contact Fields</h3>
								<p class="small"><i class="fa fa-hand-o-up"></i> Drag from here to your form, or back again.</p>
								<ul class="sortable-list connectList agile-list" id="available_fields">
									<li class="info-element" id="##lastname##">Last Name
										<div class="agile-detail">
											<a class="pull-right btn btn-xs btn-white"><i class="fa fa-cog"></i> Settings</a> <i class="fa fa-pencil-square-o"></i> Text line 
										</div>
									</li>
									<li class="info-element" id="##company##">Company
										<div class="agile-detail">
											<a class="pull-right btn btn-xs btn-white" href="#"><i class="fa fa-cog"></i> Settings</a> <i class="fa fa-pencil-square-o"></i> Text line 
										</div>
									</li>
									<li class="info-element" id="##phone##">Phone
										<div class="agile-detail">
											<a class="pull-right btn btn-xs btn-white" href="#"><i class="fa fa-cog"></i> Settings</a> <i class="fa fa-phone"></i> US Phone # 
										</div>
									</li>
									<li class="info-element" id="##cell##">Cell Phone Number
										<div class="agile-detail">
											<a class="pull-right btn btn-xs btn-white" href="#"><i class="fa fa-cog"></i> Settings</a> <i class="fa fa-mobile"></i> US Phone # 
										</div>
									</li>
									<li class="info-element" id="##primary_business##">Which bests describes your primary business?
										<div class="agile-detail">
											<a class="pull-right btn btn-xs btn-white" href="#"><i class="fa fa-cog"></i> Settings</a> <i class="fa fa-caret-square-o-down"></i> Drop-down List 
										</div>
									</li>
									<li class="info-element" id="##utm_string##">UTM String
										<div class="agile-detail">
											<a class="pull-right btn btn-xs btn-white" href="#"><i class="fa fa-cog"></i> Settings</a> <i class="fa fa-user-secret"></i> Hidden Field
										</div>
									</li>
								</ul>
								<div class="input-group">
									<input class="input input-sm form-control" placeholder="New field name ..." type="text"> <span class="input-group-btn"><button class="btn btn-sm btn-white" type="button"><span class="input-group-btn"><i class="fa fa-plus"></i> Create New Field</span></button></span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="ibox">
						    <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                 <h5>Form: eBook D/L Form</h5>
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
									<li class="success-element" id="##email##">Business Email Address <small><i aria-hidden="true" class="fa fa-star-o" style="color:red"></i></small>
										<div class="agile-detail">
											<a class="pull-right btn btn-xs btn-white" href="#" data-toggle="modal" data-target="#myModalEmail"><i class="fa fa-cog"></i> Settings</a> <i class="fa fa-pencil-square-o"></i> Text line 
										</div>
									</li>
									<li class="success-element" id="##firstname##">First Name
										<div class="agile-detail">
											<a class="pull-right btn btn-xs btn-white" href="#"><i class="fa fa-cog"></i> Settings</a> <i class="fa fa-pencil-square-o"></i> Text line 
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
												<form action="/send?a=download" id="rzForm" method="post" name="rzForm" novalidate="">
													<fieldset>
														<div class="hover"><textarea class="summernote" id="summernote" name="LANDINGPAGE-BODY-TEXT"><p class="lead">Download your eBook:</p></textarea></div>
														<div class="form-group">
															<label><div class="hover"><textarea class="summernote" id="summernote" name="LANDINGPAGE-BODY-TEXT">Email <span style="color:red;">&#42;</span></label></textarea></div> <input class="form-control input-sm" name="email" required="" type="text" value="">
														</div>
														<div class="form-group">
															<label><div class="hover"><textarea class="summernote" id="summernote" name="LANDINGPAGE-BODY-TEXT">First Name <span style="color:red;">&#42;</span></label></textarea></div> <input class="form-control input-sm" name="firstname" required="" type="text" value="">
														</div><button class="btn btn-lg btn-block btn-warning" type="submit">Download Now!</button>
														<div>
															<p class="rz-required-note" style="text-align: right;"><i><div class="hover"><textarea class="summernote" id="summernote" name="LANDINGPAGE-BODY-TEXT">* Indicates a required field.<br>
															Answer all required fields to activate the button.</textarea></div></i></p>
														</div>
													</fieldset>
												</form>
										<summernote ng-model="summerText" editor="editor" on-image-upload="imageUpload(files,'editor')"></summernote><br>

								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
                            <div class="modal inmodal fade" id="myModalEmail" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Field Settings For: Email</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Label:</p>
                                            <p>Required?</p>
                                            <p>Pre-fill if already known or Don't display if known</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

				<div class="row">
					<div class="col-lg-12">
						<h4>Serialized Output</h4>
						<p>Here are the sortable fields in a string array:</p>
						<div class="output p-m m white-bg"></div>
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
				  popover: {
					  image: [
						['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
						['float', ['floatLeft', 'floatRight', 'floatNone']],
						['remove', ['removeMedia']]
					  ],
					  link: [
						['link', ['linkDialogShow', 'unlink']]
					  ],
					  air: [
						['color', ['color']],
						['font', ['bold', 'underline', 'clear']],
						['para', ['ul', 'paragraph']],
						['table', ['table']],
						['insert', ['link', 'picture']]
					  ]
					}
				});

	           $("#available_fields, #form_fields, #completed").sortable({
	               connectWith: ".connectList",
	               update: function( event, ui ) {

	                   var available_fields = $( "#available_fields" ).sortable( "toArray" );
	                   var form_fields = $( "#form_fields" ).sortable( "toArray" );
	                   var completed = $( "#completed" ).sortable( "toArray" );
	                   $('.output').html("Available Fields: " + window.JSON.stringify(available_fields) + "<br/>" + "Form Fields: " + window.JSON.stringify(form_fields) + "<br/>");
	               }
	           }).disableSelection();

	}); // end document.ready(); 

	var myApp = angular.module('myApp',  ['summernote',"ngFileUpload"]);
    myApp.controller('myCtrl',['$scope','$http','Upload',function($scope,$http,Upload) {
        //$scope.summerText = "Summer Text 2"; 
        $scope.imageUpload = function(files,editor){
            var uploadFileName = "IMG-" + uuidv4();
            //$scope.editor.summernote('insertNode', imgNode);
            Upload.upload({
                url: 'upload.php',
                method: 'POST',
                file:files[0],
                data: {
                    file:files[0], 
                    's3':'true',
                    'fileName':uploadFileName,
                    'acctID':'accountID',
                    'progID':'programID',
                }
            }).then(function (resp) {
                console.log('Success ' + resp.config.data.file.name + 'uploaded');
                console.log(resp.data);
                var imgNode = $('<img>').attr('src', resp.data.imgSrc)[0];
                $scope[editor].summernote('insertNode',imgNode );
            }, function (resp) {
                console.log('Error status: ' + resp.status);
            }, function (evt) {
                var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
            });
        };
    }]);
	function uuidv4() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    }
    
	</script>

</body>
</html>