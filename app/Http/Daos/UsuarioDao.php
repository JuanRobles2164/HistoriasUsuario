<?php

namespace App\Http\Daos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\usuario;
use App\Http\Controllers\Funciones;

class UsuarioDao extends Controller
{

    /**Obtiene el usuario 
     * asociado al correo
     */

    public static function getAllRoles(){
        $roles = DB::table('roles')->get();
        return $roles;
    }
    public static function getAlumnoRole(){
        $roles = DB::table('roles')
        ->where('abreviatura', 'alumno')
        ->first();
        return $roles;
    }
    /**Registra un usuario */
    public static function registrar(usuario $usuario){
        $SQL = "INSERT INTO "
        ."usuarios(nombres, apellidos, username, contrasenia, identificacion, e_mail, rol_id, usuario_modifica, creado_en, estado_eliminado) "
        ."VALUES "
        ."('$usuario->nombres', "
        ."'$usuario->apellidos', "
        ."'$usuario->username', "
        ."'$usuario->contrasenia', "
        ."'$usuario->identificacion',"
        ."'$usuario->email',"
        ."'$usuario->rol_id',"
        ."0,"
        ." CURRENT_TIMESTAMP,"
        ."'$usuario->estado_eliminado')";
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
    public static function editarUsuario(usuario $usuario){
        $SQL = "UPDATE usuarios "
        ."SET "
        ."nombres='$usuario->nombres', "
        ."apellidos='$usuario->apellidos', "
        ."username='$usuario->username', "
        ."contrasenia='$usuario->contrasenia', "
        ."identificacion='$usuario->identificacion', "
        ."e_mail='$usuario->email', "
        ."modificado_en=CURRENT_TIMESTAMP "
        ."WHERE id='$usuario->id' ";
        DB::update($SQL);
    }

}
