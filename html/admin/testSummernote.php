<!doctype html>
<html ng-app="myApp">
<head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/angular-xeditable/0.8.0/css/xeditable.min.css" rel="stylesheet">
<link href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.4/angular-material.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet"/>

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
</head>
<body>
<style>
.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 10px;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
[hidden] {
  display: none !important;
}

</style>
<div ng-controller="myCtrl">
<label class="btn btn-default">
    Browse <input type="file" hidden>
</label>
    Test SummerNote
    <summernote ng-model="summerText" editor="editor" on-image-upload="imageUpload(files,'editor')"></summernote><br>
    {{summerText}}
    <summernote ng-model="summerText2" editor="editor1" on-image-upload="imageUpload(files,'editor1')"></summernote><br>
    {{summerText2}}
    <hr>
    Airmode<br>
    <summernote ng-model="summerText3" editor="editor3" config="options" on-image-upload="imageUpload(files,'editor3')"></summernote><br>
</div>

<script>
    var myApp = angular.module('myApp',  ['summernote',"ngFileUpload"]);
    myApp.controller('myCtrl',['$scope','$http','Upload',function($scope,$http,Upload) {
        $scope.summerText = "Summer Text 1"; 
        $scope.summerText2 = "Summer Text 2"; 
        $scope.summerText3 = "<img src='https://www.google.co.th/logos/doodles/2017/in-remembrance-of-his-majesty-king-bhumibol-adulyadej-5106535469416448.8-l.png'/>"; 
        $scope.options = {
            dialogsInBody: true,
            airMode: true,
            popover: {
              image: [
                ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']],
                ['image',['url']],
                ['change', ['changeImage']]
              ],
              air: [
                ['color', ['color']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']]
              ]
            },
            buttons: {
              changeImage: changeImageButton
            }
          };

        $scope.imageUpload = function(files,editor){
            var uploadFileName = "IMG-" + uuidv4();
            //$scope.editor.summernote('insertNode', imgNode);
            Upload.upload({
                url: 'upload.php',
                method: 'POST',
                file:files[0],
                data: {
                    file:files[0], 
                    's3':'true',
                    'fileName':uploadFileName,
                    'acctID':'accountID',
                    'progID':'programID',
                }
            }).then(function (resp) {
                console.log('Success ' + resp.config.data.file.name + 'uploaded');
                console.log(resp.data);
                var imgNode = $('<img>').attr('src', resp.data.imgSrc)[0];
                $scope[editor].summernote('insertNode',imgNode );
            }, function (resp) {
                console.log('Error status: ' + resp.status);
            }, function (evt) {
                var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
            });
        };
    }]);
    
    function uuidv4() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    }
    
    var changeImageButton = function (context) {
      var ui = $.summernote.ui;
      // create button
      var button = ui.button({
        contents: '<i class="fa fa-upload"/>',
        //contents: '<div class="fileUpload btn btn-primary"><span>Upload</span><input type="file" class="upload" /></div>',
        //contents: '<label class="btn btn-default">Browse <input type="file" hidden></label>',
        tooltip: 'Change',
        click: function () {
          // invoke insertText method with 'hello' on editor module.
            //context.invoke('editor.insertText', 'hello');
            //var editor = $.summernote.eventHandler.getEditor();
            //editor.insertImage($('.note-editable'), "http://162.243.155.57:5985/_utils/image/logo.png");
            //alert('1');
            //var imgNode = $('<img>').attr('src', "http://162.243.155.57:5985/_utils/image/logo.png")[0];
            //context.invoke('code',"<img src='http://162.243.155.57:5985/_utils/image/logo.png'>");
            //context.invoke('editor.insertNode', imgNode);
            //context.triggerEvent('image.upload');
            //$scope.imageUpload
            context.invoke('code','');
            context.invoke('imageDialog.show');
        }
      });

      return button.render();   // return button as jquery object
    }

</script>

</body>
</html>