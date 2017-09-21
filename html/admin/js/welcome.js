myApp.controller('myCtrl', function($scope, $http) {
    $scope.Reset = function() {
        $scope.campaignlist = angular.copy($scope.master);
        // Added by Dave on 9/20/17 so that UI can know whether or not to display table of campaigns.
        if ($scope.campaignlist.campaigns.length > 0) {
        $scope.numberOfCampaigns = 1;
        } else {
        $scope.numberOfCampaigns = 0;
        }
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
        //return Math.floor((Math.random() * range) + 1);
      return 1;
    };
    $scope.Load();

    $scope.goToLink = function(item) {
    window.location = 'edit' + item.campaignType + '.php?campaign_id=' + item.campaignID;
    };
    
});


$(document).ready(function() {
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
});	


