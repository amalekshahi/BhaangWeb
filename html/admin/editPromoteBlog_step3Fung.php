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
									<!-- fung -->
									<select class="chosen-select1" data-placeholder="Choose a List..." multiple style="width:350px;" tabindex="4" ng-model="filterList">
										<!-- <option ng-repeat="option in audience.items" ng-value="option['LIST-ARRAY']" >{{option['LIST-NAME']}}</option>  -->
										<option ng-repeat="option in audience.items" ng-value="option['contactID']" >{{option['LIST-NAME']}}</option> 
									</select>
									 <input type="hidden" name="EMAIL1-FILTER" value="{{filterList}}">
									<span class="help-block m-b-none">Who are you sending to? Pick your targets for this sequence.</span>
									<button class="btn btn-primary" type="button" ng-click="ArrangeFilter()">test</button>

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
												
																							
												<table class="table table-hover">
												
												<input type="hidden" class="form-control" id="EMAIL1-SCHEDULE1-DATETIME" name="EMAIL1-SCHEDULE1-DATETIME" placeholder="" type="text" ng-model="campaign['EMAIL1-SCHEDULE1-DATETIME']">

												<input type="hidden" class="form-control" id="EMAIL2-SCHEDULE1-DATETIME" name="EMAIL2-SCHEDULE1-DATETIME" placeholder="" type="text" ng-model="campaign['EMAIL2-SCHEDULE1-DATETIME']">

												<input type="hidden" class="form-control" id="EMAIL3-SCHEDULE1-DATETIME" name="EMAIL3-SCHEDULE1-DATETIME" placeholder="" type="text" ng-model="campaign['EMAIL3-SCHEDULE1-DATETIME']">
												<!-- 
												For Debug<br>	
												<input type="text" class="form-control" id="EMAIL1-SCHEDULE1-DATETIME" name="EMAIL1-SCHEDULE1-DATETIME" placeholder="" type="text" ng-model="campaign['EMAIL1-SCHEDULE1-DATETIME']" readonly>

												<input type="text" class="form-control" id="EMAIL2-SCHEDULE1-DATETIME" name="EMAIL2-SCHEDULE1-DATETIME" placeholder="" type="text" ng-model="campaign['EMAIL2-SCHEDULE1-DATETIME']" readonly>

												<input type="text" class="form-control" id="EMAIL3-SCHEDULE1-DATETIME" name="EMAIL3-SCHEDULE1-DATETIME" placeholder="" type="text" ng-model="campaign['EMAIL3-SCHEDULE1-DATETIME']" readonly>
												 -->

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
															                <input type="datetime" class="form-control" date-time ng-model="campaign['EMAIL1-SCHEDULE1-DATE']" view="date" auto-close="true" min-view="date" format="MM/DD/YYYY" id="EMAIL1-SCHEDULE1-DATE" name="EMAIL1-SCHEDULE1-DATE" onchange="dateChange('')">
															                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
															            </div>

																		<div class="input-group clockpicker" clock-picker data-autoclose="true" data-placement="left" data-align="top">
																			<input type="text" class="form-control" id="EMAIL1-SCHEDULE1-TIME" name="EMAIL1-SCHEDULE1-TIME" placeholder="" type="text" ng-model="campaign['EMAIL1-SCHEDULE1-TIME']" onchange="dateChange('')">
																			<span class="input-group-addon">
																				<span class="fa fa-clock-o"></span>
																			</span>
																		</div>

																		<select class="form-control m-b" id="EMAIL1-SCHEDULE1-TIMEZONE" name="EMAIL1-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL1-SCHEDULE1-TIMEZONE']" onchange="dateChange('')">
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
																		<input class="touchspin2 form-control input-sm" id="EMAIL2-WAIT" name="EMAIL2-WAIT" type="text" value="4" ng-model="campaign['EMAIL2-WAIT']" style="width:50px; text-align: center" onchange="dateChange('')"> <strong>days</strong> <small>and send @ </small> 
																		

																		<div class="input-group clockpicker" clock-picker data-autoclose="true" data-placement="left" data-align="top">
																			<input type="text" class="form-control" id="EMAIL2-SCHEDULE1-TIME" name="EMAIL2-SCHEDULE1-TIME" placeholder="" type="text" ng-model="campaign['EMAIL2-SCHEDULE1-TIME']" onchange="dateChange('')">
																			<span class="input-group-addon">
																				<span class="fa fa-clock-o"></span>
																			</span>
																		</div>
																		<select class="form-control m-b" id="EMAIL2-SCHEDULE1-TIMEZONE" name="EMAIL2-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL2-SCHEDULE1-TIMEZONE']" onchange="dateChange('')">
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
																		<input class="touchspin2 form-control input-sm" id="EMAIL3-WAIT" name="EMAIL3-WAIT" type="text" value="4" ng-model="campaign['EMAIL3-WAIT']" style="width:50px; text-align: center" onchange="dateChange('')"> <strong>days</strong> <small>and send @ </small> 


																		<div class="input-group clockpicker" clock-picker data-autoclose="true" data-placement="left" data-align="top">
																			<input type="text" class="form-control" id="EMAIL3-SCHEDULE1-TIME" name="EMAIL3-SCHEDULE1-TIME" placeholder="" type="text" ng-model="campaign['EMAIL3-SCHEDULE1-TIME']" onchange="dateChange('')">
																			<span class="input-group-addon">
																				<span class="fa fa-clock-o"></span>
																			</span>
																		</div>
																		<select class="form-control m-b" id="EMAIL3-SCHEDULE1-TIMEZONE" name="EMAIL3-SCHEDULE1-TIMEZONE" ng-model="campaign['EMAIL3-SCHEDULE1-TIMEZONE']" onchange="dateChange('')">
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
							<div class="col-sm-10"><input name="programNameHash" type="hidden" value="{{programNameHash}}"> <button class="btn btn-primary" ng-click="Save('')">Save</button> <button class="btn btn-white" type="submit">Cancel</button></div>
						</div>
															
														</div>
													</div>
												</div>
											</div>


