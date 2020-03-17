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
        ->where('rol_id', $rol)
        ->orderBy('estado_eliminado');
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
    /**Obtiene el usuario 
     * asociado al correo
     */
    public static function getByEmail($email){
        $usuario = DB::table('usuarios')
        ->where('e_mail', $email)
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
