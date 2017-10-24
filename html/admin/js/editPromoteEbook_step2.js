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
    
	$scope.FormChanged = function(srcField,tarField) {
		$scope.campaign[tarField] = $scope.campaign[srcField];
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

}]);
function setLeftBar() {
	if ($( "body" ).hasClass( "mini-navbar" )) {
		$("body").removeClass("mini-navbar");
	} else {
		$("body").addClass("mini-navbar");
	}
}
