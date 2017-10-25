var myApp = angular.module('myApp', ['localytics.directives']);
myApp.controller('myCtrl', function($scope, $http) {
    $scope.selectAccount = "";
	/*
    $scope.login = {
        userName: "tt994613@gmail.com",
        passWord: "Tu4&Mi2$",
    }
	*/
    $scope.login = {
        userName: "",
        passWord: "",
	}
    $scope.myAlert = function(mesg) {
        $scope.alert = {
            normal: mesg,
        };
    };

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
                $scope.login.mps = [];
                var mps = $scope.login.response.mps;
                for (var i = 0; i < mps.length; i++) {
                    $scope.login.mps.push({
                        "id": mps[i][0],
                        "name": mps[i][1]
                    });
                }
                $scope.state = "checked";
                //$('#accountDiv').show();
                //$('#continueDiv').show();
                //$('#loginDiv').hide();		
            } else {
                //alert($scope.login.response.message); 
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
}); //END myApp

function ForgotPassword() {

    var form_data = $("#loginForm").serialize();
    $.ajax({
        url: 'ForgotPassword.php', // point to server-side PHP script 
        dataType: 'json', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'get',
        success: function(json) {
            if (json.success) {
                swal("Please check email for the instructions to reset your password.");
            }
        }
    });
}