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
use App\Http\Util\Utilities;

class DocenteController extends Controller
{
    private $ruta ='/Contents/Docente/';
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
        $proyecto = DocenteDao::getProyectoById($request->id);
        $proyecto->fecha_inicial = Utilities::getCurrentDate($proyecto->fecha_inicial);
        $proyecto->fecha_limite = Utilities::getCurrentDate($proyecto->fecha_limite);
        return view($this->ruta.'editarProyecto')->with(compact('proyecto'));
    }
    public function postEditarProyecto(Request $request){
        $proyecto = DocenteDao::getProyectoById($request->id);
        $proyecto->nombre = $request->nombre;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->fecha_inicial = $request->fecha_inicial;
        $proyecto->fecha_limite = $request->fecha_limite;
        DocenteDao::editarProyecto($proyecto);
        return redirect()->route('docente.getListaProyectos');
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
     * @return void
     */
    
     //Funciones del controlador para los grupos de los proyectos
    public function getListaGrupos(Request $request){ 
        $proyecto = DocenteDao::getProyectoById($request->id_proyecto);
        $grupos = DocenteDao::getAllGrupos($request->id_proyecto);
        $integrantes = DocenteDao::getIntegrantesGrupos($grupos);
        $variables = array('proyecto','grupos', 'integrantes');
        //return json_encode($integrantes);
        return view($this->ruta.'listarGrupos')->with(compact(array('proyecto','grupos', 'integrantes')));
    }
    public function getCrearGrupo(Request $request){
        $proyecto = DocenteDao::getProyectoById($request->id_proyecto);
        return view($this->ruta.'crearGrupo')->with(compact('proyecto'));
    }
    public function postCrearGrupo(Request $request){
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required'
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
        $query_value = array();
        foreach($request->id_alumnos as $idAlumno){
            //array_push($query_values, "($idAlumno,$request->id_proyecto, CURRENT_TIMESTAMP)");
            array_push($query_value, "($idAlumno,$request->id_grupo, NOW(), NULL, CURRENT_TIMESTAMP)");
        }
        DocenteDao::asignarAlumnosAGrupo(implode(",",$query_value));
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
        $query_value = array();
        foreach($request->id_alumnos as $idAlumno){
            array_push($query_value, "($idAlumno,$request->id_proyecto, '$request->observacion', CURRENT_TIMESTAMP)");
        }
        DocenteDao::asignarObservacionAAlumnos(implode(",",$query_value));
        return redirect()->route('docente.getListaGrupos', $request->id_proyecto);
    }
    public function getSupervisarGrupo(Request $request){
        $historias = DocenteDao::getAllHistoriasFromGrupoById($request->id_grupo);
        return view($this->ruta.'supervisarHistoriasGrupo', 
        array('id_proyecto' => $request->id_proyecto, 
        'id_grupo' => $request->id_grupo))
        ->with(compact('historias'));
    }
    public function getDetallesHistoria(Request $request){
        $historia = DocenteDao::getHistoriaById($request->id_historia);
        $evidencias = DocenteDao::getEvidenciasByHistoriaId($historia->id);
        $compromisos = DocenteDao::getCompromisosByHistoriaId($historia->id);
        return view($this->ruta.'supervisarHistoriasGrupo');
    }
}

