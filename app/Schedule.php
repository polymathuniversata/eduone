<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['branch_id', 'room_id', 'class_id', 'subject_id', 
    						'teacher_id', 'session_id', 'event_id', 'slot_id', 'started_at', 'finished_at', 
    						'attendance_detail', 'creator_id'];

    protected $casts = [
    	'attendance_detail' => 'array'
    ];

}
