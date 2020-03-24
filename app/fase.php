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
}
