var app = app || {};

app.controller('FamilyController', function($scope, $http)
{
	$scope.users = [];

	$scope.exists = [];

	$scope.search = '';

	$scope.queue = [];

	$scope.isLoading = false;

	$scope.init = function() 
	{
		if (typeof window.exists != 'undefined')
			$scope.exists = window.exists;
	};

	$scope.$watch('search', function()
	{
		var params = {
			search: $scope.search,

		};

		if ( ! $scope.isLoading) {

			$scope.isLoading = true;

			$http.get( APP_URL + 'users/search/', {
				params: params
			}).
			success(function(data, status, headers, config) {
		    	$scope.users = data;
		  	}).
		  	error(function(data, status, headers, config) {
		    	//
			});

			$scope.isLoading = false;
	  	}
	});

	$scope.addUser = function($index)
	{
		var isDuplicated = false;

		angular.forEach($scope.queue, function(user) {
			if (user.id === $scope.users[$index].id) {
				isDuplicated = true;
				return false;
			}
		});

		if (isDuplicated)
			return false;

		$scope.queue.push($scope.users[$index]);

		$scope.users.splice($index, 1);
	};

	$scope.removeQueueUser = function($index)
	{
		$scope.queue.splice($index, 1);
	};

});