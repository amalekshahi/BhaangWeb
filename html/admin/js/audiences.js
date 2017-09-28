
var myApp = angular.module('myApp', ["xeditable",'davinci','localytics.directives']);
myApp.controller('myCtrl', function($scope, $http) {
    $scope.Reset = function() {
        $scope.audience = angular.copy($scope.master);
    };
    $scope.Load = function() {
        $http.get(dbEndPoint + "/" + dbName + '/audienceLists' + "?" + new Date().toString()).then(function(response) {
            $scope.master = response.data;
            if (typeof $scope.master.items == 'undefined') {
                $scope.master.items = [];
            }
            $scope.Reset();

        }, function(errResponse) {
            if (errResponse.status == 404) {
                $scope.audience = {
                    items: []
                };
            }
        });
    };

    $scope.Load();
});

function importContact() {
    window.location.href = "importContact.php";
}
