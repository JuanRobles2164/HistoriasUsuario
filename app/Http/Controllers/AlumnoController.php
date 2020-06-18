<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Funciones;
use App\Http\Daos\AlumnoDao;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use App\grupoTrabajo;
use App\Http\Daos\GrupoTrabajoDao;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Daos\UsuarioDao;
use App\Http\Util\Utilities;
use App\usuario;
use Exception;
use stdClass;

class AlumnoController extends Controller
{
    private $ruta = "/Contents/Alumno/";
    private static $json_result = array('result' => 'success');
    public function index(Request $request){
        return view($this->ruta.'indexAlumno');
    }
    public function getSelfEdit(Request $request){
        $usuario = UsuarioDao::getUserById( json_decode(Crypt::decrypt(Cookie::get('usuario')))->id );
        return view($this->ruta.'editPerfil')->with(compact('usuario'));
    }
    public function postSelfEdit(Request $request){
        
        $usuario = new usuario();
        $usuario->id = $request->id;
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->username = $request->username;
        $usuario->identificacion = $request->identificacion;
        $usuario->email = $request->email;
        if(strlen($request->contrasenia) <= 80){
            $usuario->contrasenia = Funciones::cifrarClave($request->contrasenia);
        }else{
            $usuario->contrasenia = $request->contrasenia;
        }
        UsuarioDao::editarUsuario($usuario);
        return redirect()->route('alumno.getIndex');
    }
    public function getListaProyectos(Request $request){
        $proyectos = AlumnoDao::getAllRegisteredProjects(json_decode(Crypt::decrypt(Cookie::get('usuario')))->id);
        $notificaciones = AlumnoDao::getNotificacionesByProyecto($proyectos);
        return View($this->ruta.'indexProyectos')->with(compact(array('proyectos','notificaciones')));
    }
    public function getFasesProyecto(Request $request){
        $proyecto = AlumnoDao::getProyectoById($request->id_proyecto);
        $usuario = Utilities::returnDecryptedCookieByName('usuario');
        $grupo_trabajo = GrupoTrabajoDao::getGrupoTrabajo($proyecto->id, $usuario->id);
        $fases = AlumnoDao::getFasesFromProyecto($proyecto->id);  
        $fases = $fases->where('id_grupo_trabajo', $grupo_trabajo->id);
        //return json_encode($fases);
        return view($this->ruta.'fasesProyecto')->with(compact(array('proyecto', 'fases')));
    }
    public function postAgregarFase(Request $request){
        $request->validate(
            [
                'nombre' => ['required'],
                'fecha_inicio' => ['required', 'after_or_equal:proyecto_fecha_inicial', 'before_or_equal:fecha_limite'],
                'fecha_limite' => ['required', 'before_or_equal:proyecto_fecha_limite', 'after_or_equal:fecha_inicio']
            ]
        );
        $fase = new stdClass();
        $fase = $request->except('_token');
        if(isset($request->miniatura_fase)){
            $fase['miniatura_fase'] = $request->file('miniatura_fase')->store('uploads', 'public');
        }else{
            $fase['miniatura_fase'] = 'uploads/terminal.png';
        }
        $usuario = Utilities::returnDecryptedCookieByName('usuario');
        $grupo_trabajo = GrupoTrabajoDao::getGrupoTrabajo($request->id_proyecto, $usuario->id);
        AlumnoDao::crearFase($fase, $grupo_trabajo->id);
        //$fase->created_at = date('Y-m-d H:i:s', strtotime('now - 4 hours'));
        return back();
    }

    public function getEditarFase(Request $request){
        $fase = AlumnoDao::getFaseById($request->id_fase);
        return json_encode($fase);
    }

