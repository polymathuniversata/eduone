<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
	use BranchTrait;

    protected $fillable = ['branch_id', 'room_id', 'class_id', 'subject_id', 
    						'teacher_id', 'session_id', 'event_id', 'slot_id', 'started_at', 'finished_at', 
    						'attendance_detail', 'creator_id'];

    protected $dates = ['started_at', 'finished_at', 'created_at', 'updated_at'];

    protected $casts = [
    	'attendance_detail' => 'array'
    ];

    public static function findByUnique($date, $room_id, $slot_id, $branch_id = 1)
    {
    	return self::ofBranch($branch_id)
    				->whereRoomId($room_id)
    				->whereDate('started_at', '=', $date)
    				->whereSlotId($slot_id)
    				->first();
    }
}