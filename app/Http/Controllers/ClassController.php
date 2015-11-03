<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Classes;
use App\Branch;
use App\Program;
use App\Subject;

class ClassController extends Controller
{
    protected $programs = [];
    protected $branches = [];
    protected $subjects = [];

    public function __construct()
    {
        $this->programs = Program::lists('name', 'id')->toArray();
        array_unshift($this->programs, 'Please select');
        
        $this->branches = Branch::lists('name', 'id')->toArray();
        array_unshift($this->branches, 'Please select');

        $this->subjects = Subject::lists('name', 'id')->toArray();
        array_unshift($this->subjects, 'Please select');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $classes = Classes::all();
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
        
        $subjects = $this->subjects;

        $programs = $this->programs;

        return view('classes/create', compact('branches', 'programs', 'subjects'));
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
