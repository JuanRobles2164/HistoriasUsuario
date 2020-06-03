<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fase extends Model
{
    public $id;
    public $nombre;
    public $descripcion;
    public $id_metodologia;
    public $id_estado;
    public $id_proyecto;
    public $miniatura_fase;
    public $fecha_inicio;
    public $fecha_limite;
    public $created_at;
    public $updated_at;
}
