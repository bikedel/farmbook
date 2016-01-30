<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Datatables;

use Input;
use App\User;
use Redirect;
use Route;
use DB;
use Auth;
use Helpers;
use Session;
use Exception;

class DatatablesController extends Controller
{



	public $currUrl = "";


	public function __construct()
	{
		$this->middleware('auth');
	}


		 /**
		 * Displays datatables front end view
		 *
		 * @return \Illuminate\View\View
		 */
		 public function getIndex()
		 {

		 //  $getname = Auth::user()->suburb;
          //  dd($getname);

		 	$suburbs = DB::table('suburbs')->lists('database','id');

		 	$test = DB::table('suburbs')->select('id')->orderby('id')->first();
   
            $test = [$test->id];


		 	return view('datatables.index',compact('suburbs','test'));
		 }

		 /**
		 * Displays datatables front end view
		 *
		 * @return \Illuminate\View\View
		 */
		 public function show()
		 {

		 //  $getname = Auth::user()->suburb;
		 	$current_params = Route::current()->parameters();

		 	$user = $current_params;
		 	$mp = \App\User::find($user);
           // dd($mp);
          // $array = json_decode(json_encode($mp), true);
		 	$mp = $mp[0];

		 	$userId = $current_params;

		 	$suburbs = DB::table('user_suburbs')
		 	->join('suburbs',"suburbs.id" ,'=','user_suburbs.suburb_id')
		 	->select("suburbs.id","name","database")->distinct()
		 	->where('user_id',$userId)->distinct('suburbs.name')->get();

//dd($suburbs,$userId);


		 	return View('datatables.edit',compact('mp','suburbs'));
		 //	return view('datatables.edit');
		 }


		/**
		 * Process datatables ajax request.
		 *
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function anyData()
		{

			return Datatables::of(User::select('*'))->make(true);
		}

		/**
		 * Process datatables ajax request.
		 *
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function newUser(Request $request)
		{


            // get inputs
			$sub = $request->input('getsuburb');
			$name = $request->get('name');
			$email = $request->get('email');
			$admin = $request->get('admin');
			$password = $request->get('password');
			$passwordc = $request->get('password_confirmation');






     // submitted form action
			$formaction = $request->get('formaction');

            //dd($name,$email,$password,$admin,$sub,$formaction );

     // delete database
			if ($formaction == "Delete" ){
				try{




        // get user id
					$usersid = DB::table('users')->where('email', $email)->first();
					$usersid = $usersid->id ;

					DB::table('users')->where('name', '=',$name)->delete();
              // delete all assoc databases
					DB::table('user_suburbs')->where('user_id', '=',$usersid)->delete();

				}
				catch(\Exception $e){
            // error
					Session::flash('flash_message',   $name . ' not deleted ' . $e->getMessage() );
					Session::flash('flash_type', 'alert-danger');
					return Redirect::back();
				}
            // success
				Session::flash('flash_message',   $name . ' has been deleted');
				Session::flash('flash_type', 'alert-success');
				return Redirect::back();
			}


        // update database
			if ($formaction == "Update" ){
				try{


					if (strlen($password) > 0  && $password == $passwordc ) {

					} else {
						throw new Exception('password problem');
					}

                   // get first suburb selected details
					$suburbType = DB::table('suburbs')->where('id', $sub[0])->first();


					DB::table('users')->where('name','=',$name)->update(
						['name' => $name, 'email' => $email, 'admin' => $admin, 'suburb' => $suburbType->database , 'suburb_type'=> $suburbType->type,
						'password' => bcrypt($password),
						'created_at'=> \Carbon\Carbon::now()->toDateTimeString(),
						'updated_at'=> \Carbon\Carbon::now()->toDateTimeString()
						]);


        // get user id
					$usersid = DB::table('users')->where('email', $email)->first();
					$usersid = $usersid->id ;

                 // delete old database connections
					DB::table('user_suburbs')->where('user_id', '=',$usersid)->delete();

                 // add databases for user
					foreach ($sub as $value) {
						DB::table('user_suburbs')->insertGetId(
							['user_id' => $usersid, 'suburb_id' => $value]
							);

					}


				}
				catch(\Exception $e){
                // error
					Session::flash('flash_message',   $name . ' not updated.'.$e->getMessage() );
					Session::flash('flash_type', 'alert-danger');
					return Redirect::back();
				}
                // success
				Session::flash('flash_message',   $name . ' has been updated');
				Session::flash('flash_type', 'alert-success');
				return Redirect::back();
			}


        // add new database
			if ($formaction == "Add" ){
				try{


					if (strlen($password) > 0  && $password == $passwordc ) {

					} else {
						throw new Exception('password problem');
					}


                   // get first suburb selected details
					$suburbType = DB::table('suburbs')->where('id', $sub[0])->first();


					DB::table('users')->insert(
						['name' => $name, 'email' => $email, 'admin' => $admin, 'suburb' => $suburbType->database , 'suburb_type'=> $suburbType->type,
						'password' => bcrypt($password),
						'created_at'=> \Carbon\Carbon::now()->toDateTimeString(),
						'updated_at'=> \Carbon\Carbon::now()->toDateTimeString()
						]);

        // get user id
					$usersid = DB::table('users')->where('email', $email)->first();
					$usersid = $usersid->id ;


        // add databases for user
					foreach ($sub as $value) {
						DB::table('user_suburbs')->insertGetId(
							['user_id' => $usersid, 'suburb_id' => $value]
							);

					}

				}
				catch(\Exception $e){


                //error
					Session::flash('flash_message',   $name . ' not added.' .$e->getMessage());
					Session::flash('flash_type', 'alert-danger');
					return Redirect::back();
				}
                // success
				Session::flash('flash_message',   $name . ' has been added');
				Session::flash('flash_type', 'alert-success');
				return Redirect::back();
			}


			return Redirect::back();
		}





		public function update(User $user, Request $request)
		{

			$current_params = Route::current()->parameters();

	      //  $input = array_except(Input::all(), '_method');
			$name = $request->input('name');
			$username = $request->input('username');
			$id = $request->input('id');
			$email = $request->input('email');
			$admin = $request->input('admin');
			$suburb = $request->input('suburb');
//dd($request,$id,$current_params);
//$user->update(['name' => $email]);

			$user = User::find($id);

			$user->name = $name;
			$user->username = $username;
			$user->email = $email;
			$user->admin = $admin;
			$user->suburb = $suburb;
			$user->save();

			$user->touch();


			return Redirect::route('datatables');
		}

		public function destroy( Request $request)
		{

			$id = $request->id;

	      //  $input = array_except(Input::all(), '_method');


//$user->update(['name' => $email]);

			$user = User::find($id);


			$user->delete();


			

			return Redirect::route('datatables');
		}





	}
