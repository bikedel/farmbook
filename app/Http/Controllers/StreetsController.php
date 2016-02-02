<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
use App\helpers;


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

      if ($radio === '1'){

         // view title
       $street = Input::get('street_id');

       $streets = $db->table($freeholds_table)
       ->Join($mem_Table,$freeholds_table_key ,'=',$mem_key)
       ->Join('tblSuburbContactNumbers',$freeholds_identity,'=','tblSuburbContactNumbers.strIDNumber')
       ->orderBy('strStreetName', 'asc')
       ->orderBy('strStreetNo', 'asc')
       ->orderBy($freeholds_table.'.strKey', 'asc')
       ->select('*')
        ->groupby($freeholds_table.'.ID')
       ->where('strStreetName', $street)->paginate(100);



// format phone and currency
       
       foreach ($streets as $value) {
         $value->strHomePhoneNo = helpers::phoneFormat($value->strHomePhoneNo);
         $value->strWorkPhoneNo = helpers::phoneFormat($value->strWorkPhoneNo);
         $value->strCellPhoneNo = helpers::phoneFormat($value->strCellPhoneNo);

         $value->strAmount = helpers::currencyFormat($value->strAmount);
         $value->strBondAmount = helpers::currencyFormat($value->strBondAmount);

         $value->strSurname = str::title($value->strSurname);
         $value->strFirstName = str::title($value->strFirstName);
       }


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
       ->orderBy($freeholds_table.'.strKey', 'asc')
       ->select('*')
        ->groupby($freeholds_table.'.ID')
       ->where($freeholds_table.'.numErf', $erf)->paginate(100);


// format phone and currency
       
       foreach ($streets as $value) {
         $value->strHomePhoneNo = helpers::phoneFormat($value->strHomePhoneNo);
         $value->strWorkPhoneNo = helpers::phoneFormat($value->strWorkPhoneNo);
         $value->strCellPhoneNo = helpers::phoneFormat($value->strCellPhoneNo);

         $value->strAmount = helpers::currencyFormat($value->strAmount);
         $value->strBondAmount = helpers::currencyFormat($value->strBondAmount);

         $value->strSurname = str::title($value->strSurname);
         $value->strFirstName = str::title($value->strFirstName);
       }


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
       ->orderBy($freeholds_table.'.strKey', 'asc')
       ->select('*')
        ->groupby($freeholds_table.'.ID')
      // ->groupby('tblSuburbContactNumbers.strIDNumber')
       ->where('strIdentity', $id)->paginate(100);


// format phone and currency
       
       foreach ($streets as $value) {
         $value->strHomePhoneNo = helpers::phoneFormat($value->strHomePhoneNo);
         $value->strWorkPhoneNo = helpers::phoneFormat($value->strWorkPhoneNo);
         $value->strCellPhoneNo = helpers::phoneFormat($value->strCellPhoneNo);

         $value->strAmount = helpers::currencyFormat($value->strAmount);
         $value->strBondAmount = helpers::currencyFormat($value->strBondAmount);

         $value->strSurname = str::title($value->strSurname);
         $value->strFirstName = str::title($value->strFirstName);
       }


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
       ->orderBy($freeholds_table.'.strKey', 'asc')
       ->select('*')
        ->groupby($freeholds_table.'.ID')
       //->groupby('tblSuburbContactNumbers.strIDNumber')
       ->where('strSurname', $surname)->paginate(100);


// format phone and currency
       
       foreach ($streets as $value) {
         $value->strHomePhoneNo = helpers::phoneFormat($value->strHomePhoneNo);
         $value->strWorkPhoneNo = helpers::phoneFormat($value->strWorkPhoneNo);
         $value->strCellPhoneNo = helpers::phoneFormat($value->strCellPhoneNo);

         $value->strAmount = helpers::currencyFormat($value->strAmount);
         $value->strBondAmount = helpers::currencyFormat($value->strBondAmount);

         $value->strSurname = str::title($value->strSurname);
         $value->strFirstName = str::title($value->strFirstName);
       }



       return view('pages.streetsPrint',compact('streets','street'));


     }

     if ($radio === '5'){


         // view title
       $street = Input::get('complex');

       $streets = $db->table($freeholds_table)
       ->Join($mem_Table,$freeholds_table_key ,'=',$mem_key)
       ->Join('tblSuburbContactNumbers',$freeholds_identity,'=','tblSuburbContactNumbers.strIDNumber')
       ->orderBy($freeholds_table.'.strKey', 'asc')

       ->select('*')
        ->groupby($freeholds_table.'.ID')
       ->where($freeholds_table.'.strComplexName', $complex)->paginate(100);


// format phone and currency
       
       foreach ($streets as $value) {
         $value->strHomePhoneNo = helpers::phoneFormat($value->strHomePhoneNo);
         $value->strWorkPhoneNo = helpers::phoneFormat($value->strWorkPhoneNo);
         $value->strCellPhoneNo = helpers::phoneFormat($value->strCellPhoneNo);

         $value->strAmount = helpers::currencyFormat($value->strAmount);
         $value->strBondAmount = helpers::currencyFormat($value->strBondAmount);

         $value->strSurname = str::title($value->strSurname);
         $value->strFirstName = str::title($value->strFirstName);


       }


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
     // ->orderBy($freeholds_table.'.strKey', 'asc')
       ->orderBy(DB::raw('cast(\'strStreetNo\' as UNSIGNED )'),'ASC')
   
      
       ->select('*')
       ->groupby($freeholds_table.'.ID')
       ->where('strStreetName', $street)->paginate(1);

$len = sizeof($streets);


// format phone and currency

       foreach ($streets as $value) {
         $value->strHomePhoneNo = helpers::phoneFormat($value->strHomePhoneNo);
         $value->strWorkPhoneNo = helpers::phoneFormat($value->strWorkPhoneNo);
         $value->strCellPhoneNo = helpers::phoneFormat($value->strCellPhoneNo);

         $value->strAmount = helpers::currencyFormat($value->strAmount);
         $value->strBondAmount = helpers::currencyFormat($value->strBondAmount);

         $value->strSurname = str::title($value->strSurname);
         $value->strFirstName = str::title($value->strFirstName);
       }


       

       return view('pages.streets1',compact('streets','street','len'));


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
       ->orderBy($freeholds_table.'.strKey', 'asc')
       ->select('*')
        ->groupby($freeholds_table.'.ID')
       ->where('tblSuburbOwners.numErf', $erf)->paginate(1);


// format phone and currency
       
       foreach ($streets as $value) {
         $value->strHomePhoneNo = helpers::phoneFormat($value->strHomePhoneNo);
         $value->strWorkPhoneNo = helpers::phoneFormat($value->strWorkPhoneNo);
         $value->strCellPhoneNo = helpers::phoneFormat($value->strCellPhoneNo);

         $value->strAmount = helpers::currencyFormat($value->strAmount);
         $value->strBondAmount = helpers::currencyFormat($value->strBondAmount);

         $value->strSurname = str::title($value->strSurname);
         $value->strFirstName = str::title($value->strFirstName);
       }


       return view('pages.streets1',compact('streets','street'));


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
       ->orderBy($freeholds_table.'.strKey', 'asc')
       ->select('*')
     //  ->groupby('tblSuburbContactNumbers.strIDNumber')
       ->where('strIdentity', $id)->paginate(1);


// format phone and currency
       
       foreach ($streets as $value) {
         $value->strHomePhoneNo = helpers::phoneFormat($value->strHomePhoneNo);
         $value->strWorkPhoneNo = helpers::phoneFormat($value->strWorkPhoneNo);
         $value->strCellPhoneNo = helpers::phoneFormat($value->strCellPhoneNo);

         $value->strAmount = helpers::currencyFormat($value->strAmount);
         $value->strBondAmount = helpers::currencyFormat($value->strBondAmount);

         $value->strSurname = str::title($value->strSurname);
         $value->strFirstName = str::title($value->strFirstName);
       }


       return view('pages.streets1',compact('streets','street'));


     }

     if ($radio === '4'){


         // view title
       $street = Input::get('surname');

       $streets = $db->table($freeholds_table)
       ->Join($mem_Table,$freeholds_table_key ,'=',$mem_key)
       ->Join('tblSuburbContactNumbers',$freeholds_identity,'=','tblSuburbContactNumbers.strIDNumber')
       ->orderBy($freeholds_table.'.strKey', 'asc')
       ->select('*')
     // ->groupby('tblSuburbContactNumbers.strSurname')
       ->where('strSurname', $surname)->paginate(1);

//dd($streets->count(),$street);


// format phone and currency
       
       foreach ($streets as $value) {
         $value->strHomePhoneNo = helpers::phoneFormat($value->strHomePhoneNo);
         $value->strWorkPhoneNo = helpers::phoneFormat($value->strWorkPhoneNo);
         $value->strCellPhoneNo = helpers::phoneFormat($value->strCellPhoneNo);

         $value->strAmount = helpers::currencyFormat($value->strAmount);
         $value->strBondAmount = helpers::currencyFormat($value->strBondAmount);

         $value->strSurname = str::title($value->strSurname);
         $value->strFirstName = str::title($value->strFirstName);
       }


       return view('pages.streets1',compact('streets','street'));


     }

     if ($radio === '5'){


         // view title
       $street = Input::get('complex');

       $streets = $db->table($freeholds_table)
       ->Join($mem_Table,$freeholds_table_key ,'=',$mem_key)
       ->Join('tblSuburbContactNumbers',$freeholds_identity,'=','tblSuburbContactNumbers.strIDNumber')
       ->orderBy($freeholds_table.'.strKey', 'asc')

       ->select('*')
        ->groupby($freeholds_table.'.ID')
       ->where($freeholds_table.'.strComplexName', $complex)->paginate(1);


// format phone and currency
       
       foreach ($streets as $value) {
         $value->strHomePhoneNo = helpers::phoneFormat($value->strHomePhoneNo);
         $value->strWorkPhoneNo = helpers::phoneFormat($value->strWorkPhoneNo);
         $value->strCellPhoneNo = helpers::phoneFormat($value->strCellPhoneNo);

         $value->strAmount = helpers::currencyFormat($value->strAmount);
         $value->strBondAmount = helpers::currencyFormat($value->strBondAmount);

         $value->strSurname = str::title($value->strSurname);
         $value->strFirstName = str::title($value->strFirstName);
       }
       

       return view('pages.streets1',compact('streets','street'));


     }



   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkStreet($street)
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

      $streets = $db->table($freeholds_table)
      ->Join($mem_Table,$freeholds_table_key ,'=',$mem_key)
      ->Join('tblSuburbContactNumbers',$freeholds_identity,'=','tblSuburbContactNumbers.strIDNumber')
      ->orderBy('strStreetName', 'asc')
      ->orderBy('strStreetNo', 'asc')
      ->orderBy($freeholds_table.'.strStreetName', 'asc')
      ->orderBy($freeholds_table.'.strStreetNo', 'asc')
      ->orderBy($freeholds_table.'.strKey', 'asc')
      ->select('*')
      ->groupby($freeholds_table.'.ID')
      ->where('strStreetName', $street)->paginate(1);







