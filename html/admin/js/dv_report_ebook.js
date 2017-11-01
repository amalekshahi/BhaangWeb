myApp.controller('dvebookreport', ['$scope', '$http', 'Upload', function($scope, $http, Upload) {
	$scope.Load = function() {
        $http.get(dbEndPoint + "/" + dbName + '/' + campaignID + "?" + new Date().toString()).then(function(response) {    
			$scope.master = response.data;
            $scope.report = angular.copy($scope.master);
			$scope.LoadReport();
            $scope.Reset();
        });
    };

    $scope.LoadReport = function() {
		var fd = UTCDateTimeMDT();
		var td = UTCDateTimeMDT();		
		var tdate = toDate(td);	
		fd = addDays(tdate, -30);
		fd = formatDateMDY(fd);
		$scope.showreportebook = false;
        $http.get("getReportPage.php", {
            method: "GET",
            params: {
                campaignName: $scope.report.campaignName,
				programID: $scope.report.publishProgramID,
                fd: fd,
				td: td,
            }
        }).then(function(response) {
			if (response.data.success == false) {
				
			} else {
				$scope.reportebookConversion = response.data.conversion;	
				$scope.reportebookReach = response.data.Reach;	
				$scope.campaign.reportebook = [];
				var report = response.data.rows;
                for (var i = 0; i < report.length; i++) {
					$scope.showreportebook = true;					
                    $scope.campaign.reportebook.push({
						"orderid": report[i].orderid,
						"Page": report[i].Page,
                        "Visitors": report[i].Visitors,
                        "Submits": report[i].Submits,
						"Clicks": report[i].Clicks,
						"Responses": report[i].Responses,
                    });
                }
			}           
        }, function(response) {
            $scope.myAlert("A connection error occured. Please try again.");
        });
    }; // LoadReport
	
	$scope.ViewReport = function() {
        window.open("reporting.php?campaignID=" + campaignID);
    };

	$scope.Load();

}]);

