var myApp = angular.module('myApp', ['angularMoment']);
myApp.controller('myCtrl', function($scope, $http) {
    $scope.Reset = function() {
        $scope.campaignlist = angular.copy($scope.master);
    };
    $scope.Load = function() {
        //$http.get("/couchdb/" + dbName + '/campaignlist?' + new Date().toString()).then(function(response) {
        $http.get(dbEndPoint + "/" + dbName + '/campaignlist?' + new Date().toString()).then(function(response) {
            //$http.get("/couchdb/" + dbName +'/campaignlist?'+new Date().toString()).then(function(response) {
            $scope.master = response.data;
            if (typeof $scope.master.campaigns == 'undefined') {
                $scope.master.campaigns = [];
            }
            $scope.Reset();
        });
    };
    $scope.Random = function(range) {
        return Math.floor((Math.random() * range) + 1);
    };
    $scope.Load();

    $scope.goToLink = function(item) {
    window.location = 'edit' + item.campaignType + '.php?campaign_id=' + item.campaignID;
    };
    
});

$(document).ready(function() {
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
});	


