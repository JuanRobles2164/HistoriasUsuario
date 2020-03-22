<?php

namespace App\Http\Daos;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Funciones;
use Illuminate\Support\Facades\DB;
use App\usuario;

class AdministradorDao extends Controller
{
    public static function getByEmail($email){
        $usuario = DB::table('usuarios')
        ->where('e_mail', $email)
        ->first();
        return $usuario;
    }


     /**Retorna todos los usuarios
      * Estén activos o no
      */
    public static function getAllUsers(){
        $usuarios = DB::select("SELECT u.*, r.abreviatura FROM usuarios u join roles r WHERE u.rol_id=r.id ORDER BY estado_eliminado");
        return $usuarios;
    }
    /**Retorna sólo los usuarios activos
     * estado_eliminado = 0;
     */
    public static function getAllActiveUsers(){
        $usuarios = DB::table('usuarios')
        ->where('estado_eliminado', 0)
        ->get();
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
        /**Obtiene todos los usuarios
     * de un rol determinado
     */
    public static function getByRole($rol){
        $usuarios = DB::table('usuarios')
        ->where('rol_id', $rol)
        ->orderBy('estado_eliminado');
        return $usuarios;
    }
    public static function getRoles(){
        $roles = DB::table('roles')->get();
        return $roles;
    }
    public static function restaurarUsuario($id){
        $usuario = DB::table('usuarios')
        ->where('id', $id)
        ->first();
        $usuario->username = $usuario->identificacion;
        $usuario->contrasenia = Funciones::cifrarClave($usuario->identificacion);
        $SQL = "UPDATE usuarios SET username='$usuario->username', contrasenia='$usuario->contrasenia' WHERE id=$id";
        DB::update($SQL);
    }

    /**
     * Habilita o inhabilita un usuario
     *
     * @param usuario $usuario
     * @return void
     */
    public static function eliminarUsuario(usuario $usuario){
        $SQL = "UPDATE usuarios SET eliminado_en = CURRENT_TIMESTAMP, estado_eliminado = $usuario->estado_eliminado WHERE id = $usuario->id";
        DB::update($SQL);
    }

}
