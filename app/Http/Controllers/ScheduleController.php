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

    public function __construct()
    {
        $this->teachers = \App\User::ofRole(3)->lists('display_name', 'id')->toArray();
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
            'Slot 1' => '7:45 - 9:30',
            'Slot 2' => '9:45 - 11:30',
            'Slot 3' => '13:45 - 15:30',
            'Slot 4' => '15:45 - 16:30',
            'Slot 5' => '16:45 - 18:30',
        ];

        $rooms = Room::lists('name', 'id')->toArray();

        $pass_to_view = [
            'date' => $date,
            'schedule' => $schedule,
            'teachers' => $this->teachers,
            'slots' => $slots,
            'rooms' => $rooms
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
        //
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
