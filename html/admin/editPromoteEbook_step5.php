<!-- step5 Start -->
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
			<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseFive"><span class="badge" ng-show="!step4Done">5</span> 
			<i aria-hidden="true" class="fa fa-check-circle fa-lg" style="color:green" ng-show="step5Done"></i> Configure Notifications & Alerts</a></h4>
		</div>
		<div class="col-sm-9">
			<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseFive">
      <small class="m-l-sm" ng-show="campaign['URL-eBOOK-NAME']"><i aria-hidden="true" class="fa fa-bell-o" ng-show="campaign['URL-eBOOK-NAME']"></i> Alerted on Visits and Downloads</small> </a></h4>
		</div>
	</div>
</div>
<div class="panel-collapse collapse" id="collapseFive">
	<div class="panel-body">
		<div class="ibox float-e-margins">
			<div class="ibox-content">
				<form action="" class="form-horizontal" method="post">
					<div class="form-group">
						<label class="col-sm-3" control-label>Notify me when people.:</label>
						<div class="col-sm-3">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Visit the Landing Page</label>
						<div class="col-sm-2">
							<switch ng-model="campaign['VISIT-MY-EBOOK-']" class="green" ng-change="SwitchChange()"></switch>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Download the eBook</label>
						<div class="col-sm-2">
							<switch ng-model="campaign['DOWNLOAD-MY-EBOOK-']" class="green" ng-change="SwitchChange()"></switch>
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