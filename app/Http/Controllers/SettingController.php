<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Branch;
use App\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        
        $branch_id = Branch::currentId();

        if ( ! empty($request->file('logo'))) {
            $logo      = $request->file('logo');

            $logo_path = $logo->getRealPath();
            $logo_name = $logo->getClientOriginalName();

            $logo->move(
                base_path() . '/public/images/', $logo_name
            );

            $data['logo'] = $logo_name;
        }

        if ( ! empty($request->file('favicon')))
        {
            $favicon      = $request->file('favicon');
            $favicon_path = $favicon->getRealPath();
            $favicon_name = 'favicon.ico';

            $favicon->move(
                base_path() . '/public/', $photo_name
            );
        }


        foreach ($data as $key => $value)
        {
            if ($key != '_token')
                Setting::set($key, $value, $branch_id);
        }

        // Checkboxes
        if ( ! isset($data['enable_ssl']))
            Setting::set('enable_ssl', 0);

        
        return back()->withMessage('Setting was saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    public function grades()
    {
        return view('settings/grades');
    }
}
