<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Group;
use App\Subject;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $view = [];

        if ( ! isset($request->grade_id)) {
            $subjects = Subject::orderBy('name')->get()->getDictionary();
            
            $classes = Group::with('subjects')->ofType('class')->paginate(5);

            $view = [
                'request' => $request,
                'classes' => $classes,   
                'subjects'=> $subjects
            ];
        } 
        else {
            $class      = Group::findOrFail($request->class_id);

            $subject    = Subject::findOrFail($request->subject_id);

            $grades = \DB::table('users_grades')
                    ->where('subject_id', $request->subject_id)
                    ->where('class_id', $request->class_id)
                    ->where('grade_id', $request->grade_id)
                    ->get();

            // Use user_id as key for easier access in the view        
            $grades = collect($grades)->keyBy('user_id')->toArray();
                
            $students   = $class->getStudents();

            $view       = compact('request', 'class', 'subject', 'students', 'grades');
        }

        return view('grades/index', $view);
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
        $data = $request->all();
        
        $insert = [];
        $update = [];

        $exists = \DB::table('users_grades')
                    ->where('subject_id', $data['subject_id'])
                    ->where('class_id', $data['class_id'])
                    ->where('grade_id', $data['grade_id'])
                    ->get();

        foreach ($data['students'] as $student_id => $grade) 
        {
             $record = [
                'user_id'       => $student_id,
                'subject_id'    => intval($data['subject_id']),
                'class_id'      => intval($data['class_id']),
                'grade_id'      => intval($data['grade_id']),
                'total'         => isset($grade['mark']) ? $grade['mark'] : 0,
                'notes'         => isset($grade['notes']) ? $grade['notes'] : '',
                'creator_id'    => 1,
                'created_at'    => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
            ];
            
            $ins = true;

            // If record exists, then assign to $update with key is row id to perform update
            if ( ! empty($exists)) {
                foreach ($exists as $row) {
                    if ($row->user_id == $student_id) {
                        $update[$row->id] = $record;
                        $ins = false;
                        break; // Todo: check it
                    }
                }
            }

            if ($ins)
                $insert[] = $record;
        }

        $rows_affected = \DB::table('users_grades')->insert($insert);

        foreach ($update as $id => $row)
        {
            \DB::table('users_grades')->whereId($id)->update($row);
            $rows_affected++;
        }

        return redirect()->back()->withMessage('Success' . $rows_affected);
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
