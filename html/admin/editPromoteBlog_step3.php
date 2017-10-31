<!-- step3 Start -->
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
		.label-email-subject {
			white-space: nowrap;
			text-overflow: ellipsis;
			max-width: calc(100% - 80px);
			display: inline-block;
			overflow: hidden;
		}
		.input-group{display: inline-flex;}
		.input-group-btn, .input-group-addon{width: unset;}
		.form-control{padding: 6px 10px;}
		@media screen and (max-width:767px){
		}
		@media (min-width:768px){
		}
		@media (min-width:992px){
		}
		@media (min-width:1200px){
			.schedule-grid{
				/* Internet Explorer 10 */
				display:-ms-flexbox;
				-ms-flex-pack:center;
				-ms-flex-align:center;

				/* Firefox */
				display:-moz-box;
				-moz-box-pack:center;
				-moz-box-align:center;

				/* Safari, Opera, and Chrome */
				display:-webkit-box;
				-webkit-box-pack:center;
				-webkit-box-align:center;

				/* W3C */
				display:box;
				box-pack:center;
				box-align:center;
			}
			#EMAIL2-SCHEDULE1-TIME{width: 80px;}
			#EMAIL3-SCHEDULE1-TIME{width: 80px;}
		}
		
	</style>
	<div class="panel-collapse collapse" id="collapseThree">
		<!--<button ng-click="ParseDate()"></button>-->
		<div class="panel-body">
			<div class="ibox float-e-margins">
				<div class="ibox-content">
					<form name="idForm" id="idForm">
						<input type="hidden" name="LISTDEFINITION"  id="LISTDEFINITION" value="{{campaign['EMAIL1-FILTER']}}">
					</form>
					<form class="form-horizontal" name="frmStep3">
						<div class="form-group">
							<label class="col-sm-3 control-label">Choose Your Audience</label>
							<div class="col-sm-5">
								<div>
									<select chosen multiple placeholder-text-multiple="'Choose a List...'" ng-model="filter1List" ng-options="s.contactID as s['LIST-NAME']+' ['+s['LIST-COUNT']+' people]' for s in audience.items" style="width:400px;" ng-change="ArrangeFilter('1')">
										 <option value=""></option>
									</select>
									<span class="help-block m-b-none">Who are you sending to? Pick your targets for this sequence. </span>
								</div>								
							</div>
							<div>
								<input type="text" name="au1Count"  id="au1Count"  style="border: 0 rgba(0, 0, 0, 0.3);height:30px; text-align: center;" value="" readonly>
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
												<div class="row">
													<div class="col-lg-2">
														<h5><i aria-hidden="true" class="fa fa-calendar"></i> Schedule</h5>
													</div>
													<div class="col-lg-3 col-lg-push-7">
														<h5 style="float: right;">
															<input name="programNameHash" type="hidden" value="{{programNameHash}}">
															<button class="btn btn-primary" ng-click="Save('Step3')"><i class="fa fa-floppy-o" ng-show="state['Save'] == 'Save'"></i><span ng-show="state['Save'] == 'Saving'"><i class="glyphicon glyphicon-refresh spinning"></i></span> {{state['Save']}} </button>
															<button class="btn btn-white" ng-disabled="frmStep3.$pristine" ng-click="Cancel()"><i class="fa fa-ban"></i> Cancel </button>
														</h5>
													</div>
												</div>
											</div>
											<div class="project-list">
												<div class="row schedule-grid">
													<div class="col-lg-2">
														<div class="project-status">
															<div class="widget style1 navy-bg">
																<div class="text-right">
																	<span> Sent to Everyone </span>
																	<h2 class="font-bold">Email #1</h2>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-5">
														<div style="width:100%;">
															<h3 ng-show="emailDone == 0"><i class="fa fa-info-circle" aria-hidden="true" style="color:orange"></i> You need to create this Email in Step <span class="badge">2</span> before you can set a Schedule.</h3>
															<h3 ng-show="emailDone > 0 && campaign['EMAIL1-SUBJECT'] != null" style="display: flex;">Subject:&nbsp;"<div  class="label-email-subject">{{campaign['EMAIL1-SUBJECT']}}</div>"</h3>
															<h3 ng-show="emailDone > 0 && campaign['EMAIL1-SUBJECT'] == null"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color:red"></i> Warning: You're still using the default Subject line for your Email.</h3>
															<small ng-show="emailDone == 0">Once you create your masterpiece, you'll be able to set a date and time for deployment.</small>
															<small ng-show="emailDone > 0">This email is sent to everyone you specify in the above Targeting section.</small>
														</div>
													</div>
													<div class="col-lg-5">
														<div ng-show="emailDone > 0">
															<!-- <label for="wait2"><i aria-hidden="true" class="fa fa-clock-o fa-lg"></i> Scheduled for Wednesday August 22, 2017</label>
															<small>@ 3:30 PM PST</small><br> 													 -->
															<div class="col-lg-12">
																<label for="wait2"><i aria-hidden="true" class="fa fa-clock-o fa-lg"></i> Scheduled for:</label><br>
															</div>
															<div class="col-lg-5">
																<div class="input-group date">
																	<input ng-disabled="disabledEmail['1']" type="datetime" class="form-control" date-time ng-model="campaign['EMAIL1-SCHEDULE1-DATE']" view="date" auto-close="true" min-view="date" format="MM/DD/YYYY" id="EMAIL1-SCHEDULE1-DATE" name="EMAIL1-SCHEDULE1-DATE" ng-change="dateChange('')" required="">
																	<span id="datespan1" class="input-group-addon" onclick="showcalendar();"><i class="fa fa-calendar"></i></span>
																</div>
															</div>
															<div class="col-lg-4">
																<div class="input-group clockpicker" clock-picker data-autoclose="true" data-placement="left" data-align="top">
																	<input ng-disabled="disabledEmail['1']" type="text" class="form-control" id="EMAIL1-SCHEDULE1-TIME" name="EMAIL1-SCHEDULE1-TIME" placeholder="" type="text" ng-model="campaign['EMAIL1-SCHEDULE1-TIME']" ng-change="dateChange('')" required="">
																	<span id="clockspan1" class="input-group-addon">
																		<span class="fa fa-clock-o"></span>
																	</span>
																</div>
															</div>
															<div class="col-lg-3">
																<select ng-disabled="disabledEmail['1']" class="form-control" id="EMAIL1-SCHEDULE1-TIMEZONE" name="EMAIL1-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL1-SCHEDULE1-TIMEZONE']" ng-change="dateChange('')" required="">
																	<option value="Pacific Standard Time" >PST</option> 
																	<option value="Mountain Standard Time">MST</option> 
																	<option value="Central America Standard Time">CST</option> 
																	<option value="Eastern Standard Time">EST</option>
																</select>
															</div>
														</div>
													</div>
												</div>
											
												<div class="row schedule-grid" ng-show="openEmail['2']">
													<div class="col-lg-2">
														<div class="project-status">
															<div class="widget style1 navy-bg">
																<div class="text-right">
																	<span> Sent to Non-Opens </span>
																	<h2 class="font-bold">Email #2</h2>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-5">
														<div style="width:100%;">
															<h3 style="display: flex;">Subject:&nbsp;"<div  class="label-email-subject">{{campaign['EMAIL2-SUBJECT']}}</div>"</h3>
															<small>This email is sent to everyone who did not open your first email.</small>
														</div>
													</div>
													<div class="col-lg-5">
														<div ng-show="emailDone > 0">
															<!-- <label for="wait2"><i aria-hidden="true" class="fa fa-clock-o fa-lg"></i> Scheduled for Wednesday August 22, 2017</label>
															<small>@ 3:30 PM PST</small><br> -->
															<div class="col-lg-12">
																<i aria-hidden="true" class="fa fa-pause"></i>&nbsp;<strong>Wait</strong><br>
															</div>
															<div class="col-lg-4">
																<input ng-disabled="disabledEmail['2']" class="touchspin2" id="EMAIL2-WAIT" name="EMAIL2-WAIT" type="text" value="4" ng-model="campaign['EMAIL2-WAIT']" style="width:40px; text-align: center" ng-change="dateChange('')">&nbsp;<strong>days</strong>
															</div>
															<div class="col-lg-5">
																<small style="padding-top: 8px;">and send @ </small>
																<div class="input-group clockpicker" clock-picker data-autoclose="true" data-placement="left" data-align="top">
																	<input ng-disabled="disabledEmail['2']" type="text" class="form-control" id="EMAIL2-SCHEDULE1-TIME" name="EMAIL2-SCHEDULE1-TIME" placeholder="" type="text" ng-model="campaign['EMAIL2-SCHEDULE1-TIME']" ng-change="dateChange('')">
																	<span id="clockspan2" class="input-group-addon">
																		<span class="fa fa-clock-o"></span>
																	</span>
																</div>
															</div>
															<div class="col-lg-3">
																<select ng-disabled="disabledEmail['2']" class="form-control" id="EMAIL2-SCHEDULE1-TIMEZONE" name="EMAIL2-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL2-SCHEDULE1-TIMEZONE']" ng-change="dateChange('')">
																	<option value="Pacific Standard Time" >PST</option> 
																	<option value="Mountain Standard Time">MST</option> 
																	<option value="Central America Standard Time">CST</option> 
																	<option value="Eastern Standard Time">EST</option>
																</select>
															</div>
														</div>
													</div>
												</div>

												<div class="row schedule-grid" ng-show="openEmail['3']">
													<div class="col-lg-2">
														<div class="project-status">
															<div class="widget style1 navy-bg">
																<div class="text-right">
																	<span> Sent to Non-Clickers </span>
																	<h2 class="font-bold">Email #3</h2>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-5">
														<div style="width:100%;">
															<h3 style="display: flex;">Subject:&nbsp;"<div  class="label-email-subject">{{campaign['EMAIL3-SUBJECT']}}</div>"</h3>
															<small>This email is sent to everyone has not yet clicked your Blog Post URL.</small>
														</div>
													</div>
													<div class="col-lg-5">
														<div ng-show="emailDone > 0">
															<!-- <label for="wait2"><i aria-hidden="true" class="fa fa-clock-o fa-lg"></i> Scheduled for Wednesday August 22, 2017</label>
															<small>@ 3:30 PM PST</small><br> -->
															<div class="col-lg-12">
																<i aria-hidden="true" class="fa fa-pause"></i>&nbsp;<strong>Wait</strong><br>
															</div>
															<div class="col-lg-4">
																<input ng-disabled="disabledEmail['3']" class="touchspin2" id="EMAIL3-WAIT" name="EMAIL3-WAIT" type="text" value="4" ng-model="campaign['EMAIL3-WAIT']" style="width:40px; text-align: center" ng-change="dateChange('')">&nbsp;<strong>days</strong>
															</div>
															<div class="col-lg-5">
																<small style="padding-top: 8px;">and send @ </small>
																<div class="input-group clockpicker" clock-picker data-autoclose="true" data-placement="left" data-align="top">
																	<input ng-disabled="disabledEmail['3']" type="text" class="form-control" id="EMAIL3-SCHEDULE1-TIME" name="EMAIL3-SCHEDULE1-TIME" placeholder="" type="text" ng-model="campaign['EMAIL3-SCHEDULE1-TIME']" ng-change="dateChange('')">
																	<span id="clockspan3" class="input-group-addon">
																		<span class="fa fa-clock-o"></span>
																	</span>
																</div>
															</div>
															<div class="col-lg-3">
																<select ng-disabled="disabledEmail['3']" class="form-control" id="EMAIL3-SCHEDULE1-TIMEZONE" name="EMAIL3-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL3-SCHEDULE1-TIMEZONE']" ng-change="dateChange('')">
																	<option value="Pacific Standard Time" >PST</option> 
																	<option value="Mountain Standard Time">MST</option> 
																	<option value="Central America Standard Time">CST</option> 
																	<option value="Eastern Standard Time">EST</option>
																</select>
															</div>
														</div>
													</div>
												</div>
												
												<!--jiew <table class="table table-hover">
													<tbody> jiew-->
														<!-- Kwang do not remove fix first row bug -->
														<!--jiew<tr style="display:none;">
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
															<td class="project-status" width="160">
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
																<h3 ng-show="emailDone == 0"><i class="fa fa-info-circle" aria-hidden="true" style="color:orange"></i> You need to create this Email in Step <span class="badge">2</span> before you can set a Schedule.</h3>
																<h3 ng-show="emailDone > 0 && campaign['EMAIL1-SUBJECT'] != null">	<div style="display: inline-flex;">
																	Subject:&nbsp;"<div  class="label-email-subject">{{campaign['EMAIL1-SUBJECT']}}</div>"
																</div></h3>
																<h3 ng-show="emailDone > 0 && campaign['EMAIL1-SUBJECT'] == null"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color:red"></i> Warning: You're still using the default Subject line for your Email.</h3>
																<small ng-show="emailDone == 0">Once you create your masterpiece, you'll be able to set a date and time for deployment.</small>
																<small ng-show="emailDone > 0">This email is sent to everyone you specify in the above Targeting section.</small>
															</td>
															<td class="project-title" width="550">
																<form class="form-inline" role="form">
																	<div class="form-group" ng-show="emailDone > 0">jiew-->
																		<!-- <label for="wait2"><i aria-hidden="true" class="fa fa-clock-o fa-lg"></i> Scheduled for Wednesday August 22, 2017</label>
																		<small>@ 3:30 PM PST</small><br> 													 -->

																		<!--jiew<label for="wait2"><i aria-hidden="true" class="fa fa-clock-o fa-lg"></i> Scheduled for:</label><br>


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
																<h3><div style="display: inline-flex;">	Subject:&nbsp;"<div  class="label-email-subject">{{campaign['EMAIL2-SUBJECT']}}</div>"</div></h3>
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
																<h3><div style="display: inline-flex;">	Subject:&nbsp;"<div  class="label-email-subject">{{campaign['EMAIL3-SUBJECT']}}</div>"</div></h3>
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
												</table>jiew-->
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
	<!-- Move to here for fix bug each step not have margin-top because css .panel-group .panel+.panel -->
	<script src="js/editPromoteBlog_step3.js"></script>
</div>
<!-- step3 End-->