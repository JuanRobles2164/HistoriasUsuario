<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Funciones;
use App\Http\Daos\AlumnoDao;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use App\grupoTrabajo;
use App\usuario;

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
    public function buscarTeammatesDisponibles(Request $request){
        
    }
    public function agregarTeammate(Request $request){
        
    }
    
}
