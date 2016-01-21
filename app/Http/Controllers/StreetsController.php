<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Input;
use App\Freehold;
use App\User;
use DB;
use Auth;
use Config;
use App\Database;
use Session;
use Redirect;
use Carbon;

class StreetsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');

    }



    //   2 buttons on form
    //   check action of submitted button 
    //   and call appropriate function
    //
    //   nb!  return function()

    public function checkButton()
    {

        $act = Input::get('action');

        //check which submit was clicked on
        if($act == 'View') {

         return $this->index(); 
     } 
     if($act == "Print") {

      return  $this->streetprint(); 
  }

}   




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function streetprint()
    {


       // dynamically change database
        $userDB = Auth::user()->suburb;
        $otf = new \App\Database\OTF(['database' => $userDB]);
        $db = DB::connection($userDB);

        // check database type
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
            $freeholds_table_key =  $freeholds_table.".strErfPort";
            $freeholds_identity = $freeholds_table.".strIdentity";
            $mem_Table = "tblFHPropertyID";
            $mem_key = $mem_Table.".strKey";

        }
        if ($databaseType == 3 ){

            $freeholds_table = "tblSuburbOwners";
            $freeholds_table_key =  $freeholds_table.".strComplexNameNo";
            $freeholds_identity = $freeholds_table.".strIdentity";
            $mem_Table = "tblFHPropertyID";
            $mem_key = $mem_Table.".strKey";

        }



        $input = Input::all();
        $suburb = Input::get('suburb_id');
        $street = Input::get('street_id');
        $erf = Input::get('erf');
        $id = Input::get('id');
        $surname = Input::get('surname');
        $complex = Input::get('complex');
        $radio = Input::get('optradio');

        if ($radio === '1'){

         // view title
         $street = Input::get('street_id');

         $streets = $db->table($freeholds_table)
         ->Join($mem_Table,$freeholds_table_key ,'=',$mem_key)
         ->Join('tblSuburbContactNumbers',$freeholds_identity,'=','tblSuburbContactNumbers.strIDNumber')
         ->orderBy('strStreetName', 'asc')
         ->orderBy('strStreetNo', 'asc')
         ->select('*')
         ->where('strStreetName', $street)->paginate(100);


         return view('pages.streetsPrint',compact('streets','street'));


     }

     if ($radio === '2'){


         // view title
         $street = Input::get('erf');


         $streets = $db->table($freeholds_table)
         ->Join($mem_Table,$freeholds_table_key ,'=',$mem_key)
         ->Join('tblSuburbContactNumbers',$freeholds_identity,'=','tblSuburbContactNumbers.strIDNumber')
         ->orderBy('strStreetName', 'asc')
         ->orderBy('strStreetNo', 'asc')
         ->select('*')
         ->where($freeholds_table.'.numErf', $erf)->paginate(100);

         return view('pages.streetsPrint',compact('streets','street'));


     }
     if ($radio === '3'){


         // view title
         $street = Input::get('id');


         $streets = $db->table($freeholds_table)
          ->Join($mem_Table,$freeholds_table_key ,'=',$mem_key)
         ->Join('tblSuburbContactNumbers',$freeholds_identity,'=','tblSuburbContactNumbers.strIDNumber')
         ->orderBy('strStreetName', 'asc')
         ->orderBy('strStreetNo', 'asc')
         ->select('*')
         ->where('strIdentity', $id)->paginate(100);

         return view('pages.streetsPrint',compact('streets','street'));


     }

     if ($radio === '4'){


         // view title
         $street = Input::get('surname');

         $streets = $db->table($freeholds_table)
          ->Join($mem_Table,$freeholds_table_key ,'=',$mem_key)
         ->Join('tblSuburbContactNumbers',$freeholds_identity,'=','tblSuburbContactNumbers.strIDNumber')
         ->orderBy('strStreetName', 'asc')
         ->orderBy('strStreetNo', 'asc')
         ->select('*')
         ->where('strSurname', $surname)->paginate(100);

         return view('pages.streetsPrint',compact('streets','street'));


     }

     if ($radio === '5'){


         // view title
         $street = Input::get('complex');

         $streets = $db->table($freeholds_table)
          ->Join($mem_Table,$freeholds_table_key ,'=',$mem_key)
         ->Join('tblSuburbContactNumbers',$freeholds_identity,'=','tblSuburbContactNumbers.strIDNumber')
         ->orderBy('strStreetName', 'asc')
         ->orderBy('strStreetNo', 'asc')
         ->select('*')
         ->where('tblSuburbContactNumbers.strComplexName', $complex)->paginate(100);

         return view('pages.streetsPrint',compact('streets','street'));


     }


 }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {




        // dynamically change database
        $userDB = Auth::user()->suburb;
        $otf = new \App\Database\OTF(['database' => $userDB]);
        $db = DB::connection($userDB);


        // check database type
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


        $input = Input::all();
        $suburb = Input::get('suburb_id');
        $street = Input::get('street_id');
        $erf = Input::get('erf');
        $id = Input::get('id');
        $surname = Input::get('surname');
        $complex = Input::get('complex');
        $radio = Input::get('optradio');



  // street search

        if ($radio === '1'){

         // view title
         $street = Input::get('street_id');


         $streets = $db->table($freeholds_table)
         ->Join($mem_Table,$freeholds_table_key ,'=',$mem_key)
         ->Join('tblSuburbContactNumbers',$freeholds_identity,'=','tblSuburbContactNumbers.strIDNumber')
         ->orderBy('strStreetName', 'asc')
         ->orderBy('strStreetNo', 'asc')
         ->select('*')
         ->where('strStreetName', $street)->paginate(1);



         /* type 1 working
         $streets = $db->table($freeholds_table)
         ->Join('tblErfNumbers',$freeholds_table_key ,'=','tblErfNumbers.numErf')
         ->Join('tblSuburbContactNumbers',$freeholds_identity,'=','tblSuburbContactNumbers.strIDNumber')
         ->orderBy('strStreetName', 'asc')
         ->orderBy('strStreetNo', 'asc')
         ->select('*')
         ->where('strStreetName', $street)->paginate(1);
         */


           /*/ noordhoek
           $freeholds_table = "tblSuburbOwners";
           $freeholds_table_key =  $freeholds_table.".strErfPort";
           $freeholds_identity = $freeholds_table.".strIdentity";

           $streets = $db->table($freeholds_table)
           ->Join('tblFHPropertyID','tblSuburbOwners.strErfPort' ,'=','tblFHPropertyID.strKey')
           ->Join('tblSuburbContactNumbers',$freeholds_identity,'=','tblSuburbContactNumbers.strIDNumber')
           ->orderBy('strStreetName', 'asc')
           ->orderBy('strStreetNo', 'asc')
           ->select('*')
           ->where('strStreetName', $street)->paginate(1);
            */



           return view('pages.streets2',compact('streets','street'));


       }


//  erf number search
       if ($radio === '2'){


         // view title
         $street = Input::get('erf');


         $streets = $db->table($freeholds_table)
         ->Join($mem_Table,$freeholds_table_key ,'=',$mem_key)
         ->Join('tblSuburbContactNumbers',$freeholds_identity,'=','tblSuburbContactNumbers.strIDNumber')
         ->orderBy('strStreetName', 'asc')
         ->orderBy('strStreetNo', 'asc')
         ->select('*')
         ->where('tblSuburbOwners.numErf', $erf)->paginate(1);

         return view('pages.streets2',compact('streets','street'));


     }

//  id number search
     if ($radio === '3'){


         // view title
         $street = Input::get('id');


         $streets = $db->table($freeholds_table)
          ->Join($mem_Table,$freeholds_table_key ,'=',$mem_key)
         ->Join('tblSuburbContactNumbers',$freeholds_identity,'=','tblSuburbContactNumbers.strIDNumber')
         ->orderBy('strStreetName', 'asc')
         ->orderBy('strStreetNo', 'asc')
         ->select('*')
         ->where('strIdentity', $id)->paginate(1);

         return view('pages.streets2',compact('streets','street'));


     }

     if ($radio === '4'){


         // view title
         $street = Input::get('surname');

         $streets = $db->table($freeholds_table)
         ->Join($mem_Table,$freeholds_table_key ,'=',$mem_key)
         ->Join('tblSuburbContactNumbers',$freeholds_identity,'=','tblSuburbContactNumbers.strIDNumber')
         ->select('*')
         ->where('strSurname', $surname)->paginate(1);

//dd($streets->count(),$street);

         return view('pages.streets2',compact('streets','street'));


     }

     if ($radio === '5'){


         // view title
         $street = Input::get('complex');

         $streets = $db->table($freeholds_table)
          ->Join($mem_Table,$freeholds_table_key ,'=',$mem_key)
         ->Join('tblSuburbContactNumbers',$freeholds_identity,'=','tblSuburbContactNumbers.strIDNumber')
         ->orderBy('strStreetName', 'asc')
         ->orderBy('strStreetNo', 'asc')
         ->select('*')
         ->where($freeholds_table.'.strComplexName', $complex)->paginate(1);

         return view('pages.streets2',compact('streets','street'));


     }



 }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {

        dd("edit");
    }











    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


        $input = Input::all();

       // set user and date
       $user = Auth::user()->name;
       $now = Carbon\Carbon::now('Africa/Cairo');


        // dynamic dtabase connection
        
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
            $mem_key = "numErf";
            $searchKey = Input::get('numErf');
        }
        if ($databaseType == 2 ){

            $freeholds_table = "tblSuburbOwners";
            $freeholds_table_key =  $freeholds_table.".strKey";
            $freeholds_identity = $freeholds_table.".strIdentity";
            $mem_Table = "tblFHPropertyID";
            $mem_key = "strKey";
            $searchKey = Input::get('strKey');
        }
        if ($databaseType == 3 ){

            $freeholds_table = "tblSuburbOwners";
            $freeholds_table_key =  $freeholds_table.".strKey";
            $freeholds_identity = $freeholds_table.".strIdentity";
            $mem_Table = "tblFHPropertyID";
            $mem_key = "strKey";
            $searchKey = Input::get('strKey');
        }








        $input = $request;

      //  dd($input);

        $numErf = Input::get('numErf');
        $strIdentity = Input::get('strIdentity');
        $comment = Input::get('memNotes');
        $commentNew = Input::get('memNotesNew');
        $strHomePhoneNo = Input::get('strHomePhoneNo');
        $strWorkPhoneNo = Input::get('strWorkPhoneNo');
        $strCellPhoneNo = Input::get('strCellPhoneNo');
        $EMAIL = Input::get('EMAIL');


        $result = $db->table($mem_Table)->where(  $mem_key, $searchKey)->first();


        // uers and date timestamp memNates
         $commentNew = $comment . "\r\n" .   $now  . "  " . $user . "  wrote : " . "\r\n" . $commentNew ;

 //dd($result->memNotes,$commentNew,$user,$now);


        if ($result) {

            $affected = $db->table($mem_Table)
            ->where($mem_key, $searchKey)
            ->update(array('memNotes' => $commentNew));

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
