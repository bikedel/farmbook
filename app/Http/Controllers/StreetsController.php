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
;

class StreetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $input = Input::all();
        $suburb = Input::get('suburb_id');
        $street = Input::get('street_id');

        //dd('hellop',$suburb);
        $sub = DB::table('suburbs')
        ->select('name')
        ->find($suburb);

       //dd($sub->name);

        $userId = Auth::id();
            $user = User::find($userId);


            $user->suburb = $sub->name;
            $user->save();

            $user->touch();

        $freeholds_table = "freeholds";
        $freeholds_table_key =  $freeholds_table.".numErf";


        $streets = DB::table($freeholds_table)->Join('tblErfNumbers',$freeholds_table_key ,'=','tblErfNumbers.id')
        ->Join('tblSuburbContactNumbers','freeholds.strIdentity','=','tblSuburbContactNumbers.strIDNumber')
        ->orderBy('strStreetName', 'asc')
        ->orderBy('strStreetNo', 'asc')
        ->select('*')
        ->where('strStreetName', $street)->paginate(1);

   //     $streets = Freehold::Join('tblErfNumbers','freeholds.numErf','=','tblErfNumbers.id')
   //     ->Join('tblSuburbContactNumbers','freeholds.strIdentity','=','tblSuburbContactNumbers.strIDNumber')
   //     ->orderBy('strStreetName', 'asc')
   //     ->orderBy('strStreetNo', 'asc')
   //     ->select('*')
   //     ->where('strStreetName', $street)->paginate(1);



// dd($streets);




        //$streets->setPath(url() . '/street');
       // $streets->setPath('/street');
       //dd($streets);
        return view('pages.streets',compact('streets','street'));
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

   $input = Input::all();

        dd("got here - edit in streets controller",$id,$input);
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
