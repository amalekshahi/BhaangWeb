<!-- step3 Start -->
<link data-require="chosen@*" data-semver="1.0.0" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.min.css" />
<script data-require="chosen@*" data-semver="1.0.0" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.jquery.min.js"></script>
<script data-require="chosen@*" data-semver="1.0.0" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.proto.min.js"></script>
<script src="https://rawgit.com/leocaseiro/angular-chosen/master/dist/angular-chosen.min.js"></script>

<div class="panel panel-default" ng-controller="step3">
	<div class="panel-heading">
		<div class="row">

			<div class="col-sm-3">
				<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseThree"><span class="badge" ng-show="!step3Done">3</span>
			<i aria-hidden="true" class="fa fa-check-circle fa-lg" style="color:green" ng-show="step3Done"></i> Choose Your Audience & Schedule </a></h4>
			</div>

			<div class="col-sm-9">
				<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseThree"><small class="m-l-sm" ng-show="ShowScheduleDateTime()"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Scheduled for {{ScheduleDateTime}} ({{campaign['EMAIL1-SCHEDULE1-TIMEZONE']}})</small></a></h4>
			</div>
		</div>
	</div>
	<style>
		.chosen-container {
			width: 100% !important;
		}
		.chosen-container-multi .chosen-choices li.search-field input[type=text] {
			padding-top: 0px;
			width:120px !important;
		}
	</style>
	<div class="panel-collapse collapse" id="collapseThree">
		<!--<button ng-click="ParseDate()"></button>-->
		<div class="panel-body">
			<div class="ibox float-e-margins">
				<div class="ibox-content">
					<form class="form-horizontal" name="frmStep3">
						<div class="form-group">
							<label class="col-sm-2 control-label">Choose Your Audience</label>
							<div class="col-sm-5">
								<div>
									<!--<select chosen multiple placeholder-text-multiple="'Choose a List...'" ng-model="filterList" ng-options = "s.id as s.listname for s in states"  style="width:400px;" ng-change="ArrangeFilter()">-->
									<select chosen multiple placeholder-text-multiple="'Choose a List...'" ng-model="filterList" ng-options="s.contactID as s['LIST-NAME'] for s in audience.items" style="width:400px;" ng-change="ArrangeFilter()">
										 <option value=""></option>
									</select>
									<!-- <option ng-repeat="option in audience.items" ng-value="option['LIST-ARRAY']" >{{option['LIST-NAME']}}</option>  -->
									<!-- <option ng-repeat="option in audience.items" ng-value="option">{{option['LIST-NAME']}}</option>  -->
									<!-- <select class="chosen-select1" data-placeholder="Choose a List..." multiple style="width:350px;" tabindex="4" ng-model="filterList" ng-change="ArrangeFilter()">
										<option ng-repeat="option in audience.items" ng-value="option['contactID']">{{option['LIST-NAME']}}</option> 
									</select> -->
									<!--<input type="hidden" name="EMAIL1-FILTER"  id="EMAIL1-FILTER" value="">-->
									<span class="help-block m-b-none">Who are you sending to? Pick your targets for this sequence.</span>
								</div>
								<!--<div>
									<p>{{campaign['EMAIL1-FILTER']}}</p>
								</div>-->
							</div>

							<div class="row">
								<!--EMAIL1-SCHEDULE1-DATETIME={{campaign['EMAIL1-SCHEDULE1-DATETIME']}}<br>
                                EMAIL2-SCHEDULE1-DATETIME={{campaign['EMAIL2-SCHEDULE1-DATETIME']}}<br>
                                EMAIL3-SCHEDULE1-DATETIME={{campaign['EMAIL3-SCHEDULE1-DATETIME']}}<br>
								EMAIL-FILTER-JOINOPERATOR={{campaign['EMAIL-FILTER-JOINOPERATOR']}}<br>
								EMAIL-FILTER-CRITERIAROW={{campaign['EMAIL-FILTER-CRITERIAROW']}}<br>-->
								<div class="col-lg-12">
									<div class="wrapper wrapper-content animated fadeInUp">
										<div class="ibox">
											<div class="ibox-title">
												<div style="float:left;">
													<h5><i aria-hidden="true" class="fa fa-calendar"></i> Schedule</h5>
												</div>
												<div style="float:right;">
													<h5><input name="programNameHash" type="hidden" value="{{programNameHash}}">
														<button class="btn btn-primary" ng-click="Save('Step3')"><i class="fa fa-floppy-o" ng-show="state['Save'] == 'Save'"></i><span ng-show="state['Save'] == 'Saving'"><i class="glyphicon glyphicon-refresh spinning"></i></span> {{state['Save']}} </button>
														<button class="btn btn-white" ng-disabled="frmStep3.$pristine" ng-click="Cancel()"><i class="fa fa-ban"></i> Cancel </button></h5>
												</div>
											</div>
											<div class="project-list">
												<table class="table table-hover">
													<tbody>
														<!-- Kwang do not remove fix first row bug -->
														<tr style="display:none;">
															<td class="project-status">
															</td>
															<td class="project-title">
															</td>
															<td class="project-title">
																<form class="form-inline" role="form">
																	<div class="form-group"></div>
																</form>
															</td>
														</tr>
														<tr>
															<td class="project-status">
																<div class="widget style1 navy-bg">
																	<div class="row">
																		<div class="text-right">
																			<span> Sent to Everyone </span>
																			<h2 class="font-bold">Email #1</h2>
																		</div>
																	</div>
																</div>
															</td>
															<td class="project-title">
																<h3>Subject: "{{campaign['TEXT-LINE-ACCTID-PROGRAMID-EMAIL1SUBJECT']}}"</h3>
																<small>This email is sent to everyone you specify in the above Targeting section.</small>
															</td>
															<td class="project-title">
																<form class="form-inline" role="form">
																	<div class="form-group">
																		<!-- <label for="wait2"><i aria-hidden="true" class="fa fa-clock-o fa-lg"></i> Scheduled for Wednesday August 22, 2017</label>
																		<small>@ 3:30 PM PST</small><br> 													 -->

																		<label for="wait2"><i aria-hidden="true" class="fa fa-clock-o fa-lg"></i> Scheduled for:</label><br>


																		<div class="input-group date">
																			<input ng-disabled="disabledEmail['1']" type="datetime" class="form-control" date-time ng-model="campaign['EMAIL1-SCHEDULE1-DATE']" view="date" auto-close="true" min-view="date" format="MM/DD/YYYY" id="EMAIL1-SCHEDULE1-DATE" name="EMAIL1-SCHEDULE1-DATE" ng-change="dateChange('')" required="">
																			<span id="datespan1" class="input-group-addon" onclick="showcalendar();"><i class="fa fa-calendar"></i></span>
																		</div>

																		<div class="input-group clockpicker" clock-picker data-autoclose="true" data-placement="left" data-align="top">
																			<input ng-disabled="disabledEmail['1']" type="text" class="form-control" id="EMAIL1-SCHEDULE1-TIME" name="EMAIL1-SCHEDULE1-TIME" placeholder="" type="text" ng-model="campaign['EMAIL1-SCHEDULE1-TIME']" ng-change="dateChange('')" required="">
																			<span id="clockspan1" class="input-group-addon">
																				<span class="fa fa-clock-o"></span>
																			</span>
																		</div>

																		<select ng-disabled="disabledEmail['1']" class="form-control" id="EMAIL1-SCHEDULE1-TIMEZONE" name="EMAIL1-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL1-SCHEDULE1-TIMEZONE']" ng-change="dateChange('')" required="">
																			<option value="Pacific Standard Time" >PST</option> 
																			<option value="Mountain Standard Time">MST</option> 
																			<option value="Central America Standard Time">CST</option> 
																			<option value="Eastern Standard Time">EST</option>
																		</select>
																	</div>
																</form>
															</td>

														</tr>
														<tr ng-show="openEmail['2']">
															<td class="project-status">
																<div class="widget style1 navy-bg">
																	<div class="row">
																		<div class="text-right">
																			<span> Sent to Non-Opens </span>
																			<h2 class="font-bold">Email #2</h2>
																		</div>
																	</div>
																</div>
															</td>
															<td class="project-title">
																<h3>Subject: "{{campaign['TEXT-LINE-ACCTID-PROGRAMID-EMAIL2SUBJECT']}}"</h3>
																<small>This email is sent to everyone who did not open your first email.</small>
															</td>
															<td class="project-title">
																<form class="form-inline" role="form">
																	<div class="form-group">
																		<label for="wait"><i aria-hidden="true" class="fa fa-pause"></i> Wait</label>
																		<input ng-disabled="disabledEmail['2']" class="touchspin2 form-control input-sm" id="EMAIL2-WAIT" name="EMAIL2-WAIT" type="text" value="4" ng-model="campaign['EMAIL2-WAIT']" style="width:50px; text-align: center" ng-change="dateChange('')"> <strong>days</strong> <small>and send @ </small>


																		<div class="input-group clockpicker" clock-picker data-autoclose="true" data-placement="left" data-align="top">
																			<input ng-disabled="disabledEmail['2']" type="text" class="form-control" id="EMAIL2-SCHEDULE1-TIME" name="EMAIL2-SCHEDULE1-TIME" placeholder="" type="text" ng-model="campaign['EMAIL2-SCHEDULE1-TIME']" ng-change="dateChange('')">
																			<span id="clockspan2" class="input-group-addon">
																				<span class="fa fa-clock-o"></span>
																			</span>
																		</div>
																		<select ng-disabled="disabledEmail['2']" class="form-control" id="EMAIL2-SCHEDULE1-TIMEZONE" name="EMAIL2-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL2-SCHEDULE1-TIMEZONE']" ng-change="dateChange('')">
																			<option value="Pacific Standard Time" >PST</option> 
																			<option value="Mountain Standard Time">MST</option> 
																			<option value="Central America Standard Time">CST</option> 
																			<option value="Eastern Standard Time">EST</option>
																		</select>
																	</div>
																</form>
															</td>

														</tr>
														<tr ng-show="openEmail['3']">
															<td class="project-status">
																<div class="widget style1 navy-bg">
																	<div class="row">
																		<div class="text-right">
																			<span> Sent to Non-Clickers </span>

																			<h2 class="font-bold">Email #3</h2>
																		</div>
																	</div>
																</div>
															</td>
															<td class="project-title">
																<h3>Subject: "{{campaign['TEXT-LINE-ACCTID-PROGRAMID-EMAIL3SUBJECT']}}"</h3>
																<small>This email is sent to everyone has not yet clicked your Blog Post URL.</small>
															</td>
															<td class="project-title">
																<form class="form-inline" role="form" >
																	<div class="form-group">
																		<label for="wait3"><i aria-hidden="true" class="fa fa-pause"></i> Wait</label>
																		<input ng-disabled="disabledEmail['3']" class="touchspin2 form-control input-sm" id="EMAIL3-WAIT" name="EMAIL3-WAIT" type="text" value="4" ng-model="campaign['EMAIL3-WAIT']" style="width:50px; text-align: center" ng-change="dateChange('')"> <strong>days</strong> <small>and send @ </small>


																		<div class="input-group clockpicker" clock-picker data-autoclose="true" data-placement="left" data-align="top">
																			<input ng-disabled="disabledEmail['3']" type="text" class="form-control" id="EMAIL3-SCHEDULE1-TIME" name="EMAIL3-SCHEDULE1-TIME" placeholder="" type="text" ng-model="campaign['EMAIL3-SCHEDULE1-TIME']" ng-change="dateChange('')">
																			<span id="clockspan3" class="input-group-addon">
																				<span class="fa fa-clock-o"></span>
																			</span>
																		</div>
																		<select ng-disabled="disabledEmail['3']" class="form-control" id="EMAIL3-SCHEDULE1-TIMEZONE" name="EMAIL3-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL3-SCHEDULE1-TIMEZONE']" ng-change="dateChange('')">
																			<option value="Pacific Standard Time" >PST</option> 
																			<option value="Mountain Standard Time">MST</option> 
																			<option value="Central America Standard Time">CST</option> 
																			<option value="Eastern Standard Time">EST</option>
																		</select>
																	</div>
																</form>
															</td>

														</tr>

													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--
							<label class="col-sm-2 control-label"></label>
							<div class="col-sm-10"><input name="programNameHash" type="hidden" value="{{programNameHash}}"> <button class="btn btn-primary" ng-click="Save('')">Save</button> <button class="btn btn-white" ng-click="Reset()">Cancel</button></div>
                            -->
						</div>
						<input class="form-control" name="EMAIL-FILTER-JOINOPERATOR" placeholder="" type="hidden" ng-model="campaign['EMAIL-FILTER-JOINOPERATOR']">
						<input class="form-control" name="EMAIL-FILTER-CRITERIAROW" placeholder="" type="hidden" ng-model="campaign['EMAIL-FILTER-CRITERIAROW']">

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="js/editPromoteBlog_step3.js"></script>
<!-- step3 End-->