    public function postEditarFase(Request $request){
        $fase = $request->except('_token', 'miniatura_hidden', 'eliminar_miniatura');
        if(isset($request->miniatura_fase)){
            $fase['miniatura_fase'] = $request->miniatura_fase;
        }else{
            $fase['miniatura_fase'] = $request->miniatura_hidden;
        }
        if(isset($request->eliminar_miniatura)){
            $fase['miniatura_fase'] = 'uploads/terminal.png';
        }
        AlumnoDao::editarFase($fase);
        return redirect()->route('alumno.getFasesProyecto', $request->id_proyecto);
    }
    public function postEditarCrearObjetivo(Request $request){
        $objetivo = $request->except('_token', 'id_proyecto');
        AlumnoDao::agregarEditarObjetivo($objetivo);
        return back();
    }
    public function getTrabajarEnFaseModulos(Request $request){
        $id_proyecto = $request->id_proyecto;
        $id_fase = $request->id_fase;
        $fase = AlumnoDao::getFaseById($id_fase);
        $modulos = AlumnoDao::getModulosByFaseId($request->id_fase);
        return view($this->ruta.'trabajarFase' , array('id_proyecto' => $id_proyecto, 'id_fase' => $id_fase, 'fase' => $fase))->with(compact(array('id_proyecto', 'id_fase', 'modulos')));
    }
    public function postCrearModulo(Request $request){
        $request->validate([
            'nombre' => 'required',
            'fecha_inicio' => ['required', 'after_or_equal:fase_fecha_inicio', 'before_or_equal:fecha_limite'],
            'fecha_limite' => ['required', 'before_or_equal:fase_fecha_limite', 'after_or_equal:fecha_inicio']
        ]);
        $modulo = $request->except('_token');
        AlumnoDao::agregarModulo($modulo);
        return back();
    }
    public function getEntregarModulo(Request $request){
        AlumnoDao::concluirModulo($request->id_modulo);
        return back();
    }
    public function getEliminarModulo(Request $request){
        try{
            AlumnoDao::EliminarModulo($request->id_modulo);
        }catch(Exception $e){

        }
        return back();
    }
    public function getEditarModulo(Request $request){
        $modulo = AlumnoDao::getModuloById($request->id_modulo);
        return json_encode($modulo);
    }
    public function postEditarModulo(Request $request){
        $request->validate([
            'nombre' => 'required',
            'fecha_inicio' => ['required', 'after_or_equal:fase_fecha_inicio', 'before_or_equal:fecha_limite'],
            'fecha_limite' => ['required', 'before_or_equal:fase_fecha_limite', 'after_or_equal:fecha_inicio']
        ]);
        $modulo = $request->except('_token', 'id_proyecto', 'id_fase');
        AlumnoDao::editarModulo($modulo);
        
        return response()->json(self::$json_result);
    }
    public function getActividadesByModulo(Request $request){
        $actividades = AlumnoDao::getActividadesByModuloId($request->id_modulo);
        $modulo = AlumnoDao::getModuloById($request->id_modulo);
        return view($this->ruta.'trabajarModulo',  
        array('id_modulo' => $request->id_modulo, 
        'id_proyecto' => $request->id_proyecto, 
        'id_fase' => $request->id_fase))
        ->with(compact('actividades', 'modulo'));
    }
    public function getRecursosByActividad(Request $request){
        $recursos = AlumnoDao::getAllRecursosFromActividad($request->id_actividad);
        $tipos_recurso = AlumnoDao::getTipoRecursoByRecursoId();
        return view($this->ruta.'indexRecursos', 
        array('id_modulo' => $request->id_modulo, 
        'id_proyecto' => $request->id_proyecto, 
        'id_fase' => $request->id_fase,
        'id_actividad' => $request->id_actividad))
        ->with(compact('recursos', 'tipos_recurso'));
    }
    public function postCrearActividad(Request $request){
        $request->validate([
            'fecha_inicio' => ['required', 'after_or_equal:modulo_fecha_inicio', 'before_or_equal:fecha_limite'],
            'fecha_limite' => ['required', 'before_or_equal:modulo_fecha_limite', 'after_or_equal:fecha_inicio'],
            'nombre' => 'required'
        ]);
        $actividad = $request->except('_token');
        AlumnoDao::crearActividad($actividad);
        return redirect()->route('alumno.getActividadesByModulo', [
            'id_proyecto' => $request->id_proyecto,
            'id_fase' => $request->id_fase,
            'id_modulo' => $request->id_modulo
        ]);
    }
    public function getEliminarActividad(Request $request){
        AlumnoDao::eliminarActividad($request->id);
        return back();
    }
    public function getEntregarActividad(Request $request){
        AlumnoDao::entregarActividad($request->id);
        return back();
    }
    public function getEliminarRecurso(Request $request){
        AlumnoDao::eliminarRecurso($request->id);
        return back();
    }
    public function getEditarRecurso(Request $request){
        $recurso = AlumnoDao::getRecursoById($request->id_recurso);
        $tipos_recursos = AlumnoDao::getTipoRecursoByRecursoId();
        $json_response = array('recurso' => $recurso, 'tipos_recursos' => $tipos_recursos);
        return json_encode($json_response);
    }
    public function postEditarRecurso(Request $request){
        $recurso = $request->all();
        AlumnoDao::editarRecurso($recurso);
        return json_encode(true);
    }
    public function getCrearRecurso(Request $request){
        $tipos_recurso = AlumnoDao::getTipoRecursoByRecursoId();
        return view($this->ruta.'crearRecurso', 
        array('id_modulo' => $request->id_modulo, 
        'id_proyecto' => $request->id_proyecto, 
        'id_fase' => $request->id_fase,
        'id_actividad' => $request->id_actividad,
        'id_recurso' => $request->id_recurso))->with(compact('tipos_recurso'));
    }
    public function postCrearRecurso(Request $request){
        $recurso = $request->except('_token');
        AlumnoDao::crearRecurso($recurso);
        return back();
    }
    public function postCrearTipoRecurso(Request $request){
        $tipo_recurso = $request->except('_token');
        AlumnoDao::crearTipoRecurso($tipo_recurso);
        return back();
    }
    public function getListarHistoriasUsuarioByActividad(Request $request){
        $historias = AlumnoDao::getHistoriasUsuarioByActividadId($request->id_actividad);
        $usuarios_entrevistados = new stdClass;
        foreach($historias as $historia){
            $usuarios_entrevistados->{$historia->id} = AlumnoDao::getUsuarioEntrevistadoById($historia->id_usuario_entrevistado);
        }
        return view($this->ruta.'ListarHistoriasUsuario', array('id_modulo' => $request->id_modulo, 
        'id_proyecto' => $request->id_proyecto, 
        'id_fase' => $request->id_fase,
        'id_actividad' => $request->id_actividad))->with(compact('historias', 'usuarios_entrevistados'));
    }
    public function getHistoriasUsuarioByActividadId(Request $request){
        $historias = AlumnoDao::getHistoriasUsuarioByActividadId($request->id_actividad);
        $usuarios_entrevistados = AlumnoDao::getAllUsuariosEntrevistados();
        $actividad = AlumnoDao::getActividadById($request->id_actividad);
        return view($this->ruta.'indexHistorias', 
        array(
            'id_modulo' => $request->id_modulo, 
            'id_proyecto' => $request->id_proyecto, 
            'id_fase' => $request->id_fase,
            'id_actividad' => $request->id_actividad))
        ->with(
            compact(
                'historias', 
                'usuarios_entrevistados', 
                'actividad'
            )
        );
    }
    public static function actividadValida(Request $request) : bool
    {
        $actividad = AlumnoDao::getActividadById($request->id_actividad);
        if($actividad->estado_finalizado == 0){
            echo '<script>alert("No puede editar una actividad una vez finalizada")</script>';
            return false;
        }
        return true;
    }
    public function postCrearUsuarioEntrevistado(Request $request){

        $request->validate([
            'nombre_usuario_entrevistado' => 'required',
            'telefono_usuario_entrevistado' => 'required',
            'email_usuario_entrevistado' => ['required', 'unique:usuario_entrevistado,e_mail'],
            'cargo_usuario_entrevistado' => 'required'
        ]);
        AlumnoDao::agregarUsuarioEntrevistado($request);
        return redirect()->route('alumno.getHistoriasUsuarioByActividadId',array('id_modulo' => $request->id_modulo, 
        'id_proyecto' => $request->id_proyecto, 
        'id_fase' => $request->id_fase,
        'id_actividad' => $request->id_actividad));
    }
    public function postCrearHistoriaUsuario(Request $request){
        $request->validate([
            'fecha_inicio' => ['required', 'after_or_equal:actividad_fecha_inicio', 'before_or_equal:fecha_fin'],
            'fecha_fin' => ['required', 'before_or_equal:actividad_fecha_fin', 'after_or_equal:fecha_inicio'],
            'descripcion' => 'required',
            'secuencia' => 'required',
            'nombre' => 'required',
            'usuario_entrevistado' => 'required',
        ]);

        $historia_usuario = new stdClass();
        $historia_usuario = $request->except('token');
        $id_historia = AlumnoDao::crearHistoriaUsuarioGetId($historia_usuario);
        foreach($historia_usuario['compromisos'] as $compromiso){
            AlumnoDao::crearCompromisosByHistoria($id_historia, $compromiso);
        }
        foreach(array_combine($request->nombre_evidencia, $request->foto_evidencia) as $nombre => $foto){
            AlumnoDao::crearEvidencia($id_historia, $nombre, $foto);
        }
        return back();
    }
    public function getListarObservacionesLyS(Request $request){
        $usuario = Utilities::returnDecryptedCookieByName('usuario');
        $grupo = AlumnoDao::EncontrarGrupByIdProyecto($request->id_proyecto, $usuario->id);
        $ob_vistas = AlumnoDao::getObservacionesV($grupo->id);
        $ob_sinver = AlumnoDao::getObservacionesS($grupo->id);
        $json_response = array('usuario' => $usuario->id,'ObS' => $ob_sinver ,'ObV' => $ob_vistas);
        return response()->json($json_response);
    }
    public function postListarObservacionesLyS(Request $request){
        $visto = $request->except('_token');
        AlumnoDao::MarcarComoLeido($visto);
        return response()->json(self::$json_result);
    }
    public function getSelectModulos(Request $request){
        $Modulos = AlumnoDao::getModulosByFaseId($request->id_fase);
        return response()->json($Modulos);
    }
    public function getSelectActividades(Request $request){
        $Actividades = AlumnoDao::getActividadesByModuloId($request->id_modulo);
        return response()->json($Actividades);
    }
    public function getCrearHistoriaUsuario(Request $request){
        $usuarios_entrevistados = AlumnoDao::getAllUsuariosEntrevistados();
        $fases = AlumnoDao::getFasesFromProyecto($request->id_proyecto);
        $usuario = Utilities::returnDecryptedCookieByName('usuario');
        $grupo_trabajo = GrupoTrabajoDao::getGrupoTrabajo($request->id_proyecto, $usuario->id);
        $fases = $fases->where('id_grupo_trabajo', $grupo_trabajo->id);
        $id_proyecto = $request->id_proyecto;
        return view($this->ruta.'CrearHistoriaUsuario')->with(compact(array('usuarios_entrevistados', 'fases','id_proyecto')));
    }
    public function postCrearUsuarioEntrevistadoAJAX(Request $request){
        $data = new stdClass;
        $data->nombre_usuario_entrevistado = $request->nombre;
        $data->email_usuario_entrevistado = $request->e_mail;
        $data->telefono_usuario_entrevistado = $request->telefono;
        $data->cargo_usuario_entrevistado = $request->cargo;
        $data->id = AlumnoDao::agregarUsuarioEntrevistado($data);
        return response()->json($data);
    }
}
