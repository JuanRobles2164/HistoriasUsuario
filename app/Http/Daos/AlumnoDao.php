<?php

namespace App\Http\Daos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\grupoTrabajo;
use App\usuario;
use App\fase;
use App\Http\Util\Utilities;
use stdClass;

class AlumnoDao extends Controller
{
    private static $LEIDO = true;
    private static $SIN_LEER = false;
    public static function getAllRegisteredProjects($idUsuario){
        $proyectos = DB::select("SELECT p.*, m.nombre AS metodologia, m.id AS id_metodologia, u.nombres AS docente, gt.id AS id_grupo FROM proyecto p JOIN grupo_trabajo gt ON gt.id_proyecto = p.id JOIN grupo_usuario gu ON gt.id = gu.id_grupo JOIN metodologia m ON p.id_metodologia = m.id JOIN usuarios u ON u.id = p.id_usuario WHERE gu.id_usuario = $idUsuario AND p.id_estado = 1 AND gu.fecha_fin IS NULL");
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
    public static function getFasesFromProyectoByGrupoId($id_proyecto, $id_grupo_trabajo){
        $fases = DB::table('fase')
        ->where([
            ['id_proyecto', $id_proyecto],
            ['id_grupo_trabajo', $id_grupo_trabajo]
        ])
        ->get();
        return $fases;
    }
    /**
     * Miniatura, descripcion, nombre, fecha_limite, id_proyecto, id_metodologia
     *
     * @param [type] $fase
     * @return void
     */

    public static function crearFase($fase, $id_grupo_trabajo){
        return DB::table('fase')
        ->insertGetId([
            'nombre' => $fase['nombre'],
            'descripcion' => $fase['descripcion'],
            'fecha_limite' => $fase['fecha_limite'],
            'fecha_inicio' => $fase['fecha_inicio'],
            'miniatura_fase' => $fase['miniatura_fase'],
            'id_proyecto' => $fase['id_proyecto'],
            'id_estado' => 1,
            'id_metodologia' => $fase['id_metodologia'],
            'id_grupo_trabajo' => $id_grupo_trabajo,
            'created_at' => Utilities::getCurrentDate()
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
            'fecha_inicio' => $fase['fecha_inicio'],
            'miniatura_fase' => $fase['miniatura_fase'],
            'updated_at' => Utilities::getCurrentDate()
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
            'fecha_inicio' => $modulo['fecha_inicio'],
            'fecha_limite' => $modulo['fecha_limite'],
            'created_at' => Utilities::getCurrentDate()
        ]);
    }
    public static function concluirModulo($id_modulo){
        DB::table('modulo')
        ->where('id', $id_modulo)
        ->update([
            'estado' => 'Concluido'
        ]);
    }
    public static function eliminarModulo($id_modulo){
        DB::table('modulo')
        ->where('id', $id_modulo)
        ->delete();
    }
    public static function editarModulo(array $modulo){
        DB::table('modulo')
        ->where('id', $modulo['id'])
        ->update([
            'nombre' => $modulo['nombre'],
            'descripcion' => $modulo['descripcion'],
            'fecha_inicio' => $modulo['fecha_inicio'],
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
        //$recursos = DB::select("SELECT r.*, tr.nombre as tipo_recurso FROM recurso r JOIN tipo_recurso tr ON r.id_tipo_recurso = tr.id WHERE r.id_actividad = $id_actividad");
        $recursos = DB::table('recurso')
        ->join('tipo_recurso', 'recurso.id_tipo_recurso', '=', 'tipo_recurso.id')
        ->select('recurso.*', 'tipo_recurso.nombre AS tipo_recurso')
        ->where('recurso.id_actividad',$id_actividad)
        ->get();
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
            'fecha_inicio' => $actividad['fecha_inicio'],
            'fecha_limite' => $actividad['fecha_limite'],
            'created_at' => Utilities::getCurrentDate()
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
            'updated_at' => Utilities::getCurrentDate()
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
            'updated_at' => Utilities::getCurrentDate()
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
            'created_at' => Utilities::getCurrentDate()
        ]);
    }
    public static function crearTipoRecurso(array $tipo_recurso){
        DB::table('tipo_recurso')
        ->insert([
            'nombre' => $tipo_recurso['nombre'],
            'descripcion' => $tipo_recurso['descripcion'],
            'created_at' => Utilities::getCurrentDate()
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
    public static function agregarUsuarioEntrevistado($usuario_entrevistado){
        return DB::table('usuario_entrevistado')
        ->insertGetId([
            'nombre' => $usuario_entrevistado->nombre_usuario_entrevistado,
            'e_mail' => $usuario_entrevistado->email_usuario_entrevistado,
            'telefono' => $usuario_entrevistado->telefono_usuario_entrevistado,
            'cargo' => $usuario_entrevistado->cargo_usuario_entrevistado,
            'created_at' => Utilities::getCurrentDate()
        ]);
    }
    public static function getAllUsuariosEntrevistados(){
        $usuarios_entrevistados = DB::table('usuario_entrevistado')->get();
        return $usuarios_entrevistados;
    }
    public static function crearHistoriaUsuarioGetId($historia_usuario){
        $id = DB::table('historia_usuario')
        ->insertGetId([
            'secuencia' => $historia_usuario['secuencia'],
            'nombre' => $historia_usuario['nombre'],
            'prioridad' => $historia_usuario['prioridad'],
            'id_usuario_entrevistado' => $historia_usuario['usuario_entrevistado'],
            'descripcion' => $historia_usuario['descripcion'],
            'estado' => $historia_usuario['estado'],
            'fecha_inicio' => $historia_usuario['fecha_inicio'],
            'id_actividad' => $historia_usuario['id_actividad'],
            'id_modulo' => $historia_usuario['id_modulo'],
            'fecha_fin' => $historia_usuario['fecha_fin']
        ]);
        return $id;
    }
    public static function crearCompromisosByHistoria($id_historia_usuario, $compromiso){
        DB::table('compromiso')
        ->insert([
            'descripcion' => $compromiso,
            'id_historia_usuario' => $id_historia_usuario
        ]);
    }
    public static function crearEvidencia($id_historia_usuario, $nombre, $foto){
        DB::table('evidencia')
        ->insert([
            'nombre' => $nombre,
            'foto' => $foto,
            'id_historia_usuario' => $id_historia_usuario,
            'created_at' => Utilities::getCurrentDate()
        ]);
    }
    public static function crearCriterio($id_historia_usuario, $nombre, $contexto, $evento, $resultado, $cumple){
        DB::table('criterio_aceptacion')
        ->insert([
            'nombre' => $nombre,
            'contexto' => $contexto,
            'evento' => $evento,
            'cumple' => $cumple,
            'resultado' => $resultado,
            'id_historia_usuario' => $id_historia_usuario
        ]);
    }
    public static function EncontrarGrupByIdProyecto($idProyecto, $idUsuario){
        $grupo = DB::table('grupo_trabajo')
        ->join('grupo_usuario', 'grupo_usuario.id_grupo', '=', 'grupo_trabajo.id')
        ->select('grupo_trabajo.id AS id')
        ->where('grupo_trabajo.id_proyecto',$idProyecto)
        ->where('grupo_usuario.id_usuario',$idUsuario)
        ->first();
        return $grupo;
    }
    public static function MarcarComoLeido($recurso){
        $id = $recurso['id'];
        DB::table('comentario')
        ->where('id', $id)
        ->update([
            'estado' => self::$LEIDO,
            'usuariovisto' => $recurso['id_usuario'],
            'updated_at' => Utilities::getCurrentDate()
        ]);
    }
    public static function getObservacionesV($grupo){
        $observaciones = DB::table('comentario')
        ->select('comentario AS observacion', 'created_at AS fecha')
        ->where('estado',1)
        ->where('id_grupo',$grupo)
        ->get();
        return $observaciones;
    }
    public static function getObservacionesS($grupo){
        $observaciones = DB::table('comentario')
        ->select('comentario AS observacion', 'id AS id_observacion')
        ->where('estado',0)
        ->where('id_grupo',$grupo)
        ->get();
        return $observaciones;
    }
    public static function getNotificacionesByProyecto($id_grupos){
        $notificaciones = new stdClass();
        foreach($id_grupos as $grupo){
            $notificacion = DB::table('comentario')
            ->select(DB::raw("COUNT(estado) AS estado"))
            ->where('id_grupo' ,'=',$grupo->id_grupo)
            ->where('estado', 0)
            ->get();
            $notificaciones->{$grupo->id} = $notificacion;
        }
        return $notificaciones;
    }
    public static function getHistoriaById($id){
        $historia = DB::table('historia_usuario')
        ->where('id', $id)
        ->first();
        return $historia;
    }
    public static function getCompromisosByHistoriaId($id_historia){
        $evidencias = DB::table('compromiso')
        ->where('id_historia_usuario', $id_historia)
        ->get();
        return $evidencias;
    }
    public static function getUsuariosFromHistoriaId($id_usuario){
        $usuario_entrevistado = DB::table('usuario_entrevistado')
        ->where('id', $id_usuario)
        ->first();
        return $usuario_entrevistado;
    }
    public static function getEvidenciasByHistoriaId($id_historia){
        $evidencias = DB::table('evidencia')
        ->where('id_historia_usuario', $id_historia)
        ->get();
        return $evidencias;
    }
    public static function crearFaseAgil($fase, $id_metodologia, $id_grupo_trabajo){
        $id = DB::table('fase')->insertGetId([
            'nombre' => $fase['nombre'],
            'descripcion' => $fase['descripcion'],
            'fecha_limite' => $fase['fecha_limite'],
            'fecha_inicio' => $fase['fecha_inicio'],
            'id_proyecto' => $fase['id_proyecto'],
            'id_grupo_trabajo' => $id_grupo_trabajo,
            'id_estado' => 1,
            'id_metodologia' => $id_metodologia,
            'created_at' => Utilities::getCurrentDate()
        ]);
        return $id;
    }
    public static function getMetodologiaByIdProyecto($id_proyecto){
        $metodologia = DB::table('proyecto')
        ->join('metodologia', 'metodologia.id', '=', 'proyecto.id_metodologia')
        ->select('metodologia.*')
        ->where('proyecto.id',$id_proyecto)
        ->first();
        return $metodologia;
    }
    public static function agregarModuloAgil(array $modulo){
        $id = DB::table('modulo')->insertGetId([
            'nombre' =>  $modulo['nombre'],
            'descripcion' => $modulo['descripcion'],
            'id_fase' => $modulo['id_fase'],
            'estado' => 'En desarrollo',
            'observacion' => 'Ninguna...',
            'fecha_inicio' => $modulo['fecha_inicio'],
            'fecha_limite' => $modulo['fecha_limite'],
            'created_at' => Utilities::getCurrentDate()
        ]);
        return $id;
    }
    public static function crearActividadAgil(array $actividad){
        $id = DB::table('actividad')->insertGetId([
            'nombre' => $actividad['nombre'],
            'descripcion' => $actividad['descripcion'],
            'prioridad' => $actividad['prioridad'],
            'id_modulo' => $actividad['id_modulo'],
            'estado_finalizado' => 0,
            'fecha_inicio' => $actividad['fecha_inicio'],
            'fecha_limite' => $actividad['fecha_limite'],
            'created_at' => Utilities::getCurrentDate()
        ]);
        return $id;
    }
    public static function getActividadById($id){
        $modulos = DB::table('actividad')
        ->where('id', $id)
        ->first();
        return $modulos;
    }
    public static function getCriteriosByHistoriaId($id_historia_usuario){
        return DB::table('criterio_aceptacion')
        ->where('id_historia_usuario', $id_historia_usuario)
        ->get();
    }
    public static function getUsuarioEntrevistadoById($id){
        return DB::table('usuario_entrevistado')
        ->where('id', $id)
        ->first();
    }
}
