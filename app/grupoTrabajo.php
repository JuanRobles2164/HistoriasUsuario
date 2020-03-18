<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class grupoTrabajo extends Model
{
    public $id;
    public $nombre;
    public $descripcion;
    public $estado;
    public $id_proyecto;
    
    public function __construct() {
        
    }
}
