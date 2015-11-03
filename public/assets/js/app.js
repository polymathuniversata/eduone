;(function($, angular) {

	var app = angular.module('App', []);

	app.controller('SubjectController', function($scope, $http, $sce) {
		
		$scope.grades = [];
		$scope.sessions = [];

		$scope.init = function() {
			$scope.grades 	= window.grades;
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

	app.controller('ProgramController', function($scope, $http, $sce) {
		
		$scope.cached_json = [
			{
				name: 'Period 1',
				type: 'period',
				weight: 1
			}
		];

		$scope.availableSubjects = [];

		$scope.init = function() {
			$scope.availableSubjects = window.subjects;
			console.log(window.subjects);
		};

		$scope.addSubject = function(id) {
			$scope.cached_json.push({
				id: id,
				name: $scope.availableSubjects[id] 
			});

			delete $scope.availableSubjects[id];
		};

		$scope.addPeriod = function() {
			$scope.cached_json.push({
				name: 'Period',
				type: 'period',
				weight: 1
			});
		};

		$scope.removeItem = function($index) {
			$scope.cached_json.splice($index, 1);
		};
	});

})(jQuery, angular);