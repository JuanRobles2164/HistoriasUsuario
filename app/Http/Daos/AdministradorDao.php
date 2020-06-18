<?php

namespace App\Http\Daos;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Funciones;
use Illuminate\Support\Facades\DB;
use App\usuario;
use App\Http\Util\Utilities;

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
        $usuarios = DB::table('usuarios')
        ->orderBy('estado_eliminado')
        ->join('roles', 'usuarios.rol_id','=','roles.id')
        ->select('usuarios.*', 'roles.abreviatura')
        ->paginate(5);
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
        $usuario = AdministradorDao::getById($id);
        $usuario->username = $usuario->identificacion;
        $usuario->contrasenia = Funciones::cifrarClave($usuario->identificacion);
        DB::table('usuarios')
        ->where('id',$id)
        ->update(array('username' => $usuario->username, 'contrasenia' => $usuario->contrasenia));
        return $usuario;
    }

    /**
     * Habilita o inhabilita un usuario
     *
     * @param usuario $usuario
     * @return void
     */
    public static function eliminarUsuario(usuario $usuario){
        DB::table('usuarios')
        ->where('id',$usuario->id)
        ->update(array('eliminado_en' => Utilities::getCurrentDate(), 'estado_eliminado' => $usuario->estado_eliminado));
    }
    public static function eliminarUsuarioCascade($id){
        $users = DB::table('usuarios')
        ->join('roles', 'usuarios.rol_id', '=','roles.id')
        ->select('roles.nombre')
        ->where('usuarios.id',$id)
        ->get();
        if($users == "DOCENTE"){
            $tiene = DB::table('proyecto')
            ->where('id_usuario',$id)
            ->get();
            if($tiene->count == 0){
                DB::table('usuarios')->where('id', $id)->delete();
                return true;
            } 
            return false;        
        }elseif($users == "ALUMNO"){
            $tiene = DB::table('grupo_usuario')
            ->where('id_usuario',$id)
            ->get();
            if($tiene->count == 0){
                DB::table('usuarios')->where('id', $id)->delete();
                return true;
            } 
            return false;
        }elseif($users == "ADMIN"){
            DB::table('usuarios')->where('id', $id)->delete();
            return false;
        }
    }
}
