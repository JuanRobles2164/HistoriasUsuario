<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class grupo extends Model
{
    public $id;
    public $nombre;
    public $descripcion;
    public $id_proyecto;

    public function __construct($id = null, $nombre = null, $descripcion = null, $id_proyecto = null){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->id_proyecto = $id_proyecto;
    }
}
