<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use Yajra\Datatables\Datatables;

use Input;
use App\Freehold;
use App\tblErfNumbers;
use Redirect;
use Route;

use DB;

class FreeholdsController extends Controller
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




		 	return view('freeholds.index');
		 }




		/**
		 * Process datatables ajax request.
		 *
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function anyData()
		{

			//Freehold::select(['strSuburb']);
			//$freehold = Freehold::all();

			//return Datatables::of($freehold)->make();


			
	//	 $freeholds = Freeholds::of(Freehold::select('*'))->make(true);
//dd($freeholds);

		// return $freeholds;

        // $freehold = Freehold::select('*')->where('numErf', '>', '90000')->get();






			$freehold = Freehold::Join('tblErfNumbers','freeholds.numErf','=','tblErfNumbers.id')
			->Join('tblSuburbContactNumbers','freeholds.strIdentity','=','tblSuburbContactNumbers.strIDNumber')
			->orderBy('strStreetName', 'asc')
			->orderBy('strStreetNo', 'asc')
			->select('*')->get();


			return Datatables::of($freehold)
			->addColumn('notes', function ($freehold) {
				return $freehold->memNotes;
			})
			->make(true);
		}



		public function update(Request $request)
		{
			$input = $request;

			$numErf = Input::get('numErf');
			$strIdentity = Input::get('strIdentity');
			$comment = Input::get('comment');
			$strHomePhoneNo = Input::get('strHomePhoneNo');
			$strWorkPhoneNo = Input::get('strWorkPhoneNo');
			$strCellPhoneNo = Input::get('strCellPhoneNo');
			$EMAIL = Input::get('EMAIL');


			$result = DB::table('tblErfNumbers')->where('id', $numErf)->get();


			if ($result) {

				$affected = DB::table('tblErfNumbers')
				->where('id', $numErf)
				->update(array('memNotes' => $comment));

				$affected2 = DB::table('tblSuburbContactNumbers')
				->where('strIDNumber', $strIdentity)
				->update(array('strCellPhoneNo' => $strCellPhoneNo,
					'strHomePhoneNo' => $strHomePhoneNo,
					'strWorkPhoneNo' => $strWorkPhoneNo,
					'EMAIL' => $EMAIL,
					));

				Session::flash('flash_message', 'Updated '.  $numErf );
				Session::flash('flash_type', 'alert-success');
				return Redirect::back();

			} else {

				Session::flash('flash_message', 'Error updating '.  $numErf );
				Session::flash('flash_type', 'alert-danger');
				return Redirect::back();

			}

			dd("ok");

			return Redirect::route('datatables');
		}



	}
