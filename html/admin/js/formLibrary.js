var myApp = angular.module('myApp', ['angularMoment', 'davinci', 'localytics.directives']);
myApp.controller('myCtrl',function($scope,$http) {
			
			$scope.Reset = function() {
				 
			};
			$scope.Load = function() {                
				$http.get(dbEndPoint + "/" + dbName + '/formLibrary'+"?"+new Date().toString()).then(function(response) {
					 $scope.master  = response.data; 
					 if (typeof $scope.master.items == 'undefined') {
					   $scope.master.items = [];
					 } 
					  $scope.formLib  = angular.copy($scope.master);

				},function(errResponse){
						if (errResponse.status == 404) {
							$scope.formLib = {items:[]};
						}
				});
			};

			$scope.DuplicateFormClick = function(frmID,frmName){
				    $scope.copyID = frmID;
                    swal({
                      title: 'What is your new form name?',
                      input: 'text',
                      inputValue: frmName + " (COPY)",
                      showCancelButton: true,
                    }).then($scope.DuplicateFormOK);
			};

			$scope.DuplicateFormOK = function(newFormName){
				newFormName = newFormName.trim();							
				var indx = $scope.formLib.items.getIndexByValue('formID',$scope.copyID);		
				$scope.selectFrm = $scope.formLib.items[indx];						

				var submission = "";
				var modDate = getCurrentDateTime();
				if(newFormName != ''){
					var keyword = newFormName+getCurrentDateTime();
					var resID = $.md5(keyword);      

					$scope.formLib.items.push({
							"formID":resID,
							"formName":newFormName,
							"formType_DefID":$scope.selectFrm.formType_DefID,
							"submission":submission,
							"modifiedDate":modDate,
							"allFieldName":$scope.selectFrm.allFieldName,
							"formHTML":$scope.selectFrm.formHTML,
							"fieldLists":$scope.selectFrm.fieldLists
					});
					$scope.SaveCopy(resID,newFormName); 
				}else{
					swal({
						type: 'error',
						html: "Form [" + newFormName + "] copy fail!!",
					});
				}
			};

			$scope.SaveCopy = function(resID,newFormName) {								
					$http.put(dbEndPoint + "/" + dbName + '/formLibrary',  $scope.formLib).then(function(response){
							swal({
								type: 'success',
								html: "Form [" + newFormName + "] created",
							}).then($scope.Load);
							
					},function(errsaveResponse){
							swal({
								type: 'error',
								html: "Form [" + response.data.newFormName + "] copy fail!!",
							});
	                });		
            };
			
			$scope.DuplicateFormOK2 = function(newFormName){
                    newFormName = newFormName.trim();
                    $http.get("formEditorCopy.php"+"?" + new Date().toString(),
							{
							  method: "POST",
							  params: {
								fID: $scope.copyID,
								LName: newFormName,
							  }  
							}
                    ).then(function(response) {
							console.log(response.data);
							if(response.data.success == true){
								swal({
									type: 'success',
									html: "Form [" + response.data.newFormName + "] created",
								}).then(function() {
									window.location.href = "formLibrary.php";
								});
							}else{
								swal({
									type: 'error',
									html: "Form [" + response.data.newFormName + "] copy fail<br>" + response.data.addRet.message,
								});
							}
                    });                
            };

			$scope.Load();
});  
