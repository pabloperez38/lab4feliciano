<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UsersMetadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login_index()
    {
        return view('login.index');
    }

    public function login_index_post(Request $request)
    {
        $validate = $request->validate(
            [
                'correo' => 'required|email:rfc,dns',
                'password' => 'required|min:6'
            ],
            [
               'correo.required' => 'El campo email está vacío',
               'correo.email' => 'Ingrese un email válido',
               'password.required' => 'El campo contraseña está vacío',
               'password-min' => 'La contraseña debe tener mínimo 6 caracteres'
            ]
        );
        if (Auth::attempt(['email' => $request->input('correo'), 'password' => $request->input('password')]))
        {
            $usuario = UsersMetadata::where(["users_id" => Auth::id()])->first();
            $request->session()->put('users_metadata_id', $usuario->id);
            $request->session()->put('perfiles_id', $usuario->perfiles_id);
            $request->session()->put('perfiles', $usuario->perfiles->nombre);

            return redirect()->intended('/');
        }
        else
        {
            $request->session()->put('css', 'danger');
            $request->session()->put('mensaje','Error al intentar ingresar');
            return redirect()->route('login_index');
        }
    }

    public function login_salir(Request $request){

        Auth::logout();

        $request->session()->forget('users_metadata_id');
        $request->session()->forget('perfiles_id');
        $request->session()->forget('perfiles');

        return redirect()->route('login_index');

    }
}
