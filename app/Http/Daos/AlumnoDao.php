<?php

namespace App\Http\Daos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\grupoTrabajo;
use App\usuario;

class AlumnoDao extends Controller
{
    public static function crearEquipo(grupoTrabajo $grupo, usuario $usuario){
        //Obtiene el máx id mas 1 para poder asignarlo tanto al grupo, como a la relacion n -> n
        $max_id_grupo = (int) DB::select("SELECT MAX(id)+1 as max_id from grupo_trabajo")[0]->max_id;
        $grupo->id = $max_id_grupo; 
        $SQL = "INSERT INTO grupo_trabajo(id, nombre, descripcion, estado, id_proyecto) VALUES ($max_id_grupo, '$grupo->nombre', '$grupo->descripcion', 1, $grupo->id_proyecto)";
        DB::insert($SQL);
        //Asigna un alumno 
        $SQL ="INSERT INTO grupo_usuario(id_usuario, id_grupo) VALUES($usuario->id, $max_id_grupo)";
        DB::insert($SQL);

    }
    public static function getAllRegisteredProjects($idUsuario){
        $proyectos = DB::select("SELECT p.*, m.nombre AS metodologia, u.nombres AS docente FROM proyecto p JOIN grupo_trabajo gt ON gt.id_proyecto = p.id JOIN grupo_usuario gu ON gt.id = gu.id_grupo JOIN metodologia m ON p.id_metodologia = m.id JOIN usuarios u ON u.id = p.id_usuario WHERE gu.id_usuario = $idUsuario");
        return $proyectos;
    }
    public static function buscarTeammateDisponible(){
        
    }
}
