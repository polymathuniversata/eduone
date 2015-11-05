<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subject;

class Classes extends Model
{
	use CanUseCreator, CanUseMeta;
	
    protected $fillable = [
    	'name', 'slug', 'student_count', 'program_id', 
    	'subjects_id', 'periods_id', 'branch_id', 'creator', 'started_at', 'finished_at'
    ];

    protected $casts = [
    	'student_count' => 'integer',
    	'program_id' 	=> 'integer',
    	'subjects_id' 	=> 'array',
        'periods_id'    => 'array',
    	'branch_id' 	=> 'integer',
    	'creator' 		=> 'integer'
    ];

    protected $dates = ['started_at', 'finished_at', 'created_at', 'updated_at'];

    public function students()
    {
    	return $this->belongsToMany('App\User', 'users_classes');
    }

    public function program()
    {
    	return $this->belongsTo('App\Program');
    }

    public function branch()
    {
    	return $this->belongsTo('App\Branch');
    }

    public function getSubjectsId()
    {
        if ( ! empty($this->subjects_id))
            return (array) $this->subjects_id;
    }

    public function getSubjects()
    {
        $subjects_id = $this->getSubjectsId();
        
        if (is_null($subjects_id))
            return;

        return Subject::where('id', 'in', $subjects_id)
                        ->lists('name', 'id')->get();
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

    /**
     * Add student to class
     * 
     * @param array/mixed $params One or List of student
     */
    public function addStudent($params = [])
    {

    }

    /**
     * Remove a student or list of students from class
     * 
     * @param array/mixed $params One or List of student
     */
    public function removeStudent($params = [])
    {

    }

    public function existsStudent($params){

    }

    /**
     * Add teacher to class
     */
    public function addTeacher()
    {

    }

    public function removeTeacher()
    {

    }

    public function existsTeacher()
    {

    }
}
