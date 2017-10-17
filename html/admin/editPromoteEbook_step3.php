<?php
	$emailHTMLTemplate = file_get_contents('eachEmailCode.html');
	$email1 = str_replace('##emailid##','1',$emailHTMLTemplate);
	$email2 = str_replace('##emailid##','2',$emailHTMLTemplate);
?>
	<style>
		.chosen-container {
			width: 100% !important;
		}
	</style>
	<div class="panel panel-default" ng-controller="step3" id="step3ID">

		<div class="panel-heading">
			<div class="row">
				<div class="col-sm-3">
					<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseThree"><span class="badge" ng-show="!step3Done">3</span>
					<i aria-hidden="true" class="fa fa-check-circle fa-lg" style="color:green" ng-show="step3Done"></i> Write Your Email Drip Sequence</a></h4>
				</div>
				<div class="col-sm-9">
					<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseThree">
          <small class="m-l-sm" ng-show="emailDone > 0"><i aria-hidden="true" class="fa fa-envelope-o" ng-show="emailDone > 0"></i> {{emailProgress}}</small> </a></h4>
				</div>
			</div>
		</div>
		<div class="panel-collapse collapse" id="collapseThree">
			<div class="panel-body">
				<div class="row wrapper border-bottom white-bg page-heading">
					<div class="wrapper wrapper-content animated fadeIn gray-bg">
						<div class="row">
							<div class="col-lg-12">
								<div class="tabs-container">
									<ul class="nav nav-tabs">
										<li class="active">
											<a data-toggle="tab" href="#email-1" ng-click="initTemplateEmail('1');">Email #1: Sent to Everyone Who Downloads</a>
										</li>
										<li class="">
											<a data-toggle="tab" href="#email-2" ng-click="initTemplateEmail('2');">Email #2: Sent to Everyone Who Downloads</a>
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
										<div class="tab-pane active" id="email-1">
											<?php echo $email1; ?>
										</div>
										<!-- Email #2 -->
										<div class="tab-pane" id="email-2">
											<div class="panel-body" ng-show="!openEmail['2']">
												<h2>By adding a second email to non-openers, you'll increase engagement rates by an average of 24%.</h2>
												<p><button type="button" class="btn btn-primary btn-lg" ng-click="startEmail('COPY2')">Create Email Using #1's Content</button>
													<button type="button" class="btn btn-default btn-lg" ng-click="startEmail('NEW2')">Start With a Blank Email</button></p>
											</div>
											<?php echo $email2; ?>
										</div>
										<!-- <div class="tab-pane" id="tab-3">
											<div class="panel-body" ng-show="!openEmail['3']">
												<h2>By adding a third email to non-clickers, you'll increase engagement rates by an average of 14%.</h2>
												<p><button type="button" class="btn btn-primary btn-lg" ng-click="startEmail('COPY3')">Create Email Using #2's Content</button>
													<button type="button" class="btn btn-default btn-lg" ng-click="startEmail('NEW3')">Start With a Blank Email</button></p>
											</div>
											<?php echo $email3; ?>
										</div> -->

										<!-- Jiew -->
										<div ng-repeat="item in emailList" class="tab-pane" id="tab-{{item.emlID}}">
											<div class="panel-body" ng-show="!openEmail['{{item.emlID}}']">
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

	<script src="js/editPromoteEbook_step3.js"></script>