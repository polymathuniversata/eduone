<?php

namespace App\Plugins\HappyBirthday;

class HappyBirthday
{
	public function __construct()
	{
		$this->publishAsset();

		$this->createMenuPage([

		]);

		$this->createPage();
	}

	public static function make()
	{
		return 'foo';
	}
}