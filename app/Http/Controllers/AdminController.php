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
use Session;
use Carbon;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDatabases()
    {
        //
        return view('admin.suburbs');
        dd('admin controller - Databases ');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUsers()
    {
        //
        return view('admin.suburbs');
        dd('admin controller - Users ');
    }




        /**
         * Process datatables ajax request.
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function anyData()
        {

            return Datatables::of(DB::table('suburbs')->select('*'))->make(true);
        }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newDatabase(Request $request)
    {



     // database fields

     $name = $request->get('name');
     $database = $request->get('database');
     $type = $request->get('type');


     // submitted form action
     $formaction = $request->get('formaction');



     // delete database
     if ($formaction == "Delete" ){
        try{
          DB::table('suburbs')->where('name', '=',$name)->delete();
        }
        catch(\Exception $e){
            // error
            Session::flash('flash_message',   $database . ' not deleted' );
            Session::flash('flash_type', 'alert-danger');
            return Redirect::back();
        }
            // success
            Session::flash('flash_message',   $database . ' has been deleted');
            Session::flash('flash_type', 'alert-success');
            return Redirect::back();
        }


        // update database
        if ($formaction == "Update" ){
            try{
             DB::table('suburbs')->where('name','=',$name)->update(
                ['name' => $name, 'database' => $database, 'type' => $type,
                 'created_at'=> \Carbon\Carbon::now()->toDateTimeString(),
                 'updated_at'=> \Carbon\Carbon::now()->toDateTimeString()
                ]);
             }
             catch(\Exception $e){
                // error
                Session::flash('flash_message',   $database . ' not updated' );
                Session::flash('flash_type', 'alert-danger');
                return Redirect::back();
            }
                // success
                Session::flash('flash_message',   $database . ' has been updated');
                Session::flash('flash_type', 'alert-success');
                return Redirect::back();
            }


        // add new database
        if ($formaction == "Add" ){
            try{
                DB::table('suburbs')->insert(
                    ['name' => $name, 'database' => $database, 'type' => $type,
                     'created_at'=> \Carbon\Carbon::now()->toDateTimeString(),
                     'updated_at'=> \Carbon\Carbon::now()->toDateTimeString()
                    ]);
            }
            catch(\Exception $e){
                //error
                Session::flash('flash_message',   $database . ' not added' );
                Session::flash('flash_type', 'alert-danger');
                return Redirect::back();
            }
                // success
                Session::flash('flash_message',   $database . ' has been added');
                Session::flash('flash_type', 'alert-success');
                return Redirect::back();
            }


        return Redirect::back();


    } // end newDatabase


}
