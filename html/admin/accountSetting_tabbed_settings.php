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
					<!--<div class="row wrapper border-bottom white-bg page-heading" >
						<div class="col-lg-10">
							<h2>Settings for <?php echo $accountName;?> and <?php echo $USERNAME;?></h2>
							
							<ol class="breadcrumb">
								<li><a href="welcome.html">Home</a></li>
								<li><strong><a>Settings</a></strong></li>                    
							</ol>
						</div>
						<div class="col-lg-2"></div>
					</div>-->
					<!--<div class="row">
							<div class="col-lg-12">
								<div class="ibox float-e-margins">
									<div class="ibox-title">
										<h5>Let's get to know each other. <small>A few simple questions from a complex man.</small></h5>
										<div class="ibox-tools">								
											<?php if ($gates['tabbed_settings'] == "TRUE") { echo "<a class='btn btn-white btn-bitbucket btn-xs' href='accountSetting_tabbed_settings.php'><i class='fa fa-flag' aria-hidden='true' style='color:red'></i> Switch to the New Layout</a>"; }?>
											<a class="collapse-link">
												<i class="fa fa-chevron-up"></i>
											</a>
												<!-- <ul class="dropdown-menu dropdown-user">
												<li><a href="#">Config option 1</a>
												</li>
												<li><a href="#">Config option 2</a>
												</li>
											</ul> 
											<a class="close-link">
												<i class="fa fa-times"></i>
											</a>
										</div>
									</div>
									<div class="ibox-content">
											<form name="myForm" method="post" class="form-horizontal">
												<div><h2>Studio Credentials</h2></div>
												<div class="form-group"><label class="col-sm-2 control-label">Studio Username</label>
													<div class="col-sm-10">									
													
													<input type="text" class="form-control" placeholder="you@something.com" name="studio_username" ng-model="studioEmail" readonly>
													<!-- <input type="text" ng-model="userinfo.username"> 
													<span class="help-block m-b-none">Your studio username.</span></div>
												</div>
												<div class="form-group"><label class="col-sm-2 control-label">Studio Password</label>
													<div class="col-sm-10">									
													
													<input type="password" class="form-control" placeholder="You want some cool stuff?" name="studio_password"  ng-model="studioPassword" readonly>
													<span class="help-block m-b-none">Shhh.  I won't tell anyone.</span>
													</div>
												</div>
												<div class="hr-line-dashed"></div>


												<div><h2>3rd Party Applications</h2></div>
												<div class="form-group"><label class="col-sm-2 control-label">Google Analytics Tracking Code</label>
													<div class="col-sm-10">
													
													<input type="text" class="form-control" placeholder="UA-83447148-1" name="google_tracking_code" ng-model="userinfo.GoogleAccessToken">
													<span class="help-block m-b-none">Find your tracking ID and tracking code snippet.</span></div>
												</div>

												
												<div class="form-group"><label class="col-sm-2 control-label">Facebook Pixel ID</label>
													<div class="col-sm-10">
													
													<input type="text" class="form-control" placeholder="120261521652622" name="facebook_pixel_id" ng-model="userinfo.FaceBookAccessToken">
													<span class="help-block m-b-none">Shhh.  I won't tell anyone.</span>
													</div>
												</div>

												<div class="hr-line-dashed"></div>                                
												<div><h2>Marketing Settings</h2></div>
												
												
												<div class="form-group"><label class="col-sm-2 control-label">From Email</label>
													<div class="col-sm-10">
													<input type="text" class="form-control" placeholder="you@something.com" name="defFromAdd" ng-model="userinfo.defFromAdd">
													<span class="help-block m-b-none">The email you're sending from (and to which people will reply).</span></div>
												</div>
											   
												
												<div class="form-group"><label class="col-sm-2 control-label">From Email Name</label>
													<div class="col-sm-10">
													<input type="text" class="form-control" placeholder="Bill Gates" name="defFromName" ng-model="userinfo.defFromName">
													<span class="help-block m-b-none">What do they call you?</span>
													</div>
												</div>

												<div class="form-group"><label class="col-sm-2 control-label">Unsubscribe Link</label>
													<div class="col-sm-10">
													<input type="text" class="form-control" placeholder="http://domain/unsubscribe" name="defUnsubscribe" ng-model="userinfo.defUnsubscribe">
													<span class="help-block m-b-none">How to unsubscribe?</span>
													</div>
												</div>

												<div class="form-group"><label class="col-sm-2 control-label">View Online Message</label>
													<div class="col-sm-10">
													<input type="text" class="form-control" placeholder="View online message" name="defViewOnline" ng-model="userinfo.defViewOnline">
													<span class="help-block m-b-none">View online message to show in the emails.</span>
													</div>
												</div>

												<div class="form-group"><label class="col-sm-2 control-label">Company Name</label>
													<div class="col-sm-10">
													<input type="text" class="form-control" placeholder="Company Name" name="defCompanyName" ng-model="userinfo.defCompanyName">
													<span class="help-block m-b-none">Company Name</span>
													</div>
												</div>

												<div class="form-group"><label class="col-sm-2 control-label">Company Address</label>
													<div class="col-sm-10">
													<input type="text" class="form-control" placeholder="Company Address" name="defCompanyAddress" ng-model="userinfo.defCompanyAddress">
													<span class="help-block m-b-none">Company Address</span>
													</div>
												</div>

												<div class="form-group"><label class="col-sm-2 control-label">Company Phone</label>
													<div class="col-sm-10">
													<input type="text" class="form-control" placeholder="Company Phone" name="defCompanyPhone" ng-model="userinfo.defCompanyPhone">
													<span class="help-block m-b-none">Company Phone</span>
													</div>
												</div>

												<div class="form-group"><label class="col-sm-2 control-label">Company Logo</label>
													<div class="col-sm-10">
														<a ng-model="file" ngf-select="upload($file,'defCompanyLogo')" href="" style="vertical-align: top;" class="btn btn-default btn-file" data-toggle="tooltip" data-placement="top" title="I'll upload and replace image of this email "><span ng-show="state['Upload-defCompanyLogo'] == 'Uploading'"><i class="glyphicon glyphicon-refresh spinning"></i></span><i class="fa fa-cloud-upload" ng-show="state['Upload-defCompanyLogo'] != 'Uploading'"></i> Upload image ...</a>
														<img ng-src="{{srcCompanyLogo}}" width="180px" border="0" alt="logo">
													</div>
												</div>

												<div class="hr-line-dashed"></div>            
												
												<div class="form-group">
													<div class="col-sm-4 col-sm-offset-2">
														<input type="hidden" name="action" value="saveProfileSettings">
														<button ng-disabled="myForm.$pristine" class="btn btn-primary" ng-click="Save()" ><i class="fa fa-floppy-o" ng-show="state['SaveAccountSetting'] == 'Save'"></i><span ng-show="state['SaveAccountSetting'] == 'Saving'"><i class="glyphicon glyphicon-refresh spinning"></i></span> {{state['SaveAccountSetting']}}</button>
														<button ng-disabled="myForm.$pristine" class="btn btn-white" ng-click="Cancel()"><i class="fa fa-ban"></i> Cancel</button>
													</div>
												</div>
												<div ng-show="saveSuccess && myForm.$pristine"  ng-cloak>
													<div class="alert alert-success">
													<strong> Success! </strong> Save success.
													</div>
												</div>
											</form>
									</div>
								</div>
							</div>						
						</div>-->
					<!-- row -->
				
				<div class="row">
		<form action="dv.php?page=myProfileSettings&action=submit" class="form-horizontal" method="post">
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
								<!--
								<li class="">
									<a data-toggle="tab" href="#tab-tracking-code">Tracking Code</a>
								</li>
