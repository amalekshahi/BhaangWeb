<?php
date_default_timezone_set('America/Los_Angeles');
session_start();
include 'global.php';
require_once('loginCredentials.php');
?>

<!doctype html>
<html ng-app="myApp">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Template</title>
	<link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

	<link href="css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

	<link href="css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
	<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">

	<link rel="stylesheet" href="https://websemantics.github.io/Image-Select/src/chosen/chosen.css">
    <link rel="stylesheet" href="https://websemantics.github.io/Image-Select/src/ImageSelect.css">

	<!-- x-editable (bootstrap version) -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"/>

	<!-- Angular -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/angular-xeditable/0.8.0/css/xeditable.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-xeditable/0.8.0/js/xeditable.min.js"></script>

	<style class="cp-pen-styles">
	   /*@charset "UTF-8";*/
	   /* 2015 Johannes Jakob
	     Made with <3 in Germany */

	   .window {
	    background: #fff;
	    width: 700px;
	    margin: auto;
	    margin-top: .5vh;
	    border: 1px solid #acacac;
	    border-radius: 6px;
	    box-shadow: 0px 0px 20px #acacac;
	   }

	   .titlebar {
	    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, #ebebeb, color-stop(1, #d5d5d5)));
	    background: -webkit-linear-gradient(top, #ebebeb, #d5d5d5);
	    background: -moz-linear-gradient(top, #ebebeb, #d5d5d5);
	    background: -ms-linear-gradient(top, #ebebeb, #d5d5d5);
	    background: -o-linear-gradient(top, #ebebeb, #d5d5d5);
	    background: linear-gradient(top, #ebebeb, #d5d5d5);
	    color: #4d494d;
	    font-size: 11pt;
	    line-height: 20px;
	    text-align: center;
	    width: 100%;
	    height: 20px;
	    border-top: 1px solid #f3f1f3;
	    border-bottom: 1px solid #b1aeb1;
	    border-top-left-radius: 6px;
	    border-top-right-radius: 6px;
	    user-select: none;
	    -webkit-user-select: none;
	    -moz-user-select: none;
	    -ms-user-select: none;
	    -o-user-select: none;
	    cursor: default;
	   }

	   .buttons {
	    padding-left: 8px;
	    padding-top: 3px;
	    float: left;
	    line-height: 0px;
	   }

	   .buttons:hover a {
	    visibility: visible;
	   }

	   .close {
	    background: #ff5c5c;
	    font-size: 9pt;
	    width: 11px;
	    height: 11px;
	    border: 1px solid #e33e41;
	    border-radius: 50%;
	    display: inline-block;
	   }

	   .close:active {
	    background: #c14645;
	    border: 1px solid #b03537;
	   }

	   .close:active .closebutton {
	    color: #4e0002;
	   }

	   .closebutton {
	    color: #820005;
	    visibility: hidden;
	    cursor: default;
	   }

	   .minimize {
	    background: #ffbd4c;
	    font-size: 9pt;
	    line-height: 11px;
	    margin-left: 4px;
	    width: 11px;
	    height: 11px;
	    border: 1px solid #e09e3e;
	    border-radius: 50%;
	    display: inline-block;
	   }

	   .minimize:active {
	    background: #c08e38;
	    border: 1px solid #af7c33;
	   }

	   .minimize:active .minimizebutton {
	    color: #5a2607;
	   }

	   .minimizebutton {
	    color: #9a5518;
	    visibility: hidden;
	    cursor: default;
	   }

	   .zoom {
	    background: #00ca56;
	    font-size: 9pt;
	    line-height: 11px;
	    margin-right: 4px;
	    width: 11px;
	    height: 11px;
	    border: 1px solid #14ae46;
	    border-radius: 50%;
	    display: inline-block;
	   }

	   .zoom:active {
	    background: #029740;
	    border: 1px solid #128435;
	   }

	   .zoom:active .zoombutton {
	    color: #003107;
	   }

	   .zoombutton {
	    color: #006519;
	    visibility: hidden;
	    cursor: default;
	   }

	   .content {
	    padding: 10px;
	   }

	   /* window END */
	   /* content BEGIN */
	   h3 {
	    margin-top: 0px;
	   }

	   /* content END */

	   .hover {
	      border: 2px solid transparent;
	   }

	   .hover:hover {
	        text-shadow: 2px 2px 20px red;
	        border: 2px dashed red;
	   }

	</style>
</head>
<body class="">
    <div id="wrapper">
	<!-- left wrapper -->
	<div w3-include-html="leftWrapper.html"></div>
	<!-- /end left wrapper -->
	<div id="page-wrapper" class="gray-bg" ng-controller="myCtrl">
		<div class="row border-bottom">
				 <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
				<!-- top wrapper -->
				<div w3-include-html="topWrapper.html"></div>
				<!-- / top wrapper -->
				</nav>
		</div>	
		
<!-- content -->
	<div class="row">
		<div class="col-lg-12">
			<div class="widget style1 blue-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-bullhorn fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Promote a Blog Post </span> 
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
													<span class="badge" ng-if="campaign['URL-BLOG-POST-URL']===undefined || campaign['URL-BLOG-POST-URL']==''">1</span>
													<i aria-hidden="true" class="fa fa-check-circle fa-lg" style="color:green" ng-if="campaign['URL-BLOG-POST-URL']!==undefined && campaign['URL-BLOG-POST-URL']!=''"></i>
													&nbsp;Identify the Targeted Blog Post &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<small class="m-l-sm"><i aria-hidden="true" class="fa fa-crosshairs fa-lg"></i> {{campaign['URL-BLOG-POST-URL']}}</small>
												</a></h4>
											</div>
											<div class="panel-collapse collapse" id="collapseOne">
												<div class="panel-body">
													<div class="ibox-content">
														<form class="form-horizontal">
															<div class="form-group">
																<label class="col-sm-2 control-label">Blog Post URL</label>
																<div class="col-sm-10">
																	<input class="form-control" name="URL-BLOG-POST-URL" placeholder="http://www.you-blog-post.com/page.html" type="text" ng-model="campaign['URL-BLOG-POST-URL']"><span class="help-block m-b-none">Enter the URL to the post you wish to promote. We'll use this link in your emails.</span>
																</div>
															</div>
															<div class="hr-line-dashed"></div>
															<div class="alert alert-success" role="alert">
																<h3><i aria-hidden="true" class="fa fa-lightbulb-o"></i> OPTIONAL: Track Conversions Generated By This Post</h3>Mr. Da Vinci recommends that within your Blog Post you have at least one Call to Action (CTA). Your CTA turns passive visitors into engaged Leads. If you have a CTA within your blog post, add it below. This enables Da Vinci to track the number of conversions generated by this Post.
																<p></p>
															</div>
															<div class="form-group">
																<label class="col-sm-2 control-label">Conversion URL</label>
																<div class="col-sm-2">
																	<select class="form-control m-b" name="CONVERSION-URL-MATCHING-RULE" ng-model="campaign['CONVERSION-URL-MATCHING-RULE']">
																		<option value="Contains">
																			Contains
																		</option>
																		<option value="StartsWith">
																			Starts With
																		</option>
																		<option value="Exact">
																			Exact
																		</option>
																	</select>
																</div>
																<div class="col-sm-8">
																	<input class="form-control" name="CONVERSION-URL" placeholder="/blog/success.html" type="text" ng-model="campaign['CONVERSION-URL']"><span class="help-block m-b-none">Enter the full URL of the destination page where you want to count a visit as a conversion event; for example, the 'Thank You' page someone arrives at after filling out a form. We recommend excluding 'http' or 'https'. Only include 'www' if 'www' appears in your URL as visitors would see it when they come to your page</span>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-2 control-label">Conversion Name</label>
																<div class="col-sm-10">
																	<input class="form-control" name="CONVERSION-NAME" placeholder="Describe your list for easy future reference" type="text" ng-model="campaign['CONVERSION-NAME']"><span class="help-block m-b-none">Give your conversion action a name. Conversions are steps that a person takes on your site that you would like to track such as visits, sign ups or downloads.</span>
																</div>
															</div>
															<div class="hr-line-dashed"></div>
															<div class="form-group">
																<div class="col-sm-4 col-sm-offset-2">
																	<!--<input type="hidden" name="programNameHash" value="{{programNameHash}}">-->
																	<input name="programNameHash" type="hidden" value="{{programNameHash}}"> <button class="btn btn-primary" ng-click="Save()">Save</button> <button class="btn btn-white" type="submit">Cancel</button>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseTwo"><span class="badge">2</span> &nbsp;Write Your Email Sequence &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small class="m-l-sm"> <i class="fa fa-envelope-o" aria-hidden="true"></i> 2 of 3 emails ready</small></a></h4>
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
																				<a data-toggle="tab" href="#tab-1">Email #1: Sent to Everyone You're Targeting</a>
																			</li>
																			<li class="">
																				<a data-toggle="tab" href="#tab-2">Email #2: Sent to Non-Openers</a>
																			</li>
																			<li class="">
																				<a data-toggle="tab" href="#tab-3">Email #3: Sent to Non-Clickers</a>
																			</li>
																		</ul>
																		<div class="tab-content">
																			<div class="tab-pane active" id="tab-1">
																				<div class="mail-box-header">
																					<div class="pull-right tooltip-demo">
																						<a class="btn btn-white" data-placement="top" data-toggle="tooltip" href="mailbox.html" title="Leave without saving"><i class="fa fa-ban"></i> Cancel</a> <button class="btn btn-primary" ng-click="Save()"><i class="fa fa-floppy-o"></i> Save Email</button>
																					</div>
																					<h3>Subject: <a data-pk="2" data-title="Email Name" data-type="text" data-url="" href="#" id="email_subject"><span ng-bind="campaign['TEXT-LINE-ACCTID-PROGRAMID-EMAIL1SUBJECT']">[NEW POST] How To XYZ Without ABC</span></a></h3>
																				</div>	
																				
																				<div class="row">
																					<div class="col-lg-4">
																						<div class="ibox-content">
																							<div class="ibox-content">
																								<form action="" class="form-horizontal" method="post" onsubmit="return postForm()">
																									<div class="form-group">
																										<div class="col-sm-12">
																													<div>Select who you want this email to come from.  Once you've picked a template, roll over the various text blocks in the email template to see what you can edit.</div>
																													<label class="control-label">From</label> 
																													<select name="EMAIL-{{email_number}}-from_address" class="chosen-select" data-placeholder="Choose a sender (replies go here too)" tabindex="1">
																														<option value="">
																															Choose a sender (replies go here too)
																														</option>
																														<option value="david_rosendahl">
																															David Rosendahl (daver@mindfireinc.com)
																														</option>
																														<option value="mackenzi_farsheed">
																															Mackenzi Farsheed (mcfarsheed@mindfireinc.com)
																														</option> 
																													</select>
																												</div>
																											</div>
																											<div class="form-group">
																												<div class="col-sm-12">
																													<label class="control-label">Template</label> 
																													<select class="chosen-select" data-target=".template_preview" id="template" tabindex="2" name="EMAIL-{{email_number}}-template">
																													<option data-show=".Pick" value="Pick">
																															Pick a template...
																														</option>
																														<option data-show=".Plain" value="Plain">
																															Plain: Looks manual & handwritten
																														</option>
																														<option data-show=".Company_Email" value="Company_Email">
																															Company Email: Your company logo, call to action button, and address in footer
																														</option>
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
																									</div><small>New Email from: "Mackenzi Farsheed @ MindFire" &lt;mcfarsheed@mindfireinc.com&gt;</small> <!-- window title -->
																								</div>
																								<div class="content">
																									<div class="template_preview">
																										<div class="Pick">
																											<p></p>
																											<p>Your email preview will display here after you select a template.</p>
																											<p></p>
																										</div>
																										<div class="Plain">
																											{{PLAIN-EMAIL}}
																										</div>
																										<div class="Company_Email" id="Company_Email">
																											
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="tab-pane" id="tab-2">
																				<div class="panel-body">
																					<h2>By adding a second email to non-openers, you'll increase engagement rates by an average of 24%.</h2>
																					<p><button type="button" class="btn btn-primary btn-lg">Create Email Using #1's Content</button>
                            														<button type="button" class="btn btn-default btn-lg">Start With a Blank Email</button></p>
																				</div>
																			</div>
																			<div class="tab-pane" id="tab-3">
																				<div class="panel-body">
																					<h2>By adding a third email to non-clickers, you'll increase engagement rates by an average of 14%.</h2>
																					<p><button type="button" class="btn btn-primary btn-lg">Create Email Using #2's Content</button>
                            														<button type="button" class="btn btn-default btn-lg">Start With a Blank Email</button></p>
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
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseThree"><span class="badge">3</span> &nbsp;Choose Your Audience & Schedule <small class="m-l-sm"> <i class="fa fa-dot-circle-o" aria-hidden="true"></i> Scheduled for Wednesday August 22, 2017 at 3:00 PM</small></a></h4>
											</div>
											<div class="panel-collapse collapse" id="collapseThree">
												<div class="panel-body">
													<div class="ibox float-e-margins">
														<div class="ibox-content">
														<form action="" class="form-horizontal" method="post">
														<div class="form-group">
							<label class="col-sm-2 control-label">Choose Your Audience</label>
							<div class="col-sm-10">
								<div>
									<select class="chosen-select" data-placeholder="Choose a List..." multiple style="width:350px;" tabindex="4">
										<option value="">
											Select
										</option>
										<option value="All Printers from SalesForce (3,512)">
											All Printers from SalesForce (3,512)
										</option>
										<option value="All Leads imported from scanned (713)">
											All Leads imported from scanned (713)
										</option>
										<option value="Existing Clients (3,412)">
											Existing Clients (3,412)
										</option>
										<option value="Mary and Joe Opps from this month (442)">
											Mary and Joe Opps from this month (442)
										</option>
									</select> <span class="help-block m-b-none">Who are you sending to? Pick your targets for this sequence.</span>
								</div>
								<div>
									<p></p>
								</div>
									
							</div>
							</form>
							<div class="row">
								<div class="col-lg-12">
									<div class="wrapper wrapper-content animated fadeInUp">
										<div class="ibox">
											<div class="ibox-title">
												<h5><i aria-hidden="true" class="fa fa-calendar"></i> Schedule</h5>
											</div>
											<div class="project-list">
												<table class="table table-hover">

												<input type="hidden" class="form-control" id="EMAIL1-SCHEDULE1-DATETIME" name="EMAIL1-SCHEDULE1-DATETIME" placeholder="" type="text" ng-model="campaign['EMAIL1-SCHEDULE1-DATETIME']">

												<input type="hidden" class="form-control" id="EMAIL2-SCHEDULE1-DATETIME" name="EMAIL2-SCHEDULE1-DATETIME" placeholder="" type="text" ng-model="campaign['EMAIL2-SCHEDULE1-DATETIME']">

												<input type="hidden" class="form-control" id="EMAIL3-SCHEDULE1-DATETIME" name="EMAIL3-SCHEDULE1-DATETIME" placeholder="" type="text" ng-model="campaign['EMAIL3-SCHEDULE1-DATETIME']">

													<tbody>
														<tr>
															
															<td class="project-title">
																<button class="btn btn-primary btn-lg" type="button"><span aria-hidden="true" class="fa fa-envelope-o"></span> Email #1</button>
															</td>
															<td class="project-title">
																<strong>Targeting: All Your Primary Targets</strong><br>
																<small>This email is sent to everyone you specify in the above Targeting section.</small>
															</td>
															<td class="project-title">
																<form class="form-inline" role="form">
																	<div class="form-group">
																		<!-- <label for="wait2"><i aria-hidden="true" class="fa fa-clock-o fa-lg"></i> Scheduled for Wednesday August 22, 2017</label>
																		<small>@ 3:30 PM PST</small><br> 													 -->

																		<label for="wait2"><i aria-hidden="true" class="fa fa-clock-o fa-lg"></i> Scheduled for</label><br> 
																		

																		<div class="input-group date">
															                <input type="datetime" class="form-control" date-time ng-model="campaign['EMAIL1-SCHEDULE1-DATE']" view="date" auto-close="true" min-view="date" format="MM/DD/YYYY" id="EMAIL1-SCHEDULE1-DATE" name="EMAIL1-SCHEDULE1-DATE">
															                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
															            </div>

																		<div class="input-group clockpicker" clock-picker data-autoclose="true">
																			<input type="text" class="form-control" id="EMAIL1-SCHEDULE1-TIME" name="EMAIL1-SCHEDULE1-TIME" placeholder="" type="text" ng-model="campaign['EMAIL1-SCHEDULE1-TIME']">
																			<span class="input-group-addon">
																				<span class="fa fa-clock-o"></span>
																			</span>
																		</div>

																		<select class="form-control m-b" id="EMAIL1-SCHEDULE1-TIMEZONE" name="EMAIL1-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL1-SCHEDULE1-TIMEZONE']">
																			<option value="Pacific Standard Time" >PST</option> 
																			<option value="Mountain Standard Time">MST</option> 
																			<option value="Central America Standard Time">CST</option> 
																			<option value="Eastern Standard Time">EST</option>
																		</select>
																	</div>
																	</form>
															</td>
															
														</tr>
														<tr>
															
															<td class="project-status">
																<button class="btn btn-primary btn-lg" type="button"><span aria-hidden="true" class="fa fa-envelope-o"></span> </i>Email #2</button>
															</td>
															<td class="project-title">
																<strong>Targeting: Non-Opens</strong><br>
																<small>This email is sent to everyone who did not open.</small>
															</td>
															<td class="project-title">
																<form class="form-inline" role="form">
																	<div class="form-group">
																		<label for="wait"><i aria-hidden="true" class="fa fa-pause"></i> Wait</label>
																		<input class="touchspin2 form-control input-sm" id="EMAIL2-WAIT" name="EMAIL2-WAIT" type="text" value="4" ng-model="campaign['EMAIL2-WAIT']" style="width:50px; text-align: center""> <strong>days</strong> <small>and send @ </small> 
																		

																		<div class="input-group clockpicker" clock-picker data-autoclose="true">
																			<input type="text" class="form-control" id="EMAIL2-SCHEDULE1-TIME" name="EMAIL2-SCHEDULE1-TIME" placeholder="" type="text" ng-model="campaign['EMAIL2-SCHEDULE1-TIME']">
																			<span class="input-group-addon">
																				<span class="fa fa-clock-o"></span>
																			</span>
																		</div>
																		<select class="form-control m-b" id="EMAIL2-SCHEDULE1-TIMEZONE" name="EMAIL2-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL2-SCHEDULE1-TIMEZONE']">
																			<option value="Pacific Standard Time" >PST</option> 
																			<option value="Mountain Standard Time">MST</option> 
																			<option value="Central America Standard Time">CST</option> 
																			<option value="Eastern Standard Time">EST</option>
																		</select>
																	</div>
																	</form>
															</td>
															
														</tr>
														<tr>
															
															<td class="project-status">
																<button class="btn btn-primary btn-lg" type="button"><span aria-hidden="true" class="fa fa-envelope-o"></span> Email #3</button>
															</td>
															<td class="project-title">
																<strong>Targeting: Non-Clickers</strong><br>
																<small>This email is sent to everyone you who opened but did not click.</small>
															</td>
															<td class="project-title">
																<form class="form-inline" role="form">
																	<div class="form-group">
																		<label for="wait3"><i aria-hidden="true" class="fa fa-pause"></i> Wait</label>
																		<input class="touchspin2 form-control input-sm" id="EMAIL3-WAIT" name="EMAIL3-WAIT" type="text" value="4" ng-model="campaign['EMAIL3-WAIT']" style="width:50px; text-align: center"> <strong>days</strong> <small>and send @ </small> 


																		<div class="input-group clockpicker" clock-picker data-autoclose="true">
																			<input type="text" class="form-control" id="EMAIL3-SCHEDULE1-TIME" name="EMAIL3-SCHEDULE1-TIME" placeholder="" type="text" ng-model="campaign['EMAIL3-SCHEDULE1-TIME']">
																			<span class="input-group-addon">
																				<span class="fa fa-clock-o"></span>
																			</span>
																		</div>
																		<select class="form-control m-b" id="EMAIL3-SCHEDULE1-TIMEZONE" name="EMAIL3-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL3-SCHEDULE1-TIMEZONE']">
																			<option value="Pacific Standard Time" >PST</option> 
																			<option value="Mountain Standard Time">MST</option> 
																			<option value="Central America Standard Time">CST</option> 
																			<option value="Eastern Standard Time">EST</option>
																		</select>
																	</div>
																	</form>
															</td>
															
														</tr>
														
													</tbody>
												</table>
												
											</div>
											
										</div>
									</div>
								</div>
							</div>
							<label class="col-sm-2 control-label"></label>
							<div class="col-sm-10"><input name="programNameHash" type="hidden" value="{{programNameHash}}"> <button class="btn btn-primary" ng-click="Save('Schedule')">Save</button> <button class="btn btn-white" type="submit">Cancel</button></div>
						</div>
															
															
															
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseFour"><span class="badge">4</span> &nbsp;Configure Notifications & Alerts &nbsp;&nbsp;&nbsp;&nbsp;<small class="m-l-sm"> <i class="fa fa-bell-o" aria-hidden="true"></i> Alerted on Clicks, Opens, and Conversions</small></a></h4>
											</div>
											<div class="panel-collapse collapse" id="collapseFour">
												<div class="panel-body">
													<div class="ibox float-e-margins">
														<div class="ibox-content">
															<form action="" class="form-horizontal" method="post">
															<div class="form-group">
																<label class="col-sm-2 control-label">Notify me when people:</label>
																<div class="col-sm-10">
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-2 control-label">Open my Emails</label>
																<div class="col-sm-10">
																	<input checked class="js-switch" type="checkbox">
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-2 control-label">Visit my Blog Post</label>
																<div class="col-sm-10">
																	<input checked class="js-switch_2" type="checkbox">
																</div>
															</div>

															<div class="form-group">
																<label class="col-sm-2 control-label">Complete my Call-to-Action</label>
																<div class="col-sm-10">
																	<input checked class="js-switch_3" type="checkbox">
																</div>
															</div>

																<!-- Team, no save button required.  Let's take the user's input and persist it without requiring them to hit save -->
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
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><i aria-hidden="true" class="fa fa-bar-chart" style="color:black"></i> Performance Snapshot</h5>
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
			<div class="footer">
				<!-- footer -->
				<div w3-include-html="footer.html"></div>
				<!-- / footer -->			
			</div>
		</div><!--  end page-wrapper -->
</div>

    <!-- Mainly scripts -->
	<script src="js/w3data.js"></script>	
	<script>w3IncludeHTML();</script>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

	<script type="text/JavaScript" src="global.js?n=1"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>
	<script src="js/davinci.js"></script>

	<!-- SUMMERNOTE -->
	<script src="js/plugins/summernote/summernote.min.js"></script>

	<!-- Chosen -->
	<script src="js/plugins/chosen/chosen.jquery.js"></script>

	<!-- X-editable -->
	<script src="js/plugins/bootstrap-editable/boostrap-editable.js"></script>

	<!-- Clipboard -->
	<script src="js/plugins/clipboard/clipboard.min.js"></script>
	
	<!-- clockpicker -->
	<script src="js/plugins/clockpicker/clockpicker.js"></script>

	<!-- datepicker -->
	<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Page-Level Scripts -->
	<script src="js/jquery.md5.js"></script>
    <script>
		var action = getParameterByName("action");
		var campaignName = getParameterByName("campaign_name");
		var campaignID = getParameterByName("campaign_id");
		if (action=="newCampaign") {
			var keyword = campaignName+getCurrentDateTime();
			campaignID = $.md5(keyword);
		}

		$.fn.editable.defaults.mode = 'inline';
		$.fn.editableform.buttons  = 
        '<button type="button" class="btn btn-primary btn-sm editable-submit"><i class="glyphicon glyphicon-ok"></i></button>'+
        '<button type="button" class="btn btn-default btn-sm editable-cancel"><i class="glyphicon glyphicon-remove"></i></button>'+
        '<button type="button" class="btn btn-default btn-sm editable-off"><i class="glyphicon glyphicon-trash"></i></button>';
		
		$(document).on('change', '#template', function() {
			var target = $(this).data('target');
			var show = $("option:selected", this).data('show');
			$(target).children().addClass('hide');
			$(show).removeClass('hide');
		});

        $(document).ready(function() {
			$('#email_name').editable();
			$('#email_subject').editable();
			
			$('#template').trigger('change');
		
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

			$('.clockpicker').clockpicker( {
				twelvehour: false
			} );

			$( "#EMAIL1-SCHEDULE1-DATE" ).datepicker();


        });

		var accountProfile = {
			"firstname" : "John",
			"lastname" : "Sample",
			"username" : "johnsample",
			"email" : "johnsample@example.com",
			"pass" : "password",
		};
		var myApp = angular.module('myApp', ["xeditable"]);
		myApp.controller('myCtrl',function($scope,$http) {
			$scope.Save = function(mode) {

				
				$scope.campaign['PABP-EML1-HTMLBODY'] = $("#BodyHtml").summernote("code");
				$scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL1CONTENT'] = $("#Company_Email").html();

				
				var EMAIL2SCHEDULE1TIME = $("#EMAIL2-SCHEDULE1-TIME").val();
				var EMAIL3SCHEDULE1TIME = $("#EMAIL3-SCHEDULE1-TIME").val();

				var EMAIL1SCHEDULE1TIME = $("#EMAIL1-SCHEDULE1-TIME").val();
				var EMAIL1SCHEDULE1DATE = $("#EMAIL1-SCHEDULE1-DATE").val();
				
				
				var EMAIL1SCHEDULE1DATETIME = "";
				var EMAIL2SCHEDULE1DATETIME = "";
				var EMAIL3SCHEDULE1DATETIME = "";

				var EMAIL2WAIT = $("#EMAIL2-WAIT").val();
				var EMAIL3WAIT = $("#EMAIL3-WAIT").val();

				var EMAIL1SCHEDULE1TIMEZONE = $("#EMAIL1-SCHEDULE1-TIMEZONE").val();
				var EMAIL2SCHEDULE1TIMEZONE = $("#EMAIL2-SCHEDULE1-TIMEZONE").val();
				var EMAIL3SCHEDULE1TIMEZONE = $("#EMAIL3-SCHEDULE1-TIMEZONE").val();

				$scope.campaign['EMAIL2-WAIT'] = EMAIL2WAIT;
				$scope.campaign['EMAIL3-WAIT'] = EMAIL3WAIT;

				$scope.campaign['EMAIL1-SCHEDULE1-TIMEZONE'] = EMAIL1SCHEDULE1TIMEZONE;
				$scope.campaign['EMAIL2-SCHEDULE1-TIMEZONE'] = EMAIL2SCHEDULE1TIMEZONE;
				$scope.campaign['EMAIL3-SCHEDULE1-TIMEZONE'] = EMAIL3SCHEDULE1TIMEZONE;

				$scope.campaign['EMAIL2-SCHEDULE1-TIME'] = EMAIL2SCHEDULE1TIME;
				$scope.campaign['EMAIL3-SCHEDULE1-TIME'] = EMAIL3SCHEDULE1TIME;

				$scope.campaign['EMAIL1-SCHEDULE1-DATE'] = EMAIL1SCHEDULE1DATE;
				$scope.campaign['EMAIL1-SCHEDULE1-TIME'] = EMAIL1SCHEDULE1TIME;

				EMAIL1SCHEDULE1 = EMAIL1SCHEDULE1DATE+' '+convertTime(EMAIL1SCHEDULE1TIME);

				if (mode == 'Schedule') {
					EMAIL1SCHEDULE1DATETIME = EMAIL1SCHEDULE1;
					//alert('EMAIL1-SCHEDULE1-DATETIME = '+EMAIL1SCHEDULE1DATETIME);

					date1 = toDate(EMAIL1SCHEDULE1);
					numberOfDaysToAdd = parseInt(EMAIL2WAIT);
					date2 = addDays(date1, numberOfDaysToAdd);
					EMAIL2SCHEDULE1DATETIME = formatDate(date2)+' '+convertTime(EMAIL2SCHEDULE1TIME);

					//alert('EMAIL2-SCHEDULE1-DATETIME = '+EMAIL2SCHEDULE1DATETIME);

					numberOfDaysToAdd = parseInt(EMAIL3WAIT);
					date3 = addDays(date2, numberOfDaysToAdd);
					EMAIL3SCHEDULE1DATETIME = formatDate(date3)+' '+convertTime(EMAIL3SCHEDULE1TIME);				

					//alert('EMAIL3-SCHEDULE1-DATETIME = '+EMAIL3SCHEDULE1DATETIME);

				}
				
				$scope.campaign['EMAIL1-SCHEDULE1-DATETIME'] = EMAIL1SCHEDULE1DATETIME;
				$scope.campaign['EMAIL2-SCHEDULE1-DATETIME'] = EMAIL2SCHEDULE1DATETIME;
				$scope.campaign['EMAIL3-SCHEDULE1-DATETIME'] = EMAIL3SCHEDULE1DATETIME;
			

				$http.put('/couchdb/' + accountProfile.username +'/'+campaignID, $scope.campaign).then(function(response){
					var currentDate = getCurrentDateTime();

					if (action=="newCampaign") {
						$scope.campaignlist.items.push({"campaignID":$scope.campaign.campaignID,"accountID":"","campaignName":$scope.campaign.campaignName,"createDate":currentDate,"lastEditDate":currentDate,"status":"Edit","campaignType":$scope.campaign.campaignType,"EMAIL1-SCHEDULE1-DATE":$scope.campaign.EMAIL1-SCHEDULE1-DATE,"EMAIL1-SCHEDULE1-TIME":$scope.campaign.EMAIL1-SCHEDULE1-TIME,"EMAIL2-SCHEDULE1-TIME":$scope.campaign.EMAIL2-SCHEDULE1-TIME,"EMAIL3-SCHEDULE1-TIME":$scope.campaign.EMAIL3-SCHEDULE1-TIME,"EMAIL2-WAIT":$scope.campaign.EMAIL2-WAIT,"EMAIL3-WAIT":$scope.campaign.EMAIL3-WAIT,"EMAIL1-SCHEDULE1-DATETIME":$scope.campaign.EMAIL1-SCHEDULE1-DATETIME,"EMAIL2-SCHEDULE1-DATETIME":$scope.campaign.EMAIL2-SCHEDULE1-DATETIME,"EMAIL3-SCHEDULE1-DATETIME":$scope.campaign.EMAIL3-SCHEDULE1-DATETIME,"EMAIL1-SCHEDULE1-TIMEZONE":$scope.campaign.EMAIL1-SCHEDULE1-TIMEZONE,"EMAIL2-SCHEDULE1-TIMEZONE":$scope.campaign.EMAIL2-SCHEDULE1-TIMEZONE,"EMAIL3-SCHEDULE1-TIMEZONE":$scope.campaign.EMAIL3-SCHEDULE1-TIMEZONE});
					} else{
						$scope.campaignlist.items[$scope.listIndex()].LastEditDate = currentDate;
						$scope.campaignlist.items[$scope.listIndex()].CampaignType = $scope.campaign.campaignType;
					}
					$http.put('/couchdb/' + accountProfile.username +'/campaignlist', $scope.campaignlist).then(function(response){
						alert("Save Campaign Successful.");
					});
				});
			};
			$scope.Reset = function() {
                  $scope.campaign  = angular.copy($scope.master);
				  $("#BodyHtml").summernote('pasteHTML', $scope.campaign['PABP-EML1-HTMLBODY']);
				  $("#Company_Email").html($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL1CONTENT']);
					
					$("#EMAIL1-SCHEDULE1-DATE").val($scope.campaign['EMAIL1-SCHEDULE1-DATE']);
					$("#EMAIL1-SCHEDULE1-TIME").val($scope.campaign['EMAIL1-SCHEDULE1-TIME']);

					$("#EMAIL2-SCHEDULE1-TIME").val($scope.campaign['EMAIL2-SCHEDULE1-TIME']);
					$("#EMAIL3-SCHEDULE1-TIME").val($scope.campaign['EMAIL3-SCHEDULE1-TIME']);

					$("#EMAIL1-SCHEDULE1-DATETIME").val($scope.campaign['EMAIL1-SCHEDULE1-DATETIME']);
					$("#EMAIL2-SCHEDULE1-DATETIME").val($scope.campaign['EMAIL2-SCHEDULE1-DATETIME']);
					$("#EMAIL3-SCHEDULE1-DATETIME").val($scope.campaign['EMAIL3-SCHEDULE1-DATETIME']);

					$("#EMAIL2-WAIT").val($scope.campaign['EMAIL2-WAIT']);
					$("#EMAIL3-WAIT").val($scope.campaign['EMAIL3-WAIT']);

					$("#EMAIL1-SCHEDULE1-TIMEZONE").val($scope.campaign['EMAIL1-SCHEDULE1-TIMEZONE']);
					$("#EMAIL2-SCHEDULE1-TIMEZONE").val($scope.campaign['EMAIL2-SCHEDULE1-TIMEZONE']);
					$("#EMAIL3-SCHEDULE1-TIMEZONE").val($scope.campaign['EMAIL3-SCHEDULE1-TIMEZONE']);

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
            };
			$scope.Load = function() {
				$http.get("/couchdb/" + accountProfile.username +'/campaignlist').then(function(response) {
                     $scope.campaignlist  = response.data; 
                });
                $http.get("/couchdb/" + accountProfile.username +'/'+campaignID).then(function(response) {
					$scope.master  = response.data; 
					$scope.Reset();
                },function(errResponse){
					if (errResponse.status == 404) {
						$scope.campaign = {"campaignID":campaignID,"campaignName":campaignName,"campaignType":"PromoteBlog","accountID":"","publishProgramName":"","publishDate":"","EMAIL1-SCHEDULE1-DATE":"","EMAIL1-SCHEDULE1-TIME":"","EMAIL2-SCHEDULE1-TIME":"","EMAIL3-SCHEDULE1-TIME":"","EMAIL2-WAIT":"","EMAIL3-WAIT":"","EMAIL1-SCHEDULE1-DATETIME":"","EMAIL2-SCHEDULE1-DATETIME":"","EMAIL3-SCHEDULE1-DATETIME":"","EMAIL1-SCHEDULE1-TIMEZONE":"","EMAIL2-SCHEDULE1-TIMEZONE":"","EMAIL3-SCHEDULE1-TIMEZONE":""};
					} else {
						alert(errResponse.statusText);
					}
					
				});
            };
			$scope.listIndex = function() {
				var cplist = 	$scope.campaignlist.items;
				for(var i=0;i < cplist.length; i++){
				  if (cplist[i]["campaignID"] == campaignID)
				  {
					return i;
				  } 
				}
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
    </script>



</body>

</html>