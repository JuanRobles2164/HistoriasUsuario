<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Funciones extends Controller
{
    public static function cifrarClave(string $clave){
        $clave = crypt($clave, '$6$rounds=100$descifremeesta$');
        $clave = substr($clave, 30);
        return $clave;
    }
}
