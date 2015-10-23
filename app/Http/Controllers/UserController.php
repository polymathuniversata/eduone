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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::lists('name', 'id')->toArray();
        $branches = Branch::lists('name', 'id')->toArray();

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
        $data = $request->all();

        foreach ($data as $k => $v) {
            if (empty($data[$k]))
                unset($data[$k]);
        }
        
        if (! empty($data['branches']))
            $branches = (array) $data['branches'];
        
        unset($data['password_confirmation']);
        unset($data['branches']);

        try {
            $user = User::create($data);
            
            if (! empty($data['branches']))
                $user->branches()->sync($branches);

            return redirect('users/' . $user->id )->with('message', 'User was created successfully!');
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
    public function show($id)
    {
        $user       = User::findOrFail($id);
        $roles      = Role::lists('name', 'id')->toArray();
        $branches   = Branch::lists('name', 'id')->toArray();
        $permissions= config('settings.permissions');

        return view('users.update', compact('user', 'roles', 'branches', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->show($id);
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
        $data = $request->all();

        $user = User::findOrFail($id);

        try {
            $user->update($data);

            return redirect('users/' . $user->id )->with('message', 'User was created successfully!');

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
    public function destroy($id)
    {
        //
    }
}
