    myApp.controller('myCtrl',function($scope,$http) {
		$scope.Reset = function() {				 
                  $scope.userinfo  = angular.copy($scope.master);
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
                /*
				$http.get("/couchdb/" + dbname + "/UserInfo").then(function(response) {
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
				$http.put("/couchdb/" + dbname + "/UserInfo", $scope.userinfo).then(function(response){
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
		
		$scope.Load();

    });// end myApp.controller(myCtrl)