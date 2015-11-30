app = app || {};

app.controller('ScheduleController', function($scope, $http)
{
	$scope.classSubjects = [];

	$scope.teachers = {};

	$scope.schedules = [];

	$scope.rooms = {};

	$scope.slots = {};

	$scope.classes = [];

	$scope.subjects = [];

	$scope.schedule = {};

	$scope.isLoading = false;

	$scope.init = function()
	{
		angular.forEach(['teachers', 'slots', 'rooms', 'schedules', 'classes', 'subjects'], function(object) {
			if (typeof window[object] != 'undefined')
				$scope[object] = window[object];
		});
	};

	$scope.setSchedule = function(schedule, slot_id, room_id)
	{
		$scope.schedule 			= schedule;
		$scope.schedule.slot_id 	= slot_id;
		$scope.schedule.room_id 	= room_id; 
	};
	
	$scope.getSubjects = function() 
	{
		if ( ! $scope.isLoading) {
			$scope.isLoading = true;
			
			$http.get('/classes/' + $scope.schedule.class_id + '/subjects').
				success(function(data, status, headers, config) {
			    	$scope.classSubjects = data;
			  	}).
			  	error(function(data, status, headers, config) {
			    	//
			});

			$scope.isLoading = false;
		}
	};

	$scope.setSelectedTeacher = function() {
		
		$scope.schedule.teacher_id = $scope.classSubjects[$scope.schedule.subject_id].teacher + '';
	};

	$scope.addGroup = function()
	{
		$http.post('/schedules', $scope.schedule)
			.success(function(data, status, headers, config) {
			// console.log(data);
		});

		jQuery('#myModal').modal('hide');
	};

	$scope.removeGroup = function()
	{
		$scope.group = {};
	};

	$scope.cancel = function()
	{
		$scope.schedule = {};
	};
});