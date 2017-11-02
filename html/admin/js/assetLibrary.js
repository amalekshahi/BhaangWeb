var assetLibrary = angular.module('assetLibrary', ['davinci', 'localytics.directives', "ngFileUpload"]);
assetLibrary.controller('assetList', ['$scope', '$http', 'Upload', function($scope, $http, Upload) {

		  $scope.showPreview = function(file) {
					//alert(file);
					$scope.showPreviewFile = file;
		  }; 
		  //$scope.folders = ["Images","HTML Emails","HTML Pages", "eBooks", "Videos", "Blueprint Defaults"];
		  $scope.folders = ["Images","Videos","Audio","Documents","Emails","Web Pages"];
		  $scope.tags = ["Prospect content", "Client content", "Internal stuff", "Mac-only"];  		

		  $scope.upload = function (file,emlID) {
					var fname = ""; 
					$scope.state['UpdFiles'] = 'uploading';
					/* //fungedit
					 for(var i = 0; i < file.length; i++){
						 files=file[i];
						 fname=files.fileName;
					 }
					console.log(" file.length = "+ file.length + "  filename = "+fname); 
					*/
					var uploadFileName = "IMG-" + uuidv4();
					//$scope.editor.summernote('insertNode', imgNode);
					Upload.upload({
						url: 'uploadS3.php',
						method: 'POST',
						file: file,
						data: {
							file: file,
							's3': 'true',
							'dbName': accID,
							'pathUpload': pathUpload,
							'fileName': uploadFileName,
							'acctID': 'accountID',
							'progID': 'programID',
						}
					}).then(function(resp) {
						console.log('Success ' + resp.config.data.file.name + 'uploaded');
						console.log(resp.data);
						var imgHTML = '<img src="'+resp.data.imgSrc+'">';
						//$scope.campaign['EMAIL'+emlID+'-HERO-IMAGE'] = imgHTML;
						$scope.state['UpdFiles'] = 'finish';
						$scope.Reloadpage();
					}, function(resp) {
						console.log('Error status: ' + resp.status);
						$scope.state['UpdFiles'] = 'error';
						/*
					}, function(evt) {
						var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
						console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
						*/ 
					});
			};// end upload

			$scope.NewFolderClick = function(frmName){				    
                    swal({
                      title: 'What is your new folder name?',
                      input: 'text',
                      inputValue: frmName,
                      showCancelButton: true,
                    }).then($scope.NewFolderClickOK);

			};

			$scope.NewFolderClickOK = function(newFolderName) { // newFolderName from inputValue
				if(newFolderName != ''){
						$http.get("createS3Folder.php"+"?" + new Date().toString(),
						{
							  method: "Get",
							  params: {
								initAccID:accID,
								mainFolder:$scope.host,  // "Images"
								folderName:newFolderName, 						
							  }  
						}
						).then(function(response) {							  
							  console.log("response[CreateFolder] = " + response.data);
							  if(response.data.success){
								  swal("Folder created."); 
								  $scope.Reloadpage();
							  }else{
								  swal("Can not create folder."); 
							  }
						});
					
				}else{
					swal({
						type: 'error',
						html: "Please enter folder name",
					});
				}			
				
			};// end NewFolderClickOK

			$scope.DeleteFileConfirm = function (fID) {
					/*
					swal({
						  title: 'Are you sure?',
						  text: "You won't be able to revert this!",
						  type: 'warning',
						  showCancelButton: true,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'Yes, delete it!',
						  cancelButtonText: 'No, cancel!',
						  confirmButtonClass: 'btn btn-success',
						  cancelButtonClass: 'btn btn-danger',
						  buttonsStyling: false
					 },
					function(isConfirm){
						  if (isConfirm) {
								$scope.DeleteFile(fID); 
						  } else {
								swal("Cancelled", "Your imaginary file is safe :)", "error");
						  }
					});
					*/ 

					swal({
						  title: 'Are you sure?',
						  text: "You won't be able to revert this!",
						  type: 'warning',
						  showCancelButton: true,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'Yes, delete it!'
					}).then(function(isConfirm) {
						  if (isConfirm) {
								$scope.DeleteFile(fID); 
						  }
					}); 
				
			};// end DeleteFileConfirm

			$scope.DeleteFile = function (fID) {
					$("#initAccID"+fID).val(accID) ; 		
					var form_data = $("#idForm"+fID).serialize();		
					//var pfile = $("#filepath"+fID).val(); 
					$scope.state['delFile'] = 'deleteing';										
					$.ajax({
						type: 'get',
						dataType: 'json',  // what to expect back from the PHP script, if anything
						url: 'deletefileS3.php', // point to server-side PHP script 	
						cache: false,
						contentType: false,
						processData: false,
						data: form_data,
						//data: jsonObj,
						success: function(json){		
							if (json.success) {
								$scope.state['delFile'] = 'finish';		
								swal("Your file was deleted!"); 
								$scope.Reloadpage();	

							}else{ //false
								console.log("result = "+json) ;	
							}
						}//end success
					 });	
			};// end DeleteFile

			$scope.Reloadpage = function() {
				$scope.Load(); 
				$scope.GetChildrenFolder(); 
			};

			$scope.copyToClipboard = function(x) {
				  copyClipboard(x); 
			};// end copyToClipboard

/*
			$scope.GenFile = function(fileLists) {
				var genFileArr = []; 
				for(i=0;i<fileLists.length;i++){
						var namefile = fileLists[i]; 
						var nameFilePath = "https://bkktest.s3.amazonaws.com/tmp/17124/stage/Images/"; 
						var fullnamefile = nameFilePath+namefile; 
						//console.log(" i["+i+"]  ="+namefile); 
						var fileDetail = { 
							"fileName":fullnamefile,
							"friendlyName":namefile
						}
//						$scope.files.push({
						genFileArr.push({
							"Name":fileDetail,
							"Thumbnail":fullnamefile,
							"Description":"This one is picture description.",
							"Type":"Image",
							"Size": "11k",
							"URI": fullnamefile,
							"Dimensions":"99 x 71"
						});
						
				}//end for
				return genFileArr; 
			}; 
*/ 

			$scope.state = {"showfile":"finish","UpdFiles":"finish","delFile":"finish"};

			$scope.Load = function() {
				//alert("Load"); 
				var pathfolder = getParameterByName("folder");
				if(pathfolder == "" || pathfolder == "undefined"){
					pathfolder = "Images"; 
				}

				$('#initFolder').val(pathfolder); 
				$('#initAccID').val(accID); 
				$scope.host = pathfolder; 
				//console.log( " accID = "+ $('#initAccID').val() );  
				//$('#initAccID').val("17124"); 
				var form_data = $("#initForm").serialize();
				$scope.state['showfile'] = "loading";
				$.ajax({
					url: 'getFileS3.php', // point to server-side PHP script 
					dataType: 'json',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                         
					type: 'get',
					success: function(json){					
						if (json.success) {
							console.log(json.fileLists); 
							$scope.files = json.fileLists;							
							if (typeof $scope.files == 'undefined' || $scope.files == 0) {		
								$scope.nofile = "yes"; 
							}else{
								$scope.nofile = "no"; 
							}
							$scope.state['showfile'] = "finish";
							$scope.$apply();
						}
					}
//				 });
				 }).then(function(resp) {									
					$scope.state['showfile'] = "finish";
				});
			};// end Load

			$scope.GetChildrenFolder = function(){				
					$http.get("getChildS3.php?initAccID=" + accID).then(function(response){
								if(response.data.success){							
									$scope.sections = response.data.sections; 
								}else{
									$scope.sections = []; 
								}	
					});			

			}; //GetChildrenFolder
			
			$scope.GetChildrenFolder(); 
			$scope.Load(); 			 
			  

}]);// end assetList


function copyClipboard(elementId) { 
  var aux = document.createElement("input"); 
  console.log(document.getElementById(elementId).innerHTML); 
  aux.setAttribute("value", document.getElementById(elementId).innerHTML); 
  document.body.appendChild(aux); 
  aux.select(); 
  document.execCommand("copy"); 
  document.body.removeChild(aux);
  swal("Copy to clipboard");

}