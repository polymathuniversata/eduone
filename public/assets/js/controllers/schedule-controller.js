app = app || {};

app.controller('ScheduleController', function($scope, $http)
{
	$scope.class_subjects = [];

	$scope.teachers = {};

	$scope.schedules = [];

	$scope.rooms = {};

	$scope.slots = {};

	$scope.classes = [];

	$scope.subjects = [];

	$scope.schedule = {};

	$scope.isLoading = false;

	$scope.current_date = null;

	$scope.init = function()
	{
		angular.forEach(['teachers', 'slots', 'rooms', 'schedules', 'classes', 'subjects', 'current_date'], function(object) {
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
		if ( ! $scope.isLoading 
			&& typeof $scope.schedule.class_id != 'undefined'
			&& typeof $scope.class_subjects[$scope.schedule.class_id] == 'undefined'
		) 
		{
			$scope.isLoading = true;
			
			$http.get('/classes/' + $scope.schedule.class_id + '/subjects').
				success(function(data, status, headers, config) {
			    	$scope.class_subjects[$scope.schedule.class_id] = data;
			  	}).
			  	error(function(data, status, headers, config) {
			    	//
			});

			$scope.isLoading = false;
		}
	};

	$scope.setSelectedTeacher = function() 
	{
		if (typeof $scope.class_subjects[$scope.schedule.class_id] != 'undefined')
			$scope.schedule.teacher_id = $scope.class_subjects[$scope.schedule.class_id][$scope.schedule.subject_id].teacher;
	};

	$scope.addGroup = function()
	{

		$scope.schedule.started_at = $scope.current_date;

		$http.post('/schedules', $scope.schedule)
			.success(function(data, status, headers, config) {
			//console.log(data);
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