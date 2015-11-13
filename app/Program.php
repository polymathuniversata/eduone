<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
	use CanUseCreator, CanUseMeta;
	
    protected $fillable = ['name', 'slug', 'periods_count', 'creator_id'];
    
    protected $casts = [
    	'periods_count'  => 'integer',
        'periods'        => 'array'
    ];

    public function students()
    {
    	return $this->belongsToMany('App\User', 'users_programs');
    }

    public function periods()
    {
        return $this->hasMany('App\Period');
    }

    public function subjects()
    {

    }

    public function classes()
    {
        return $this->hasMany('App\Classes');
    }
}