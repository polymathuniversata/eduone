<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Branch;
use App\Program;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     * Available Roles
     * @var array
     */
    protected $roles = [];

    /**
     * Available Branches
     * @var array
     */
    protected $branches = [];

    /**
     * Available Programs
     * @var array
     */
    protected $programs = [];

    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->roles       = Role::orderBy('id')->lists('name', 'id')->toArray();

        $this->branches    = Branch::lists('name', 'id')->toArray();

        $this->programs    = Program::lists('name', 'id')->toArray();

        $this->user        = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::search($request->all())
                    ->orderBy('created_at')
                    ->paginate(50); 

        return view('users.index', [
            'users'     => $users,
            'roles'     => $this->roles,
            'branches'  => $this->branches,
            'request'   => $request
        ]);
    }

    public function search(Request $request)
    {
        return User::search($request->all())->get(['id', 'display_name', 'photo']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('users.create', [
            'roles'     => $this->roles,
            'branches'  => $this->branches,
            'programs'  => $this->programs,
            'request'   => $request
        ]);
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
        
        if (! empty($data['branches'])) {
            $branches = $data['branches'];

            foreach($branches as $index => $branch)
            {
                $branches[$index] = intval($branch);
            }
        }

        try {
            $user = User::create($data);

            if (isset($branches))
                $user->branches()->sync($branches);

            return redirect('users/' . $user->id )
                        ->with('message', 'User was created successfully!');
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
    public function show(User $user, Request $request)
    {
        $user_branches = $user->branches->lists('id')->toArray();
        $user_programs = $user->programs->lists('id')->toArray();

        $permissions= config('settings.permissions');
        
        if ( ! isset($request->tab))
            $request->tab = 'account';

        $pass_to_view = [
            'user'          => $user,
            'roles'         => $this->roles,
            'branches'      => $this->branches,
            'user_branches' => $user_branches,
            'user_programs' => $user_programs,
            'permissions'   => $permissions,
            'programs'      => $this->programs,
            'request'       => $request
        ];

        if ($user->isRole([3,4])) {
            $subjects         = \App\Subject::lists('name', 'id')->toArray();

            $pass_to_view['subjects'] = $subjects;
        }

        if ($user->isTeacher()) {
            
            $teacher_subjects = $user->subjects->lists('id')->toArray(); 

        }

        if ($user->isStudent()) {

            $user_subjects_pivot = \DB::table('users_subjects')
                                        ->where('user_id', $user->id)
                                        ->get();

            $student_grades = \DB::table('users_grades')
                                    ->where('user_id', $user->id)
                                    ->orderBy('subject_id')
                                    ->orderBy('grade_id')
                                    ->get();

            $student_grades = collect($student_grades)->sortBy('grade_id')->groupBy('subject_id')->toArray();
            

            $pass_to_view['user_subjects_pivot']    = $user_subjects_pivot;
            $pass_to_view['student_grades']         = $student_grades;
        }

        return view('users.update', $pass_to_view);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return $this->show($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = array_filter($request->all());

        if ( ! empty($data['branches']))
            $branches = (array) $data['branches'];

        if ( ! empty($data['programs']))
            $programs = (array) $data['programs'];

        if ( ! empty($data['subjects']))
            $subjects = (array) $data['subjects'];

        if ( ! empty($data['photo'])) {
            $photo      = $request->file('photo');
            $photo_path = $photo->getRealPath();
            $photo_name = $photo->getClientOriginalName();

            $photo->move(
                base_path() . '/public/photos/', $photo_name
            );

            $data['photo'] = $photo_name;
        }

        if ( ! empty($data['family_members']) )
        {
            $users = [];
            $queue = json_decode($data['family_members'], true);

            // Todo: Use better function that foreach
            foreach ($queue as $member) {
                $users[$member['id']] = $member['id'];
            }

            if ($user->isStudent())
                $user->parents()->attach($users);
            else
                $user->childrens()->attach($users);
        }

        try {
            $user->update($data);

            if ( ! empty($data['branches']))
                $user->branches()->sync($branches);

            if ( ! empty($data['programs']))
                $user->programs()->sync($programs);

             if ( ! empty($data['subjects']))
                $user->subjects()->sync($subjects);

            return redirect('users/' . $user->id )
                ->with('message', 'User was updated successfully!');

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
    public function destroy(User $user)
    {
        $user->delete();

        return back()->withMessage('User was deleted successfully!');
    }
}
