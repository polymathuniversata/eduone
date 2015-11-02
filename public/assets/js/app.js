;(function($, angular) {

	var app = angular.module('App', []);

	app.controller('SubjectController', function($scope, $http, $sce) {
		
		$scope.grades = [];
		$scope.sessions = [];

		$scope.init = function() {
			$scope.grades 	= window.grades || $scope.grades;
			$scope.sessions = window.sessions || $scope.sessions;
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

		// Push to hidden fields when Form submitted
	});

})(jQuery, angular);