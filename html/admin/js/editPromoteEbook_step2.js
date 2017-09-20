var editLandingPage = true;
myApp.controller('step2',['$scope','$http','Upload',function($scope,$http,Upload) {
	$scope.upload2Pages = function (file,field) {
		$scope.state[field] = 'Uploading';
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
			var imgHTML = "<img src='"+resp.data.imgSrc+"' border='0' style='display:block'>";
			//$scope['editor1'].summernote('code',imgHTML);
			$scope.campaign[field] = imgHTML;
			$scope.state[field] = 'Finish';
		}, function(resp) {
			console.log('Error status: ' + resp.status);
			$scope.state[field] = 'Error';
		}, function(evt) {
			var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
			console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
		});
	};
	$scope.FormChanged = function(srcField,tarField) {
		$scope.campaign[tarField] = $scope.campaign[srcField];
	};
}]);
function setLeftBar() {
	if (editLandingPage) {
		$("body").addClass("mini-navbar");
		editLandingPage = false;
	} else {
		$("body").removeClass("mini-navbar");
		editLandingPage = true;
	}
}
