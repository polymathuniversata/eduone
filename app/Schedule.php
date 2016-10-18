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

    /**
     * Todo: Change this method to getConflictedSlot()
     * @param $date
     * @param $room_id
     * @param $slot_id
     * @param int $branch_id
     * @return mixed
     */
    public static function findByUnique($date, $room_id, $slot_id, $branch_id = 1)
    {
    	return self::ofBranch($branch_id)
    				->whereRoomId($room_id)
    				->whereDate('started_at', '=', $date)
    				->whereSlotId($slot_id)
    				->first();
    }

    /**
     * Todo: Change this method to isConflictedSlot()
     * @param $class_id
     * @param $date
     * @param $slot_id
     * @param int $branch_id
     * @return mixed
     */
    public static function isClassConflict($class_id, $date, $slot_id, $branch_id = 1)
    {
        return self::ofBranch($branch_id)
                    ->whereClassId($class_id)
                    ->whereDate('started_at', '=', $date)
                    ->whereSlotId($slot_id)
                    ->exists();
    }
}