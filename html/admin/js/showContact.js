var cid = getParameterByName("cid");
	var indx = -1;
	var myApp = angular.module('myApp', ["xeditable"]);
	myApp.controller('myCtrl', function($scope, $http) {
				$scope.sendtocontact = function() {
					//var reloadCntclick = getContactClick();
					$scope.GetContactClick(); 
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
								/*
								$scope.audience.items.push({
									"contactID": "",
									"LIST-NAME": "",
									"LIST-COUNT": "0",
									"LIST-DESCRIPTION": "",
									"LIST-DEFINITION": "",
									"LIST-HASH": "",
									"contactDetail": ""
								}); */ 
							} else {
								$scope.item = $scope.audience.items[indx];
							}
							$scope.sendtocontact();
					});
				};


				$scope.GetContactClick = function() {
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
									if (cid != "-1")		$scope.item['LIST-COUNT'] = Contacts.length; 
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
										"columns": columns,
										"columnDefs": [{
											"defaultContent": "",
										    "targets": "_all"
										}]
									});
								}
								//reload check countClick
								$http.put(dbEndPoint + "/" + dbName +'/audienceLists',  $scope.audience).then(function(response){		
									 $scope.audience._rev = response.data.rev;                      
									 $scope.master = angular.copy($scope.audience);   
								});  
						}
					});				
				};

				$scope.Load();
	});
	
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
			responsive: true,
			type: 'get',
			success: function(json) {
				var count = "0";
				if (json.success) {
					//var html ="Click <a href='https://web2xmm.com/admin/import/contactFile/"+json.tmpName+"'>here</a> or check your email to download the exported file.";
					var html = "<a href='https://web2xmm.com/admin/import/contactFile/" + json.tmpName + "'><i class='fa fa-file-text-o' aria-hidden='true'></i> Your file is ready.  Click here to download</a>.";
					$('#exportdiv').html(html);
					$('#exportdiv').show();
				}
			}
		});

	}