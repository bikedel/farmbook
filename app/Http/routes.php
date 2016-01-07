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

Route::any('myAjaxCallURI', 'MainController@getAjax');



Route::get('/', ['middleware' => ['auth'], function () {


    $user = Auth::user()->name;
    $userId = Auth::user()->id;

    // get suburbs

	//$suburbs = App\Suburb::all(['id', 'name']); //->where('user_id',$userId)->get();
	$streets = App\Street::all(['id', 'name']);

    $suburbs = DB::table('user_suburbs')
    ->join('suburbs',"suburbs.id" ,'=','user_suburbs.suburb_id')
    ->select("suburbs.id","name")->distinct()
    ->where('user_id',$userId)->distinct('suburbs.name')->get();


//dd($sub);
	return View::make('pages.home', compact('user','suburbs','streets'));

	//return view('pages.home');
}]);

Route::get('/admin', function () {
	return view('pages.admin');
});

Route::get('/users/{user}', function ( $user) {
	$mp = \App\User::find($user);
	return ($mp);
});



Route::get('/hello/{name}',  'DatatablesController@show' );





Route::get('/notes',  'FreeholdsController@update' );




Route::get('notes/{numErf}', function ($numErf) {

	$mp = DB::table('tblErfNumbers')->where('id', $numErf)->first();
	dd($mp,$numErf,$mp);
	return view('datatables.edit',compact('mp'));
});



Route::get('/street',  'StreetsController@index' );

Route::post('/street',  'StreetsController@edit' );

Route::resource('update', 'DatatablesController');


Route::get('destroy/{id}',  'DatatablesController@destroy' );

Route::controller('datatables', 'DatatablesController', [
	'anyData'  => 'datatables.data',
	'getIndex' => 'datatables',
	]);


Route::controller('freeholds', 'FreeholdsController', [
	'anyData'  => 'freeholds.data',
	'getIndex' => 'freeholds',
	]);


//admin
Route::get('protected', ['middleware' => ['auth', 'admin'], function() {
	return "this page requires that you be logged in and an Admin";
}]);




// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