// format phone and currency

      foreach ($streets as $value) {
       $value->strHomePhoneNo = helpers::phoneFormat($value->strHomePhoneNo);
       $value->strWorkPhoneNo = helpers::phoneFormat($value->strWorkPhoneNo);
       $value->strCellPhoneNo = helpers::phoneFormat($value->strCellPhoneNo);

       $value->strAmount = helpers::currencyFormat($value->strAmount);
       $value->strBondAmount = helpers::currencyFormat($value->strBondAmount);

       $value->strSurname = str::title($value->strSurname);
       $value->strFirstName = str::title($value->strFirstName);
     }




     return view('pages.streets1',compact('streets','street'));


     dd('checkgrid streetcontroller',$street);
   }



/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
public function checkComplex($street)
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

  $streets = $db->table($freeholds_table)
  ->Join($mem_Table,$freeholds_table_key ,'=',$mem_key)
  ->Join('tblSuburbContactNumbers',$freeholds_identity,'=','tblSuburbContactNumbers.strIDNumber')
  ->orderBy('strStreetName', 'asc')
  ->orderBy('strStreetNo', 'asc')
  ->orderBy($freeholds_table.'.strComplexName', 'asc')
  ->orderBy($freeholds_table.'.strComplexNo' , 'asc')
  ->orderBy($freeholds_table.'.strKey', 'asc')
  ->select('*')
   ->groupby($freeholds_table.'.ID')
  ->where($freeholds_table.'.strComplexName', $street)->paginate(1);

