<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import</title>
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
<div class="row">

						<div class="row wrapper">
							 <div class="col-lg-12">            
									<h2>Import Contact: </h2>

									<!-- <ol class="breadcrumb">
										<li>
											<a href="editContact.html?cid={{item.contactID}}">{{item['LIST-NAME']}}</a>
										</li>
										<li>
											<strong>Import Contact</strong>
										</li>
									</ol> -->
							</div>
						</div><!-- page-heading -->

						<div class="ibox-content">
                            <form id="idForm" enctype="multipart/form-data" action="doImportFile.php" method="post">
										<div class="row">
												<label class="col-sm-2 control-label">Send this file:</label><br>												
										</div>

										<div class="row wrapper border-bottom page-heading">
												<div class="col-lg-12">   
												<!-- <label class="fileContainer">Choose file upload. Click Here!<input name="file" id="fileUpload" type="file"></label> -->
												<!-- <button class="btn btn-outline btn-success  dim" type="button"><i class="fa fa-paste"></i> </button> -->
												<p style="display:inline"><input id="choseFile" type="text" disabled="disabled" placeholder="Choose File"></p>												
															<div class="file-upload btn btn-outline btn-success  dim"><span><i class="fa fa-paste"></i></span>  
															<!-- <div class="file-upload btn btn-primary"><span>Choose File</span>   -->
															<input class="upload" id="fileUpload" type="file"></div>  
															<script type="text/javascript">  
																document.getElementById("fileUpload").onchange = function () {  
																	document.getElementById("choseFile").value = $('input[type=file]').val().split('\\').pop();
																};
															</script>  
															<style>  
																input[type="file"] {display: block;}
																input[type="file"]:focus{outline: thin dotted;outline: 5px auto -webkit-focus-ring-color;outline-offset: -2px;}
																.file-upload {position: relative;  overflow: hidden;  margin: 10px;  }
																.file-upload input.upload {position: absolute;  top: 0;  right: 0;  margin: 0;  padding: 0;  font-size: 20px;  cursor: pointer;  opacity: 0;  filter: alpha(opacity=0); }
																#choseFile {line-height: 30px;border: 1px solid #1c84c6; }
															</style>
															<button class="btn btn-success"  id="upload" type="button" onclick="uploadFile()"><i class="fa fa-upload"></i>&nbsp;&nbsp;<span class="bold">Upload</span></button>
															<input type="hidden" id="uploadFileName" name="uploadFileName" value="" >							
															<input type="hidden" id="itemCount" name="itemCount" value="" >							
															<input type="hidden" id="headerValue" name="headerValue" value="" >	
												</div>	
												<!-- <input type="button" id="upload" name="upload" value="Upload..." onclick="uploadFile()">			 -->
												<!-- <div class="col-lg-8"> 
														<button class="btn btn-success " type="button" onclick="uploadFile()"><i class="fa fa-upload"></i>&nbsp;&nbsp;<span class="bold">Upload</span></button>
														<input type="hidden" id="uploadFileName" name="uploadFileName" value="" >							
														<input type="hidden" id="itemCount" name="itemCount" value="" >							
														<input type="hidden" id="headerValue" name="headerValue" value="" >												
												</div>	 -->
										</div><!--row page-heading 2 -->
										<div class="row">
												<div class="form-group" id="fieldDiv" style="display:none;"><label class="col-sm-2 control-label"><h2>Header List</h2></label><br>
													<div id="headerdiv">
													</div>										
												</div>
										</div>
										<div class="row">
												<div class="form-group" id="importNameDiv" style="display:none;">
												<label class="col-sm-2 control-label">Import Name</label>
													<div class="col-sm-4"><input type="text" class="form-control" name="importName" id="importName" placeholder="Import Name" >
													</div>
													<!-- <input type="button" name="import" value="Import..." onclick="importFile()">	 -->
													<button class="btn btn-success " type="button"  onclick="importFile()"><i class="fa fa-upload"></i>&nbsp;&nbsp;<span class="bold">Import...</span></button>
												</div>

										</div>

                            </form>

						</div><!-- ibox-content -->
                
</div><!-- myCtrl -->

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