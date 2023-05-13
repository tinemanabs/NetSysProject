<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'birthday' => ['required', 'max:255', 'before:-18 years'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'max:255'],
            'contact_no' => ['required', 'max:255', 'unique:users'],
            'password' => ['required'],
            'confpwd' => ['required', 'same:password'],
        ], $messages = [
            'first_name.required' => 'The first name field must not be empty.',
            'last_name.required' => 'The last name field must not be empty.',
            'birthday.required' => 'The birthdate field must not be empty.',
            'birthday.before' => 'Age must be more than or equal to 18 years old.',
            'address.required' => 'The address field must not be empty.',
            'contact_no.required' => 'The contact number field must not be empty.',
            'contact_no.unique' => 'The contact number has already been taken.',
            'confpwd.required' => 'The confirm password field must not be empty.',
            'confpwd.same' => 'The confirm password and password must match.',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'birthday' => $data['birthday'],
            'email' => $data['email'],
            'address' => $data['address'],
            'contact_no' => $data['contact_no'],
            'password' => Hash::make($data['password']),
            'is_notify' => $data['is_notify'],
            'is_booked' => NULL, // confirm what data to save
            'user_role' => 2
        ]);

        //dd($data);
    }
}
