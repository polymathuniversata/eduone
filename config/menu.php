<?php

return [
	[
		'icon' 	=> '',
		'title' => 'Overview',
		'url'	=> '/',
	],
	[
		'icon' => '',
		'title' => 'Classes',
		'url'	=> 'classes',
		'childs' => [
			'all_classes' => [
				'title' => 'All Classes',
				'url'	=> 'classes'
			],
			'add_new_class' => [
				'title' => 'Add New Class',
				'url'	=> 'classes/create'
			]
		]
	],
];