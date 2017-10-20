

myApp.controller('myCtrl',function($scope,$http, Upload) {
	$scope.Reset = function() {				 
		$scope.userinfo  = angular.copy($scope.master);
		if (!hasValue($scope.userinfo.defCompanyLogo)) {
			$scope.userinfo.defCompanyLogo = "https://s3.amazonaws.com/mindfiredavinci/img/DV_image_placeholder_180x70.png";
		}
		$scope.srcCompanyLogo = $scope.userinfo.defCompanyLogo;
		$scope.myForm.setPristine();
		//$scope.fuser = $scope.userinfo.username;
		//$scope.fadd = $scope.userinfo.defFromAdd;			
	};
	$scope.Load = function() {
		$scope.studioEmail = studioEmail;
		$scope.studioPassword = studioPassword;
		$scope.initSender();
		$scope.state = {
			"SaveAccountSetting":"Save",
			"SaveUser":"Save",
			"senderData":"false"
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
              //save content to s3
              $http.get("backend.php"+"?" + new Date().toString(),
                {
                  method: "POST",
                  params: {
                    cmd: "userinfo2s3",
                    acctID: accountID,     
                    progID: "yyyy",     // anything that not empty
                  }  
                }
                ).then(function(response) {
                    console.log(response.data);    
                });
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

	$scope.SaveUser = function() {
		$scope.state['SaveUser'] = "Saving";
		$scope.userinfo.users = $scope.senders;
		$http.put(dbEndPoint + "/" + dbname + "/UserInfo", $scope.userinfo).then(function(response){
			  $scope.data = response.data;          
			  //$scope.Load();
			  $scope.saveSuccess = true;
			  $scope.state['SaveUser'] = "Save";
			  $scope.userinfo._rev = response.data.rev;                      
			  $scope.master = angular.copy($scope.userinfo);         
		 },function(response){
			  console.log(response.data);    
			  alert("ERROR: can not save!!!");	
			  $scope.state['SaveUser'] = "Save";                      
		}); 		
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
			$scope.srcCompanyLogo = resp.data.imgSrc+ "?" + new Date().toString();
			$scope.state['Upload-'+fieldName] = 'Finish';
		}, function(resp) {
			console.log('Error status: ' + resp.status);
			$scope.state['Upload-'+fieldName] = 'Error';
		}, function(evt) {
			var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
			console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
		});
	};
    
    $scope.colorPickerOptions = {
        format: "hex",
    };

	$scope.AddUser = function() {
        $scope.state['senderData'] = "true";  
		$scope.state['UserMode'] = "Add";  
		$('#senderName').val('');
		$('#senderEmail').val('');
		$('#senderOfficialName').val('');
		$('#senderCell').val('');
		$('#senderPermissions').val('');
    };

	$scope.EditUser = function(person) {
        $scope.state['senderData'] = "true";  
		$scope.state['UserMode'] = "Edit";  
		var id = $scope.senders.indexOf(person);
		$('#senderID').val(id);
		$('#senderName').val(person.name);
		$('#senderEmail').val(person.email);
		$('#senderOfficialName').val(person.OfficialName);
		$('#senderCell').val(person.Cell);
		$('#senderPermissions').val(person.Permissions);
    };

	$scope.DeleteUser = function(person) {
		var r = confirm("Do you want to delete "+person.email+"?");
		if (r == true) {
			var senderID = $scope.senders.indexOf(person);
			$scope.senders.splice(senderID, 1);
			$scope.SaveUser();
		    $scope.state['senderData'] = "false";  
			$scope.state['UserMode'] = "";
		} 		 
    };

	$scope.SetSender = function() {
		var mode = $scope.state['UserMode'];
		var senderID = $('#senderID').val();
		var senderName = $('#senderName').val();
		var senderEmail = $('#senderEmail').val();
		var senderOfficialName = $('#senderOfficialName').val();
		var senderCell = $('#senderCell').val();
		var senderPermissions = $('#senderPermissions').val();
		var newArray = {
			"name": senderName,
			"email": senderEmail,
			"OfficialName": senderOfficialName,
			"Cell": senderCell,
			"Permissions": senderPermissions
		}
		if (mode == 'Edit') {
			$scope.senders[senderID] = newArray;
		} else if (mode == 'Add') {
			$scope.senders.push(newArray);
		}
		$scope.SaveUser();
        $scope.state['senderData'] = "false";  
		$scope.state['UserMode'] = "";  
    };

	$scope.HideSender = function() {
        $scope.state['senderData'] = "false";  
		$scope.state['UserMode'] = "";  
    };

	$scope.initSender = function() {		
		$scope.senders = [];
		$scope.senders.push({
			"email": "boonsom@mindfireinc.com",
			"name": "Boonsom Coa",
			"OfficialName": "Boonsom Coa",
			"Cell": "",
			"Permissions": ""
		});
		$scope.senders.push({
			"email": "kdutta@mindfireinc.com",
			"name": "Kushal Dutta",
			"OfficialName": "Kushal Dutta",
			"Cell": "",
			"Permissions": ""
		});
		$scope.senders.push({
			"email": "daver@mindfireinc.com",
			"name": "David Rosendahl",
			"OfficialName": "David Rosendahl",
			"Cell": "",
			"Permissions": ""
		});
		$scope.senders.push({
			"email": "mcfarsheed@mindfireinc.com",
			"name": "Mackenzi Farsheed",
			"OfficialName": "Mackenzi Farsheed",
			"Cell": "",
			"Permissions": ""
		});

		$http.get(dbEndPoint + "/" + dbName + '/UserInfo' + "?" + new Date().toString()).then(function(response) {
			$scope.masterAu = response.data;
			if (typeof $scope.masterAu.users == 'undefined') {				
				$http.get(dbEndPoint + "/master/Default_UserInfo?" + new Date().toString()).then(function(response) {
					$scope.masterAu = response.data;
					if (typeof $scope.masterAu.users == 'undefined') {
					} else {
						$scope.senders = angular.copy($scope.masterAu.users);
					}
				});			   
			} else {
				$scope.senders = angular.copy($scope.masterAu.users);
			}
        });		
    }; // initSender
	
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