var editEmail = true;

$(document).ready(function() {
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
});	

$(document).ready(function() {

  $('.footable').footable();

 });

myApp.controller('step2', ['$scope', '$http', 'Upload', function($scope, $http, Upload) {
    //var email4 = {emlID : '4',tabLabel : 'Email #4: Sent to Non-Order',emlHead : 'Thsi is Email #4 Content.'};
    //var email4 = {emlID : '4',tabLabel : 'Email #4: Sent to Non-Order',emlHead : 'Thsi is Email #4 Content.'};
    //var email4 = {emlID : '4',tabLabel : 'Email #4: Sent to Non-Order',emlHead : 'Thsi is Email #4 Content.'};
    var emails = [{
            emlID: '4',
            tabLabel: 'Email #4: Sent to Non-Order',
            emlHead: 'Thsi is Email #4 Content.'
        },
        {
            emlID: '5',
            tabLabel: 'Email #5: Sent to Non-Order',
            emlHead: 'Thsi is Email #5 Content.'
        },
        {
            emlID: '6',
            tabLabel: 'Email #6: Sent to Non-Order',
            emlHead: 'Thsi is Email #6 Content.'
        }
    ];
    //emails.push(email4);
    $scope.emlIndex = 0;
    $scope.maxEmail = 0;
    $scope.emailList = [];
    $scope.sendTestContactSelected = "";	
    $scope.newTab = function(tab) {
        //emlIndex = parseInt($scope.campaign.totalEmail)+1;
        $scope.emailList.push(emails[$scope.emlIndex]);
        $scope.emlIndex++;
        $('.nav-tabs a[href="#tab-4"]').tab('show');
    }

    $scope.removeTab = function(tab) {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this Email!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }).then(function () {
            $scope.emailList.splice($scope.emailList.indexOf(tab), 1);
            $scope.emlIndex--;
            $scope.$apply();
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });
    }
    $scope.SendTest = function(index) {
        var id = $scope.sendTestContactSelected;
        if (id == "") {
            swal("Please select address to send to");
            return;
        }
        $scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL' + index + 'CONTENT'] = $scope.getContentRaw($scope['templatesAs'+index], $scope.campaign['templateEmail'+index], 'TEXT-AREA-ACCTID-PROGRAMID-EMAIL'+index+'CONTENT');
        $scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-EMAIL' + index + 'SUBJECT'] = $("#subjectEmail" + index).text();
        $scope.campaign['EMAIL' + index + '-SUBJECT'] = $("#subjectEmail" + index).text();

        $scope.state['SendTest' + index] = "Sending";
        var html = $scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL' + index + 'CONTENT'];
        var fromAddress = $scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMEMAIL'];
        var fromName = $scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMNAME'];
        var renderedHtml = Render(html, $scope.campaign);
        //renderedHtml = RenderSharpSharp(renderedHtml,accountID);
        //alert(renderedHtml);
        var subject = $("#subjectEmail" + index).text();
        //alert($scope.campaign['EMAIL1-HERO-IMAGE']);
        $http({
            method: 'POST',
            url: 'sendTestStudio.php' + "?" + new Date().toString(),
            data: ObjecttoParams({
                "ContactID": id,
                "HtmlContent": renderedHtml,
                "subject": subject,
                "FromName": fromName,
                "FromAddress": fromAddress,
            }),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function(response) {
            var ret = response.data;
            var str = JSON.stringify(response.data, null, 4); // (Optional) beautiful indented output.
            console.log(str); // Logs output to dev tools console.
            if (response.data.success == false) {
                swal("Fail");
            } else {
                swal("Success");
            }
            //$scope.state['Publish'] = "Launch Program";
            $scope.state['SendTest' + index] = "Send Test";
            //alert(response);
        }, function(errResponse) {
            var str = JSON.stringify(errResponse.data, null, 4); // (Optional) beautiful indented output.
            console.log(str); // Logs output to dev tools console.
            /*
            $scope.state['Publish'] = "Launch Program";*/
            swal("Server Error");
            $scope.state['SendTest' + index] = "Send Test";
            //alert(errResponse);
        });
    }

    $scope.LoadSendTestContact = function() {
        $http.get('getSeedContact.php' + "?" + new Date().toString()).then(function(response) {
            var ret = response.data;
            $scope.sendTestContacts = ret.Contact;
            var str = JSON.stringify(response.data, null, 4); // (Optional) beautiful indented output.
            console.log(str); // Logs output to dev tools console.
        }, function(errResponse) {
            var str = JSON.stringify(errResponse.data, null, 4);
            console.log(str);
            swal("Server Error");
        });
    }

    $scope.imageUpload = function(files, editor) {
        var uploadFileName = "IMG-" + uuidv4();
        //$scope.editor.summernote('insertNode', imgNode);
        Upload.upload({
            url: 'upload.php',
            method: 'POST',
            file: files[0],
            data: {
                file: files[0],
                's3': 'true',
                'fileName': uploadFileName,
                'acctID': 'accountID',
                'progID': 'programID',
            }
        }).then(function(resp) {
            console.log('Success ' + resp.config.data.file.name + 'uploaded');
            console.log(resp.data);
            var imgNode = $('<img>').attr('src', resp.data.imgSrc)[0];
            $scope[editor].summernote('code','');
            $scope[editor].summernote('insertNode', imgNode);
        }, function(resp) {
            console.log('Error status: ' + resp.status);
        }, function(evt) {
            var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
            console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
        });
    };

    $scope.upload = function (file,emlID) {
        $scope.state['Upload'+emlID] = 'Uploading';
        var uploadFileName = "IMG-" + uuidv4();
        //$scope.editor.summernote('insertNode', imgNode);
        Upload.upload({
            url: 'upload.php',
            method: 'POST',
            file: file,
            data: {
                file: file,
                's3': 'true',
                'fileName': uploadFileName,
                'acctID': 'accountID',
                'progID': 'programID',
            }
        }).then(function(resp) {
            console.log('Success ' + resp.config.data.file.name + 'uploaded');
            console.log(resp.data);
            var imgHTML = '<img src="'+resp.data.imgSrc+'">';
            //$scope['editor1'].summernote('code',imgHTML);
            $scope.campaign['EMAIL'+emlID+'-HERO-IMAGE'] = imgHTML;
            $scope.state['Upload'+emlID] = 'Finish';
        }, function(resp) {
            console.log('Error status: ' + resp.status);
            $scope.state['Upload'+emlID] = 'Error';
        }, function(evt) {
            var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
            console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
        });
    };
    
    $scope.smnOptions = {
        dialogsInBody: true,
        //airMode: true,
        popover: {
            air: [
                ['color', ['color']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']]
            ],
            image: [
                ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']],
                ['image',['url']],
                ['change', ['changeImage']]
            ]
        },
        buttons: {
          changeImage: changeImageButton
        }
        
    };

    $scope.OpenRegister = function() {
        var w = 500;
        var h = 325;
        var x = screen.width / 2 - w / 2;
        var y = screen.height / 2 - h / 2;

        $scope.popup = window.open("register.php", '_blank', 'toolbar=no, menubar=no, location=no, scrollbars=no,resizable=no,width=' + w + ',height=' + h + ',left=' + x + ',top=' + y);
    };

	$scope.setFilterSchedule = function() {
		if (hasValue($scope.campaign['EMAIL1-SCHEDULE1-DATETIME'],'01/01/2050 08:00:00 AM')) {
			$scope.dateChange('1');
		}
		if ($scope.openFilter['2']) {
			$scope.dateChange('2');
		}
        if ($scope.openFilter['3']) {
			$scope.dateChange('3');
		}
    };

	$scope.lessThan = function(prop, val){
		return function(item){
		  return item[prop] <= val;
		}
	}

	$scope.sendTestTimeChange = function(){
		if (hasValue($scope.campaign.sendTestStart) && $scope.campaign.sendTestStart == 'specific') {
			/*swal({
				title: 'What is your send test time?',
				html: '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/jquery-clockpicker.min.css" />'
						+'<script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/jquery-clockpicker.min.js"></script>' 
						+'<div class="input-group clockpicker" clock-picker data-autoclose="true" data-placement="left" data-align="top">'
							+'<input type="text" class="form-control" id="specificTime" name="specificTime" placeholder="" type="text">'
							+'<span id="specificClock" class="input-group-addon">'
								+'<span class="fa fa-clock-o"></span>'
							+'</span>'
						+'</div>',
				showCancelButton: true,
			}).then($scope.specificSendTestTime);*/
			$('#modal-form').modal();
		}
    };

	$scope.specificSendTestTime = function(){
        swal('OK');
    };

    $scope.LoadSendTestContact();
}]);



function setLeftBar() {
	if (editEmail) {
		$("body").addClass("mini-navbar");
		editEmail = false;
	} else {
		$("body").removeClass("mini-navbar");
		editEmail = true;
	}
}

function uuidv4() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = Math.random() * 16 | 0,
            v = c == 'x' ? r : (r & 0x3 | 0x8);
        return v.toString(16);
    });
}

function CloseRegister() {
    var scope = angular.element(document.getElementById('step2ID')).scope();
    scope.LoadSendTestContact();
    //alert('LoadSendTestContact done');        
}