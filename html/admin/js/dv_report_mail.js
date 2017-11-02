myApp.controller('dvreport', ['$scope', '$http', 'Upload', function($scope, $http, Upload) {
	$scope.Load = function() {
        $http.get(dbEndPoint + "/" + dbName + '/' + campaignID + "?" + new Date().toString()).then(function(response) {    
			$scope.master = response.data;
            $scope.report = angular.copy($scope.master);
			$scope.LoadReport();
			$scope.LoadSummary();
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
						"DeliveredRate": 100 * (report[i].Delivered / report[i].Sent),
						"Delivered": report[i].Delivered,
						"OpenedRate": 100 * (report[i].Opened / report[i].Delivered),
                        "Opened": report[i].Opened,
						"ClickedRate": 100 * (report[i].Clicked / report[i].Opened),
						"Clicked": report[i].Clicked,
						"UnsubscribedRate": 100 * (report[i].Unsubscribed / report[i].Opened),
						"Unsubscribed": report[i].Unsubscribed,
						"ConversionsRate": "0",
						"Conversions": "0",
                    });
                }
			}           
        }, function(response) {
            $scope.myAlert("A connection error occured. Please try again.");
        });
    }; // LoadReport

	$scope.LoadSummary = function() {

		var fd = UTCDateTimeMDT();
		var td = UTCDateTimeMDT();		
		var tdate = toDate(td);	
		fd = addDays(tdate, -30);
		fd = formatDateMDY(fd);
		
		//alert(mode+','+fd);
		$http({
			method: 'GET',
			url: 'getReportEmailSummary.php' + "?programID=" + $scope.report.publishProgramID + "&campaignName=" + $scope.report.campaignName + "&fd=" + fd + "&td=" + td + "&nocache=" + new Date().toString()
		}).then(function(response) {
			if (response.data.success == false) {
				//var errorMessage = prettyStudioErrorMessage(response.data.detail.Result.ErrorMessage);
				//swal("fail");
			} else {
				$scope.campaign.reportSumary = [];
				$scope.campaign.reportSumarySent = response.data.rows[0].Sent;
				$scope.campaign.reportSumaryDelivered = response.data.rows[0].Delivered;
				$scope.campaign.reportSumaryDeliveredRate = 100 * (response.data.rows[0].Delivered / response.data.rows[0].Sent);
				$scope.campaign.reportSumaryOpened = response.data.rows[0].Opened;
				$scope.campaign.reportSumaryOpenedRate = 100 * (response.data.rows[0].Opened / response.data.rows[0].Delivered);
				$scope.campaign.reportSumaryClicked = response.data.rows[0].Clicked;
				$scope.campaign.reportSumaryClickedRate = 100 * (response.data.rows[0].Clicked / response.data.rows[0].Opened);
				$scope.campaign.reportSumaryUnsubscribed = response.data.rows[0].Unsubscribed;
				$scope.campaign.reportSumaryUnsubscribedRate = 100 * (response.data.rows[0].Unsubscribed / response.data.rows[0].Opened);
				$scope.campaign.reportSumaryConversions = '0';
				$scope.campaign.reportSumaryConversionsRate = '0';				
			}

		}, function(errResponse) {});

	}; // LoadSummary
	
	$scope.ViewReport = function() {
        window.open("reporting.php?campaignID=" + campaignID);
    };

	$scope.Load();

}]);

