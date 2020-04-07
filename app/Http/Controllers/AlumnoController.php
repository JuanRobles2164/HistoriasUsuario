<?php

namespace App\Http\Controllers;

use App\fase;
use Illuminate\Http\Request;
use App\Http\Controllers\Funciones;
use App\Http\Daos\AlumnoDao;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use App\grupoTrabajo;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Daos\DocenteDao;
use App\Http\Daos\UsuarioDao;
use App\usuario;
use Facade\FlareClient\View;
use stdClass;

class AlumnoController extends Controller
{
    private $ruta = "/Contents/Alumno/";
    public function index(Request $request){
        return view($this->ruta.'indexAlumno');
    }
    public function crearEquipo(Request $request){
        $grupo = new grupoTrabajo();
        $grupo->nombre = $request->nombre;
        $grupo->descripcion = $request->descripcion;
        $grupo->id_proyecto = $request->id_proyecto;

        $cookie_alumno = json_decode(Crypt::decrypt(Cookie::get('usuario')));
        $usuario = new usuario();
        $usuario->id = $cookie_alumno->id;
        $usuario->email = $cookie_alumno->email;
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
        return View($this->ruta.'indexProyectos')->with(compact('proyectos'));
    }
    public function getFasesProyecto(Request $request){
        $proyecto = AlumnoDao::getProyectoById($request->id_proyecto);
        $fases = AlumnoDao::getFasesFromProyecto($proyecto->id);
        return view($this->ruta.'fasesProyecto')->with(compact(array('proyecto', 'fases')));
    }
    public function postAgregarFase(Request $request){
        $fase = new stdClass();
        $fase = $request->except('_token');
        if(isset($request->miniatura_fase)){
            $fase['miniatura_fase'] = $request->file('miniatura_fase')->store('uploads', 'public');
        }else{
            $fase['miniatura_fase'] = 'uploads/terminal.png';
        }
        AlumnoDao::crearFase($fase);
        //$fase->created_at = date('Y-m-d H:i:s', strtotime('now - 4 hours'));
        return redirect()->route('alumno.getFasesProyecto', $request->id_proyecto);
    }
    public function getEditarFase(Request $request){
        $fase = AlumnoDao::getFaseById($request->id_fase);
        $objetivo = AlumnoDao::getObjetivoByFaseId($request->id_fase);
        return view($this->ruta.'editarFase')->with(compact(array('fase', 'objetivo')));
    }
    public function postEditarFase(Request $request){
        $fase = $request->except('_token', 'miniatura_hidden', 'eliminar_miniatura');
        if(isset($request->miniatura_fase)){
            $fase['miniatura_fase'] = $request->file('miniatura_fase')->store('uploads', 'public');
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
        return redirect()->route('alumno.getFasesProyecto', $request->id_proyecto);
    }
    public function getTrabajarEnFaseModulos(Request $request){
        $id_proyecto = $request->id_proyecto;
        $id_fase = $request->id_fase;
        $modulos = AlumnoDao::getModulosByFaseId($request->id_fase);
        return view($this->ruta.'trabajarFase' , array('id_proyecto' => $id_proyecto, 'id_fase' => $id_fase))->with(compact(array('id_proyecto', 'id_fase', 'modulos')));
    }
    public function postCrearModulo(Request $request){
        $modulo = $request->except('_token');
        AlumnoDao::agregarModulo($modulo);
        return back();
    }
    public function getEditarModulo(Request $request){
        $modulo = AlumnoDao::getModuloById($request->id_modulo);
        return view($this->ruta.'editarModulo', 
        array('id_proyecto' => $request->id_proyecto, 
        'id_fase' => $request->id_fase, 
        'id_modulo' => $request->id_modulo))
        ->with(compact('modulo'));
    }
    public function postEditarModulo(Request $request){
        $modulo = $request->except('_token', 'id_proyecto', 'id_fase');
        AlumnoDao::editarModulo($modulo);
        return redirect()->route('alumno.getTrabajarEnFaseModulos', array('id_proyecto' => $request->id_proyecto, 'id_fase' => $request->id_fase));
    }
    public function getActividadesByModulo(Request $request){
        $actividades = AlumnoDao::getActividadesByModuloId($request->id_modulo);
        return view($this->ruta.'trabajarModulo',  
        array('id_modulo' => $request->id_modulo, 
        'id_proyecto' => $request->id_proyecto, 
        'id_fase' => $request->id_fase))
        ->with(compact('actividades'));
        //$recursos = AlumnoDao::getAllRecursosFromActividad($);
    }
    public function getRecursosByActividad(Request $request){
        $recursos = AlumnoDao::getAllRecursosFromActividad($request->id_actividad);
        return view($this->ruta.'indexRecursos', 
        array('id_modulo' => $request->id_modulo, 
        'id_proyecto' => $request->id_proyecto, 
        'id_fase' => $request->id_fase,
        'id_actividad' => $request->id_actividad))
        ->with(compact('recursos'));
    }
    public function postCrearActividad(Request $request){
        $actividad = $request->except('_token');
        AlumnoDao::crearActividad($actividad);
        return back();
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
        return view($this->ruta.'editarRecurso', 
        array('id_modulo' => $request->id_modulo, 
        'id_proyecto' => $request->id_proyecto, 
        'id_fase' => $request->id_fase,
        'id_actividad' => $request->id_actividad,
        'id_recurso' => $request->id_recurso))
        ->with(compact('recurso', 'tipos_recursos'));
    }
    public function postEditarRecurso(Request $request){
        $recurso = $request->except('_token');
        AlumnoDao::editarRecurso($recurso);
        return redirect()->route('alumno.getRecursosByActividad', 
        array('id_proyecto' => $request->id_proyecto, 
        'id_fase' => $request->id_fase,
        'id_modulo' => $request->id_modulo,
        'id_actividad' => $request->id_actividad));
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

        return redirect()->route(
        'alumno.getRecursosByActividad', 
        array('id_modulo' => $request->id_modulo, 
        'id_proyecto' => $request->id_proyecto, 
        'id_fase' => $request->id_fase,
        'id_actividad' => $request->id_actividad));
    }
    public function postCrearTipoRecurso(Request $request){
        $tipo_recurso = $request->except('_token');
        AlumnoDao::crearTipoRecurso($tipo_recurso);
        return back();
    }
    public function getHistoriasUsuarioByActividadId(Request $request){
        $historias = AlumnoDao::getHistoriasUsuarioByActividadId($request->id_actividad);
        //$usuarios = 
    }
}
