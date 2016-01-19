<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Input;

use Auth;
use View;
use App\User;


class SuburbController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');


    }



   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function getSuburb()
   {

    $user = Auth::user()->name;
    $userId = Auth::user()->id;

    // user database
    $userDB = Auth::user()->suburb;


    // dynamically change database to above
    $otf = new \App\Database\OTF(['database' => $userDB]);
    $mydbconn = $otf->getConnection();


    // set connection
    $db = DB::connection($userDB);



    // check users suburbs for setting database
    $suburbs = DB::table('user_suburbs')
    ->join('suburbs',"suburbs.id" ,'=','user_suburbs.suburb_id')
    ->select("suburbs.id","name","database","type")->distinct()
    ->where('user_id',$userId)->distinct('suburbs.name')->get();


    return View::make('pages.suburb', compact('suburbs'));
}


public function setSuburb(Request $request){

 $userId = Auth::user()->id;
 $input = Input::all();
 $suburb = Input::get('suburb_id');


 // get database type
// 1 - numerf
 // 2 - numerf_portion
 //3 - complexname_complexno

  $suburb_type = DB::table('suburbs')
    ->select("type")
    ->where('database',$suburb)->get(1);

//dd($suburb,$suburb_type[0]->type);

$suburb_type =$suburb_type[0]->type;
 $user = User::find($userId);

// set database and type  for selected database in user table
 $user->suburb = $suburb;
  $user->suburb_type = $suburb_type;
 $user->save();

 return redirect('/');
}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->name;
        $userId = Auth::user()->id;


    // user database
        $userDB = Auth::user()->suburb;


    // dynamically change database to above
        $otf = new \App\Database\OTF(['database' => $userDB]);
        $mydbconn = $otf->getConnection();


    // set connection
        $db = DB::connection($userDB);



    // fetch combobox entries from database
        $streets = $db->table('tblSuburbStreetNames')->get(['strStreetName']);

        $erfs = $db->table('tblErfNumbers')->get(['numErf']);

        $ids = $db->table('tblSuburbContactNumbers')
        ->orderBy('strIDNumber')->get(['strIDNumber','strSurname']);

       $complexs = $db->table('tblSecurityComplexNames')
       ->orderBy('strComplexName')
       ->get(['strComplexName']);
         

        $surnames = $db->table('tblSuburbContactNumbers')
        ->orderBy('strSurname','desc')->distinct()->get(['strIDNumber','strSurname']);

    // check users suburbs for setting database
        $suburbs = DB::table('user_suburbs')
        ->join('suburbs',"suburbs.id" ,'=','user_suburbs.suburb_id')
        ->select("suburbs.id","name","database")->distinct()
        ->where('user_id',$userId)->distinct('suburbs.name')->get();



        return View::make('pages.home', compact('user','suburbs','streets','erfs','ids','surnames','complexs'));
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

    $user = Auth::user()->name;
    $userId = Auth::user()->id;

    // user database
    $userDB = Auth::user()->suburb;

    // check users suburbs for setting database
        $suburbs = DB::table('user_suburbs')
        ->join('suburbs',"suburbs.id" ,'=','user_suburbs.suburb_id')
        ->select("suburbs.id","name","database")->distinct()
        ->where('user_id',$userId)->distinct('suburbs.name')->get();

//dd($suburbs);

        return View::make('pages.viewsuburbs', compact('suburbs','user'));





    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
