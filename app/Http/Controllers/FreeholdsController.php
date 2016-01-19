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
use Log;
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



            // dynamicall set database
			$userDB = Auth::user()->suburb;
			$otf = new \App\Database\OTF(['database' => $userDB]);
			$db = DB::connection($userDB);


      // get database type
			$databaseType = Auth::user()->suburb_type;


			if ($databaseType == 1 ){

				$freeholds_table = "tblSuburbOwners";
				$freeholds_table_key =  $freeholds_table.".numErf";
				$freeholds_identity = $freeholds_table.".strIdentity";
				$mem_Table = "tblErfNumbers";
				$mem_key = "tblErfNumbers.numErf";

			}
			if ($databaseType == 2 ){

				$freeholds_table = "tblSuburbOwners";
				$freeholds_table_key =  $freeholds_table.".strKey";
				$freeholds_identity = $freeholds_table.".strIdentity";
				$mem_Table = "tblFHPropertyID";
				$mem_key = $mem_Table.".strKey";

			}
			if ($databaseType == 3 ){

				$freeholds_table = "tblSuburbOwners";
				$freeholds_table_key =  $freeholds_table.".strKey";
				$freeholds_identity = $freeholds_table.".strIdentity";
				$mem_Table = "tblFHPropertyID";
				$mem_key = $mem_Table.".strKey";

			}




			$freehold =  $db->table($freeholds_table)
			->Join($mem_Table,$freeholds_table_key ,'=',$mem_key)
			->Join('tblSuburbContactNumbers',$freeholds_identity,'=','tblSuburbContactNumbers.strIDNumber')
			->orderBy('strStreetName', 'asc')
			->orderBy('strStreetNo', 'asc')
			->select('*');








			return Datatables::of($freehold)
			->addColumn('notes', function ($freehold) {
				return $freehold->memNotes;
			})
			->make(true);
		}



		public function update(Request $request)
		{


			$userDB = Auth::user()->suburb;
			$otf = new \App\Database\OTF(['database' => $userDB]);
			$db = DB::connection($userDB);


			$databaseType = Auth::user()->suburb_type;



			if ($databaseType == 1 ){

				$freeholds_table = "tblSuburbOwners";
				$freeholds_table_key =  $freeholds_table.".numErf";
				$freeholds_identity = $freeholds_table.".strIdentity";
				$mem_Table = "tblErfNumbers";
				$mem_key = "numErf";
				$searchKey = Input::get('numErf');
			}
			if ($databaseType == 2 ){

				$freeholds_table = "tblSuburbOwners";
				$freeholds_table_key =  $freeholds_table.".strErfPort";
				$freeholds_identity = $freeholds_table.".strIdentity";
				$mem_Table = "tblFHPropertyID";
				$mem_key = "strKey";
				$searchKey = Input::get('strKey');
			}
			if ($databaseType == 3 ){

				$freeholds_table = "tblSuburbOwners";
				$freeholds_table_key =  $freeholds_table.".strComplexNameNo";
				$freeholds_identity = $freeholds_table.".strIdentity";
				$mem_Table = "tblFHPropertyID";
				$mem_key = "strKey";
				$searchKey = Input::get('strKey');
			}




			$input = $request;

			$numErf = Input::get('numErf');
			$strIdentity = Input::get('strIdentity');
			$comment = Input::get('comment');
			$strHomePhoneNo = Input::get('strHomePhoneNo');
			$strWorkPhoneNo = Input::get('strWorkPhoneNo');
			$strCellPhoneNo = Input::get('strCellPhoneNo');
			$EMAIL = Input::get('EMAIL');

            DB::connection()->enableQueryLog();
			$result = $db->table($mem_Table)->where(  $mem_key, $searchKey)->get();



			if ($result) {


				$affected = $db->table($mem_Table)
				->where($mem_key, $searchKey)
				->update(array('memNotes' => $comment));

				$affected2 = $db->table('tblSuburbContactNumbers')
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
