<?php

// fix count() error ver php 7.2 >   
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {

    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

}

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


// ajax call from view without reload
//Route::any('myAjaxCallURI', 'MainController@getAjax');




//Route::get('protected', ['middleware' => ['auth','admin'], 'uses' => 'DatatablesController@getIndex']);

Route::get('/adminDatabases',  'AdminController@indexDatabases' );

Route::post('/adminDatabasesNew',  'AdminController@newDatabase' );

Route::post('/adminUsersNew',  'DatatablesController@newUser' );

Route::get('/adminUsers',  'AdminController@indexUsers' );


Route::controller('admin', 'AdminController', [
	'anyData'  => 'admin.data',
	'getIndex' => 'admin',
	]);





Route::get('/',  'SuburbController@index' );

Route::get('/suburb',  'SuburbController@getSuburb' );

Route::post('/suburb',  'SuburbController@setSuburb' );



// admin page
// Route::get('/admin', function () {
//	return view('pages.admin');
//});

//admin
//Route::get('protected', ['middleware' => ['auth', 'admin'], function() {
//	return "this page requires that you be logged in and an Admin";
//}]);

//Route::get('protected', ['middleware' => ['auth','admin'], 'uses' => 'DatatablesController@getIndex']);


//Route::get('/users/{user}', function ( $user) {
//	$mp = \App\User::find($user);
//	return ($mp);
//});

//Route::get('/hello/{name}',  'DatatablesController@show' );


Route::get('/logs',  'LogsController@index' );

//

Route::get('/import',  'CsvImportController@index' );
Route::post('/import',  'CsvImportController@store' );

//    grid update notes route
//
Route::get('/notes',  'FreeholdsController@update' );

Route::get('/streetgrid/{street}',  'StreetsController@checkStreet' );
Route::get('/complexgrid/{street}',  'StreetsController@checkComplex' );
Route::get('/idgrid/{street}',  'StreetsController@checkId' );
Route::get('/erfgrid/{street}',  'StreetsController@checkErf' );


Route::get('/street',  'StreetsController@checkButton' );

Route::post('/street',  'StreetsController@update' );


Route::resource('update', 'DatatablesController');

Route::get('destroy/{id}',  'DatatablesController@destroy' );

Route::get('addsuburb/{id}',  'SuburbController@show' );

Route::controller('datatables', 'DatatablesController', [
	'anyData'  => 'datatables.data',
	'getIndex' => 'datatables',
	]);

Route::controller('freeholds', 'FreeholdsController', [
	'anyData'  => 'freeholds.data',
	'getIndex' => 'freeholds',
	]);

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
