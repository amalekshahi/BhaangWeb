<!-- step4 Start -->

<link href="css/plugins/switchery/switchery.css" rel="stylesheet">
<!-- Switchery -->
<script src="js/plugins/switchery/switchery.js"></script>

											
											<div class="panel-heading">
												<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseFour"><span class="badge">4</span> &nbsp;Configure Notifications & Alerts &nbsp;&nbsp;&nbsp;&nbsp;<small class="m-l-sm"> <i class="fa fa-bell-o" aria-hidden="true"></i> Alerted on Clicks, Opens, and Conversions</small></a></h4>
											</div>
											<div class="panel-collapse collapse" id="collapseFour">
												<div class="panel-body">
													<div class="ibox float-e-margins">
														<div class="ibox-content">
															<form class="form-horizontal" name="frmStep4">
															<div class="row" ng-controller="step4">
																<div class="form-group">
																	<label class="col-sm-2 control-label">Notify me when people.:</label>
																	<div class="col-sm-10">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-2 control-label">Open my Emails</label>
																	<div class="col-sm-10">
																		<input class="js-switch form-control" id="OPEN-MY-EMAIL" name="OPEN-MY-EMAIL" type="checkbox" ng-model="campaign['OPEN-MY-EMAIL']" ng-true-value="'Start'" ng-false-value="'Stop'" onchange="doSave()">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-2 control-label">Visit my Blog Post</label>
																	<div class="col-sm-10">
																		<input class="js-switch_2 form-control" id="VISIT-MY-BLOCK" name="VISIT-MY-BLOCK" type="checkbox" ng-model="campaign['VISIT-MY-BLOCK']" ng-true-value="'Start'" ng-false-value="'Stop'" onchange="doSave()">
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-sm-2 control-label">Complete my Call-to-Action</label>
																	<div class="col-sm-10">
																		<input class="js-switch_3 form-control" id="CALL-TO-ACTION" name="CALL-TO-ACTION" type="checkbox" ng-model="campaign['CALL-TO-ACTION']" ng-true-value="'Start'" ng-false-value="'Stop'" onchange="doSave()">
																	</div>
																</div>

																<button class="btn btn-primary"  ng-click="Save('')"><i class="fa fa-floppy-o"></i> Save </button>
				
																OPEN-MY-EMAIL={{campaign['OPEN-MY-EMAIL']}}<br>
																OPEN-MY-EMAIL={{campaign['VISIT-MY-BLOCK']}}<br>
																CALL-TO-ACTION={{campaign['CALL-TO-ACTION']}}<br>
																<!-- Team, no save button required.  Let's take the user's input and persist it without requiring them to hit save -->
															</div>
															</form>
														</div>
													</div>
												</div>
											</div>

<script>
$(document).ready(function(){

	var elem = document.querySelector('.js-switch');
    var switchery = new Switchery(elem, { color: '#1AB394', size: 'small' });
    
    var elem_2 = document.querySelector('.js-switch_2');
    var switchery_2 = new Switchery(elem_2, { color: '#1AB394', size: 'small' });
    
    var elem_3 = document.querySelector('.js-switch_3');
    var switchery_3 = new Switchery(elem_3, { color: '#1AB394', size: 'small' });        

});

myApp.controller('step4',function($scope,$http) {
	$scope.saveData = function(){
		alert('saveData');
	};
});

function doSave(){
	//alert('doSave');
}



</script>

<!-- step4 End-->