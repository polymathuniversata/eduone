var app = app || {};

app.controller('SubjectController', function($scope, $http, $sce) 
{
	$scope.grades = [];
	$scope.sessions = [];

	$scope.init = function() {
		if (typeof window.grades != 'undefined' && angular.isArray(window.grades))
			$scope.grades 	= window.grades;

		if (typeof window.sessions != 'undefined' && angular.isArray(window.sessions))
			$scope.sessions = window.sessions;
	};
	
	$scope.addGrade = function() {
		$scope.grades.push({
			name: '',
			percent: 0,
			minimum: 0
		});
	}

	$scope.removeGrade = function($index) {
		$scope.grades.splice($index, 1);
	};

	$scope.addSession = function() {
		$scope.sessions.push({
			name: '',
			type: '',
			description: ''
		});
	};

	$scope.removeSession = function($index) {
		$scope.sessions.splice($index, 1);
	};
});