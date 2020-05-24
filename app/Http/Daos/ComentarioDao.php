<?php

namespace App\Http\Daos;

use App\Http\Util\Utilities;
use Illuminate\Support\Facades\DB;

class ComentarioDao extends Master{

    /**
     * Consulta todos los comentarios del sistema
     * @return comentarios
     */
    public static function getAllComentarios()
    {
        return DB::table('comentario')
        ->orderBy('estado', 'asc')
        ->get();
    }

    public static function getAllComentariosByUserProyectoId($id_user, $id_proyecto){
        $comentarios = DB::table('comentario')
        ->join('grupo_usuario', 'grupo_usuario.id', '=', 'comentario.grupo_usuario_id')
        ->select('comentario.*')
        ->orderBy('comentario.estado', 'asc')
        ->where('grupo_usuario.id_usuario')
        ->get();
        return $comentarios;
    }
    
}