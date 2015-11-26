app = app || {};

app.controller('ScheduleController', function($scope, $http)
{
	$scope.group = {};

	$scope.subjects = [];

	$scope.teachers = [];

	$scope.init = function()
	{
		if (typeof window.teachers != 'undefined')
			$scope.teachers = window.teachers;
	};
	
	$scope.getSubjects = function() {
		$http.get('/classes/' + $scope.group.id + '/subjects').
			success(function(data, status, headers, config) {
		    	$scope.subjects = data;
		  	}).
		  	error(function(data, status, headers, config) {
		    	//
		});
	};

	$scope.setSelectedTeacher = function() {
		$scope.group.teacher = $scope.subjects[$scope.group.subject].teacher + '';
	};

	$scope.addGroup = function(group)
	{

	};

	$scope.removeGroup = function(group)
	{

	};
});