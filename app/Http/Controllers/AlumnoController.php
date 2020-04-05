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
            $fase['miniatura_fase'] = $request->file('miniatura_fase')->store('images');
        }
        AlumnoDao::crearFase($fase);
        //$fase->created_at = date('Y-m-d H:i:s', strtotime('now - 4 hours'));
        return redirect()->route('docente.getFasesProyecto', $request->id_proyecto);
    }
}
