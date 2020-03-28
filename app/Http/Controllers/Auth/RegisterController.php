<?php

namespace App\Http\Controllers\Auth;

use App\Department;
use App\User;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {   
        $alias = array(
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'password' => 'Password'
        );
        $validator = Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $validator->setAttributeNames($alias);

        return $validator;


    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   
        $first_name = substr($data['fname'], 0, 1);
        $uname = strtolower($first_name. "." . $data["lname"]);
        return User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'uname' => $uname,
            'role_id' => '1',
            'department_id' => $data['department_id'],
            'password' => Hash::make($data['password']),
        ]);
    }

    
}
