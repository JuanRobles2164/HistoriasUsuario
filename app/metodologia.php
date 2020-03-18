<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class metodologia extends Model
{
    public $id;
    public $nombre;
    public $descripcion;

    public function __construct($id = null, $nombre = null, $descripcion = null){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }
}
