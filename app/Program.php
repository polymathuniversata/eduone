<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
	use CanUseCreator, CanUseMeta;
	
    protected $fillable = ['name', 'slug', 'periods_count', 'periods', 'builder_json', 'creator_id', 'branches'];
    
    protected $casts = [
    	'periods_count'  => 'integer',
        'periods'        => 'array'
    ];

    public function students()
    {
    	return $this->belongsToMany('App\User', 'users_programs');
    }

    public function getPeriods()
    {
        $periods = [];

        $all_periods = json_decode($this->periods, true);
        
        foreach ($all_periods as $item) {
            if ($item['type'] === 'period') {
                $periods[$item['id']] = [
                    'id'   => $item['id'],
                    'name' => $item['name']
                ];
                $period_id = $item['id'];
            }

            if ($item['type'] === 'subject')
                $periods[$period_id]['subjects'][] = intval($item['id']);
        }
        
        return $periods;
    }

    public function getSubjectFromPeriod($arg = '')
    {
        $periods = $this->getPeriods();

        $all_subjects = [];

        foreach ($periods as $id => $period ) {
            if ($arg === $id)
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