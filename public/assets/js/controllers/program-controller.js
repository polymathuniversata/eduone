var app = app || {};

app.controller('ProgramController', function($scope) {
	
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
	    start: function(e, ui) {
	    	if (ui.item.hasClass('subject'))
	    		ui.placeholder.attr('placeholder-subject', 1);
	    }
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