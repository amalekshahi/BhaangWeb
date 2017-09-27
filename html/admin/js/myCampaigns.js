var myApp = angular.module('myApp', ['angularMoment', 'davinci', 'localytics.directives']);
myApp.controller('myCtrl', function($scope, $http) {
    $scope.Reset = function() {
        $scope.campaignlist = angular.copy($scope.master);
    };
    $scope.Load = function() {
        $http.get(dbEndPoint + "/" + dbName + '/campaignlist').then(function(response) {
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
    $scope.Search = function() {
        //alert($scope.searchText);
        $scope.Load();
    };
    /*
    $scope.myFilter = function(item) {
        if (typeof $scope.searchText == 'undefined') {
            return true;
        }
        if ($scope.searchText == '') {
            return true;
        }
        if (item.campaignName.startsWith($scope.searchText)) {
            return true;
        }
        return false;
    };*/
    $scope.Load();
    
    $scope.goToLink = function(item) {
        window.location = 'edit' + item.campaignType + '.php?campaign_id=' + item.campaignID;
    };
});

myApp.filter('campaignNameFilter',  function() {
    return function( items, searchText) {
        var filtered = [];
        angular.forEach(items, function(item) {
            if((typeof searchText == 'undefined') || (searchText == "")){
                filtered.push(item);
            }else{
                if (item.campaignName.startsWith(searchText)) {
                    filtered.push(item);
                }
            }
        });
        return filtered;
    };
});
