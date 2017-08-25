<!-- TouchSpin -->
<link href="css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

<!-- TouchSpin -->
<script src="js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

<div class="panel-heading">
												<h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseThree"><span class="badge">3</span> &nbsp;Choose Your Audience & Schedule <small class="m-l-sm"> <i class="fa fa-dot-circle-o" aria-hidden="true"></i> Scheduled for Wednesday August 22, 2017 at 3:00 PM</small></a></h4>
											</div>
											<div class="panel-collapse collapse" id="collapseThree">
												<div class="panel-body">
													<div class="ibox float-e-margins">
														<div class="ibox-content">
														<form action="" class="form-horizontal" method="post">
														<div class="form-group">
							<label class="col-sm-2 control-label">Choose Your Audience</label>
							<div class="col-sm-10">
								<div>
									<select class="chosen-select" data-placeholder="Choose a List..." multiple style="width:350px;" tabindex="4">
										<option value="">
											Select
										</option>
										<option value="All Printers from SalesForce (3,512)">
											All Printers from SalesForce (3,512)
										</option>
										<option value="All Leads imported from scanned (713)">
											All Leads imported from scanned (713)
										</option>
										<option value="Existing Clients (3,412)">
											Existing Clients (3,412)
										</option>
										<option value="Mary and Joe Opps from this month (442)">
											Mary and Joe Opps from this month (442)
										</option>
									</select> <span class="help-block m-b-none">Who are you sending to? Pick your targets for this sequence.</span>
								</div>
								<div>
									<p></p>
								</div>
									
							</div>
							</form>
							<div class="row">
								<div class="col-lg-12">
									<div class="wrapper wrapper-content animated fadeInUp">
										<div class="ibox">
											<div class="ibox-title">
												<h5><i aria-hidden="true" class="fa fa-calendar"></i> Schedule</h5>
											</div>
											<div class="project-list">
                                                campaign['EMAIL1-SCHEDULE1-DATETIME'] = {{campaign['EMAIL1-SCHEDULE1-DATETIME']}}<br>
                                                campaign['EMAIL2-SCHEDULE1-DATETIME'] = {{campaign['EMAIL2-SCHEDULE1-DATETIME']}}<br>
                                                campaign['EMAIL3-SCHEDULE1-DATETIME'] = {{campaign['EMAIL3-SCHEDULE1-DATETIME']}}<br>
												<table class="table table-hover">
                                                
												<input type="hidden" class="form-control" id="EMAIL1-SCHEDULE1-DATETIME" name="EMAIL1-SCHEDULE1-DATETIME" placeholder="" type="text" ng-model="campaign['EMAIL1-SCHEDULE1-DATETIME']">

												<input type="hidden" class="form-control" id="EMAIL2-SCHEDULE1-DATETIME" name="EMAIL2-SCHEDULE1-DATETIME" placeholder="" type="text" ng-model="campaign['EMAIL2-SCHEDULE1-DATETIME']">

												<input type="hidden" class="form-control" id="EMAIL3-SCHEDULE1-DATETIME" name="EMAIL3-SCHEDULE1-DATETIME" placeholder="" type="text" ng-model="campaign['EMAIL3-SCHEDULE1-DATETIME']">

													<tbody>
														<tr>
															
															<td class="project-title">
																<button class="btn btn-primary btn-lg" type="button"><span aria-hidden="true" class="fa fa-envelope-o"></span> Email #1</button>
															</td>
															<td class="project-title">
																<strong>Targeting: All Your Primary Targets</strong><br>
																<small>This email is sent to everyone you specify in the above Targeting section.</small>
															</td>
															<td class="project-title">
																<form class="form-inline" role="form">
																	<div class="form-group">
																		<!-- <label for="wait2"><i aria-hidden="true" class="fa fa-clock-o fa-lg"></i> Scheduled for Wednesday August 22, 2017</label>
																		<small>@ 3:30 PM PST</small><br> 													 -->

																		<label for="wait2"><i aria-hidden="true" class="fa fa-clock-o fa-lg"></i> Scheduled for</label><br> 
																		

																		<div class="input-group date">
															                <input type="datetime" class="form-control" date-time ng-change="dateChange('EMAIL1')" ng-model="campaign['EMAIL1-SCHEDULE1-DATE']" view="date" auto-close="true" min-view="date" format="MM/DD/YYYY" id="EMAIL1-SCHEDULE1-DATE" name="EMAIL1-SCHEDULE1-DATE">
															                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
															            </div>

																		<div class="input-group clockpicker" clock-picker data-autoclose="true">
																			<input type="text" class="form-control" id="EMAIL1-SCHEDULE1-TIME" name="EMAIL1-SCHEDULE1-TIME" placeholder="" type="text"  ng-change="dateChange('EMAIL1')" ng-model="campaign['EMAIL1-SCHEDULE1-TIME']">
																			<span class="input-group-addon">
																				<span class="fa fa-clock-o"></span>
																			</span>
																		</div>

																		<select class="form-control m-b" id="EMAIL1-SCHEDULE1-TIMEZONE" name="EMAIL1-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL1-SCHEDULE1-TIMEZONE']">
																			<option value="Pacific Standard Time" >PST</option> 
																			<option value="Mountain Standard Time">MST</option> 
																			<option value="Central America Standard Time">CST</option> 
																			<option value="Eastern Standard Time">EST</option>
																		</select>
																	</div>
																	</form>
															</td>
															
														</tr>
														<tr>
															
															<td class="project-status">
																<button class="btn btn-primary btn-lg" type="button"><span aria-hidden="true" class="fa fa-envelope-o"></span> </i>Email #2</button>
															</td>
															<td class="project-title">
																<strong>Targeting: Non-Opens</strong><br>
																<small>This email is sent to everyone who did not open.</small>
															</td>
															<td class="project-title">
																<form class="form-inline" role="form">
																	<div class="form-group">
																		<label for="wait"><i aria-hidden="true" class="fa fa-pause"></i> Wait</label>
																		<input class="touchspin2 form-control input-sm" id="EMAIL2-WAIT" name="EMAIL2-WAIT" type="text" value="4" ng-change="dateChange('EMAIL2')" ng-model="campaign['EMAIL2-WAIT']" style="width:50px; text-align: center""> <strong>days</strong> <small>and send @ </small> 
																		

																		<div class="input-group clockpicker" clock-picker data-autoclose="true">
																			<input type="text" class="form-control" id="EMAIL2-SCHEDULE1-TIME" name="EMAIL2-SCHEDULE1-TIME" placeholder="" type="text"  ng-change="dateChange('EMAIL2')" ng-model="campaign['EMAIL2-SCHEDULE1-TIME']">
																			<span class="input-group-addon">
																				<span class="fa fa-clock-o"></span>
																			</span>
																		</div>
																		<select class="form-control m-b" id="EMAIL2-SCHEDULE1-TIMEZONE" name="EMAIL2-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL2-SCHEDULE1-TIMEZONE']">
																			<option value="Pacific Standard Time" >PST</option> 
																			<option value="Mountain Standard Time">MST</option> 
																			<option value="Central America Standard Time">CST</option> 
																			<option value="Eastern Standard Time">EST</option>
																		</select>
																	</div>
																	</form>
															</td>
															
														</tr>
														<tr>
															
															<td class="project-status">
																<button class="btn btn-primary btn-lg" type="button"><span aria-hidden="true" class="fa fa-envelope-o"></span> Email #3</button>
															</td>
															<td class="project-title">
																<strong>Targeting: Non-Clickers</strong><br>
																<small>This email is sent to everyone you who opened but did not click.</small>
															</td>
															<td class="project-title">
																<form class="form-inline" role="form">
																	<div class="form-group">
																		<label for="wait3"><i aria-hidden="true" class="fa fa-pause"></i> Wait</label>
																		<input class="touchspin2 form-control input-sm" id="EMAIL3-WAIT" name="EMAIL3-WAIT" type="text" value="4" ng-change="dateChange('EMAIL3')" ng-model="campaign['EMAIL3-WAIT']" style="width:50px; text-align: center"> <strong>days</strong> <small>and send @ </small> 


																		<div class="input-group clockpicker" clock-picker data-autoclose="true">
																			<input type="text" class="form-control" id="EMAIL3-SCHEDULE1-TIME" name="EMAIL3-SCHEDULE1-TIME" placeholder="" type="text" ng-change="dateChange('EMAIL3')" ng-model="campaign['EMAIL3-SCHEDULE1-TIME']">
																			<span class="input-group-addon">
																				<span class="fa fa-clock-o"></span>
																			</span>
																		</div>
																		<select class="form-control m-b" id="EMAIL3-SCHEDULE1-TIMEZONE" name="EMAIL3-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL3-SCHEDULE1-TIMEZONE']">
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
							<label class="col-sm-2 control-label"></label>
							<div class="col-sm-10"><input name="programNameHash" type="hidden" value="{{programNameHash}}"> <button class="btn btn-primary" ng-click="Save('Schedule')">Save</button> <button class="btn btn-white">Cancel</button></div>
						</div>
															
														</div>
													</div>
												</div>
											</div>




<script>
$(document).ready(function(){
	$(".touchspin2").TouchSpin({
						initval: 1,
                        min: 1,
                        max: 100,
                        step: 1,
                        decimals: 0,
                        boostat: 5,
                        maxboostedstep: 10,
                        postfix: '',
                        postfix_extraclass: "btn btn-xs",
                        buttondown_class: 'btn btn-white',
                        buttonup_class: 'btn btn-white'
                    });

});


</script>