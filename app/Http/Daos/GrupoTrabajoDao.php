<?php

namespace App\Http\Daos;

use Illuminate\Support\Facades\DB;
use stdClass;
use App\Http\Util\Utilities;

Class GrupoTrabajoDao {

    /**
     * Trae la info de un grupo
     * En base al id del usuario
     * y el id del proyecto
     * 
     * @param [int] $id_proyecto
     * @param [int] $id_usuario
     * @return 
     */
    public static function getGrupoTrabajo($id_proyecto, $id_usuario){
        $grupo_trabajo = DB::table('usuarios')
        ->join('grupo_usuario', 'grupo_usuario.id_usuario', '=', 'usuarios.id')
        ->join('grupo_trabajo', 'grupo_trabajo.id', '=', 'grupo_usuario.id_grupo')
        ->where([
            ['usuarios.id', $id_usuario],
            ['grupo_trabajo.id_proyecto', $id_proyecto]
        ])
        ->select('grupo_trabajo.*')
        ->first();
        return $grupo_trabajo;
    }
}