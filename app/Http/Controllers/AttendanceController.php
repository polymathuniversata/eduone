<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Group;
use App\Schedule;
use App\Subject;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ( ! isset($request->schedule_id))
            return redirect(url('/'))->withMessage('Please select a class session');

        $schedule_id = intval($request->schedule_id);

        $schedule   = Schedule::find($schedule_id);
        
        $attendance_detail = $schedule->attendance_detail;

        $class      = Group::find($schedule->class_id);
        
        $students   = $class->getStudents()->lists('display_name', 'id')->toArray();

        $subject = Subject::findOrFail($schedule->subject_id);
        
        $view = compact('schedule', 'class', 'students', 'request', 'subject', 'attendance_detail');

        return view('attendances/create', $view);
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

        if ( ! $data['schedule_id'])
            return redirect(url('/'))->withMessage('Please select a class session');

        $schedule = Schedule::findOrFail($data['schedule_id']);

        $students = $data['students'];

        // Attendance Detail for Class
        $attendance_detail = [];

        foreach ($students as $student_id => $state) {
            $id = intval($student_id);
            
            $status = isset($state['status']) ? $state['status'] : 'absent';
            $note   = isset($state['note']) ? $state['note'] : '';

            $attendance_detail[$id] = compact('status', 'note');

            $student_attendance_detail = [
                'date'      => $schedule->started_at->format('Y-m-d H:i:s'),
                'slot'      => $schedule->slot_id,
                'status'    => $status,
                'note'      => $note
            ];
            
            $student_subjects_pivot = [
                'user_id'       => $id,
                'class_id'      => $schedule->class_id,
                'subject_id'    => $schedule->subject_id,
                'creator_id'    => $schedule->creator_id,
                'branch_id'     => $schedule->branch_id,
                'attendance_detail' => json_encode([$student_attendance_detail])
            ];

            // Todo: Improve performance of these lines
            $student_attendance = \DB::table('users_subjects')
                        ->whereUserId($id)
                        ->whereClassId($schedule->class_id)
                        ->whereSubjectId($schedule->subject_id)
                        ->first();

            if ( ! $student_attendance) {
                \DB::table('users_subjects')->insert($student_subjects_pivot);
            } else {

                $attendance_details = json_decode($student_attendance->attendance_detail);

                $new = true;

                foreach ($attendance_details as $index => $attendance) {
                    
                    if ($attendance->date === $student_attendance_detail['date']
                        && $attendance->slot = $schedule->slot_id
                    ) {
                        $attendance_details[$index] = $student_attendance_detail;

                        $new = false;
                    }
                }

                if ($new)
                    $attendance_details[] = $student_attendance_detail;

                \DB::table('users_subjects')->where('id', $student_attendance->id)
                                            ->update(['attendance_detail' => json_encode($attendance_details)]);
            }
        }

        $schedule->attendance_detail = $attendance_detail;
        $schedule->save();

        return redirect(url('attendances/create?schedule_id=' . $schedule->id));
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
