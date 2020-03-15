<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Daos\loginDao;
use Illuminate\Support\Facades\Crypt;
use stdClass;
use App\usuario;

class Login extends Controller
{
    
    public function onGetLogin(Request $request){
        return view('Login');
    }

    public function onPostLogin(Request $request){
        $usuario = new usuario();
        $usuario->email = $request->username;
        $usuario->username = $request->username;
        $usuario->contrasenia = $request->contrasenia;

        $usuarioAuth = loginDao::validaUsuario($usuario);
        if($usuarioAuth != null){
            $time = config()->get('app')['session-time-minutes'];
            Cache::put($usuarioAuth->nombres, $usuarioAuth, $time*60);
            $_usuario = new stdClass();
            $_usuario->nombre = $usuarioAuth->nombres;
            $_usuario->token = Str::random(80);
            if($usuarioAuth->role == "SUPER_ADMIN"){
                return redirect()->route('indexAdmin')->cookie(cookie('usuario', Crypt::encrypt(json_encode($_usuario))));
            }
            if($usuarioAuth->role = "ALUMNO"){
                return redirect()->route('indexAlumno')->cookie(cookie('usuario', Crypt::encrypt(json_encode($_usuario))));
            }
            if($usuarioAuth->role = "DOCENTE"){
                return redirect()->route('indexDocente')->cookie(cookie('usuario', Crypt::encrypt(json_encode($_usuario))));
            }
            //return redirect()->route('getWelcome')->cookie(cookie('usuario', Crypt::encrypt(json_encode($_usuario))));
        }else{
            return view('Login');
        }
    }

}