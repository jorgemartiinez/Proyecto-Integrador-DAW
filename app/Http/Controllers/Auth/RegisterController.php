<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Padre;
use App\Miembro;
use App\Monitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'password' => ['required', 'string', 'min:6', 'confirmed'],
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
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function createPadre(Request $request)
    {

        for ($i = 0; $i < 1; $i++) {
            $request[$i]['password'] = str_random(10);
            $request[$i]['username'] = generarUsername($request[$i]['nombre'], $request[$i]['apellido1'], $request[$i]['apellido2']);
            $user = User::create([
                'username' => $request[$i]['username'],
                'nombre' => $request[$i]['nombre'],
                'apellidos' => $request[$i]['apellido1'] . " " . $request[$i]['apellido2'],
                'dni' => $request[$i]['dni'],
                'fec_nac' => $request[$i]['fec_nac'],
                'estado_registro' => 1,
                'password' => Hash::make($request[$i]['password']),
            ]);

            \App::call('App\Http\Controllers\MailController@sendRegistroPadre');

            $padre = Padre::create([
                'id' => $user['id'],
                'domicilio' => $request[$i]['domicilio'],
                'email' => $request[$i]['email'],
                'telefono' => $request[$i]['telefono'],
            ]);
        }

    }

    protected function createMonitor(Request $request)
    {
        $user = User::create([
            'username' => $request->username,
            'nombre' => $request->nombre,
            'apellidos' => $request->apellido1 . $request->apellido2,
            'dni' => $request->dni,
            'fec_nac' => $request->fec_nac,
            'password' => Hash::make('secret'),
        ]);
        $miembro = Miembro::create([
            'id' => $user->id,
            'curso_escolar' => $request->curso_escolar,
            'id_padre1' => $request->id_padre1,
            'id_padre2' => User::where('dni', '=', $request->id_padre2)->first()->id,
            'id_datos_med' => 0,
            'id_nivel' => $request->id_nivel,
        ]);
        $monitor = Monitor::create([
            'id' => $user->id,
            'rango_monitor' => $request->rango_monitor,
            'domicilio' => $request->domicilio,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'id_cargo' => $request->id_cargo,
        ]);
    }
}