<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use App\Notifications\RegisteredUser;

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

     use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        $user->notify(new RegisteredUser());

        return redirect('/login')->with('success', 'Votre compte a été crée, veuillez le confimer avec votre email');
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
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
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
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'verifyToken' => Str::random(40),
        ]);
    }

    public function confirm($id, $verifyToken)
    {
        $user = User::where('id', $id)->where('verifyToken', $verifyToken)->first();
        if($user){
            $user->update(['verifyToken' => null]);
            $this->guard()->login($user);
            return redirect($this->redirectPath())->with('success', 'Votre compte a été valider, Merci !');
        } else {
            redirect('/login')->with('error', "Ce lien n'est plus valide.");
        }
    }
}
