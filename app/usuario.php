<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
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
    

    public function __construct(){

    }
    public function __construct1($username, $contrasenia, $email, $rol_id){
        $this->username = $username;
        $this->contrasenia = $contrasenia;
        $this->email = $email;
        $this->rol_id = $rol_id;
    }


    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function getNombres(){
        return $this->nombres;
    }
    public function setNombres($nombres){
        $this->nombres = $nombres;
    }

    public function getApellidos(){
        return $this->apellidos;
    }
    public function setApellidos($apellidos){
        $this->apellidos = $apellidos;
    }

    public function getContrasenia(){
        return $this->contrasenia;
    }
    public function setContrasenia($contrasenia){
        $this->contrasenia = $contrasenia;
    }

    public function getUserName(){
        return $this->username;
    }
    public function setUserName($username){
        $this->username = $username;
    }

    public function getIdentificacion(){
        return $this->identificacion;
    }
    public function setIdentificacion($identificacion){
        $this->identificacion = $identificacion;
    }

    public function getRolId(){
        return $this->rol_id;
    }
    public function setRolId($rol_id){
        $this->rol_id = $rol_id;
    }

    public function getCreadoEn(){
        return $this->creado_en;
    }
    public function getUsuarioModifica(){
        return $this->usuario_modifica;
    }
    public function getEstadoEliminado(){
        return $this->estado_eliminado;
    }
    public function getModificadoEn(){
        return $this->modificado_en;
    }
}
