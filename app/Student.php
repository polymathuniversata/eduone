<?php

namespace App;

class Student extends User
{
    public static function boot()
    {
    	static::addGlobalScope(new StudentScope);
    }
}