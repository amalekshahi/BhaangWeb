<?php
    date_default_timezone_set('America/Los_Angeles');
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
    $dbName = $_SESSION['DBNAME'];
    $accountID = $_SESSION['ACCOUNTID'];
    $accountName = $_SESSION['ACCOUNNAME'];
?>

<!DOCTYPE html>
<html ng-app="myApp">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<!-- Angular -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-xeditable/0.8.0/js/xeditable.min.js"></script>
	<!-- KKK -->
    <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">


</head>
<body class="white-bg">
    <div id="wrapper">
	<!-- left wrapper -->
	<!-- <div w3-include-html="leftWrapper.html"></div> -->
	<!-- /end left wrapper -->
	<div id="page-wrapper1" class="gray-bg">
		<div class="row border-bottom">
				 <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
				<!-- top wrapper -->
				<!-- <div w3-include-html="topWrapper.html"></div> -->
				<!-- / top wrapper -->
				</nav>
		</div>	

<!-- content -->

<div ng-controller="myCtrl" id="myCtrl">
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
				<h2 id="havCID" style = "display:none;">List: "{{item['LIST-NAME']}}" [{{item['LIST-COUNT']}} People]</h2>
				<h2 id="noCID" style = "display:none;">All List</h2>
				<input type="button" value="Export" onclick="exportContact()">
				<div id="exportdiv" style="display:none;"></div>
            </div>
        </div>
		<div id="headTable" style="margin:0 10px;">
			<div id="DataTables_Table_1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer" ></div>
			<div class="dataTables_length" id="DataTables_Table_1_length" ></div>
			<div id="DataTables_Table_1_filter" class="dataTables_filter"></div>
			<div class="dataTables_info" id="DataTables_Table_1_info" role="status" aria-live="polite"></div>

			<table datatable="ng" dt-options="dtOptions" class="table table-striped table-bordered table-hover dataTables-example ng-isolate-scope dataTable no-footer" style="" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info" role="grid" >
				<thead>
				<tr>
				</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
			<form id="idForm">
				<input type="hidden" name="LISTDEFINITION" id="LISTDEFINITION">			
				<input type="hidden" name="cid" id="cid">			
			</form>
		</div><!-- headTable -->
</div><!-- myCtrl -->	

<!--/ content -->           		


	</div><!--  end page-wrapper -->
</div><!-- end id=wrapper -->

<!--  footer -->
<div class="footer"><div w3-include-html="footer.php"></div></div>

    <!-- Mainly scripts -->
	<script src="js/w3data.js"></script>	
	<script>w3IncludeHTML();</script>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script type="text/JavaScript" src="global.js?n=1"></script> 


    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>
	<script src="js/plugins/dataTables/datatables.min.js" style=""></script>	 
	 <!-- Page-Level Scripts -->
 	<script src="js/jquery.md5.js"></script>
	<script src="js/davinci.js"></script>
    <script>	
		Array.prototype.getIndexByValue = function (name, value) {
				for (var i = 0, len=this.length; i <len; i++) {
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
		myApp.controller('myCtrl',function($scope,$http) {			
			$scope.sendtocontact = function() {                 				
				  getContactClick(); 
            };			
			$scope.Load = function() {
                $http.get("/couchdb/" + dbName +'/audienceLists').then(function(response) {
                     $scope.master  = response.data; 
                     if (typeof $scope.master.items == 'undefined') {
                       $scope.master.items = [];
                     } 
                     //$scope.Reset();					 			 
					 $scope.audience  = angular.copy($scope.master);
					  indx = $scope.audience.items.getIndexByValue('contactID',cid);						  
					  if(cid == 'new' || indx == -1){
						  $scope.audience.items.push({"contactID":"","LIST-NAME":"","LIST-COUNT":"0","LIST-DESCRIPTION":"","LIST-DEFINITION":"","LIST-HASH":"","contactDetail":""});
					  }else{					 
						 $scope.item = $scope.audience.items[indx];
					  }
					  $scope.sendtocontact(); 
                });
            };
			$scope.Load();
		});

	
		function getContactClick() {		
			if(cid != "-1")	{				
				$("#havCID").show();
				$("#LISTDEFINITION").val(angular.element(document.getElementById('myCtrl')).scope().item['LIST-DEFINITION']);

			}else{
				$("#noCID").show();
				$("#cid").val("-1"); 
			}

			var form_data = $("#idForm").serialize();	
			$.ajax({
				url: 'getContact.php', // point to server-side PHP script 
				dataType: 'json',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,                         
				type: 'get',
				success: function(json){					
					var count = "0"; 
					if (json.success) {
						Contacts = json.Contact;
						columns = json.columns;				
						$('#DataTables_Table_1').DataTable( {
						    data: Contacts,
							columns: columns
						} );
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
				dataType: 'json',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,                         
				type: 'get',
				success: function(json){					
					var count = "0"; 
					if (json.success) {
						//var html ="Click <a href='https://web2xmm.com/admin/import/contactFile/"+json.tmpName+"'>here</a> or check your email to download the exported file.";
						var html ="Click <a href='https://web2xmm.com/admin/import/contactFile/"+json.tmpName+"'>here</a> to download the exported file.";
						$('#exportdiv').html(html);
						$('#exportdiv').show();						
					}					
				}
			 });
			 
		}
    </script>


</body>

</html>
