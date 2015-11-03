<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Branch;

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


    public function __construct()
    {
        $this->roles       = Role::lists('name', 'id')->toArray();
        array_unshift($this->roles, 'Please select');

        $this->branches    = Branch::lists('name', 'id')->toArray();
        array_unshift($this->branches, 'Please select');
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

        $roles      = $this->roles;
        $branches   = $this->branches;

        return view('users.index', compact('users', 'roles', 'branches', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles      = $this->roles;
        $branches   = $this->branches;

        return view('users.create', compact('roles', 'branches'));
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
            
            if (! empty($data['branches']))
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
        $roles      = $this->roles;
        $branches   = $this->branches;

        $permissions= config('settings.permissions');

        return view('users.update', compact('user', 'roles', 'branches', 'permissions'));
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
        $data = $request->all();        
        $data = array_filter($data);

        try {
            $user->update($data);

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
