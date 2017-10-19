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
    '<button type="button" class="btn btn-primary btn-sm editable-submit" title="Done"><i class="glyphicon glyphicon-ok"></i></button>' +
    '<button type="button" class="btn btn-default btn-sm editable-cancel" title="Cancel"><i class="glyphicon glyphicon-remove"></i></button>';

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

myApp.controller('myCtrl', function($scope, $http) {

		/* Dave added this as mock for notifications: scope.notify*, scope.users, and scope.creatOptions */
		$scope.notifyTheseUsersForOpens  = ['the-currently-logged-in-user@domain.com'];
		$scope.notifyTheseUsersForVisits  = ['the-currently-logged-in-user@domain.com'];
		$scope.notifyTheseUsersForCTACompletions  = ['the-currently-logged-in-user@domain.com'];

	/* Dave added this as mock for notifications; this will likely need to read from CouchDB */	
		$scope.users = [
			'kdutta@mindfireinc.com',
			'daver@mindfireinc.com',
			'mcfarsheed@mindfireinc.com',
			'demandgen@mindfireinc.com',
			'the-currently-logged-in-user@domain.com',
		];

	/* Dave added this as mock for notifications; this allows user to add another email address on-the-fly.  Feel free to keep DRY here and re-write to save lines */	
		$scope.addUserForOpens = function(term) {
			$scope.$apply(function() {
				$scope.users.push(term);
				$scope.notifyTheseUsersForOpens.push(term);
			});
		}

		$scope.addUserForVisits = function(term) {
			$scope.$apply(function() {
				$scope.users.push(term);
				$scope.notifyTheseUsersForVisits.push(term);
			});
		}

		$scope.addUserForCTACompletions = function(term) {
			$scope.$apply(function() {
				$scope.users.push(term);
				$scope.notifyTheseUsersForCTACompletions.push(term);
			});
		}
		
		
	
	
		$scope.campaignID = campaignID;
    $scope.state = {
        Save: "Save",
        Publish: "Launch Program",
    };
    $scope.Save = function(mode, silence) {
        $scope.state['Save'] = "Saving";
        //alert(mode);
		for (var key in $scope.openEmail) {
			if (hasValue($scope['templatesAs'+key])) {
				$scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL'+key+'CONTENT'] = $scope.getContentRaw($scope['templatesAs'+key], $scope.campaign['templateEmail'+key], 'TEXT-AREA-ACCTID-PROGRAMID-EMAIL'+key+'CONTENT');
				$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-EMAIL'+key+'SUBJECT'] = $scope.campaign['EMAIL'+key+'-SUBJECT'];
			}
		}
        if (mode == 'Step3') {
            var date1 = $scope.campaign['EMAIL1-SCHEDULE1-DATE'];
            var time1 = $scope.campaign['EMAIL1-SCHEDULE1-TIME'];
            var timezone1 = $scope.campaign['EMAIL1-SCHEDULE1-TIMEZONE'];
            var publishProgramID = $scope.campaign['publishProgramID'];

            
            
            if ((typeof date1 == 'undefined') || (typeof time1 == 'undefined') || (timezone1 == "")){
                swal('Please set schedule for Email1');
                $scope.state['Save'] = "Save";
                return;
            } else {
                if ((typeof publishProgramID == 'undefined') || (publishProgramID == "")) {
                    var datetime1 = $scope.campaign['EMAIL1-SCHEDULE1-DATETIME'];								
                    if (checkdate(datetime1, timezone1)) {
                    } else {
                        swal('Please do not set "PAST" times for Email1');
                        $scope.state['Save'] = "Save";
                        return;
                    }	
                } else {
                }
            }

            if(hasValue($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL2CONTENT'])){
				var datetime1 = $scope.campaign['EMAIL1-SCHEDULE1-DATETIME'];								
                var wait2 = $scope.campaign['EMAIL2-WAIT'];
                var time2 = $scope.campaign['EMAIL2-SCHEDULE1-TIME'];
                var timezone2 = $scope.campaign['EMAIL2-SCHEDULE1-TIMEZONE'];
                if ((wait2 == "") || (typeof time2 == 'undefined') || (time2 == '') || (timezone2 == "")){
                    swal('Please set schedule for Email2');
                    $scope.state['Save'] = "Save";
                    return;
                } else {
                    
                    var datetime2 = $scope.campaign['EMAIL2-SCHEDULE1-DATETIME'];								
                    if (comparedate(datetime1, timezone1, datetime2, timezone2)) {
                    } else {
                        swal('Email2 must have a schedule later than Email1.');
                        $scope.state['Save'] = "Save";
                        return;
                    }
                    
                }
            }

            if(hasValue($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL3CONTENT'])){
				var datetime1 = $scope.campaign['EMAIL1-SCHEDULE1-DATETIME'];								
                var wait3 = $scope.campaign['EMAIL3-WAIT'];
                var time3 = $scope.campaign['EMAIL3-SCHEDULE1-TIME'];
                var timezone3 = $scope.campaign['EMAIL3-SCHEDULE1-TIMEZONE'];
                if ((wait3 == "") || (typeof time3 == 'undefined') || (time3 == '') || (timezone3 == "")){
                    swal('Please set schedule for Email3');
                    $scope.state['Save'] = "Save";
                    return;
                } else {
                    var datetime3 = $scope.campaign['EMAIL3-SCHEDULE1-DATETIME'];								
                    if (comparedate(datetime1, timezone1, datetime3, timezone3)) {
                    } else {
                        swal('Email3 must have a schedule later than Email1.');
                        $scope.state['Save'] = "Save";
                        return;
                    }

                    if (comparedate(datetime2, timezone2, datetime3, timezone3)) {
                    } else {
                        swal('Email3 must have a schedule later than Email2.');
                        $scope.state['Save'] = "Save";
                        return;
                    }
                }
            }						

            
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
					$scope.campaignlist.campaigns[$scope.clIndex()].campaignName = $scope.campaign.campaignName;
                }
                $http.put(dbEndPoint + "/" + dbName + '/campaignlist', $scope.campaignlist).then(function(response) {
                    $scope.setDisplay();
                    if (silence == true) {} else {
                        //swal("Save Campaign Successful.", "", "success");
                    }
                    // Kwang backup current to master and clear formState
                    $scope.master = angular.copy($scope.campaign);
                    $scope.clearFormState();
                    $scope.goEditMode(action);
                });
            }, function(errResponse) {
                // case new account
                if (errResponse.status == 404 || errResponse.status == 504) {
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
						$scope.goEditMode(action);
                        //swal("Save Campaign Successful.", "", "success");
                        //alert("Save Campaign Successful.");
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
			window.location.href = "editPromoteBlog.php?campaign_id="+campaignID+"&nocache=" + new Date().toString();
		}
		$scope.state['Save'] = 'Save';
	};
    $scope.Cancel = function() {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover your last changed!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "OK!"
		}).then(function () {
			$scope.Reset(true);
        });
    };

    $scope.Reset = function(alert) {
        $scope.campaign = angular.copy($scope.master);
		$('#subjectEmail1').editable("setValue",$scope.campaign['EMAIL1-SUBJECT']);
		$('#subjectEmail2').editable("setValue",$scope.campaign['EMAIL2-SUBJECT']);
		$('#subjectEmail3').editable("setValue",$scope.campaign['EMAIL3-SUBJECT']);
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
            //$scope.openEmail1 = true; //Email #1 always open.
			$scope.setCampaignName();
            $scope.setInitValue();
            $scope.setDisplay();
			$scope.LoadDefaultPromoteBlog(); 
            $scope.LoadAudience();
            $scope.Reset();
        }, function(errResponse) {
            if (errResponse.status == 404) {
                action = 'newCampaign';
                $scope.campaign = {
                    "campaignID": campaignID,
                    "campaignName": campaignName,
                    "campaignType": "PromoteBlog",
                    "accountID": accountID,
                    "totalEmail": "3",
                    "publishProgramName": "",
                    "publishDate": "",
                    "filterSelected": []
                };
                //$scope.openEmail1 = true; //Email #1 always open.
				$scope.setCampaignName();
                $scope.setInitValue();
                $scope.setDisplay();
                $scope.LoadAudience();
            } else {
                //alert(errResponse.statusText);
                swal(errResponse.statusText);
            }
        });

    };
	$scope.setCampaignName = function() {
        $("#editCampaignName").text($scope.campaign.campaignName);
		$("#editCampaignName").editable({
			tpl: '<input type="text" maxlength="50">'
			,validate:function(value){
				if($.trim(value) == '') {
						//swal("Oops...","Please enter Campaign Name!","warning");
						return 'Campaign Name is required';
				}
			}
		});
		//$('#template').trigger('change');
		$("#editCampaignName").on('save', function(e, params) {
			$scope.campaign.campaignName = params.newValue;
			$scope.Save();
			/*if($.trim(params.newValue) == '') {
				swal({
					title: "Oops...",
					text: "Please enter Campaign Name!",
					type: "warning",
					confirmButtonText: "OK!"
				}).then(function () {
					$('#editCampaignName').editable("setValue",$scope.campaign.campaignName);
				});				
			} else {
				$scope.campaign.campaignName = params.newValue;
				$scope.Save();
			}*/
		});
    };
    $scope.setInitValue = function() {
        $scope.initTemplateEmail('1');
        $scope.initSender();
    };
    $scope.initTemplateEmail = function(emlID) {
        if (!hasValue($scope['templatesAs'+emlID]) && $scope.openEmail[emlID]) {
            $http.get("/admin/getEmailTemplate.php?blueprint=PromoteBlog&scopeName=campaign&as=" + emlID).then(function(response) {
                $scope['templatesAs' + emlID] = response.data.templates;
                if (emlID == '1') {
                    $scope.config = response.data.config;
                    $scope.campaign = jQuery.extend(true, {}, $scope.config, $scope.campaign);
                }
                $("#subjectEmail" + emlID).text($scope.campaign['EMAIL' + emlID + '-SUBJECT']);
                $scope.SelectChanged('viewEmail' + emlID, 'templateEmail' + emlID);
                $scope.sendersChanged('textSender' + emlID);
                $scope.startEditable(emlID);
                $scope.campaign['defButtonStyle'] = {
                    "background-color":"#" + $scope.campaign['defButtonColor'] ,
                    "border-radius":"3px",
                    "text-align":"center",
                };
            });
        }
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
    $scope.setDisplay = function() {
        $scope.disabledEmail = {
            "1":false,
            "2":false,
            "3":false,
        };
        $scope.step1Done = hasValue($scope.campaign['URL-BLOG-POST-URL']);
        $scope.step2Done = hasValue($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL1CONTENT']);
        $scope.step3Done = hasValue($scope.campaign['EMAIL1-SCHEDULE1-DATETIME'], "01/01/2050 08:00:00 AM");
        $scope.step4Done = $scope.step3Done;
        if ($scope.campaign.totalEmail > '3') {
            $scope.emailProgress = $scope.campaign.totalEmail + ' of ' + $scope.campaign.totalEmail + ' emails ready';
        } else {
            var emailDone = '0';
            if ($scope.step2Done) {
                emailDone = '1';
                if (hasValue($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL2CONTENT'])) {
                    emailDone = '2';
                    $scope.openEmail["2"] = true;
                }
                if (hasValue($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL3CONTENT'])) {
                    emailDone = '3';
                    $scope.openEmail["3"] = true;
                }
            }
            $scope.emailProgress = emailDone + ' of 3 Emails Ready';
						$scope.emailDone = emailDone;
        }

		var publishProgramID = $scope.campaign['publishProgramID'];
		if ((typeof publishProgramID == 'undefined') || (publishProgramID == "")) {

		} else {
			var d1 = $scope.campaign['EMAIL1-SCHEDULE1-DATETIME'];
			if (d1 == "01/01/2050 08:00:00 AM")	{
				
			} else {

				var datetime1 = $scope.campaign['EMAIL1-SCHEDULE1-DATETIME'];								
				var timezone1 = $scope.campaign['EMAIL1-SCHEDULE1-TIMEZONE'];								
                if (checkdate(datetime1, timezone1)) {
					$('#datespan1').show();
					$('#clockspan1').show();
                } else {
                    $scope.disabledEmail["1"] = true;
					$('#datespan1').hide();
					$('#clockspan1').hide();
                }				
			}
			if(hasValue($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL2CONTENT'])){
				var d2 = $scope.campaign['EMAIL2-SCHEDULE1-DATETIME'];
				if (d2 == "01/01/2050 08:00:00 AM")	{
					
				} else {
					var datetime2 = $scope.campaign['EMAIL2-SCHEDULE1-DATETIME'];								
					var timezone2 = $scope.campaign['EMAIL2-SCHEDULE1-TIMEZONE'];								
					if (checkdate(datetime2, timezone2)) {
						$('#clockspan2').show();
					} else {
						$scope.disabledEmail["2"] = true;
						$('#clockspan2').hide();
					}
				}
			}
			if(hasValue($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL3CONTENT'])){        
				var d3 = $scope.campaign['EMAIL3-SCHEDULE1-DATETIME'];
				if (d3 == "01/01/2050 08:00:00 AM")	{
					
				} else {
					var datetime3 = $scope.campaign['EMAIL3-SCHEDULE1-DATETIME'];								
					var timezone3 = $scope.campaign['EMAIL3-SCHEDULE1-TIMEZONE'];								
					if (checkdate(datetime3, timezone3)) {
						$('#clockspan3').show();
					} else {
						$scope.disabledEmail["3"] = true;
						$('#clockspan3').hide();
					}
				}
			}
		}
		
		$scope.hasNotifications = false;
		$scope.labelNotifications = 'Alerted on';
		if (hasValue($scope.campaign['OPEN-MY-EMAIL-'], false)) {
			$scope.hasNotifications = true;
			$scope.labelNotifications += ' Opens';
		}
		if (hasValue($scope.campaign['VISIT-MY-BLOCK-'], false)) {
			$scope.hasNotifications = true;
			if ($scope.labelNotifications == 'Alerted on') {
				$scope.labelNotifications += ' Clicks';
			} else {
				if (hasValue($scope.campaign['CALL-TO-ACTION-'], false)) {
					$scope.labelNotifications += ', Clicks';
				} else {
					$scope.labelNotifications += ' and Clicks';
				}
			}
		}
		if (hasValue($scope.campaign['CALL-TO-ACTION-'], false)) {
			$scope.hasNotifications = true;
			if ($scope.labelNotifications == 'Alerted on') {
				$scope.labelNotifications += ' Conversions';
			} else {
				$scope.labelNotifications += ' and Conversions';
			}
		}
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
            $scope.openEmail['2'] = true;
            if (cmd == 'COPY2') {
                $scope.copyEmail(email1Fields, '1', '2');
            } else {
                $scope.copyEmail(email1Fields, '2', '2');
            }
        } else if (cmd.endsWith("3")) {
            currentEmail = '3';
            $scope.openEmail['3'] = true;
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
            $scope.startEditable(tar);
        });
    }
	$scope.getContentRaw = function(templates, selected, field) {
		for (var i = 0; i < templates.length; i++) {
            if (templates[i]["content"] == selected) {
                return templates[i]["contentRaw"];
            }
        }
		if (hasValue($scope.campaign[field])) {
			return $scope.campaign[field];
		} else {
			return '';
		}
	}
    $scope.clIndex = function() {
        var cplist = $scope.campaignlist.campaigns;
        for (var i = 0; i < cplist.length; i++) {
            if (cplist[i]["campaignID"] == campaignID) {
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
    $scope.CanPublish = function() {
        return $scope.step1Done == true && $scope.step2Done == true && $scope.step3Done == true && $scope.step4Done == true;
    };
    $scope.RePublish = function(){
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
                swal(response.data.detail.Result.ErrorCode,errorMessage);
            } else {
                swal(response.data.message);
            }
            var str = JSON.stringify(response.data, null, 4); // (Optional) beautiful indented output.
            console.log(str); // Logs output to dev tools console.
            $scope.state['Publish'] = "Launch Program";
            //alert(response);
			$scope.state['Save'] = 'Save';
        }, function(errResponse) {
            $scope.state['Publish'] = "Launch Program";
            swal("Server Error");
            //alert(errResponse);
			$scope.state['Save'] = 'Save';
        });
    }
    $scope.PublishProgram = function(pAccountID,pCampaignID) {
        $http({
            method: 'POST',
            url: 'backend.php' + "?" + new Date().toString(),
            data: ObjecttoParams({
                "cmd": "publish",
                "acctID": pAccountID,
                "progID": pCampaignID,
            }),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function(response) {
            if (response.data.success == false) {
                //var errorMessage = prettyStudioErrorMessage(response.data.detail.Result.ErrorMessage);
                //swal(response.data.detail.Result.ErrorCode,errorMessage);
            } else {
                //swal(response.data.message);
                // set public programID back to tree
                $scope.campaign['publishProgramID'] = response.data.publishProgramID;
            }
            var str = JSON.stringify(response.data, null, 4); // (Optional) beautiful indented output.
            console.log(str);
            //alert(response);
        }, function(errResponse) {
            //swal("Server Error");
            //alert(errResponse);
        });

    }
    $scope.Publish = function() {
        //check if we already publish this campaign
        if(hasValue($scope.campaign['publishProgramID'])){
            //alert('Already publish ' + $scope.campaign['publishProgramID']);
            $scope.RePublish();
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
                swal(response.data.detail.Result.ErrorCode,errorMessage);
            } else {
                swal(response.data.message);
                // set public programID back to tree
                $scope.campaign['publishProgramID'] = response.data.publishProgramID;
            }
            $scope.state['Publish'] = "Launch Program";
            var str = JSON.stringify(response.data, null, 4); // (Optional) beautiful indented output.
            console.log(str);
            
            //alert(response);
        }, function(errResponse) {
            $scope.state['Publish'] = "Launch Program";
            swal("Server Error");
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
        $scope.Save("", true); //silence save
        //alert('SwitchChange');
    };

	$scope.CheckSumAudience = function() {
			var form_data = $("#idForm").serialize();	
			var listdefinition = $("#LISTDEFINITION").val(); 
			$.ajax({
						url: 'countClick.php', 
						dataType: 'json',  
						cache: false,
						contentType: false,
						processData: false,
						data: form_data,   
						type: 'get',
						success: function(json){				
							var sumcount = "Default"; 
							//alert("cnt = " + json.count); 
							if (json.success) {
								if(listdefinition != '<Filter CriteriaJoinOperator=""></Filter>'){								 
									 sumcount = json.count + " People";			
								}
							}
							$scope.auCount = sumcount; 
							$("#auCount").val(sumcount) ; 
						}
			});		

	}//CheckSumAudience

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
			$scope.CheckSumAudience(); 
        }, function(errResponse) {
            if (errResponse.status == 404) {
                alert("ERROR 404 [audienceLists]");
            }
        });
    }; // LoadAudience

	

    $scope.LoadDefaultPromoteBlog = function(){
			$http.get(dbEndPoint + "/master/Default_PromoteBlog" + "?" + new Date().toString()).then(function(response) {
					$scope.masterDefault  = response.data; 
					if (typeof $scope.masterDefault == 'undefined') {
					   $scope.masterDefault = "";
					   $scope.masterDefEmailFilter = '<Filter CriteriaJoinOperator="&"><Criteria Row="1" Field="isseed" Operator="Equal" Value="True" /></Filter>'; 
					} 
					$scope.masterDefEmailFilter = $scope.masterDefault['EMAIL1-FILTER']; 
			}, function(errResponse) {        
					if (errResponse.status == 404 || errResponse.status == 504) {
						$scope.masterDefault = "";
					}
					$scope.masterDefEmailFilter = '<Filter CriteriaJoinOperator="&"><Criteria Row="1" Field="isseed" Operator="Equal" Value="True" /></Filter>'; 
			});
    };//LoadDefaultPromoteBlog

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
                $scope.PublishProgram(accountID,response.data.newProgID);
            }else{
                swal({
                    type: 'error',
                    html: "Campaign [" + response.data.newCampaignName + "] copy fail<br>" + response.data.addRet.message,
                });
            }
        });                
    }
	$scope.startEditable = function(objID) {
		$('#subjectEmail' + objID).editable();
		//$('#template').trigger('change');
		$('#subjectEmail' + objID).on('save', function(e, params) {
			//alert('Saved value: ' + params.newValue);
			$scope.campaign['EMAIL'+objID+'-SUBJECT'] = params.newValue;
			$scope.$apply();
		});
	}
	$scope.openEmail = {
		"1":true,
		"2":false,
		"3":false,
	};
		
    $scope.Load();
});

