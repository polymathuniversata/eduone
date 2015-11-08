<?php

return [
	[
		'icon' 	=> 'fa fa-bar-chart',
		'title' => 'Overview',
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
		'url'	=> 'students',
		'childs' => [
			'students' 			=> 'All Students',
			'students/create' 	=> 'Add New Student',
			'users/import' 		=> 'Import'
		]
	],

	[
		'icon' => 'fa fa-user',
		'title' => 'Teachers',
		'url'	=> 'teachers',
		'childs' => [
			'teachers' 			=> 'All Teachers',
			'teachers/create' 	=> 'Add New Teacher',
			'users/import' 		=> 'Import'
		]
	],

	[
		'icon' => 'fa fa-user',
		'title' => 'Parents',
		'url'	=> 'parents',
		'childs' => [
			'parents' 			=> 'Parents',
			'parents/create' 	=> 'Add New Parent',
			'users/import' 		=> 'Import'
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