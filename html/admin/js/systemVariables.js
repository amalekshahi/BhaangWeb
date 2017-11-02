var systemVariables = angular.module('systemVariables', []);

systemVariables.controller('variables', function($scope) {
	$scope.text = "Dave";
  //$scope.variables = ["Images","HTML Emails","HTML Pages", "eBooks"];
  $scope.tags = ["Prospect content", "Client content", "Internal stuff", "Mac-only"];  
  $scope.variables = [
    {
        FieldName: "firstname",
        Description:  "First Name",			
        Type: "string",
        Length: "50",
        PURL_Position: "first",
        De_dupe_Group: "No",
        Required:  "Yes",
        RegEx:  "",
        Encrypted:  "No",			
		},
    {
        FieldName: "lasttname",
        Description:  "Last Name",			
        Type: "string",
        Length: "50",
        PURL_Position: "second",
        De_dupe_Group: "No",
        Required:  "Yes",
        RegEx:  "",
        Encrypted:  "No",			
		},
  ];
});