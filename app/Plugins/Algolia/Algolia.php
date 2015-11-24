<?php

namespace App;

class Algolia extends Plugin 
{
	public $plugin = [
		'title' 		=> 'Algolia For Uniform',
		'description' 	=> 'Improve searching speed by using Algolia service',
		'version'		=> '1.0',
		'author'		=> 'Tan Nguyen <tan@binaty.org>'
	];

	public $model 	= 'Algolia';

	public $seeder 	= 'AlgoliaDBSeeder';

	public function __construct()
	{
		parent::__construct();
	}

	public function seed()
	{

	}

	public function activated()
	{
		$this->migrate()->seed();
	}

	public function deactivated()
	{
		$this->drop();
	}
}