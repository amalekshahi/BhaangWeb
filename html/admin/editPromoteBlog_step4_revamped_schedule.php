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
							<span>As people interact with your Campaign, when would you like to be alerted, and who should I tell? I can send alerts when:</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Open my Emails 
							<switch ng-model="campaign['OPEN-MY-EMAIL-']" class="green" ng-change="SwitchChange()"></switch>
						</label>
						<div class="col-sm-6">
							<select multiple
								chosen
								create-option-text="'Add this email'"
								persistent-create-option="true"
								skip-no-results="true"
								create-option="addUserForOpens"
								ng-model="notifyTheseUsersForOpens"
								ng-options="x.email as x.name + ' (' + x.email + ')' for x in senders">
								<option value=""></option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Visit my Blog Post 
							<switch ng-model="campaign['VISIT-MY-BLOCK-']" class="green" ng-change="SwitchChange()"></switch>
						</label>
						<div class="col-sm-6">
							<select multiple
								chosen
								create-option-text="'Add this email'"
								persistent-create-option="true"
								skip-no-results="true"
								create-option="addUserForVisits"
								ng-model="notifyTheseUsersForVisits"
								ng-options="x.email as x.name + ' (' + x.email + ')' for x in senders">
								<option value=""></option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Complete Conversions
							<switch ng-if="campaign['CONVERSION-URL']" ng-model="campaign['CALL-TO-ACTION-']" class="green" ng-change="SwitchChange()"></switch>
							<switch class="disabled" ng-if="!campaign['CONVERSION-URL']"></switch>
						</label>
							
							<small class="text-muted" ng-if="!campaign['CONVERSION-URL']"><br> &nbsp;&nbsp;&nbsp; <i class="fa fa-bell-o" aria-hidden="true"></i> You need to first set a Conversion point in 'Identify the Targeted Blog Post' above.</small>
							
							<div class="col-sm-6" ng-show="campaign['CONVERSION-URL']">
								<select multiple
								chosen
								create-option-text="'Add this email'"
								persistent-create-option="true"
								skip-no-results="true"
								create-option="addUserForCTACompletions"
								ng-model="notifyTheseUsersForCTACompletions"
								ng-options="x.email as x.name + ' (' + x.email + ')' for x in senders">
									<option value=""></option>
								</select>
							</div>
						</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"></label>
						<div class="col-sm-6">
						<button class="btn btn-primary" ng-click="Save('Step4')">
							<i class="fa fa-floppy-o" ng-show="state['Save'] == 'Save'"></i>
							<span ng-show="state['Save'] == 'Saving'">
								<i class="glyphicon glyphicon-refresh spinning"></i>
							</span> {{state['Save']}} 
						</button>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script></script>
	<!-- stepEnd Start -->