var gatekeeper = angular.module('gatekeeper', ['davinci', 'localytics.directives']);

gatekeeper.controller('gatekeeperController', function($scope, $http) {

  $http.get('gatekeeper/gatekeeper.json')
      .then(function successCallback(response) {
        // this callback will be called asynchronously
        // when the response is available
        $scope.gates = response.data;
        //alert($scope.gates);

      }, function errorCallback(response) {
        // called asynchronously if an error occurs
        // or server returns response with an error status.
       alert("Error!");
      });
});