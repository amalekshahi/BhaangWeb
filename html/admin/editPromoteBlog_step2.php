<?php
  $emailHTMLTemplate = file_get_contents('eachEmailCode.html');
	$email3 = str_replace('##emailid##','3',$emailHTMLTemplate);
?>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-chosen-localytics/1.8.0/angular-chosen.min.js"></script>
	
	<div class="panel panel-default" ng-controller="step2" id="step2ID">
		<div class="panel-heading">

			<div class="row">
				<div class="col-sm-3">
					<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseTwo"><span class="badge" ng-show="!step2Done">2</span><i aria-hidden="true" class="fa fa-check-circle fa-lg" style="color:green" ng-show="step2Done"></i> Write Your Email Sequence
			</h4>
		</div>
		<div class="col-sm-9">
			<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseTwo"><small class="m-l-sm"> <i class="fa fa-envelope-o" aria-hidden="true"></i> {{emailProgress}}</small></a>
					</h4>
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
											<a data-toggle="tab" href="#tab-1" ng-click="initTemplateEmail('1');">Email #1: Sent to Everyone You're Targeting</a>
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
													<button class="btn btn-primary" ng-click="Save('Email')"><i class="fa fa-floppy-o" ng-show="state['Save'] == 'Save'"></i><span ng-show="state['Save'] == 'Saving'"><i class="glyphicon glyphicon-refresh spinning"></i></span> {{state['Save']}} Email</button>
													<a
													 class="btn btn-white" data-placement="top" data-toggle="tooltip" title="Leave without saving" ng-click="Cancel()"><i class="fa fa-ban"></i> Cancel</a>
												</div>
												<h3>Subject: <a data-pk="2" data-title="Email Name" data-type="text" data-url="" href="#" id="subjectEmail1"></a></h3>
											</div>

											<div class="row">
												<div class="col-lg-4">
													<div class="ibox-content">
														<form class="form-horizontal">
															<div class="form-group">
																<div class="col-sm-12">
																	<div>Select who you want this email to come from. Once you've picked a template, roll over the various text blocks in the email template to see what you can edit.</div>
																	<label class="control-label">From</label>
																	<div>
																		<select chosen placeholder-text-single="'Pick a sender (replies go here too)'" ng-model="campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMEMAIL']" ng-change="sendersChanged('textSender1')" style="height: 30px;width=100%" ng-options="x.email as x.name + ' (' + x.email + ')' for x in senders"></select>
																		<p></p>
																	</div>
																	<label class="control-label">Template</label>
																	<div>
																		<select chosen placeholder-text-single="'Pick a Template'" ng-model="campaign.templateEmail1" ng-change="SelectChanged('viewEmail1','templateEmail1')" style="width: 100%;height: 30px;" ng-options="x.content as x.title for x in templatesAs1">
																			<option value=""></option> <!-- Needs this otherwise gets funky.  Known angular issue -->
																		</select>
																		<p></p>
																	</div>
																	<label class="control-label">Hero Image</label>
																	<div>
																		<a ng-model="file" ngf-select="upload($file,'1')" href="" class="btn btn-default btn-file" data-toggle="tooltip" data-placement="top" title="Upload and replace this email's hero image."><span ng-show="state['Upload1'] == 'Uploading'"><i class="glyphicon glyphicon-refresh spinning"></i></span><i class="fa fa-cloud-upload" ng-show="state['Upload1'] != 'Uploading'"></i> Upload new image ...</a>																				
																	</div>
																	<div class="hr-line-dashed"></div>
																	<label class="control-label">Send a Test Message</label>
																	<div style="overflow: hidden; box-sizing: border-box; -webkit-box-sizing: border-box; -moz-box-sizing: border-box;"></div>
																	<div style="width:100%;height:30px;">
                                                                        <div style="width: calc(100% - 25px); float: left;">
																			<select chosen placeholder-text-single="'Pick a person'" ng-model="sendTestContactSelected" style="height: 30px;" ng-options="x[0] as x[1] + ' ' + x[2] + ' (' + x[3] + ') ' for x in sendTestContacts | orderBy:'1'">
																			<option value=""></option> <!-- Needs this otherwise gets funky.  Known angular issue -->
																			</select>
                                                                        </div>
																		<a ng-click="OpenRegister()" data-toggle="tooltip" data-placement="top" title="Add a person to your seed list. They'll show up here going forward."><i class="fa fa-plus-circle fa-2x" style="color:green;float:right;"></i></a>
																	</div>
															
																	<label class="control-label"></label>
																	<a ng-click="SendTest(1)" href="" class="btn btn-success btn-block" data-toggle="tooltip" data-placement="top" title="After you select someone from the list, press this button and I'll send you the email."><span ng-show="state['SendTest1'] == 'Sending'"><i class="glyphicon glyphicon-refresh spinning"></i></span><i class="fa fa-share-square-o" ng-show="state['SendTest1'] != 'Sending'"></i> Send</a>
																</div>
															</div> <!-- form-group -->
														</form>
													</div> <!-- ibox-content -->
												</div> <!-- col-lg-4 -->
												<div class="col-lg-8">
													<div class="ibox-content">
														<div class="window">
															<div class="titlebar">
																<div class="buttons">
																	<div class="close"></div>
																	<div class="minimize"></div>
																	<div class="zoom"></div>
																</div><small><span id="textSender1">New Email from:</span></small>
																<!-- window title -->
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
													<button class="btn btn-primary" ng-click="Save('Email2')"><i class="fa fa-floppy-o" ng-show="state['Save'] == 'Save'"></i><span ng-show="state['Save'] == 'Saving'"><i class="glyphicon glyphicon-refresh spinning"></i></span> {{state['Save']}} Email</button>
													<a
													 class="btn btn-white" data-placement="top" data-toggle="tooltip" title="Leave without saving" ng-click="Cancel()"><i class="fa fa-ban"></i> Cancel</a>
												</div>
												<h3>Subject: <a data-pk="2" data-title="Email Name" data-type="text" data-url="" href="#" id="subjectEmail2" e-style="width: 480px"></a></h3>
											</div>

											<div class="row" ng-show="openEmail2">
												<div class="col-lg-4">
													<div class="ibox-content">
														<form class="form-horizontal">
															<div class="form-group">
																<div class="col-sm-12">
																	<div>Select who you want this email to come from. Once you've picked a template, roll over the various text blocks in the email template to see what you can edit.</div>
																	<label class="control-label">From</label>
																	<div>
																		<select chosen placeholder-text-single="'Pick a sender (replies go here too)'" ng-model="campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMEMAIL']" ng-change="sendersChanged('textSender2')" style="height: 30px;" ng-options="x.email as x.name + ' (' + x.email + ')' for x in senders"></select>
																		<p></p>
																	</div>
																	<label class="control-label">Template</label>
																	<div>
																		<select chosen placeholder-text-single="'Pick a Template'" ng-model="campaign.templateEmail2" ng-change="SelectChanged('viewEmail2','templateEmail2')" style="width: 100%;height: 30px;" ng-options="x.content as x.title for x in templatesAs2">
																			<option value=""></option> <!-- Needs this otherwise gets funky.  Known angular issue -->
																		</select>
																		<p></p>
																	</div>
																	<label class="control-label">Hero Image</label>
																	<div>
																		<a ng-model="file" ngf-select="upload($file,'2')" href="" class="btn btn-default btn-file" data-toggle="tooltip" data-placement="top" title="Upload and replace this email's hero image."><span ng-show="state['Upload2'] == 'Uploading'"><i class="glyphicon glyphicon-refresh spinning"></i></span><i class="fa fa-cloud-upload" ng-show="state['Upload2'] != 'Uploading'"></i> Upload new image ...</a>																				
																	</div>
																	<div class="hr-line-dashed"></div>
																	<label class="control-label">Send a Test Message</label>
																	<div style="overflow: hidden; box-sizing: border-box; -webkit-box-sizing: border-box; -moz-box-sizing: border-box;"></div>
																	<div style="width:100%;height:30px;">
                                                                        <div style="width: calc(100% - 25px); float: left;">
																			<select chosen placeholder-text-single="'Pick a person'" ng-model="sendTestContactSelected" style="height: 30px;" ng-options="x[0] as x[1] + ' ' + x[2] + ' (' + x[3] + ') ' for x in sendTestContacts | orderBy:'1'">
																			<option value=""></option> <!-- Needs this otherwise gets funky.  Known angular issue -->
																			</select>
                                                                        </div>
																		<a ng-click="OpenRegister()" data-toggle="tooltip" data-placement="top" title="Add a person to your seed list. They'll show up here going forward.orward."><i class="fa fa-plus-circle fa-2x" style="color:green;float:right;"></i></a>
																	</div>
															
																	<label class="control-label"></label>
																	<a ng-click="SendTest(2)" href="" class="btn btn-success btn-block" data-toggle="tooltip" data-placement="top" title="After you select someone from the list, press this button and I'll send you the email."><span ng-show="state['SendTest2'] == 'Sending'"><i class="glyphicon glyphicon-refresh spinning"></i></span><i class="fa fa-share-square-o" ng-show="state['SendTest2'] != 'Sending'"></i> Send</a>
																</div>
															</div> <!-- form-group -->
														</form>
													</div> <!-- ibox-content -->
												</div> <!-- col-lg-4 -->
												<div class="col-lg-8">
													<div class="ibox-content">
														<div class="window">
															<div class="titlebar">
																<div class="buttons">
																	<div class="close"></div>
																	<div class="minimize"></div>
																	<div class="zoom"></div>
																</div><small><span id="textSender2">New Email from:</span></small>
																<!-- window title -->
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
    <script src="js/editPromoteBlog_step2.js"></script>