// format phone and currency

  foreach ($streets as $value) {
   $value->strHomePhoneNo = helpers::phoneFormat($value->strHomePhoneNo);
   $value->strWorkPhoneNo = helpers::phoneFormat($value->strWorkPhoneNo);
   $value->strCellPhoneNo = helpers::phoneFormat($value->strCellPhoneNo);

   $value->strAmount = helpers::currencyFormat($value->strAmount);
   $value->strBondAmount = helpers::currencyFormat($value->strBondAmount);

   $value->strSurname = str::title($value->strSurname);
   $value->strFirstName = str::title($value->strFirstName);
 }

 return view('pages.streets1',compact('streets','street'));


 dd('checkgrid streetcontroller',$street);
}



/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
public function checkId($street)
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

  $streets = $db->table($freeholds_table)
  ->Join($mem_Table,$freeholds_table_key ,'=',$mem_key)
  ->Join('tblSuburbContactNumbers',$freeholds_identity,'=','tblSuburbContactNumbers.strIDNumber')
  ->orderBy('strStreetName', 'asc')
  ->orderBy('strStreetNo', 'asc')
  ->orderBy($freeholds_table.'.strComplexName', 'asc')
  ->orderBy($freeholds_table.'.strComplexNo' , 'asc')
  ->orderBy($freeholds_table.'.strKey', 'asc')
  ->select('*')
  ->groupby($freeholds_table.'.ID')
  ->where($freeholds_table.'.strOwners', $street)->paginate(1);

