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
use Exception;
use Carbon;
use App\helpers;

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
			->select('*')
			->groupby('tblSuburbContactNumbers.strIDNumber')->get();


            // formats for phone and currency
			foreach ($freehold as $value) {
				$value->strHomePhoneNo = helpers::phoneFormat($value->strHomePhoneNo);
				$value->strWorkPhoneNo = helpers::phoneFormat($value->strWorkPhoneNo);
				$value->strCellPhoneNo = helpers::phoneFormat($value->strCellPhoneNo);
				$value->strAmount = helpers::currencyFormat($value->strAmount);
				$value->strBondAmount = helpers::currencyFormat($value->strBondAmount);

				$value->strSurname = str::title($value->strSurname);
				$value->strFirstName = str::title($value->strFirstName);
			}


			$collection = collect($freehold);



			return Datatables::of( $collection)->make(true);


		}



		public function update(Request $request)
		{

            // set database
			$userDB = Auth::user()->suburb;
			$otf = new \App\Database\OTF(['database' => $userDB]);
			$db = DB::connection($userDB);


       // set user and date
			$user = Auth::user()->name;
			$now = Carbon\Carbon::now('Africa/Cairo');


            // get database type
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
			$commentNew = Input::get('memNotesNew');
			$strHomePhoneNo = Input::get('strHomePhoneNo');
			$strWorkPhoneNo = Input::get('strWorkPhoneNo');
			$strCellPhoneNo = Input::get('strCellPhoneNo');
			$EMAIL = Input::get('EMAIL');


			$result = $db->table($mem_Table)->where(  $mem_key, $searchKey)->get();



			//if ($result) {


			try{



                // update notes
				if (strlen(  $commentNew) > 0 ) {
		        // uers and date timestamp memNates
					$commentNew = $comment . "\r\n" .   $now  . "  " . $user . " wrote : " . "\r\n" . $commentNew ;

					$affected = $db->table($mem_Table)
					->where($mem_key, $searchKey)
					->update(array('memNotes' => $commentNew,'updated_at'=> \Carbon\Carbon::now()->toDateTimeString()));
				}

                // check id is passed
				if (strlen($strIdentity)) {
					$affected2 = $db->table('tblSuburbContactNumbers')
					->where('strIDNumber', $strIdentity)
					->update(array('strCellPhoneNo' => $strCellPhoneNo,
						'strHomePhoneNo' => $strHomePhoneNo,
						'strWorkPhoneNo' => $strWorkPhoneNo,
						'EMAIL' => $EMAIL,
						'updated_at'=> \Carbon\Carbon::now()->toDateTimeString()
						));
				} else {
					throw new Exception('no data passed');
				}
			}
			catch(\Exception $e){

				Session::flash('flash_message', 'Error updating '.  $numErf . "  ". $e->getMessage() );
				Session::flash('flash_type', 'alert-danger');
				return Redirect::back();
			}

			Session::flash('flash_message', 'Updated '.  $numErf );
			Session::flash('flash_type', 'alert-success');
			return Redirect::back();


		}



	}
