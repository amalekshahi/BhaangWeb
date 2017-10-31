<?php

require_once 'commonUtil.php';?><!doctype html>
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
  <h1>TestBed 1.0 <?php echo $databaseEndpoint;?> s3Path=<?php echo $AWSFormatFileName;?></h1>
</div>  
<style>
.md-tab {
    text-transform: none;
}
</style>
<div ng-controller="myCtrl">
<div ng-cloak>
  <md-content>
    <md-tabs md-dynamic-height md-border-bottom>
      <md-tab label="backend">
        <md-content md-theme="docs-dark" layout="column" class="md-padding">          
            <md-content md-theme="docs-dark" layout="row" layout-padding>    
                <md-input-container>
                    <label>cmd</label>
                    <md-select ng-model="backend.cmd">
                        <md-option value="publish">publish</md-option>
                        <md-option value="update">update</md-option>
                        <md-option value="copy">copy</md-option>                        
                        <md-option value="userinfo">userinfo</md-option>                        
                        <md-option value="userinfo2s3">userinfo2s3</md-option>
                        <md-option value="test">test</md-option>
                    </md-select>
                </md-input-container>  
                <md-input-container>
                    <label>mode</label>
                    <!--<input ng-model="backend.mode" placeholder="[test]">-->
                    <md-select ng-model="backend.mode">
                        <md-option value="">--not set--</md-option>
                        <md-option value="junk">junk</md-option>
                        <md-option value="mamlInfo">mamlInfo</md-option>
                    </md-select>
                </md-input-container>  
                <md-input-container>
                    <label>acctID</label>
                    <input ng-model="backend.acctID" placeholder="228">
                </md-input-container>  
                <md-input-container>
                    <label>progID</label>
                    <input ng-model="backend.progID" placeholder="b81fc4f3c0f9a7cd2856dc97c3b42373">
                </md-input-container">  
                <md-input-container  ng-show="backend.cmd=='copy'">
                    <label>name</label>
                    <input ng-model="backend.name" placeholder="new campaign namw">
                </md-input-container>  
                <md-input-container>
                    <button ng-click="backendClick()">submit</button>
                </md-input-container>  
            </md-content>                  
            
        </md-content>  
        <div ng-if="backend.data" ng-jsoneditor="onLoad" ng-model="backend.data" options="backend.options" style="width: 98%;"></div>
      </md-tab label>        
      <md-tab label="getEmailTemplate">
        <md-content md-theme="docs-dark" layout="column" class="md-padding">          
            <md-content md-theme="docs-dark" layout="row" layout-padding>    
                <md-input-container>
                    <label>blueprint</label>
                    <md-select ng-model="getEmailTemplate.blueprint">
                        <md-option value="PromoteBlog">PromoteBlog</md-option>
                        <md-option value="PromoteEbook">PromoteEbook</md-option>
                    </md-select>
                </md-input-container>  
                <md-input-container>
                    <label>resource</label>
                    <md-select ng-model="getEmailTemplate.resource">
                        <md-option value="emails">emails</md-option>
                        <md-option value="pages">pages</md-option>
                    </md-select>
                </md-input-container>  
                
                <md-input-container>
                    <button ng-click="getEmailTemplateClick()">submit</button>
                </md-input-container>  
            </md-content>                  
        </md-content>  
        <div ng-if="getEmailTemplate.data" ng-jsoneditor="onLoad" ng-model="getEmailTemplate.data" options="getEmailTemplate.options" style="width: 98%;"></div>
      </md-tab label>        
      
      <md-tab label="login">
        <md-content md-theme="docs-dark" layout="column" class="md-padding">          
            <md-content md-theme="docs-dark" layout="row" layout-padding>    
                 <md-input-container>
                    <label>email</label>
                    <input ng-model="login.email" >
                </md-input-container>  
                <md-input-container>
                    <label>password</label>
                    <input ng-model="login.pwd" >
                </md-input-container>  
                <md-input-container>
                    <button ng-click="loginClick()">submit</button>
                </md-input-container>  
            </md-content>                  
        </md-content>  
        <div ng-if="login.data" ng-jsoneditor="onLoad" ng-model="login.data" options="login.options" style="width: 98%;"></div>
      </md-tab label>   
      
      <md-tab label="couchDB">
        <md-content md-theme="docs-dark" layout="column" class="md-padding">          
            <md-content md-theme="docs-dark" layout="row" layout-padding>    
                <md-input-container>
                    <label>path</label>
                    <input ng-model="couchDB.path" >
                </md-input-container>  
                <md-input-container>
                    <label>method</label>
                    <md-select ng-model="couchDB.method">
                        <md-option value="PUT">put</md-option>
                        <md-option value="GET">get</md-option>
                    </md-select>
                </md-input-container>                  
                <md-input-container>
                    <button ng-click="couchDBClick()">submit</button>
                </md-input-container>  
            </md-content>                  
        </md-content>  
        <div ng-if="couchDB.data" ng-jsoneditor="onLoad" ng-model="couchDB.data" options="couchDB.options" style="width: 98%;"></div>
      </md-tab label>        
      
      <md-tab label="getContact">
        <md-content md-theme="docs-dark" layout="column" class="md-padding">          
            <md-content md-theme="docs-dark" layout="row" layout-padding>    
                <md-input-container>
                    <label>cid</label>
                    <input ng-model="getContact.cid" >
                </md-input-container>  
                <md-input-container>
                    <label>length</label>
                    <input ng-model="getContact.length" >
                </md-input-container>  
                <md-input-container>
                    <label>start</label>
                    <input ng-model="getContact.start" >
                </md-input-container>  
                <md-input-container>
                    <label>search</label>
                    <input ng-model="getContact.search" >
                </md-input-container>                  
                <md-input-container>
                    <button ng-click="getContactClick()">submit</button>
                </md-input-container>  
            </md-content>                  
        </md-content>  
        <div ng-if="getContact.data" ng-jsoneditor="onLoad" ng-model="getContact.data" options="getContact.options" style="width: 98%;"></div>
      </md-tab label>        
    </md-tabs>
  <md-content>
