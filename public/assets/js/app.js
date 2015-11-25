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


$(function()
{

	$('.panel-checkbox').click (function () {
	  	$(this).parents('.panel')
	  			.find('.panel-body input[type=checkbox]')
	  			.prop('checked', this.checked);
	});

	$('.subject-teacher').change(function() {
		var checked = $(this).val() != '';
		
		$(this).parents('tr')
				.find('input[type=checkbox]')
				.prop('checked', checked);
		
	});

});
