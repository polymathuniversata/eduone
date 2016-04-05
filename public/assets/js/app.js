var app = angular.module('App', ['ui.bootstrap', 'tg.dynamicDirective', 'ui.sortable']);

app.run(function($rootScope) 
{
	//
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

app.controller('MemberController', function($scope, $http)
{
	$scope.setRole = function(userId, roleId) {
		$http.put( APP_URL + 'classes', {
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

	$('#present-checkbox').click(function() {
		$(this).parents('table').find('input[type=checkbox]').prop('checked', this.checked);
	});

	// When click to cell. Checkbox in that cell is also clicked.
	$('.cell-label').click(function (e) {
		$(this).find('input[type=checkbox]').trigger('click');
	});

	$('.cell-label input[type=checkbox]').click(function(e) {
		// Stop bubble because of above effect.
		e.stopPropagation();
	});

	$('[data-toggle="offcanvas"]').click(function () {
	    $('.row-offcanvas').toggleClass('active')
	});

	$('.dropdown-menu').click(function(e) {
        e.stopPropagation();
    });
});