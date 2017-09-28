var fID = getParameterByName("fID");
var indx = -1; 
var defIndx = -1; 

var myApp = angular.module("myApp", ["ngRoute"]);
myApp.config(function($routeProvider) {
	$routeProvider
	.when("/", {
		templateUrl : "formEditorEdit.html"
	})
	.when("/new", {
		templateUrl : "formEditorNew.html"
	});		 
});

myApp.service('myService', ['$rootScope','$http', function($rootScope,$http) {
		this.GetDropdownOpt = function(fieldName) {
		//			$http.put(dbEndPoint + "/" + dbname + "/UserInfo", $scope.userinfo).then(function(response){
					//$http.get("/couchdb/master/Default_FormDropdown"+"?"+new Date().toString()).then(function(response) {
					$http.get(dbEndPoint + "/master/Default_FormDropdown"+"?"+new Date().toString()).then(function(response) {
								$rootScope.masterDD  = response.data; 
								if (typeof $rootScope.masterDD == 'undefined') {
								   $rootScope.masterDD = "";
								} 
								$rootScope.dropdownOpt  = angular.copy($rootScope.masterDD);		
								if(fieldName !=null || fieldName!=""){
									$rootScope.tmphtml += $rootScope.dropdownOpt[fieldName];
								}								
					},function(errResponse){
								if (errResponse.status == 404) {
									$rootScope.dropdownOpt = ""; 
									alert("ERROR::can not find dropdown list option"); 
								}							
					});						
				
        };// GetDropdownOpt		
		
		this.GetFormCodeG = function(codeType,fieldType,fieldID,fieldName,label,required,prepopulated) {				
		//codeType = "HTML" plus gen <script> tag in code
					$rootScope.tmpReq = ""; 
					$rootScope.tmpPrepop=""; 
					$rootScope.redstar = ""; 		
					if(required == "Yes"){
							$rootScope.tmpReq = ' required="" '; 
							$rootScope.redstar += '<span style="color:red;">&#42;</span>'	; 
					}
					if(prepopulated == "Yes"){
							$rootScope.tmpPrepop = '##'+fieldID+'##'; 						
					}

					$rootScope.tmphtml ='<div class="form-group"><label>'+label+'</label>'+$rootScope.redstar ;
					if(fieldType == "textbox" || fieldType == "email" || fieldType == "mobile" || fieldType == "phone"){

							$rootScope.tmphtml += ' <input class="form-control input-sm" id="'+fieldID+'" name="'+fieldID+'" '+$rootScope.tmpReq+' type="text" value="'+$rootScope.tmpPrepop+'"> '; 

					}else if(fieldType == "hidden"){		
						
							$rootScope.tmphtml += ' <input type="hidden" name="'+label+' value="'+$rootScope.tmpPrepop+'"> '; 
	
					}else if(fieldType == "dropdown"  || fieldType == "state"  || fieldType == "country"){

							$rootScope.tmphtml += ' <select id="'+fieldID+'" name="'+fieldID+'" class="form-control input-sm" '+$rootScope.tmpReq+'> '; 		
							//alert("["+fieldName +"] = " +  $rootScope.dropdownOpt[fieldName] );		
							if(typeof $rootScope.dropdownOpt != 'undefined') {
								$rootScope.tmphtml += $rootScope.dropdownOpt[fieldName];
							}else{
								this.GetDropdownOpt(fieldName)
							}
							$rootScope.tmphtml += '</select> '; 

					}else if(fieldType == "datetime"){
							var datename = fieldID+"_DATE"; 								
							if(codeType == "HTML"){
								$rootScope.tmphtml += ' <script>$(document).ready(function(){$("#'+datename +' .input-group.date").datepicker({todayBtn: "linked",keyboardNavigation: false,forceParse: false,calendarWeeks: true,autoclose: true});}); <\/script>' ;
							}
							$rootScope.tmphtml += '<div class="form-group" id="'+datename+'"><div class="input-group date"><span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control input-sm" value="" id="'+fieldID+'" name="'+fieldID+'" '+$rootScope.tmpReq+'></div></div>' ; 
								
					}else if(fieldType == "radio"){

						$rootScope.tmphtml += ' <input class="form-control input-sm" id="'+fieldID+'" name="'+fieldID+'" '+$rootScope.tmpReq+' type="text" value="'+$rootScope.tmpPrepop+'"> '; 
					}

					$rootScope.tmphtml +="</div>"; 

					return $rootScope.tmphtml

        };//GetFormCodeG

		this.LoadRightBlockG = function(codeType,selectItem) {
		//codeType = "HTML" plus gen <script> tag in code
					var summerdivtxt = ''; 
					var darray = []; 
					if(typeof selectItem != 'undefined') {
							for(i=0;i<selectItem.length;i++){																	
									summerdivtxt += this.GetFormCodeG(codeType,selectItem[i].fieldType,selectItem[i].fieldID,selectItem[i].fieldName,selectItem[i].label,selectItem[i].required,selectItem[i].prepopulated); 
									//summerdivtxt += $rootScope.tmphtml; 									

									if(selectItem[i].fieldType == 'datetime'){
											var datename = selectItem[i].fieldID+"_DATE"; 
											darray.push(datename); 											
									}
							}//end for i
					}
					$('#summerblock').html(summerdivtxt); 
					if(darray.length > 0 ){
						for(k=0;k<darray.length;k++){
							//runScriptDate(darray[i]); 
						}
					}
		};//LoadRightBlockG		 

		this.GenSelectedFromHTMLG = function(page,tempArr) {
				var retArr = this.reloadformfieldG(page); 
				var temphtml = ""; 
				var allFieldName =""; 

				for(i=0;i<tempArr.length;i++){						
						allFieldName += tempArr[i].fieldName;
						if(i<tempArr.length-1){		allFieldName +=", ";		}										
						temphtml += this.GetFormCodeG("HTML",tempArr[i].fieldType,tempArr[i].fieldID,tempArr[i].fieldName,tempArr[i].label,tempArr[i].required,tempArr[i].prepopulated);				
				}//end for i
				
				$rootScope.allFieldName = allFieldName; 
				$rootScope.selectedFromHTML = '<form action="#" id="rzForm" name="rzForm" method="post"><fieldset>'+temphtml+'<button class="btn btn-lg btn-block btn-warning" type="submit">Download Now!</button><p class="rz-required-note"><i>* Indicates a required field.<br>Answer all required fields to activate the button.</i></p> </fieldset></form>' ; return retArr;            
            };// end GenSelectedFromHTMLG()		
		
		this.reloadformfieldG = function(page) {
					var form_fields = $( "#form_fields" ).sortable( "toArray" );				   
					var summerdivtxt = ''; 				//display right block 
					var tempArr=[]; 
					for(i=0;i<form_fields.length;i++){							
						var fFieldName = $(document.getElementById(form_fields[i]+"FieldName")).val();	
						var fFieldType = $(document.getElementById(form_fields[i]+"FieldType")).val();	
						var flabel = $(document.getElementById(form_fields[i]+"Label")).val();	
						var frequire = $(document.getElementById(form_fields[i]+"Require")).val();	
						var fprefill = $(document.getElementById(form_fields[i]+"Prefill")).val();	
						var fprepop = $(document.getElementById(form_fields[i]+"Prepop")).val();	
						var freq = $(document.getElementById(form_fields[i]+"Req")).val();	
						//add array
						tempArr.push({"fieldID":form_fields[i], "fieldName":fFieldName, "label": flabel,"required": frequire,"prepopulated": fprefill,"fieldType": fFieldType }); 						
						summerdivtxt += this.GetFormCodeG("",fFieldType,form_fields[i],fFieldName,flabel,frequire,fprefill); 						
					}//end for i					
					$('#summerblock').html(summerdivtxt); 		
					return tempArr; 

		};//reloadformfieldG

}]);

