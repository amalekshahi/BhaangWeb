myApp.controller('dvreport', ['$scope', '$http', 'Upload', function($scope, $http, Upload) {
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
		$scope.showreport = false;
        $http.get("getReportEmail.php", {
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
				$scope.campaign.report = [];
				var report = response.data.rows;
                for (var i = 0; i < report.length; i++) {
					$scope.showreport = true;
					var emailName = getEmailName(report[i].Email,'short');
                    $scope.campaign.report.push({
						"emailName": emailName,
                        "Sent": report[i].Sent,
						"Delivered": report[i].Delivered,
                        "Opened": report[i].Opened,
						"Clicked": report[i].Clicked,
						"Unsubscribed": report[i].Unsubscribed,
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

