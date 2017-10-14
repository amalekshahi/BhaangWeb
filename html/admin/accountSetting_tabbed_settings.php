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
					<div class="row wrapper border-bottom white-bg page-heading" >
						<div class="col-lg-10">
							<h2>Account Settings</h2>
							<ol class="breadcrumb">
								<li><a href="welcome.html">Home</a></li>
								<li><strong><a>Settings</a></strong></li>                    
							</ol>
						</div>
						<div class="col-lg-2"></div>
					</div>
					<div class="row">
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
											</ul> -->
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
													<!-- <input type="text" ng-model="userinfo.username"> -->
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
						</div><!-- row -->
				
				<div class="row">
		<form action="dv.php?page=myProfileSettings&action=submit" class="form-horizontal" method="post">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="tabs-container">
						<div class="tabs-left">
							<ul class="nav nav-tabs">
								<li class="active">
									<a data-toggle="tab" href="#tab-your-company"><i class="fa fa-building" aria-hidden="true"></i> Global Settings for <?php echo $accountName;?></a>
								</li>
								<li class="">
									<a data-toggle="tab" href="#tab-you"><i class="fa fa-user-o" aria-hidden="true"></i> Settings for <?php echo $USERNAME;?></a>
								</li>
								<li class="">
									<a data-toggle="tab" href="#tab-tracking-code">Tracking Code</a>
								</li>
								<!--
								<li class="">
									<a data-toggle="tab" href="#tab-5">Sender Addresses</a>
								</li>-->
								<li class="">
									<a data-toggle="tab" href="#tab-3rd-party-products"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Integrations</a>
								</li>
								<li class="">
									<a data-toggle="tab" href="#tab-grading-and-scoring">Grading & Scoring</a>
								</li>
								<li class="">
									<a data-toggle="tab" href="#tab-grading-and-scoring"><i class="fa fa-credit-card" aria-hidden="true"></i> Billing</a>
								</li>								
							</ul>
							<div class="tab-content">
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
										
									<div><h2>Marketing Settings</h2></div>
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
-->
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
										
										
									</div>
									
								</div>
								<div class="tab-pane" id="tab-you">
									<div class="panel-body">
										<p></p>
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
										
									</div>
								</div>
								<div class="tab-pane" id="tab-3rd-party-products">
									<div class="panel-body">
										<p><label><i class="fa fa-google" aria-hidden="true" style="color:red"></i> Google Analytics Tracking Code</label><input class="form-control" name="google_tracking_code" placeholder="UA-83447148-1" type="text" value="{{google_tracking_code}}"><small>To find your tracking ID, sign in to your Analytics account, click Admin, select an account from the menua in the ACCOUNT column, and select a property.  Under PROPERTY, click Tracking Info > Tracking Code.</small> </p>
										<p><label><i class="fa fa-facebook-official" aria-hidden="true" style="color:blue"></i> Facebook Pixel ID</label><input class="form-control" name="facebook_pixel_id" placeholder="120261521652622" type="text" value="{{facebook_pixel_id}}"><small>Find your Pixel ID by going to your Ads Manager, going to the pixel section and looking under the Pixel Name. To learn more about the Facebook Pixel, <a href="https://www.facebook.com/business/help/952192354843755/?ref=u2u">please visit this link from Facebook's Help Center</a>.</small></p>
    									<p>&nbsp;</p>
    									<input name="action" type="hidden" value="saveProfileSettings"> <button class="btn btn-primary" type="submit">Save</button> <button class="btn btn-white" type="submit">Cancel</button>
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
