<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Subject;
use App\Program;

class SubjectController extends Controller
{
    /**
     * All Available Programs 
     * @var array
     */
    protected $programs;

    /**
     * Prepare variables
     */
    public function __construct()
    {
        $this->programs = Program::pluck('name', 'id')->toArray();
        array_unshift( $this->programs, 'Please select');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subjects = Subject::search($request->q)
                            ->ofProgram($request->program)
                            ->orderBy('created_at')
                            ->paginate(50);

        $programs = $this->programs;

        return view('subjects/index', compact('subjects', 'request', 'programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subjects/create');
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
        
        if ( ! isset($data['is_required']))
            $data['is_required'] = 0;

        if (! empty($data['grades_plan'])) {
            $data['grades_plan'] = json_decode( $data['grades_plan'] );
            $data['grades_count'] = count($data['grades_plan']);
        }

        if (! empty($data['sessions_plan'])) {
            $data['sessions_plan'] = json_decode( $data['sessions_plan'] );
            $data['sessions_count'] = count($data['sessions_plan']);
        }

        try {
            $subject = Subject::create($data);
            return redirect('subjects/' . $subject->id )->with('message', 'Subject was created successfully!');
        } catch ( Exception $e ) {
            return back()->withInput()->with('message', 'Fooo!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return $this->edit($subject);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('subjects/update', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $data = $request->all();        
        $data = array_filter($data);

        if (! empty($data['grades_plan'])) {
            $data['grades_plan'] = json_decode( $data['grades_plan'] );
            $data['grades_count'] = count($data['grades_plan']);
        }

        if (! empty($data['sessions_plan'])) {
            $data['sessions_plan'] = json_decode( $data['sessions_plan'] );
            $data['sessions_count'] = count($data['sessions_plan']);
        }

        if ( ! isset($data['is_required']))
            $data['is_required'] = 0;
        
        try {
            $subject->update($data);

            return redirect('subjects/' . $subject->id )
                ->with('message', 'Subject was updated successfully!');
        } catch(Exception $e) {
            return back()->withInput()->with('message', 'Fooo!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return back()->withMessage('Subject was deleted successfully!');
    }
}
