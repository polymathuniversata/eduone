<?php

return [
	[
		'icon' 	=> 'typcn typcn-chart-line-outline',
		'title' => 'Dashboard',
		'url'	=> '/',
	],
	[
		'icon' => 'typcn typcn-tree',
		'title' => 'Classes',
		'url'	=> 'classes',
		'childs' => [
			'classes' 			=> 'All Classes',
			'classes/create' 	=> 'Add New Class'
		]
	],
	[
		'icon' => 'typcn typcn-tree',
		'title' => 'Grades',
		'url'	=> 'grades'
	],
	[
		'icon' => 'typcn typcn-mortar-board',
		'title' => 'Students',
		'url'	=> 'users?role_id=4',
		'childs' => [
			'users?role_id=4' 			=> 'All Students',
			'users/create?role_id=4' 	=> 'Add New Student',
			'users/import' 		=> 'Import'
		]
	],

	[
		'icon' => 'typcn typcn-user-outline',
		'title' => 'Teachers',
		'url'	=> 'users/?role_id=3',
		'childs' => [
			'users/?role_id=3' 			=> 'All Teachers',
			'teachers/create/?role_id=3' => 'Add New Teacher',
		]
	],

	[
		'icon' => 'typcn typcn-user-outline',
		'title' => 'Parents',
		'url'	=> 'users?role_id=5',
		'childs' => [
			'users?role_id=5' 				=> 'Parents',
			'users/create?role_id=5' => 'Add New Parent',
		]
	],

	[
		'icon' => 'typcn typcn-compass',
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
		'icon' => 'typcn typcn-calendar-outline',
		'title' => 'Schedules',
		'url'	=> 'schedules',
		'childs' => [
			'schedules/import'	=> 'Import Schedules',
		]
	],

	[
		'icon' => 'typcn typcn-group-outline',
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
		'icon' => 'typcn typcn-point-of-interest-outline',
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
		'icon' => 'typcn typcn-image-outline',
		'title' => 'Media',
		'url'	=> 'media'
	],

	[
		'icon' => 'typcn typcn-spanner-outline',
		'title' => 'Settings',
		'url'	=> 'settings',
		'childs' => [
			'settings' 			=> 'General',
			'settings/grades' 	=> 'Grades',
			'settings/themes' 	=> 'Themes',
		]
	],
];