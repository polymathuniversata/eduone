var app = app || {};

app.controller('UserController', function($scope, $http)
{
	$scope.users = [];

	$scope.exists = [];

	$scope.search = '';

	$scope.queue = [];

	$scope.isLoading = false;

	$scope.role_id = null;

	$scope.group_id = null;

	$scope.init = function() 
	{
		if (typeof window.exists != 'undefined')
			$scope.exists = window.exists;

		if (typeof window.role_id != 'undefined')
			$scope.role_id = window.role_id;

		if (typeof window.group_id != 'undefined')
			$scope.group_id = window.group_id;
	};

	$scope.$watch('search', function()
	{
		if ( ! $scope.isLoading) {

			$scope.isLoading = true;

			var params = {
				search: $scope.search,
				role_id: $scope.role_id,
			};

			if ( typeof $scope.group_id != 'undefined')
				params.not_in_group = $scope.group_id;
			
			$http.get(APP_URL + 'users/search/', {
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