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
    public function create()
    {
        // Todo: If users isn't Administrator, branch is current branch
        $branches = $this->branches;
        $programs = $this->programs;
        
        return view('classes/create', compact('branches', 'programs'));
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

        // Already Added Members
        $members = [
            ['id' => 1, 'name' => 'Tan Nguyen', 'email' => 'tan@fitwp.com', 'role' => 'Teacher', 'photo' => 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xlt1/v/t1.0-1/p100x100/11694742_702638139841881_3407774468465086624_n.jpg?oh=3e821c7cc35415570f815389a2e6b91e&oe=56B35EBC&__gda__=1455586043_b09d7ffe08072bb8da01d4537d508da5'],
            ['id' => 2, 'name' => 'Hai Tran', 'email' => 'hai@fpt.edu.vn', 'role' => 'Student', 'photo' => 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xlp1/v/t1.0-1/p100x100/11960032_10205265084689207_9163069548125985365_n.jpg?oh=74f1b16405469c14d5c5f51fda9d7be4&oe=56B96460&__gda__=1454596060_668c6e5ac01fa5a4c8f9668331401243'],
            ['id' => 3, 'name' => 'Phan Anh', 'email' => 'phananh@gmail.vn', 'role' => 'Student', 'photo' => 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpa1/v/t1.0-1/p100x100/603826_961073040577277_1835077498336082614_n.jpg?oh=dcdd84cfabbb6f403b9870ae1cc544a0&oe=56F4B8D8&__gda__=1454782660_8fa501ac21b7526d133c81014366ea0a'],
        ];

        // All Users available to add
        // Todo: Only add users in current Program 
        $users = User::lists('name', 'id')->toArray();

        return view('classes/members', compact('class', 'members', 'users'));
    }

    public function subjects($id)
    {
        $class = Group::findOrFail($id);

        $program = $class->program;

        $subjects = [];
        $periods = $program->periods()->orderBy('ordr')->get();

        foreach ($periods as $period) {
            $subjects[$period->id] = $period->subjects()->orderBy('ordr')->get();
        }

        $class_subjects = $class->subjects->pluck('id')->toArray();
        
        return view('classes/subjects', compact('class', 'program', 'periods', 'subjects', 'class_subjects'));
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

            if ( ! empty($data['subjects'])) {
                // Save Subjects
                $class->subjects()->sync($data['subjects']);
            }

            if ( ! empty($data['users'])) {
                
                // Parse $data['users'] to properly id to add to class
                $class->addUsers($data['users']);
            }
            
            return redirect(url('/classes/' . $class->id))->withMessage('Class was updated successfully!');
        } catch (Exception $e) {
            return redirect(url('/classes/' . $class->id))->withInput()->withMessage('Error during updating class!');
        }
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
