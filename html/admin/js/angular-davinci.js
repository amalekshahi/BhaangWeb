angular.module('davinci', [])

.directive('accountSwitch', function() {
    var directive = {};
    directive.restrict = 'E'; /* restrict this directive to elements */
    directive.templateUrl = "accountSwitch.html";
    directive.scope = {
    };
    directive.controller = ['$scope','$http','$window', function($scope, $http, $window){
        
        $scope.selectAccount = "";
        $scope.login = {
            userName: $window.userName,
            passWord: $window.passWord,
        }

        $scope.Login = function() {
            $scope.alert = false;
            if (typeof $scope.state == 'undefined') {
                $scope.CheckLogin();
            } else {
                //if($scope.state == "checked"){
                //}
                $scope.RealLogin();
            }
        };
      
        $scope.CheckLogin = function() {
         
            $http.get("/admin/login.php", {
                method: "GET",
                params: {
                    email: $scope.login.userName,
                    pwd: $scope.login.passWord,
                }
            }).then(function(response) {
             
                $scope.login.response = JSON.parse(clearCallBack(response.data));
                //alert("success: " +  $scope.login.response.success + "\n errMsg: " +  $scope.login.response.message);
                if ($scope.login.response.success) {
                  //alert("success");
                    $scope.login.mps = [];
                    var mps = $scope.login.response.mps;
                    for (var i = 0; i < mps.length; i++) {
                        $scope.login.mps.push({
                            "id": mps[i][0],
                            "name": mps[i][1]
                        });
                    }
                  $scope.state = "checked";
                } else {
                  alert($scope.login.response.message); 
                    $scope.myAlert($scope.login.response.message);
                }

            }, function(response) {
                $scope.myAlert("A connection error occured. Please try again.");
                //alert("ERROR: " + response.statusText);
            });

        }; //end scope.Login

        $scope.RealLogin = function() {
            if (typeof $scope.mpsSelect == 'undefined') {
                $scope.myAlert("Please select an account");
                return;
            }
            var acct = $scope.mpsSelect.split("|");
            
          //alert(acct[0]);
            //alert(acct[1]);
            //return;
            $http.get("/admin/login.php", {
                method: "GET",
                params: {
                    mode: "login",
                    email: $scope.login.userName,
                    pwd: $scope.login.passWord,
                    //accountID: $scope.mpsSelect,
                    //accountName: $('#mpsSelect option:selected').text() ,
                    accountID: acct[0],
                    accountName: acct[1],
                }
            }).then(function(response) {
                $scope.login.response = JSON.parse(clearCallBack(response.data));
                //alert("mpsSelect text =  " + $('#mpsSelect option:selected').text() );
                //alert("mpsSelect val =  " + $('#mpsSelect option:selected').val() );
                if ($scope.login.response.success) {
                    //createCookie("canLogin","Yes");
                    //alert('44')
                    window.location = "welcome.php";
                    //$("#loginForm").attr("action", "welcome.html");
                    //$("#loginForm").submit();		
                } else {
                    $scope.myAlert($scope.login.response.message);
                }
            }, function(response) {
                $scope.myAlert("Can not login!");
            });
        };
        
        $scope.myAlert = function(x){
            alert(x);
        }
        
        $scope.CheckLogin();

    }];
    return directive;
})

// Dave created this to show # of logged in Users
.directive('usersActive', function () {
  
    var directive = {};
    directive.restrict = 'E'; 
    directive.template = '<img src="https://cdn1.iconfinder.com/data/icons/unique-round-blue/93/group-128.png" width="20"> {{message}}'
    directive.scope = {
    };
  
    directive.controller = ['$scope', '$http', '$timeout', function($scope, $http, $timeout){
      $http({
        method: 'GET',
        url: 'https://api.chartbeat.com/live/toppages/v3/?apikey=377d6d7bd5f197ac3eab56c632fc1ab2&host=mindfireinc.com'
      }).then(function successCallback(response) {
        //console.log(response.data);
        var length = Object.keys(response.data.pages).length;
        var people = 0; // Hey, no cheating! :)
        for (var i=0; i < length; ++i) {
          if (response.data.pages[i].path.includes("vinci") || response.data.pages[i].path.includes("GetReport")) {
           people += response.data.pages[i].stats.people;
          }
        }
        $scope.people = parseInt(people);
        if (people ===0) {
          $scope.message = "Da Vinci is all alone."
        }
        
        if (people ===1) {
          $scope.message = "Are you lonely?  You're the only User logged in right now."
        }
        
        if (people > 1) {
          $scope.message = people.toLocaleString() + " other Users are also logged in right now";
        }

      }, function errorCallback(response) {
        console.log("We got an error.");
      });
    }];
    return directive;
});