<?php
    $emailHTMLTemplate = file_get_contents('eachEmailCode.html');
	$email3 = str_replace('##emailid##','3',$emailHTMLTemplate);
?>
<div class="panel panel-default" ng-controller="step2">
<div class="panel-heading">
	<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseTwo">
		<span class="badge" ng-show="!step2Done">2</span>
		<i aria-hidden="true" class="fa fa-check-circle fa-lg" style="color:green" ng-show="step2Done""></i>
		&nbsp;Write Your Email Sequence &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small class="m-l-sm"> <i class="fa fa-envelope-o" aria-hidden="true"></i> {{emailProgress}}</small></a>
	</h4>
</div>
<div class="panel-collapse collapse" id="collapseTwo">
	<div class="panel-body">
		<div class="row wrapper border-bottom white-bg page-heading">
			<div class="wrapper wrapper-content animated fadeIn gray-bg">
				<div class="row">
					<div class="col-lg-12">
						<div class="tabs-container">
							<ul class="nav nav-tabs">
								<li class="active">
									<a data-toggle="tab" href="#tab-1" ng-click="initEmailTemplate();">Email #1: Sent to Everyone You're Targeting</a>
								</li>
								<li class="">
									<a data-toggle="tab" href="#tab-2" ng-click="initTemplateEmail('2');">Email #2: Sent to Non-Openers</a>
								</li>
								<li class="">
									<a data-toggle="tab" href="#tab-3" ng-click="initTemplateEmail('3');">Email #3: Sent to Non-Clickers</a>
								</li>
								<!-- Jiew -->
								<li class="" ng-repeat="item in emailList" ng-cloak>
									<a data-toggle="tab" href="#tab-{{item.emlID}}" ng-click="initTemplateEmail('{{item.emlID}}');">{{item.tabLabel}}&nbsp;&nbsp;<i class="fa fa-close" ng-click="removeTab(item)"></i></a>
								</li>
								<li class="" ng-if="emlIndex<maxEmail">
									<a data-toggle="tab"><i class="fa fa-plus" ng-click="newTab();"></i></a>
								</li>
								<!-- Jiew -->
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tab-1">
									<div class="mail-box-header">
										<div class="pull-right tooltip-demo">
											<button class="btn btn-primary" ng-click="Save('Email')"><i class="fa fa-floppy-o" ng-show="state['Save'] == 'Save'"></i><span ng-show="state['Save'] == 'Saving'"><i class="glyphicon glyphicon-refresh spinning"></i></span> {{state['Save']}} Email</button><a class="btn btn-white" data-placement="top" data-toggle="tooltip" title="Leave without saving" ng-click="Cancel()"><i class="fa fa-ban"></i> Cancel</a> 
										</div>
										<h3>Subject: <a data-pk="2" data-title="Email Name" data-type="text" data-url="" href="#" id="subjectEmail1"></a></h3>
									</div>	
									
									<div class="row">
										<div class="col-lg-4">
											<div class="ibox-content">
												<div class="ibox-content">
													<form class="form-horizontal">
														<div class="form-group">
															<div class="col-sm-12">
																		<div>Select who you want this email to come from.  Once you've picked a template, roll over the various text blocks in the email template to see what you can edit.</div>
																		<label class="control-label">From</label> 
																		<select ng-model="campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMEMAIL']" ng-change="sendersChanged('textSender1')" style="width: 100%;height: 30px;">
																		<option ng-repeat="x in senders" value="{{x.email}}">{{x.name}}&nbsp;({{x.email}})</option>
																		</select>
																		<!-- <select name="EMAIL-{{email_number}}-from_address" class="chosen-select" data-placeholder="Choose a sender (replies go here too)" tabindex="1">
																			<option value="">
																				Choose a sender (replies go here too)
																			</option>
																			<option value="david_rosendahl">
																				David Rosendahl (daver@mindfireinc.com)
																			</option>
																			<option value="mackenzi_farsheed">
																				Mackenzi Farsheed (mcfarsheed@mindfireinc.com)
																			</option> 
																		</select> -->
																	</div>
																</div>
																<div class="form-group">
																	<div class="col-sm-12">
																		<label class="control-label">Template</label> 
																		<select ng-model="campaign.templateEmail1" ng-change="SelectChanged('viewEmail1','templateEmail1')" style="width: 100%;height: 30px;">
																		<option ng-repeat="x in templates" value="{{x.content}}">{{x.title}}</option>
																		</select>
																		<!-- <select class="chosen-select" data-target=".template_preview" id="template" tabindex="2" name="EMAIL-{{email_number}}-template">
																		<option data-show=".Pick" value="Pick">
																				Pick a template...
																			</option>
																			<option data-show=".Plain" value="Plain">
																				Plain: Looks manual & handwritten
																			</option>
																			<option data-show=".Company_Email" value="Company_Email">
																				Company Email: Your company logo, call to action button, and address in footer
																			</option>
																		</select> -->
																	</div>
																	<div class="col-sm-12">
																		<div><p></p></div>
																		<div class="tooltip-demo">
																		<label class="control-label"></label> 
																		<a href="" class="btn btn-success btn-block" data-toggle="tooltip" data-placement="top" title="I'll send you a test of this email to daver@mindfireinc.com"><i class="fa fa-share-square-o"></i> Send me a test email</a>
																	  </div>
																	</div>
																	
																</div>
														<div class="hr-line-dashed"></div><input name="URL-PABP-EML1-FROMADDRESS" type="hidden" value="{{STUDIO_ACCOUNTID-STUDIO_PROGRAMID-PABP-EML1-FROMADDRESS}}"> <input name="URL-PABP-EML1-FROMNAME" type="hidden" value="{{STUDIO_ACCOUNTID-STUDIO_PROGRAMID-PABP-EML1-FROMNAME}}"> <input name="programNameHash" type="hidden" value="{{programNameHash}}">
													</form>
												</div>
											</div>
										</div>
										<div class="col-lg-8">
											<div class="ibox-content">
												<div class="window">
													<div class="titlebar">
														<div class="buttons">
															<div class="close"></div>
															<div class="minimize"></div>
															<div class="zoom"></div>
														</div><small><span id="textSender1">New Email from:</span></small> <!-- window title -->
													</div>
													<div class="content">
														<div class="template_preview">
															<div id="viewEmail1"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
