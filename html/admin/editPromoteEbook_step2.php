<style type="text/css">
	.window {
		width: 100%;
	}
</style>
<div class="panel panel-default" ng-controller="step2" id="step2ID">

	<div class="panel-heading">
		<div class="row">
			<div class="col-sm-3">
				<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseTwo" onclick="setLeftBar();"><span class="badge" ng-show="!step2Done">2</span>
				<i aria-hidden="true" class="fa fa-check-circle fa-lg" style="color:green" ng-show="step2Done"></i> Set Up Your Landing Page</a></h4>
			</div>
			<div class="col-sm-9">
				<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseTwo">
        <small class="m-l-sm" ng-show="pageDone > 0"><i aria-hidden="true" class="fa fa-file-o" ng-show="pageDone > 0"></i> {{pageProgress}}</small> </a></h4>
			</div>
		</div>
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
										<a data-toggle="tab" href="#tab-1"><i aria-hidden="true" class="fa fa-file-text-o" style="color:green"></i> Welcome Page</a>
									</li>
									<li class="">
										<a data-toggle="tab" href="#tab-2"><i aria-hidden="true" class="fa fa-file-text-o" style="color:blue"></i> Thank-You Page</a>
									</li>
									<li class="">
										<a data-toggle="tab" href="#tab-3"><i aria-hidden="true" class="fa fa-cogs"></i> <strong>Landing Page Settings</strong></a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab-1">
										<div class="mail-box-header">
											<!--<a href="" class="btn btn-success btn-block" data-toggle="tooltip" data-placement="top" title="I'll send you a test of this email to daver@mindfireinc.com"><i class="fa fa-share-square-o"></i> Preview</a>-->
											<div class="pull-right tooltip-demo">
												<a ng-model="file" ngf-select="upload2Pages($file,'LANDINGPAGE-HERO-IMAGE')" href="" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="I'll upload and replace image of this page"><span ng-show="state['LANDINGPAGE-HERO-IMAGE'] == 'Uploading'"><i class="glyphicon glyphicon-refresh spinning"></i></span><i class="fa fa-cloud-upload" ng-show="state['LANDINGPAGE-HERO-IMAGE'] != 'Uploading'"></i> Upload image</a>
												<a class="btn btn-white fullscreen-link"><i class="fa fa-arrows-alt"></i> Edit in Full Screen</a>
												<button class="btn btn-primary" ng-click="Save('Welcome')"><i class="fa fa-floppy-o" ng-show="state['Save'] == 'Save'"></i><span ng-show="state['Save'] == 'Saving'"><i class="glyphicon glyphicon-refresh spinning"></i></span> {{state['Save']}} Page</button>
												<a
												 class="btn btn-white" data-placement="top" data-toggle="tooltip" title="Leave without saving" ng-click="Cancel()"><i class="fa fa-ban"></i> Cancel</a>
											</div>
											<div class="col-xs-6" style="padding-left: 0px;padding-right: 0px;">
												<div class="col-xs-6">
													<label>Template</label>
													<select ng-model="campaign.templateWelcome" ng-change="SelectChanged('viewWelcome','templateWelcome')" style="width: 100%;height: 30px;">
													<option ng-repeat="x in templatesWelcome" value="{{x.content}}">{{x.title}}</option>
													</select>
												</div>
												<div class="col-xs-6">
													<label>Form</label>
													<select ng-model="campaign['landing_form']" ng-change="FormChanged('landing_form','LANDINGPAGE-FORM')" style="width: 100%;height: 30px;">
														<option ng-repeat="x in listForm" value="{{x.formHTML}}">{{x.formName}}</option>
													</select>
													<!-- <select ng-model="campaign['LANDINGPAGE-FORM']" ng-options="x.formHTML as x.formName for x in listForm" style="width: 100%;height: 30px;">
													</select> -->
												</div>
											</div>
											<br><br>
										</div>
										<div class="ibox-content">
											<div class="window">
												<div class="titlebar">
													<div class="buttons">
														<div class="close"></div>
														<div class="minimize"></div>
														<div class="zoom"></div>
													</div><small>eBook Landing Page</small>
													<!-- window title -->
												</div>
												<div class="content">
													<div class="template_preview">
														<div id="viewWelcome"></div>
													</div>
												</div>
											</div>
										</div>
										<div class="row"></div>
									</div>
									<div class="tab-pane" id="tab-2">
										<div class="mail-box-header">
											<!--<a href="" class="btn btn-success btn-block" data-toggle="tooltip" data-placement="top" title="I'll send you a test of this email to daver@mindfireinc.com"><i class="fa fa-share-square-o"></i> Preview</a>-->
											<div class="pull-right tooltip-demo">
												<a class="btn btn-white fullscreen-link"><i class="fa fa-arrows-alt"></i> Edit in Full Screen</a>
												<button class="btn btn-primary" ng-click="Save('ThankYou')"><i class="fa fa-floppy-o" ng-show="state['Save'] == 'Save'"></i><span ng-show="state['Save'] == 'Saving'"><i class="glyphicon glyphicon-refresh spinning"></i></span> {{state['Save']}} Page</button>
												<a
												 class="btn btn-white" data-placement="top" data-toggle="tooltip" title="Leave without saving" ng-click="Cancel()"><i class="fa fa-ban"></i> Cancel</a>
											</div>
											<div class="col-xs-4">
												<select ng-model="campaign.templateThankYou" ng-change="SelectChanged('viewThankYou','templateThankYou')" style="width: 100%;height: 30px;">
												<option ng-repeat="x in templatesThankYou" value="{{x.content}}">{{x.title}}</option>
												</select>
											</div>
											<br><br>
										</div>
										<div class="ibox-content">
											<div class="window">
												<div class="titlebar">
													<div class="buttons">
														<div class="close"></div>
														<div class="minimize"></div>
														<div class="zoom"></div>
													</div><small>eBook Landing Page</small>
													<!-- window title -->
												</div>
												<div class="content">
													<div class="template_preview">
														<div id="viewThankYou"></div>
													</div>
												</div>
											</div>
										</div>
										<div class="row"></div>
									</div>
									<div class="tab-pane" id="tab-3">
										<div class="panel-body">
											<div class="ibox float-e-margins">
												<div class="ibox-content">
													<form action="" class="form-horizontal" method="post">
														<div class="form-group">
															<label class="col-sm-2 control-label">Welcome Page URL</label>
															<div class="col-sm-10">
																<p>
																	<a href="<?php echo $LANDINGPAGEDOMAIN; ?>/Welcome.html" target="_blank" id="welcomeURL">
																		<?php echo $LANDINGPAGEDOMAIN; ?>/Welcome.html</a> &nbsp;&nbsp;&nbsp;<a class="btn btn-white btn-sm btn-copy" data-clipboard-target="#welcomeURL"><i class="fa fa-copy"></i> Copy URL</a> <a class="btn btn-white btn-sm" href="<?php echo $LANDINGPAGEDOMAIN; ?>/Welcome.html" target="_blank"><i class="fa fa-external-link"></i> Open in New Window</a></p>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label">Thank-You Page URL</label>
															<div class="col-sm-10">
																<p>
																	<a href="<?php echo $LANDINGPAGEDOMAIN; ?>/Download.html" target="_blank" id="downloadURL">
																		<?php echo $LANDINGPAGEDOMAIN; ?>/Download.html</a> &nbsp;<a class="btn btn-white btn-sm btn-copy" data-clipboard-target="#downloadURL"><i class="fa fa-copy"></i> Copy URL</a> <a class="btn btn-white btn-sm" href="<?php echo $LANDINGPAGEDOMAIN; ?>/Download.html" target="_blank"><i class="fa fa-external-link"></i> Open in New Window</a></p>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label">Landing Page Domain</label>
															<div class="col-xs-4">
																<select class="chosen-select col-xs-4" id="domain" name="domain" tabindex="2" disabled>
																	<option data-show=".Pick" value="Pick">
																		Pick a domain ...
																	</option>
																	<option selected value="d1">
																		a-generic-domain-we-buy.com
																	</option>
																	<option value="d2">
																		another-generic-domain-we-buy.com
																	</option>
																	<option value="d3">
																		A-domain-they-have-purchased.com
																	</option>
																</select><br>
																<div style="padding-top: 10px;">
																	<a class="btn btn-success btn-block btn-sm" data-placement="top" data-toggle="tooltip" href="https://www.godaddy.com" target="_blank" title="Domains are cool."><i class="fa fa-share-square-o"></i> Buy my own domain for $11 p/year</a>
																</div>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label">Meta Title</label>
															<div class="col-sm-10">
																<input class="form-control" name="URL-eBOOK-NAME" placeholder="Crime and Punishment" type="text" value="{{URL-eBOOK-NAME}}"><span class="help-block m-b-none">Enter the name of your eBook. This will appear on your landing page and other key areas.</span>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="js/editPromoteEbook_step2.js"></script>