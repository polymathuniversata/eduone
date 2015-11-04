<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
	use CanUseCreator, CanUseMeta;
	
    protected $fillable = ['name', 'slug', 'periods_count', 'periods', 'builder_json', 'creator_id', 'branches'];
    
    protected $casts = [
    	'periods_count'  => 'integer',
        'periods'        => 'array',
        'builder_json'   => 'array'
    ];

    public function students()
    {
    	return $this->belongsToMany('App\User', 'users_programs');
    }

    public function getSubjectFromPeriod($arg = '')
    {
        $periods = $this->periods;
        $all_subjects = [];

        foreach ($periods as $index => $period ) {
            if ((is_integer($arg) && $index === $arg) || ! empty($arg) && $period['name'] === $arg)
                return $period['subjects'];

            $all_subjects = array_merge($all_subjects, $period['subjects']);
        }

        return $all_subjects;
    }

    public function subjects()
    {

    }

    public function classes()
    {
        return $this->hasMany('App\Classes');
    }

    public function allSubject()
    {

    }
}