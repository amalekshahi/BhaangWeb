<?php
    date_default_timezone_set('UTC');
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');    
    $dbName = $_SESSION['DBNAME'];
	$accountID = $_SESSION['ACCOUNTID'];
    $accountName = $_SESSION['ACCOUNNAME'];
	$gates = $_SESSION['GATES'];
?>
	<!DOCTYPE html>
	<html ng-app="myApp">

	<head>
		<?php include "header.php"; ?>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/angularjs-color-picker/3.4.8/angularjs-color-picker.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/angularjs-color-picker/3.4.8/themes/angularjs-color-picker-bootstrap.css" rel="stylesheet">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tinycolor/1.4.1/tinycolor.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/angularjs-color-picker/3.4.8/angularjs-color-picker.js"></script>
	</head>

	<body class="fixed-sidebar">
		<script>
			//Kwang create myAPP here so all step can access it.
			var dbName = "<?php echo $dbName; ?>";
			var accountID = "<?php echo $accountID; ?>";
			var myApp = angular.module('myApp', ['ngFileUpload', 'davinci', 'localytics.directives','color.picker']);
		</script>
		<div id="wrapper">
			<!-- left wrapper -->
			<?php include 'leftWrapper.php'; ?>
			<!-- /end left wrapper -->
			<div id="page-wrapper" class="gray-bg">
				<div class="row border-bottom">
					<nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
						<!-- top wrapper -->
						<?php include 'topWrapper.php'; ?>
						<!-- / top wrapper -->
					</nav>
				</div>
				<!-- content -->
				<div ng-controller="myCtrl">
					<div class="widget style1 navy-bg">
						<div class="row">
							<div class="col-xs-4">
								<i class="fa fa-wrench fa-5x"></i>
							</div>
							<div class="col-xs-8 text-right">
								<span> Manage options for <?php echo $accountName;?> and <?php echo $USERNAME;?> </span>
								<h2 class="font-bold">Settings</h2>
							</div>
						</div>
					</div>
					<div class="row">
						<form name="myForm" method="post" class="form-horizontal">
							<div class="col-lg-12">
								<div class="ibox float-e-margins">
									<div class="tabs-container">
										<div class="tabs-left">
											<ul class="nav nav-tabs">
												<li class="active">
													<a data-toggle="tab" href="#tab-your-company"><i class="fa fa-building" aria-hidden="true"></i> <?php echo $accountName;?> Global Settings</a>
												</li>
												<li class="">
													<a data-toggle="tab" href="#tab-users"><i class="fa fa-user-o" aria-hidden="true"></i> <?php echo $accountName;?> Users </a>
												</li>
												<li class="">
													<a data-toggle="tab" href="#tab-you"><i class="fa fa-user-o" aria-hidden="true"></i> <?php echo $USERNAME;?> Preferences </a>
												</li>
												<li class="">
													<a data-toggle="tab" href="#tab-3rd-party-products"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Integrations</a>
												</li>
												<li class="">
													<a data-toggle="tab" href="#tab-billing"><i class="fa fa-credit-card" aria-hidden="true"></i> Plans & Billing</a>
												</li>
											</ul>
											<div class="tab-content">
												<form role="form">
													<div class="tab-pane" id="tab-users">
														<div class="panel-body">
															<h2><i class="fa fa-user" aria-hidden="true"></i> Users at <?php echo $accountName;?></h2>
															<fieldset class="form-horizontal">
															
																	
																				<div class="ibox-tools">
																					<!-- <a href="" class="btn btn-primary btn-sm">+ Add User</a> -->
																					<button class="btn btn-primary btn-sm" ng-click="AddUser()">+ Add a User</button>
																					<!-- <button class="btn btn-primary" ng-click="EditUser(item)">Edit</button>
																					<button class="btn btn-primary" ng-click="DeleteUser(item)">Delete</button> -->																																	
																				</div>
																			<div id="senderData" ng-show="state['senderData'] == 'true'">
																				<input type="hidden" id="senderID" name="senderID">
																				<fieldset class="form-horizontal">														
																					<div class="form-group">
																						<label class="col-sm-4 control-label">Name<br><small class="text-muted">Used for internal purposes only.  You'll only see this name inside Da Vinci.</small></label>
																						<div class="col-sm-8"><input type="text" class="form-control" placeholder="Leo Da Vinci" id="senderName" name="senderName"></div>
																					</div>
																					<div class="form-group">
																						<label class="col-sm-4 control-label">Email<br><small class="text-muted">Used as the from and reply-to address for emails, as well as alerts and notifications.</small></label>
																						<div class="col-sm-8"><input type="text" class="form-control" placeholder="leo@davinci.com" id="senderEmail" name="senderEmail"></div>
																					</div>
																					<div class="form-group">
																						<label class="col-sm-4 control-label">Official Name (Used for Emails)<br><small class="text-muted">Appears as the from name in emails and other communication initiated by Da Vinci.</small></label>
																						<div class="col-sm-8"><input type="text" class="form-control" placeholder="Leonardo di ser Piero da Vinci" id="senderOfficialName" name="senderOfficialName"></div>
																					</div>
																					<div class="form-group">
																						<label class="col-sm-4 control-label">Cell<br><small class="text-muted">Used to receive alerts and notifications.</small></label>
																						<div class="col-sm-8"><input type="text" class="form-control" placeholder="949-375-4459" id="senderCell" name="senderCell"></div>
																					</div>
																					<div class="form-group">
																						<label class="col-sm-4 control-label">Permissions<br><small class="text-muted">Control what this User can do within Da Vinci.</small></label>
																						<div class="col-sm-8"><input type="text" class="form-control" placeholder="God User" id="senderPermissions" name="senderPermissions">
																						<div class="hr-line-dashed"></div>
																						<button class="btn btn-primary" ng-click="SetSender()"><i class="fa fa-floppy-o" ng-show="state['SaveUser'] == 'Save'"></i><span ng-show="state['SaveUser'] == 'Saving'"><i class="glyphicon glyphicon-refresh spinning"></i></span> {{state['SaveUser']}} </button>
																						<button class="btn btn-primary" ng-click="HideSender()">Cancel</button>
																						</div>
																					</div>
																				</fieldset>
																			</div>
																			<div class="ibox-content">
																				<table datatable="ng" dt-options="dtOptions" class="table table-striped table-bordered table-hover dataTables-example">
																					<thead>
																						<tr>																			
																							<th>Name</th>
																							<th>Email</th>
																							<th>Official Name (Used in Emails)</th>
																							<th>Cell Phone (For SMS Alerts)</th>
																							<th>Permissions</th>	
																							<th></th>
																						</tr>
																					</thead>
																					<tbody>
																						<tr ng-repeat="item in senders | orderBy:'name'" ng-cloak>						
																							<td class="project-title">{{item.name}}</td>
																							<td class="project-title">{{item.email}}</td>
																							<td class="project-title">{{item.OfficialName}}</td>
																							<td class="project-title">{{item.Cell}}</td>
																							<td class="project-title">{{item.Permissions}}</td>		
																							<td>
																								<div class="btn-group">
																									<button type="button" class="btn btn-default btn-xs" ng-click="EditUser(item);"><i class="glyphicon glyphicon-pencil"></i> Edit</button>
																									<button type="button" class="btn btn-default btn-xs" ng-click="DeleteUser(item);"><i class="glyphicon glyphicon-trash"></i> Delete</button>
																								</div>
																							</td>
																						</tr>
																					</tbody>
																				</table>
																			</div>																			
																	
																
															</fieldset>
													</form>
												</div>
												</div>
												<div class="tab-pane active" id="tab-your-company">
													<div class="panel-body">
														<fieldset class="form-horizontal">
														<h2>Company Global Settings</h2>
															<div class="form-group"><label class="col-sm-4 control-label">Official Name <br><small class="text-muted">This is how your company will be referenced in all communications, including email, landing pages, and Social.</small></label>
																<div class="col-sm-8"><br><input type="text" class="form-control" placeholder="Company Name" name="defCompanyName" ng-model="userinfo.defCompanyName">
																	<span class="help-block m-b-none"></span> </div>
															</div>
															<div class="form-group"><label class="col-sm-4 control-label">Address <br><small class="text-muted">This address is used when displaying your company's contact information.</small></label>
																<div class="col-sm-8"><br>
																	<input type="text" class="form-control" placeholder="Company Address" name="defCompanyAddress" ng-model="userinfo.defCompanyAddress">
																	<span class="help-block m-b-none"></span> </div>
															</div>
															<div class="form-group"><label class="col-sm-4 control-label">Phone # <br><small class="text-muted">This address is used when displaying your company's phone number.  Make sure someone answers!</small></label>
																<div class="col-sm-8"><br>
																	<input type="text" class="form-control" placeholder="Company Phone" name="defCompanyPhone" ng-model="userinfo.defCompanyPhone">
																	<span class="help-block m-b-none"></span> </div>
															</div>
															<div class="form-group"><label class="col-sm-4 control-label">Logo <br><small class="text-muted">This logo is used in all communications, including emails, landing pages, Social, and more.</small></label>
																<div class="col-sm-8"><br>
																	<a ng-model="file" ngf-select="upload($file,'defCompanyLogo')" href="" style="vertical-align: top;" class="btn btn-default btn-file" data-toggle="tooltip" data-placement="top" title="I'll upload and replace image of this email "><span ng-show="state['Upload-defCompanyLogo'] == 'Uploading'"><i class="glyphicon glyphicon-refresh spinning"></i></span><i class="fa fa-cloud-upload" ng-show="state['Upload-defCompanyLogo'] != 'Uploading'"></i> Change Logo ...</a>
																	<img ng-src="{{srcCompanyLogo}}" width="180px" border="0" alt="logo">
																	<span class="help-block m-b-none"></span> </div>
															</div>
															<div class="form-group"><label class="col-sm-4 control-label">Your Organization's Timezone <br><small class="text-muted">This timezone is used for your scheduled communications, like emails.  Changing this impacts all Users of your organization.</small></label>
																<div class="col-sm-8"> <br><select ng-disabled="disabledEmail['1']" class="form-control" id="EMAIL1-SCHEDULE1-TIMEZONE" name="EMAIL1-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL1-SCHEDULE1-TIMEZONE']" ng-change="dateChange('')" required="" style="width: 150px">
																	<option value="Pacific Standard Time" >Pacific Time</option> 
																	<option value="Mountain Standard Time">Mountain Time</option> 
																	<option value="Central America Standard Time">Central Time</option> 
																	<option value="Eastern Standard Time">Eastern Time</option>
																</select>
																	<span class="help-block m-b-none"></span>
																</div>
															</div>
															<div class="hr-line-dashed"></div>
															<h2>Global Email Settings</h2>
															<div class="form-group"><label class="col-sm-4 control-label">Email Protection <br><small class="text-muted">This is a global setting that protects you from sending more emails that appropriate to your database.</small></label>
																<div class="col-sm-8"><br>Allow no more than <select required="">
																	<option value="1" >1</option> 
																	<option value="2">2</option> 
																</select> emails sent to each person per <select required="">
																	<option value="hour" >hour</option> 
																	<option value="day">day</option> 
																	<option value="week">week</option> 
																	<option value="month">month</option> 
																</select></div>
															</div>
															<div class="form-group"><label class="col-sm-4 control-label">Unsubscribe Link <br><small class="text-muted">This is used for your call-to-action buttons in emails and landing pages.</small></label>
																<div class="col-sm-8"><br><input type="text" class="form-control" placeholder="http://domain/unsubscribe" name="defUnsubscribe" ng-model="userinfo.defUnsubscribe">
																	<span class="help-block m-b-none"></span> </div>
															</div>
															<div class="form-group"><label class="col-sm-4 control-label">"View This Message Online" Text <br><small class="text-muted">This is used for your call-to-action buttons in emails and landing pages.</small></label>
																<div class="col-sm-8"><br>
																	<input type="text" class="form-control" placeholder="View online message" name="defViewOnline" ng-model="userinfo.defViewOnline">
																	<span class="help-block m-b-none"></span> </div>
															</div>
															<div class="hr-line-dashed"></div>
															<h2>Grading & Scoring</h2>
															<p>To measure the value of the people interacting with your marketing programs, I've set up the following for you. Feel free to change.</p>
															<div class="form-group form-inline">
																<div class="col-sm-8">
																<label for="opens"><i aria-hidden="true" class="fa fa-envelope-open-o"></i>&nbsp;</label>
																	<input class="touchspin-points form-control input-sm" id="opens" type="text" value="0" name="opens" style="width:50px; text-align: center"> points when people <strong>open</strong> any of my emails for the first time.</small>
																	<p></p>
																	<label for="clicks"><i aria-hidden="true" class="fa fa-mouse-pointer"></i>&nbsp;&nbsp;</label>
																	<input class="touchspin-points form-control input-sm" id="opens" type="text" value="5" name="opens" style="width:50px; text-align: center"> points when people <strong>click</strong> any of my email CTAs for the first time.</small>
																	<p></p>
																	<label for="download"><i aria-hidden="true" class="fa fa-download"></i>&nbsp;</label>
																	<input class="touchspin-points form-control input-sm" id="downloads" type="text" value="5" name="opens" style="width:50px; text-align: center"> points when people <strong>download</strong> any of my eBooks or other assets for the first time.</small>
																	
																</div>
															</div>
														</fieldset>
													</div>
												</div>
												<div class="tab-pane" id="tab-you">
													<div class="panel-body">
														<h2>Your Preferences</h2>
													</div>
												</div>
												<div class="tab-pane" id="tab-3rd-party-products">
													<div class="panel-body">
														<h2><i class="fa fa-google" aria-hidden="true" style="color:red"></i> Google</h2>
														<fieldset class="form-horizontal">
															<div class="form-group">
																<label class="col-sm-4 control-label"> Google Analytics Tracking Code<br><small class="text-muted">Google Analytics helps you track visitors to your campaigns, and generates reports that help you with your marketing.</small></label>
																<div class="col-sm-8"><br><input type="text" class="form-control" placeholder="Paste your Google ID here, like: UA-83447148-1" name="google_tracking_code" ng-model="userinfo.GoogleAccessToken">
																	<span class="help-block m-b-none"><a href="https://support.google.com/analytics/answer/1008080?hl=en" target="_blank">Where to find your Google Analytics Tracking ID</a>.</span>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-4 control-label">Google Tag Manager ID<br><small class="text-muted">Google Tag Manager helps make tag management simple, easy and reliable by allowing marketers and webmasters to deploy website tags all in one place.</small></label>
																<div class="col-sm-8"><br><input type="text" class="form-control" id="" placeholder="Paste your Google ID here, like: GTM-XXXX" name="google_tag_manager_snippet" ng-model="userinfo.GoogleTagManager">
																	<span class="help-block m-b-none"><a href="https://support.google.com/tagmanager/answer/6103696?hl=en#install" target="_blank">Where to find your Google Tag Manager ID</a>.</span>
																</div>
															</div>
															<div class="hr-line-dashed"></div>
															<h2><i class="fa fa-facebook-official" aria-hidden="true" style="color:blue"></i> Facebook</h2>
															<div class="form-group">
																<label class="col-sm-4 control-label">Facebook Pixel ID<br><small class="text-muted">The Facebook Pixel enables you to create Facebook ad campaigns that find new prospects and engages existing Clients.</small></label>
																<div class="col-sm-8"><br><input type="text" class="form-control" placeholder="Paste your Facebook Pixel ID here, like: 120261521652622" name="facebook_pixel_id" ng-model="userinfo.FaceBookAccessToken">
																	<span class="help-block m-b-none"><a href="https://www.facebook.com/business/help/952192354843755" target="_blank">Where to find your Facebook Pixel ID</a>.</span>
																</div>
															</div>
													</div>
												</div>
												<div class="tab-pane" id="tab-tracking-code">
													<div class="panel-body">
														<p>To track interactions on your website, add the javascript snippet below. Copy and paste the code snippet before the </body> tag on every page where you want to track interactions.</p>
														<p><label>MindFire Tracking Code</label></p>
														<p><code>http://hc.studioqa.com/html/test.js?dom=TestingDummyCookie&track=true</code></p>
														<p>&nbsp;</p>
														<input name="action" type="hidden" value="saveProfileSettings"> <button class="btn btn-primary" type="submit">Save</button> <button class="btn btn-white" type="submit">Cancel</button>
													</div>
												</div>
											<div class="tab-pane" id="tab-grading-and-scoring">
		<div class="panel-body">
			<h2>Grading & Scoring</h2>
			<p>To measure the value of the people interacting with your marketing programs, I've set up the following for you. Feel free to change.</p>
			<form role="form">
				<div class="form-group form-inline">
					<label for="opens"><i aria-hidden="true" class="fa fa-envelope-open-o"></i>&nbsp;</label>
					<input class="touchspin-points form-control input-sm" id="opens" type="text" value="0" name="opens" style="width:50px; text-align: center"> points when people <strong>open</strong> any of my emails for the first time.</small>
					<p></p>
					<label for="clicks"><i aria-hidden="true" class="fa fa-mouse-pointer"></i>&nbsp;&nbsp;</label>
					<input class="touchspin-points form-control input-sm" id="opens" type="text" value="5" name="opens" style="width:50px; text-align: center"> points when people <strong>click</strong> any of my email CTAs for the first time.</small>
					<p></p>
					<label for="download"><i aria-hidden="true" class="fa fa-download"></i>&nbsp;</label>
					<input class="touchspin-points form-control input-sm" id="downloads" type="text" value="5" name="opens" style="width:50px; text-align: center"> points when people <strong>download</strong> any of my eBooks or other assets for the first time.</small>

				</div>

			</form>

			<input name="action" type="hidden" value="saveProfileSettings"> <button class="btn btn-primary" type="submit">Save</button> <button class="btn btn-white" type="submit">Cancel</button>
		</div>
	</div>
											<div class="tab-pane" id="tab-billing">
		<div class="panel-body">
			<fieldset class="form-horizontal">
			<h2>Plans & Billing</h2>
			<p><strong>Questions about plans and pricing?</strong></p>
			<p>The MindFire Da Vinci team is available to answer your questions. <a href="helpCenter.php" target="_blank">Get help here</a>.</p> 
			<p>MindFire also offers enterprise-grade service packages for high volume marketers.  Contact our Customer Success team for a no obligations consultation or demo.</p>
			<h2>Payment Info</h2>
			<div class="row">
						<div class="col-sm-4">
							<div class="ibox float-e-margins">
								<div class="ibox-title">
									<h5>Next Billing</h5>
									<div ibox-tools></div>
								</div>
								<div class="ibox-content">
									<ul class="list-group">
										<li class="list-group-item">
											<span class="badge badge-primary">&nbsp;DATE&nbsp;</span> November 8th, 2017
										</li>
										<li class="list-group-item ">
											<span class="badge badge-warning">&nbsp;AMOUNT DUE&nbsp;</span> $495.00
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="ibox float-e-margins">
								<div class="ibox-title">
									<h5>Payment Details</h5>

									<div ibox-tools></div>
								</div>
								<div class="ibox-content">
									<ul class="list-group">
										<li class="list-group-item">
											<span class="badge badge-primary">&nbsp;CREDIT CARD&nbsp;</span> xxxx xxxx xxxx 8405
										</li>
										<li class="list-group-item ">
											<button type="button" class="btn btn-default btn-xs">CHANGE PAYMENT METHOD</button>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="ibox float-e-margins">
								<div class="ibox-title">
									<h5>Information</h5>
									<span class="pull-right">
										<div ibox-tools></div>
								</div>
								<div class="ibox-content">
									<p>Invoices</p>
									<p>Change invoice details</p>
									<p>Change billing notifications</p>
									<p>Contact us about your bill</p>
								</div>
							</div>
						</div>							
			</div>
			<h2>Your Account & Sub-Accounts</h2>
				<hr/>
			<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-4">
                <div class="contact-box center-version">
                    <a href="#">
                        <img alt="image" class="img-circle" src="http://www.pngall.com/wp-content/uploads/2016/05/Coming-Soon-Free-Download-PNG.png">
                        <h3 class="m-b-xs"><strong><?php echo $accountName;?></strong></h3>
                        <div class="font-bold">Added 4/14/2013</div>
                        <div class="font-bold">$150 p/mo</div>
											<hr/>
											<span><strong>Details:</strong><br>Unlimited Emails<br>1,000 Contacts</span>
                    </a>
                    <div class="contact-box-footer">
                        <div class="m-t-xs btn-group">
                            <a class="btn btn-xs btn-white"> Edit</a>
                        </div>
                    </div>
                </div>
            </div>
					<div class="col-lg-4">
                <div class="contact-box center-version">
                    <a href="#">
                        <img alt="image" class="img-circle" src="http://www.dbq.edu/media/Calendar/UD-logo-combined-3_web.jpg">
                        <h3 class="m-b-xs"><strong>University of Dubuque</strong></h3>
                        <div class="font-bold">Added 1/23/2015</div>
                        <div class="font-bold">$150 p/mo</div>
											<hr/>
											<span><strong>Details:</strong><br>Unlimited Emails<br>1,000 Contacts</span>
                    </a>
                    <div class="contact-box-footer">
                        <div class="m-t-xs btn-group">
                            <a class="btn btn-xs btn-white"> Edit</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-box center-version">
                    <a href="#">
                        <img alt="image" class="img-circle" src="http://www.arc.losrios.edu/Images/Images-arc/Support_Services/TransferCenter/CSU%20Logos/CSULong-Beach-Logo.jpg">
                        <h3 class="m-b-xs"><strong>Cal State Longbeach</strong></h3>
                        <div class="font-bold">Added 7/3/2015</div>
                        <div class="font-bold">$450 p/mo</div>
											<hr/>
											<span><strong>Details:</strong><br>Unlimited Emails<br>10,000 Contacts</span>
                    </a>
                    <div class="contact-box-footer">
                        <div class="m-t-xs btn-group">
                            <a class="btn btn-xs btn-white"> Edit</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-box center-version">
                    <a href="#">
                        <img alt="image" class="img-circle" src="https://brand.uiowa.edu/sites/brand.uiowa.edu/files/color-ffcd00_on_black.png">
                        <h3 class="m-b-xs"><strong>University of Iowa</strong></h3>
                        <div class="font-bold">Added 3/14/2015</div>
                        <div class="font-bold">$350 p/mo</div>
											<hr/>
											<span><strong>Details:</strong><br>Unlimited Emails<br>5,000 Contacts</span>
                    </a>
                    <div class="contact-box-footer">
                        <div class="m-t-xs btn-group">
                            <a class="btn btn-xs btn-white"> Edit</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-box center-version">
                    <a href="#">
                        <img alt="image" class="img-circle" src="https://upload.wikimedia.org/wikipedia/en/thumb/3/3a/Harvard_Wreath_Logo_1.svg/1200px-Harvard_Wreath_Logo_1.svg.pngg">
                        <h3 class="m-b-xs"><strong>Harvard</strong></h3>
                        <div class="font-bold">Added 1/23/2015</div>
                        <div class="font-bold">$150 p/mo</div>
											<hr/>
											<span><strong>Details:</strong><br>Unlimited Emails<br>1,000 Contacts</span>
                    </a>
                    <div class="contact-box-footer">
                        <div class="m-t-xs btn-group">
                            <a class="btn btn-xs btn-white"> Edit</a>
                        </div>
                    </div>
                </div>
            </div>
            


        </div>
        </div>	
				</fieldset>
				</div>
			</div>
		</div>
	</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
	<!-- myCtrl -->
	<!--/ content -->
	<div class="footer">
		<?php include 'footer.php'; ?>
	</div>
	</div>
	<!--  end page-wrapper -->
	</div>

	<!-- Mainly scripts -->
	<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
	<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

	<!-- Custom and plugin javascript -->
	<script src="js/inspinia.js"></script>
	<script src="js/plugins/pace/pace.min.js"></script>
	<script src="js/davinci.js"></script>

	<script>
		var dbname = "<?php echo $dbName; ?>";
		var accountID = "<?php echo $accountID; ?>";
		var studioEmail = "<?php echo $email; ?>";
		var studioPassword = "<?php echo $pwd; ?>";
	</script>
	<script src="js/accountSetting.js"></script>

	</body>

	</html>