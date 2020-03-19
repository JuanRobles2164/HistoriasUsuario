<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Daos\DocenteDao;
use App\Http\Controllers\Funciones;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use App\metodologia;
use App\proyecto;
use App\usuario;

class DocenteController extends Controller
{
    public function getEditar(Request $request){
        
    }
    public function index(Request $request){
        return view('indexDocente');
    }
    public function crearMetodologia(Request $request){
        $metodologia = new metodologia();
        $metodologia->nombre = $request->nombre;
        $metodologia->descripcion = $request->descripcion;
        DocenteDao::crearMetodologia($metodologia);
        return back();
    }
    public function editarMetodologia(Request $request){
        $metodologia = new metodologia();
        $metodologia->id = $request->id;
        $metodologia->nombre = $request->nombre;
        $metodologia->descripcion = $request->descripcion;
        DocenteDao::editarMetodologia($metodologia);
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
        DocenteDao::crearProyecto($docente, $metodologia, $proyecto);
    }

}
