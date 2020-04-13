<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Funciones;
use App\Http\Daos\UsuarioDao;
use App\usuario;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use stdClass;
use Illuminate\Http\Request;


class UsuarioController extends Controller
{
    /**Devuelve la vista de Login 
     * Restaura y elimina las cookies de sesión (usuario)
     * Inhabilita el acceso a otras partes
    */
    public function onGetLogin(Request $request){
        $cookiexd = Cookie::forget('usuario');
        return response(View('Login'))->withCookie($cookiexd);
    }
    /**Devuelve la vista de registro 
     * Sin autenticación
    */
    public function getRegistro(Request $request){
        $rol = UsuarioDao::getAlumnoRole();
        return view('Contents/Registro')->with(compact('rol'));
    }
    /**Prepara todos los datos que se necesitan de los usuarios
     * para poder registrarlos en el sistema
     */
    public function postRegistro(Request $request){
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'identificacion' => 'required|unique:usuarios,identificacion|max:50',
            'email' => 'required|unique:usuarios,e_mail|max:50',
            'contrasenia' => 'required'
        ]);
        $usuario = new usuario();
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->username = $request->identificacion;
        $usuario->email = $request->email;
        $usuario->contrasenia = Funciones::cifrarClave($request->contrasenia);
        $usuario->identificacion = $request->identificacion;
        $usuario->rol_id = $request->rol;
        $usuario->estado_eliminado = 0;
        UsuarioDao::registrar($usuario);
        $mensaje = 'Registrado de forma exitosa!';
        return back()->with(compact('mensaje'));
    }
    /**Recoje todos los datos de un usuario para poder darle
     * acceso al sistema
     * Y redirije de acuerdo a la view 
     * que le corresponda
     */
    public function onPostLogin(Request $request){
        $request->validate([
            'username' => 'required',
            'contrasenia' => 'required'
        ]);
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
            $_usuario = new stdClass();
            $_usuario->id = $usuarioAuth->id;
            $usuario->email = $usuarioAuth->e_mail;
            $_usuario->nombre = $usuarioAuth->nombres;
            $_usuario->rol = $usuarioAuth->rol;
            $_usuario->token = Str::random(80);
            Cache::put($_usuario->nombre, $_usuario, $time*60);
            return redirect()->route(strtolower($usuarioAuth->rol).'.getIndex')->cookie(cookie('usuario', Crypt::encrypt(json_encode($_usuario))));
        }else{

            return redirect('registro');
            //return redirect()->route('getLogin')->withErrors($datosErroneos, 'errorDatos');
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
