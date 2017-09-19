var myApp = angular.module('myApp', ["ngFileUpload"]);
myApp.controller('myCtrl',function($scope,$http, Upload) {
	$scope.Reset = function() {				 
		$scope.userinfo  = angular.copy($scope.master);
		if (!hasValue($scope.userinfo.defCompanyLogo)) {
			$scope.userinfo.defCompanyLogo = "https://s3.amazonaws.com/mindfiredavinci/img/DV_image_placeholder_180x70.png";
		}
		$scope.myForm.$setPristine();
		//$scope.fuser = $scope.userinfo.username;
		//$scope.fadd = $scope.userinfo.defFromAdd;			
	};
	$scope.Load = function() {
		$scope.studioEmail = studioEmail;
		$scope.studioPassword = studioPassword;
		$scope.state = {
			"SaveAccountSetting":"Save",
		};
		
		/*$http.get("/couchdb/" + dbname + "/UserInfo").then(function(response) {
			 $scope.master  = response.data; 
			 if (typeof $scope.master.items == 'undefined') {
				$scope.master.items = [];
				// So this is new user
			 } 
			 $scope.Reset();
		});*/
		// Kwang user backend php instead to handle devault value
		$http.get("backend.php"+"?" + new Date().toString(),
		{
		  method: "POST",
		  params: {
			cmd: "userinfo",
			acctID: accountID,     
			progID: "yyyy",     // anything that not empty
		  }  
		}
		).then(function(response) {
			console.log(response.data);    
			$scope.master = response.data.doc;
			$scope.Reset();
			//$scope.backend.data = response.data;
		});
			
	};		

	$scope.Save = function() {
		//$http.put('/couchdb/' + data.username +'/userinfo', $scope.userinfo).then(function(response){
		$scope.state['SaveAccountSetting'] = "Saving";
		$http.put(dbEndPoint + "/" + dbname + "/UserInfo", $scope.userinfo).then(function(response){
			  $scope.data = response.data;          
			  //$scope.Load();
			  $scope.saveSuccess = true;
			  $scope.state['SaveAccountSetting'] = "Save";
			  $scope.userinfo._rev = response.data.rev;                      
			  $scope.master = angular.copy($scope.userinfo);                      
		 },function(response){
			  console.log(response.data);    
			  alert("ERROR: can not save!!!");	
			  $scope.state['SaveAccountSetting'] = "Save";                      
		});   
	};		
	
	$scope.Cancel = function(){
		//$scope.Load();
		$scope.Reset();
		$scope.saveSuccess = false;
	};

	$scope.upload = function (file,fieldName) {
		$scope.state['Upload-'+fieldName] = 'Uploading';
		var uploadFileName = "IMG-COMPANY-LOGO-" + accountID;
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
			$scope.userinfo[fieldName] = resp.data.imgSrc;
			$scope.state['Upload-'+fieldName] = 'Finish';
		}, function(resp) {
			console.log('Error status: ' + resp.status);
			$scope.state['Upload-'+fieldName] = 'Error';
		}, function(evt) {
			var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
			console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
		});
	};
	
	$scope.Load();

});// end myApp.controller(myCtrl)

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
function uuidv4() {
	return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
		var r = Math.random() * 16 | 0,
			v = c == 'x' ? r : (r & 0x3 | 0x8);
		return v.toString(16);
	});
}