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
			<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseFour"><span class="badge" ng-show="!step3Done">4</span>
											<i aria-hidden="true" class="fa fa-check-circle fa-lg" style="color:green" ng-show="step4Done"></i> Configure Notifications & Alerts</a></h4>
		</div>

		<div class="col-sm-9">
			<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseFour"><small class="m-l-sm"> <i class="fa fa-bell-o" aria-hidden="true"></i> Alerted on Clicks, Opens, and Conversions</small></a></h4>
		</div>
	</div>

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
							<switch ng-model="campaign['OPEN-MY-EMAIL-']" class="green" ng-change="SwitchChange()"></switch>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Visit my Blog Post</label>
						<div class="col-sm-10">
							<switch ng-model="campaign['VISIT-MY-BLOCK-']" class="green" ng-change="SwitchChange()"></switch>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Complete my Call-to-Action</label>
						<div class="col-sm-10">
							<switch ng-model="campaign['CALL-TO-ACTION-']" class="green" ng-change="SwitchChange()"></switch>
						</div>
					</div>
					<!-- Team, no save button required.  Let's take the user's input and persist it without requiring them to hit save -->
				</form>
			</div>
		</div>
	</div>
</div>

<script>
</script>
<!-- stepEnd Start -->