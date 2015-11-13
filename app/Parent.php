<?php

namespace App;

class Parent extends User
{
    public static function boot()
    {
    	static::addGlobalScope(new ParentScope);
    }

    public function branches()
    {
        return $this->belongsToMany('App\Branch', 'users_branches', 'user_id', 'id');
    }
}