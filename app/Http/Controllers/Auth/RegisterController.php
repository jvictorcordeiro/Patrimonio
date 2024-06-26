<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Servidor;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{


    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cpf' => 'required|regex:/^[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}$/',
            'matricula' => 'required|regex:/^[0-9]{9}$/',
        ]);
    }

    public function showRegistrationForm()
    {
        $cargos = Cargo::all();
        return view('auth.register', compact('cargos'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'matricula' => $data['matricula'],
            'cpf' => $data['cpf'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->cargos()->sync($data['cargo_id']);
        $user->roles()->sync($data['role_id']);

        return $user;
    }
}
