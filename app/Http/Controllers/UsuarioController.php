<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Funciones;
use App\Http\Daos\UsuarioDao;
use App\usuario;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Http\Daos\loginDao;
use Illuminate\Support\Facades\Crypt;
use stdClass;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function onGetLogin(Request $request){
        return view('Login');
    }
    public function index(){
        return view('Contents/Registro');
    }
    public function registrar(Request $request){
        $usuario = new usuario();
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->username = $request->identificacion;
        $usuario->email = $request->email;
        $usuario->contrasenia = Funciones::cifrarClave($request->clave);
        $usuario->identificacion = $request->identificacion;
        UsuarioDao::registrar($usuario);
        return view('AwaitingConfirmation');
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
            if($usuarioAuth->rol == "SUPER_ADMIN"){
                //No olvidar cambiarlo por indexAdmin o la vista que se le genere al admin
                //en el archivo web.php
                return redirect()->route('getWelcome')->cookie(cookie('usuario', Crypt::encrypt(json_encode($_usuario))));
            }
            if($usuarioAuth->rol = "ALUMNO"){
                return redirect()->route('indexAlumno')->cookie(cookie('usuario', Crypt::encrypt(json_encode($_usuario))));
            }
            if($usuarioAuth->rol = "DOCENTE"){
                return redirect()->route('indexDocente')->cookie(cookie('usuario', Crypt::encrypt(json_encode($_usuario))));
            }
            //return redirect()->route('getWelcome')->cookie(cookie('usuario', Crypt::encrypt(json_encode($_usuario))));
        }else{
            return view('Login');
        }
    }
}
