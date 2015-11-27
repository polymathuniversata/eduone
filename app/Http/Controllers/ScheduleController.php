<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Schedule;
use App\Room;

class ScheduleController extends Controller
{
    protected $teachers = [];

    protected $classes = [];

    protected $subjects = [];

    public function __construct()
    {
        $this->teachers = \App\User::ofRole(3)->lists('display_name', 'id')->toArray();
        
        $this->classes = \App\Group::ofType('class')->lists('name', 'id')->toArray();
        
        $this->subjects = \App\Subject::lists('name', 'id')->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = isset($request->date) ? $request->date : date('Y-m-d');

        $schedule = Schedule::whereStartedAt($date)->get();

        $slots = [
            'slot_1' => '7:45 - 9:30',
            'slot_2' => '9:45 - 11:30',
            'slot_3' => '13:45 - 15:30',
            'slot_4' => '15:45 - 16:30',
            'slot_5' => '16:45 - 18:30',
        ];

        $rooms = Room::lists('name', 'id')->toArray();

        $schedules = [];

        foreach ($rooms as $room_id => $room_name) {
            if ( ! isset($schedules[$room_id]))
                $schedules[$room_id] = [];

            foreach ($slots as $slot_name => $time) {
                $schedules[$room_id][$slot_name] = new \stdClass;
            }   
        }

        $pass_to_view = [
            'date' => $date,
            'schedule' => $schedule,
            'teachers' => $this->teachers,
            'slots' => $slots,
            'rooms' => $rooms,
            'schedules' => $schedules,
            'classes' => $this->classes,
            'subjects' => $this->subjects
        ];

        return view('schedules/index', $pass_to_view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();

        $data['branch_id'] = 1;

        return Schedule::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