function convertTime(timeString) {
    var hourEnd = timeString.indexOf(":");
    var H = +timeString.substr(0, hourEnd);
    var h = H % 12 || 12;
    var ampm = H < 12 ? ":00 AM" : ":00 PM";
    timeString = h + timeString.substr(hourEnd, 3) + ampm;


    return timeString; // return adjusted time or original string
}

function convertTimeFormat(timeString) {
	if (hasValue(timeString)) {
		timeString = timeString.replace("PM", ":00 PM");
		timeString = timeString.replace("AM", ":00 AM");
	} else {
		timeString = "";
	}
    return timeString;
}

function hasValue(obj, defaultValue) {
    if (obj === undefined || obj == '' || obj == 'null') {
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

function comparedate(datetime1, timezone1, datetime2, timezone2){
    timezone1 = convertTimezone(timezone1);				
    timezone2 = convertTimezone(timezone2);

    //alert(datetime1+','+timezone1+','+datetime2+','+timezone2);

    //time1 = convert_to_24h(convertTimeFormat(time1));
    
    // Create date from input value
    var d1 = new Date(datetime1+' '+timezone1);
    //var Date1= dateFormat(d1, "yyyy-mm-dd HH:MM:ss",true);
    var Date1= dateFormat(d1, "isoDateTime", true);
    //alert(Date1);

    // Get today's date
    var d2 = new Date(datetime2+' '+timezone2);
    //var Date2= dateFormat(d2, "yyyy-mm-dd HH:MM:ss",true);
    var Date2= dateFormat(d2, "isoDateTime", true);
    //alert(Date2);

    if (Date1 < Date2) {
        //alert('ok');
        return true;
    } else {
        //alert('past date');
        return false;					
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

