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
	if ( ! Auth::user())
		Auth::loginUsingId(1);

    return view('dashboard');
});

Route::get('profile', function () {
    return view('users/profile');
});

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration Routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::resource('branches', 'BranchController');
Route::resource('settings', 'SettingController');
Route::resource('rooms', 'RoomController');
Route::resource('roles', 'RoleController');
Route::resource('classes', 'ClassController');
Route::resource('subjects', 'SubjectController');
Route::resource('programs', 'ProgramController');

Route::get('users/search', function(Illuminate\Http\Request $request)
{
	$exists = [1,2,3];

	return App\User::search($request->search)
					->where('id', 'not in', $exists)
					->get(['id', 'name', 'photo']);
});

Route::resource('users', 'UserController');
Route::resource('media', 'MediaController');
Route::resource('schedules', 'ScheduleController');

// Route::get('users/search', function()
// {
// 	return App\User::orderBy('created_at', 'desc')->get(['id', 'name', 'photo']);
// });



// Route::get('programs/periods/{id}', 'ProgramController@periods');
Route::get('classes/{id}/members', 'ClassController@members');
Route::get('classes/{id}/subjects', 'ClassController@subjects');

Route::patch('classes/{id}/members', 'ClassController@setRole');