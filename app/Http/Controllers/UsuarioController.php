<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Funciones;
use App\Http\Daos\UsuarioDao;
use App\usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
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
}
