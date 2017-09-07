<!DOCTYPE html>
<html ng-app="myApp">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Someone to Your Seeed List</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<!-- Angular -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	<!-- Sweet alert -->
	<script src="css/sweet/sweetalert-dev.js"></script>
	<link rel="stylesheet" href="css/sweet/sweetalert.css">
</head>

<body class="gray-bg">
	<div class="passwordBox animated fadeInDown" ng-controller="myCtrl" style="padding-top:10px;">
		<div class="row">
			<div class="col-md-12">
				<div class="ibox-content">
					<div class="row">
						<div class="col-lg-12">
							<form name="registerForm" id="registerForm" class="m-t" role="form" method="post">
								<div class="form-group">
									<input type="text" class="form-control" name="firstname" id="firstname" autofocus placeholder="First Name" required="" ng-model="register.firstname">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" required="" ng-model="register.lastname">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="email" id="email" placeholder="Email" required="" ng-model="register.email">
								</div>
								<div id="continueDiv">
									<button class="btn btn-primary block full-width m-b" ng-click="Register()"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add This Person to My Seed List</button>
								</div>
								<div class="alert alert-success" role="alert">People you add show up in your "Send a Test Message" dropdown.  Close this window when you're done.</div>
								<div ng-show="alert" ng-cloak>
									<div class="alert alert-danger">
										<!--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
										<strong> Error! </strong> {{alert.normal}}
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr/>
		
	</div>
	<!-- Mainly scripts -->

	<script src="js/w3data.js"></script>
	<script>
		w3IncludeHTML();
	</script>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<!--<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>-->
	<script type="text/JavaScript" src="global.js?n=1"></script>
	<!-- Custom and plugin javascript -->
	<!--<script src="js/inspinia.js"></script>-->
	<script src="js/plugins/pace/pace.min.js"></script>
	<script src="js/davinci.js"></script>
	<script>
		var myApp = angular.module('myApp', []);
		myApp.controller('myCtrl', function($scope, $http) {
			$scope.selectAccount = "";
			$scope.register = {
				firstname: "",
				lastname: "",
				email: "",
			}
			$scope.myAlert = function(mesg) {
				$scope.alert = {
					normal: mesg,
				};
			};

			$scope.state = "checked";

			$scope.Register = function() {
				var firstname = $('#firstname').val();
				var lastname = $('#lastname').val();
				var email = $('#email').val();
				if ((firstname == '') || (lastname == '') || (email == '')) {

				} else {

					var form_data = $("#registerForm").serialize();


					$.ajax({
						url: 'registerContact.php', // point to server-side PHP script 
						dataType: 'json', // what to expect back from the PHP script, if anything
						cache: false,
						contentType: false,
						processData: false,
						data: form_data,
						type: 'get',
						success: function(json) {
							if (json.success) {
								swal(json.message);
								window.location = "register.php";
							} else {
								//$scope.myAlert(json.message); 
								swal(json.message);
							}
						}
					});
				}

			}; //end scope.Login


		}); //END myApp

		window.onunload = function(e) {
			opener.CloseRegister();
			//opener.document.getElementById('someid').innerHTML = 'update content of parent window';
		};
	</script>

</body>

</html>