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
        <md-content md-theme="docs-dark" layout="column" class="md-padding">          
            <md-content md-theme="docs-dark" layout="row" layout-padding>    
                <md-input-container>
                    <label>cmd</label>
                    <md-select ng-model="backend.cmd">
                        <md-option value="publish">publish</md-option>
                        <md-option value="update">update</md-option>
                        <md-option value="getID">getID</md-option>
                    </md-select>
                </md-input-container>  
                <md-input-container>
                    <label>mode</label>
                    <!--<input ng-model="backend.mode" placeholder="[test]">-->
                    <md-select ng-model="backend.mode">
                        <md-option value="">--not set--</md-option>
                        <md-option value="junk">junk</md-option>
                    </md-select>
                </md-input-container>  
                <md-input-container>
                    <label>acctID</label>
                    <input ng-model="backend.acctID" placeholder="228">
                </md-input-container>  
                <md-input-container>
                    <label>progID</label>
                    <input ng-model="backend.progID" placeholder="b81fc4f3c0f9a7cd2856dc97c3b42373">
                </md-input-container>  
                <md-input-container>
                    <button ng-click="backendClick()">submit</button>
                </md-input-container>  
            </md-content>                  
            
        </md-content>  
        <div ng-if="backend.data" ng-jsoneditor="onLoad" ng-model="backend.data" options="backend.options" style="width: 98%;"></div>
      </md-tab label>        
      <md-tab label="CheckOut">
        <md-content class="md-padding">
          <h1 class="md-display-1">Tab tow</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla venenatis ante augue. Phasellus volutpat neque ac dui mattis vulputate. Etiam consequat aliquam cursus. In sodales pretium ultrices. Maecenas lectus est, sollicitudin consectetur felis nec, feugiat ultricies mi.</p>
        </md-content>  
      </md-tab label>        
      <!--
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

</div>
<script>
  var myApp = angular.module('myApp', ['ngMaterial','ng.jsoneditor']);
  myApp.controller('myCtrl',['$scope','$http',function($scope,$http) {
        $scope.backend = {
            cmd:"publish",
            acctID:"228",
            progID:"24d4ea35fd91047acdc18b2746372cee",
            options: {mode: 'tree'},
        };
        $scope.backendClick = function(){
            $scope.backend.data = {};
            $http.get("backend.php",
                {
                  method: "POST",
                  params: {
                    cmd: $scope.backend.cmd,
                    acctID: $scope.backend.acctID,
                    progID: $scope.backend.progID,
                    mode: $scope.backend.mode,
                  }  
                }
            ).then(function(response) {
                  $scope.backend.data = response.data;
                  console.log($scope.backend.response);
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