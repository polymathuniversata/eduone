<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
	use CanUseCreator;
	
    protected $fillable = [
    	'name', 'slug', 'student_count', 'program_id', 
    	'subject_id', 'branch_id', 'creator', 'started_at', 'finished_at'
    ];

    protected $casts = [
    	'student_count' => 'integer',
    	'program_id' 	=> 'integer',
    	'subject_id' 	=> 'integer',
    	'branch_id' 	=> 'integer',
    	'creator' 		=> 'integer'
    ];

    protected $dates = ['started_at', 'finished_at', 'created_at', 'updated_at'];

    public function students()
    {
    	$this->belongsToMany('App\User', 'users_classes');
    }

    public function program()
    {
    	$this->belongsTo('App\Program');
    }

    public function subject()
    {
    	$this->belongsTo('App\Subject');
    }

    public function branch()
    {
    	$this->belongsTo('App\Branch');
    }
}
