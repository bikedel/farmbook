<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use App\CsvFileImporter;
use Input;
use Redirect;
use Session;
use Exception;

class CsvImportController extends BaseController
{



	public function __construct()
	{
		$this->middleware('auth');


	}


    /**
     * [POST] Form which will submit the file
     */
    public function index()
    {

           return view('pages.import'); //,compact('streets','street'));




}







    /**
     * [POST] Form which will submit the file
     */
    public function store()
    {


//dd($chost,$cuser,$cpass);

   // dd('CsvImportController  hi hi',$input);
        // Check if form submitted a file
    	if (Input::hasFile('csv_import')) {
    		$csv_file = Input::file('csv_import');
//dd('CsvImportController  hi hi',$csv_file);
            // You wish to do file validation at this point
    		if ($csv_file->isValid()) {

                // We can also create a CsvStructureValidator class
                // So that we can validate the structure of our CSV file

                // Lets construct our importer
    			$csv_importer = new CsvFileImporter();

                // Import our csv file
    			if ($csv_importer->import($csv_file) ){
                    // Provide success message to the user
    				$message = 'Your file has been successfully imported! ';
    				Session::flash('flash_message', 'Your file has been successfully imported! ' );
    				Session::flash('flash_type', 'alert-success');


    			} else {
    				$message = 'Your file did not import ';
    				Session::flash('flash_message', 'Your file did not import ');
    				Session::flash('flash_type', 'alert-danger');
    			}

    		} else {
                // Provide a meaningful error message to the user
                // Perform any logging if necessary
    			$message = 'You must provide a CSV file for import.';
    			Session::flash('flash_message', 'You must provide a CSV file for import.' );
    			Session::flash('flash_type', 'alert-danger');
    		}

    		return Redirect::back()->with('flash_message',$message);
    	}
    }
}

