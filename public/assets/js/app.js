;(function($, angular) {

	var app = angular.module('App', ['ui.bootstrap']);

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

	app.controller('MetaController', function($scope) {
		
		$scope.meta 	= [];
		$scope.object 	= '';
		$scope.object_id = 0;

		$scope.init = function() {
			$scope.meta = window.meta;
			$scope.object = window.object;
			$scope.object_id = window.object_id;
		};

		$scope.addMeta = function() {
			$scope.meta.push({
				key: '',
				value: ''
			});
		};

		$scope.removeMeta = function($index) {
			$scope.meta.splice($index, 1);
		};
	});

	app.controller('ClassController', function($scope) {
		
		$scope.students = [
			{
				id: 1,
				name: 'Tan Nguyen',
				photo: '0/01/Flag_of_California.svg/45px-Flag_of_California.svg.png'
			},
			{
				id: 2,
				name: 'Anh Tran',
				photo: 'e/ef/Flag_of_Hawaii.svg/46px-Flag_of_Hawaii.svg.png'
			}
		];

		$scope.selectedStudents = [];

		$scope.init = function() {
			//$scope.students = window.students;
			//$scope.selected = window.selected;
		};

		$scope.addStudent = function($item, $model, $label) {
			$scope.selectedStudents.push($item);

			var students = [];
			
			angular.forEach($scope.students, function(student) {
				if (student.id !== $item.id)
					students.push(student);
			});

			$scope.students = students;
			$scope.selected = [];
		};

		$scope.removeStudent = function(student) {
			$scope.selectedStudents.splice($index, 1);
		};
	});

})(jQuery, angular);