<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Funciones;
use App\Http\Daos\UsuarioDao;
use App\usuario;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use stdClass;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**Devuelve la vista de Login */
    public function onGetLogin(Request $request){
        return view('Login');
    }
    /**Devuelve la vista de registro */
    public function getRegistro(Request $request){
        $roles = UsuarioDao::getAllRoles();
        return view('Contents/Registro')->with(compact('roles'));
    }
    /**Prepara todos los datos que se necesitan de los usuarios
     * para poder registrarlos en el sistema
     */
    public function registrar(Request $request){
        $usuario = new usuario();
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->username = $request->identificacion;
        $usuario->email = $request->email;
        $usuario->contrasenia = Funciones::cifrarClave($request->clave);
        $usuario->identificacion = $request->identificacion;
        $usuario->rol_id = $request->rol;
        UsuarioDao::registrar($usuario);
        return back();
    }
    /**Recoje todos los datos de un usuario para poder darle
     * acceso al sistema
     * Y redirije de acuerdo a la view 
     * que le corresponda
     */
    public function onPostLogin(Request $request){
        $usuario = new usuario();
        $usuario->email = $request->username;
        $usuario->username = $request->username;
        $usuario->contrasenia = $request->contrasenia;

        $usuarioAuth = UsuarioDao::validaUsuario($usuario);
        if($usuarioAuth != null){
            if($usuarioAuth->estado_eliminado == 1){
                //No olvidar hacer la vista para cuando una cuenta esté deshabilitada
                return redirect()->route('getLogin');
            }
            $time = config()->get('app')['session-time-minutes'];
            Cache::put($usuarioAuth->nombres, $usuarioAuth, $time*60);
            $_usuario = new stdClass();
            $_usuario->id = $usuarioAuth->id;
            $usuario->email = $usuarioAuth->e_mail;
            $_usuario->nombre = $usuarioAuth->nombres;
            $_usuario->token = Str::random(80);
            if($usuarioAuth->rol == "SUPER_ADMIN"){
                //No olvidar cambiarlo por indexAdmin o la vista que se le genere al admin
                //en el archivo web.php
                return redirect()->route('admin.getIndex')->cookie(cookie('usuario', Crypt::encrypt(json_encode($_usuario))));
            }
            if($usuarioAuth->rol == "ALUMNO"){
                return redirect()->route('alumno.getIndex')->cookie(cookie('usuario', Crypt::encrypt(json_encode($_usuario))));
            }
            if($usuarioAuth->rol == "DOCENTE"){
                return redirect()->route('docente.getIndex')->cookie(cookie('usuario', Crypt::encrypt(json_encode($_usuario))));
            }
            //return redirect()->route('getWelcome')->cookie(cookie('usuario', Crypt::encrypt(json_encode($_usuario))));
        }else{
            return view('Login');
        }
    }
    public function editar(Request $request){
        $usuario = new usuario();
        $usuario->id = $request->id;
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->identificacion = $request->identificacion;
        $usuario->email = $request->email;
        $usuario->username = $request->username;
        $usuario->contrasenia = Funciones::cifrarClave($request->contrasenia);
        UsuarioDao::editarUsuario($usuario);
        return back();
    }
}
