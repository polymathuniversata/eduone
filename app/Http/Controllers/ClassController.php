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
                        ->with('message', 'Congratulation! Class was created successfully!');
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
    public function show(Group $class, Request $request)
    {
        return $this->edit($class, $request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $class, Request $request)
    {
        if ( ! isset($request->tab))
            $request->tab = 'members';

        $pass_to_view = [
            'programs' => $this->programs,
            'branches' => $this->branches,
            'class'    => $class,
            'request'  => $request
        ];
        
        if ($request->tab === 'subjects' || $class->users_count > 0) {
            $teachers   = $class->getTeachers()->lists('name', 'id')->toArray();
        
            $program = $class->program;

            $subjects = [];
            $periods = $program->periods()->orderBy('ordr')->get();

            foreach ($periods as $period) {
                $subjects[$period->id] = $period->subjects()->orderBy('ordr')->get();
            }

            $class_subjects = $class->subjects->pluck('id')->toArray();
            
            $subjects_teachers = $class->getSubjectsTeachers();
            
            $pass_to_view += compact('periods', 'subjects', 'class_subjects', 'teachers', 'subjects_teachers');
        }

        return view('classes/update', $pass_to_view);
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

        try {
            $class->update($data);

            $message = 'Class was updated successfully!';

            // Save Subjects and assigned Teachers
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

            // Save Users
            if ( ! empty($data['queue'])) {
                $users = [];
                $queue = json_decode($data['queue'], true);
                foreach ($queue as $user) {
                    $users[$user['id']] = $user['id'];
                }

                // Parse $data['users'] to properly id to add to class
                $class->addUsers($users);

                $message = 'Class members was added successfully!';
            }

            return redirect(url('/classes/' . $class->id . '?tab=' . $request->tab))->withMessage($message);
        } catch (Exception $e) {
            return redirect(url('/classes/' . $class->id . '?tab=' . $request->tab))->withInput()->withMessage('Error during updating class!');
        }
    }

    public function subjects($id, Request $request)
    {
        $class = Group::findOrFail($id);

        $subjects = $class->subjects;
        
        $subjects_info = [];

        foreach ($subjects as $subject)
        {
            $subjects_info[$subject->id] = [
                'id'        => $subject->id,
                'name'      => $subject->name,
                'completed' => $class->getSubjectCompletedSessions($subject->id),
                'teacher'   => $subject->pivot->user_id // Todo: Check performance this line
            ];
        }

        return $subjects_info;
    }

    public function teacher($class_id, $subject_id, Request $request)
    {
        $class = Group::findOrFail($class_id);

        $teacher = $class->getTeacherBySubject($subject_id);

        return $teacher;
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
