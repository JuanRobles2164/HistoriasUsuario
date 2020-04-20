<?php

namespace App\Http\Daos;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\usuario;
use App\proyecto;
use App\metodologia;
use App\fuente;
use App\grupo;
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
        $proyectos = DB::select("SELECT p.*,(SELECT DATEDIFF(p.fecha_limite, p.fecha_inicial)) AS dias_restantes FROM proyecto p WHERE p.id_usuario = $id_docente ORDER BY id_estado ASC");
        return $proyectos;
    }
    public static function crearProyecto(proyecto $proyecto){
        $max_id_proyecto = DB::table('proyecto')->max('id');
        $max_id_proyecto++;
        $SQL = "INSERT INTO proyecto(id, nombre, descripcion, fecha_limite, fecha_inicial, id_usuario, id_metodologia, id_estado, created_at) VALUES($max_id_proyecto,'$proyecto->nombre', '$proyecto->descripcion', '$proyecto->fecha_limite', '$proyecto->fecha_inicial' ,$proyecto->id_usuario, $proyecto->id_metodologia, $proyecto->id_estado, CURRENT_TIMESTAMP)";
        DB::insert($SQL);
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
        $SQL = "UPDATE proyecto SET nombre='$proyecto->nombre', descripcion='$proyecto->descripcion', fecha_limite='$proyecto->fecha_limite', fecha_inicio='$proyecto->fecha_inicial' updated_at=CURRENT_TIMESTAMP WHERE id=$proyecto->id";
        DB::update($SQL);
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
        ->get();
        return $estudiantes;
    }
    public static function getGrupoPrimigenio($id_proyecto){
        $grupo = DB::table('grupo_trabajo')
        ->where('id', $id_proyecto)
        ->first();
        return $grupo;
    }
    public static function asignarAlumnosAProyecto($cadena){
        $SQL = "INSERT INTO usuario_proyecto_union(id_usuario, id_proyecto, created_at) VALUES ".$cadena;
        DB::insert($SQL);
    }
    public static function asignarAlumnosAGrupo($cadena){
        $SQL = "INSERT INTO grupo_usuario(id_usuario, id_grupo, created_at) VALUES ".$cadena;
        DB::insert($SQL);
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
        ->get();
        return $grupos;
    }
    
    public static function getIntegrantesGrupos($id_grupos){
        $integrantes = new stdClass();
        foreach($id_grupos as $id_grupo){
            /*$integrante = DB::table('grupo_usuario AS gu')
            ->join('usuarios AS u', 'gu.id_usuario', '=', 'u.id')
            ->select('gu.id_grupo AS grupo','u.nombres AS nombres')
            ->where('gu.id_grupo' ,'=',$id_grupo->id)
            ->get();*/
            $sub_integrantes = DB::select("SELECT CONCAT(u.nombres, ' ', u.apellidos) as nombres, id_grupo as grupo FROM usuarios u JOIN grupo_usuario gu ON u.id = gu.id_usuario where gu.id_grupo = $id_grupo->id");
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
        //DB::update("UPDATE proyecto SET id_estado = $proyecto->id_estado WHERE id = $proyecto->id");
        DB::table('grupo_trabajo')
            ->where('id_proyecto', $grupo->id_proyecto)
            ->where('id', $grupo->id)
            ->update(array('estado_activo' => $grupo->estado_activo));
    }
    public static function asignarObservacionAAlumnos($cadena){
        $SQL = "INSERT INTO usuario_proyecto_union(id_usuario, id_proyecto, observacion, created_at) VALUES ".$cadena;
        DB::insert($SQL);
    }
}
