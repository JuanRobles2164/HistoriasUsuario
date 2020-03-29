<?php

namespace App\Http\Daos;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\usuario;
use App\proyecto;
use App\metodologia;
use App\fuente;
use stdClass;

class DocenteDao extends Controller
{
    public static function getMetodologiaById($id){
        $metodologia = DB::table('metodologia')
        ->where('id', $id)
        ->first();
        return $metodologia;
    }
    public static function getFuentesMetodologia($id_metodologia){
        $fuente = DB::table('fuente')
        ->where('id_metodologia', $id_metodologia)
        ->get();
        return $fuente;
    }
    public static function getProyectoById($id){
        $proyecto = DB::table('proyecto')
        ->where('id', $id)
        ->first();
        return $proyecto;
    }
    public static function eliminarFuenteMetodologia($id){
        $SQL = "DELETE FROM fuente WHERE id = $id";
        DB::delete($SQL);
    }
    public static function crearMetodologia(metodologia $metodologia){
        $SQL = "INSERT INTO metodologia(nombre, descripcion, estado_eliminado) VALUES ('$metodologia->nombre', '$metodologia->descripcion', 0)";
        DB::insert($SQL);
    }
    public static function agregarFuenteMetodologia($fuente){
        $SQL = "INSERT INTO fuente(url, descripcion, id_metodologia, creado_en, modificado_en) VALUES('$fuente->url', '$fuente->descripcion', $fuente->id_metodologia, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        DB::insert($SQL);
    }
    public static function eliminarMetodologia($id){
        $SQL = "UPDATE metodologia SET estado_eliminado = 1 WHERE id='$id'";
        DB::update($SQL);
    }
    public static function editarMetodologia(metodologia $metodologia){
        $SQL = "UPDATE metodologia SET nombre='$metodologia->nombre', descripcion='$metodologia->descripcion', updated_at = CURRENT_TIMESTAMP WHERE id='$metodologia->id'";
        DB::update($SQL);
    }
    public static function getAllProyectos($id_docente){
        $proyectos = DB::select("SELECT p.*,(SELECT DATEDIFF(p.fecha_limite, SYSDATE())) AS dias_restantes FROM proyecto p WHERE p.id_usuario = $id_docente ORDER BY id_estado ASC");
        return $proyectos;
    }
    public static function crearProyecto(proyecto $proyecto){
        $max_id_proyecto = DB::table('proyecto')->max('id');
        $max_id_proyecto++;
        $SQL = "INSERT INTO proyecto(id, nombre, descripcion, fecha_limite, id_usuario, id_metodologia, id_estado, created_at) VALUES($max_id_proyecto,'$proyecto->nombre', '$proyecto->descripcion', '$proyecto->fecha_limite', $proyecto->id_usuario, $proyecto->id_metodologia, $proyecto->id_estado, CURRENT_TIMESTAMP)";
        DB::insert($SQL);
        DB::insert("INSERT INTO grupo_trabajo(nombre, descripcion, estado_activo, id_proyecto) VALUES('Grupo base', 'Grupo base del proyecto; alumnos sin grupo dentro de un proyecto', 1, $max_id_proyecto)");
    }
    public static function getAllMetodologias(){
        $metodologias = DB::table('metodologia')
        ->get();
        return $metodologias;
    }
    public static function alternarEstadoProyecto(stdClass $proyecto){
        DB::update("UPDATE proyecto SET id_estado = $proyecto->id_estado WHERE id = $proyecto->id");
    }
    public static function editarProyecto(stdClass $proyecto){
        $SQL = "UPDATE proyecto SET nombre='$proyecto->nombre', descripcion='$proyecto->descripcion', fecha_limite='$proyecto->fecha_limite', updated_at=CURRENT_TIMESTAMP WHERE id=$proyecto->id";
        DB::update($SQL);
    }
    public static function getAllEstudiantesSinAsignarEnProyecto($id_proyecto){
        //Obtiene los estudiantes asignados actualmente al proyecto
        $SQL = "SELECT u.* FROM usuarios u LEFT JOIN grupo_usuario gu on u.id = gu.id_usuario LEFT JOIN grupo_trabajo gt ON gt.id = gu.id_grupo where gt.id_proyecto = 9";
        $estudiantes = DB::select($SQL);
        return $estudiantes;
    }
}
