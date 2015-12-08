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

	$scope.oldSchedule = {};

	$scope.init = function()
	{
		angular.forEach(['teachers', 'slots', 'rooms', 'schedules', 'classes', 'subjects', 'current_date'], function(object) {
			if (typeof window[object] != 'undefined')
				$scope[object] = window[object];
		});
	};

	$scope.setSchedule = function(schedule, slot_id, room_id)
	{
		$scope.oldSchedule 			= angular.copy(schedule);

		$scope.schedule 			= schedule;
		$scope.schedule.slot_id 	= slot_id;
		$scope.schedule.room_id 	= room_id;
	};
	
	$scope.getSubjects = function() 
	{
		if ( ! $scope.isLoading 
			&& typeof $scope.schedule.class_id != 'undefined'
			//&& typeof $scope.class_subjects[$scope.schedule.class_id] == 'undefined'
		) 
		{
			$scope.isLoading = true;
			
			$http.get(window.APP_URL + 'classes/' + $scope.schedule.class_id + '/subjects').
				then(function(response) {
			    	$scope.class_subjects[$scope.schedule.class_id] = response.data;
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

		$http.post(window.APP_URL + '/schedules', $scope.schedule)
			.then(function(response) {
			
			if (response.data === 'conflict') {
				return alert('Error. This class is already scheduled in same slot!');
			}

			$scope.schedule.id = response.data.id;

			$scope.schedules[$scope.schedule.room_id][$scope.schedule.slot_id].id = response.data.id
			
			// $scope.class_subjects[$scope.schedule.class_id][$scope.schedule.subject_id].completed++;
			
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

		return Math.round((alreadyScheduled+1) / sessionsCount * 100);
	};

	/**
	 * Just remove Group from Schedule. Do not persist data
	 * 
	 * @return void
	 */
	$scope.removeGroup = function()
	{
		$scope.schedules[$scope.schedule.room_id][$scope.schedule.slot_id] = {};
		$scope.schedule = {};
	};

	/**
	 * Remove Group from Schedule and persist data
	 * 
	 * @return void
	 */
	$scope.deleteGroup = function()
	{
		$http.delete(window.APP_URL + 'schedules/' + $scope.schedule.id)
			.then(function(response) {
			
			if (response.data === 'success')
				$scope.removeGroup();
		});

		jQuery('#myModal').modal('hide');
	};

	$scope.cancel = function()
	{
		if (typeof $scope.schedule.room_id != 'undefined' && typeof $scope.schedule.slot_id != 'undefined')
			$scope.schedules[$scope.schedule.room_id][$scope.schedule.slot_id] = $scope.oldSchedule;
	};
});