myApp.controller('myCtrl', ['$scope','$http','myService', function($scope,$http,service) {
			$scope.state = {	"Save":"Save",	};
			$scope.defID = ""; 	
			$scope.tempArr = []; 
			$scope.SaveForm = function() {			
					$scope.state['Save'] = "Saving";				
					tempArr = service.GenSelectedFromHTMLG('edit',$scope.tempArr); 
					$scope.MyCopyItem('fieldLists',tempArr);	
					$scope.MyCopyItem('formHTML',$scope.selectedFromHTML);
					$scope.MyCopyItem('allFieldName',$scope.allFieldName); 
					var today = getCurrentDateTime();
					$scope.MyCopyItem('modifiedDate',today);	
					$scope.MyCopyItem('formType_DefID',$scope.defID);	

					$http.put(dbEndPoint + '/' + dbname + '/formLibrary',  $scope.frmlist).then(function(response){
							 $scope.LoadSelect('new'); 							 
							 $scope.state['Save'] = "Save";

					});         
            };

			$scope.CopyScope = function (ItemName,data) {
				$scope[ItemName] = data; 
			};			

			$scope.MyCopyItem = function (ItemName,data) {
				if(indx != -1)
					$scope.frmlist.items[indx][ItemName] = data; 
				else
					$scope.selectItem[ItemName] = data; 
			};

			$scope.GetCodeCallG = function (codeType,fieldType,fieldID,fieldName,label,required,prepopulated) {
					return service.GetFormCodeG(codeType,fieldType,fieldID,fieldName,label,required,prepopulated); 	
			};			

			$scope.reloadformfieldCallG = function (page) {
					return service.reloadformfieldG(page); 	
			};

			$scope.LoadSelect = function(load) {                
				$http.get(dbEndPoint + "/" + dbname + "/formLibrary"+"?"+new Date().toString()).then(function(response) {
							$scope.master  = response.data; 
							if (typeof $scope.master.items == 'undefined') {
							   $scope.master.items = [];
							} 
							$scope.frmlist  = angular.copy($scope.master);
							indx = $scope.frmlist.items.getIndexByValue('formID',fID);		
							$scope.selectFrm = $scope.frmlist.items[indx];
							$scope.selectItem = $scope.frmlist.items[indx]['fieldLists']; 							
							service.LoadRightBlockG("",$scope.selectItem); 
							$scope.tempArr = $scope.selectItem;  							
							$scope.defID = $scope.frmlist.items[indx]['formType_DefID']; 
							$scope.LoadDefault(load); 
				},function(errResponse){
							if (errResponse.status == 404) {
								$scope.frmlist = {items:[]};
							}							
                });				
            };

			$scope.LoadDefault = function(load) { 		
				$http.get(dbEndPoint + "/master/Default_FormLibrary"+"?"+new Date().toString()).then(function(response) {
							$scope.masterDef  = response.data; 
							if (typeof $scope.masterDef.items == 'undefined') {
							   $scope.masterDef.items = [];
							} 
							$scope.deflist  = angular.copy($scope.masterDef);

							if(typeof $scope.defID == 'undefined' || $scope.defID=="" ){								
								defIndx = $scope.deflist.items.getIndexByValue('defaultID',load);
							}else{
								defIndx = $scope.deflist.items.getIndexByValue('defaultID',$scope.defID);		
								$scope.deflist.items[defIndx]['fieldLists'].formSelected = "selected";
							}
							$scope.CheckDupOnLoad(defIndx); 

				},function(errResponse){
							if (errResponse.status == 404) {
								$scope.deflist = {items:[]};
							}
                });
            };

			$scope.CheckDupOnLoad = function(index) {
					if(index=="-1" ){		index= "0";	}
					if(typeof $scope.selectItem != 'undefined') {
							var defArr = []; 							
							for(i=0;i<$scope.deflist.items[index]['fieldLists'].length;i++){
									var isDup = false; 
									for(k=0;k<$scope.selectItem.length;k++){
											if($scope.deflist.items[index]['fieldLists'][i].fieldID == $scope.selectItem[k].fieldID){
												isDup = true; 
												break; 
											}else{
												isDup = false; 
											}
									}//for k
									if(!isDup){
											defArr.push($scope.deflist.items[index]['fieldLists'][i]); 
									}
							}//for i
							$scope.defItem = defArr; 
							$scope.defID = $scope.deflist.items[index]['defaultID'];
					}else{
							$scope.defItem = $scope.deflist.items[index]['fieldLists']; 	
							$scope.defID = $scope.deflist.items[index]['defaultID'];
					}
					if($scope.defItem.length > 10){
							$("#form_fields").height(900);	
					}else{
							$("#form_fields").height(650);	
					}
					/*
					$('.output2').html(" AAA > length = "+$scope.defItem.length + " f-field height = "+$("#form_fields").height() );	
					var height = Math.max($("#available_fields").height(), $("#form_fields").height());
					$("#form_fields").height(height);
//					$("#form_fields").height($("#available_fields").height());
*/ 

            };

			$scope.SelectChanged = function(defFrmID) { //				
				$scope.LoadDefault($scope.defID);	//send DefID to reload Available field				
            };								
			$scope.Reset = function() {
				$scope.dropdownOpt  = angular.copy($scope.masterDD);		
            };		

			$scope.SetRequire = function() {
                  var txt=$scope.selectItem;
            };					

			service.GetDropdownOpt(); 
			$scope.LoadSelect('new');		
}]);
//end myCtrl