-->
								<!--
								<li class="">
									<a data-toggle="tab" href="#tab-5">Sender Addresses</a>
								</li>-->
								<li class="">
									<a data-toggle="tab" href="#tab-3rd-party-products"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Integrations</a>
								</li>
								<!--
								<li class="">
									<a data-toggle="tab" href="#tab-grading-and-scoring">Grading & Scoring</a>
								</li>
-->
								<li class="">
									<a data-toggle="tab" href="#tab-billing"><i class="fa fa-credit-card" aria-hidden="true"></i> Billing</a>
								</li>								
							</ul>
												
							<div class="tab-content">
								<form role="form">
																	<div class="tab-pane" id="tab-users">
																			<div class="panel-body">
										
									<h2>Users</h2>
										<fieldset class="form-horizontal">
      <div class="row">
						<div class="col-lg-12">
							<div class="ibox float-e-margins">
								<div class="ibox-title">
									<div class="ibox-tools">
											<a href="editContact.php?cid=new#!new" class="btn btn-primary btn-sm">+ Add User</a>
									</div>
								</div>
								<div class="ibox-content">
									<table datatable="ng" dt-options="dtOptions" class="table table-striped table-bordered table-hover dataTables-example">
										<thead>
											<tr>
												<th>Name</th>
												<th>Email</th>
												<th>Cell Phone</th>
												<th>Permissions</th>
											</tr>
										</thead>
										<tbody>
											<tr ng-repeat="item in audience.items | orderBy:'-lastEditDate'" ng-cloak>
												<td class="project-title"><a target="_blank" href="showContact.php?cid={{item.contactID}}">{{item['LIST-NAME']}}</a><br><small>{{item['LIST-DESCRIPTION']}}</small></td>
												<td class="project-title"><a target="_blank" href="showContact.php?cid={{item.contactID}}" ng-if="item['LIST-COUNT']>0"><i class="fa fa-users" ng-if="item['LIST-COUNT']>1" style="color:green"></i><i class="fa fa-user" ng-if="item['LIST-COUNT']==1"></i>
 
													
													<ng-pluralize count="item['LIST-COUNT']" 
																				when=	"{'0': 'No one.  How lonely!',
 													              	    	'one': 'See this 1 person',
                       													'other': 'See these {} people'}">
											  	</ng-pluralize>
													</a>
													<span ng-if="item['LIST-COUNT']==0"><small>No Contacts meet this Segment Definition</small></span>
												</td>
											<td>
											<a href="editContact.php?cid={{item.contactID}}" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit User</a>	
											</td>	
											</tr>
										</tbody>
									</table>
									</div>
								</div>
							</div>
						</div>
																				</fieldset>
																			</form>

										</div>
									</div>
	
								<div class="tab-pane active" id="tab-your-company">
									<!--<div class="panel-body">
									 
										<h2>Company Contact Information</h2>
									    <p>This information is used in all your Emails and Landing Pages.</p>
										<p><label>Company Name</label><input class="form-control" name="COMPANY-NAME" placeholder="Big Shiz Inc" type="text" value="{{COMPANY-NAME}}"><small>Your company's name. Appears many places, including emails and landing pages.</small></p>
										<p><label>Address Street</label><input class="form-control" name="ADDRESS-STREET" placeholder="123 West Road" type="text" value="{{ADDRESS-STREET}}"><small>Your company's street address.</small></p>
										<p><label>City</label><input class="form-control" name="ADDRESS-CITY" placeholder="Costa Mesa" type="text" value="{{ADDRESS-CITY}}"></p>
										<p><label>State</label><input class="form-control" name="ADDRESS-STATE" placeholder="CA" type="text" value="{{ADDRESS-STATE}}"></p>
										<p><label>Zip</label><input class="form-control" name="ADDRESS-ZIP" placeholder="92626" type="text" value="{{ADDRESS-ZIP}}"></p>
										<h2>Company Brand Settings</h2>
									    <p>This information is also used in all your Emails and Landing Pages.</p>
										<p><label>Company Logo</label><input class="form-control" name="LOGO" placeholder="http://www.yahoo.com/logo.gif" type="text" value="{{LOGO}}"><small>URL to your logo. Later we'll let you upload this.</small></p>
									    <p><label>Button Color</label><input class="form-control" name="ADDRESS-ZIP" placeholder="92626" type="text" value="{{ADDRESS-ZIP}}"></p>
									    <p><label>Font</label><input class="form-control" name="ADDRESS-ZIP" placeholder="92626" type="text" value="{{ADDRESS-ZIP}}"></p>
									    <p><label>Tag Line</label><input class="form-control" name="ADDRESS-ZIP" placeholder="92626" type="text" value="{{ADDRESS-ZIP}}"></p>
									    <p><label>Blog URL</label><input class="form-control" name="ADDRESS-ZIP" placeholder="92626" type="text" value="{{ADDRESS-ZIP}}"></p>
									    <p><label>Twitter Handle</label><input class="form-control" name="ADDRESS-ZIP" placeholder="92626" type="text" value="{{ADDRESS-ZIP}}"></p>
									    <p><label>Facebook Page</label><input class="form-control" name="ADDRESS-ZIP" placeholder="92626" type="text" value="{{ADDRESS-ZIP}}"></p>
									    <p><label>LinkedIn Page</label><input class="form-control" name="ADDRESS-ZIP" placeholder="92626" type="text" value="{{ADDRESS-ZIP}}"></p>
									    <p><label>Privacy Policy Link</label><input class="form-control" name="ADDRESS-ZIP" placeholder="92626" type="text" value="{{ADDRESS-ZIP}}"></p>
									    
									    <p>&nbsp;</p>
									<input name="action" type="hidden" value="saveProfileSettings"> <button class="btn btn-primary" type="submit">Save</button> <button class="btn btn-white" type="submit">Cancel</button>
									
									</div>-->
									<div class="panel-body">
										
									<h2>Global Settings</h2>
										<fieldset class="form-horizontal">
                                            <div class="form-group"><label class="col-sm-2 control-label">Your Organization's Timezone:</label>
                                                <div class="col-sm-10">																<select ng-disabled="disabledEmail['1']" class="form-control" id="EMAIL1-SCHEDULE1-TIMEZONE" name="EMAIL1-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL1-SCHEDULE1-TIMEZONE']" ng-change="dateChange('')" required="">
																	<option value="Pacific Standard Time" >PST</option> 
																	<option value="Mountain Standard Time">MST</option> 
																	<option value="Central America Standard Time">CST</option> 
																	<option value="Eastern Standard Time">EST</option>
																</select>
																<span class="help-block m-b-none">This timezone is used for your emails and other areas.</span>									
																									
