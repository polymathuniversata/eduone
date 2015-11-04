<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Classes;
use App\Branch;
use App\Program;
use App\Subject;
use App\Repositories\ClassRepository;

class ClassController extends Controller
{
    protected $programs = [];
    
    protected $branches = [];
    
    protected $subjects = [];

    protected $classes;

    public function __construct(ClassRepository $classes)
    {
        $this->classes = $classes;

        $this->programs = Program::lists('name', 'id')->toArray();
        
        $this->branches = Branch::lists('name', 'id')->toArray();
 
        $this->subjects = Subject::lists('name', 'id')->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $classes = Classes::search($request->q)
                        ->ofProgram($request->program)
                        ->ofSubject($request->subject)
                        ->paginate(20);

        $programs = $this->programs;
        $branches = $this->branches;

        return view('classes/index', compact('classes', 'programs', 'branches', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Todo: If users isn't Administrator, branch is current branch
        $branches = $this->branches;
        
        $subjects = json_encode($this->subjects);

        $programs = $this->programs;
        $programs_periods = Program::lists('periods', 'id')->toJson();
        
        return view('classes/create', compact('branches', 'programs', 'subjects', 'programs_periods'));
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
        if ( empty($data['slug']))
            $data['slug'] = str_slug($data['name']);

        try {
            $class = Classes::create($data);
            
            return redirect('classes/' . $class->id )
                        ->with('message', 'Class was created successfully!');
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
    public function show(Classes $class)
    {
        return $this->edit($class);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $class)
    {
        $classes = Classes::all();
        $programs = $this->programs;
        $branches = $this->branches;

        return view('classes/update', compact('classes', 'programs', 'branches'));
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
        Classes::findOrFail($id)->delete();

        return back();
    }
}
