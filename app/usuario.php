<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class usuario extends Authenticatable
{
    protected $table = 'usuarios';
    protected $fillable = ['id', 'e_mail', 'nombres', 'apellidos'];
    public $id;
    public $nombres;
    public $apellidos;
    public $username;
    public $contrasenia;
    public $identificacion;
    public $email;
    public $rol_id;
    public $rol;
    public $creado_en;
    public $usuario_modifica;
    public $modificado_en;
    public $estado_eliminado;

}