myApp.controller('myNewCtrl', ['$scope','$http','myService', function($scope,$http,service) {
			$scope.state = {	"Save":"Save",	};
			$scope.defID = ""; 	
			$scope.tempArr = []; 
			$scope.SaveNewForm = function() {			
					$scope.state['Save'] = "Saving";				
					var LName = $('#frmName').val();			
					if(LName != ''){
						var keyword = LName+getCurrentDateTime();
						var conID = $.md5(keyword);      
						$scope.LoadSaveData(conID); 
					}else{
						$('.listNameAlt').html("Please fill Form Name");
					}
            };		

			$scope.LoadSaveData = function (formID) {
				//$scope.GenSelectedFromHTML();  // create $scope.selectedFromHTML / $scope.allFieldName
				tempArr = service.GenSelectedFromHTMLG("new",$scope.tempArr); 
				$scope.CopyScope('selectItem',tempArr); 

				var frmName = $('#frmName').val(); 
				var frmtype_defID = $scope.defID; //formType_DefID 
				var submission = "";
				var modDate = getCurrentDateTime(); 
				var allfield = $scope.allFieldName; //allFieldName
				var formhtml = $scope.selectedFromHTML;  //formHTML

				$http.get(dbEndPoint + "/" + dbname + "/formLibrary"+"?"+new Date().toString()).then(function(response) {
							$scope.master  = response.data; 
							if (typeof $scope.master.items == 'undefined') {
									$scope.master.items = [];
							} 							
							$scope.frmlist  = angular.copy($scope.master);						 
							$scope.frmlist.items.push({
									"formID":formID,
									"formName":frmName,
									"formType_DefID":frmtype_defID,
									"submission":submission,
									"modifiedDate":modDate,
									"allFieldName":allfield,
									"formHTML":formhtml,
									"fieldLists":$scope.selectItem
							});
							$scope.SaveDB(formID); 
					},function(errResponse){
							if (errResponse.status == 404) {
									$scope.frmlist = {items:[]};
									$scope.frmlist.items.push({
										"formID":formID,
										"formName":frmName,
										"formType_DefID":frmtype_defID,
										"submission":submission,
										"modifiedDate":modDate,
										"allFieldName":allfield,
										"formHTML":formhtml,
										"fieldLists":$scope.selectItem
									});
									$scope.SaveDB(formID); 
							}
					});
			
            };

			$scope.SaveDB = function(cID) {					
				$scope.state['Save'] = "Save";
				$http.put(dbEndPoint + "/" + dbname + "/formLibrary",  $scope.frmlist).then(function(response){
						 window.location.href="formEditor.php?fID="+cID; 
				});                    
			};

			$scope.CopyScope = function (ItemName,data) {
				$scope[ItemName] = data; 
			};
			
			$scope.MyCopyItem = function (ItemName,data) {
				if(indx != -1)
					$scope.frmlist.items[indx][ItemName] = data; 
				else
					$scope.selectItem[ItemName] = data; 
			};

			$scope.GetCodeCallG = function (codeType,fieldType,fieldID,fieldName,label,required,prepopulated) {
					return service.GetFormCodeG(codeType,fieldType,fieldID,fieldName,label,required,prepopulated); 	
			};

			$scope.reloadformfieldCallG = function (page) {
					return service.reloadformfieldG(page); 	
			};

			//Default Set Middle block From Start 
			$scope.LoadNewPageSelect = function(startDefaultMiddleArr) {                
				$scope.selectItem = [];					
				$scope.selectItem.push({"fieldID":"FirstName", "fieldName":"First Name", "label": "First Name","required": "No","prepopulated": "No","fieldType": "textbox" }); 				
				$scope.selectItem.push({"fieldID":"LastName", "fieldName":"Last Name", "label": "Last Name","required": "No","prepopulated": "No","fieldType": "textbox" }); 				
				$scope.selectItem.push({"fieldID":"Email", "fieldName":"Email", "label": "Email","required": "No","prepopulated": "No","fieldType": "email" }); 
				service.LoadRightBlockG("",$scope.selectItem); 
				$scope.tempArr = $scope.selectItem;  						
            };
			
			$scope.LoadNewPageDefault = function(load) { 			
				if(load=="new"){
					$scope.LoadNewPageSelect(); 
				}
				$http.get(dbEndPoint + "/master/Default_FormLibrary"+"?"+new Date().toString()).then(function(response) {
							$scope.masterDef  = response.data; 
							if (typeof $scope.masterDef.items == 'undefined') {
							   $scope.masterDef.items = [];
							} 
							$scope.deflist  = angular.copy($scope.masterDef);

							if(typeof $scope.defID == 'undefined' || $scope.defID=="" ){								
								defIndx = $scope.deflist.items.getIndexByValue('defaultID',load);								
							}else{
								defIndx = $scope.deflist.items.getIndexByValue('defaultID',$scope.defID);									
								$scope.deflist.items[defIndx]['fieldLists'].formSelected = "selected";
							}
							$scope.CheckDupOnLoad(defIndx); 
							
							if(load=='new'){
								/* //fung			
								//set option on start
									var defaultVal = document.getElementById('femailPrepop').value;
									setOptionSelected("femailPrefill",defaultVal);
									defaultVal = document.getElementById('fnamePrepop').value;
									setOptionSelected("fnamePrefill",defaultVal);									
									*/ 
							}

				},function(errResponse){
							if (errResponse.status == 404) {
								$scope.deflist = {items:[]};
							}
                });
            };

			$scope.CheckDupOnLoad = function(index) {
					if(index=="-1" ){		index= "0";	}
					if(typeof $scope.selectItem != 'undefined') {
							var defArr = []; 							
							for(i=0;i<$scope.deflist.items[index]['fieldLists'].length;i++){
									var isDup = false; 
									for(k=0;k<$scope.selectItem.length;k++){
											if($scope.deflist.items[index]['fieldLists'][i].fieldID == $scope.selectItem[k].fieldID){
												isDup = true; 
												break; 
											}else{
												isDup = false; 
											}
									}//for k
									if(!isDup){
											defArr.push($scope.deflist.items[index]['fieldLists'][i]); 
									}
							}//for i
							$scope.defItem = defArr; 
							$scope.defID = $scope.deflist.items[index]['defaultID'];
					}else{
							$scope.defItem = $scope.deflist.items[index]['fieldLists']; 	
							$scope.defID = $scope.deflist.items[index]['defaultID'];
					}			
					if($scope.defItem.length > 10){
							$("#form_fields").height(900);	
					}else{
							$("#form_fields").height(650);	
					}
            };

			$scope.SelectChanged = function(defFrmID) { //
				$scope.LoadNewPageDefault($scope.defID);	//send DefID to reload Available field
				//$('.alerttest').html(" formtype = "+ftype);
            };			
			$scope.Reset = function() {                  

            };			

			$scope.SetRequire = function(selid,hidid) {
                  alert( document.getElementById(selid).val() );
                  alert( document.getElementById(hidid).val() );
            };	

			service.GetDropdownOpt(); 
			$scope.LoadNewPageDefault('new');	

}]);
//end myNewCtrl

