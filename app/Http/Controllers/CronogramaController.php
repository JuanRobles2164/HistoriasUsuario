<?php

namespace App\Http\Controllers;

use App\Http\Daos\AlumnoDao;
use App\Http\Daos\DocenteDao;
use Illuminate\Http\Request;

class CronogramaController extends Controller
{
    private $ruta = '/Contents/Docente/';
    public function getCronogramaByGrupoId(Request $request){
        
        return view($this->ruta.'calendarioCronograma', [
            'id_grupo' => $request->id_grupo,
            'id_proyecto' => $request->id_proyecto
        ]);
    }
    public function getDataCronogramaByGrupoId(Request $request){
        //$fases = AlumnoDao::getFasesFromProyecto($request->id_proyecto);
        $fases = AlumnoDao::getFasesFromProyectoByGrupoId($request->id_proyecto, $request->id_grupo);
        $modulos = [];
        foreach($fases as $fase){
            array_push($modulos, AlumnoDao::getModulosByFaseId($fase->id));
        }
        $actividades = [];
        foreach($modulos as $moduloSingleArray){
            foreach($moduloSingleArray as $modulo){
                array_push($actividades, AlumnoDao::getActividadesByModuloId($modulo->id));
            }
        }
        $historias = DocenteDao::getAllHistoriasFromGrupoById($request->id_grupo);
        return response()->json([
            'fases' => $fases,
            'actividades' => $actividades,
            'modulos' => $modulos,
            'historias' => $historias
        ]);
    }
}
