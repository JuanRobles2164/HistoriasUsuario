<?php

namespace App\Http\Daos;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\usuario;
use App\proyecto;
use App\metodologia;
use App\fuente;
use App\grupo;
use App\Http\Util\Utilities;
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
        DB::table('fuente')->where('id', $id)->delete();
    }
    public static function crearMetodologia(metodologia $metodologia){
        $id = DB::table('metodologia')->insertGetId(
            array('nombre' => $metodologia->nombre, 'descripcion' => $metodologia->descripcion, 'estado_eliminado' => 0)
        );
        return $id;
    }
    public static function agregarFuenteMetodologia($fuente){
        $id = DB::table('fuente')->insertGetId(
            array('url' => $fuente->url, 'descripcion' => $fuente->descripcion, 'id_metodologia' => $fuente->id_metodologia, 'creado_en' => Utilities::getCurrentDate(), 'modificado_en' => Utilities::getCurrentDate())
        );
    }
    public static function eliminarMetodologia($id){
        DB::table('metodologia')
        ->where('id',$id)
        ->update(array('estado_eliminado' => 1));
        //$SQL = "UPDATE metodologia SET estado_eliminado = 1 WHERE id='$id'";
        //DB::update($SQL);
    }
    public static function editarMetodologia(metodologia $metodologia){
        DB::table('metodologia')
        ->where('id',$metodologia->id)
        ->update(array('nombre' => $metodologia->nombre, 'descripcion' => $metodologia->descripcion, 'updated_at' => Utilities::getCurrentDate()));
    }
    //falta ordenar los proyectos por estado
    public static function getAllProyectos($id_docente){
        $proyectos = DB::table('proyecto')
        ->where('id_usuario',$id_docente)
        ->orderBy('id_estado')
        ->select('*',DB::raw("(SELECT DATEDIFF(proyecto.fecha_limite,proyecto.fecha_inicial))AS dias_restantes"))
        ->get();
        return $proyectos;
    }
    public static function crearProyecto(proyecto $proyecto){
        $max_id_proyecto = DB::table('proyecto')->max('id');
        $max_id_proyecto++;
        DB::table('proyecto')
        ->insert(
            array('id'=>$max_id_proyecto,'nombre' => $proyecto->nombre,'descripcion' => $proyecto->descripcion,'fecha_limite' => $proyecto->fecha_limite,'fecha_inicial' => $proyecto->fecha_inicial,'id_usuario' => $proyecto->id_usuario,'id_metodologia' => $proyecto->id_metodologia,'id_estado' => $proyecto->id_estado, 'created_at' => Utilities::getCurrentDate())
        );
    }
    public static function getAllMetodologias(){
        $metodologias = DB::table('metodologia')
        ->get();
        return $metodologias;
    }
    public static function alternarEstadoProyecto(stdClass $proyecto){
        DB::table('proyecto')
        ->where('id',$proyecto->id)
        ->update(array('id_estado' => $proyecto->id_estado));
    }
    public static function editarProyecto(stdClass $proyecto){
        DB::table('proyecto')
        ->where('id', $proyecto->id)
        ->update(array('nombre' => $proyecto->nombre,'descripcion' => $proyecto->descripcion,'fecha_limite' => $proyecto->fecha_limite,'fecha_inicial' => $proyecto->fecha_inicial,'updated_at' => Utilities::getCurrentDate(),'id_metodologia' => $proyecto->id_metodologia)
        );
    }
    public static function getAllEstudiantesSinAsignarEnProyecto($request){
        //Obtiene los estudiantes asignados actualmente al proyecto
        /* Consulta antigua para obtener los estudiantes con un grupo primitivo
        */
        //$SQL = "SELECT u.* FROM usuarios u LEFT JOIN grupo_usuario gu on u.id = gu.id_usuario LEFT JOIN grupo_trabajo gt ON gt.id = gu.id_grupo WHERE u.rol_id = 2";
        //$estudiantes = DB::select($SQL);
        $model1 = DB::table('usuarios')
        ->join('roles', 'usuarios.rol_id', '=', 'roles.id')
        ->select('usuarios.*')
        ->where('roles.id','=',2)
        ->get();
        $model2 = DB::table('usuarios')
        ->join('grupo_usuario', 'usuarios.id', '=', 'grupo_usuario.id_usuario')
        ->join('grupo_trabajo', 'grupo_usuario.id_grupo', '=', 'grupo_trabajo.id')
        ->select('usuarios.*')
        ->where('grupo_trabajo.id_proyecto','=',$request->id_proyecto)
        ->whereNull('grupo_usuario.fecha_fin')
        ->get();       
        //Get the id's of first model as array
        $ids1 = $model1->pluck('id');

        //get the id's of second models as array
        $ids2 = $model2->pluck('id');
        //get the models
        $estudiantes = DB::table('usuarios')->whereIn('id',$ids1)->whereNotIn('id',$ids2)->get();
        return $estudiantes;
    }
    public static function getAllEstudiantesAsignadosAProyecto($request){
        $estudiantes = DB::table('usuarios')
        ->join('grupo_usuario', 'usuarios.id', '=', 'grupo_usuario.id_usuario')
        ->join('grupo_trabajo', 'grupo_usuario.id_grupo', '=', 'grupo_trabajo.id')
        ->select('usuarios.*')
        ->where('grupo_trabajo.id_proyecto','=',$request->id_proyecto)
        ->whereNull('grupo_usuario.fecha_fin')
        ->get();
        return $estudiantes;
    }
    public static function getGrupoPrimigenio($id_proyecto){
        $grupo = DB::table('grupo_trabajo')
        ->where('id', $id_proyecto)
        ->first();
        return $grupo;
    }
   // public static function asignarAlumnosAProyecto($request){
        
       // $SQL = "INSERT INTO usuario_proyecto_union(id_usuario, id_proyecto, created_at) VALUES ".$cadena;
       // DB::insert($SQL);
    //}
    public static function asignarAlumnosAGrupo($request){
        foreach($request->id_alumnos as $idAlumno){
            DB::table('grupo_usuario')
            ->insert(
                array('id_usuario'=>$idAlumno,'id_grupo' => $request->id_grupo,'fecha_inicio' => Utilities::getCurrentDate(),'created_at' => Utilities::getCurrentDate())
            );
        }
    }
    public static function getAllTemas(){
        $temas = DB::table('tema')->get();
        return $temas;
    }
    public static function getTemaById($id){
        $tema = DB::table('tema')
        ->where('id', $id)
        ->first();
        return $tema;
    }
    public static function getAllGrupos($id_proyecto){
        $grupos = DB::table('grupo_trabajo') 
        ->where('id_proyecto', $id_proyecto)
        ->orderBy('estado_activo')
        ->get();
        return $grupos;
    }
    public static function getIntegrantesGrupos($id_grupos){
        $integrantes = new stdClass();
        foreach($id_grupos as $id_grupo){
            $sub_integrantes = DB::table('usuarios')
            ->join('grupo_usuario', 'grupo_usuario.id_usuario', '=', 'usuarios.id')
            ->select(DB::raw("CONCAT(usuarios.nombres,' ', usuarios.apellidos) AS nombres"),'grupo_usuario.id_grupo AS grupo')
            ->where('grupo_usuario.id_grupo' ,'=',$id_grupo->id)
            ->get();
            $integrantes->{$id_grupo->id} = $sub_integrantes;
        }
        return $integrantes;
    }
    public static function crearGrupo(grupo $grupo, $id_proyecto){
        $id = DB::table('grupo_trabajo')->insertGetId(
            array('nombre' => $grupo->nombre, 'descripcion' => $grupo->descripcion, 'id_proyecto' => $id_proyecto, 'estado_activo' => 1)
        );
    }
    public static function getGrupoById($id_grupo){
        $grupo = DB::table('grupo_trabajo')
        ->where('id', $id_grupo)
        ->first();
        return $grupo;
    }
    public static function alternarEstadoGrupo(stdClass $grupo){
        DB::table('grupo_trabajo')
            ->where('id_proyecto', $grupo->id_proyecto)
            ->where('id', $grupo->id)
            ->update(array('estado_activo' => $grupo->estado_activo));
    }
    public static function asignarObservacionAAlumnos($request){
        foreach($request->id_alumnos as $idAlumno){
            DB::table('usuario_proyecto_union')
            ->insert(
                array('id_usuario'=>$idAlumno,'id_proyecto' => $request->id_proyecto,'observacion' => $request->observacion,'created_at' => Utilities::getCurrentDate())
            );
        }
        
        //$SQL = "INSERT INTO usuario_proyecto_union(id_usuario, id_proyecto, observacion, created_at) VALUES ".$cadena;
        //DB::insert($SQL);
    }
    public static function getAllHistoriasFromGrupoById($id_grupo){
        $historias = DB::table('grupo_trabajo')
        ->join('proyecto' ,'grupo_trabajo.id_proyecto' ,'=', 'proyecto.id')
        ->join('fase', 'proyecto.id', '=', 'fase.id_proyecto')
        ->join('modulo', 'fase.id', '=', 'modulo.id_fase')
        ->join('historia_usuario', 'modulo.id', '=', 'historia_usuario.id_modulo')
        ->select('historia_usuario.*')
        ->where('grupo_trabajo.id', $id_grupo)
        ->get();
        return $historias;
    }
    public static function getHistoriaById($id){
        $historia = DB::table('historia_usuario')
        ->where('id', $id)
        ->first();
        return $historia;
    }
    public static function getCompromisosByHistoriaId($id_historia){
        $compromisos = DB::table('compromiso')
        ->where('id_historia_usuario', $id_historia)
        ->get();
        return $compromisos;
    }
    public static function getEvidenciasByHistoriaId($id_historia){
        $evidencias = DB::table('evidencia')
        ->where('id_historia_usuario', $id_historia)
        ->get();
        return $evidencias;
    }
    public static function CrearObservacionGrupo($recurso){
        DB::table('comentario')
        ->insert([
            'comentario' => $recurso['comentario'],
            'id_grupo' => $recurso['id_grupo'],
            'created_at' => Utilities::getCurrentDate()
        ]);
    }
    public static function getAllHistoriasByActividadId($id_actividad){
        $historias = DB::table('historia_usuario')
        ->where('id_actividad', $id_actividad)
        ->get();
        return $historias;
    }
    public static function getLabelsToEstadoHistorias(){
        $estados = DB::table('historia_usuario')
                    ->select('estado')
                    ->distinct()
                    ->get();
        return $estados;
    }
}
