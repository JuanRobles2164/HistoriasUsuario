<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Funciones;
use App\Http\Daos\AlumnoDao;
use App\grupoTrabajo;
use App\usuario;

class AlumnoController extends Controller
{

    public function crearEquipo(Request $request){
        $grupo = new grupoTrabajo();
        $grupo->nombre = $request->nombre;
        $grupo->descripcion = $request->descripcion;
        $grupo->id_proyecto = $request->id_proyecto;
        $usuario = new usuario();
        $usuario->id = $request->id_usuario;
        $usuario->email = $request->email_usuario;
    }
    public function buscarTeammatesDisponibles(Request $request){
        
    }
    public function agregarTeammate(Request $request){
        
    }
    
}
