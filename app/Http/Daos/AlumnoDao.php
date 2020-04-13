<?php

namespace App\Http\Daos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\grupoTrabajo;
use App\usuario;
use App\fase;

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
    public static function getProyectoById($id){
        $proyecto = DB::table('proyecto')
        ->where('id', $id)
        ->first();
        return $proyecto;
    }
    public static function getFasesFromProyecto($id_proyecto){
        $fases = DB::table('fase')
        ->where('id_proyecto', $id_proyecto)
        ->get();
        return $fases;
    }
    public static function crearFase($fase){
        DB::table('fase')
        ->insert([
            'nombre' => $fase['nombre'],
            'descripcion' => $fase['descripcion'],
            'fecha_limite' => $fase['fecha_limite'],
            'miniatura_fase' => $fase['miniatura_fase'],
            'id_proyecto' => $fase['id_proyecto'],
            'id_estado' => 1,
            'id_metodologia' => $fase['id_metodologia'],
            'created_at' => date('Y-m-d H:i:s', strtotime('now - 4 hours'))
        ]);
    }
    public static function getFaseById($id){
        $fase = DB::table('fase')
        ->where('id', $id)
        ->first();
        return $fase;
    }
    public static function editarFase($fase){
        DB::table('fase')
        ->where('id', $fase['id'])
        ->update([
            'nombre' => $fase['nombre'],
            'descripcion' => $fase['descripcion'],
            'fecha_limite' => $fase['fecha_limite'],
            'miniatura_fase' => $fase['miniatura_fase'],
            'updated_at' => date('Y-m-d H:i:s', strtotime('now - 4 hours'))
        ]);
    }
    public static function agregarEditarObjetivo(array $objetivo){
        DB::table('objetivo')
        ->updateOrInsert([
            'id_fase' => $objetivo['id_fase']
        ],[
            'nombre' => $objetivo['nombre'],
            'descripcion' => $objetivo['descripcion'],
            'id_fase' => $objetivo['id_fase']
        ]);
    }
    public static function getModuloById($id){
        $modulo = DB::table('modulo')
        ->where('id', $id)
        ->first();
        return $modulo;
    }
    public static function getModulosByFaseId($id_fase){
        $modulos = DB::table('modulo')
        ->where('id_fase', $id_fase)
        ->get();
        return $modulos;
    }
    public static function getObjetivoByFaseId($id_fase){
        $objetivo = DB::table('objetivo')
        ->where('id_fase', $id_fase)
        ->first();
        return $objetivo;
    }
    public static function agregarModulo(array $modulo){
        DB::table('modulo')
        ->insert([
            'nombre' =>  $modulo['nombre'],
            'descripcion' => $modulo['descripcion'],
            'id_fase' => $modulo['id_fase'],
            'estado' => 'En desarrollo',
            'observacion' => 'Ninguna...',
            'fecha_limite' => $modulo['fecha_limite']
        ]);
    }
    public static function editarModulo(array $modulo){
        DB::table('modulo')
        ->where('id', $modulo['id'])
        ->update([
            'nombre' => $modulo['nombre'],
            'descripcion' => $modulo['descripcion'],
            'fecha_limite' => $modulo['fecha_limite'],
        ]);
    }
    public static function getActividadesByModuloId($id_modulo){
        $actividades = DB::table('actividad')
        ->where('id_modulo', $id_modulo)
        ->get();
        return $actividades;
    }
    public static function getAllRecursosFromActividad($id_actividad){
        $recursos = DB::select("SELECT r.*, tr.nombre as tipo_recurso FROM recurso r JOIN tipo_recurso tr ON r.id_tipo_recurso = tr.id WHERE r.id_actividad = $id_actividad");
        /*DB::table('recurso')
        ->join('tipo_recurso', 'recurso.id_tipo_recurso', '=', 'tipo_recurso.id')
        ->where('recurso.id_actividad', $id_actividad)
        ->select('recurso.*', 'tipo_recurso.nombre')
        ->get();*/
        return $recursos;
    }
    public static function crearActividad(array $actividad){
        DB::table('actividad')
        ->insert([
            'nombre' => $actividad['nombre'],
            'descripcion' => $actividad['descripcion'],
            'prioridad' => $actividad['prioridad'],
            'id_modulo' => $actividad['id_modulo'],
            'estado_finalizado' => 0,
            'fecha_limite' => $actividad['fecha_limite'],
            'created_at' => date('Y-m-d H:i:s', strtotime('now - 4 hours'))
        ]);
    }
    public static function eliminarActividad($id){
        DB::table('actividad')
        ->where('id', $id)
        ->delete();
    }
    public static function entregarActividad($id){
        DB::table('actividad')
        ->where('id', $id)
        ->update([
            'estado_finalizado' => 1,
            'updated_at' => date('Y-m-d H:i:s', strtotime('now - 4 hours'))
        ]);
    }
    public static function eliminarRecurso($id){
        DB::table('recurso')
        ->where('id', $id)
        ->delete();
    }
    public static function editarRecurso(array $recurso){
        DB::table('recurso')
        ->where('id', $recurso['id'])
        ->update([
            'nombre' => $recurso['nombre'],
            'descripcion' => $recurso['descripcion'],
            'valor_unitario' => $recurso['valor_unitario'],
            'cantidad' => $recurso['cantidad'],
            'id_tipo_recurso' => $recurso['id_tipo_recurso'],
            'updated_at' => date('Y-m-d H:i:s', strtotime('now - 4 hours'))
        ]);
    }
    public static function getRecursoById($id){
        $recurso = DB::table('recurso')
        ->where('id', $id)
        ->first();
        return $recurso;
    }
    public static function crearRecurso(array $recurso){
        DB::table('recurso')
        ->insert([
            'nombre' => $recurso['nombre'],
            'descripcion' => $recurso['descripcion'],
            'valor_unitario' => $recurso['valor_unitario'],
            'cantidad' => $recurso['cantidad'],
            'id_tipo_recurso' => $recurso['id_tipo_recurso'],
            'id_actividad' => $recurso['id_actividad'],
            'created_at' => date('Y-m-d H:i:s', strtotime('now - 4 hours'))
        ]);
    }
    public static function crearTipoRecurso(array $tipo_recurso){
        DB::table('tipo_recurso')
        ->insert([
            'nombre' => $tipo_recurso['nombre'],
            'descripcion' => $tipo_recurso['descripcion'],
            'created_at' => date('Y-m-d H:i:s', strtotime('now - 4 hours'))
        ]);
    }
    public static function getTipoRecursoByRecursoId(){
        $tipos_recurso = DB::table('tipo_recurso')
        ->get();
        return $tipos_recurso;
    }
    public static function getHistoriasUsuarioByActividadId($id_actividad){
        $historias = DB::table('historia_usuario')
        ->where('id_actividad', $id_actividad)
        ->get();
        return $historias;
    }
    public static function getUsuariosFromHistorias($historias){
        
    }
    public static function agregarUsuarioEntrevistado($usuario_entrevistado){
        DB::table('usuario_entrevistado')
        ->insert([
            'nombre' => $usuario_entrevistado->nombre_usuario_entrevistado,
            'e_mail' => $usuario_entrevistado->email_usuario_entrevistado,
            'telefono' => $usuario_entrevistado->telefono_usuario_entrevistado,
            'cargo' => $usuario_entrevistado->cargo_usuario_entrevistado,
            'created_at' => date('Y-m-d H:i:s', strtotime('now - 4 hours'))
        ]);
    }
}
