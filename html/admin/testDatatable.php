<!doctype html>
<html>
<head>
<!--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> 

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"/>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

</head>
<body>
<div  ng-app="myApp" ng-controller="myCtrl">

<table width="100%" class="display" id="example" cellspacing="0">
</table>  
</div>
<script>
/*var myApp = angular.module("myApp", []);
myApp.controller('myCtrl',['$scope','$http',function($scope,$http) {
}]);
*/
$(document).ready(function() {
    $('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "getContactEx.php?cid=-1",
        //"pagingType": "simple",
        //buttons: ['copy', 'excel', 'pdf'],
        //stateSave: true, // Remember how the User left the table
        //colReorder: true,
        language: {
            "search": "Search People: ",
            searchPlaceholder: "Start typing here ...",
        },
        //"data": Contacts,
        "columns": [{"title":"FirstName"},{"title":"LastName"},{"title":"Email"},{"title":"Phone"},{"title":"Address1"},{"title":"City"},{"title":"State"},{"title":"Zip"}],
        /*"columnDefs": [{
            "defaultContent": "",
            "targets": "_all"
        }]*/
    });
});
</script>
</body>
</html>