<script>
function dateChange() {
	

	var EMAIL2SCHEDULE1TIME = $("#EMAIL2-SCHEDULE1-TIME").val();
	var EMAIL3SCHEDULE1TIME = $("#EMAIL3-SCHEDULE1-TIME").val();

	var EMAIL1SCHEDULE1TIME = $("#EMAIL1-SCHEDULE1-TIME").val();
	var EMAIL1SCHEDULE1DATE = $("#EMAIL1-SCHEDULE1-DATE").val();
				
				
	var EMAIL1SCHEDULE1DATETIME = "";
	var EMAIL2SCHEDULE1DATETIME = "";
	var EMAIL3SCHEDULE1DATETIME = "";

	var EMAIL2WAIT = $("#EMAIL2-WAIT").val();
	var EMAIL3WAIT = $("#EMAIL3-WAIT").val();

	var EMAIL1SCHEDULE1TIMEZONE = $("#EMAIL1-SCHEDULE1-TIMEZONE").val();
	var EMAIL2SCHEDULE1TIMEZONE = $("#EMAIL2-SCHEDULE1-TIMEZONE").val();	
	var EMAIL3SCHEDULE1TIMEZONE = $("#EMAIL3-SCHEDULE1-TIMEZONE").val();

	//alert('EMAIL1SCHEDULE1DATE = '+EMAIL1SCHEDULE1DATE);
	//alert('EMAIL1SCHEDULE1TIME = '+EMAIL1SCHEDULE1TIME);

	if(EMAIL1SCHEDULE1DATE!="" && EMAIL1SCHEDULE1TIME!=""){
		var d1 = EMAIL1SCHEDULE1DATE+' '+convertTimeFormat(EMAIL1SCHEDULE1TIME);
		$('#EMAIL1-SCHEDULE1-DATETIME').val(d1);
		var date1 = toDate(d1);
		//alert('d1 = '+d1);
		//alert('date1 = '+EMAIL1SCHEDULE1DATE);
		var date2 = date1;
		for(var i=2;i<=3;i++){
			var emailName = "EMAIL" + i;
			$('#'+emailName+'-SCHEDULE1-DATETIME').val()
			if($('#'+emailName+'-WAIT').val()!="" && $('#'+emailName+'-SCHEDULE1-TIME').val()!=""){
				var numberOfDaysToAdd = parseInt($('#'+emailName+'-WAIT').val());
				date2 = addDays(date2, numberOfDaysToAdd);
				var d2 = formatDate(date2)+' '+convertTimeFormat($('#'+emailName+'-SCHEDULE1-TIME').val());
				//alert(emailName+' : d2 = '+d2);
				$('#'+emailName+'-SCHEDULE1-DATETIME').val(d2);   
			}else{
				$('#'+emailName+'-SCHEDULE1-DATETIME').val("");
			}
		}
	}

	/* for test
	if($scope.campaign['EMAIL1-SCHEDULE1-DATE']!="" && $scope.campaign['EMAIL1-SCHEDULE1-TIME']!=""){
		$scope.campaign['EMAIL1-SCHEDULE1-DATETIME'] = $scope.campaign['EMAIL1-SCHEDULE1-DATE']+' '+convertTime($scope.campaign['EMAIL1-SCHEDULE1-TIME']);
		var date1 = toDate($scope.campaign['EMAIL1-SCHEDULE1-DATETIME']);
		
		for(var i=2;i<=3;i++){
			var emailName = "EMAIL" + i;
			if($scope.campaign[emailName + '-WAIT']!="" && $scope.campaign[emailName + '-SCHEDULE1-TIME']!=""){
				var numberOfDaysToAdd = parseInt($scope.campaign[emailName + '-WAIT']);
				var date2 = addDays(date1, numberOfDaysToAdd);
				$scope.campaign[emailName + '-SCHEDULE1-DATETIME'] = formatDate(date2)+' '+convertTime($scope.campaign[emailName + '-SCHEDULE1-TIME']);;
			}else{
				$scope.campaign[emailName + '-SCHEDULE1-DATETIME'] = "";
			}
		}
	}
	*/
	
	/*
	function convertTimeFormat (timeString) {
		timeString = timeString.replace("PM", ":00 PM");
		timeString = timeString.replace("AM", ":00 AM");
		return timeString; 
	}
	*/
}

		

            
</script>