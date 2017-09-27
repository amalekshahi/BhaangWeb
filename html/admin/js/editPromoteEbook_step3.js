$(document).ready(function() {
	$("body").tooltip({ selector: '[data-toggle=tooltip]' });
});	

myApp.controller('step3', ['$scope', '$http', 'Upload', function($scope, $http, Upload) {
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
		}, function() {
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
		$scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL' + index + 'CONTENT'] = $scope['templatesAs' + index][$scope.tpsIndex(index)].contentRaw;
		$scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-EMAIL' + index + 'SUBJECT'] = $("#subjectEmail" + index).text();
		$scope.campaign['EMAIL' + index + '-SUBJECT'] = $("#subjectEmail" + index).text();

		$scope.state['SendTest' + index] = "Sending";
		var html = $scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL' + index + 'CONTENT'];
		var fromAddress = $scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMEMAIL'];
		var fromName = $scope.campaign['TEXT-LINE-ACCTID-PROGRAMID-FROMNAME'];
		var renderedHtml = Render(html, $scope.campaign);
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
			//console.log(str); // Logs output to dev tools console.
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

	$scope.OpenRegister = function() {
		var w = 500;
		var h = 325;
		var x = screen.width / 2 - w / 2;
		var y = screen.height / 2 - h / 2;

		$scope.popup = window.open("register.php", '_blank', 'toolbar=no, menubar=no, location=no, scrollbars=no,resizable=no,width=' + w + ',height=' + h + ',left=' + x + ',top=' + y);
	};
	$scope.LoadSendTestContact();
}]);

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