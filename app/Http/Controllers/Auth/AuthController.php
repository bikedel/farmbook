<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Redirect;
use DB;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    protected $redirectPath = '/';
    protected $loginPath = '/auth/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {



       // $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',

            'password' => 'required|confirmed|min:2',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        // get chosen databases
        $suburbs= $data['getsuburb'];

        // and its type
        $suburbType = DB::table('suburbs')->where('database', $data['suburb'])->first();

        $suburbType = $suburbType->type;
        //dd($data,$suburbType);

        // create the user
        // set default suburb and type
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'suburb' => $data['suburb'],
            'suburb_type' => $suburbType,
            'password' => bcrypt($data['password']),
            ]);
 
        // get user id
        $usersid = DB::table('users')->where('email', $data['email'])->first();
        $usersid = $usersid->id ;


        // add databases for user
        foreach ($suburbs as $value) {
            DB::table('user_suburbs')->insertGetId(
                ['user_id' => $usersid, 'suburb_id' => $value]
                );

        }

      

        return $user;

    }



    function postLogin(Request $request){


 //log in the user



      $credentials = [
        'email' => trim($request->get('email')),
       'password' => trim($request->get('password'))
     ];

      $remember = $request->has('remember');

       if (\Auth::attempt($credentials, $remember)){

           return redirect()->intended('/');
    }

        //show error if invalid data entered
       return redirect()->back()->withErrors('Login/Pass do not match')->withInput();

    }
}
