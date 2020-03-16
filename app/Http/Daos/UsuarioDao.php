<?php

namespace App\Http\Daos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\usuario;
use App\Http\Controllers\Funciones;

class UsuarioDao extends Controller
{
    /**Obtiene todos los usuarios
     * de un rol determinado
     */
    public static function getByRole($rol){
        $usuarios = DB::table('usuarios')
        ->where('rol_id', $rol);
        return $usuarios;
    }
    /**Obtiene el usuario que posea
     * ese Id
     */
    public static function getById($id){
        $usuario = DB::table('usuarios')
        ->where('id', $id)
        ->first();
        return $usuario;
    }

    /**Registra un usuario */
    public static function registrar(usuario $usuario){
        $SQL = "INSERT INTO "
        ."usuarios(nombres, apellidos, username, contrasenia, identificacion, e_mail, rol_id) "
        ."VALUES "
        ."('$usuario->nombres', "
        ."'$usuario->apellidos', "
        ."'$usuario->username', "
        ."'$usuario->contrasenia', "
        ."'$usuario->identificacion',"
        ."'$usuario->e_mail',"
        ."'$usuario->rol_id')";
        DB::insert($SQL);
    }
    /**Verifica la existencia de un usuario 
     * en el sistema
     * Si es verídico, retorna toda su info
     * sino, retorna null
     */
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
