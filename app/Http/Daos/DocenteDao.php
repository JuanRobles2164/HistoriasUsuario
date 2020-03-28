<?php

namespace App\Http\Daos;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\usuario;
use App\proyecto;
use App\metodologia;
use App\fuente;

class DocenteDao extends Controller
{
    public static function getMetodologiaById($id){
        $metodologia = DB::table('metodologia')
        ->where('id', $id)
        ->first();
        return $metodologia;
    }
    public static function getFuentesMetodologia($id_metodologia){
        $fuente = DB::table('fuente')
        ->where('id_metodologia', $id_metodologia)
        ->get();
        return $fuente;
    }
    public static function eliminarFuenteMetodologia($id){
        $SQL = "DELETE FROM fuente WHERE id = $id";
        DB::delete($SQL);
    }
    public static function crearMetodologia(metodologia $metodologia){
        $SQL = "INSERT INTO metodologia(nombre, descripcion, estado_eliminado) VALUES ('$metodologia->nombre', '$metodologia->descripcion', 0)";
        DB::insert($SQL);
    }
    public static function agregarFuenteMetodologia($fuente){
        $SQL = "INSERT INTO fuente(url, descripcion, id_metodologia, creado_en, modificado_en) VALUES('$fuente->url', '$fuente->descripcion', $fuente->id_metodologia, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        DB::insert($SQL);
    }
    public static function eliminarMetodologia($id){
        $SQL = "UPDATE metodologia SET estado_eliminado = 1 WHERE id='$id'";
        DB::update($SQL);
    }
    public static function editarMetodologia(metodologia $metodologia){
        $SQL = "UPDATE metodologia SET nombre='$metodologia->nombre', descripcion='$metodologia->descripcion', updated_at = CURRENT_TIMESTAMP WHERE id='$metodologia->id'";
        DB::update($SQL);
    }
    public static function crearProyecto(usuario $docente, metodologia $metodologia, proyecto $proyecto){
        $SQL = "INSERT INTO proyecto(nombre, descripcion, fecha_limite, id_usuario, id_metodologia, id_estado) VALUES('', '', )";
        DB::insert($SQL);
    }
    public static function getAllMetodologias(){
        $metodologias = DB::table('metodologia')
        ->get();
        return $metodologias;
    }
}
