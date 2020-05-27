<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use App\Http\Daos\DocenteDao;
use App\metodologia;
use Illuminate\Http\Request;
use stdClass;

class MetodologiaController extends Controller
{
    /**
     * Recibe información básica para poder crear una fuente y asignarla rápidamnete a un proyecto
     * @param AJAX_Request $request
     * @return metodologia
     */
    public function postCrearMetodologiaAJAX(Request $request){
        $metodologia = new metodologia(null, $request->nombre, $request->descripcion);
        $id_metodologia = DocenteDao::crearMetodologia($metodologia);
        $metodologia->id = $id_metodologia;
        $fuente = new stdClass;
        $fuente->url = $request->url;
        $fuente->descripcion = $request->descripcion_fuente;
        $fuente->id_metodologia = $id_metodologia;
        DocenteDao::agregarFuenteMetodologia($fuente);
        $metodologiaRetorno = DocenteDao::getMetodologiaById($id_metodologia);
        return response()->json($metodologiaRetorno);
    }
}
