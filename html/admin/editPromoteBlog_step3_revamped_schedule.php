<!-- step3 Start -->
<!-- Dave commented these out because they're redundant
<link data-require="chosen@*" data-semver="1.0.0" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.min.css" />
<script data-require="chosen@*" data-semver="1.0.0" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.jquery.min.js"></script>
<script data-require="chosen@*" data-semver="1.0.0" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.proto.min.js"></script>
<script src="https://rawgit.com/leocaseiro/angular-chosen/master/dist/angular-chosen.min.js"></script>
-->
<?php
	$filterHTMLTemplate = file_get_contents('eachFilterCode_revamped_schedule.html');
	$filter1 = str_replace('##filterid##','1',$filterHTMLTemplate);
	$filter2 = str_replace('##filterid##','2',$filterHTMLTemplate);
	$filter3 = str_replace('##filterid##','3',$filterHTMLTemplate);

	$filter1 = str_replace('##nextfilterid##','2',$filter1);
	$filter2 = str_replace('##nextfilterid##','3',$filter2);
	$filter3 = preg_replace('/<!--hideF3[^>]*-->([\s\S]*?)<!--hideF3[^>]*-->/', '',$filter3);

	$filter2 = preg_replace('/<!--showF1[^>]*-->([\s\S]*?)<!--showF1[^>]*-->/', '',$filter2);
	$filter3 = preg_replace('/<!--showF1[^>]*-->([\s\S]*?)<!--showF1[^>]*-->/', '',$filter3);
