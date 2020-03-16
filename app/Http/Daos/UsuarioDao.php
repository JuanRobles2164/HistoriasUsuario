<?php

namespace App\Http\Daos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\usuario;

class UsuarioDao extends Controller
{
    public static function registrar(usuario $usuario){
        $SQL = "INSERT INTO "
        ."usuarios(nombres, apellidos, username, contrasenia, identificacion, e_mail) "
        ."VALUES "
        ."('$usuario->nombres', "
        ."'$usuario->apellidos', "
        ."'$usuario->username', "
        ."'$usuario->contrasenia', "
        ."'$usuario->identificacion',"
        ."'$usuario->e_mail')";
        DB::insert($SQL);
    }

}