</div>  
{{result}}

</div>
<script>
  var myApp = angular.module('myApp', ['ngMaterial','ng.jsoneditor']);
  myApp.controller('myCtrl',['$scope','$http',function($scope,$http) {
        $scope.backend = {
            cmd:"publish",
            acctID:"16916",
            progID:"1d528fd7f31ba330223fa579b311c968",
            options: {mode: 'tree'},
        };
        $scope.backendClick = function(){
            $scope.backend.data = {};
            $http.get("backend.php"+"?" + new Date().toString(),
                {
                  method: "POST",
                  params: {
                    cmd: $scope.backend.cmd,
                    acctID: $scope.backend.acctID,
                    progID: $scope.backend.progID,
                    mode: $scope.backend.mode,
                    name: $scope.backend.name,
                  }  
                }
            ).then(function(response) {
                  $scope.backend.data = response.data;
                  console.log($scope.backend.response);
            },function(response){
                  alert(response.statusText);
                  console.log(response);
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

        $scope.getEmailTemplate = {
            blueprint: "PromoteBlog",
            resource: 'emails',
            options: {  
                mode: 'tree',
                
            },
        };
        $scope.getEmailTemplateClick = function(){
            $scope.getEmailTemplate.data = {};
            $http.get("getEmailTemplate.php"+"?" + new Date().toString(),
                {
                  method: "POST",
                  params: {
                    blueprint: $scope.getEmailTemplate.blueprint,
                    resource: $scope.getEmailTemplate.resource,
                  }  
                }
            ).then(function(response) {
                  $scope.getEmailTemplate.data = response.data;
                  console.log($scope.getEmailTemplate.response);
            },function(response){
                  alert(response.statusText);
                  console.log(response);
            });
        };        
        
        $scope.login = {
            email: "tt994613@gmail.com",
            pwd: "Atm12345#",
            options: {mode: 'tree'},
        };
        $scope.loginClick = function(){
            $scope.login.data = {};
            $http.get("login.php"+"?" + new Date().toString(),
                {
                  method: "GET",
                  params: {
                    email: $scope.login.email,
                    pwd: $scope.login.pwd,
                  }  
                }
            ).then(function(response) {
                  $scope.login.data = JSON.parse(clearCallBack(response.data)); // response.data;
                  console.log($scope.login.response);
            });
        };                
        
        $scope.couchDB = {
            options: {mode: 'tree'},
        };
        $scope.couchDBClick = function(){
            $scope.couchDB.data = {};
            if($scope.couchDB.method == "GET"){
                $http.get("couchdb.php"+ $scope.couchDB.path + "?" + new Date().toString()).then(function(response) {
                      $scope.couchDB.data = response.data;
                      console.log($scope.couchDB.response);
                });
            }
            if($scope.couchDB.method == "PUT"){
                $http.put('couchdb.php' + $scope.couchDB.path, $scope.couchDB).then(function(response) {
                      $scope.couchDB.data = response.data;
                      console.log($scope.couchDB.response);
                });
            }

        };                
        
        $scope.getContact = {
            cid:-1,
            length:10,
            start:0,
            search:"",
            options: {mode: 'tree'},
        };
        $scope.getContactClick = function(){
            $scope.getContact.data = {};
            var search = "";
            if($scope.getContact.search != ""){
                search = "&" +  encodeURIComponent("search[value]") + "=" + $scope.getContact.search;
            }
            var order = encodeURIComponent("order[0][column]") + "=2&" + encodeURIComponent("order[0][dir]") + "=asc";
            $http.get("getContactEx.php?cid=" + $scope.getContact.cid + "&draw=1&start=" + $scope.getContact.start + "&length=" + $scope.getContact.length + search + "&" + order + "&" + new Date().toString()).then(function(response) {
                  $scope.getContact.data = response.data;
                  console.log($scope.getContact.response);
            },function(response){
                  alert(response.statusText);
                  console.log(response);
            });
        };          
  }]);
</script>
</body>
</html>