function showcalendar(filterID) {
	    $("#EMAIL1-SCHEDULE"+filterID+"-DATE").datepicker("show");
}

myApp.controller('step3', function($scope, $http) {
    //alert('step3');
    /*$scope.dateChange = function() {
        if ($scope.campaign['EMAIL1-SCHEDULE1-DATE'] != "" && $scope.campaign['EMAIL1-SCHEDULE1-TIME'] != "") {
            $scope.campaign['EMAIL1-SCHEDULE1-DATETIME'] = $scope.campaign['EMAIL1-SCHEDULE1-DATE'] + ' ' + convertTimeFormat($scope.campaign['EMAIL1-SCHEDULE1-TIME']);
            var date1 = toDate($scope.campaign['EMAIL1-SCHEDULE1-DATETIME']);
            var date2 = date1;
            for (var i = 2; i <= 3; i++) {
                var emailName = "EMAIL" + i;
                if ( (typeof $scope.campaign[emailName + '-WAIT'] != 'undefined') && (typeof $scope.campaign[emailName + '-SCHEDULE1-TIME'] != 'undefined') && ($scope.campaign[emailName + '-WAIT'] != "") && ($scope.campaign[emailName + '-SCHEDULE1-TIME'] != "") ) {
                    var numberOfDaysToAdd = parseInt($scope.campaign[emailName + '-WAIT']);
                    date2 = addDays(date2, numberOfDaysToAdd);
                    $scope.campaign[emailName + '-SCHEDULE1-DATETIME'] = formatDateMDY(date2) + ' ' + convertTimeFormat($scope.campaign[emailName + '-SCHEDULE1-TIME']);;
                } else {
                    $scope.campaign[emailName + '-SCHEDULE1-DATETIME'] = "01/01/2050 08:00:00 AM";
                }
            }
            $scope.ShowScheduleDateTime();
        }
    };*/
    $scope.Cancel = function() {
        //$scope.frmStep3.$setPristine();
        $scope.$parent.Cancel();
        //$scope.Reset(); // parent scope's Reset()
    };

    $scope.ArrangeFilter = function(filterID) {
			$scope.AuFilter = angular.copy($scope.masterAu);
			var auCnt = 0;
			var auOpr = "";
			var allRule = "";
			var selList = [];
			for (var i = 0; i < $scope['filter'+filterID+'List'].length; i++) {
				var indx = $scope.AuFilter.items.getIndexByValue('contactID', $scope['filter'+filterID+'List'][i]);
				selList.push($scope['filter'+filterID+'List'][i]);
				$scope.auItem = $scope.AuFilter.items[indx];
				var auItemOpr = $scope.auItem['LIST-OPERATOR'];
				auOpr += "(";
				var arrItem = $scope.auItem['LIST-ARRAY'];
				if (typeof $scope.auItem['LIST-ARRAY'] != 'undefined') {
					var itemRule = "";
					for (var k = 0; k < arrItem.length; k++) {
						auCnt++;
						//alert(arrItem[k]); 
						if (arrItem[k] != null) {
							itemRule = itemRule + '<Criteria Row=\"' + auCnt + '\" Field=\"' + arrItem[k].Field + '\" Operator=\"' + arrItem[k].Operator + '\" Value=\"' + arrItem[k].Value + '\" />';
						}
						auOpr += auCnt;
						var opr = "&amp;"
						if (arrItem[k].JoinOperator == "or") opr = "|";
						if (k < arrItem.length - 1) auOpr += opr;

					} // end for k
					//alert(itemRule ); 
					allRule += itemRule;
				}
				auOpr += ")";
				if (i < $scope['filter'+filterID+'List'].length - 1) auOpr += "|";
			} //end for i		

			$scope.campaign['filter'+filterID+'Selected'] = selList;
			//$scope.campaign['filterSelected'].push(selList);
			var auRule = $scope.masterDefEmailFilter; // set default
			if(auOpr.length > 0){
				auRule = "<Filter CriteriaJoinOperator=\"" + auOpr + "\">" + allRule + "</Filter>";
			}

			//$("#EMAIL1-FILTER").val(auRule);
			$scope.campaign['EMAIL'+filterID+'-FILTER'] = auRule;
			$scope.campaign['EMAIL'+filterID+'-FILTER-JOINOPERATOR'] = auOpr;
			$scope.campaign['EMAIL'+filterID+'-FILTER-CRITERIAROW'] = allRule;
			$("#LISTDEFINITION").val(auRule) ; 
			$scope.CheckSumAudience(filterID); 
    };


    /*$scope.ShowScheduleDateTime = function() {
        if (hasValue($scope.campaign)) {
            if (hasValue($scope.campaign['EMAIL1-SCHEDULE1-DATETIME'], "01/01/2050 08:00:00 AM")) {
                var a = moment($scope.campaign['EMAIL1-SCHEDULE1-DATETIME']);
                $scope.ScheduleDateTime = a.format('dddd MMMM DD, YYYY [at] h:mm:ss a');
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    };*/

	$scope.showFilter = function(filterID) {
		$scope.openFilter[filterID] = true;
		$("#addFilter"+filterID).hide();
	}

	$scope.disabledScheduleEmail = function (emailID) {
		return sentEmail['E'+emailID+'F1'] && sentEmail['E'+emailID+'F2'] && sentEmail['E'+emailID+'F3'];
	}

});
