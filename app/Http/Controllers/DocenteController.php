<?php

namespace App\Http\Controllers;

use App\fase;
use Illuminate\Http\Request;
use App\Http\Daos\DocenteDao;
use App\Http\Controllers\Funciones;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use App\metodologia;
use App\proyecto;
use App\Http\Daos\UsuarioDao;
use App\usuario;
use App\fuente;
use stdClass;
use App\grupo;
use App\Http\Daos\AlumnoDao;
use App\Http\Util\Utilities;
use Exception;

class DocenteController extends Controller
{
    private $ruta ='/Contents/Docente/';
    private static $FINALIZADO = 1;
    private static $EN_PROCESO = 0;
    public function getEditar(Request $request){

    }
    public function index(Request $request){
        return view($this->ruta.'indexDocente');
    }
    public function getViewListaTemas(){
        $temas = DocenteDao::getAllTemas();
        return view($this->ruta.'listaTopics')->with(compact('temas'));
    }
    public function getListaTemas(Request $request){
        $temaEdit = null;
        if(isset($request->id)){
            $temaEdit = DocenteDao::getTemaById($request->id);
        }
        return $this->getViewListaTemas()->with(compact('temaEdit'));
    }
    public function getCrearMetodologia(Request $request){
        return view($this->ruta.'crearMetodologia');
    }
    public function getSelfEdit(Request $request){
        $cookie_docente = Utilities::returnDecryptedCookieByName('usuario');
        $usuario = UsuarioDao::getUserById($cookie_docente->id);
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
        return redirect()->route('docente.getIndex');
    }
    public function postCrearMetodologia(Request $request){
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required'
        ]);
        $metodologia = new metodologia();
        $metodologia->nombre = $request->nombre;
        $metodologia->descripcion = $request->descripcion;
        DocenteDao::crearMetodologia($metodologia);
        return redirect()->route('docente.getListaMetodologias');
    }
    public function getListaMetodologias(){
        $metodologias = DocenteDao::getAllMetodologias();
        return view($this->ruta.'listaMetodologias')->with(compact('metodologias'));
    }
    public function getEditarMetodologia(Request $request){
        $metodologia = DocenteDao::getMetodologiaById($request->id);
        $fuentes = Docentedao::getFuentesMetodologia($metodologia->id);
        return View($this->ruta.'editarMetodologia')->with(compact('metodologia', 'fuentes'));
    }
    public function postEditarMetodologia(Request $request){
        $metodologia = new metodologia();
        $metodologia->id = $request->id;
        $metodologia->nombre = $request->nombre;
        $metodologia->descripcion = $request->descripcion;
        DocenteDao::editarMetodologia($metodologia);
        return redirect()->route('docente.getListaMetodologias');
    }
    /**
     * Posiblemente vaya a funcionar con AJAX
     *
     * @param [type] $id_metodologia
     * @return void
     */
    public function agregarFuenteMetodologiaAJAX(Request $request){
        $fuente = new stdClass();
        $fuente->descripcion = $request->descripcion_fuente;
        $fuente->url = $request->url_fuente;
        $fuente->id_metodologia = $request->id_metodologia;

        DocenteDao::agregarFuenteMetodologia($fuente);
        return redirect()->route('docente.getEditarMetodologia', 'id='.$request->id_metodologia);
    }
    public function eliminarFuenteMetodologia(Request $request){
        DocenteDao::eliminarFuenteMetodologia($request->id);
        return back();
    }
    public function eliminarMetodologia(Request $request){
        DocenteDao::eliminarMetodologia($request->id);
        return back();
    }
    /**
     * Traerá sólo los proyectos que le pertenezcan a ese docente
     * pues, los que haya creado
     * @param Request $request
     * @return void
     */
    public function getListaProyectos(Request $request){
        $cookie_docente = Utilities::returnDecryptedCookieByName('usuario');
        $proyectos = DocenteDao::getAllProyectos($cookie_docente->id);
        return View($this->ruta.'listarProyectos')->with(compact('proyectos'));
    }
    public function getCrearProyecto(Request $request){
        $metodologias = DocenteDao::getAllMetodologias();
        return View($this->ruta.'crearProyecto')->with(compact('metodologias'));
    }
    public function postCrearProyecto(Request $request){
        $request->validate([
            'nombre' => 'required',
            'fecha_inicial' => ['required', 'before_or_equal:fecha_limite', 'after_or_equal:now'],
            'fecha_limite' => ['required', 'after_or_equal:fecha_inicial']
        ]);
        $cookie_docente = Utilities::returnDecryptedCookieByName('usuario');
        $proyecto = new proyecto();
        $proyecto->nombre = $request->nombre;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->fecha_inicial = $request->fecha_inicial;
        $proyecto->fecha_limite = $request->fecha_limite;
        $proyecto->id_metodologia = $request->id_metodologia;
        $proyecto->id_usuario = $cookie_docente->id;
        $proyecto->id_estado = $request->id_estado;
        DocenteDao::crearProyecto($proyecto);
        return redirect()->route('docente.getListaProyectos');
    }
    public function getAlternarEstadoProyecto(Request $request){
        $proyecto = new stdClass();
        $proyecto->id = $request->id;
        $proyecto->id_estado = $request->id_estado == 1 ? 2 : 1;
        DocenteDao::alternarEstadoProyecto($proyecto);
        return redirect()->route('docente.getListaProyectos');
    }
    public function getEditarProyecto(Request $request){
        $metodologias = DocenteDao::getAllMetodologias();
        $proyecto = DocenteDao::getProyectoById($request->id);
        $proyecto->fecha_inicial = date("Y-m-d", strtotime($proyecto->fecha_inicial));
        return view($this->ruta.'editarProyecto')->with(compact(array('proyecto','metodologias')));
    }
    public function postEditarProyecto(Request $request){
        $request->validate([
            'nombre' => 'required',
            'fecha_inicial' => ['required', 'before_or_equal:fecha_limite'],
            'fecha_limite' => ['required', 'after_or_equal:fecha_inicial']
        ]);
        $proyecto = DocenteDao::getProyectoById($request->id);
        $proyecto->nombre = $request->nombre;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->fecha_inicial = $request->fecha_inicial;
        $proyecto->fecha_limite = $request->fecha_limite;
        $proyecto->id_metodologia = $request->id_metodologia;
        DocenteDao::editarProyecto($proyecto);
        return redirect()->route('docente.getListaProyectos');
    }
    protected static function calcularPorcentajeGrupo($id_grupo, $id_proyecto){
        $acumulado = 0.0;
        $fases = AlumnoDao::getFasesFromProyectoByGrupoId($id_proyecto, $id_grupo);
        $cantidad_fases = $fases->count();
        if($cantidad_fases == 0){
            $peso_fase = 0;
        }else{
            $peso_fase = (float)(100.0/(float)($fases->count()));
        }
        $modulos = [];
        $peso_modulo = new stdClass;
        $cantidad_modulos_fase = 0;
        $actividades = [];
        $peso_actividades_modulo = new stdClass;
        foreach($fases as $fase){
            $modulosQuery = AlumnoDao::getModulosByFaseId($fase->id);
            array_push($modulos, $modulosQuery);
            $cantidad_modulos = (float)$modulosQuery->count();
            if($cantidad_modulos == 0){
                $peso_modulo->{$fase->id} = 0.0;
            }else{
                $peso_modulo->{$fase->id} = (float)($peso_fase / $cantidad_modulos);
            }
        }
        foreach($modulos as $modulos_array){
            foreach($modulos_array as $modulo){
                $actividades_modulo = AlumnoDao::getActividadesByModuloId($modulo->id);
                array_push($actividades, $actividades_modulo);
                $cantidad_actividades = (float) $actividades_modulo->count();
                if($cantidad_actividades == 0){
                    $peso_actividades_modulo->{$modulo->id} = 0.0;
                }else{
                    $peso_actividades_modulo->{$modulo->id} = (float) $peso_modulo->{$modulo->id_fase} /(float) $cantidad_actividades;
                }
            }
        }
        foreach($actividades as $actividades_array){
            foreach($actividades_array as $actividad){
                if($actividad->estado_finalizado == self::$FINALIZADO){
                    $acumulado = $acumulado + $peso_actividades_modulo->{$actividad->id_modulo};
                }
            }
        }
        return $acumulado;
    }
    /**
     * Esta función deberá devolverle a la vista:
     * - Los alumnos que no estén ligados a un proyecto
     * - Los grupos que han trabajado en el proyecto
     * - Los grupos que estén ligados al proyecto pero no han trabajado
     * - El porcentaje de trabajo avanzado por grupo
     * - La última fase trabajada por ese grupo
     * - La última actividad trabajada por el grupo
     * @param Request $request
     * @return mixed
     */

     //Funciones del controlador para los grupos de los proyectos
    public function getListaGrupos(Request $request){
        $proyecto = DocenteDao::getProyectoById($request->id_proyecto);
        $grupos = DocenteDao::getAllGrupos($request->id_proyecto);
        $integrantes = DocenteDao::getIntegrantesGrupos($grupos);
        $variables = array('proyecto','grupos', 'integrantes');
        $progreso_grupo = new stdClass;
        foreach($grupos as $grupo){
            $progreso_grupo->{$grupo->id} = self::calcularPorcentajeGrupo($grupo->id, $request->id_proyecto);
        }
        //return json_encode($integrantes);
        return view($this->ruta.'listarGrupos')->with(compact(array('proyecto','grupos', 'integrantes', 'progreso_grupo')));
    }
    public function getCrearGrupo(Request $request){
        $proyecto = DocenteDao::getProyectoById($request->id_proyecto);
        return view($this->ruta.'crearGrupo')->with(compact('proyecto'));
    }
    public function postCrearGrupo(Request $request){
        $request->validate([
            'nombre' => 'required',
        ]);
        $grupo = new grupo();
        $grupo->nombre = $request->nombre;
        $grupo->descripcion = $request->descripcion;
        DocenteDao::crearGrupo($grupo, $request->id_proyecto);
        return redirect()->route('docente.getListaGrupos', $request->id_proyecto);
    }
    public function getAsignarAlumnoGrupo(Request $request){
        $proyecto = DocenteDao::getProyectoById($request->id_proyecto);
        $grupo = DocenteDao::getGrupoById($request->id_grupo);
        $alumnos = DocenteDao::getAllEstudiantesSinAsignarEnProyecto($request);
        return view($this->ruta.'añadirPersonasAGrupo')->with(compact(array('proyecto', 'alumnos','grupo')));
    }
    public function postAsignarAlumnoGrupo(Request $request){
        DocenteDao::asignarAlumnosAGrupo($request);
        return redirect()->route('docente.getListaGrupos', $request->id_proyecto);
    }
    public function getAlternarEstadoGrupo(Request $request){
        $grupo= new stdClass();
        $grupo->id = $request->id;
        $grupo->id_proyecto = $request->id_proyecto;
        $grupo->estado_activo = $request->id_estado == 1 ? 2 : 1;
        DocenteDao::alternarEstadoGrupo($grupo);
        return redirect()->route('docente.getListaGrupos', $request->id_proyecto);
    }
    public function getObservacionAlumnosProyecto(Request $request){
        $proyecto = DocenteDao::getProyectoById($request->id_proyecto);
        $alumnos = DocenteDao::getAllEstudiantesAsignadosAProyecto($request);
        return view($this->ruta.'observacionAlumnosProyecto')->with(compact(array('proyecto', 'alumnos')));
    }
    public function postObservacionAlumnosProyecto(Request $request){
        DocenteDao::asignarObservacionAAlumnos($request);
        return redirect()->route('docente.getListaGrupos', $request->id_proyecto);
    }
    public function getDetallesHistoria(Request $request){
        $historia = DocenteDao::getHistoriaById($request->id_historia);
        $evidencias = DocenteDao::getEvidenciasByHistoriaId($historia->id);
        $compromisos = DocenteDao::getCompromisosByHistoriaId($historia->id);
        return view($this->ruta.'supervisarHistoriasGrupo');
    }
    public function getCrearObservacionGrupo(Request $request){
        $grupo = DocenteDao::getGrupoById($request->id_grupo);
        return response()->json($grupo);
        //return json_encode($grupo);
    }
    public function postCrearObservacionGrupo(Request $request){
        $recurso = $request->all();
        DocenteDao::CrearObservacionGrupo($recurso);
        return json_encode(true);
    }
    public function getSupervisarGrupo(Request $request){
        $fases = AlumnoDao::getFasesFromProyecto($request->id_proyecto);
        $fases = $fases->where('id_grupo_trabajo', $request->id_grupo);
        $modulos = [];
        foreach($fases as $fase){
            array_push($modulos, AlumnoDao::getModulosByFaseId($fase->id));
        }
        $actividades = [];
        foreach($modulos as $moduloSingleArray){
            foreach($moduloSingleArray as $modulo){
                array_push($actividades, AlumnoDao::getActividadesByModuloId($modulo->id));
            }
        }
        $historias = DocenteDao::getAllHistoriasFromGrupoById($request->id_grupo);
        return view($this->ruta.'supervisarHistoriasGrupo',
        array('id_proyecto' => $request->id_proyecto,
        'id_grupo' => $request->id_grupo))
        ->with(compact('historias', 'fases', 'modulos', 'actividades'));
    }
    public function getHistoriaUsuario(Request $request){
        $historia = AlumnoDao::getHistoriaById($request->id_historia);
        $usuario = AlumnoDao::getUsuariosFromHistoriaId($historia->id_usuario_entrevistado);
        $compromisos = AlumnoDao::getCompromisosByHistoriaId($historia->id);
        $evidencias = AlumnoDao::getEvidenciasByHistoriaId($historia->id);
        return response()->json(array(
            $historia,
            $usuario,
            $compromisos,
            $evidencias
        ));
    }
    public function getEstadoHistoriasData(Request $request){
        $labels = DocenteDao::getLabelsToEstadoHistorias();
        $contador = [];
        $historias = DocenteDao::getAllHistoriasFromGrupoById($request->id_grupo);
        foreach($labels as $estado){
            $conteo = $historias->where('estado', $estado->estado)->count();
            array_push($contador, $conteo);
        }
        return response()->json(array('labels' => $labels, 'contador' => $contador));
    }
    public function detallesMetodologia(Request $request){
        $metodologia = DocenteDao::getMetodologiaById($request->id);
        //return view('Contents/Docente/consultandometodologia')->with(compact('metodologia'));
        //$metodologia = json_encode(DocenteDao::getMetodologiaById($request->id));
        return response()->json($metodologia);
    }
    public function detallesProyectos(Request $request){
        $proyecto = DocenteDao::getProyectoById($request->id);
        $metodologia = DocenteDao::getMetodologiaById($proyecto->id_metodologia);
        return response()->json(array('proyecto' => $proyecto, 'metodologia' => $metodologia));
    }
    public function detallesGrupos(Request $request){
        $grupo = DocenteDao::getGrupoById($request->id_grupo);
        return response()->json($grupo);
    }
    public function geteditarGrupos(Request $request){
        $grupo = DocenteDao::getGrupoById($request->id_grupo);
        $integrantes = DocenteDao::getIntegrantesByIdGrupo($request->id_grupo);
        return response()->json(array('grupo' => $grupo, 'integrantes' => $integrantes));
    }
    public function posteditarGrupos(Request $request){
        DocenteDao::updateGrupo($request);
        return response()->json(true);
    }
    public function geteliminarIntegrante(Request $request){
        DocenteDao::eliminarIntegrante($request->id_grupo_usuario);
        return response()->json(true);
    }
    public function getListarObservacionesLyS(Request $request){
        $obs = new stdClass;
        $observaciones = DocenteDao::getObservacionesGrupo($request->id_grupo);
        $obs = $observaciones;
        foreach($observaciones as $observacion){
            if($observacion->usuariovisto != null){
                $usuariov = DocenteDao::getUsuarioVisto($observacion->usuariovisto);
                $obs = $usuariov;
            }
        }
        $json_response = array('obs' => $obs);
        return response()->json($json_response);
    }
    public function getObservacionesProyectos(Request $request){

        $obs = new stdClass;
        $observaciones = DocenteDao::getObservacionesProyectos($request->id_proyecto);
        $obs = $observaciones;
        foreach($observaciones as $observacion){
            $usuariov = DocenteDao::getUsuarioVisto($observacion->id_usuario);
            $obs->{$usuariov} = $usuariov;
        }
        $json_response = array('obs' => $obs);
        return response()->json($json_response);
    }
    public function eliminarGrupoProyecto(Request $request){
        try{
            DocenteDao::eliminarGrupo($request->id_grupo);
        }catch(Exception $e){
            return redirect()->route('docente.getListaGrupos', [
                'msj' => 'Este grupo tiene otros valores asociados, no se puede eliminar'
            ]);
        }
    }
    public function getAlternarEstadoFase(Request $request){
        $data = new stdClass;
        $data->id = $request->id_fase;
        if($request->id_estado == 1){
            $data->estado = 2;
            $data->estado_child = "Concluido";
        }else{
            $data->estado = 1;
            $data->estado_child = "En desarrollo";
        }
        AlumnoDao::alternarEstadoFase($data);
        AlumnoDao::alternarEstadoModulos($data);
        return back();
    }
    public function getAlternarEstadoModulo(Request $request){
        $data = new stdClass;
        $data->id = $request->id_modulo;
        $data->estado = "";
        if($request->estado == "En desarrollo"){
            $data->estado = "Concluido";
            $data->estado_child = 1;
        }else{
            $data->estado = "En desarrollo";
            $data->estado_child = 0;
        }
        AlumnoDao::alternarEstadoModulo($data);
        AlumnoDao::alternarEstadoActividades($data);
        return back();
    }
    public function getAlternarEstadoActividad(Request $request){
        $data = new stdClass;
        $data->id = $request->id_actividad;
        $data->estado = 0;
        if($request->estado_finalizado == 0){
            $data->estado = 1;
        }else{
            $data->estado = 0;
        }
        AlumnoDao::alternarEstadoActividad($data);
        return back();
    }
}
