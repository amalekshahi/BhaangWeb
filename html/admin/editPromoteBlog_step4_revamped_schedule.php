<!-- step4 Start -->
<style>
	.switch {
		width: 42px;
		height: 20px;
		top: 5px;
		/* frame */
	}

	.switch small {
		/* button */
		width: 20px;
		height: 20px;
	}

	.switch.checked {
		/* frame when enabled */
	}

	.switch.checked small {
		/* button when enabled */
	}
</style>
<div class="panel-heading">
	<div class="row">
		<div class="col-sm-3">
			<h4 class="panel-title">
				<a data-parent="#accordion" data-toggle="collapse" href="#collapseFour">
					<span class="badge" ng-show="!step3Done">3</span>
					<i aria-hidden="true" class="fa fa-check-circle fa-lg" style="color:green" ng-show="step4Done"></i> Toggle Notifications & Alerts
				</a>
			</h4>
		</div>
		<div class="col-sm-9">
			<h4 class="panel-title">
				<a data-parent="#accordion" data-toggle="collapse" href="#collapseFour" class="accordion-toggle collapsed">
					<small class="m-l-sm" ng-show="hasNotifications">
						<i aria-hidden="true" class="fa fa-bell-o"></i> {{labelNotifications}}
					</small>
				</a>
			</h4>
		</div>
	</div>
</div>
<div class="panel-collapse collapse" id="collapseFour">
	<div class="panel-body">
		<div class="ibox float-e-margins">
			<div class="ibox-content">
				<form action="" class="form-horizontal" method="post">
					<div class="form-group">
						<div>
							<span>As people interact with your Campaign, when would you like to be alerted, and who should I tell?</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Open my Emails 
							<switch ng-model="campaign['OPEN-MY-EMAIL-']" class="green" ng-change="SwitchChange()"></switch>
						</label>
						<div class="col-sm-6">
							<select multiple
								chosen
								create-option-text="'Create item'"
								persistent-create-option="true"
								skip-no-results="true"
								create-option="createOption"
								ng-model="notifyTheseUsersForOpens"
								ng-options="u for u in users">
								<option value=""></option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Visit my Blog Post 
							<switch ng-model="campaign['VISIT-MY-BLOCK-']" class="green" ng-change="SwitchChange()"></switch>
						</label>
						<div class="col-sm-6">
							<select multiple
								chosen
								create-option-text="'Create item'"
								persistent-create-option="true"
								skip-no-results="true"
								create-option="createOption"
								ng-model="notifyTheseUsersForVisits"
								ng-options="u for u in users">
								<option value=""></option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Complete my Call-to-Action
							
							<switch ng-if="campaign['CONVERSION-URL']" ng-model="campaign['CALL-TO-ACTION-']" class="green" ng-change="SwitchChange()"></switch>
							<switch class="disabled" ng-if="!campaign['CONVERSION-URL']"></switch>
						</label>
						<span ng-if="!campaign['CONVERSION-URL']">
							<small class="text-muted">
								<br>You need to set your Conversion point in 'Identify the Targeted Blog Post' above.
								</small>
							</span>
							<div class="col-sm-6">
								<select multiple
								chosen
								create-option-text="'Create item'"
								persistent-create-option="true"
								skip-no-results="true"
								create-option="createOption"
								ng-model="notifyTheseUsersForCTACompletions"
								ng-options="u for u in users">
									<option value=""></option>
								</select>
							</div>
						</div>
						<!-- Team, no save button required.  Let's take the user's input and persist it without requiring them to hit save -->
					</form>
				</div>
			</div>
		</div>
	</div>
	<script></script>
	<!-- stepEnd Start -->