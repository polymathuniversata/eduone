<?php

namespace App\Plugins;

class Plugin
{
	public $plugins;

	public function __construct()
	{
		$this->scan();
	}

	public function scan()
	{
		$this->plugins = ['Algolia', 'HappyBirthday'];

		return $this;
	}
}