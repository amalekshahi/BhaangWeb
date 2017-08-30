<html ng-app="myApp">
<head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/angular-xeditable/0.8.0/css/xeditable.min.css" rel="stylesheet">
<link href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.4/angular-material.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">


<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.js"></script> 
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-animate.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-aria.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-messages.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.4/angular-material.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-xeditable/0.8.0/js/xeditable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/danialfarid-angular-file-upload/12.2.13/ng-file-upload-all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-summernote/0.8.1/angular-summernote.js"></script>
<script src="js/davinci.js"></script>
</head>
  <body>
    TestJSRender 1.0<br>
    <div ng-controller="myCtrl">
      <button ng-click="Load()">Load</button>
      <button ng-click="Render()">Render</button>
      {{data.out}}
    </div>
    <script>
        myApp = angular.module('myApp', ["xeditable","ngFileUpload","summernote"]);
            myApp.controller('myCtrl',['$scope','$http','Upload',function($scope,$http,Upload) {
                $scope.data = {
                    out:"",
                };
                $scope.Load = function() {
                    $scope.count++;
                    $http.get("/couchdb/db228/b81fc4f3c0f9a7cd2856dc97c3b42373" + "?"+new Date().toString()).then(function(response) {
                        $scope.campaign  = response.data; 
                    });
                };
                $scope.Render = function(){
                    $scope.data.out = Render($scope.campaign['TEXT-AREA-ACCTID-PROGRAMID-EMAIL1CONTENT'],$scope.campaign);
                };
            }]);
        
    </script>
  </body>
</html>
