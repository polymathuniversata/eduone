<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subject;

class Classes extends Group
{
	use CanUseCreator, CanUseMeta;

	public static function boot()
    {
        static::addGlobalScope(new ClassScope);
    }
}