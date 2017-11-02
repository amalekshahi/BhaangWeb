
var accID = "17124" ; 

/*
var Tutorials = angular.module('Tutorials', ['davinci', 'localytics.directives', "ngFileUpload"]);
Tutorials.controller('getAnswers', ['$scope', '$http', 'Upload', function($scope, $http, Upload) {
*/ 
var Tutorials = angular.module('Tutorials', ['davinci', 'localytics.directives', "ngFileUpload"]);
Tutorials.controller('getAnswers', ['$scope', '$http', 'Upload', function($scope, $http, Upload) {

	$scope.sections = sections;
	$scope.loadFromParent = function (tut) {
	      alert('parent index = ' + tut);
	};

	$scope.GetChildrenFolder = function(){				
			$http.get("getChildS3.php?initAccID=" + accID).then(function(response){
						if(response.data.success){							
							$scope.sections = response.data.sections; 
						}else{
							$scope.sections = []; 
						}	
			});			

	}; //GetChildrenFolder
	
	//$scope.GetChildrenFolder(); 

}]);// end 



var sections = [{
    name: "Images",
    tutorials: [{
        active: "inactive",
        name: "aaa"
    },{
        active: "inactive",
        name: "bbb"
    },{
        active: "inactive",
        name: "ccc"
    },{
        active: "inactive",
        name: "Harder Words"
    }]
},{
	name: "Videos",
	tutorials: []
}, {
	name: "Audio",
	tutorials: [{
		active: "inactive",
		name: "Particles"
	}, {
		active: "inactive",
		name: "Word Order"
	}]
}];