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
    <script>
        //Kwang create myAPP here so all step can access it.
        var dbName = "<?php echo $dbName; ?>";
		var accountID = "<?php echo $accountID; ?>";
		var myApp = angular.module('myApp', ["localytics.directives","xeditable","summernote","uiSwitch","ngFileUpload"]);
    </script>

    <div id="wrapper">
	<!-- left wrapper -->
	<div w3-include-html="leftWrapper.php"></div>
	<!-- /end left wrapper -->
	<div id="page-wrapper" class="gray-bg" ng-controller="myCtrl">
		<div class="row border-bottom">
				 <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
				<!-- top wrapper -->
				<div w3-include-html="topWrapper.php"></div>
				<!-- / top wrapper -->
				</nav>
		</div>	
		
<!-- content -->
	<div class="row" ng-cloak>
		<div class="col-lg-12">
			<div class="widget style1 red-bg">
				<div class="row">
					<div class="col-xs-4">
						<i class="fa fa fa-book fa-5x"></i>
					</div>
					<div class="col-xs-8 text-right">
						<span>Promote an Ebook</span>
						<h2 class="font-bold">{{campaign.campaignName}}</h2>
					</div>
				</div>
			</div>
			<div class="ibox float-e-margins">
				<div class="row">
					<div class="col-lg-12">
						<div class="ibox float-e-margins">
							<div class="ibox-title">
								<h5><i class="fa fa-rocket" aria-hidden="true" style="color:black"></i> Your Campaign Settings <small class="m-l-sm"></small></h5>
								<div class="ibox-tools">
							<a class="fullscreen-link"><i class="fa fa-expand"></i> Toggle distraction-free mode</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a class="btn btn-white btn-bitbucket btn-xs"><i aria-hidden="true" class="fa fa-pause" style="color:orange"></i> PAUSE CAMPAIGN</a>
                            <a class="btn btn-white btn-bitbucket btn-xs"><i aria-hidden="true" class="fa fa-clone" style="color:green"></i> DUPLICATE CAMPAIGN</a>
                            
                        </div>
							</div>
							<div class="ibox-content">
								<div class="panel-body">
									<div class="panel-group" id="accordion">
										<div class="panel panel-default">
											<div class="panel-heading">
												<!-- <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseOne"><i aria-hidden="true" class="fa fa-check-circle fa-lg" style="color:green"></i> &nbsp;Identify the Targeted Blog Post &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small class="m-l-sm"><i aria-hidden="true" class="fa fa-crosshairs fa-lg"></i> {{campaign['URL-BLOG-POST-URL']}}</small></a></h4> -->
												<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseOne">
													<span class="badge" ng-show="!step1Done">1</span>
													<i aria-hidden="true" class="fa fa-check-circle fa-lg" style="color:green" ng-show="step1Done""></i>
													&nbsp;Configure Your eBook &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<small class="m-l-sm"><i aria-hidden="true" class="fa fa-crosshairs fa-lg"></i> Still Relevant: A Look at How Millennials Respond to Direct Mail</small>
												</a></h4>
											</div>
											<div class="panel-collapse collapse" id="collapseOne">
												<div class="panel-body">
													<div class="ibox-content">
														<form action="" class="form-horizontal" method="post">
															<div class="form-group">
																<label class="col-sm-2 control-label">eBook Name</label>
																<div class="col-sm-10">
																	<input class="form-control" placeholder="Crime and Punishment" type="text" ng-model="campaign['URL-eBOOK-NAME']"><span class="help-block m-b-none">Enter the name of your eBook. This will appear on your landing page and other key areas.</span>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-2 control-label">eBook Hosting Location</label>
																<div class="col-sm-10">
																	<div class="fileinput fileinput-new input-group col-sm-6" data-provides="fileinput">
																		<div class="form-control" data-trigger="fileinput">
																			<i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span>
																		</div><span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Upload your eBook</span> <span class="fileinput-exists">Change</span> <input name="eBookFile" id="eBookFile" type="file"></span> <a class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput" href="#">Remove</a>
																	</div>
																	<p class="text-muted">Or specify the URL it is hosted at:</p><input class="form-control" placeholder="http://www.s3.com" type="text" ng-model="campaign['URL-eBOOK-LOCATION']"><span class="help-block m-b-none">Something like http://www.yahoo.com/myeBook.pdf</span>
																</div>
															</div>
														</form>
													</div>
													<div>
														<p>&nbsp;</p>
													</div>
													<div class="hr-line-dashed"></div>
													<div class="form-group">
														<div class="col-sm-4 col-sm-offset-2">
															<!--<input type="hidden" name="programNameHash" value="{{programNameHash}}">-->
															<input name="programNameHash" type="hidden" value="{{programNameHash}}"><button class="btn btn-primary" ng-click="uploadBeforeSave()"><i class="fa fa-floppy-o" ng-show="state['Save'] == 'Save'"></i><span ng-show="state['Save'] == 'Saving'"><i class="glyphicon glyphicon-refresh spinning"></i></span> {{state['Save']}} </button> <button class="btn btn-white" ng-click="Cancel()"><i class="fa fa-ban"></i> Cancel</button>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="panel panel-default">
											<?php include "editPromoteEbook_step2.php"; ?>
										</div>
										<div class="panel">
											<?php include "editPromoteEbook_step3.php"; ?>
										</div>
										<div class="panel">
											<?php include "editPromoteEbook_step4.php"; ?>
										</div>
										<div class="panel panel-default">
											<?php include "editPromoteEbook_step5.php"; ?>
										</div>
									</div>
                                    <div style="float:right;">
                                        <button class="btn btn-primary" ng-disabled="!CanPublish()" ng-click="Publish()"><i class="fa fa-paper-plane" ng-show="state['Publish'] == 'Launch Program'">></i><span ng-show="state['Publish'] != 'Launch Program'"><i class="glyphicon glyphicon-refresh spinning"></i></span> {{state['Publish']}}</button>
                                    </div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><i aria-hidden="true" class="fa fa-bar-chart" style="color:black"></i> Performance Snapshot</h5>
					<div class="ibox-tools">
						<button class="btn btn-white btn-xs" ng-click="ViewReport()"><i aria-hidden="true" class="fa fa-external-link" style="color:blue"></i> VIEW MORE PERFORMANCE REPORTS</button>
                    	<a class="collapse-link">
                        	<i class="fa fa-chevron-up"></i>
                        </a>
      				</div>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-xs-3">
							<small class="stats-label"><i aria-hidden="true" class="fa fa-users" style="color:green"></i> Targeted People</small>
							<h2>643</h2>
						</div>
						<div class="col-xs-3">
							<small class="stats-label"><i aria-hidden="true" class="fa fa-envelope-open-o" style="color:blue"></i> Opens</small>
							<h2>64 (17%)</h2>
						</div>
						<div class="col-xs-3">
							<small class="stats-label"><i aria-hidden="true" class="fa fa-mouse-pointer" style="color:purple"></i> Clicks to Blog Post</small>
							<h2>13 (11%)</h2>
						</div>
						<div class="col-xs-3">
							<small class="stats-label"><i aria-hidden="true" class="fa fa-times-circle" style="color:red"></i> Unsubscribes</small>
							<h2>2 (1%)</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
