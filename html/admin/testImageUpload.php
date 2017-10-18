<!doctype html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/danialfarid-angular-file-upload/12.2.13/ng-file-upload.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> 
<style>
.image-upload-container {
  position: relative;
  margin-top: 50px;
  width: 200px;
  height: 200px;
  border-style: solid;
  border-width: 1px;
  overflow:hidden;

}

.image-upload-container:hover .image-upload-overlay {
  display: block;
  background: rgba(0, 0, 0, .3);
}

.image-upload-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0);
  transition: background 0.5s ease;
}

.image-upload {
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
}

.image-upload-form {
  position: absolute;
  top: 50%;
  left: 50%;
  opacity: 0;
  transition: opacity .35s ease;
  transform: translate(-50%,-50%);
}

.image-upload-container:hover .image-upload-form {
  opacity: 1;
}
</style>
</head>
<body>
<div  ng-app="myApp" ng-controller="myCtrl">
<div class="container">
<div class="row">
    <div class="col-sm-6"><image-Upload model="urla" /></div>
    <div class="col-sm-6"><image-Upload model="urlb" /></div>
</div>   
<div class="row">
    <div class="col-sm-6">{{urla}}</div>
    <div class="col-sm-6">{{urlb}}</div>
</div>   

</div>    
</div>
<script>
var myApp = angular.module("myApp", ['ngFileUpload']);
myApp.controller('myCtrl',['$scope','$http','Upload',function($scope,$http,Upload) {
    $scope.url = "https://images.unsplash.com/photo-1488628075628-e876f502d67a?dpr=1&auto=format&fit=crop&w=200&h=200&q=80&cs=tinysrgb&crop=&bg=";
    $scope.urla = "https://images.unsplash.com/photo-1488628075628-e876f502d67a?dpr=1&auto=format&fit=crop&w=200&h=200&q=80&cs=tinysrgb&crop=&bg=";
    $scope.urlb = "http://162.243.155.57:5985/_utils/image/logo.png";
    $scope.upload = function(file,fileName){
        Upload.upload({
            url: 'upload.php',
            method: 'POST',
            file:file,
            data: {
                file:file, 
                's3':'true',
                'fileName':file.name,
                'acctID':'accountID',
                'progID':'programID',
            }
        }).then(function (resp) {
            console.log('Success ' + resp.config.data.file.name + 'uploaded');
            console.log(resp.data);
            $scope.url = resp.data.imgSrc;
            //$scope.userinfo[propname] = resp.data.imgSrc;
        }, function (resp) {
            console.log('Error status: ' + resp.status);
        }, function (evt) {
            var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
            console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
        });
    };
}]);

myApp.directive('imageUpload', function() {
    var directive = {};
    directive.restrict = 'E'; /* restrict this directive to elements */
    directive.templateUrl = "imageUpload.html";
    directive.scope = {
        model: "=model",
    };
    directive.controller = function($scope,Upload){
        $scope.imageUploadUpload = function(file,fileName){
            Upload.upload({
                url: 'upload.php',
                method: 'POST',
                file:file,
                data: {
                    file:file, 
                    's3':'true',
                    'fileName':file.name,
                    'acctID':'accountID',
                    'progID':'programID',
                }
            }).then(function (resp) {
                console.log('Success ' + resp.config.data.file.name + 'uploaded');
                console.log(resp.data);
                //$scope.src = resp.data.imgSrc;
                $scope.model = resp.data.imgSrc;
            }, function (resp) {
                console.log('Error status: ' + resp.status);
            }, function (evt) {
                var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
            });
        };
    };
    return directive;
});
</script>
</body>
</html>