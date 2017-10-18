<?php
	$emailHTMLTemplate = file_get_contents('eachEmailCode_revamped_schedule.html');
	$email1 = str_replace('##emailid##','1',$emailHTMLTemplate);
	$email2 = str_replace('##emailid##','2',$emailHTMLTemplate);
	$email3 = str_replace('##emailid##','3',$emailHTMLTemplate);
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
										<span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true" style="color:green; font-size: 8px;"></span> Day 1: Sent to Everyone
									</a>
								</li>
								<li class="">
									<a data-toggle="tab" href="#email-2" style="padding-left: 10px;"> Day 3: Sent to Non-Openers</a>
								</li>
								<li class="">
									<a data-toggle="tab" href="#email-2" style="padding-left: 10px;"> Day 5: Sent to Non-Clickers</a>
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
										<?php echo $email2; ?>
									</div>
								</div>
								<div id="email-3" class="tab-pane">
									<div class="panel-body">
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
	</div>
	<script src="js/editPromoteBlog_step2.js"></script>
				