<!doctype html>
<html ng-app="myApp">
<head>
<link href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.4/angular-material.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/5.9.4/jsoneditor.css" rel="stylesheet" >

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.js"></script> 
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.js"></script> 

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-animate.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-aria.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-messages.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.4/angular-material.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/5.9.4/jsoneditor.js"></script>
<script src="https://cdn.rawgit.com/angular-tools/ng-jsoneditor/master/ng-jsoneditor.js"></script>

<script src="js/davinci.js"></script>
</head>
<body>
<div class="bg-primary">
  <h1>TestBed 1.0</h1>
</div>  
<div ng-controller="myCtrl">
<div ng-cloak>
  <md-content>
    <md-tabs md-dynamic-height md-border-bottom>
      <md-tab label="backend">
        <md-content md-theme="docs-dark" layout="column" class1="md-padding">          
            <md-content md-theme="docs-dark" layout="row" layout-padding>            
                <md-input-container>
                    <label>cmd</label>
                    <input ng-model="backend.cmd" placeholder="publish/update">
                </md-input-container>
                <md-input-container>
                    <label>mode</label>
                    <input ng-model="backend.mode" placeholder="[test]">
                </md-input-container>  
                <md-input-container>
                    <label>acctID</label>
                    <input ng-model="backend.acctID" placeholder="228">
                </md-input-container>  
                <md-input-container>
                    <label>progID</label>
                    <input ng-model="backend.progID" placeholder="4e98af380d523688c0504e98af3">
                </md-input-container>  
            </md-content>                  
            <md-input-container>
                <button ng-click="backendClick()">submit</button>
            </md-input-container>  
        </md-content>  
      </md-tab label>        
      <!--
      <md-tab label="two">
        <md-content class="md-padding">
          <h1 class="md-display-1">Tab tow</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla venenatis ante augue. Phasellus volutpat neque ac dui mattis vulputate. Etiam consequat aliquam cursus. In sodales pretium ultrices. Maecenas lectus est, sollicitudin consectetur felis nec, feugiat ultricies mi.</p>
        </md-content>  
      </md-tab label>        
      <md-tab label="three">
        <md-content class="md-padding">
          <h1 class="md-display-1">Tab three</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla venenatis ante augue. Phasellus volutpat neque ac dui mattis vulputate. Etiam consequat aliquam cursus. In sodales pretium ultrices. Maecenas lectus est, sollicitudin consectetur felis nec, feugiat ultricies mi.</p>
        </md-content>  
      </md-tab label>        -->
    </md-tabs>
  <md-content>
</div>  
{{result}}
<div ng-if="obj.data" ng-jsoneditor="onLoad" ng-model="obj.data" options="obj.options" style="width: 98%;"></div>
</div>
<script>
  var myApp = angular.module('myApp', ['ngMaterial','ng.jsoneditor']);
  myApp.controller('myCtrl',['$scope','$http',function($scope,$http) {
        $scope.obj = {options: {mode: 'tree'}};
        $scope.backendClick = function(){
            console.log('backendClick');
        };
            
          $scope.Load = function() {
            $scope.count++;
            $http.get("/couchdb/" + data.username +'/userinfo' + "?"+new Date().toString()).then(function(response) {
                $scope.master  = response.data; 
                if (typeof $scope.master.items == 'undefined') {
                    $scope.master.items = [];
                } 
                $http.get("/admin/getEmailTemplate.php?blueprint=PromoteBlog&scopeName=userinfo").then(function(response) {
                    $scope.templates  = response.data.templates; 
                    $scope.config = response.data.config;
                    $scope.Reset();
                });

            });
          };
          $scope.Save = function() {

            $http.put('/couchdb/' + data.username +'/userinfo', $scope.userinfo).then(function(response){
                  $scope.data = response.data;                  
            });         
          };
          $scope.AddNew = function(){
              $scope.userinfo.items.push({"id":"empty","name":"empty","value":"empty","value2":"empty"});
          };
          $scope.IsNew = function(item){
              return false;
          };
          
          $scope.Login = function(){
              $http.get("/admin/loginOriginal.php",
                {
                  method: "GET",
                  params: {
                    email: $scope.login.userName,
                    pwd: $scope.login.passWord,
                    account: 228,
                  }  
                }
              ).then(function(response) {
                  $scope.login.response = JSON.parse(clearCallBack(response.data));
                  //alert("OK: " + response.statusText);
                  $scope.login.mps = [];
                  var mps = $scope.login.response.mps;
                  for(var i=0;i < mps.length; i++){
                      $scope.login.mps.push({"id":mps[i][1],"name":mps[i][1]}); 
                  } 
              },function(response){
                  alert("ERROR: " + response.statusText);
              });
          };
          
          $scope.Login2 = function(){
              //alert($scope.login.mpsSelect);
              alert($scope.mpsSelect);
              $http.get("/admin/loginOriginal.php",
                {
                  method: "GET",
                  params: {
                    mode: "login",
                    email: $scope.login.userName,
                    pwd: $scope.login.passWord,
                    account: $scope.mpsSelect,
                  }  
                }
              ).then(function(response) {
                  $scope.login.response = JSON.parse(clearCallBack(response.data));
                  alert("OK: " + $scope.login.response.success);
              });
          };
          
          $scope.Submit = function(){
            alert('submit');
          };
          
            $scope.upload = function (file,propname) {
                console.log(propname);
                Upload.upload({
                    url: 'upload.php',
                    method: 'POST',
                    file:file,
                    data: {
                        file:file, 
                        's3':'true',
                        'fileName':propname,
                        'acctID':'accountID',
                        'progID':'programID',
                    }
                }).then(function (resp) {
                    console.log('Success ' + resp.config.data.file.name + 'uploaded');
                    console.log(resp.data);
                    $scope.userinfo[propname] = resp.data.imgSrc;
                }, function (resp) {
                    console.log('Error status: ' + resp.status);
                }, function (evt) {
                    var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                    console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
                });
            };
            
            $scope.upload2 = function (file,propname,$event) {
                console.log(propname);
                Upload.upload({
                    url: 'upload.php',
                    method: 'POST',
                    file:file,
                    data: {
                        file:file, 
                        's3':'true',
                        'fileName':propname,
                        'acctID':'accountID',
                        'progID':'programID',
                    }
                }).then(function (resp) {
                    console.log('Success ' + resp.config.data.file.name + 'uploaded');
                    console.log(resp.data);
                    $scope.userinfo[propname] = resp.data.imgSrc;
                }, function (resp) {
                    console.log('Error status: ' + resp.status);
                }, function (evt) {
                    var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                    console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
                });
            };              
            
            $scope.SelectChanged = function(){
                $scope.content = angular.copy($scope.selectedTemplate);
                $("#myDiv").html($scope.content);
                angular.element(document).injector().invoke(function($compile) {
                    var scope = angular.element($("#myDiv")).scope();
                    $compile($("#myDiv"))(scope);
                });
            };                
  }]);
</script>
</body>
</html>