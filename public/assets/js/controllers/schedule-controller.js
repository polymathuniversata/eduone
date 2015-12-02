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
		// if ( typeof $scope.schedule != 'undefined'
		// 	&& $scope.schedule.class_id != schedule.class_id 
		// 	&& $scope.schedule.subject_id != schedule.subject_id
		// 	&& typeof $scope.class_subjects != 'undefined'
		// 	&& typeof $scope.class_subjects[$scope.schedule.class_id] != 'undefined'
		// 	&& typeof $scope.class_subjects[$scope.schedule.class_id][$scope.schedule.subject_id] != 'undefined') {
			
		// 	$scope.class_subjects[$scope.schedule.class_id][$scope.schedule.subject_id].completed--;
		// }

		$scope.schedule 			= schedule;
		$scope.schedule.slot_id 	= slot_id;
		$scope.schedule.room_id 	= room_id;

		// if ( typeof $scope.class_subjects != 'undefined'
		// 	&& typeof $scope.class_subjects[$scope.schedule.class_id] != 'undefined'
		// 	&& typeof $scope.class_subjects[$scope.schedule.class_id][$scope.schedule.subject_id] != 'undefined') {

		// 	$scope.class_subjects[$scope.schedule.class_id][$scope.schedule.subject_id].completed++;
		// }
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

		console.log($scope.schedule);

		$http.post('/schedules', $scope.schedule)
			.success(function(data, status, headers, config) {
			console.log(data);
			$scope.schedule.id = data.id;

			$scope.schedules[$scope.schedule.room_id][$scope.schedule.slot_id].id = data.id
			

			$scope.class_subjects[$scope.schedule.class_id][$scope.schedule.subject_id].completed++;
			

			// Todo completed-- when new class is override
		});

		jQuery('#myModal').modal('hide');
	};

	$scope.getCompletedPercent = function()
	{
		if (typeof $scope.schedule.subject_id == 'undefined' || typeof $scope.schedule.class_id == 'undefined')
			return;

		var subjectId = $scope.schedule.subject_id,
			classId   = $scope.schedule.class_id;

		if (typeof $scope.class_subjects[classId] == 'undefined')
			return;

		var sessionsCount = $scope.subjects[subjectId].sessions_count;

		var alreadyScheduled = $scope.class_subjects[classId][subjectId].completed;

		return Math.round(alreadyScheduled / sessionsCount * 100);
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