<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use App\Http\Daos\AlumnoDao;
use App\Http\Util\Utilities;
use Illuminate\Http\Request;
use stdClass;


class HistoriasController extends Controller
{
    protected $successVoidJson = array('status' => 'success');
    protected $errorVoidJson = array('statud' => 'error');

    public function CrearFaseRetornoAJAX(Request $request){
        $fase = $request->except('_token');
        $id = AlumnoDao::crearFase($fase);
        $fase_retorno = new stdClass();
        $fase_retorno->nombre = $fase['nombre'];
        $fase_retorno->id = $id;
        return json_encode($fase);
    }
    public function getCrearHistoriaUsuario(Request $request){
        $usuarios_entrevistados = AlumnoDao::getAllUsuariosEntrevistados();
        $fases = AlumnoDao::getFasesFromProyecto($request->id_proyecto);
        return view($this->ruta.'CrearHistoriaUsuario')->with(compact(array('usuarios_entrevistados', 'fases')));
    }
}
