<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::get('profile', function () {
    return view('users/profile');
});

Route::resource('branches', 'BranchController');
Route::resource('settings', 'SettingController');
Route::resource('users', 'UserController');
Route::resource('students', 'StudentController');
Route::resource('parents', 'UserController');
Route::resource('rooms', 'RoomController');
Route::resource('roles', 'RoleController');
Route::resource('classes', 'ClassController');
Route::resource('subjects', 'SubjectController');
Route::resource('programs', 'ProgramController');