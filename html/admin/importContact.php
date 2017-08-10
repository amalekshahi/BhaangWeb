<!-- <?php
date_default_timezone_set('America/Los_Angeles');
session_start();
include 'global.php';
require_once('loginCredentials.php');
?> -->

<!doctype html>
<html ng-app="myApp">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Template</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

	<link href="css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

	<!-- Angular -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/angular-xeditable/0.8.0/css/xeditable.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-xeditable/0.8.0/js/xeditable.min.js"></script>
</head>
<body class="">
    <div id="wrapper">
	<!-- left wrapper -->
	<div w3-include-html="leftWrapper.html"></div>
	<!-- /end left wrapper -->
	<div id="page-wrapper" class="gray-bg">
		<div class="row border-bottom">
				 <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
				<!-- top wrapper -->
				<div w3-include-html="topWrapper.html"></div>
				<!-- / top wrapper -->
				</nav>
		</div>	
		
<!-- content -->
		<div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Upload contact: </h2>
            </div>
            <!--<div class="col-lg-2">

            </div>-->
        </div>
        <div class="row" ng-controller="myCtrl">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
								<form id="idForm" enctype="multipart/form-data" action="doImportFile.php" method="post">
									Send this file: <input name="file" id="fileUpload" type="file" />
									<input type="button" id="upload" name="upload" value="Upload..." onclick="uploadFile()">			
									
									<input type="hidden" id="uploadFileName" name="uploadFileName" value="" >							
									<input type="hidden" id="itemCount" name="itemCount" value="" >							
									<input type="hidden" id="headerValue" name="headerValue" value="" >												
								
									<div class="form-group" id="fieldDiv" style="display:none;"><label class="col-sm-2 control-label">Header List</label><br>
										<div id="headerdiv">
										</div>										
									</div>

									<div class="form-group" id="importNameDiv" style="display:none;"><label class="col-sm-2 control-label">Import Name</label>
										<div class="col-sm-10"><input type="text" class="form-control" name="importName" id="importName" placeholder="Import Name" >
										</div>
										<input type="button" name="import" value="Import..." onclick="importFile()">	
									</div>
									
								</form>
								
                                
                                
                        </div>
                    </div>
                </div>
            </div>        

<!--/ content -->           
			<div class="footer">
				<!-- footer -->
				<div w3-include-html="footer.html"></div>
				<!-- / footer -->			
			</div>
		</div><!--  end page-wrapper -->
</div>

    <!-- Mainly scripts -->
	<script src="js/w3data.js"></script>	
	<script>w3IncludeHTML();</script>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

	<!-- SUMMERNOTE -->
	<script src="js/plugins/summernote/summernote.min.js"></script>

    <!-- Page-Level Scripts -->
	<script src="js/jquery.md5.js"></script>
    <script>
		function uploadFile() {
			var x = document.getElementById("fileUpload");
			
			if ('files' in x) {
				if (x.files.length == 0) {
					alert('Please select a CSV file to upload.');					
					return false;	
				} else {
					var file = x.files[0];
					var filename = file.name;

					if( filename.substr(-4).toLowerCase() != '.csv' ) {
						alert('The file must be in the CSV format.');
						return false;
					} else {
						var file_data = $('#fileUpload').prop('files')[0];   
						var form_data = new FormData();                  
						form_data.append('file', file_data);
						
						
						$.ajax({
							url: 'doUploadFile.php', // point to server-side PHP script 
							dataType: 'json',  // what to expect back from the PHP script, if anything
							cache: false,
							contentType: false,
							processData: false,
							data: form_data,                         
							type: 'post',
							success: function(json){
								if (json.success) {
									$('#headerdiv').html(json.headerdiv);
									$('#uploadFileName').val(json.tmpName);
									$('#itemCount').val(json.itemCount);
									$('#headerValue').val(json.headerValue);
									
									
									$('#fieldDiv').show();
									$('#importNameDiv').show();
								} else {
									alert(json.message);
								}
							}
						 });
					}
				}				
			}		
		}

		function importFile() {
			var importName = $('#importName').val();
			if (importName == '') {
				alert('Please enter import name.');
				return false;
			}

			//$('#idForm').submit();


			var form_data = $("#idForm").serialize();   
						
			
			$.ajax({
				url: 'doImportFile.php', // point to server-side PHP script 
				dataType: 'json',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,                         
				type: 'get',
				success: function(json){
					alert(json.message);
					if (json.success) {
						location.href = 'audiences.html';
					} else {
						
					}
				}
			 });

		}
		
    </script>

</body>

</html>