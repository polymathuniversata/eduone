<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use CanUseCreator, CanUseMeta;
	
    protected $fillable = [
    	'name', 'slug', 'student_count', 'program_id', 
    	'branch_id', 'creator', 'started_at', 'finished_at'
    ];

    protected $casts = [
    	'student_count' => 'integer',
    	'program_id' 	=> 'integer',
    	'branch_id' 	=> 'integer',
    	'creator_id' 	=> 'integer'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function members()
    {
    	return $this->belongsToMany('App\User', 'users_groups', 'user_id', 'group_id');
    }

    public function program()
    {
    	return $this->belongsTo('App\Program');
    }

    public function branch()
    {
    	return $this->belongsTo('App\Branch');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Subject', 'classes_subjects', 'class_id', 'subject_id')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }

    public function scopeOfType($query, $value)
    {
    	return $query->whereType($value);
    }

    public function scopeOfProgram($query, $value)
    {
        if (intval($value) > 0)
            return $query->whereProgramId($value);

        return $query;
    }

    public function scopeSearch($query, $value)
    {
        if ( ! empty($value))
            return ! empty($value) ? $query->where('name', 'like', "%$value%") : $query;
    }
    
    public function scopeOfSubject($query, $value)
    {
        if ( ! empty($value))
            return $query->where('subjects_id', 'like', "%$value%");

        return $query;
    }
}
