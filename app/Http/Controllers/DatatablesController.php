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
		 	return view('datatables.index');
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
