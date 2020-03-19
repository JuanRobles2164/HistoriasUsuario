<?php

namespace App\Http\Daos;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\usuario;
use App\proyecto;
use App\metodologia;

class DocenteDao extends Controller
{
    public static function crearMetodologia(metodologia $metodologia){
        $SQL = "INSERT INTO metodologia(nombre, descripcion) VALUES ('$metodologia->nombre', '$metodologia->descripcion')";
        DB::insert($SQL);
    }
    public static function eliminarMetodologia($id){
        $SQL = "UPDATE metodologia SET estado_eliminado = 1 WHERE id='$id'";
        DB::update($SQL);
    }
    public static function editarMetodologia(metodologia $metodologia){
        $SQL = "UPDATE metodologia SET nombre='$metodologia->nombre', descripcion='$metodologia->descripcion' WHERE id='$metodologia->id'";
        DB::update($SQL);
    }
    public static function crearProyecto(usuario $docente, metodologia $metodologia, proyecto $proyecto){
        $SQL = "INSERT INTO proyecto(nombre, descripcion, fecha_limite, id_usuario, id_metodologia, id_estado) VALUES('', '', )";
    }
}
