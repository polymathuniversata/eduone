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
    	'sessions_plan', 'grades_plan', 
    	'creator_id', 'is_required', 'created_at', 'updated_at'
    ];

    protected $casts = [
    	'grades_count' 			=> 'integer',
    	'sessions_count' 		=> 'integer',
    	'total_grade_rate' 		=> 'integer',
    	'minimum_student_grade' => 'integer',
    	'minimum_student_present_session' => 'integer',
    	'creator_id' 			=> 'integer',
        'is_required'           => 'boolean',
        'grades_plan'           => 'array',
        'sessions_plan'         => 'array'
    ];

    public function program()
    {
        return $this->belongsToMany('App\Program', 'periods_subjects', 'program_id', 'period_id');
    }

    public function periods()
    {
        return $this->belongsToMany('App\Period', 'periods_subjects')
                    ->withPivot('ordr', 'program_id')
                    ->withTimestamps();
    }

    public function classes()
    {
        return $this->belongsToMany('App\Group', 'classes_subjects', 'subject_id', 'class_id')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }

    public function getSessionsCountAttribute($value)
    {
        return isset($value) ? $value : 0;
    }

    public function getGradesCountAttribute($value)
    {
        return isset($value) ? $value : 0;
    }

    public function scopeSearch($query, $value)
    {
        if ( ! empty($value)) {
            $value = "%$value%";

            return $query->where('name', 'like', $value);
        }

        return $query;
    }

    public function scopeOfProgram($query, $value)
    {
        if (intval($value) > 0)
            return $query->whereProgramId($value);
        
        return $query;
    }
}