function setOptionSelected(ename,defaultVal){		
			var eid = document.getElementById(ename);
			if(eid != "undefined"){
				$("#"+ename).find("option").each(function () {
					if ($(this).val() == defaultVal) {
						$(this).prop("selected", "selected");
					}
				});
//				$("#"+ename).find("option").each(function () {					alert(ename +" = " + $(this).val()); 				});				
			}
}

function reloadformfield(page){	
		var retArr = []; 
		if(page=="new"){
				retArr = angular.element(document.getElementById('myNewCtrl')).scope().reloadformfieldCallG(page);
				angular.element(document.getElementById('myNewCtrl')).scope().CopyScope('selectItem',retArr);
				angular.element(document.getElementById('myNewCtrl')).scope().CopyScope('tempArr',retArr);		
		}else{
				retArr = angular.element(document.getElementById('myCtrl')).scope().reloadformfieldCallG(page);
				angular.element(document.getElementById('myCtrl')).scope().MyCopyItem('fieldLists',retArr);
				angular.element(document.getElementById('myCtrl')).scope().CopyScope('tempArr',retArr);
		}
} 

function runScriptDate(dateID){
	 $("#"+dateID+" .input-group.date").datepicker({todayBtn: "linked",keyboardNavigation: false,forceParse: false,calendarWeeks: true,autoclose: true});
}
