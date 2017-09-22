var action = '';
var campaignName = getParameterByName("campaign_name");
var campaignID = getParameterByName("campaign_id");
//if (campaignID === undefined || campaignID=='') {
if (!hasValue(campaignID)) {
	var keyword = campaignName + getCurrentDateTime();
	campaignID = $.md5(keyword);
}

$.fn.editable.defaults.mode = 'inline';
$.fn.editableform.buttons =
	'<button type="button" class="btn btn-primary btn-sm editable-submit"><i class="glyphicon glyphicon-ok"></i></button>' +
	'<button type="button" class="btn btn-default btn-sm editable-cancel"><i class="glyphicon glyphicon-remove"></i></button>' +
	'<button type="button" class="btn btn-default btn-sm editable-off"><i class="glyphicon glyphicon-trash"></i></button>';

$(document).ready(function() {
	$('#email_name').editable();

	$('.clockpicker').clockpicker({
		twelvehour: true
	});

	$("#EMAIL1-SCHEDULE1-DATE").datepicker();

	$(".touchspin2").TouchSpin({
		initval: 1,
		min: 0,
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

function startEditable(objID) {
	$('#subjectEmail' + objID).editable();
	//$('#template').trigger('change');

}

myApp.controller('myCtrl', function($scope, $http,Upload) {
	$scope.campaignID = campaignID;
	$scope.state = {
		Save: "Save",
		Publish: "Launch Program",
	};
	$scope.uploadBeforeSave = function () {
		var file = $('#eBookFile').prop('files')[0];
		if (file===undefined) {
			$scope.Save();
			return false;
		}
		var uploadFileName = "eBOOK-" + uuidv4();
		$scope.state['Save'] = "Saving";
		Upload.upload({
			url: 'upload.php',
			method: 'POST',
			file:file,
			data: {
				file:file, 
				's3':'true',
				'fileName':uploadFileName,
				'acctID':'accountID',
				'progID':'programID',
			}
		}).then(function (resp) {
			console.log(resp.data);
			if (resp.config.data.file != null) {
				console.log('Success ' + resp.config.data.file.name + 'uploaded');
				$scope.campaign['URL-eBOOK-LOCATION'] = resp.data.imgSrc;													 
			}
			$scope.Save();
		}, function (resp) {
			console.log('Error status: ' + resp.status);
		}, function (evt) {
			var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
			console.log('progress: ' + progressPercentage + '% ');
		});
	};
	$scope.Save = function(mode, silence) {
		$scope.state['Save'] = "Saving";
		//alert(mode);
		if (mode == 'Email') {
			$scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL1CONTENT'] = $scope.templatesAs1[$scope.tpsIndex('1')].contentRaw;
			$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-EMAIL1SUBJECT'] = $("#subjectEmail1").text();
			$scope.campaign['EMAIL1-SUBJECT'] = $("#subjectEmail1").text();
			$scope.campaign['EMAIL1-STATE'] = 'Start';
		}
		if (mode == 'Email2') {
			$scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL2CONTENT'] = $scope.templatesAs2[$scope.tpsIndex('2')].contentRaw;
			$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-EMAIL2SUBJECT'] = $("#subjectEmail2").text();
			$scope.campaign['EMAIL2-SUBJECT'] = $("#subjectEmail2").text();
			$scope.campaign['EMAIL2-STATE'] = 'Start';
		}
		if (mode == 'Email3') {
			$scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL3CONTENT'] = $scope.templatesAs3[$scope.tpsIndex('3')].contentRaw;
			$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-EMAIL3SUBJECT'] = $("#subjectEmail3").text();
			$scope.campaign['EMAIL3-SUBJECT'] = $("#subjectEmail3").text();
			$scope.campaign['EMAIL3-STATE'] = 'Start';
		}
		if (mode == 'Welcome') {
			$scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-WELCOMEPAGECONTENT'] = $scope.templatesWelcome[$scope.getListIndex('templatesWelcome','content','templateWelcome')].contentRaw;
		}
		if (mode == 'ThankYou') {
			$scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-DOWNLOADPAGECONTENT'] = $scope.templatesThankYou[$scope.getListIndex('templatesThankYou','content','templateThankYou')].contentRaw;
		}
		$http.put(dbEndPoint + "/" + dbName + '/' + campaignID, $scope.campaign).then(function(response) {
			$scope.campaign._rev = response.data.rev;

			//var currentDate = getCurrentDateTime();
			var currentDate = UTCDateTime(); //use GMT time zone to make angular sort() collrectly
			$http.get(dbEndPoint + "/" + dbName + '/campaignlist' + "?" + new Date().toString()).then(function(response) {
				$scope.campaignlist = response.data;
				if (action == "newCampaign") {
					if (typeof($scope.campaignlist.campaigns)=='undefined') {
						$scope.campaignlist.campaigns = [];
					}
					$scope.campaignlist.campaigns.push({
						"campaignID": $scope.campaign.campaignID,
						"accountID": accountID,
						"campaignName": $scope.campaign.campaignName,
						"createDate": currentDate,
						"lastEditDate": currentDate,
						"status": "Edit",
						"campaignType": $scope.campaign.campaignType
					});
					//action = 'editCampaign';
				} else {
					$scope.campaignlist.campaigns[$scope.clIndex()].lastEditDate = currentDate;
				}
				$http.put(dbEndPoint + "/" + dbName + '/campaignlist', $scope.campaignlist).then(function(response) {
					$scope.setDisplay();
					if (silence == true) {} else {
						//swal("Save Campaign Successful.", "", "success");
					}
					// Kwang backup current to master and clear formState
					$scope.master = angular.copy($scope.campaign);
					$scope.clearFormState();
					$scope.state['Save'] = 'Save';
                    //Kwang try auto publish
                    $scope.Publish(true);
					$scope.goEditMode(action);
				});
			}, function(errResponse) {
				// case new account
				if (errResponse.status == 404) {
					$scope.campaignlist = {
						campaigns: []
					};

					$scope.campaignlist.campaigns.push({
						"campaignID": $scope.campaign.campaignID,
						"accountID": accountID,
						"campaignName": $scope.campaign.campaignName,
						"createDate": currentDate,
						"lastEditDate": currentDate,
						"status": "Edit",
						"campaignType": $scope.campaign.campaignType
					});
					$http.put(dbEndPoint + "/" + dbName + '/campaignlist', $scope.campaignlist).then(function(response) {
						$scope.setDisplay();
						$scope.state['Save'] = 'Save';
						$scope.goEditMode(action);
					});
				} else {
					//alert(errResponse.statusText);
					$scope.state['Save'] = 'Save';
					swal(errResponse.statusText);
				}
				
			});

		});
		
	};
	$scope.goEditMode = function(action) {
		if (action == "newCampaign") {
			window.location.href = "editPromoteEbook.php?campaign_id="+campaignID;
		}
	};
	$scope.Cancel = function() {
		swal({
			title: "Are you sure?",
			text: "You will not be able to recover your last changed!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "OK!",
			closeOnConfirm: false
		}, function() {
			$scope.Reset(true);

		});
	};
	$scope.Reset = function(alert) {
		$scope.campaign = angular.copy($scope.master);
		$("#subjectEmail1").text($scope.campaign['EMAIL1-SUBJECT']);
		$("#subjectEmail2").text($scope.campaign['EMAIL2-SUBJECT']);

		if (alert) {
			$scope.$apply();
			$scope.SelectChanged('viewEmail1', 'templateEmail1');
			$scope.sendersChanged('textSender1');
			// Kwang clear form state
			$scope.clearFormState();
			swal("Cancel!", "You are back to previous version.", "success");
		}
	};
	$scope.Load = function() {
		$http.get(dbEndPoint + "/" + dbName + '/' + campaignID + "?" + new Date().toString()).then(function(response) {
			action = 'editCampaign';
			$scope.master = response.data;
			$scope.campaign = angular.copy($scope.master);
			$scope.openEmail1 = true; //Email #1 always open.
			$scope.setInitValue();
			$scope.setDisplay();
			$scope.LoadAudience();
			$scope.Reset();
		}, function(errResponse) {
			if (errResponse.status == 404) {
				action = 'newCampaign';
				$scope.campaign = {
					"campaignID": campaignID,
					"campaignName": campaignName,
					"campaignType": "PromoteEbook",
					"accountID": accountID,
					"totalEmail": "2",
					"publishProgramName": "",
					"publishDate": "",
					"filterSelected": []
				};
				$scope.openEmail1 = true; //Email #1 always open.
				$scope.setInitValue();
				$scope.setDisplay();
				$scope.LoadAudience();
			} else {
				//alert(errResponse.statusText);
				swal(errResponse.statusText);
			}
		});

	};
	$scope.setInitValue = function() {
		$scope.initTemplateWelcome();
		$scope.initTemplateThankyou();
		$scope.initTemplateEmail('1');
		$scope.initListForm();
		$scope.initSender();
	};
	$scope.initTemplateEmail = function(emlID) {
		if ($scope['openEmail' + emlID]) {
			$http.get("/admin/getEmailTemplate.php?blueprint=PromoteBlog&scopeName=campaign&as=" + emlID).then(function(response) {
				$scope['templatesAs' + emlID] = response.data.templates;
				if (emlID == '1') {
					$scope.config = response.data.config;
					$scope.campaign = jQuery.extend(true, {}, $scope.config, $scope.campaign);
				}
				$("#subjectEmail" + emlID).text($scope.campaign['EMAIL' + emlID + '-SUBJECT']);
				$scope.SelectChanged('viewEmail' + emlID, 'templateEmail' + emlID);
				$scope.sendersChanged('textSender' + emlID);
				startEditable(emlID);
			});
		}
	};
	$scope.initTemplateWelcome = function(){
		$http.get("/admin/getEmailTemplate.php?blueprint=PromoteEbook&scopeName=campaign&resource=pages").then(function(response) {
			$scope['templatesWelcome']  = response.data.templates; 
			$scope.config = response.data.config; 
			$scope.campaign = jQuery.extend(true, {},$scope.config,$scope.campaign);
			$scope.SelectChanged('viewWelcome','templateWelcome');
		});
	};
	$scope.initTemplateThankyou = function(){
		$http.get("/admin/getEmailTemplate.php?blueprint=PromoteEbook&scopeName=campaign&resource=pages").then(function(response) {
			$scope['templatesThankYou']  = response.data.templates; 
			$scope.config = response.data.config; 
			$scope.campaign = jQuery.extend(true, {},$scope.config,$scope.campaign);
			$scope.SelectChanged('viewThankYou','templateThankYou');
		});
	};
	$scope.initListForm = function(){
		$http.get(dbEndPoint + "/" + dbName +"/formLibrary?"+new Date().toString()).then(function(response) {
			$scope.listForm = response.data.items;
			if (typeof $scope.listForm == 'undefined') {
				$scope.listForm = [];
			}
		});
	};
	$scope.initSender = function() {
		$scope.senders = [];
		$scope.senders.push({
			"email": "boonsom@mindfireinc.com",
			"name": "Boonsom Coa"
		});
		$scope.senders.push({
			"email": "kdutta@mindfireinc.com",
			"name": "Kushal Dutta"
		});
		$scope.senders.push({
			"email": "daver@mindfireinc.com",
			"name": "David Rosendahl"
		});
		$scope.senders.push({
			"email": "mcfarsheed@mindfireinc.com",
			"name": "Mackenzi Farsheed"
		});
	};
	$scope.setDisplay = function(){
		$scope.openEmail = {
			"1":true,
			"2":false,
			"3":false,
		};
		$scope.openEmail2 = false;
		$scope.openEmail3 = false;
		$scope.step1Done = hasValue($scope.campaign['URL-eBOOK-LOCATION']);
		$scope.step2Done = hasValue($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-WELCOMEPAGECONTENT']);
		$scope.step3Done = hasValue($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL1CONTENT']);
		$scope.step4Done = $scope.step3Done;
		$scope.step5Done = $scope.step4Done;
		if ($scope.campaign.totalEmail > '3')	{
			$scope.emailProgress = $scope.campaign.totalEmail+' of '+$scope.campaign.totalEmail+' emails ready';
		} else {
			var emailDone = '0';
			if ($scope.step3Done) {
				emailDone = '1';
				if (hasValue($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL2CONTENT'])) {
					emailDone = '2';
					$scope.openEmail2 = true;
					$scope.openEmail["2"] = true;
				}
				if (hasValue($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL3CONTENT'])) {
					emailDone = '3';
					$scope.openEmail3 = true;
					$scope.openEmail["3"] = true;
				}
			}
			$scope.emailProgress = emailDone+' of '+$scope.campaign.totalEmail+' emails ready';
		}

		var pageDone = '0';
		if ($scope.step2Done) {
			pageDone = '1';
			if (hasValue($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-DOWNLOADPAGECONTENT'])) {
				pageDone = '2';
			}
		}
		$scope.pageProgress = pageDone+' of 2 Pages Configured';
		$scope.scheduleProgress = emailDone+' Drip Emails Configured';
	};
	$scope.SelectChanged = function(emailViewID, templateField) {
		//$scope.content = angular.copy($scope.templateEmail1);
		$("#" + emailViewID).html($scope.campaign[templateField]);
		angular.element(document).injector().invoke(function($compile) {
			var scope = angular.element($("#" + emailViewID)).scope();
			$compile($("#" + emailViewID))(scope);
		});
	};
	$scope.sendersChanged = function(senderTextID) {
		if (!hasValue($scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMEMAIL'])) {
			$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMNAME'] = '';
			$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMEMAIL'] = '';
		} else {
			$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMNAME'] = $scope.senders[$scope.sdIndex()].name
			$("#" + senderTextID).text('New Email from: "' + $scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMNAME'] + '" <' + $scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMEMAIL'] + '>');
		}
	};
	$scope.startEmail = function(cmd) {
		var currentEmail = '1';
		var email1Fields = ["EMAIL1-BACKGROUND-COLOR", "EMAIL1-BOTTOM-TEXT", "EMAIL1-BUTTON-COLOR", "EMAIL1-CTA-TEXT", "EMAIL1-HERO-IMAGE", "EMAIL1-NAME", "EMAIL1-SUBJECT", "EMAIL1-TOP-TEXT", "EMAIL1-VIEW-ONLINE-LINK", "EMAIL1-STUDIO-TRACKER", "templateEmail1"];
		if (cmd.endsWith("2")) {
			currentEmail = '2';
			$scope.openEmail2 = true;
			if (cmd == 'COPY2') {
				$scope.copyEmail(email1Fields, '1', '2');
			} else {
				$scope.copyEmail(email1Fields, '2', '2');
			}
		} else if (cmd.endsWith("3")) {
			currentEmail = '3';
			$scope.openEmail3 = true;
			if (cmd == 'COPY3') {
				$scope.copyEmail(email1Fields, '2', '3');
			} else {
				$scope.copyEmail(email1Fields, '3', '3');
			}
		}
	};
	$scope.copyEmail = function(fields, src, tar) {
		if (src != tar) {
			var emailSRCFields = fields.map(function(x) {
				return x.replace(/1/g, src)
			});
			var emailTARFields = fields.map(function(x) {
				return x.replace(/1/g, tar)
			});
			for (var i = 0; i < fields.length; i++) {
				if (emailTARFields[i] == "templateEmail" + tar) {
					$scope.campaign[emailTARFields[i]] = $scope.campaign[emailSRCFields[i]].replace(new RegExp("campaign\\[\\'EMAIL" + src, "gi"), "campaign['EMAIL" + tar);
				} else {
					$scope.campaign[emailTARFields[i]] = $scope.campaign[emailSRCFields[i]];
				}
			}
		}
		$http.get("/admin/getEmailTemplate.php?blueprint=PromoteBlog&scopeName=campaign&as=" + tar).then(function(response) {
			$scope['templatesAs' + tar] = response.data.templates;
			$scope.config = response.data.config;
			$("#subjectEmail" + tar).text($scope.campaign['EMAIL' + tar + '-SUBJECT']);
			$scope.SelectChanged('viewEmail' + tar, 'templateEmail' + tar);
			$scope.sendersChanged('textSender' + tar);
			startEditable(tar);
		});
	}
	$scope.clIndex = function() {
		var cplist = $scope.campaignlist.campaigns;
		for (var i = 0; i < cplist.length; i++) {
			if (cplist[i]["campaignID"] == campaignID) {
				return i;
			}
		}
	};
	$scope.tpsIndex = function(emlID) {
		var tplist = $scope['templatesAs' + emlID];
		for (var i = 0; i < tplist.length; i++) {
			if (tplist[i]["content"] == $scope.campaign['templateEmail' + emlID]) {
				return i;
			}
		}
	};
	$scope.sdIndex = function() {
		var sdlist = $scope.senders;
		for (var i = 0; i < sdlist.length; i++) {
			if (sdlist[i]["email"] == $scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMEMAIL']) {
				return i;
			}
		}
	};
	$scope.getListIndex = function(tpName,tpField,cpField) {
		var tpList = $scope[tpName];
		for(var i=0;i < tpList.length; i++){
		  if (tpList[i][tpField] == $scope.campaign[cpField])
		  {
			return i;
		  } 
		}
	};
	$scope.CanPublish = function() {
		return $scope.step1Done == true && $scope.step2Done == true && $scope.step3Done == true && $scope.step4Done == true;
	};
	$scope.RePublish = function(silenceMode){
		console.log("RePublish");
		$scope.state['Publish'] = "Re Launching";
		$http({
			method: 'POST',
			url: 'backend.php' + "?" + new Date().toString(),
			data: ObjecttoParams({
				"cmd": "update",
				"acctID": accountID,
				"progID": campaignID,
			}),
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			}
		}).then(function(response) {
			if (response.data.success == false) {
				var errorMessage = prettyStudioErrorMessage(response.data.detail.Result.ErrorMessage);
                if(!$scope.silenceMode){
                    swal(response.data.detail.Result.ErrorCode,errorMessage);
                }
			} else {
                if(!$scope.silenceMode){
                    swal(response.data.message);
                }
			}
			var str = JSON.stringify(response.data, null, 4); // (Optional) beautiful indented output.
			console.log(str); // Logs output to dev tools console.
			$scope.state['Publish'] = "Launch Program";
			//alert(response);
		}, function(errResponse) {
			$scope.state['Publish'] = "Launch Program";
            //if(!$scope.silenceMode){
                swal("Server Error");
            //}
			//alert(errResponse);
		});
	}
    $scope.silenceMode = false;
	$scope.Publish = function(silenceMode) {
        if(typeof silenceMode == "undefined"){
            silenceMode = false;
        }
        $scope.silenceMode = silenceMode;
		//check if we already publish this campaign
		if(hasValue($scope.campaign['publishProgramID'])){
			//alert('Already publish ' + $scope.campaign['publishProgramID']);
			$scope.RePublish(silenceMode);
			return;
		}
		$scope.state['Publish'] = "Launching";
		$http({
			method: 'POST',
			url: 'backend.php' + "?" + new Date().toString(),
			data: ObjecttoParams({
				"cmd": "publish",
				"acctID": accountID,
				"progID": campaignID,
			}),
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			}
		}).then(function(response) {
			if (response.data.success == false) {
				var errorMessage = prettyStudioErrorMessage(response.data.detail.Result.ErrorMessage);
                if(!$scope.silenceMode){
                    swal(response.data.detail.Result.ErrorCode,errorMessage);
                }
			} else {
                if(!$scope.silenceMode){
                    swal(response.data.message);
                }
				// set public programID back to tree
				$scope.campaign['publishProgramID'] = response.data.publishProgramID;
			}
			$scope.state['Publish'] = "Launch Program";
			var str = JSON.stringify(response.data, null, 4); // (Optional) beautiful indented output.
			console.log(str);
			
			//alert(response);
		}, function(errResponse) {
			$scope.state['Publish'] = "Launch Program";
            //if(!$scope.silenceMode){
                swal("Server Error");
            //}
			//alert(errResponse);
		});
	};
	// Kwang clear form state
	$scope.clearFormState = function() {
		//$scope.frmStep3.$setPristine();
	};
	//Kwang uiSwitch change
	$scope.SwitchChange = function() {
		$scope.campaign['OPEN-MY-EMAIL'] = MapTrueFalse($scope.campaign['OPEN-MY-EMAIL-'], "Start", "Stop");
		$scope.campaign['CALL-TO-ACTION'] = MapTrueFalse($scope.campaign['CALL-TO-ACTION-'], "Start", "Stop");
		$scope.campaign['VISIT-MY-BLOCK'] = MapTrueFalse($scope.campaign['VISIT-MY-BLOCK-'], "Start", "Stop");
		$scope.campaign['DOWNLOAD-MY-EBOOK'] = MapTrueFalse($scope.campaign['DOWNLOAD-MY-EBOOK-'], "Start", "Stop");
		$scope.campaign['VISIT-MY-EBOOK'] = MapTrueFalse($scope.campaign['VISIT-MY-EBOOK-'], "Start", "Stop");
		$scope.Save("", true); //silence save
		//alert('SwitchChange');
	};

	$scope.ViewReport = function() {
		//window.location.href = "reporting.php?campaignID=" + campaignID;
		window.open("reporting.php?campaignID=" + campaignID);

	};

	$scope.LoadAudience = function() {

		if (typeof $scope.campaign['filterSelected'] == 'undefined') {
			$scope.filterList = [];
		} else {
			$scope.filterList = $scope.campaign['filterSelected'];
		}
		$http.get(dbEndPoint + "/" + dbName + '/audienceLists' + "?" + new Date().toString()).then(function(response) {
			$scope.masterAu = response.data;
			if (typeof $scope.masterAu.items == 'undefined') {
				$scope.masterAu.items = [];
			}
			$scope.audience = angular.copy($scope.masterAu);
		}, function(errResponse) {
			if (errResponse.status == 404) {
				alert("ERROR 404 [audienceLists]");
			}
		});
	};

	$scope.DuplicateCampaignClick = function(){
		swal({
		  title: 'What is your new campaign name?',
		  input: 'text',
		  //inputPlaceholder: campaignName + " (copy)",
		  inputValue: $scope.campaign.campaignName + " (copy)",
		  showCancelButton: true,
		}).then($scope.DuplicateCampaignOK);
	};
	
	$scope.DuplicateCampaignOK = function(newCampaignName){
		newCampaignName = newCampaignName.trim();
		$http.get("backend.php"+"?" + new Date().toString(),
			{
			  method: "POST",
			  params: {
				cmd: "copy",
				acctID: accountID,
				progID: campaignID,
				name: newCampaignName,
				mode: "junk",
			  }  
			}
		).then(function(response) {
			console.log(response.data);
			if(response.data.success == true){
				swal({
					type: 'success',
					html: "Campaign [" + response.data.newCampaignName + "] created",
				});
			}else{
				swal({
					type: 'error',
					html: "Campaign [" + response.data.newCampaignName + "] copy fail<br>" + response.data.addRet.message,
				});
			}
		});                
	}
	$scope.Load();
});

function toDate(dateStr) {
	var parts1 = dateStr.split(" ");

	var parts2 = parts1[0].split("/");

	return new Date(parts2[2], parts2[0] - 1, parts2[1]);
}


function addDays(theDate, days) {
	return new Date(theDate.getTime() + days * 24 * 60 * 60 * 1000);
}

function formatDateMDY(date) {
	var year = date.getFullYear();
	month = date.getMonth() + 1; // months are zero indexed
	day = date.getDate();


	return str_pad(month) + "/" + str_pad(day) + "/" + year;
}

function convertTime(timeString) {
	var hourEnd = timeString.indexOf(":");
	var H = +timeString.substr(0, hourEnd);
	var h = H % 12 || 12;
	var ampm = H < 12 ? ":00 AM" : ":00 PM";
	timeString = h + timeString.substr(hourEnd, 3) + ampm;


	return timeString; // return adjusted time or original string
}

function str_pad(n) {
	return String("0" + n).slice(-2);
}

function convertTimeFormat(timeString) {
	timeString = timeString.replace("PM", ":00 PM");
	timeString = timeString.replace("AM", ":00 AM");
	return timeString;
}

function hasValue(obj, defaultValue) {
	if (obj === undefined || obj == '') {
		return false;
	} else {
		//make sure that it is not default if provided
		if (defaultValue === undefined) {} else {
			if (obj == defaultValue) {
				return false;
			}
		}
		return true;
	}
}

function ObjecttoParams(obj) {
	var p = [];
	for (var key in obj) {
		p.push(key + '=' + encodeURIComponent(obj[key]));
	}
	return p.join('&');
};

function MapTrueFalse(obj, trueValue, falseValue) {
	if (obj == true) {
		return trueValue;
	} else {
		return falseValue;
	}
}

function formatDate(date) {
	var monthNames = [
		"January", "February", "March",
		"April", "May", "June", "July",
		"August", "September", "October",
		"November", "December"
	];

	var day = date.getDate();
	var monthIndex = date.getMonth();
	var year = date.getFullYear();

	return day + ' ' + monthNames[monthIndex] + ' ' + year;
}

function checkdate(datetime1, timezone1){
	timezone1 = convertTimezone(timezone1);				

	//time1 = convert_to_24h(convertTimeFormat(time1));
	
	// Create date from input value
	var d1 = new Date(datetime1+' '+timezone1);
	//var inputDate= dateFormat(d1, "yyyy-mm-dd HH:MM:ss",true);
	var inputDate= dateFormat(d1, "isoDateTime", true);
	//alert(inputDate);

	// Get today's date
	var d2 = new Date();
	//var todaysDate= dateFormat(d2, "yyyy-mm-dd HH:MM:ss",true);
	var todaysDate= dateFormat(d2, "isoDateTime", true);
	//alert(todaysDate);

	if (inputDate < todaysDate) {
		//alert('past date');
		return false;
	} else {
		//alert('ok');
		return true;
	}
}			


function convertTimezone(timezone) {
	if (timezone == 'Pacific Standard Time') {
		timezone = 'PDT';
	} else if (timezone == 'Mountain  Standard Time') {
		timezone = 'MDT';
	} else if (timezone == 'Central Standard Time') {
		timezone = 'CDT';
	} else if (timezone == 'Eastern Standard Time') {
		timezone = 'EDT';
	} else {
		timezone = 'PDT';
	}
	return timezone;
}


function convert_to_24h(time_str) {
	// Convert a string like 10:05:23 PM to 24h format, returns like [22,5,23]
	var time = time_str.match(/(\d+):(\d+):(\d+) (\w)/);
	var hours = Number(time[1]);
	var minutes = Number(time[2]);
	var seconds = Number(time[3]);
	var meridian = time[4].toLowerCase();

	if (meridian == 'p' && hours < 12) {
	  hours += 12;
	}
	else if (meridian == 'a' && hours == 12) {
	  hours -= 12;
	}
	return str_pad(hours)+':'+str_pad(minutes)+':'+str_pad(seconds);
};