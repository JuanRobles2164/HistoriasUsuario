<?php

namespace App\Http\Controllers\PDFs;

use App\Http\Daos\AlumnoDao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PDFController extends Controller
{
    public function pdff(Request $request){
        $usuarios = DB::table('usuarios')->get();
        $pdf = \PDF::loadView('pdf_generado', compact('usuarios'));
        return $pdf->download('pdf_generado.pdf');
    }
    public function getHistoriaPdfById(Request $request){
        $historia = AlumnoDao::getHistoriaById($request->id_historia);
        $modulo = AlumnoDao::getModuloById($historia->id_modulo);
        //$evaluador = 'Ricardo';
        $evidencias = AlumnoDao::getEvidenciasByHistoriaId($historia->id);
        $criterios = AlumnoDao::getCriteriosByHistoriaId($historia->id);
        $compromisos = AlumnoDao::getCompromisosByHistoriaId($historia->id);
        $pdf = \PDF::loadView('PDFs\historiaPDF', compact(array(
            'historia',
            'modulo',
            'evidencias',
            'criterios',
            'compromisos',
        )));
        return $pdf->download('pdf_generado.pdf');
    }
}