<!--/ content -->           
			<div class="footer fixed">
				<!-- footer -->
				<div w3-include-html="footer.php"></div>
				<!-- / footer -->			
			</div>
		</div><!--  end page-wrapper -->
</div>
	
	<script src="js/w3data.js"></script>	
	<script>w3IncludeHTML();</script>
    <!-- <script src="js/jquery-3.1.1.min.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script type="text/JavaScript" src="global.js?n=1"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>
	<script src="js/davinci.js"></script>

	<!-- Chosen -->
	<!-- <script src="js/plugins/chosen/chosen.jquery.js"></script> -->
    
	<!-- X-editable -->
	<script src="js/plugins/bootstrap-editable/boostrap-editable.js"></script>

	<!-- Clipboard -->
	<script src="js/plugins/clipboard/clipboard.min.js"></script>

	<!-- clockpicker -->
	<script src="js/plugins/clockpicker/clockpicker.js"></script>

	<!-- datepicker -->
	<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

	<!-- Sweet alert -->
	<script src="css/sweet/sweetalert-dev.js"></script>

	<!-- Jasny -->
	<script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>

	<!-- TouchSpin -->
	<script src="js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <!-- Page-Level Scripts -->
	<script src="js/jquery.md5.js"></script>
	<script>
		var action = '';
		var campaignName = getParameterByName("campaign_name");
		var campaignID = getParameterByName("campaign_id");
		//if (campaignID === undefined || campaignID=='') {
        if(!hasValue(campaignID)){
			var keyword = campaignName+getCurrentDateTime();
			campaignID = $.md5(keyword);
		}

		$.fn.editable.defaults.mode = 'inline';
		$.fn.editableform.buttons  = 
        '<button type="button" class="btn btn-primary btn-sm editable-submit"><i class="glyphicon glyphicon-ok"></i></button>'+
        '<button type="button" class="btn btn-default btn-sm editable-cancel"><i class="glyphicon glyphicon-remove"></i></button>'+
        '<button type="button" class="btn btn-default btn-sm editable-off"><i class="glyphicon glyphicon-trash"></i></button>';
		
		$(document).ready(function() {
			$('#email_name').editable();

			$('.clockpicker').clockpicker( {
				twelvehour: true
			} );

			$( "#EMAIL1-SCHEDULE1-DATE" ).datepicker();

			$(".touchspin2").TouchSpin({
				initval: 1,
				min: 0,
				max: 100,
				step: 1,
				decimals: 0,
				boostat: 5,
				maxboostedstep: 10,
				postfix: '',
				postfix_extraclass: "btn btn-xs",
				buttondown_class: 'btn btn-white',
				buttonup_class: 'btn btn-white'
			});
        });

		function startEditable(objID){
			$('#subjectEmail'+objID).editable();
			//$('#template').trigger('change');
			
		}

		myApp.controller('myCtrl',function($scope,$http,Upload) {
            $scope.campaignID = campaignID;
            $scope.state = {    
                Save:"Save",
                Publish:"Launch Program",
            };
			$scope.uploadBeforeSave = function () {
				var file = $('#eBookFile').prop('files')[0];
				var uploadFileName = "eBOOK-" + uuidv4();
				$scope.state['Save'] = "Saving";
				Upload.upload({
					url: 'upload.php',
					method: 'POST',
					file:file,
					data: {
						file:file, 
						's3':'true',
						'fileName':uploadFileName,
						'acctID':'accountID',
						'progID':'programID',
					}
				}).then(function (resp) {
					console.log('Success ' + resp.config.data.file.name + 'uploaded');
					console.log(resp.data);
					$scope.campaign['URL-eBOOK-LOCATION'] = resp.data.imgSrc;
					$scope.Save();
				}, function (resp) {
					console.log('Error status: ' + resp.status);
				}, function (evt) {
					var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
					console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
				});
			};
			$scope.Save = function(mode,silence) {
                $scope.state['Save'] = "Saving";
				//alert(mode);
				$("body").css("cursor", "progress");
				if (mode == 'Email') {
					$scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL1CONTENT'] = $scope.templatesAs1[$scope.tpsIndex('1')].contentRaw;
					$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-EMAIL1SUBJECT'] = $("#subjectEmail1").text();
					$scope.campaign['EMAIL1-SUBJECT'] = $("#subjectEmail1").text();
				}
				if (mode == 'Email2') {
					$scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL2CONTENT'] = $scope.templatesAs2[$scope.tpsIndex('2')].contentRaw;
					$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-EMAIL2SUBJECT'] = $("#subjectEmail2").text();
					$scope.campaign['EMAIL2-SUBJECT'] = $("#subjectEmail2").text();
				}
				if (mode == 'Email3') {
					$scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL3CONTENT'] = $scope.templatesAs3[$scope.tpsIndex('3')].contentRaw;
					$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-EMAIL3SUBJECT'] = $("#subjectEmail3").text();
					$scope.campaign['EMAIL3-SUBJECT'] = $("#subjectEmail3").text();
				}
				if (mode == 'Welcome') {
					$scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-WELCOMEPAGECONTENT'] = $scope.templatesWelcome[$scope.getListIndex('templatesWelcome','content','templateWelcome')].contentRaw;
				}
				if (mode == 'ThankYou') {
					$scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-DOWNLOADPAGECONTENT'] = $scope.templatesThankYou[$scope.getListIndex('templatesThankYou','content','templateThankYou')].contentRaw;
				}
				$http.put('/couchdb/' + dbName +'/'+campaignID, $scope.campaign).then(function(response){
					$scope.campaign._rev = response.data.rev;

					var currentDate = getCurrentDateTime();
					$http.get("/couchdb/" + dbName +'/campaignlist'+"?"+new Date().toString()).then(function(response) {
						$scope.campaignlist  = response.data; 
						if (action=="newCampaign") {
							$scope.campaignlist.campaigns.push({"campaignID":$scope.campaign.campaignID,"accountID":accountID,"campaignName":$scope.campaign.campaignName,"createDate":currentDate,"lastEditDate":currentDate,"status":"Edit","campaignType":$scope.campaign.campaignType});
							action = 'editCampaign';
						} else{
							$scope.campaignlist.campaigns[$scope.clIndex()].lastEditDate = currentDate;
						}
						$http.put('/couchdb/' + dbName +'/campaignlist', $scope.campaignlist).then(function(response){
							$("body").css("cursor", "default");
							$scope.setDisplay();
                            if(silence == true){
                            }else{
                                //swal("Save Campaign Successful.", "", "success");
                                $scope.state['Save'] = 'Save';
                            }
							// Kwang backup current to master and clear formState
                            $scope.master  = angular.copy($scope.campaign);
                            $scope.clearFormState();   
						});
					},function(errResponse){
						// case new account
						if (errResponse.status == 404) {
							$scope.campaignlist = {campaigns:[]};
							
							$scope.campaignlist.campaigns.push({"campaignID":$scope.campaign.campaignID,"accountID":accountID,"campaignName":$scope.campaign.campaignName,"createDate":currentDate,"lastEditDate":currentDate,"status":"Edit","campaignType":$scope.campaign.campaignType});
							$http.put('/couchdb/' + dbName +'/campaignlist', $scope.campaignlist).then(function(response){
								$("body").css("cursor", "default");
								$scope.setDisplay();
								//swal("Save Campaign Successful.", "", "success");
								//alert("Save Campaign Successful.");
							});
						} else {
							//alert(errResponse.statusText);
							swal(errResponse.statusText);
						}
                        $scope.state['Save'] = 'Save';
					});
					
				});
			};
			$scope.Cancel = function() {
				swal({
					title: "Are you sure?",
					text: "You will not be able to recover your last changed!",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "OK!",
					closeOnConfirm: false
				}, function () {
					$scope.Reset(true);
					
				});
            };
			$scope.Reset = function(alert) {
				$scope.campaign  = angular.copy($scope.master);
				$("#subjectEmail1").text($scope.campaign['EMAIL1-SUBJECT']);
				$("#subjectEmail2").text($scope.campaign['EMAIL2-SUBJECT']);
				
				if (alert) {
					$scope.$apply();
					$scope.SelectChanged('viewEmail1','templateEmail1');
					$scope.sendersChanged('textSender1');
                    // Kwang clear form state
                    $scope.clearFormState();
					swal("Cancel!", "You are back to previous version.", "success");
				}
            };
			$scope.Load = function() {
				$http.get("/couchdb/" + dbName +'/'+campaignID+"?"+new Date().toString()).then(function(response) {
					action = 'editCampaign';
					$scope.master  = response.data;
					$scope.campaign  = angular.copy($scope.master);
					$scope.openEmail1 = true;
					$scope.setInitValue();
					$scope.setDisplay();
					$scope.LoadAudience(); 
					$scope.Reset();
                },function(errResponse){
					if (errResponse.status == 404) {
						action = 'newCampaign';
						$scope.campaign = {"campaignID":campaignID,"campaignName":campaignName,"campaignType":"PromoteEbook","accountID":accountID,"totalEmail":"2","publishProgramName":"","publishDate":"","filterSelected":[]};
						$scope.openEmail1 = true;
						$scope.setInitValue();
						$scope.setDisplay();
                        $scope.LoadAudience(); 
					} else {
						//alert(errResponse.statusText);
						swal(errResponse.statusText);
					}
				});
				
            };
			$scope.setInitValue = function(){
				$scope.initTemplateWelcome();
				$scope.initTemplateThankyou();
				$scope.initTemplateEmail('1');
				$scope.initSender();
			};
			/*$scope.initEmailTemplate = function(){
				$http.get("/admin/getEmailTemplate.php?blueprint=PromoteBlog&scopeName=campaign").then(function(response) {
					$scope.templates  = response.data.templates; 
					$scope.config = response.data.config; 
					$scope.campaign = jQuery.extend(true, {},$scope.config,$scope.campaign);
					$("#subjectEmail1").text($scope.campaign['EMAIL1-SUBJECT']);
					$scope.SelectChanged('viewEmail1','templateEmail1');
					$scope.sendersChanged('textSender1');
					startEditable('1');
				});
			};*/
			$scope.initTemplateEmail = function(emlID){
				if ($scope['openEmail'+emlID] || emlID=='1') { //Email #1 always open.
					$http.get("/admin/getEmailTemplate.php?blueprint=PromoteBlog&scopeName=campaign&as="+emlID).then(function(response) {
						$scope['templatesAs'+emlID]  = response.data.templates; 
						if (emlID == '1')
						{
							$scope.config = response.data.config; 
							$scope.campaign = jQuery.extend(true, {},$scope.config,$scope.campaign);
						}
						$("#subjectEmail"+emlID).text($scope.campaign['EMAIL'+emlID+'-SUBJECT']);
						$scope.SelectChanged('viewEmail'+emlID,'templateEmail'+emlID);
						$scope.sendersChanged('textSender'+emlID);
						startEditable(emlID);
					});
				}
			};
			$scope.initTemplateWelcome = function(){
				
				$http.get("/admin/getEmailTemplate.php?blueprint=PromoteEbook&scopeName=campaign&resource=pages").then(function(response) {
					$scope['templatesWelcome']  = response.data.templates; 
					$scope.config = response.data.config; 
					$scope.campaign = jQuery.extend(true, {},$scope.config,$scope.campaign);
					$scope.SelectChanged('viewWelcome','templateWelcome');
				});
				
			};
			$scope.initTemplateThankyou = function(){
				$http.get("/admin/getEmailTemplate.php?blueprint=PromoteEbook&scopeName=campaign&resource=pages").then(function(response) {
					$scope['templatesThankYou']  = response.data.templates; 
					$scope.config = response.data.config; 
					$scope.campaign = jQuery.extend(true, {},$scope.config,$scope.campaign);
					$scope.SelectChanged('viewThankYou','templateThankYou');
				});
			};
			$scope.initSender = function(){
				$scope.senders = [];
				$scope.senders.push({"email" : "boonsom@mindfireinc.com","name" : "Boonsom Coa" });
                $scope.senders.push({"email" : "kdutta@mindfireinc.com","name" : "Kushal Dutta" });
				$scope.senders.push({"email" : "daver@mindfireinc.com","name" : "David Rosendahl"});
				$scope.senders.push({"email" : "mcfarsheed@mindfireinc.com","name" : "Mackenzi Farsheed"});                
			};
			$scope.setDisplay = function(){
				$scope.openEmail = {
					"1":true,
					"2":false,
					"3":false,
				};
				$scope.openEmail2 = false;
				$scope.openEmail3 = false;
                $scope.step1Done = hasValue($scope.campaign['URL-eBOOK-LOCATION']);
				$scope.step2Done = hasValue($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-WELCOMEPAGECONTENT']);
                $scope.step3Done = hasValue($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL1CONTENT']);
                $scope.step4Done = $scope.step3Done;
                $scope.step5Done = $scope.step4Done;
				if ($scope.campaign.totalEmail > '3')	{
					$scope.emailProgress = $scope.campaign.totalEmail+' of '+$scope.campaign.totalEmail+' emails ready';
				} else {
					var emailDone = '0';
					if ($scope.step3Done) {
						emailDone = '1';
						if (hasValue($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL2CONTENT'])) {
							emailDone = '2';
							$scope.openEmail2 = true;
							$scope.openEmail["2"] = true;
						}
						if (hasValue($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL3CONTENT'])) {
							emailDone = '3';
							$scope.openEmail3 = true;
							$scope.openEmail["3"] = true;
						}
					}
					$scope.emailProgress = emailDone+' of '+$scope.campaign.totalEmail+' emails ready';
				}

				var pageDone = '0';
				if ($scope.step2Done) {
					pageDone = '1';
					if (hasValue($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-DOWNLOADPAGECONTENT'])) {
						pageDone = '2';
					}
				}
				$scope.pageProgress = pageDone+' of 2 Pages Configured';
				$scope.scheduleProgress = emailDone+' Drip Emails Configured';
			};
			$scope.SelectChanged = function(emailViewID,templateField){
				//$scope.content = angular.copy($scope.templateEmail1);
				$("#"+emailViewID).html($scope.campaign[templateField]);
				angular.element(document).injector().invoke(function($compile) {
					var scope = angular.element($("#"+emailViewID)).scope();
					$compile($("#"+emailViewID))(scope);
				});
			};
			$scope.sendersChanged = function(senderTextID){
				if (!hasValue($scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMEMAIL'])) {
					$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMNAME'] = '';
					$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMEMAIL'] = '';
				} else {
					$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMNAME'] = $scope.senders[$scope.sdIndex()].name
					$("#"+senderTextID).text('New Email from: "'+$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMNAME']+'" <'+$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMEMAIL']+'>');
				}
			};
			$scope.startEmail = function(cmd){
				var currentEmail = '1';
				var email1Fields = ["EMAIL1-BACKGROUND-COLOR", "EMAIL1-BOTTOM-TEXT", "EMAIL1-BUTTON-COLOR", "EMAIL1-CTA-TEXT", "EMAIL1-HERO-IMAGE", "EMAIL1-NAME", "EMAIL1-SUBJECT", "EMAIL1-TOP-TEXT", "templateEmail1"];
				if (cmd.endsWith("2")) {
					currentEmail = '2';
					$scope.openEmail2 = true;
					if (cmd=='COPY2') {
						$scope.copyEmail(email1Fields,'1','2');
					} else {
						$scope.copyEmail(email1Fields,'2','2');
					}
				} else if (cmd.endsWith("3")) {
					currentEmail = '3';
					$scope.openEmail3 = true;
					if (cmd=='COPY3') {
						$scope.copyEmail(email1Fields,'2','3');
					} else {
						$scope.copyEmail(email1Fields,'3','3');
					}
				}
			};
			$scope.copyEmail = function(fields,src,tar){
				if (src!=tar) {
					var emailSRCFields = fields.map(function(x){ return x.replace(/1/g,src) });
					var emailTARFields = fields.map(function(x){ return x.replace(/1/g,tar) });
					for (var i=0; i<fields.length; i++) {
						if (emailTARFields[i]=="templateEmail"+tar) 	{
							$scope.campaign[emailTARFields[i]] = $scope.campaign[emailSRCFields[i]].replace(new RegExp("campaign\\[\\'EMAIL"+src, "gi"), "campaign['EMAIL"+tar);
						} else {
							$scope.campaign[emailTARFields[i]] = $scope.campaign[emailSRCFields[i]];
						}
					}
				}
				$http.get("/admin/getEmailTemplate.php?blueprint=PromoteBlog&scopeName=campaign&as="+tar).then(function(response) {
					$scope['templatesAs'+tar]  = response.data.templates; 
					$scope.config = response.data.config;
					$("#subjectEmail"+tar).text($scope.campaign['EMAIL'+tar+'-SUBJECT']);
					$scope.SelectChanged('viewEmail'+tar,'templateEmail'+tar);
					$scope.sendersChanged('textSender'+tar);
					startEditable(tar);
				});
			}
			$scope.clIndex = function() {
				var cplist = 	$scope.campaignlist.campaigns;
				for(var i=0;i < cplist.length; i++){
				  if (cplist[i]["campaignID"] == campaignID)
				  {
					return i;
				  } 
				}
            };
			$scope.tpsIndex = function(emlID) {
				var tplist = 	$scope['templatesAs'+emlID];
				for(var i=0;i < tplist.length; i++){
				  if (tplist[i]["content"] == $scope.campaign['templateEmail'+emlID])
				  {
					return i;
				  } 
				}
            };
			$scope.sdIndex = function() {
				var sdlist = 	$scope.senders;
				for(var i=0;i < sdlist.length; i++){
				  if (sdlist[i]["email"] == $scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMEMAIL'])
				  {
					return i;
				  } 
				}
            };
			$scope.getListIndex = function(tpName,tpField,cpField) {
				var tpList = $scope[tpName];
				for(var i=0;i < tpList.length; i++){
				  if (tpList[i][tpField] == $scope.campaign[cpField])
				  {
					return i;
				  } 
				}
            };
            $scope.CanPublish = function() {
                return $scope.step1Done==true && $scope.step2Done==true && $scope.step3Done==true && $scope.step4Done==true && $scope.step5Done==true ;
            };
            $scope.Publish = function() {
                //alert("Do publish here");
                $scope.state['Publish'] = "Launching";
                $http(
                    {
                        method: 'POST',
                        url: 'backend.php' + "?" +new Date().toString(),
                        data: ObjecttoParams(
                            {
                                "cmd":"publish",
                                "acctID":accountID,
                                "progID":campaignID,
                            }
                        ),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    }
                ).then(function(response){
                    if(response.data.success == false){
                        swal(response.data.message);
                        var str = JSON.stringify(response.data, null, 4); // (Optional) beautiful indented output.
                        console.log(str); // Logs output to dev tools console.
                        
                    }else{
                        swal(response.data.message);
                    }
                    $scope.state['Publish'] = "Launch Program";
                    //alert(response);
                },function(errResponse){
                    $scope.state['Publish'] = "Launch Program";
                    swal("Server Error");
                    //alert(errResponse);
                });
            };
            // Kwang clear form state
            $scope.clearFormState = function(){
                //$scope.frmStep3.$setPristine();
            };
            //Kwang uiSwitch change
            $scope.SwitchChange = function(){
                $scope.campaign['VISIT-MY-EBOOK'] = MapTrueFalse($scope.campaign['VISIT-MY-EBOOK-'],"Start","Stop");                
                $scope.campaign['DOWNLOAD-MY-EBOOK'] = MapTrueFalse($scope.campaign['DOWNLOAD-MY-EBOOK-'],"Start","Stop");
                $scope.Save("",true);   //silence save
                //alert('SwitchChange');
            };

            $scope.ViewReport = function(){
                //window.location.href = "reporting.php?campaignID=" + campaignID;
                window.open("reporting.php?campaignID=" + campaignID);

            };

			$scope.LoadAudience = function() {     
				
				if (typeof $scope.campaign['filterSelected']  == 'undefined') {
		   				$scope.filterList = [];
				}else{
						$scope.filterList = $scope.campaign['filterSelected'] ;	
				} 
				$http.get("/couchdb/" + dbName +'/audienceLists'+"?"+new Date().toString()).then(function(response) {
								$scope.masterAu  = response.data; 								
								 if (typeof $scope.masterAu.items == 'undefined') {
								   $scope.masterAu.items = [];
								 } 
								 $scope.audience  = angular.copy($scope.masterAu);	
				},function(errResponse){				
						if (errResponse.status == 404) {
							alert("ERROR 404 [audienceLists]"); 
						}
				});
            };			

			$scope.Load();
		});
		function toDate(dateStr) {			
			var parts1 = dateStr.split(" ");

			var parts2 = parts1[0].split("/");

			return new Date(parts2[2], parts2[0] - 1, parts2[1]);
		}


		function addDays(theDate, days) {
			return new Date(theDate.getTime() + days*24*60*60*1000);
		}		

		function formatDate(date) {
			var year = date.getFullYear();
				month = date.getMonth() + 1; // months are zero indexed
				day = date.getDate();
			

			return str_pad(month) + "/" + str_pad(day) + "/" + year;
		}

		function convertTime (timeString) {
			var hourEnd = timeString.indexOf(":");
			var H = +timeString.substr(0, hourEnd);
			var h = H % 12 || 12;
			var ampm = H < 12 ? ":00 AM" : ":00 PM";
			timeString = h + timeString.substr(hourEnd, 3) + ampm;

			 
			return timeString; // return adjusted time or original string
		}

		function str_pad(n) {
		    return String("0" + n).slice(-2);
		}

		function convertTimeFormat (timeString) {
			timeString = timeString.replace("PM", ":00 PM");
			timeString = timeString.replace("AM", ":00 AM");
			return timeString; 
		}
        
        function hasValue(obj,defaultValue){
            if (obj===undefined || obj=='') {
                return false;
            } else {
                //make sure that it is not default if provided
                if(defaultValue ===undefined){
                }else{
                    if(obj == defaultValue){
                        return false;
                    }
                }
				return true;
			}
        }
        
        function ObjecttoParams(obj) {
            var p = [];
            for (var key in obj) {
                p.push(key + '=' + encodeURIComponent(obj[key]));
            }
            return p.join('&');
        };
        
        function MapTrueFalse(obj,trueValue,falseValue){
            if(obj == true){
                return trueValue;
            }else{
                return falseValue;
            }
        }
        
        function formatDate(date) {
          var monthNames = [
            "January", "February", "March",
            "April", "May", "June", "July",
            "August", "September", "October",
            "November", "December"
          ];

          var day = date.getDate();
          var monthIndex = date.getMonth();
          var year = date.getFullYear();

          return day + ' ' + monthNames[monthIndex] + ' ' + year;
        }
                
    </script>

</body>

</html>
