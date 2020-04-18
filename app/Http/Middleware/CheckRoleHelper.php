<?php

namespace App\Http\Middleware;

use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Contracts\Encryption\Encrypter;

class CheckRoleHelper {
    public static function checkCookieRole($request, $route) : bool
    {
        if($request->hasCookie('usuario')){
            //$encrypter = app(\Illuminate\Contracts\Encryption\Encrypter::class);
            $usuario = Cookie::get('usuario');
            //$usuario = $encrypter->decrypt(Cookie::get('usuario'));
            $usuarioRol =  Crypt::decrypt(Cookie::get('usuario'), false);
            if(strpos($route, strtolower($usuarioRol)) != null){
                return true;
            }
            return false;
        }
    }
}