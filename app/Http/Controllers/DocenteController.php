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
use App\usuario;
use App\fuente;
use stdClass;

class DocenteController extends Controller
{
    private $ruta ='/Contents/Docente/';
    public function getEditar(Request $request){
        
    }
    public function index(Request $request){
        return view($this->ruta.'indexDocente');
    }
    public function getCrearMetodologia(Request $request){
        return view($this->ruta.'crearMetodologia');
    }
    public function postCrearMetodologia(Request $request){
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
        $cookie_docente = json_decode(Crypt::decrypt(Cookie::get('usuario')));
        $proyectos = DocenteDao::getAllProyectos($cookie_docente->id);
        return View($this->ruta.'listarProyectos')->with(compact('proyectos'));
    }
    public function getCrearProyecto(Request $request){
        $metodologias = DocenteDao::getAllMetodologias();
        return View($this->ruta.'crearProyecto')->with(compact('metodologias'));
    }
    public function postCrearProyecto(Request $request){
        $request->fecha_limite = date('Y-m-d', strtotime("+$request->fecha_limite days"));
        $cookie_docente = json_decode(Crypt::decrypt(Cookie::get('usuario')));
        $proyecto = new proyecto();
        $proyecto->nombre = $request->nombre;
        $proyecto->descripcion = $request->descripcion;
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
        return view($this->ruta.'editarProyecto')->with(compact('proyecto'));
    }
    public function postEditarProyecto(Request $request){
        $proyecto = DocenteDao::getProyectoById($request->id);
        $proyecto->nombre = $request->nombre;
        $proyecto->descripcion = $request->descripcion;
        if($request->dias_extra[0] != '-'){
            $proyecto->fecha_limite = date('Y-m-d', strtotime($proyecto->fecha_limite."+$request->dias_extra days"));
        }else{
            $fecha_actual = date('Y-m-d', strtotime("+ 0 days"));
            $fecha_generada = date('Y-m-d', strtotime($proyecto->fecha_limite."$request->dias_extra days"));
            if($fecha_actual > $fecha_generada){
                $proyecto->fecha_limite = date('Y-m-d', strtotime($proyecto->fecha_limite."+ 0 days"));
            }else{
                $proyecto->fecha_limite = date('Y-m-d', strtotime($proyecto->fecha_limite."$request->dias_extra days"));
            }

        }
        DocenteDao::editarProyecto($proyecto);
        return redirect()->route('docente.getListaProyectos');
    }
}
