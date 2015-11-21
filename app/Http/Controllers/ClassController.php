<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Group;
use App\Branch;
use App\Program;
use App\Subject;
use App\User;
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
        $classes = Group::ofType('class')
                        ->ofProgram($request->program)
                        ->ofSubject($request->subject)
                        ->search($request->q)
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
    public function create(Request $request)
    {
        // Todo: If users isn't Administrator, branch is current branch
        $branches = $this->branches;
        $programs = $this->programs;
        
        return view('classes/create', compact('branches', 'programs', 'request'));
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
            $class = Group::create($data);
            
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
    public function show(Group $class)
    {
        return $this->edit($class);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $class)
    {
        $programs = $this->programs;
        $branches = $this->branches;
        
        return view('classes/update', compact('class', 'programs', 'branches'));
    }

    public function members($id)
    {
        $class = Group::findOrFail($id);

        // All Users available to add
        // Todo: Only add users in current Program and Branch 
        $users = User::lists('name', 'id')->toArray();

        return view('classes/members', compact('class', 'users'));
    }

    public function subjects($id)
    {
        $class = Group::findOrFail($id);

        $teachers   = $class->getTeachers()->lists('name', 'id')->toArray();
        
        $program = $class->program;

        $subjects = [];
        $periods = $program->periods()->orderBy('ordr')->get();

        foreach ($periods as $period) {
            $subjects[$period->id] = $period->subjects()->orderBy('ordr')->get();
        }

        $class_subjects = $class->subjects->pluck('id')->toArray();
        
        $subjects_teachers = $class->getSubjectsTeachers();
        //dd($subjects_teachers);
        return view('classes/subjects', compact('class', 'program', 'periods', 'subjects', 'class_subjects', 'teachers', 'subjects_teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $class)
    {
        $data = array_filter($request->all());

        $message = 'Class was updated successfully!';

        try {
            $class->update($data);

            if ( ! empty($data['subjects'])) {
                $pivot      = [];
                $teachers   = $data['teachers'];

                foreach ($data['subjects'] as $subject_id) {
                    
                    if (isset($teachers[$subject_id]) && $teachers[$subject_id] > 0)
                        $pivot[$subject_id] = [
                            'user_id' => intval($teachers[$subject_id])
                        ];
                    else
                        $pivot[] = $subject_id;
                }

                // Save Subjects
                $class->subjects()->sync($pivot);
                
                $message = 'Class subjects was updated successfully!';
            }

            if ( ! empty($data['users'])) {

                // Parse $data['users'] to properly id to add to class
                $class->addUsers($data['users']);

                $message = 'Class members was added successfully!';
            }

            return redirect(url('/classes/' . $class->id))->withMessage($message);
        } catch (Exception $e) {
            return redirect(url('/classes/' . $class->id))->withInput()->withMessage('Error during updating class!');
        }
    }

    public function setRole(Request $request, Group $class)
    {
        return $class;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $class)
    {
        $class->delete();

        return back();
    }
}
