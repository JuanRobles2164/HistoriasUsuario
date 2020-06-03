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
    public function postCrearFaseAJAX(Request $request){
        $fase = new stdClass();
        $fase = $request->except('_token');
        $metodologia = AlumnoDao::getMetodologiaByIdProyecto($fase['id_proyecto']);
        $id_fase = AlumnoDao::crearFaseAgil($fase, $metodologia->id);
        $faseRetorno = AlumnoDao::getFaseById($id_fase);
        return response()->json($faseRetorno);
    }
    public function postCrearModuloAJAX(Request $request){
        $modulo = new stdClass();
        $modulo = $request->except('_token');
        $id = AlumnoDao::agregarModuloAgil($modulo);
        $moduloRetorno = AlumnoDao::getModuloById($id);
        return response()->json($moduloRetorno);
    }
    public function postCrearActividadAJAX(Request $request){
        $actividad = new stdClass();
        $actividad = $request->except('_token');
        $id = AlumnoDao::crearActividadAgil($actividad);
        $actividadRetorno = AlumnoDao::getActividadById($id);
        return response()->json($actividadRetorno);
    }
}
