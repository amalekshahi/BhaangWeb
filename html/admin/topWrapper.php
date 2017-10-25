<?php
date_default_timezone_set('UTC');
include 'commonUtil.php';
session_start();
$dbName = $_SESSION['DBNAME'];
$accountID = $_SESSION['ACCOUNTID'];
$accountName = $_SESSION['ACCOUNNAME'];
$email = $_SESSION['EMAIL'];
$pwd = $_SESSION['PWD'];
$USERNAME = $_SESSION['USERNAME'];


$showDB = '';
$showGH = '';
davinciSetConfig();
if ($serverMode == 'production') {
	$showDB = 'style="display: none"';
	$showGH = 'style="display: none"';	
} else {
	
}


?>
	<script type="text/javascript">
		var userName = "<?php echo $email; ?>";
		var passWord = "<?php echo $pwd; ?>";
	</script>

	<div class="navbar-header">
		<!-- Commented out for now, until we have Da Vinci wide search
		<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>		
  <form role="search" class="navbar-form-custom" action="#">
        <div class="form-group">
            <input type="text" placeholder="Search...." class="form-control" name="top-search" id="top-search">
        </div>
    </form>
  -->
	</div>
	<ul class="nav navbar-top-links navbar-right">
		<li><span class="m-r-sm text-muted welcome-message"><?php echo $USERNAME;?>, you're logged in to <?php echo $accountName;?>.</span></li>
		<li>
    <account-switch/>
		</li>
		<li <?php echo $showDB;?> ><a onClick="dbgClick('DBView')"><i class="fa fa-cog" ></i><small>Database</small></a></li>
		<li <?php echo $showGH;?> ><a onClick="dbgClick('Issue')"><i class="fa fa-bug" ></i><small>GitHub</small></a></li>
		<li><a href="logout.php"><i class="fa fa-power-off"></i> Log out </a>
		</li>
	</ul>
<script>
// default 
function dbgClick(from) {
    var dbEndpoint = "<?php echo $databaseEndpoint;?>";
    var dbName = "<?php echo $dbName;?>";
    var accountID = "<?php echo $accountID; ?>";

    //alert(dbEndpoint);
    if (from == 'DBView') {
        if (typeof campaignID == 'undefined') {
            window.open(dbEndpoint + "/_utils/document.html?" + dbName + "/campaignlist", '_blank');
        } else {
            window.open(dbEndpoint + "/_utils/document.html?" + dbName + "/" + campaignID, '_blank');
        }
    }
    if (from == 'Issue') {
        window.open("https://github.com/coa0329/BhaangWeb/issues", '_blank');
    }
}
        
    //Check if myApp is define
if(typeof myApp != "undefined"){
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
}
</script>
    