// format phone and currency

  foreach ($streets as $value) {
   $value->strHomePhoneNo = helpers::phoneFormat($value->strHomePhoneNo);
   $value->strWorkPhoneNo = helpers::phoneFormat($value->strWorkPhoneNo);
   $value->strCellPhoneNo = helpers::phoneFormat($value->strCellPhoneNo);

   $value->strAmount = helpers::currencyFormat($value->strAmount);
   $value->strBondAmount = helpers::currencyFormat($value->strBondAmount);

   $value->strSurname = str::title($value->strSurname);
   $value->strFirstName = str::title($value->strFirstName);
 }

 return view('pages.streets1',compact('streets','street'));


 dd('checkgrid streetcontroller',$street);
}


/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
public function checkErf($street)
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

  $streets = $db->table($freeholds_table)
  ->Join($mem_Table,$freeholds_table_key ,'=',$mem_key)
  ->Join('tblSuburbContactNumbers',$freeholds_identity,'=','tblSuburbContactNumbers.strIDNumber')
  ->orderBy('strStreetName', 'asc')
  ->orderBy('strStreetNo', 'asc')
  ->orderBy($freeholds_table.'.strComplexName', 'asc')
  ->orderBy($freeholds_table.'.strComplexNo' , 'asc')
  ->orderBy($freeholds_table.'.strKey', 'asc')
  ->select('*')
  ->groupby($freeholds_table.'.ID')
  ->where($freeholds_table.'.numErf', $street)->paginate(1);

// format phone and currency

  foreach ($streets as $value) {
   $value->strHomePhoneNo = helpers::phoneFormat($value->strHomePhoneNo);
   $value->strWorkPhoneNo = helpers::phoneFormat($value->strWorkPhoneNo);
   $value->strCellPhoneNo = helpers::phoneFormat($value->strCellPhoneNo);

   $value->strAmount = helpers::currencyFormat($value->strAmount);
   $value->strBondAmount = helpers::currencyFormat($value->strBondAmount);

   $value->strSurname = str::title($value->strSurname);
   $value->strFirstName = str::title($value->strFirstName);
 }

 return view('pages.streets1',compact('streets','street'));


 dd('checkgrid streetcontroller',$street);
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

      $input = $request;


      //  dd($input);

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
        $searchKey = Input::get("strKey");
      }



      $numErf = Input::get('numErf');
      $strIdentity = Input::get('strIdentity');
      $comment = Input::get('memNotes');
      $commentNew = Input::get('memNotesNew');
      $strHomePhoneNo = Input::get('strHomePhoneNo');
      $strWorkPhoneNo = Input::get('strWorkPhoneNo');
      $strCellPhoneNo = Input::get('strCellPhoneNo');
      $EMAIL = Input::get('EMAIL');


      $result = $db->table($mem_Table)->where(  $mem_key, $searchKey)->first();




 //dd($result->memNotes,$commentNew,$user,$now,$mem_key, $searchKey,$databaseType);


      if ($result) {

        // update notes 
        if (strlen(  $commentNew) > 0 ) {
             // uers and date timestamp memNates
         $commentNew = $comment . "\r\n" .   $now  . "  " . $user . "  wrote : " . "\r\n" . $commentNew ;

         $affected = $db->table($mem_Table)
         ->where($mem_key, $searchKey)
         ->update(array('memNotes' => $commentNew,'updated_at'=> \Carbon\Carbon::now()->toDateTimeString()));
       }

       $affected2 = $db->table('tblSuburbContactNumbers')
       ->where('strIDNumber', $strIdentity)
       ->update(array('strCellPhoneNo' => $strCellPhoneNo,
        'strHomePhoneNo' => $strHomePhoneNo,
        'strWorkPhoneNo' => $strWorkPhoneNo,
        'EMAIL' => $EMAIL,
        'updated_at'=> \Carbon\Carbon::now()->toDateTimeString()
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
