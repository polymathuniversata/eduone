<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
	use CanUseCreator, CanUseMeta;
	
    protected $fillable = ['name', 'slug', 'grade_type', 'periods', 'creator_id', 'branches'];
    
    protected $casts = [
    	'periods' => 'integer'
    ];

    public function subjects()
    {
        return $this->belongsToMany('App\Subject', 'programs_subjects');
    }

    public function students()
    {
    	return $this->belongsToMany('App\User', 'users_programs');
    }
}