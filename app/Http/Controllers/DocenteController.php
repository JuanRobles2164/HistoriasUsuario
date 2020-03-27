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
    public function getEditar(Request $request){
        
    }
    public function index(Request $request){
        return view('Contents/Docente/indexDocente');
    }
    public function getCrearMetodologia(Request $request){
        return view('Contents/Docente/crearMetodologia');
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
        return view('Contents/Docente/listaMetodologias')->with(compact('metodologias'));
    }
    public function getEditarMetodologia(Request $request){
        $metodologia = DocenteDao::getMetodologiaById($request->id);
        $fuentes = Docentedao::getFuentesMetodologia($metodologia->id);
        return View('Contents/Docente/editarMetodologia')->with(compact('metodologia', 'fuentes'));
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
    public function crearProyecto(Request $request){
        $cookie_docente = json_decode(Crypt::decrypt(Cookie::get('usuario')));

        $docente = new usuario();
        $docente->id = $cookie_docente->id;
        $docente->email = $cookie_docente->email;

        $metodologia = new metodologia();
        $metodologia->id = $request->id_metodologia;
        $metodologia->nombre = $request->nombre_metodologia;

        $proyecto = new proyecto();
        $proyecto->fecha_limite = $request->fecha_limite;
        DocenteDao::crearProyecto($docente, $metodologia, $proyecto);
    }

}
