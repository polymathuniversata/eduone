var app = app || {};

app.controller('FamilyController', function($scope)
{
	$scope.members = [];

	$scope.role_id = [];

	$scope.init = function()
	{
		if (typeof window.members != 'undefined')
			$scope.members = window.members;
	};

	$scope.$watch('search', function()
	{
		var params = {
			search: $scope.search,
			role_id: $scope.role_id
		};

		$http.get('/users/search/', {
			params: params
		}).
		success(function(data, status, headers, config) {
	    	$scope.members = data;
	    	console.log($scope.members);
	  	}).
	  	error(function(data, status, headers, config) {
	    	//
		});
	});

	$scope.add = function()
	{

	};

	$scope.remove = function()
	{

	};
});