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
        /*function Render(template,data){
            var reg = /\{{(.*?)\}}/;
            var html = template;
            while (match = reg.exec(html)) {
                console.log(match);
                // first shows the match: <h1>,h1
                // then shows the match: </h1>,/h1
                var slugPattern = match[0];
                var slug = match[1];
                var renderRaw = false;
                if(slug.startsWith("RAW ")){
                    renderRaw = true;
                    slug = slug.substring(4);
                }
                html = html.replace(slugPattern,data[slug]);
                //console.log(slug);
            }
            return html;
        }*/
        myApp = angular.module('myApp', ["xeditable","ngFileUpload","summernote"]);
            myApp.controller('myCtrl',['$scope','$http','Upload',function($scope,$http,Upload) {
                $scope.data = {
                    out:"",
                };
                $scope.Load = function() {
                    $scope.count++;
                    $http.get("/couchdb/db16916/10abbb541aff9d3b002d94568541c8ac" + "?"+new Date().toString()).then(function(response) {
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
