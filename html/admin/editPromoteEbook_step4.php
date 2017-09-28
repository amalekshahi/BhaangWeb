<!-- step4 Start -->
<link data-require="chosen@*" data-semver="1.0.0" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.min.css" />
<script data-require="chosen@*" data-semver="1.0.0" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.jquery.min.js"></script>
<script data-require="chosen@*" data-semver="1.0.0" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.0/chosen.proto.min.js"></script>
<script src="https://rawgit.com/leocaseiro/angular-chosen/master/dist/angular-chosen.min.js"></script>

<div class="panel panel-default" ng-controller="step4">
    <div class="panel-heading">
                            <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseFour">
                            <span class="badge" ng-show="!step4Done">4</span>
                            <i aria-hidden="true" class="fa fa-check-circle fa-lg" style="color:green" ng-show="step4Done""></i>
                            &nbsp;Set Your Drip's Timing&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <!-- <small class="m-l-sm" ng-show="ShowScheduleDateTime()"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>2 Drip Emails Configured</small> -->
							<small class="m-l-sm"><i aria-hidden="true" class="fa fa-envelope-o"></i> {{scheduleProgress}}</small>
                            </a></h4>
    </div>
<style>
    table.schedule td{padding: 0px !important;}
</style>
    <div class="panel-collapse collapse" id="collapseFour">
        <!--<button ng-click="ParseDate()"></button>-->
        <div class="panel-body">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form class="form-horizontal" name="frmStep4">
                        <div class="form-group">
							<!-- Jiew -->
							<!-- <label class="col-sm-2 control-label">Choose Your Audience</label>
							<div class="col-sm-10">
								<div>
									<select chosen multiple placeholder-text-multiple="'Choose a List...'" ng-model="filterList" ng-options = "s.contactID as s['LIST-NAME'] for s in audience.items"  style="width:400px;" ng-change="ArrangeFilter()">
										 <option value=""></option>
									</select>
									<span class="help-block m-b-none">Who are you sending to? Pick your targets for this sequence.</span>									
								</div>
							</div> -->
                            <!-- Jiew -->
							<div class="row">
                                <!--EMAIL1-SCHEDULE1-DATETIME={{campaign['EMAIL1-SCHEDULE1-DATETIME']}}<br>
                                EMAIL2-SCHEDULE1-DATETIME={{campaign['EMAIL2-SCHEDULE1-DATETIME']}}<br>
                                EMAIL3-SCHEDULE1-DATETIME={{campaign['EMAIL3-SCHEDULE1-DATETIME']}}<br>-->
								<div class="col-lg-12">
									<div class="wrapper wrapper-content animated fadeInUp">
										<div class="ibox">
											<div class="ibox-title">
                                                <div style="float:left;">
                                                    <h5><i aria-hidden="true" class="fa fa-calendar"></i> Schedule</h5>
                                                </div>
												<!-- Jiew -->
                                                <!-- <div style="float:right;"><h5><input name="programNameHash" type="hidden" value="{{programNameHash}}">
                                                    <button class="btn btn-primary" ng-disabled="frmStep4.$pristine" ng-click="Save('')"><i class="fa fa-floppy-o" ng-show="state['Save'] == 'Save'"></i><span ng-show="state['Save'] == 'Saving'"><i class="glyphicon glyphicon-refresh spinning"></i></span> {{state['Save']}} </button>
                                                    <button class="btn btn-white" ng-disabled="frmStep4.$pristine" ng-click="Cancel()"><i class="fa fa-ban"></i> Cancel </button></h5>
                                                </div> -->
												<!-- Jiew -->
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
														<!-- Jiew -->
														<!-- <tr>
															<td class="project-status">
																<button class="btn btn-primary btn-lg" type="button"><span aria-hidden="true" class="fa fa-envelope-o"></span> Email #1</button>
															</td>
															<td class="project-title">
																<strong>Targeting: All Your Primary Targets</strong><br>
																<small>This email is sent to everyone you specify in the above Targeting section.</small>
															</td>
															<td class="project-title">
																<form class="form-inline" role="form">
																	<div class="form-group">
																		<label for="wait2"><i aria-hidden="true" class="fa fa-clock-o fa-lg"></i> Scheduled for</label><br> 

																		<div class="input-group date">
															                <input type="datetime" class="form-control" date-time ng-model="campaign['EMAIL1-SCHEDULE1-DATE']" view="date" auto-close="true" min-view="date" format="MM/DD/YYYY" id="EMAIL1-SCHEDULE1-DATE" name="EMAIL1-SCHEDULE1-DATE" ng-change="dateChange('')">
															                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
															            </div>

																		<div class="input-group clockpicker" clock-picker data-autoclose="true" data-placement="left" data-align="top">
																			<input type="text" class="form-control" id="EMAIL1-SCHEDULE1-TIME" name="EMAIL1-SCHEDULE1-TIME" placeholder="" type="text" ng-model="campaign['EMAIL1-SCHEDULE1-TIME']" ng-change="dateChange('')">
																			<span class="input-group-addon">
																				<span class="fa fa-clock-o"></span>
																			</span>
																		</div>

																		<select class="form-control" id="EMAIL1-SCHEDULE1-TIMEZONE" name="EMAIL1-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL1-SCHEDULE1-TIMEZONE']" ng-change="dateChange('')">
																			<option value="Pacific Standard Time" >PST</option> 
																			<option value="Mountain Standard Time">MST</option> 
																			<option value="Central America Standard Time">CST</option> 
																			<option value="Eastern Standard Time">EST</option>
																		</select>
																	</div>
																</form>
															</td>
														</tr> -->
														<!-- Jiew -->
														<tr>
															<td class="project-status">
																<button class="btn btn-primary btn-lg" type="button"><span aria-hidden="true" class="fa fa-envelope-o"></span> </i>Email #1</button>
															</td>
															<td class="project-title">
																<strong>Targeting: Everyone Who Downloads</strong><br>
																<small>This email is sent to everyone who downloads your eBook, and is typically used to thank them for downloading.  Tip: Provide the ebook as a link in the email for easy future reference.</small>
															</td>
															<td class="project-title">
																<form class="form-inline" role="form">
																	<div class="form-group">
																		<table class="schedule">
																		<tr>
																			<td style="vertical-align: top;line-height: 32px;width: 170px;"><label for="wait3"><i aria-hidden="true" class="fa fa-pause"></i>&nbsp;Wait</label></td>
																			<td>
																				<table class="schedule">
																					<tr>
																						<td><input class="touchspin2 form-control input-sm" type="text" value="4" ng-model="campaign['EMAIL1-SCHEDULE1-DAYS']" style="width:50px; text-align: center"></td>
																						<td>days</td>
																					</tr>
																					<tr>
																						<td><input class="touchspin2 form-control input-sm" type="text" value="4" ng-model="campaign['EMAIL1-SCHEDULE1-HOURS']" style="width:50px; text-align: center"></td>
																						<td>hours</td>
																					</tr>
																					<tr>
																						<td><input class="touchspin2 form-control input-sm" type="text" value="4" ng-model="campaign['EMAIL1-SCHEDULE1-MINS']" style="width:50px; text-align: center"></td>
																						<td>minutes</td>
																					</tr>
																				</table>
																			</td>
																		</tr>
																		</table>
																		<!-- <select class="form-control" id="EMAIL1-WAIT-UNIT" name="EMAIL1-WAIT-UNIT" ng-model="campaign['EMAIL1-WAIT-UNIT']" ng-change="chkValidSchedule()">
																			<option value="" disabled>Select...</option>
																			<option value="Days" >days</option> 
																			<option value="Hours">hours</option> 
																			<option value="Mins">minutes</option> 
																		</select> -->

																		<!-- <div class="input-group clockpicker" clock-picker data-autoclose="true" data-placement="left" data-align="top">
																			<input type="text" class="form-control" id="EMAIL2-SCHEDULE1-TIME" name="EMAIL2-SCHEDULE1-TIME" placeholder="" type="text" ng-model="campaign['EMAIL2-SCHEDULE1-TIME']" ng-change="dateChange('')">
																			<span class="input-group-addon">
																				<span class="fa fa-clock-o"></span>
																			</span>
																			<select class="form-control" id="EMAIL2-SCHEDULE1-TIMEZONE" name="EMAIL2-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL2-SCHEDULE1-TIMEZONE']" ng-change="dateChange('')">
																				<option value="Pacific Standard Time" >PST</option> 
																				<option value="Mountain Standard Time">MST</option> 
																				<option value="Central America Standard Time">CST</option> 
																				<option value="Eastern Standard Time">EST</option>
																			</select>
																		</div> -->
																	</div>
																</form>
															</td>
															
														</tr>
														<tr ng-show="openEmail['2']">
															
															<td class="project-status">
																<button class="btn btn-primary btn-lg" type="button"><span aria-hidden="true" class="fa fa-envelope-o"></span> Email #2</button>
															</td>
															<td class="project-title">
																<strong>Targeting: Everyone Who Downloads</strong><br>
																<small>Use this email to continue building a relationship.  Offer insights and other useful content.</small>
															</td>
															<td class="project-title">
																<form class="form-inline" role="form">
																	<div class="form-group">
																		<table class="schedule">
																		<tr>
																			<td style="vertical-align: top;line-height: 32px;width: 170px;"><label for="wait3"><i aria-hidden="true" class="fa fa-pause"></i>&nbsp;Wait</label></td>
																			<td>
																				<table class="schedule">
																					<tr>
																						<td><input class="touchspin2 form-control input-sm" type="text" value="4" ng-model="campaign['EMAIL2-SCHEDULE1-DAYS']" style="width:50px; text-align: center"></td>
																						<td>days</td>
																					</tr>
																					<tr>
																						<td><input class="touchspin2 form-control input-sm" type="text" value="4" ng-model="campaign['EMAIL2-SCHEDULE1-HOURS']" style="width:50px; text-align: center"></td>
																						<td>hours</td>
																					</tr>
																					<tr>
																						<td><input class="touchspin2 form-control input-sm" type="text" value="4" ng-model="campaign['EMAIL2-SCHEDULE1-MINS']" style="width:50px; text-align: center"></td>
																						<td>minutes</td>
																					</tr>
																				</table>
																			</td>
																		</tr>
																		</table>
																		<!-- <input class="touchspin2 form-control input-sm" id="EMAIL2-WAIT" name="EMAIL2-WAIT" type="text" value="4" ng-model="campaign['EMAIL2-WAIT']" style="width:50px; text-align: center"> <strong>days</strong> <small>and send @ </small> 

																		<div class="input-group clockpicker" clock-picker data-autoclose="true" data-placement="left" data-align="top">
																			<input type="text" class="form-control" id="EMAIL2-SCHEDULE1-TIME" name="EMAIL2-SCHEDULE1-TIME" placeholder="" type="text" ng-model="campaign['EMAIL2-SCHEDULE1-TIME']">
																			<span class="input-group-addon">
																				<span class="fa fa-clock-o"></span>
																			</span>
																				<select class="form-control" id="EMAIL2-SCHEDULE1-TIMEZONE" name="EMAIL2-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL2-SCHEDULE1-TIMEZONE']">
																				<option value="Pacific Standard Time" >PST</option> 
																				<option value="Mountain Standard Time">MST</option> 
																				<option value="Central America Standard Time">CST</option> 
																				<option value="Eastern Standard Time">EST</option>
																			</select>
																		</div> -->
																	</div>
																</form>
															</td>
														</tr>
														<!-- Jiew : Current version cannot add email -->
														<!-- <tr>
															<td class="project-status"><button class="btn btn-success btn-lg" type="button"><span aria-hidden="true" class="fa fa-plus-square-o"></span> ADD ANOTHER EMAIL</button></td>
															<td class="project-title"><strong>You can up to 6 emails in this sequence</strong><br>
															<small>Drive engagement by up to 57% by adding 1 more email.</small></td>
															<td class="project-title">
																<form class="form-inline" role="form">
																	<div class="form-group">
																		
																	</div>
																</form>
															</td>
														</tr> -->
														<!-- Jiew -->
													</tbody>
												</table>
												
											</div>
											
										</div>
									</div>
								</div>
							</div>
                            <label class="col-sm-2 control-label"></label>
							<div class="col-sm-10"><button class="btn btn-primary" ng-click="Save('')"><i class="fa fa-floppy-o" ng-show="state['Save'] == 'Save'"></i><span ng-show="state['Save'] == 'Saving'"><i class="glyphicon glyphicon-refresh spinning"></i></span> {{state['Save']}} </button>
                                                    <button class="btn btn-white" ng-click="Cancel()"><i class="fa fa-ban"></i> Cancel </button></div>
						</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/editPromoteEbook_step4.js"></script>
<!-- step4 End-->