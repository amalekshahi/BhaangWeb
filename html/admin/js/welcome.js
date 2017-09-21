var myApp = angular.module('myApp', ['angularMoment']);

myApp.controller('myCtrl', function($scope, $http) {
    $scope.Reset = function() {
        $scope.campaignlist = angular.copy($scope.master);
        // Added by Dave on 9/20/17 so that UI can know whether or not to display table of campaigns.
        if ($scope.campaignlist.campaigns.length > 0) {
        $scope.numberOfCampaigns = 1;
        } else {
        $scope.numberOfCampaigns = 0;
        }
    };
    $scope.Load = function() {
        //$http.get("/couchdb/" + dbName + '/campaignlist?' + new Date().toString()).then(function(response) {
        $http.get(dbEndPoint + "/" + dbName + '/campaignlist?' + new Date().toString()).then(function(response) {
            //$http.get("/couchdb/" + dbName +'/campaignlist?'+new Date().toString()).then(function(response) {
            $scope.master = response.data;
            if (typeof $scope.master.campaigns == 'undefined') {
                $scope.master.campaigns = [];
            }
            $scope.Reset();
        });
    };
    $scope.Random = function(range) {
        //return Math.floor((Math.random() * range) + 1);
      return 1;
    };
    $scope.Load();

    $scope.goToLink = function(item) {
    window.location = 'edit' + item.campaignType + '.php?campaign_id=' + item.campaignID;
    };
    
});

myApp.controller('seamlessLoginCtrl', function($scope, $http, $window) {
  //$scope.loginuserName = $window.userName;
  //$scope.passWord = $window.passWord;

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
    
    $scope.CheckLogin();
  
});     



$(document).ready(function() {
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
});	


