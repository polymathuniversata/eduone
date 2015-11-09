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
    	'creator_id' 			=> 'integer'
    ];

    public function program()
    {
        return $this->belongsToMany('App\Program', 'programs_subjects');
    }

    public function periods()
    {
        return $this->belongsToMany('App\Period', 'periods_subjects')
                    ->withPivot('ordr', 'program_id')
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
