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
					$scope.state['UpdFiles'] = 'uploading';
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
					}, function(evt) {
						var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
						console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
					});
			};// end upload

			$scope.DeleteFile = function (fID) {
					var pfile = $("#filepath"+fID).val(); 
					console.log(" filepath = "+ pfile); 				
					$scope.state['delFile'] = 'deleteing';					
					//alert(" val = "+ $('#LISTDEFINITION').val() ); 		
					var jsonObj = {"initAccID":accID, "initPathFileName": pfile} ; 
					$.ajax({
						type: 'get',
						url: 'deletefileS3.php', // point to server-side PHP script 						
						data: jsonObj,
						success: function(json){												
							if (json.success) {
								console.log("result = "+json.result) ;	
								$scope.state['delFile'] = 'finish';
								$scope.Reloadpage();	
							}else{ //false
								console.log("result = "+json.errorMsg) ;	
							}
						}//end success
					 });	
			};// end DeleteFile

			$scope.Reloadpage = function() {
				$scope.Load(); 
				//location.reload(); 
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