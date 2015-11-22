<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Branch;
use App\Program;

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


    public function __construct()
    {
        $this->roles       = Role::orderBy('id')->lists('name', 'id')->toArray();

        $this->branches    = Branch::lists('name', 'id')->toArray();

        $this->programs    = Program::lists('name', 'id')->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users      = User::search($request->q)
                            ->ofRole($request->role)
                            ->branch($request->branch)
                            ->orderBy('created_at')
                            ->paginate(50);

        return view('users.index', [
            'users'     => $users,
            'roles'     => $this->roles,
            'branches'  => $this->branches,
            'request'   => $request
        ]);
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
        
        if (! empty($data['branches']))
            $branches = (array) $data['branches'];
        
        try {
            $user = User::create($data);
            
            if (! empty($branches))
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
    public function show(User $user)
    {
        $user_branches = $user->branches->lists('id')->toArray();
        $user_programs = $user->programs->lists('id')->toArray();

        $permissions= config('settings.permissions');
        
        $pass_to_view = [
            'user'          => $user,
            'roles'         => $this->roles,
            'branches'      => $this->branches,
            'user_branches' => $user_branches,
            'user_programs' => $user_programs,
            'permissions'   => $permissions,
            'programs'      => $this->programs
        ];

        if ($user->isTeacher()) {
            $subjects         = \App\Subject::lists('name', 'id')->toArray();
            $teacher_subjects = $user->subjects->lists('id')->toArray(); 

            $pass_to_view['subjects'] = $subjects;
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

    public function updatePhoto(Request $request, User $user)
    {
        Storage::put('avatars' . $user->id, 
            file_get_contents($request->file('avatar')->getRealPath())
        );
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
