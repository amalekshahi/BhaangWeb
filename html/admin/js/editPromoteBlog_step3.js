function showcalendar() {
	    $("#EMAIL1-SCHEDULE1-DATE").datepicker("show");
}

myApp.controller('step3', function($scope, $http) {
    //alert('step3');
    $scope.dateChange = function() {
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
    };
    $scope.Cancel = function() {
        //$scope.frmStep3.$setPristine();
        $scope.$parent.Cancel();
        //$scope.Reset(); // parent scope's Reset()
    };

    $scope.ArrangeFilter = function() {
        $scope.AuFilter = angular.copy($scope.masterAu);
        var auCnt = 0;
        var auOpr = "";
        var allRule = "";
        var selList = [];
        for (var i = 0; i < $scope.filterList.length; i++) {
            var indx = $scope.AuFilter.items.getIndexByValue('contactID', $scope.filterList[i]);
            selList.push($scope.filterList[i]);
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
            if (i < $scope.filterList.length - 1) auOpr += "|";
        } //end for i		
        //alert("selected = "+selList); 
        $scope.campaign['filterSelected'] = selList;
        //			$scope.campaign['filterSelected'].push(selList);
        var auRule = "<Filter CriteriaJoinOperator=\"" + auOpr + "\">" + allRule + "</Filter>";
        //$("#EMAIL1-FILTER").val(auRule);
        $scope.campaign['EMAIL1-FILTER'] = auRule;
        $scope.campaign['EMAIL-FILTER-JOINOPERATOR'] = auOpr;
        $scope.campaign['EMAIL-FILTER-CRITERIAROW'] = allRule;
        //alert( "val = " + $("#EMAIL1-FILTER").val() ); 					
    };


    $scope.ShowScheduleDateTime = function() {
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
    };

    

});