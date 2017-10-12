<?php

require_once 'commonUtil.php';?><!doctype html>
<html ng-app="myApp">
<head>
<?php include "header.php"; ?>
<link href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.4/angular-material.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/5.9.4/jsoneditor.css" rel="stylesheet" >
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/5.9.4/jsoneditor.js"></script>
<script src="https://cdn.rawgit.com/angular-tools/ng-jsoneditor/master/ng-jsoneditor.js"></script>
<script src="js/davinci.js"></script>
</head>
<body>
<div class="bg-primary">
  <h1>DBUtil 1.0 <?php echo $databaseEndpoint;?></h1>
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
      <md-tab label="Check Audience">
        <md-content md-theme="docs-dark" layout="column" class="md-padding">          
            <md-content md-theme="docs-dark" layout="row" layout-padding>    
                <md-input-container>
                    <button ng-click="CheckAudience()">Check</button>
                </md-input-container>  
            </md-content>                  
        </md-content>
        <div ng-if="audience.data" ng-jsoneditor="onLoad" ng-model="audience.data" options="audience.options" style="width: 98%;"></div>
      </md-tab>        
    </md-tabs>
  </md-content>
</div>  
{{result}}

</div>
<script>
var myApp = angular.module('myApp', ['ngMaterial','ng.jsoneditor']);
myApp.controller('myCtrl',['$scope','$http',function($scope,$http) {
    //http://127.0.0.1:8080/admin/couchdb.php/_all_dbs
    $scope.audience = {
        options: {mode: 'tree'},
    }
    $scope.CheckAudience = function(){
        $http.get("couchdb.php/_all_dbs"+"?" + new Date().toString()).then(function(response) {
              $scope.audience.data = {
                 "_all_dbs":response.data,
                 result:[]
              }              
              //console.log($scope.audience.data);
              var arrayLength = $scope.audience.data._all_dbs.length;
              for (var i = 0; i < arrayLength; i++) {
                    var item = $scope.audience.data._all_dbs[i]
                    if(item.startsWith("db")){
                        //console.log("Checking " + item);
                        $http.get("couchdb.php/" + item + "/audienceLists?" + new Date().toString()).then(function(response) {
                            var index = response.config.url.indexOf("?");
                            var dbName = response.config.url.substring(0,index);
                            //console.log("Processing " + dbName);
                            var items = response.data.items;
                            var shouldSave = false;
                            if(typeof items == "undefined"){
                                console.log(dbName + " missing items");
                                response.data.items = [];
                                shouldSave = true;
                            }else{
                                for(var i=0;i<items.length;i++){
                                    if(typeof items[i].lastEditDate == "undefined"){
                                        console.log(dbName + " missing at " + i);
                                        items[i].lastEditDate = getCurrentDateTime();
                                        shouldSave = true;
                                    }else{
                                        //console.log(dbName + " Found " + items[i].lastEditDate);
                                    }
                                }
                            }
                            if(shouldSave){
                                $http.put(dbName + "?" + new Date().toString(),response.data).then(function(response) {
                                    console.log("Saving " + dbName + " done");
                                    console.log(response.data);
                                });
                            }else{
                                //console.log("Processing " + dbName + " done");
                                $scope.audience.data.result.push("Processing " + dbName + " done");
                                console.log("Processing " + dbName + " done");
                            }
                            //lastEditDate
                        });
                    }
              }
        });
    }
}]);
myApp.config(function($mdThemingProvider) {
               $mdThemingProvider.theme('docs-dark') 
               .primaryPalette('grey')
               .accentPalette('orange')
               .warnPalette('red');
            });
</script>
</body>
</html>