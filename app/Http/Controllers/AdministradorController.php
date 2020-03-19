<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Daos\AdministradorDao;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Contracts\Encryption\Encrypter;
use App\usuario;
use App\Http\Daos\UsuarioDao;
use App\Http\Controllers\Funciones;

class AdministradorController extends Controller
{
    public function index(Request $request){
        return view('Contents/Admin/indexAdmin');
    }
    public function getCreate(Request $request){
        $roles = AdministradorDao::getRoles();
        return view('Contents/Admin/crearUsuario')->with(compact('roles'));
    }
    public function postCreate(Request $request){
        $usuario = new usuario();
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->username = $request->identificacion;
        $usuario->email = $request->email;
        $usuario->contrasenia = Funciones::cifrarClave($request->clave);
        $usuario->identificacion = $request->identificacion;
        $usuario->rol_id = $request->rol;
        $usuario->usuario_modifica = 0;
        $usuario->estado_eliminado = 0;
        UsuarioDao::registrar($usuario);
        return view('Contents/Admin/indexAdmin');
    }
    public function getListUsuarios(){
        $usuarios = AdministradorDao::getAllUsers();
        return view('Contents/Admin/listaUsuarios')->with(compact('usuarios'));
    }
    public function getEditar(Request $request){
        //return $request->id[3];
        $usuario = AdministradorDao::getById($request->id);
        return view('Contents/Admin/editUsuario')->with(compact('usuario'));
    }
    public function postEditar(Request $request){
        $usuario = new usuario();
        $usuario->id = $request->id;
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->username = $request->username;
        $usuario->identificacion = $request->identificacion;
        $usuario->email = $request->email;
        if(strlen($request->contrasenia) <= 80){
            $usuario->contrasenia = Funciones::cifrarClave($request->contrasenia);
        }else{
            $usuario->contrasenia = $request->contrasenia;
        }
        
        UsuarioDao::editarUsuario($usuario);
        return redirect()->route('admin.getListUsuarios');
    }
}
