<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use stdClass;

class Login extends Controller
{
    
    public function onGetLogin(Request $request){
        return view('Login');
    }

    public function onPostLogin(Request $request){
        $usuario = new stdClass();
        $usuario->nombre = $request->get('nombre');
        $usuario->contrasenia = $request->get('contrasenia');
        $usuario->email = $request->get('email');
        //ESTO DEBE IR EN UN DAO
        // $usuario->contrasenia = openssl_digest($usuario->contrasenia,'SHA256');
        $usuario->contrasenia = crypt($usuario->contrasenia, '$6$rounds=100$descifremeesta$');
        $usuario->contrasenia = substr($usuario->contrasenia, 30);
        $count = DB::select("SELECT COUNT(*) AS R FROM USUARIOS WHERE (NOMBRE = '$usuario->nombre' OR  E_MAIL = '$usuario->email') AND CONTRASENIA = '$usuario->contrasenia'")[0]->R;
        if ($count == 1) {
            $usuario = DB::select("SELECT * FROM USUARIOS WHERE (NOMBRE = '$usuario->nombre' OR  E_MAIL = '$usuario->email') AND CONTRASENIA = '$usuario->contrasenia'")[0];
            $usuario->rol = DB::select("SELECT * FROM ROLES WHERE ID = $usuario->rol_id")[0];
        } else {
            $usuario = null;
        }
        $time = config()->get('app')['session-time-minutes'];
        Cache::put($usuario->nombre, $usuario, $time*60);
        $_usuario = new stdClass();
        $_usuario->nombre = $usuario->nombre;
        $_usuario->token = Str::random(80);
        return redirect()->route('getWelcome')->cookie(cookie('usuario', json_encode($_usuario)));
    }

}
