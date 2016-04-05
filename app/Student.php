<?php

namespace App;

class Student extends User
{
    public static function boot()
    {
    	static::addGlobalScope(new StudentScope);
    }

    public function branches()
    {
        return $this->belongsToMany('App\Branch', 'users_branches', 'user_id', 'id');
    }
}