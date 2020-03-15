<?php

namespace App\Http\Daos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;
use App\usuario;
use App\Http\Controllers\Funciones;

class loginDao extends Controller
{
    public static function validaUsuario(usuario $usuario)
    {
        $usuario->contrasenia = Funciones::cifrarClave($usuario->contrasenia);
        $contador = DB::select("SELECT COUNT(*) AS R FROM usuarios WHERE (e_mail = '$usuario->email' OR username = '$usuario->username') AND contrasenia='$usuario->contrasenia' ")[0]->R;
        if($contador){
            $usuarioQuery = DB::select("SELECT * FROM usuarios WHERE (e_mail = '$usuario->email' OR username = '$usuario->username') AND contrasenia='$usuario->contrasenia' ")[0];
            $usuarioQuery->rol = DB::select("SELECT * FROM roles where id = '$usuarioQuery->rol_id'")[0]->abreviatura;
            return $usuarioQuery;
        }
        return null;
    }
}