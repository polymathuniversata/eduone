;(function($, angular) {

	var app = angular.module('App', ['ui.bootstrap', 'tg.dynamicDirective', 'ui.sortable']);

	app.config(['$httpProvider', function($httpProvider) {
	    $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
	}]);

	app.run(function($rootScope) 
	{
		$rootScope.uniqId = function() {
		  function s4() {
		    return Math.floor((1 + Math.random()) * 0x10000)
		      .toString(16)
		      .substring(1);
		  }
		  return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
		    s4() + '-' + s4() + s4() + s4();
		};
	});

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

	app.controller('ProgramController', function($scope, $http, $sce) {
		
		$scope.periods = [
			{
				name: 'Period 1',
				type: 'period',
				weight: 1
			}
		];

		/**
		 * Configs for ui-sortable
		 * @type {Object}
		 */
		$scope.sortableOptions = {
		    connectWith: ".sortable",
		    placeholder: "ui-state-highlight",
		};

		$scope.subjects = [];

		$scope.active = {};

		$scope.alreadyAddedSubject = [];

		$scope.init = function() {
			if (typeof window.subjects != 'undefined' && angular.isObject(window.subjects))
				$scope.subjects 	= window.subjects;
			
			if (typeof window.periods != 'undefined' && angular.isArray(window.periods))
				$scope.periods 			= window.periods;

			$scope.setAlreadyAddedSubject();
		};

		$scope.setActiveField = function (field) {
			$scope.active = field;
		};

		$scope.addSubject = function(id) {
			$scope.periods.push({
				id: id,
				type: 'subject'
			});

			$scope.alreadyAddedSubject.push(id);
		};

		$scope.addPeriod = function() {
			$scope.periods.push({
				name: 'Period',
				type: 'period',
				weight: 1
			});
		};

		$scope.removeItem = function($index) {
			var item = $scope.periods[$index];

			$scope.periods.splice($index, 1);
			
			if (item.type === 'subject') {
				var index = $scope.alreadyAddedSubject.indexOf(item.id);
				$scope.alreadyAddedSubject.splice(index, 1);	
			}
		};

		$scope.setAlreadyAddedSubject = function() {
			angular.forEach($scope.periods, function(period) {
				if (period.type === 'subject')
					$scope.alreadyAddedSubject.push(period.id + '');
			});
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

	app.controller('ClassController', function($scope, $http) {
		
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
		$scope.periods = null;
		$scope.subjects = [];
		$scope.selectedProgram = null;
		$scope.selectedPeriods = [];
		$scope.selectedSubjects = [];

		$scope.availablePrograms = {};
		$scope.thisClass = [];

		$scope.init = function() {
			$scope.thisClass = window.thisClass;
			$scope.availablePrograms = window.availablePrograms;
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

		$scope.showPeriods = function() {
			$http.get('/programs/periods/' + $scope.thisClass.program_id).
				success(function(data, status, headers, config) {
			    	$scope.periods = data;
			    	console.log($scope.periods);
			  	}).
			  	error(function(data, status, headers, config) {
			    	//
			});
		};

		$scope.showSubjects = function() {
			if ($scope.selectedPeriods.length == 1) {
				angular.forEach($scope.periods, function(period) {
					if (period.id === $scope.selectedPeriods[0]) {
						$scope.subjects = period.subjects;
						return;
					}
				});
			}
		};

		$scope.addSubject = function(a){
			console.log($scope.selectedSubjects);
		};

		$scope.removeStudent = function(student) {
			$scope.selectedStudents.splice($index, 1);
		};
	});

	app.controller('MemberController', function($scope, $http)
	{
		$scope.setRole = function(userId, roleId) {
			$http.put('/classes', {
				user_id: userId,
				role_id: roleId 
			}).success(function(data, status, headers, config) {
			    console.log(data);
			}).
			error(function(data, status, headers, config) {
			    	//
			});
		};
	});

	app.controller('UserController', function($scope, $http)
	{
		$scope.users = [];

		$scope.exists = [];

		$scope.search = '';

		$scope.queue = [];

		$scope.init = function() 
		{
			if (typeof window.exists != 'undefined')
				$scope.exists = window.exists;
		};

		$scope.$watch('search', function()
		{
			var params = {
				search: $scope.search
			};

			$http.get('/users/search/', {
				params: params
			}).
			success(function(data, status, headers, config) {
		    	$scope.users = data;
		    	console.log($scope.users);
		  	}).
		  	error(function(data, status, headers, config) {
		    	//
			});
		});

		$scope.addUser = function($index)
		{
			var isDuplicated = false;

			angular.forEach($scope.queue, function(user) {
				if (user.id === $scope.users[$index].id) {
					isDuplicated = true;
					return;
				}
			});

			if (isDuplicated)
				return;

			$scope.queue.push($scope.users[$index]);

			$scope.users.splice($index, 1);
		};

		$scope.removeQueueUser = function($index)
		{
			$scope.queue.splice($index, 1);
		};

	});

})(jQuery, angular);

$(function()
{

	$('.panel-checkbox').click (function () {
	  	$(this).parents('.panel').find('.panel-body input[type=checkbox]').prop('checked', this.checked);
	});

	$('.subject-teacher').change(function() {
		var checked = $(this).val() != '';
		
		$(this).parents('tr')
				.find('input[type=checkbox]')
				.prop('checked', checked);
		
	});

});
