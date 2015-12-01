<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Schedule;
use App\Room;
use \Carbon\Carbon as Carbon;

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
        if ($request->date === 'today')
            $request->date = date('Y-m-d');

        $request->date = isset($request->date) ? $request->date : date('Y-m-d');

        $request_date = Carbon::createFromFormat('Y-m-d', $request->date);

        $today          = Carbon::today()->format('Y-m-d');
        $previous_day   = $request_date->copy()->subDay()->format('Y-m-d');
        $next_day       = $request_date->copy()->addDay()->format('Y-m-d');
        $viewing_day    = $request_date->copy()->format('Y-m-d');

        // Todo: Should cast $request->date to date type
        
        $slots = config('settings.slots');

        $rooms = Room::lists('name', 'id')->toArray();

        $available_schedules = Schedule::whereDate('started_at', '=', $viewing_day)->ofBranch(1)->get();

        $schedules = [];
        foreach ($rooms as $room_id => $room_name) {
            foreach ($slots as $slot) {                    
                $schedules[$room_id][$slot['id']] = new \stdClass;
            }
        }
        
        foreach ($available_schedules as $schedule)
        {
            if (isset($schedule->room_id) && isset($schedule->slot_id)) {
                $schedules[$schedule->room_id][$schedule->slot_id] = $schedule;
            }
        }

        $pass_to_view = [
            'teachers' => $this->teachers,
            'slots' => $slots,
            'rooms' => $rooms,
            'schedules' => $schedules,
            'classes' => $this->classes,
            'subjects' => $this->subjects,
            'request' => $request,
            'dates' => compact('today', 'previous_day', 'next_day', 'viewing_day')
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
        $data = array_filter($request->all());

        $data['branch_id'] = 1;

        $schedule = Schedule::findByUnique($data['started_at'], $data['room_id'], $data['slot_id']);

        // Convert Slot to time
        $slot_id                = intval($data['slot_id']);
        $slot_time              = get_slot_time($slot_id);
        $date                   = $data['started_at'];

        if ( ! $schedule) {
            $data['started_at']    .= ' ' .$slot_time[0];
            $data['finished_at']    = $date . ' ' . $slot_time[1];
        }

        $data['started_at']     = Carbon::parse($data['started_at'])->format('Y-m-d H:i:s');
        $data['finished_at']    = Carbon::parse($data['finished_at'])->format('Y-m-d H:i:s');

        if ( ! $schedule )
            return Schedule::create($data);

        unset($data['updated_at']);
        
        $schedule->update($data);

        return 'success';
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
