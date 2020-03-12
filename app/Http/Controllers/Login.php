<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use stdClass;

class Login extends Controller
{
    
    public function onGetLogin(Request $request){
        return view('Login');
    }

    public function onPostLogin(Request $request){
        $time = config()->get('app')['session-time-minutes'];
        $usuario = new stdClass();
        $usuario->nombre = $request->get('nombre');
        $usuario->token = Str::random(80);
        $usuario->id = 1;
        Cache::put($usuario->nombre, $usuario, $time*60);
        return redirect()->route('getWelcome')->cookie(cookie('usuario', json_encode($usuario)));
    }

}
