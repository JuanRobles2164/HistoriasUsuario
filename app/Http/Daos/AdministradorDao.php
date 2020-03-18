<?php

namespace App\Http\Daos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdministradorDao extends Controller
{
    public static function getByEmail($email){
        $usuario = DB::table('usuarios')
        ->where('e_mail', $email)
        ->first();
        return $usuario;
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
        /**Obtiene todos los usuarios
     * de un rol determinado
     */
    public static function getByRole($rol){
        $usuarios = DB::table('usuarios')
        ->where('rol_id', $rol)
        ->orderBy('estado_eliminado');
        return $usuarios;
    }

}
