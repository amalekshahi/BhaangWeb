<?php
    date_default_timezone_set('UTC');
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
    $dbName = $_SESSION['DBNAME'];
    $accountID = $_SESSION['ACCOUNTID'];
    $accountName = $_SESSION['ACCOUNNAME'];
?>

	<!doctype html>
	<html ng-app="myApp">

	<head>
		<?php include "header.php"; ?>
		<!-- Sweet alert -->
		<script src="css/sweet/sweetalert-dev.js"></script>
	</head>

	<body class="">
		<script>
			var dbName = "<?php echo $dbName; ?>";
			var accountID = "<?php echo $accountID; ?>";
			var myApp = angular.module('myApp', ["ngFileUpload"]);
		</script>
		<div id="wrapper">
			<?php include 'leftWrapper.php'; ?>




			<div id="page-wrapper" class="gray-bg" ng-controller="myCtrl">
				<div class="row border-bottom">
					<nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
						<?php include 'topWrapper.php'; ?>
					</nav>
				</div>

				<div ng-controller="myCtrl">
					<div class="row">
						<div class="col-lg-12">
							<div class="wrapper wrapper-content animated fadeInRight">
								<div class="ibox-content m-b-sm border-bottom">
									<div class="p-xs">
										<div class="pull-left m-r-md">
											<i class="fa fa-file-text-o text-navy mid-icon"></i>
										</div>
										<h2>Upload a CSV</h2><span>Add Contacts to your database</span>
									</div>
								</div>


								<div class="ibox-content forum-container">
									<form id="idForm">
									<div class="col-md-4">
										<input type="hidden" id="uploadFileName" name="uploadFileName" value="">
										<input type="hidden" id="itemCount" name="itemCount" value="">
										<input type="hidden" id="headerValue" name="headerValue" value="">
										<div class="tooltip-demo">
											<label class="control-label"></label>
											<a ng-model="file" ngf-select="upload($file,'1')" href="" class="btn btn-success btn-block btn-lg" data-toggle="tooltip" data-placement="top" title="I'll upload and import contacts of this file "><span ng-show="state['Upload'] == 'Uploading'"><i class="glyphicon glyphicon-refresh spinning"></i></span><i class="fa fa-cloud-upload" ng-show="state['Upload'] != 'Uploading'"></i> Upload CSV File</a>
										</div>
									</div>
									<div class="col-md-8 well" style="padding-top: 0px;padding-bottom: 0px;">
										<h2>Preparing your CSV for import</h2>Create a CSV containing at least 3 columns: first name, last name, and email. This is the minimum required to import Contacts, but you can also include these special column names: x, y, z.
										<p>
										</p>
										<p>To practice, download this ready-to-go sample file and upload it now. You can use it as a template for your own Contacts too: <a href="https://s3.amazonaws.com/mindfiredavinci/other_assets/DV-sample-upload-file.csv"><i class="fa fa-file-text-o" aria-hidden="true"></i> Sample File</a></p>
									</div>
									
									<div class="row">
										
										<div class="form-group" id="fieldDiv" style="display:none;">
											<label class="col-sm-12 control-label"><div class="hr-line-dashed"></div><h2>Let's Map Your <span id="rowsUploaded"></span> Rows ...</h2></label><br>
										</div>
									</div>
									<div class="row">
										<div id="headerdiv" class="table-responsive">
										</div>
									</div>
									<div class="row">
										<div class="form-group" id="importNameDiv" style="display:none;"><br>
											<label class="col-sm-2 control-label">What do you want to call this list?<br><small class="text-muted">Giving it a name helps you use it for your campaigns.</small></label>
											<div class="col-sm-4">
												<input type="text" class="form-control" name="importName" id="importName" placeholder="My customer list">
											</div>
											<button class="btn btn-primary" ng-click="ImportFile()"><i class="fa fa-floppy-o" ng-show="state['ImportFile'] == 'Import...'"></i><span ng-show="state['ImportFile'] != 'Import...'"><i class="glyphicon glyphicon-refresh spinning"></i></span> {{state['ImportFile']}}</button>
										</div>
									</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="footer">
				<?php include 'footer.php'; ?>
			</div>
		</div>
		<!--  end page-wrapper -->
		</div>

		<!-- Mainly scripts -->
		<!-- Mainly scripts -->
		<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
		<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

		<!-- Custom and plugin javascript -->
		<script src="js/inspinia.js"></script>
		<script src="js/plugins/pace/pace.min.js"></script>
		<script src="js/davinci.js"></script>
		<script type="text/JavaScript" src="global.js?n=1"></script>
		<script src="js/jquery.md5.js"></script>
		<!-- Page-Level Scripts -->

		<script>
			$(document).ready(function() {
				$("body").tooltip({
					selector: '[data-toggle=tooltip]'
				});
			});

			myApp.controller('myCtrl', ['$scope', '$http', 'Upload', function($scope, $http, Upload) {
				//$scope.campaignID = campaignID;
				$scope.state = {
					ImportFile: "Import...",
				};



				$scope.upload = function(file, emlID) {
					$scope.state['Upload'] = 'Uploading';
					var uploadFileName = "IMG-" + uuidv4();
					//$scope.editor.summernote('insertNode', imgNode);
					Upload.upload({
						url: 'doUploadFile.php',
						method: 'POST',
						file: file,
						data: {
							file: file,
							's3': 'false',
							'fileName': uploadFileName,
							'acctID': 'accountID',
							'progID': 'programID',
						}
					}).then(function(resp) {
						console.log('Success ' + resp.config.data.file.name + 'uploaded');
						console.log(resp.data);
						$scope.state['Upload'] = 'Finish';

						if (resp.data.success) {
							$('#headerdiv').html(resp.data.headerdiv);
							$('#uploadFileName').val(resp.data.tmpName);
							$('#itemCount').val(resp.data.itemCount);
							$('#headerValue').val(resp.data.headerValue);
							$('#fieldDiv').show();
							$('#importNameDiv').show();
							$("#rowsUploaded").html(resp.data.rowCount);
							
						} else {
							swal(resp.data.message);
						}
					}, function(resp) {
						console.log('Error status: ' + resp.status);
						$scope.state['Upload'] = 'Error';
					}, function(evt) {
						var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
						console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
					});
				};


				$scope.ImportFile = function() {

					var importName = $('#importName').val();
					if (importName == '') {
						swal('Please enter import name.');
						return false;
					}
					$scope.state['ImportFile'] = "Importing";
					//$('#idForm').submit();
					var form_data = $("#idForm").serialize();
					console.log('1 ImportFile status: ' + $scope.state['ImportFile']);
					console.log('Importname:' + importName);
					$.ajax({
						url: 'doImportFile.php', // point to server-side PHP script 
						dataType: 'json', // what to expect back from the PHP script, if anything
						cache: false,
						contentType: false,
						processData: false,
						data: form_data,
						type: 'get',
						success: function(json) {
							$scope.state['ImportFile'] = 'Import...';
							$scope.$apply();
							if (json.success) {
								swal({
										title: "Import Success",
										text: json.message,
										type: "success",
										showCancelButton: false,
										confirmButtonColor: "#DD6B55",
										confirmButtonText: "OK",
										closeOnConfirm: true
									},
									function() {
										location.href = 'audiences.php';
									});
							} else {

								swal({
									title: "Import Error",
									//text: "Studio return error",									  
									text: json.message,
									showConfirmButton: true
								});

							}
							console.log('3 ImportFile status: ' + $scope.state['ImportFile']);
						}
					});
				};




			}]);

			function uuidv4() {
				return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
					var r = Math.random() * 16 | 0,
						v = c == 'x' ? r : (r & 0x3 | 0x8);
					return v.toString(16);
				});
			}
		</script>

	</body>

	</html>