?>
<div class="panel panel-default" ng-controller="step3">
	<div class="panel-heading">
		<div class="row">
			<div class="col-sm-3">
				<h4 class="panel-title">
					<a data-parent="#accordion" data-toggle="collapse" href="#collapseThree">
						<span class="badge" ng-show="!step3Done">4</span>
						<i aria-hidden="true" class="fa fa-check-circle fa-lg" style="color:green" ng-show="step3Done"></i> Schedule Broadcasts 
					</a>
				</h4>
			</div>
			<div class="col-sm-9">
				<h4 class="panel-title">
					<a data-parent="#accordion" data-toggle="collapse" href="#collapseThree" class="accordion-toggle collapsed">
						<small class="m-l-sm" ng-show="ShowScheduleDateTime()">
							<i class="fa fa-dot-circle-o" aria-hidden="true"></i> Scheduled for {{ScheduleDateTime}} ({{campaign['EMAIL1-SCHEDULE1-TIMEZONE']}})
						</small>
					</a>
				</h4>
			</div>
		</div>
	</div>
	<style>
		.chosen-container {
			width: 100% !important;
		}

		.chosen-container-multi .chosen-choices li.search-field input[type=text] {
			padding-top: 0px;
			width: 120px !important;
		}
	</style>
	<div class="panel-collapse collapse" id="collapseThree">
		<div class="panel-body">
			<div class="ibox float-e-margins">
				<div class="ibox-content">
					<form name="idForm" id="idForm">
						<input type="hidden" name="LISTDEFINITION"  id="LISTDEFINITION">
					</form>
	
					<!-- <form class="form-horizontal" name="frmStep3"> -->
						<div class="row">
							<!--<div class="col-lg-12"><div><div style="float:right;"><h5><input name="programNameHash" type="hidden" value="{{programNameHash}}"><button class="btn btn-primary" ng-click="Save('Step3')"><i class="fa fa-floppy-o" ng-show="state['Save'] == 'Save'"></i><span ng-show="state['Save'] == 'Saving'"><i class="glyphicon glyphicon-refresh spinning"></i></span> {{state['Save']}} </button><button class="btn btn-white" ng-disabled="frmStep3.$pristine" ng-click="Cancel()"><i class="fa fa-ban"></i> Cancel </button></h5></div></div><div class="project-list"><table class="table table-hover"><thead><tr><th></th><th>Email Subject & Rule</th><th>Delay Between Emails</th></tr></thead><tbody><tr><td class="project-status"><button type="button" class="btn btn-primary m-r-sm">Email #1</button></td><td class="project-title"><h3 ng-show="emailDone == 0"><i class="fa fa-info-circle" aria-hidden="true" style="color:orange"></i> You need to create this Email in Step <span class="badge">2</span> before you can set a Schedule.</h3><h3 ng-show="emailDone > 0 && campaign['TEXT-LINE-ACCTID-PROGRAMID-EMAIL1SUBJECT'] != null">"{{campaign['TEXT-LINE-ACCTID-PROGRAMID-EMAIL1SUBJECT']}}"</h3><h3 ng-show="emailDone > 0 && campaign['TEXT-LINE-ACCTID-PROGRAMID-EMAIL1SUBJECT'] == null"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color:red"></i> Warning: You're still using the default Subject line for your Email.</h3><small ng-show="emailDone == 0">Once you create your masterpiece, you'll be able to set a date and time for deployment.</small><small ng-show="emailDone > 0">Sent to everyone in this Audience.</small></td><td class="project-title"><form class="form-inline" role="form"><div class="form-group" ng-show="emailDone > 0"><label for="wait2"><i aria-hidden="true" class="fa fa-clock-o fa-lg"></i> Sent Day One</label><br></form></td></tr><tr ng-show="openEmail['2']"><td class="project-status"><button type="button" class="btn btn-primary m-r-sm">Email #2</button></td><td class="project-title"><h3>"{{campaign['TEXT-LINE-ACCTID-PROGRAMID-EMAIL2SUBJECT']}}"</h3><small>Sent to everyone who did not open Email #1.</small></td><td class="project-title"><form class="form-inline" role="form"><div class="form-group"><label for="wait"><i aria-hidden="true" class="fa fa-pause"></i> Wait</label><input ng-disabled="disabledEmail['2']" class="touchspin2 form-control input-sm" id="EMAIL2-WAIT" name="EMAIL2-WAIT" type="text" value="4" ng-model="campaign['EMAIL2-WAIT']" style="width:50px; text-align: center" ng-change="dateChange('')"><strong>days</strong><small>and send @ </small><div class="input-group clockpicker" clock-picker data-autoclose="true" data-placement="left" data-align="top"><input ng-disabled="disabledEmail['2']" type="text" class="form-control" id="EMAIL2-SCHEDULE1-TIME" name="EMAIL2-SCHEDULE1-TIME" placeholder="" type="text" ng-model="campaign['EMAIL2-SCHEDULE1-TIME']" ng-change="dateChange('')"><span id="clockspan2" class="input-group-addon"><span class="fa fa-clock-o"></span></span></div><select ng-disabled="disabledEmail['2']" class="form-control" id="EMAIL2-SCHEDULE1-TIMEZONE" name="EMAIL2-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL2-SCHEDULE1-TIMEZONE']" ng-change="dateChange('')"><option value="Pacific Standard Time" >PST</option><option value="Mountain Standard Time">MST</option><option value="Central America Standard Time">CST</option><option value="Eastern Standard Time">EST</option></select></div></form></td></tr><tr ng-show="openEmail['3']"><td class="project-status"><button type="button" class="btn btn-primary m-r-sm">Email #3</button></td><td class="project-title"><h3>"{{campaign['TEXT-LINE-ACCTID-PROGRAMID-EMAIL3SUBJECT']}}"</h3><small>Sent to everyone has not visited your Blog Post URL.</small></td><td class="project-title"><form class="form-inline" role="form"><div class="form-group"><label for="wait3"><i aria-hidden="true" class="fa fa-pause"></i> Wait</label><input ng-disabled="disabledEmail['3']" class="touchspin2 form-control input-sm" id="EMAIL3-WAIT" name="EMAIL3-WAIT" type="text" value="4" ng-model="campaign['EMAIL3-WAIT']" style="width:50px; text-align: center" ng-change="dateChange('')"><strong>days</strong><small>and send @ </small><div class="input-group clockpicker" clock-picker data-autoclose="true" data-placement="left" data-align="top"><input ng-disabled="disabledEmail['3']" type="text" class="form-control" id="EMAIL3-SCHEDULE1-TIME" name="EMAIL3-SCHEDULE1-TIME" placeholder="" type="text" ng-model="campaign['EMAIL3-SCHEDULE1-TIME']" ng-change="dateChange('')"><span id="clockspan3" class="input-group-addon"><span class="fa fa-clock-o"></span></span></div><select ng-disabled="disabledEmail['3']" class="form-control" id="EMAIL3-SCHEDULE1-TIMEZONE" name="EMAIL3-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL3-SCHEDULE1-TIMEZONE']" ng-change="dateChange('')"><option value="Pacific Standard Time" >PST</option><option value="Mountain Standard Time">MST</option><option value="Central America Standard Time">CST</option><option value="Eastern Standard Time">EST</option></select></div></form></td></tr></tbody></table></div></div>-->
						</div>
						<!--<div class="hr-line-dashed"></div>-->
						<div class="form-group">
							<table class="table table-hover">
								<thead>
									<tr>
										<th width="350">Name</th>
										<th>Lists</th>
										<th></th>
									</tr>
								</thead>
<?php echo $filter1; ?>								
<!-- Filter 2 -->
<?php echo $filter2; ?>
<!-- Filter 2 -->
<!-- Filter 3 -->
<?php echo $filter3; ?>
<!-- Filter 3 -->	
							</table>
						</div>
						<input class="form-control" name="EMAIL-FILTER-JOINOPERATOR" placeholder="" type="hidden" ng-model="campaign['EMAIL-FILTER-JOINOPERATOR']">
						<input class="form-control" name="EMAIL-FILTER-CRITERIAROW" placeholder="" type="hidden" ng-model="campaign['EMAIL-FILTER-CRITERIAROW']">
					<!-- </form> -->
				</div>
			</div>
		</div>
		<!-- Move to here for fix bug each step not have margin-top because css .panel-group .panel+.panel -->
		<script src="js/editPromoteBlog_step3.js"></script>
	</div>
	<!-- step3 End-->