</div>
																							
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">Email Protection:</label>
                                                <div class="col-sm-10">Allow no more than <select required="">
																	<option value="1" >1</option> 
																	<option value="2">2</option> 
																</select> emails sent to each person per <select required="">
																	<option value="hour" >hour</option> 
																	<option value="day">day</option> 
																	<option value="week">week</option> 
																	<option value="month">month</option> 
																</select></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">Button Color:</label>
                                                <div class="col-sm-10"><color-picker options="colorPickerOptions" ng-model="userinfo.defButtonColor"></color-picker>
																							<span class="help-block m-b-none">This is used for your call-to-action buttons in emails and landing pages.</span>	</div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">Meta Tag Description:</label>
                                                <div class="col-sm-10"><input type="text" class="form-control" placeholder="Sheets containing Lorem"></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">Meta Tag Keywords:</label>
                                                <div class="col-sm-10"><input type="text" class="form-control" placeholder="Lorem, Ipsum, has, been"></div>
                                            </div>
                                        </fieldset>
									<h2>Da Vinci Tracking Code</h2>
									<h2>Grading & Scoring</h2>		
										<!--
												<div class="form-group"><label class="col-sm-2 control-label">From Email</label>
													<div class="col-sm-10">
													<input type="text" class="form-control" placeholder="you@something.com" name="defFromAdd" ng-model="userinfo.defFromAdd">
													<span class="help-block m-b-none">The email you're sending from (and to which people will reply).</span></div>
												</div>
												<div class="form-group"><label class="col-sm-2 control-label">From Email Name</label>
													<div class="col-sm-10">
													<input type="text" class="form-control" placeholder="Bill Gates" name="defFromName" ng-model="userinfo.defFromName">
													<span class="help-block m-b-none">What do they call you?</span>
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-2">
														<label>Unsubscribe Link</label>
													</div>
													<div class="col-sm-8">
													<input type="text" class="form-control" placeholder="http://domain/unsubscribe" name="defUnsubscribe" ng-model="userinfo.defUnsubscribe">
													<span class="help-block m-b-none">How to unsubscribe?</span>
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-2">
														<label>View Online Message</label>
													</div>
													<div class="col-sm-8">
													<input type="text" class="form-control" placeholder="View online message" name="defViewOnline" ng-model="userinfo.defViewOnline">
													<span class="help-block m-b-none">View online message to show in the emails.</span>
													</div>
												</div>
												<div class="form-group"><label class="col-sm-2 control-label">Company Name</label>
													<div class="col-sm-10">
													<input type="text" class="form-control" placeholder="Company Name" name="defCompanyName" ng-model="userinfo.defCompanyName">
													<span class="help-block m-b-none">Company Name</span>
													</div>
												</div>
												<div class="form-group"><label class="col-sm-2 control-label">Company Address</label>
													<div class="col-sm-10">
													<input type="text" class="form-control" placeholder="Company Address" name="defCompanyAddress" ng-model="userinfo.defCompanyAddress">
													<span class="help-block m-b-none">Company Address</span>
													</div>
												</div>
												<div class="form-group"><label class="col-sm-2 control-label">Company Phone</label>
													<div class="col-sm-10">
													<input type="text" class="form-control" placeholder="Company Phone" name="defCompanyPhone" ng-model="userinfo.defCompanyPhone">
													<span class="help-block m-b-none">Company Phone</span>
													</div>
												</div>
												<div class="form-group"><label class="col-sm-2 control-label">Company Logo</label>
													<div class="col-sm-10">
														<a ng-model="file" ngf-select="upload($file,'defCompanyLogo')" href="" style="vertical-align: top;" class="btn btn-default btn-file" data-toggle="tooltip" data-placement="top" title="I'll upload and replace image of this email "><span ng-show="state['Upload-defCompanyLogo'] == 'Uploading'"><i class="glyphicon glyphicon-refresh spinning"></i></span><i class="fa fa-cloud-upload" ng-show="state['Upload-defCompanyLogo'] != 'Uploading'"></i> Upload image ...</a>
														<img ng-src="{{srcCompanyLogo}}" width="180px" border="0" alt="logo">
													</div>
												</div>
												<div class="hr-line-dashed"></div>            
												<div class="form-group">
													<div class="col-sm-4 col-sm-offset-2">
														<input type="hidden" name="action" value="saveProfileSettings">
														<button ng-disabled="myForm.$pristine" class="btn btn-primary" ng-click="Save()" ><i class="fa fa-floppy-o" ng-show="state['SaveAccountSetting'] == 'Save'"></i><span ng-show="state['SaveAccountSetting'] == 'Saving'"><i class="glyphicon glyphicon-refresh spinning"></i></span> {{state['SaveAccountSetting']}}</button>
														<button ng-disabled="myForm.$pristine" class="btn btn-white" ng-click="Cancel()"><i class="fa fa-ban"></i> Cancel</button>
													</div>
												</div>
												<div ng-show="saveSuccess && myForm.$pristine"  ng-cloak>
													<div class="alert alert-success">
													<strong> Success! </strong> Save success.
													</div>
												</div>
										-->
										
									</div>
									
								</div>
								<div class="tab-pane" id="tab-you">
									<div class="panel-body">
										<p></p>
										<!--
										<form role="form">
										<h2>Your Information</h2>
									    <p>Your contact info is used in all your Emails.</p>

											<p><label>Your First Name</label><input class="form-control" name="user_first_name" placeholder="Donald" type="text" value="{{user_first_name}}"></small>What do you want me to call you, my love?</small></p>
											<p><label>Your Cell Phone Number</label><input class="form-control" name="user_cell_phone_number" placeholder="949-375-4459" type="text" value="{{user_cell_phone_number}}"><small>In case I need to call you or send you an update.</small></p>
											<p><label>From Email</label><input class="form-control" name="STUDIO_ACCOUNTID-STUDIO_PROGRAMID-PABP-EML1-FROMADDRESS" placeholder="you@something.com" type="text" value="{{STUDIO_ACCOUNTID-STUDIO_PROGRAMID-PABP-EML1-FROMADDRESS}}"><small>The email you're sending from (and to which people will reply).</small></p> 
											<p><label>From Email Name</label><input class="form-control" name="STUDIO_ACCOUNTID-STUDIO_PROGRAMID-PABP-EML1-FROMNAME" placeholder="Bill Gates" type="text" value="{{STUDIO_ACCOUNTID-STUDIO_PROGRAMID-PABP-EML1-FROMNAME}}"><small>What do they call you?</small></p>
											<h2>Studio Credentials</h2>
											<p><label>Account ID</label><input class="form-control" name="studio_accountID" placeholder="679" type="text" value="{{studio_accountID}}"></p>
											<p><label>Your Username</label><input class="form-control" name="studio_username" placeholder="you@something.com" type="text" value="{{studio_username}}"></p>
											<p><label>Your Password</label><input class="form-control" name="studio_password" placeholder="You want some cool stuff?" type="password" value="{{studio_password}}"></p>
											<h2>Workspace Settings</h2>
											<div class="form-group">
												<label class="col-sm-2 control-label">Minimize left side nav?</label>
												<div class="switch col-sm-10 onoffswitch">
													<div class="onoffswitch">
														<input class="onoffswitch-checkbox" id="collapsemenu" name="collapsemenu" type="checkbox"> <label class="onoffswitch-label" for="collapsemenu"><span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Fix the left side nav in place?</label>
												<div class="col-sm-10">
													<div class="switch">
														<div class="onoffswitch">
															<input class="onoffswitch-checkbox" id="fixedsidebar" name="fixedsidebar" type="checkbox"> <label class="onoffswitch-label" for="fixedsidebar"><span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Switch to "Box" mode?</label>
												<div class="col-sm-10">
													<div class="switch">
														<div class="onoffswitch">
															<input class="onoffswitch-checkbox" id="boxedlayout" name="boxedlayout" type="checkbox"> <label class="onoffswitch-label" for="boxedlayout"><span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
														</div>
													</div>
												</div>
											</div>
											<p>&nbsp;</p>
    									<input name="action" type="hidden" value="saveProfileSettings"> <button class="btn btn-primary" type="submit">Save</button> <button class="btn btn-white" type="submit">Cancel</button>
										</form>
										-->
									</div>
								</div>
								<div class="tab-pane" id="tab-3rd-party-products">
									<div class="panel-body">
										<!--
										<p><label><i class="fa fa-google" aria-hidden="true" style="color:red"></i> Google Analytics Tracking Code</label><input class="form-control" name="google_tracking_code" placeholder="UA-83447148-1" type="text" value="{{google_tracking_code}}"><small>To find your tracking ID, sign in to your Analytics account, click Admin, select an account from the menua in the ACCOUNT column, and select a property.  Under PROPERTY, click Tracking Info > Tracking Code.</small> </p>
										<p><label><i class="fa fa-facebook-official" aria-hidden="true" style="color:blue"></i> Facebook Pixel ID</label><input class="form-control" name="facebook_pixel_id" placeholder="120261521652622" type="text" value="{{facebook_pixel_id}}"><small>Find your Pixel ID by going to your Ads Manager, going to the pixel section and looking under the Pixel Name. To learn more about the Facebook Pixel, <a href="https://www.facebook.com/business/help/952192354843755/?ref=u2u">please visit this link from Facebook's Help Center</a>.</small></p>
    									<p>&nbsp;</p>
    									<input name="action" type="hidden" value="saveProfileSettings"> <button class="btn btn-primary" type="submit">Save</button> <button class="btn btn-white" type="submit">Cancel</button>
										-->
									</div>
								</div>
								<div class="tab-pane" id="tab-tracking-code">
									<div class="panel-body">
									    <p>To track interactions on your website, add the javascript snippet below.  Copy and paste the code snippet before the </body> tag on every page where you want to track interactions.</p>
										<p><label>MindFire Tracking Code</label></p>
										<p><code>
                                        http://hc.studioqa.com/html/test.js?dom=TestingDummyCookie&track=true
                                        </code></p>
								
    									<p>&nbsp;</p>
    									<input name="action" type="hidden" value="saveProfileSettings"> <button class="btn btn-primary" type="submit">Save</button> <button class="btn btn-white" type="submit">Cancel</button>
									</div>
								</div>
								<div class="tab-pane" id="tab-grading-and-scoring">
									<div class="panel-body">
										<h2>Grading & Scoring</h2>
									    <p>To measure the value of the people interacting with your marketing programs, I've set up the following for you.  Feel free to change.</p>
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
                                            <div class="form-group"><label class="col-sm-2 control-label">Name:</label>
                                                <div class="col-sm-10"><input type="text" class="form-control" placeholder="Product name"></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">Price:</label>
                                                <div class="col-sm-10"><input type="text" class="form-control" placeholder="$160.00"></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">Description:</label>
																							<div class="col-sm-10"></div>
                                                    <div class="summernote" style="display: none;">
                                                        <h3>Lorem Ipsum is simply</h3>
                                                        dummy text of the printing and typesetting industry. <strong>Lorem Ipsum has been the industry's</strong> standard dummy text ever since the 1500s,
                                                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                                                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                                                        typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with
                                                        <br>

                                                    </div><div class="note-editor note-frame panel panel-default"><div class="note-dropzone">  <div class="note-dropzone-message"></div></div><div class="note-toolbar panel-heading"><div class="note-btn-group btn-group note-style"><div class="note-btn-group btn-group"><button type="button" class="note-btn btn btn-default btn-sm dropdown-toggle" tabindex="-1" data-toggle="dropdown" title="" data-original-title="Style"><i class="note-icon-magic"></i> <span class="note-icon-caret"></span></button><div class="dropdown-menu dropdown-style"><li><a href="#" data-value="p"><p>p</p></a></li><li><a href="#" data-value="blockquote"><blockquote>Quote</blockquote></a></li><li><a href="#" data-value="pre"><pre>Code</pre></a></li><li><a href="#" data-value="h1"><h1>Header 1</h1></a></li><li><a href="#" data-value="h2"><h2>Header 2</h2></a></li><li><a href="#" data-value="h3"><h3>Header 3</h3></a></li><li><a href="#" data-value="h4"><h4>Header 4</h4></a></li><li><a href="#" data-value="h5"><h5>Header 5</h5></a></li><li><a href="#" data-value="h6"><h6>Header 6</h6></a></li></div></div></div><div class="note-btn-group btn-group note-font"><button type="button" class="note-btn btn btn-default btn-sm note-btn-bold" tabindex="-1" title="" data-original-title="Bold (⌘+B)"><i class="note-icon-bold"></i></button><button type="button" class="note-btn btn btn-default btn-sm note-btn-underline" tabindex="-1" title="" data-original-title="Underline (⌘+U)"><i class="note-icon-underline"></i></button><button type="button" class="note-btn btn btn-default btn-sm" tabindex="-1" title="" data-original-title="Remove Font Style (⌘+\)"><i class="note-icon-eraser"></i></button></div><div class="note-btn-group btn-group note-fontname"><div class="note-btn-group btn-group"><button type="button" class="note-btn btn btn-default btn-sm dropdown-toggle" tabindex="-1" data-toggle="dropdown" title="" data-original-title="Font Family"><span class="note-current-fontname">open sans</span> <span class="note-icon-caret"></span></button><div class="dropdown-menu note-check dropdown-fontname"><li><a href="#" data-value="Arial" class=""><i class="note-icon-check"></i> <span style="font-family:Arial">Arial</span></a></li><li><a href="#" data-value="Arial Black" class=""><i class="note-icon-check"></i> <span style="font-family:Arial Black">Arial Black</span></a></li><li><a href="#" data-value="Comic Sans MS" class=""><i class="note-icon-check"></i> <span style="font-family:Comic Sans MS">Comic Sans MS</span></a></li><li><a href="#" data-value="Courier New" class=""><i class="note-icon-check"></i> <span style="font-family:Courier New">Courier New</span></a></li><li><a href="#" data-value="Helvetica Neue" class=""><i class="note-icon-check"></i> <span style="font-family:Helvetica Neue">Helvetica Neue</span></a></li><li><a href="#" data-value="Helvetica" class=""><i class="note-icon-check"></i> <span style="font-family:Helvetica">Helvetica</span></a></li><li><a href="#" data-value="Impact" class=""><i class="note-icon-check"></i> <span style="font-family:Impact">Impact</span></a></li><li><a href="#" data-value="Lucida Grande" class=""><i class="note-icon-check"></i> <span style="font-family:Lucida Grande">Lucida Grande</span></a></li><li><a href="#" data-value="Tahoma" class=""><i class="note-icon-check"></i> <span style="font-family:Tahoma">Tahoma</span></a></li><li><a href="#" data-value="Times New Roman" class=""><i class="note-icon-check"></i> <span style="font-family:Times New Roman">Times New Roman</span></a></li><li><a href="#" data-value="Verdana" class=""><i class="note-icon-check"></i> <span style="font-family:Verdana">Verdana</span></a></li></div></div></div><div class="note-btn-group btn-group note-color"><div class="note-btn-group btn-group note-color"><button type="button" class="note-btn btn btn-default btn-sm note-current-color-button" tabindex="-1" title="" data-original-title="Recent Color" data-backcolor="#FFFF00"><i class="note-icon-font note-recent-color" style="background-color: rgb(255, 255, 0);"></i></button><button type="button" class="note-btn btn btn-default btn-sm dropdown-toggle" tabindex="-1" data-toggle="dropdown" title="" data-original-title="More Color"><span class="note-icon-caret"></span></button><div class="dropdown-menu"><li><div class="btn-group">  <div class="note-palette-title">Background Color</div>  <div>    <button type="button" class="note-color-reset btn btn-default" data-event="backColor" data-value="inherit">Transparent    </button>  </div>  <div class="note-holder" data-event="backColor"><div class="note-color-palette"><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#000000" data-event="backColor" data-value="#000000" title="" data-toggle="button" tabindex="-1" data-original-title="#000000"></button><button type="button" class="note-color-btn" style="background-color:#424242" data-event="backColor" data-value="#424242" title="" data-toggle="button" tabindex="-1" data-original-title="#424242"></button><button type="button" class="note-color-btn" style="background-color:#636363" data-event="backColor" data-value="#636363" title="" data-toggle="button" tabindex="-1" data-original-title="#636363"></button><button type="button" class="note-color-btn" style="background-color:#9C9C94" data-event="backColor" data-value="#9C9C94" title="" data-toggle="button" tabindex="-1" data-original-title="#9C9C94"></button><button type="button" class="note-color-btn" style="background-color:#CEC6CE" data-event="backColor" data-value="#CEC6CE" title="" data-toggle="button" tabindex="-1" data-original-title="#CEC6CE"></button><button type="button" class="note-color-btn" style="background-color:#EFEFEF" data-event="backColor" data-value="#EFEFEF" title="" data-toggle="button" tabindex="-1" data-original-title="#EFEFEF"></button><button type="button" class="note-color-btn" style="background-color:#F7F7F7" data-event="backColor" data-value="#F7F7F7" title="" data-toggle="button" tabindex="-1" data-original-title="#F7F7F7"></button><button type="button" class="note-color-btn" style="background-color:#FFFFFF" data-event="backColor" data-value="#FFFFFF" title="" data-toggle="button" tabindex="-1" data-original-title="#FFFFFF"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#FF0000" data-event="backColor" data-value="#FF0000" title="" data-toggle="button" tabindex="-1" data-original-title="#FF0000"></button><button type="button" class="note-color-btn" style="background-color:#FF9C00" data-event="backColor" data-value="#FF9C00" title="" data-toggle="button" tabindex="-1" data-original-title="#FF9C00"></button><button type="button" class="note-color-btn" style="background-color:#FFFF00" data-event="backColor" data-value="#FFFF00" title="" data-toggle="button" tabindex="-1" data-original-title="#FFFF00"></button><button type="button" class="note-color-btn" style="background-color:#00FF00" data-event="backColor" data-value="#00FF00" title="" data-toggle="button" tabindex="-1" data-original-title="#00FF00"></button><button type="button" class="note-color-btn" style="background-color:#00FFFF" data-event="backColor" data-value="#00FFFF" title="" data-toggle="button" tabindex="-1" data-original-title="#00FFFF"></button><button type="button" class="note-color-btn" style="background-color:#0000FF" data-event="backColor" data-value="#0000FF" title="" data-toggle="button" tabindex="-1" data-original-title="#0000FF"></button><button type="button" class="note-color-btn" style="background-color:#9C00FF" data-event="backColor" data-value="#9C00FF" title="" data-toggle="button" tabindex="-1" data-original-title="#9C00FF"></button><button type="button" class="note-color-btn" style="background-color:#FF00FF" data-event="backColor" data-value="#FF00FF" title="" data-toggle="button" tabindex="-1" data-original-title="#FF00FF"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#F7C6CE" data-event="backColor" data-value="#F7C6CE" title="" data-toggle="button" tabindex="-1" data-original-title="#F7C6CE"></button><button type="button" class="note-color-btn" style="background-color:#FFE7CE" data-event="backColor" data-value="#FFE7CE" title="" data-toggle="button" tabindex="-1" data-original-title="#FFE7CE"></button><button type="button" class="note-color-btn" style="background-color:#FFEFC6" data-event="backColor" data-value="#FFEFC6" title="" data-toggle="button" tabindex="-1" data-original-title="#FFEFC6"></button><button type="button" class="note-color-btn" style="background-color:#D6EFD6" data-event="backColor" data-value="#D6EFD6" title="" data-toggle="button" tabindex="-1" data-original-title="#D6EFD6"></button><button type="button" class="note-color-btn" style="background-color:#CEDEE7" data-event="backColor" data-value="#CEDEE7" title="" data-toggle="button" tabindex="-1" data-original-title="#CEDEE7"></button><button type="button" class="note-color-btn" style="background-color:#CEE7F7" data-event="backColor" data-value="#CEE7F7" title="" data-toggle="button" tabindex="-1" data-original-title="#CEE7F7"></button><button type="button" class="note-color-btn" style="background-color:#D6D6E7" data-event="backColor" data-value="#D6D6E7" title="" data-toggle="button" tabindex="-1" data-original-title="#D6D6E7"></button><button type="button" class="note-color-btn" style="background-color:#E7D6DE" data-event="backColor" data-value="#E7D6DE" title="" data-toggle="button" tabindex="-1" data-original-title="#E7D6DE"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#E79C9C" data-event="backColor" data-value="#E79C9C" title="" data-toggle="button" tabindex="-1" data-original-title="#E79C9C"></button><button type="button" class="note-color-btn" style="background-color:#FFC69C" data-event="backColor" data-value="#FFC69C" title="" data-toggle="button" tabindex="-1" data-original-title="#FFC69C"></button><button type="button" class="note-color-btn" style="background-color:#FFE79C" data-event="backColor" data-value="#FFE79C" title="" data-toggle="button" tabindex="-1" data-original-title="#FFE79C"></button><button type="button" class="note-color-btn" style="background-color:#B5D6A5" data-event="backColor" data-value="#B5D6A5" title="" data-toggle="button" tabindex="-1" data-original-title="#B5D6A5"></button><button type="button" class="note-color-btn" style="background-color:#A5C6CE" data-event="backColor" data-value="#A5C6CE" title="" data-toggle="button" tabindex="-1" data-original-title="#A5C6CE"></button><button type="button" class="note-color-btn" style="background-color:#9CC6EF" data-event="backColor" data-value="#9CC6EF" title="" data-toggle="button" tabindex="-1" data-original-title="#9CC6EF"></button><button type="button" class="note-color-btn" style="background-color:#B5A5D6" data-event="backColor" data-value="#B5A5D6" title="" data-toggle="button" tabindex="-1" data-original-title="#B5A5D6"></button><button type="button" class="note-color-btn" style="background-color:#D6A5BD" data-event="backColor" data-value="#D6A5BD" title="" data-toggle="button" tabindex="-1" data-original-title="#D6A5BD"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#E76363" data-event="backColor" data-value="#E76363" title="" data-toggle="button" tabindex="-1" data-original-title="#E76363"></button><button type="button" class="note-color-btn" style="background-color:#F7AD6B" data-event="backColor" data-value="#F7AD6B" title="" data-toggle="button" tabindex="-1" data-original-title="#F7AD6B"></button><button type="button" class="note-color-btn" style="background-color:#FFD663" data-event="backColor" data-value="#FFD663" title="" data-toggle="button" tabindex="-1" data-original-title="#FFD663"></button><button type="button" class="note-color-btn" style="background-color:#94BD7B" data-event="backColor" data-value="#94BD7B" title="" data-toggle="button" tabindex="-1" data-original-title="#94BD7B"></button><button type="button" class="note-color-btn" style="background-color:#73A5AD" data-event="backColor" data-value="#73A5AD" title="" data-toggle="button" tabindex="-1" data-original-title="#73A5AD"></button><button type="button" class="note-color-btn" style="background-color:#6BADDE" data-event="backColor" data-value="#6BADDE" title="" data-toggle="button" tabindex="-1" data-original-title="#6BADDE"></button><button type="button" class="note-color-btn" style="background-color:#8C7BC6" data-event="backColor" data-value="#8C7BC6" title="" data-toggle="button" tabindex="-1" data-original-title="#8C7BC6"></button><button type="button" class="note-color-btn" style="background-color:#C67BA5" data-event="backColor" data-value="#C67BA5" title="" data-toggle="button" tabindex="-1" data-original-title="#C67BA5"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#CE0000" data-event="backColor" data-value="#CE0000" title="" data-toggle="button" tabindex="-1" data-original-title="#CE0000"></button><button type="button" class="note-color-btn" style="background-color:#E79439" data-event="backColor" data-value="#E79439" title="" data-toggle="button" tabindex="-1" data-original-title="#E79439"></button><button type="button" class="note-color-btn" style="background-color:#EFC631" data-event="backColor" data-value="#EFC631" title="" data-toggle="button" tabindex="-1" data-original-title="#EFC631"></button><button type="button" class="note-color-btn" style="background-color:#6BA54A" data-event="backColor" data-value="#6BA54A" title="" data-toggle="button" tabindex="-1" data-original-title="#6BA54A"></button><button type="button" class="note-color-btn" style="background-color:#4A7B8C" data-event="backColor" data-value="#4A7B8C" title="" data-toggle="button" tabindex="-1" data-original-title="#4A7B8C"></button><button type="button" class="note-color-btn" style="background-color:#3984C6" data-event="backColor" data-value="#3984C6" title="" data-toggle="button" tabindex="-1" data-original-title="#3984C6"></button><button type="button" class="note-color-btn" style="background-color:#634AA5" data-event="backColor" data-value="#634AA5" title="" data-toggle="button" tabindex="-1" data-original-title="#634AA5"></button><button type="button" class="note-color-btn" style="background-color:#A54A7B" data-event="backColor" data-value="#A54A7B" title="" data-toggle="button" tabindex="-1" data-original-title="#A54A7B"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#9C0000" data-event="backColor" data-value="#9C0000" title="" data-toggle="button" tabindex="-1" data-original-title="#9C0000"></button><button type="button" class="note-color-btn" style="background-color:#B56308" data-event="backColor" data-value="#B56308" title="" data-toggle="button" tabindex="-1" data-original-title="#B56308"></button><button type="button" class="note-color-btn" style="background-color:#BD9400" data-event="backColor" data-value="#BD9400" title="" data-toggle="button" tabindex="-1" data-original-title="#BD9400"></button><button type="button" class="note-color-btn" style="background-color:#397B21" data-event="backColor" data-value="#397B21" title="" data-toggle="button" tabindex="-1" data-original-title="#397B21"></button><button type="button" class="note-color-btn" style="background-color:#104A5A" data-event="backColor" data-value="#104A5A" title="" data-toggle="button" tabindex="-1" data-original-title="#104A5A"></button><button type="button" class="note-color-btn" style="background-color:#085294" data-event="backColor" data-value="#085294" title="" data-toggle="button" tabindex="-1" data-original-title="#085294"></button><button type="button" class="note-color-btn" style="background-color:#311873" data-event="backColor" data-value="#311873" title="" data-toggle="button" tabindex="-1" data-original-title="#311873"></button><button type="button" class="note-color-btn" style="background-color:#731842" data-event="backColor" data-value="#731842" title="" data-toggle="button" tabindex="-1" data-original-title="#731842"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#630000" data-event="backColor" data-value="#630000" title="" data-toggle="button" tabindex="-1" data-original-title="#630000"></button><button type="button" class="note-color-btn" style="background-color:#7B3900" data-event="backColor" data-value="#7B3900" title="" data-toggle="button" tabindex="-1" data-original-title="#7B3900"></button><button type="button" class="note-color-btn" style="background-color:#846300" data-event="backColor" data-value="#846300" title="" data-toggle="button" tabindex="-1" data-original-title="#846300"></button><button type="button" class="note-color-btn" style="background-color:#295218" data-event="backColor" data-value="#295218" title="" data-toggle="button" tabindex="-1" data-original-title="#295218"></button><button type="button" class="note-color-btn" style="background-color:#083139" data-event="backColor" data-value="#083139" title="" data-toggle="button" tabindex="-1" data-original-title="#083139"></button><button type="button" class="note-color-btn" style="background-color:#003163" data-event="backColor" data-value="#003163" title="" data-toggle="button" tabindex="-1" data-original-title="#003163"></button><button type="button" class="note-color-btn" style="background-color:#21104A" data-event="backColor" data-value="#21104A" title="" data-toggle="button" tabindex="-1" data-original-title="#21104A"></button><button type="button" class="note-color-btn" style="background-color:#4A1031" data-event="backColor" data-value="#4A1031" title="" data-toggle="button" tabindex="-1" data-original-title="#4A1031"></button></div></div></div></div><div class="btn-group">  <div class="note-palette-title">Foreground Color</div>  <div>    <button type="button" class="note-color-reset btn btn-default" data-event="removeFormat" data-value="foreColor">Reset to default    </button>  </div>  <div class="note-holder" data-event="foreColor"><div class="note-color-palette"><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#000000" data-event="foreColor" data-value="#000000" title="" data-toggle="button" tabindex="-1" data-original-title="#000000"></button><button type="button" class="note-color-btn" style="background-color:#424242" data-event="foreColor" data-value="#424242" title="" data-toggle="button" tabindex="-1" data-original-title="#424242"></button><button type="button" class="note-color-btn" style="background-color:#636363" data-event="foreColor" data-value="#636363" title="" data-toggle="button" tabindex="-1" data-original-title="#636363"></button><button type="button" class="note-color-btn" style="background-color:#9C9C94" data-event="foreColor" data-value="#9C9C94" title="" data-toggle="button" tabindex="-1" data-original-title="#9C9C94"></button><button type="button" class="note-color-btn" style="background-color:#CEC6CE" data-event="foreColor" data-value="#CEC6CE" title="" data-toggle="button" tabindex="-1" data-original-title="#CEC6CE"></button><button type="button" class="note-color-btn" style="background-color:#EFEFEF" data-event="foreColor" data-value="#EFEFEF" title="" data-toggle="button" tabindex="-1" data-original-title="#EFEFEF"></button><button type="button" class="note-color-btn" style="background-color:#F7F7F7" data-event="foreColor" data-value="#F7F7F7" title="" data-toggle="button" tabindex="-1" data-original-title="#F7F7F7"></button><button type="button" class="note-color-btn" style="background-color:#FFFFFF" data-event="foreColor" data-value="#FFFFFF" title="" data-toggle="button" tabindex="-1" data-original-title="#FFFFFF"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#FF0000" data-event="foreColor" data-value="#FF0000" title="" data-toggle="button" tabindex="-1" data-original-title="#FF0000"></button><button type="button" class="note-color-btn" style="background-color:#FF9C00" data-event="foreColor" data-value="#FF9C00" title="" data-toggle="button" tabindex="-1" data-original-title="#FF9C00"></button><button type="button" class="note-color-btn" style="background-color:#FFFF00" data-event="foreColor" data-value="#FFFF00" title="" data-toggle="button" tabindex="-1" data-original-title="#FFFF00"></button><button type="button" class="note-color-btn" style="background-color:#00FF00" data-event="foreColor" data-value="#00FF00" title="" data-toggle="button" tabindex="-1" data-original-title="#00FF00"></button><button type="button" class="note-color-btn" style="background-color:#00FFFF" data-event="foreColor" data-value="#00FFFF" title="" data-toggle="button" tabindex="-1" data-original-title="#00FFFF"></button><button type="button" class="note-color-btn" style="background-color:#0000FF" data-event="foreColor" data-value="#0000FF" title="" data-toggle="button" tabindex="-1" data-original-title="#0000FF"></button><button type="button" class="note-color-btn" style="background-color:#9C00FF" data-event="foreColor" data-value="#9C00FF" title="" data-toggle="button" tabindex="-1" data-original-title="#9C00FF"></button><button type="button" class="note-color-btn" style="background-color:#FF00FF" data-event="foreColor" data-value="#FF00FF" title="" data-toggle="button" tabindex="-1" data-original-title="#FF00FF"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#F7C6CE" data-event="foreColor" data-value="#F7C6CE" title="" data-toggle="button" tabindex="-1" data-original-title="#F7C6CE"></button><button type="button" class="note-color-btn" style="background-color:#FFE7CE" data-event="foreColor" data-value="#FFE7CE" title="" data-toggle="button" tabindex="-1" data-original-title="#FFE7CE"></button><button type="button" class="note-color-btn" style="background-color:#FFEFC6" data-event="foreColor" data-value="#FFEFC6" title="" data-toggle="button" tabindex="-1" data-original-title="#FFEFC6"></button><button type="button" class="note-color-btn" style="background-color:#D6EFD6" data-event="foreColor" data-value="#D6EFD6" title="" data-toggle="button" tabindex="-1" data-original-title="#D6EFD6"></button><button type="button" class="note-color-btn" style="background-color:#CEDEE7" data-event="foreColor" data-value="#CEDEE7" title="" data-toggle="button" tabindex="-1" data-original-title="#CEDEE7"></button><button type="button" class="note-color-btn" style="background-color:#CEE7F7" data-event="foreColor" data-value="#CEE7F7" title="" data-toggle="button" tabindex="-1" data-original-title="#CEE7F7"></button><button type="button" class="note-color-btn" style="background-color:#D6D6E7" data-event="foreColor" data-value="#D6D6E7" title="" data-toggle="button" tabindex="-1" data-original-title="#D6D6E7"></button><button type="button" class="note-color-btn" style="background-color:#E7D6DE" data-event="foreColor" data-value="#E7D6DE" title="" data-toggle="button" tabindex="-1" data-original-title="#E7D6DE"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#E79C9C" data-event="foreColor" data-value="#E79C9C" title="" data-toggle="button" tabindex="-1" data-original-title="#E79C9C"></button><button type="button" class="note-color-btn" style="background-color:#FFC69C" data-event="foreColor" data-value="#FFC69C" title="" data-toggle="button" tabindex="-1" data-original-title="#FFC69C"></button><button type="button" class="note-color-btn" style="background-color:#FFE79C" data-event="foreColor" data-value="#FFE79C" title="" data-toggle="button" tabindex="-1" data-original-title="#FFE79C"></button><button type="button" class="note-color-btn" style="background-color:#B5D6A5" data-event="foreColor" data-value="#B5D6A5" title="" data-toggle="button" tabindex="-1" data-original-title="#B5D6A5"></button><button type="button" class="note-color-btn" style="background-color:#A5C6CE" data-event="foreColor" data-value="#A5C6CE" title="" data-toggle="button" tabindex="-1" data-original-title="#A5C6CE"></button><button type="button" class="note-color-btn" style="background-color:#9CC6EF" data-event="foreColor" data-value="#9CC6EF" title="" data-toggle="button" tabindex="-1" data-original-title="#9CC6EF"></button><button type="button" class="note-color-btn" style="background-color:#B5A5D6" data-event="foreColor" data-value="#B5A5D6" title="" data-toggle="button" tabindex="-1" data-original-title="#B5A5D6"></button><button type="button" class="note-color-btn" style="background-color:#D6A5BD" data-event="foreColor" data-value="#D6A5BD" title="" data-toggle="button" tabindex="-1" data-original-title="#D6A5BD"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#E76363" data-event="foreColor" data-value="#E76363" title="" data-toggle="button" tabindex="-1" data-original-title="#E76363"></button><button type="button" class="note-color-btn" style="background-color:#F7AD6B" data-event="foreColor" data-value="#F7AD6B" title="" data-toggle="button" tabindex="-1" data-original-title="#F7AD6B"></button><button type="button" class="note-color-btn" style="background-color:#FFD663" data-event="foreColor" data-value="#FFD663" title="" data-toggle="button" tabindex="-1" data-original-title="#FFD663"></button><button type="button" class="note-color-btn" style="background-color:#94BD7B" data-event="foreColor" data-value="#94BD7B" title="" data-toggle="button" tabindex="-1" data-original-title="#94BD7B"></button><button type="button" class="note-color-btn" style="background-color:#73A5AD" data-event="foreColor" data-value="#73A5AD" title="" data-toggle="button" tabindex="-1" data-original-title="#73A5AD"></button><button type="button" class="note-color-btn" style="background-color:#6BADDE" data-event="foreColor" data-value="#6BADDE" title="" data-toggle="button" tabindex="-1" data-original-title="#6BADDE"></button><button type="button" class="note-color-btn" style="background-color:#8C7BC6" data-event="foreColor" data-value="#8C7BC6" title="" data-toggle="button" tabindex="-1" data-original-title="#8C7BC6"></button><button type="button" class="note-color-btn" style="background-color:#C67BA5" data-event="foreColor" data-value="#C67BA5" title="" data-toggle="button" tabindex="-1" data-original-title="#C67BA5"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#CE0000" data-event="foreColor" data-value="#CE0000" title="" data-toggle="button" tabindex="-1" data-original-title="#CE0000"></button><button type="button" class="note-color-btn" style="background-color:#E79439" data-event="foreColor" data-value="#E79439" title="" data-toggle="button" tabindex="-1" data-original-title="#E79439"></button><button type="button" class="note-color-btn" style="background-color:#EFC631" data-event="foreColor" data-value="#EFC631" title="" data-toggle="button" tabindex="-1" data-original-title="#EFC631"></button><button type="button" class="note-color-btn" style="background-color:#6BA54A" data-event="foreColor" data-value="#6BA54A" title="" data-toggle="button" tabindex="-1" data-original-title="#6BA54A"></button><button type="button" class="note-color-btn" style="background-color:#4A7B8C" data-event="foreColor" data-value="#4A7B8C" title="" data-toggle="button" tabindex="-1" data-original-title="#4A7B8C"></button><button type="button" class="note-color-btn" style="background-color:#3984C6" data-event="foreColor" data-value="#3984C6" title="" data-toggle="button" tabindex="-1" data-original-title="#3984C6"></button><button type="button" class="note-color-btn" style="background-color:#634AA5" data-event="foreColor" data-value="#634AA5" title="" data-toggle="button" tabindex="-1" data-original-title="#634AA5"></button><button type="button" class="note-color-btn" style="background-color:#A54A7B" data-event="foreColor" data-value="#A54A7B" title="" data-toggle="button" tabindex="-1" data-original-title="#A54A7B"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#9C0000" data-event="foreColor" data-value="#9C0000" title="" data-toggle="button" tabindex="-1" data-original-title="#9C0000"></button><button type="button" class="note-color-btn" style="background-color:#B56308" data-event="foreColor" data-value="#B56308" title="" data-toggle="button" tabindex="-1" data-original-title="#B56308"></button><button type="button" class="note-color-btn" style="background-color:#BD9400" data-event="foreColor" data-value="#BD9400" title="" data-toggle="button" tabindex="-1" data-original-title="#BD9400"></button><button type="button" class="note-color-btn" style="background-color:#397B21" data-event="foreColor" data-value="#397B21" title="" data-toggle="button" tabindex="-1" data-original-title="#397B21"></button><button type="button" class="note-color-btn" style="background-color:#104A5A" data-event="foreColor" data-value="#104A5A" title="" data-toggle="button" tabindex="-1" data-original-title="#104A5A"></button><button type="button" class="note-color-btn" style="background-color:#085294" data-event="foreColor" data-value="#085294" title="" data-toggle="button" tabindex="-1" data-original-title="#085294"></button><button type="button" class="note-color-btn" style="background-color:#311873" data-event="foreColor" data-value="#311873" title="" data-toggle="button" tabindex="-1" data-original-title="#311873"></button><button type="button" class="note-color-btn" style="background-color:#731842" data-event="foreColor" data-value="#731842" title="" data-toggle="button" tabindex="-1" data-original-title="#731842"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#630000" data-event="foreColor" data-value="#630000" title="" data-toggle="button" tabindex="-1" data-original-title="#630000"></button><button type="button" class="note-color-btn" style="background-color:#7B3900" data-event="foreColor" data-value="#7B3900" title="" data-toggle="button" tabindex="-1" data-original-title="#7B3900"></button><button type="button" class="note-color-btn" style="background-color:#846300" data-event="foreColor" data-value="#846300" title="" data-toggle="button" tabindex="-1" data-original-title="#846300"></button><button type="button" class="note-color-btn" style="background-color:#295218" data-event="foreColor" data-value="#295218" title="" data-toggle="button" tabindex="-1" data-original-title="#295218"></button><button type="button" class="note-color-btn" style="background-color:#083139" data-event="foreColor" data-value="#083139" title="" data-toggle="button" tabindex="-1" data-original-title="#083139"></button><button type="button" class="note-color-btn" style="background-color:#003163" data-event="foreColor" data-value="#003163" title="" data-toggle="button" tabindex="-1" data-original-title="#003163"></button><button type="button" class="note-color-btn" style="background-color:#21104A" data-event="foreColor" data-value="#21104A" title="" data-toggle="button" tabindex="-1" data-original-title="#21104A"></button><button type="button" class="note-color-btn" style="background-color:#4A1031" data-event="foreColor" data-value="#4A1031" title="" data-toggle="button" tabindex="-1" data-original-title="#4A1031"></button></div></div></div></div></li></div></div></div><div class="note-btn-group btn-group note-para"><button type="button" class="note-btn btn btn-default btn-sm" tabindex="-1" title="" data-original-title="Unordered list (⌘+⇧+NUM7)"><i class="note-icon-unorderedlist"></i></button><button type="button" class="note-btn btn btn-default btn-sm" tabindex="-1" title="" data-original-title="Ordered list (⌘+⇧+NUM8)"><i class="note-icon-orderedlist"></i></button><div class="note-btn-group btn-group"><button type="button" class="note-btn btn btn-default btn-sm dropdown-toggle" tabindex="-1" data-toggle="dropdown" title="" data-original-title="Paragraph"><i class="note-icon-align-left"></i> <span class="note-icon-caret"></span></button><div class="dropdown-menu"><div class="note-btn-group btn-group note-align"><button type="button" class="note-btn btn btn-default btn-sm" tabindex="-1" title="" data-original-title="Align left (⌘+⇧+L)"><i class="note-icon-align-left"></i></button><button type="button" class="note-btn btn btn-default btn-sm" tabindex="-1" title="" data-original-title="Align center (⌘+⇧+E)"><i class="note-icon-align-center"></i></button><button type="button" class="note-btn btn btn-default btn-sm" tabindex="-1" title="" data-original-title="Align right (⌘+⇧+R)"><i class="note-icon-align-right"></i></button><button type="button" class="note-btn btn btn-default btn-sm" tabindex="-1" title="" data-original-title="Justify full (⌘+⇧+J)"><i class="note-icon-align-justify"></i></button></div><div class="note-btn-group btn-group note-list"><button type="button" class="note-btn btn btn-default btn-sm" tabindex="-1" title="" data-original-title="Outdent (⌘+[)"><i class="note-icon-align-outdent"></i></button><button type="button" class="note-btn btn btn-default btn-sm" tabindex="-1" title="" data-original-title="Indent (⌘+])"><i class="note-icon-align-indent"></i></button></div></div></div></div><div class="note-btn-group btn-group note-table"><div class="note-btn-group btn-group"><button type="button" class="note-btn btn btn-default btn-sm dropdown-toggle" tabindex="-1" data-toggle="dropdown" title="" data-original-title="Table"><i class="note-icon-table"></i> <span class="note-icon-caret"></span></button><div class="dropdown-menu note-table"><div class="note-dimension-picker">  <div class="note-dimension-picker-mousecatcher" data-event="insertTable" data-value="1x1" style="width: 10em; height: 10em;"></div>  <div class="note-dimension-picker-highlighted"></div>  <div class="note-dimension-picker-unhighlighted"></div></div><div class="note-dimension-display">1 x 1</div></div></div></div><div class="note-btn-group btn-group note-insert"><button type="button" class="note-btn btn btn-default btn-sm" tabindex="-1" title="" data-original-title="Link (⌘+K)"><i class="note-icon-link"></i></button><button type="button" class="note-btn btn btn-default btn-sm" tabindex="-1" title="" data-original-title="Picture"><i class="note-icon-picture"></i></button><button type="button" class="note-btn btn btn-default btn-sm" tabindex="-1" title="" data-original-title="Video"><i class="note-icon-video"></i></button></div><div class="note-btn-group btn-group note-view"><button type="button" class="note-btn btn btn-default btn-sm btn-fullscreen" tabindex="-1" title="" data-original-title="Full Screen"><i class="note-icon-arrows-alt"></i></button><button type="button" class="note-btn btn btn-default btn-sm btn-codeview" tabindex="-1" title="" data-original-title="Code View"><i class="note-icon-code"></i></button><button type="button" class="note-btn btn btn-default btn-sm" tabindex="-1" title="" data-original-title="Help"><i class="note-icon-question"></i></button></div></div><div class="note-editing-area"><div class="note-handle"><div class="note-control-selection"><div class="note-control-selection-bg"></div><div class="note-control-holder note-control-nw"></div><div class="note-control-holder note-control-ne"></div><div class="note-control-holder note-control-sw"></div><div class="note-control-sizing note-control-se"></div><div class="note-control-selection-info"></div></div></div><textarea class="note-codable"></textarea><div class="note-editable panel-body" contenteditable="true">
                                                        <h3>Lorem Ipsum is simply</h3>
                                                        dummy text of the printing and typesetting industry. <strong>Lorem Ipsum has been the industry's</strong> standard dummy text ever since the 1500s,
                                                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                                                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                                                        typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with
                                                        <br>

                                                    </div></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">Meta Tag Title:</label>
                                                <div class="col-sm-10"><input type="text" class="form-control" placeholder="..."></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">Meta Tag Description:</label>
                                                <div class="col-sm-10"><input type="text" class="form-control" placeholder="Sheets containing Lorem"></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">Meta Tag Keywords:</label>
                                                <div class="col-sm-10"><input type="text" class="form-control" placeholder="Lorem, Ipsum, has, been"></div>
                                            </div>
                                        </fieldset>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
				
			</div><!-- myCtrl -->
			<!--/ content -->           
			<div class="footer">
			<?php include 'footer.php'; ?>
			</div>
	</div><!--  end page-wrapper -->
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
