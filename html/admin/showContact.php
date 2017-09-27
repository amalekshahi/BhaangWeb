<?php
    date_default_timezone_set('America/Los_Angeles');
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
?>
	<!DOCTYPE html>
	<html ng-app="myApp">

	<head>
		<?php include "header.php"; ?>
		</head>

	<body class="fixed-sidebar">
		<div id="wrapper">
			<!-- left wrapper -->
			<div w3-include-html="leftWrapper.php"></div>
			<!-- /end left wrapper -->
			<div id="page-wrapper" class="gray-bg">
				<div class="row border-bottom">
					<nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
						<!-- top wrapper -->
						<?php include 'topWrapper.php'; ?>
						<!-- / top wrapper -->
					</nav>
				</div>
				<!-- content -->
				<div class="row" ng-controller="myCtrl" id="myCtrl" ng-cloak>
					<div class="col-lg-12">
						<div class="ibox float-e-margins">
							<div class="ibox-title">
								<h5 id="havCID" style="display:none;">List: "{{item['LIST-NAME']}}" [{{item['LIST-COUNT']}} People]</strong>
								</h5>
								<h5 id="noCID" style="display:none;">Everyone</strong>
								</h5>

								<div class="ibox-tools">
									<button type="button" class="btn btn-default btn-xs" onclick="exportContact()"><i class="fa fa-download" aria-hidden="true" style="color:blue"></i> Download these People</button>
									<div id="exportdiv" style="display:none;"></div>
								</div>
							</div>
							<div class="ibox-content">
								<div>
									<div class="row wrapper border-bottom white-bg page-heading">
										<div>
											<h2 id="havCID" style="display:none;">List: "{{item['LIST-NAME']}}" [{{item['LIST-COUNT']}} People]</h2>
											<h2 id="noCID" style="display:none;">All List</h2>
										</div>
									</div>
									<div id="headTable" style="margin:0 10px;">
										<div>
											<p></p>
										</div>
										<table datatable="ng" dt-options="dtOptions" class="table table-striped table-bordered table-hover dataTables-example ng-isolate-scope dataTable no-footer" style="" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info" role="grid">
										</table>
										<form id="idForm">
											<input type="hidden" name="LISTDEFINITION" id="LISTDEFINITION">
											<input type="hidden" name="cid" id="cid">
										</form>
									</div>
									<!-- headTable -->
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- myCtrl -->
				<!--/ content -->
			</div>
			<!--  end page-wrapper -->
		</div>
		<!-- end id=wrapper -->

		<!--  footer -->
		<div class="footer">
			<div w3-include-html="footer.php"></div>
		</div>

		<!-- Mainly scripts -->
		<script src="js/w3data.js"></script>
		<script>
			w3IncludeHTML();
		</script>
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
		<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		<script type="text/JavaScript" src="global.js?n=1"></script>


		<!-- Custom and plugin javascript -->
		<script src="js/inspinia.js"></script>
		<script src="js/plugins/pace/pace.min.js"></script>

		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.4.2/b-colvis-1.4.2/b-flash-1.4.2/b-html5-1.4.2/b-print-1.4.2/cr-1.4.1/fh-3.1.3/sl-1.2.3/datatables.min.css"/>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.4.2/b-colvis-1.4.2/b-flash-1.4.2/b-html5-1.4.2/b-print-1.4.2/cr-1.4.1/fh-3.1.3/sl-1.2.3/datatables.min.js"></script>


	
		<!-- Page-Level Scripts -->
		<script src="js/jquery.md5.js"></script>
		<script src="js/davinci.js"></script>
		<script>
			Array.prototype.getIndexByValue = function(name, value) {
				for (var i = 0, len = this.length; i < len; i++) {
					if (this[i][name]) {
						if (this[i][name] === value) {
							return i
						}
					}
				}
				return -1;
			};
			var cid = getParameterByName("cid");
			var indx = -1;

			var dbName = "<?php echo $dbName; ?>";
			var myApp = angular.module('myApp', ["xeditable"]);
			myApp.controller('myCtrl', function($scope, $http) {
				$scope.sendtocontact = function() {
					getContactClick();
				};
				$scope.Load = function() {
					$http.get(dbEndPoint + "/" + dbName + '/audienceLists').then(function(response) {
						$scope.master = response.data;
						if (typeof $scope.master.items == 'undefined') {
							$scope.master.items = [];
						}
						//$scope.Reset();					 			 
						$scope.audience = angular.copy($scope.master);
						indx = $scope.audience.items.getIndexByValue('contactID', cid);
						if (cid == 'new' || indx == -1) {
							$scope.audience.items.push({
								"contactID": "",
								"LIST-NAME": "",
								"LIST-COUNT": "0",
								"LIST-DESCRIPTION": "",
								"LIST-DEFINITION": "",
								"LIST-HASH": "",
								"contactDetail": ""
							});
						} else {
							$scope.item = $scope.audience.items[indx];
						}
						$scope.sendtocontact();
					});
				};
				$scope.Load();
			});


			function getContactClick() {
				if (cid != "-1") {
					$("#havCID").show();
					$("#LISTDEFINITION").val(angular.element(document.getElementById('myCtrl')).scope().item['LIST-DEFINITION']);

				} else {
					$("#noCID").show();
					$("#cid").val("-1");
				}

				var form_data = $("#idForm").serialize();
				$.ajax({
					url: 'getContact.php', // point to server-side PHP script 
					dataType: 'json', // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,
					type: 'get',
					success: function(json) {
						var count = "0";
						if (json.success) {
							Contacts = json.Contact;
							columns = json.columns;
							$('#DataTables_Table_1').DataTable({
								"lengthMenu": [ [15, 50, -1], [15, 50, "All"] ],
								"processing": true,
								buttons: ['copy', 'excel', 'pdf'],
								stateSave: true, // Remember how the User left the table
								colReorder: true,
								language: {
									"search": "Search People: ",
        					searchPlaceholder: "Start typing here ...",
   							 },
								"data": Contacts,
								"columns": columns
							});
						}
					}
				});
			}

			function exportContact() {
				//alert("Please check your email to download the exported file.");

				$("#LISTDEFINITION").val(angular.element(document.getElementById('myCtrl')).scope().item['LIST-DEFINITION']);
				LISTDEFINITION = $("#LISTDEFINITION").val();


				var form_data = $("#idForm").serialize();
				$.ajax({
					url: 'exportContact.php', // point to server-side PHP script 
					dataType: 'json', // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,
					type: 'get',
					success: function(json) {
						var count = "0";
						if (json.success) {
							//var html ="Click <a href='https://web2xmm.com/admin/import/contactFile/"+json.tmpName+"'>here</a> or check your email to download the exported file.";
							var html = "Click <a href='https://web2xmm.com/admin/import/contactFile/" + json.tmpName + "'>here</a> to download the exported file.";
							$('#exportdiv').html(html);
							$('#exportdiv').show();
						}
					}
				});

			}
		</script>


	</body>

	</html>