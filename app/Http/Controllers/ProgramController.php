<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Program;
use App\Subject;
use App\Branch;

class ProgramController extends Controller
{
    protected $branches = [];

    protected $subjects = [];
    
    public function __construct()
    {
        $this->branches = Branch::lists('name', 'id')->toArray();
        
        $this->subjects = Subject::lists('name', 'id')->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::orderBy('created_at')->paginate(20);

        return view('programs/index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = $this->subjects;

        return view('programs/create', compact('subjects'));
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
        $data = array_filter($data);
        
        if (empty($data['periods']))
            $data['periods'] = [];
        try {
            $program = Program::create($data);
            return redirect('programs/' . $program->id )->with('message', 'Program was created successfully!');
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
    public function show(Program $program)
    {
        $subjects   = $this->subjects;

        // Remove exists subject from all subject above
        return view('programs/update', compact('program', 'subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        return $this->show($program);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $data = array_filter($request->all());

        if (empty($data['periods']))
            $data['periods'] = [];
        
        try {
            $program->update($data);

            return redirect('programs/' . $program->id )
                ->with('message', 'Program was updated successfully!');
        } catch(Exception $e) {
            return back()->withInput()->with('message', 'Fooo!');
        }
    }

    public function periods($id)
    {
        $program = Program::findOrFail($id);       
        $periods = [];
        $all_periods = $program->getPeriods();

        foreach ($all_periods as $id => $period) {
            if ( ! empty($period['subjects'])) {
                $subjects = Subject::whereIn('id', $period['subjects'])
                                ->lists('name', 'id')->toArray();
                $period['subjects'] = $subjects;
            }
            $periods[] = $period;
        }

        return $periods;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        $program->delete();

        return back();
    }
}
