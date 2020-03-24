<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fuente extends Model
{
    public $id;
    public $url;
    public $descripcion;
    public $id_metodologia;
}
