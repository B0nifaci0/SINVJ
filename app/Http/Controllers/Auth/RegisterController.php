<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Shop;
use App\Municipality;
use App\State;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    public function index(){
        $states = State::all();
        $municipalities = Municipality:: all();   
        
        return view('auth/register', compact('municipalities','states'));
         
    }
        protected $redirectTo = '/home';
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        $shop= Shop::create([
            'name' => $data['name_shop'],
            'municipality_id' => $data['municipality_id'],
            'state_id' => $data['state_id'],

        ]);
        \App\User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'type_user' => $data['type_user'],
            'shop_id' => $shop->id,
            'municipality_id' =>$shop->municipality_id,
            'state_id' =>$shop->state_id,
        ]);
    }
}
