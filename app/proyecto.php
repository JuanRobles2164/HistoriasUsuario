<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proyecto extends Model
{
    public $id;
    public $nombre;
    public $descripcion;
    public $fecha_limite;
    public $id_usuario;
    public $id_metodologia;
    public $id_estado;

    public function __construct()
    {
        
    }
}
