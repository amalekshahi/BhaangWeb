<?php
	$emailHTMLTemplate = file_get_contents('eachEmailCode_revamped_schedule.html');
	$email1 = str_replace('##emailid##','1',$emailHTMLTemplate);
	$email2 = str_replace('##emailid##','2',$emailHTMLTemplate);
	$email3 = str_replace('##emailid##','3',$emailHTMLTemplate);

	$email1 = preg_replace('/<!--hideE1[^>]*-->([\s\S]*?)<!--hideE1[^>]*-->/', '',$email1);
	$email2 = preg_replace('/<!--showE1[^>]*-->([\s\S]*?)<!--showE1[^>]*-->/', '',$email2);
	$email3 = preg_replace('/<!--showE1[^>]*-->([\s\S]*?)<!--showE1[^>]*-->/', '',$email3);
?>
<!--
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-chosen-localytics/1.8.0/angular-chosen.min.js"></script>
-->
<div class="panel panel-default" ng-controller="step2" id="step2ID">
	<div class="panel-heading">
		<div class="row">
			<div class="col-sm-3">
				<h4 class="panel-title">
					<a data-parent="#accordion" data-toggle="collapse" href="#collapseTwo">
						<span class="badge" ng-show="!step2Done">2</span>
						<i aria-hidden="true" class="fa fa-check-circle fa-lg" style="color:green" ng-show="step2Done"></i> Configure Your Email Sequence
					</h4>
				</div>
				<div class="col-sm-9">
					<h4 class="panel-title">
						<a data-parent="#accordion" data-toggle="collapse" href="#collapseTwo" class="accordion-toggle collapsed">
							<small class="m-l-sm" ng-show="emailDone > 0">
								<i class="fa fa-envelope-o" aria-hidden="true"></i> {{emailProgress}}
							</small>
						</a>
					</h4>
				</div>
			</div>
		</div>
		<div class="panel-collapse collapse" id="collapseTwo">
			<!-- Start New -->
			<div class="row m-t-sm" >
				<div class="col-lg-12">
					<div class="tabs-container" >
						<div class="tabs-left">
							<ul class="nav nav-tabs">
								<li class="active">
									<a data-toggle="tab" href="#email-1" style="padding-left: 10px;">
										<span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true" style="color:green; font-size: 8px;" ng-show="emailDone>'0'"></span> Day 1: Sent to Everyone
									</a>
								</li>
								<li class="">
									<a data-toggle="tab" href="#email-2" style="padding-left: 10px;" ng-click="initTemplateEmail('2');">
										<span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true" style="color:green; font-size: 8px;" ng-show="emailDone>'1'"></span> Day {{showEmail2Days}}: Sent to Non-Openers
									</a>
								</li>
								<li class="">
									<a data-toggle="tab" href="#email-3" style="padding-left: 10px;" ng-click="initTemplateEmail('3');">
										<span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true" style="color:green; font-size: 8px;" ng-show="emailDone>'2'"></span> Day {{showEmail3Days}}: Sent to Non-Clickers
									</a>
								</li>
							</ul>
							<div class="tab-content">
								<div id="email-1" class="tab-pane active">
									<div class="panel-body">
										<?php echo $email1; ?>
									</div>
								</div>
								<div id="email-2" class="tab-pane">
									<div class="panel-body">
										<div class="row" ng-show="!openEmail['2']">
											<div class="col-sm-11">
												<p>
													
												</p>
												<h3><i aria-hidden="true" class="fa fa-lightbulb-o"></i> Sending a second email to everyone who didn't open your first can raise engagement rates by 24%.</h3> 
												<p>
													This allows to get more engagement, leads, and activity with only a few clicks.
													<div class="hr-line-dashed"></div>
													<strong>How do you want to create this email?</strong> 
												</p>
												<p>
													<button type="button" class="btn btn-primary btn-sm" ng-click="startEmail('COPY2')"><i class="fa fa-clone" aria-hidden="true"></i> Clone first Email </button> <small class="text-muted">Recommended.  For the best results, make sure to change your <strong>Subject Line</strong>.</small>
													<br>
													<button type="button" class="btn btn-default btn-sm" ng-click="startEmail('NEW2')"><i class="fa fa-file-o" aria-hidden="true"></i> Create new Email</button>
												</p>
											</div>
										</div>
										<?php echo $email2; ?>
									</div>
								</div>
								<div id="email-3" class="tab-pane">
									<div class="panel-body">
										<div class="row" ng-show="!openEmail['3']">
											<div class="col-sm-11">
												<p>
													
												</p>
												<h3><i aria-hidden="true" class="fa fa-lightbulb-o"></i> A third email to those who haven't clicked your Blog Post can raise engagement rates by another 14%.</h3> 
												<p>
													Don't lose an opportunity to generate more awareness, leads, and conversions with only a few more clicks.
													<div class="hr-line-dashed"></div>
													<strong>How do you want to create this email?</strong> 
												</p>
											<p><button type="button" class="btn btn-primary btn-sm" ng-click="startEmail('COPY3')"><i class="fa fa-clone" aria-hidden="true"></i> Clone second Email </button> <small class="text-muted">Recommended.  For the best results, make sure to change your <strong>Subject Line</strong> <u>and</u> <strong>Body Copy</strong>.</small><br>
													<button type="button" class="btn btn-default btn-sm" ng-click="startEmail('NEW3')"><i class="fa fa-file-o" aria-hidden="true"></i> Create new Email</button>
											</div>
										</div>
										<?php echo $email3; ?>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End New -->
			<!-- Old from here down -->
		</div>

		<div aria-hidden="true" class="modal fade" id="modal-form">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<div class="input-group clockpicker" clock-picker data-autoclose="true" data-placement="left" data-align="top">
							<input type="text" class="form-control" id="specificTime" name="specificTime" placeholder="" type="text">
							<span id="specificClock" class="input-group-addon">
								<span class="fa fa-clock-o"></span>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Move to here for fix bug each step not have margin-top because css .panel-group .panel+.panel -->
		<script src="js/editPromoteBlog_step2.js"></script>
		<style>
			.fixedContainer {
				position: fixed;
				z-index: 100;
			}
			.input-group{display: flex;}
			.input-group-btn, .input-group-addon{width: unset;}
			.form-control{padding: 5px 8px;}
			@media screen and (max-width:767px){
			}
			@media (min-width:768px){
			}
			@media (min-width:992px){
			}
			@media (min-width:1200px){
				#EMAIL2-SCHEDULE1-TIME{width: 78px;}
				#EMAIL3-SCHEDULE1-TIME{width: 78px;}
			}
		</style>
		<script>
			$('.spin-icon').click(function() {
				$(".theme-config-box").toggleClass("show");
			});

			$('.sendTest-icon').click(function() {
				$(".sendTest-config-box").toggleClass("show");
			});
		</script>
	</div>
	