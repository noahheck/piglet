<?php

namespace App\Http\Controllers\Auth;

use App\Mail\EmailVerification;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        $timezones = implode(",", array_keys(config("piglet.timezones")));

        return Validator::make($data, [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'timezone' => 'required|in:' . $timezones,
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:' . User::MIN_PASSWORD_LENGTH . '|confirmed',
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
        $user = User::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'timezone' => $data['timezone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $pin = $user->setNewEmailVerificationPin();

        Mail::to($user)->send(new EmailVerification($user, $pin));

        return $user;
    }
}
