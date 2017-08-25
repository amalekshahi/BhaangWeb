<?php
    date_default_timezone_set('America/Los_Angeles');
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
    $dbName = $_SESSION['DBNAME'];
    $accountID = $_SESSION['ACCOUNTID'];
    $accountName = $_SESSION['ACCOUNNAME'];
?>
<!doctype html>
<html ng-app="myApp">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />
    <title>Main Template</title>
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
	<link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    
	<!-- x-editable (bootstrap version) -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"/>

	<!-- Sweet alert -->
	<link rel="stylesheet" href="css/sweet/sweetalert.css">

	<!-- TouchSpin -->
	<link href="css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.js"></script> 
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.min.js"></script>

	<!-- Angular -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/angular-xeditable/0.8.0/css/xeditable.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-animate.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-aria.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-messages.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.4/angular-material.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-xeditable/0.8.0/js/xeditable.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/danialfarid-angular-file-upload/12.2.13/ng-file-upload-all.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-summernote/0.8.1/angular-summernote.js"></script>

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
    <script>
        //Kwang create myAPP here so all step can access it.
        var dbName = "<?php echo $dbName; ?>";
		var accountID = "<?php echo $accountID; ?>";
		var myApp = angular.module('myApp', ["xeditable","summernote"]);
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
													<span class="badge" ng-show="!step1Done">1</span>
													<i aria-hidden="true" class="fa fa-check-circle fa-lg" style="color:green" ng-show="step1Done""></i>
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
																	<input name="programNameHash" type="hidden" value="{{programNameHash}}"> <button class="btn btn-primary" ng-click="Save()">Save</button> <button class="btn btn-white" ng-click="Cancel()">Cancel</button>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
										<div class="panel panel-default">
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
																				<a data-toggle="tab" href="#tab-2" ng-click="initTemplateEmail2();">Email #2: Sent to Non-Openers</a>
																			</li>
																			<li class="">
																				<a data-toggle="tab" href="#tab-3">Email #3: Sent to Non-Clickers</a>
																			</li>
																		</ul>
																		<div class="tab-content">
																			<div class="tab-pane active" id="tab-1">
																				<div class="mail-box-header">
																					<div class="pull-right tooltip-demo">
																						<a class="btn btn-white" data-placement="top" data-toggle="tooltip" title="Leave without saving" ng-click="Cancel()"><i class="fa fa-ban"></i> Cancel</a> <button class="btn btn-primary" ng-click="Save('Email')"><i class="fa fa-floppy-o"></i> Save Email</button>
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
											<?php include "editPromoteBlog_step3.php"; ?>
										</div>
										<div class="panel panel-default">
											<?php include "editPromoteBlog_step4Coa.php"; ?>
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
	<script src="js/plugins/chosen/chosen.jquery.js"></script>

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

	<!-- TouchSpin -->
	<script src="js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <!-- Page-Level Scripts -->
	<script src="js/jquery.md5.js"></script>
    <script>
		var action = '';
		var campaignName = getParameterByName("campaign_name");
		var campaignID = getParameterByName("campaign_id");
		if (campaignID === undefined || campaignID=='') {
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

			$('.chosen-select').chosen({width: "100%"});

			$(".touchspin2").TouchSpin({
				initval: 1,
				min: 1,
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

		function startPlugIn(){
			$('#subjectEmail1').editable();
			$('#subjectEmail2').editable();
			//$('#template').trigger('change');
			
		}

		myApp.controller('myCtrl',function($scope,$http) {
			$scope.Save = function(mode) {
				//alert(mode);
				$("body").css("cursor", "progress");
				/*
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

				EMAIL1SCHEDULE1 = EMAIL1SCHEDULE1DATE+' '+convertTimeFormat(EMAIL1SCHEDULE1TIME);

				if (mode == 'Schedule') {
					EMAIL1SCHEDULE1DATETIME = EMAIL1SCHEDULE1;
					//alert('EMAIL1-SCHEDULE1-DATETIME = '+EMAIL1SCHEDULE1DATETIME);

					date1 = toDate(EMAIL1SCHEDULE1);
					numberOfDaysToAdd = parseInt(EMAIL2WAIT);
					date2 = addDays(date1, numberOfDaysToAdd);
					EMAIL2SCHEDULE1DATETIME = formatDate(date2)+' '+convertTimeFormat(EMAIL2SCHEDULE1TIME);
					//alert('EMAIL2-SCHEDULE1-DATETIME = '+EMAIL2SCHEDULE1DATETIME);

					numberOfDaysToAdd = parseInt(EMAIL3WAIT);
					date3 = addDays(date2, numberOfDaysToAdd);
					EMAIL3SCHEDULE1DATETIME = formatDate(date3)+' '+convertTimeFormat(EMAIL3SCHEDULE1TIME);
					//alert('EMAIL3-SCHEDULE1-DATETIME = '+EMAIL3SCHEDULE1DATETIME);

				}
				
				$scope.campaign['EMAIL1-SCHEDULE1-DATETIME'] = EMAIL1SCHEDULE1DATETIME;
				$scope.campaign['EMAIL2-SCHEDULE1-DATETIME'] = EMAIL2SCHEDULE1DATETIME;
				$scope.campaign['EMAIL3-SCHEDULE1-DATETIME'] = EMAIL3SCHEDULE1DATETIME;
				*/
				if (mode == 'Email') {
					$scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL1CONTENT'] = $scope.templates[$scope.tpIndex()].contentRaw;
					$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-EMAIL1SUBJECT'] = $("#subjectEmail1").text();
					$scope.campaign['EMAIL1-SUBJECT'] = $("#subjectEmail1").text();
				}
				if (mode == 'Email2') {
					$scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL2CONTENT'] = $scope.templatesAs2[$scope.tp2Index()].contentRaw;
					$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-EMAIL2SUBJECT'] = $("#subjectEmail2").text();
					$scope.campaign['EMAIL2-SUBJECT'] = $("#subjectEmail2").text();
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
							$scope.campaignlist.campaigns[$scope.clIndex()].LastEditDate = currentDate;
						}
						$http.put('/couchdb/' + dbName +'/campaignlist', $scope.campaignlist).then(function(response){
							$("body").css("cursor", "default");
							$scope.setDisplay();
							swal("Save Campaign Successful.", "", "success");
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
								swal("Save Campaign Successful.", "", "success");
								//alert("Save Campaign Successful.");
							});
						} else {
							//alert(errResponse.statusText);
							swal(errResponse.statusText);
						}
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
				/*
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
				*/
				
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
					$scope.setInitValue();
					$scope.setDisplay();
					$scope.Reset();
                },function(errResponse){
					if (errResponse.status == 404) {
						action = 'newCampaign';
						//$scope.campaign = {"campaignID":campaignID,"campaignName":campaignName,"campaignType":"PromoteBlog","accountID":accountID,"totalEmail":"3","publishProgramName":"","publishDate":"","EMAIL1-SCHEDULE1-DATE":"","EMAIL1-SCHEDULE1-TIME":"","EMAIL2-SCHEDULE1-TIME":"","EMAIL3-SCHEDULE1-TIME":"","EMAIL2-WAIT":"","EMAIL3-WAIT":"","EMAIL1-SCHEDULE1-DATETIME":"","EMAIL2-SCHEDULE1-DATETIME":"","EMAIL3-SCHEDULE1-DATETIME":"","EMAIL1-SCHEDULE1-TIMEZONE":"","EMAIL2-SCHEDULE1-TIMEZONE":"","EMAIL3-SCHEDULE1-TIMEZONE":""};
						$scope.campaign = {"campaignID":campaignID,"campaignName":campaignName,"campaignType":"PromoteBlog","accountID":accountID,"totalEmail":"3","publishProgramName":"","publishDate":""};
						$scope.setInitValue();
						$scope.setDisplay();
					} else {
						//alert(errResponse.statusText);
						swal(errResponse.statusText);
					}
				});
				
            };
			$scope.setInitValue = function(){
				$scope.initEmailTemplate();
				$scope.initSender();
			};
			$scope.initEmailTemplate = function(){
				$http.get("/admin/getEmailTemplate.php?blueprint=PromoteBlog&scopeName=campaign").then(function(response) {
					$scope.templates  = response.data.templates; 
					$scope.config = response.data.config; 
					$scope.campaign = jQuery.extend(true, {},$scope.config,$scope.campaign);
					$("#subjectEmail1").text($scope.campaign['EMAIL1-SUBJECT']);
					$scope.SelectChanged('viewEmail1','templateEmail1');
					$scope.sendersChanged('textSender1');
					startPlugIn();
				});
			};
			$scope.initTemplateEmail2 = function(){
				if ($scope.openEmail2) {
					$http.get("/admin/getEmailTemplate.php?blueprint=PromoteBlog&scopeName=campaign&as=2").then(function(response) {
						$scope.templatesAs2  = response.data.templates; 
						$("#subjectEmail2").text($scope.campaign['EMAIL2-SUBJECT']);
						$scope.SelectChanged('viewEmail2','templateEmail2');
						$scope.sendersChanged('textSender2');
						startPlugIn();
					});
				}
			};
			$scope.initSender = function(){
				$scope.senders = [];
				$scope.senders.push({"email" : "daver@mindfireinc.com","name" : "David Rosendahl"});
				$scope.senders.push({"email" : "mcfarsheed@mindfireinc.com","name" : "Mackenzi Farsheed"});
			};
			$scope.setDisplay = function(){
				$scope.openEmail2 = false;
				$scope.openEmail3 = false;
				if ($scope.campaign['URL-BLOG-POST-URL']===undefined || $scope.campaign['URL-BLOG-POST-URL']=='') {
					$scope.step1Done = false;
				} else {
					$scope.step1Done = true;
				}
				if ($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL1CONTENT']===undefined || $scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL1CONTENT']=='') {
					$scope.step2Done = false;
				} else {
					$scope.step2Done = true;
				}
                if ($scope.campaign['EMAIL1-SCHEDULE1-DATETIME']===undefined || $scope.campaign['EMAIL1-SCHEDULE1-DATETIME']=='') {
                    $scope.step3Done = false;
                }else{
                    $scope.step3Done = true;
                }
				if ($scope.campaign.totalEmail > '3')	{
					$scope.emailProgress = $scope.campaign.totalEmail+' of '+$scope.campaign.totalEmail+' emails ready';
				} else {
					var emailDone = '0';
					if ($scope.step2Done) {
						emailDone = '1';
						if ($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL2CONTENT']!==undefined & $scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL2CONTENT']!='') {
							emailDone = '2';
							$scope.openEmail2 = true;
						}
						if ($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL3CONTENT']!==undefined & $scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL3CONTENT']!='') {
							emailDone = '3';
						}
					}
					$scope.emailProgress = emailDone+' of 3 emails ready';
				}

				
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
				if ($scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMEMAIL']===undefined || $scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMEMAIL']=='') {
					$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMNAME'] = '';
					$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMEMAIL'] = '';
				} else {
					$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMNAME'] = $scope.senders[$scope.sdIndex()].name
					$("#"+senderTextID).text('New Email from: "'+$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMNAME']+'" <'+$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMEMAIL']+'>');
				}
			};
			$scope.startEmail = function(cmd){
				var currentEmail = '1';
				if (cmd.endsWith("2")) {
					currentEmail = '2';
					$scope.openEmail2 = true;
				}
				if (cmd=='2COPY') {
					var email1Fields = ["EMAIL1-BACKGROUND-COLOR", "EMAIL1-BOTTOM-TEXT", "EMAIL1-BUTTON-COLOR", "EMAIL1-CTA-TEXT", "EMAIL1-HERO-IMAGE", "EMAIL1-NAME", "EMAIL1-SUBJECT", "EMAIL1-TOP-TEXT", "templateEmail1"];
					var email2Fields = email1Fields.map(function(x){ return x.replace(/1/g,"2") });
					for (var i=0; i<email1Fields.length; i++) {
						$scope.campaign[email2Fields[i]] = $scope.campaign[email1Fields[i]];
					}
					$scope.campaign.templateEmail2 = $scope.campaign.templateEmail2.replace(/campaign\[\'EMAIL1/g, "campaign['EMAIL2");
				}
				$http.get("/admin/getEmailTemplate.php?blueprint=PromoteBlog&scopeName=campaign&as="+currentEmail).then(function(response) {
					$scope.templates  = response.data.templates; 
					$scope.config = response.data.config;
					$("#subjectEmail2").text($scope.campaign['EMAIL2-SUBJECT']);
					$scope.SelectChanged('viewEmail2','templateEmail2');
					$scope.sendersChanged('textSender2');
					startPlugIn();
				});
			};
			$scope.clIndex = function() {
				var cplist = 	$scope.campaignlist.campaigns;
				for(var i=0;i < cplist.length; i++){
				  if (cplist[i]["campaignID"] == campaignID)
				  {
					return i;
				  } 
				}
            };
			$scope.tpIndex = function() {
				var tplist = 	$scope.templates;
				for(var i=0;i < tplist.length; i++){
				  if (tplist[i]["content"] == $scope.campaign.templateEmail1)
				  {
					return i;
				  } 
				}
            };
			$scope.tp2Index = function() {
				var tplist = 	$scope.templatesAs2;
				for(var i=0;i < tplist.length; i++){
				  if (tplist[i]["content"] == $scope.campaign.templateEmail2)
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
            // Kwang clear form state
            $scope.clearFormState = function(){
                $scope.frmStep3.$setPristine();
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
        
        function hasValue(obj){
            if (obj===undefined || obj=='') {
                return false;
            } else {
				return true;
			}
        }
    </script>

</body>

</html>