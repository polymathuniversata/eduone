<?php

namespace App;

class Teacher extends User
{
    public static function boot()
    {
    	static::addGlobalScope(new TeacherScope);
    }

    public function branches()
    {
        return $this->belongsToMany('App\Branch', 'users_branches', 'user_id', 'id');
    }

}