<!-- Email #2 -->																			
								<div class="tab-pane" id="tab-2">
									<div class="panel-body" ng-show="!openEmail2">
										<h2>By adding a second email to non-openers, you'll increase engagement rates by an average of 24%.</h2>
										<p><button type="button" class="btn btn-primary btn-lg" ng-click="startEmail('COPY2')">Create Email Using #1's Content</button>
										<button type="button" class="btn btn-default btn-lg" ng-click="startEmail('NEW2')">Start With a Blank Email</button></p>
									</div>

									<div class="mail-box-header" ng-show="openEmail2">
										<div class="pull-right tooltip-demo">
											<a class="btn btn-white" data-placement="top" data-toggle="tooltip" title="Leave without saving" ng-click="Cancel()"><i class="fa fa-ban"></i> Cancel</a> <button class="btn btn-primary" ng-click="Save('Email2')"><i class="fa fa-floppy-o"></i> Save Email</button>
										</div>
										<h3>Subject: <a data-pk="2" data-title="Email Name" data-type="text" data-url="" href="#" id="subjectEmail2"></a></h3>
									</div>	
									
									<div class="row" ng-show="openEmail2">
										<div class="col-lg-4">
											<div class="ibox-content">
												<div class="ibox-content">
													<form action="" class="form-horizontal" method="post" onsubmit="return postForm()">
														<div class="form-group">
															<div class="col-sm-12">
																		<div>Select who you want this email to come from.  Once you've picked a template, roll over the various text blocks in the email template to see what you can edit.</div>
																		<label class="control-label">From</label> 
																		<select ng-model="campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMEMAIL']" ng-change="sendersChanged('textSender2')" style="width: 100%;height: 30px;">
																		<option ng-repeat="x in senders" value="{{x.email}}">{{x.name}}&nbsp;({{x.email}})</option>
																		</select>
																	</div>
																</div>
																<div class="form-group">
																	<div class="col-sm-12">
																		<label class="control-label">Template</label> 
																		<select ng-model="campaign.templateEmail2" ng-change="SelectChanged('viewEmail2','templateEmail2')" style="width: 100%;height: 30px;">
																		<option ng-repeat="x in templatesAs2" value="{{x.content}}">{{x.title}}</option>
																		</select>
																	</div>
																	<div class="col-sm-12">
																		<div><p></p></div>
																		<div class="tooltip-demo">
																		<label class="control-label"></label> 
																		<a href="" class="btn btn-success btn-block" data-toggle="tooltip" data-placement="top" title="I'll send you a test of this email to daver@mindfireinc.com"><i class="fa fa-share-square-o"></i> Send me a test email</a>
																	  </div>
																	</div>
																	
																</div>
														<div class="hr-line-dashed"></div><input name="URL-PABP-EML1-FROMADDRESS" type="hidden" value="{{STUDIO_ACCOUNTID-STUDIO_PROGRAMID-PABP-EML1-FROMADDRESS}}"> <input name="URL-PABP-EML1-FROMNAME" type="hidden" value="{{STUDIO_ACCOUNTID-STUDIO_PROGRAMID-PABP-EML1-FROMNAME}}"> <input name="programNameHash" type="hidden" value="{{programNameHash}}">
													</form>
												</div>
											</div>
										</div>
										<div class="col-lg-8">
											<div class="ibox-content">
												<div class="window">
													<div class="titlebar">
														<div class="buttons">
															<div class="close"></div>
															<div class="minimize"></div>
															<div class="zoom"></div>
														</div><small><span id="textSender2">New Email from:</span></small> <!-- window title -->
													</div>
													<div class="content">
														<div class="template_preview">
															<div id="viewEmail2"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="tab-3">
									<div class="panel-body" ng-show="!openEmail3">
										<h2>By adding a third email to non-clickers, you'll increase engagement rates by an average of 14%.</h2>
										<p><button type="button" class="btn btn-primary btn-lg" ng-click="startEmail('COPY3')">Create Email Using #2's Content</button>
										<button type="button" class="btn btn-default btn-lg" ng-click="startEmail('NEW3')">Start With a Blank Email</button></p>
									</div>
									<?php echo $email3; ?>
								</div>

								<!-- Jiew -->
								<div ng-repeat="item in emailList" class="tab-pane" id="tab-{{item.emlID}}">
									<div class="panel-body" ng-show="!openEmail{{item.emlID}}">
										{{item.emlHead}}
										<!-- <h2>By adding a third email to non-clickers, you'll increase engagement rates by an average of 14%.</h2>
										<p><button type="button" class="btn btn-primary btn-lg" ng-click="startEmail('COPY3')">Create Email Using #2's Content</button>
										<button type="button" class="btn btn-default btn-lg" ng-click="startEmail('NEW3')">Start With a Blank Email</button></p> -->
									</div>
								</div>
								<!-- Jiew -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script>
	myApp.controller('step2',function($scope,$http) {
		//var email4 = {emlID : '4',tabLabel : 'Email #4: Sent to Non-Order',emlHead : 'Thsi is Email #4 Content.'};
		//var email4 = {emlID : '4',tabLabel : 'Email #4: Sent to Non-Order',emlHead : 'Thsi is Email #4 Content.'};
		//var email4 = {emlID : '4',tabLabel : 'Email #4: Sent to Non-Order',emlHead : 'Thsi is Email #4 Content.'};
		var emails = [{emlID : '4',tabLabel : 'Email #4: Sent to Non-Order',emlHead : 'Thsi is Email #4 Content.'},
								{emlID : '5',tabLabel : 'Email #5: Sent to Non-Order',emlHead : 'Thsi is Email #5 Content.'},
								{emlID : '6',tabLabel : 'Email #6: Sent to Non-Order',emlHead : 'Thsi is Email #6 Content.'}];
		//emails.push(email4);
		$scope.emlIndex = 0;
		$scope.maxEmail = 0;
		$scope.emailList = [];
		$scope.newTab = function(tab){
			//emlIndex = parseInt($scope.campaign.totalEmail)+1;
			$scope.emailList.push(emails[$scope.emlIndex]);
			$scope.emlIndex++;
			$('.nav-tabs a[href="#tab-4"]').tab('show');
		}
		$scope.removeTab = function(tab){
			swal({
				title: "Are you sure?",
				text: "You will not be able to recover this Email!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: false
			}, function () {
				$scope.emailList.splice($scope.emailList.indexOf(tab), 1);
				$scope.emlIndex--;
				$scope.$apply();
				swal("Deleted!", "Your imaginary file has been deleted.", "success");
			});
		}
	});
</script>