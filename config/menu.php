<?php

return [
	[
		'icon' 	=> 'fa fa-bar-chart',
		'title' => 'Dashboard',
		'url'	=> '/',
	],
	[
		'icon' => 'fa fa-tree',
		'title' => 'Classes',
		'url'	=> 'classes',
		'childs' => [
			'classes' 			=> 'All Classes',
			'classes/create' 	=> 'Add New Class'
		]
	],
	[
		'icon' => 'fa fa-user',
		'title' => 'Students',
		'url'	=> 'users?role=4',
		'childs' => [
			'users?role=4' 			=> 'All Students',
			'users/create?role_id=4' 	=> 'Add New Student',
			'users/import' 		=> 'Import'
		]
	],

	[
		'icon' => 'glyphicon glyphicon-user',
		'title' => 'Teachers',
		'url'	=> 'users/?role=3',
		'childs' => [
			'users/?role=3' 			=> 'All Teachers',
			'teachers/create/?role_id=3' => 'Add New Teacher',
		]
	],

	[
		'icon' => 'glyphicon glyphicon-user',
		'title' => 'Parents',
		'url'	=> 'users?role=5',
		'childs' => [
			'users?role=5' 				=> 'Parents',
			'users/create?role_id=5' => 'Add New Parent',
		]
	],

	[
		'icon' => 'fa fa-cubes',
		'title' => 'Programs',
		'url'	=> 'programs',
		'childs' => [
			'programs' 			=> 'All Programs',
			'programs/create' 	=> 'Add New Program',
			'subjects'			=> 'All Subjects',
			'subjects/create' 	=> 'Add New Subject'
		]
	],

	[
		'icon' => 'fa fa-table',
		'title' => 'Class Routines',
		'url'	=> 'routines',
		'childs' => [
			'routines' 			=> 'Manage Routines',
			'routines/create' 	=> 'Add New Routine',
			'routines/import'	=> 'Import Routine',
		]
	],

	[
		'icon' => 'fa fa-users',
		'title' => 'Users',
		'url'	=> 'users',
		'childs' => [
			'users' 			=> 'All Users',
			'users/create' 		=> 'Add New',
			'users/import'		=> 'Import',
			'groups'			=> 'Groups',
			'roles'				=> 'Roles & Permissions',
		]
	],

	[
		'icon' => 'fa fa-university',
		'title' => 'Branches & Assets',
		'url'	=> 'branches',
		'childs' => [
			'branches' 			=> 'All Branches',
			'branches/create' 	=> 'Add New',
			'rooms'				=> 'Rooms',
			'rooms/create'		=> 'Add New Room'
		]
	],

	[
		'icon' => 'fa fa-picture-o',
		'title' => 'Media',
		'url'	=> 'media'
	],

	[
		'icon' => 'fa fa-sliders',
		'title' => 'Settings',
		'url'	=> 'settings',
		'childs' => [
			'settings' 			=> 'General',
			'settings/academic' => 'Academic',
			'settings/themes' 	=> 'Themes',
		]
	],
];