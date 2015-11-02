<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CanUseCreator;

class Subject extends Model
{
    use CanUseCreator, CanUseMeta;

    protected $fillable = [
    	'name', 'slug', 'grades_count', 'sessions_count', 'total_grade_rate', 
    	'minimum_student_present_session', 'minimum_student_grade', 
    	'grade_type', 'equal_to', 'sessions_plan', 'grades_plan', 
    	'creator_id', 'created_at', 'updated_at'
    ];

    protected $casts = [
    	'grades_count' 			=> 'integer',
    	'sessions_count' 		=> 'integer',
    	'total_grade_rate' 		=> 'integer',
    	'minimum_student_grade' => 'integer',
    	'minimum_student_present_session' => 'integer',
    	'equal_to'				=> 'integer',
    	'sessions_plan' 		=> 'array',
    	'grades_plan' 			=> 'array',
    	'creator_id' 			=> 'integer'
    ];

    public function program()
    {
        return $this->belongsToMany('App\Program', 'programs_subjects');
    }

    public function getSessionsCountAttribute($value)
    {
        return isset($value) ? $value : 0;
    }

    public function getGradesCountAttribute($value)
    {
        return isset($value) ? $value : 0;
    }
}
