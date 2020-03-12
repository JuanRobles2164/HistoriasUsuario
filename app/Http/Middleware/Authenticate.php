<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;


class Authenticate extends Middleware
{
    const NOSESSIONPATHS = [
        'login',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $time = config()->get('app')['session-time-minutes'];
        $usuario = $request->cookie('usuario');
        $route = '';
        try {
            $route = Route::getRoutes()->match($request)->uri();
        } catch(Exception $e) {
            Log::error($e->getMessage());
        }
        $tologin = false;
        try {
            if ($usuario) {
                $usuario = Crypt::decryptString($usuario);
                if (strpos($usuario, ":123")) {
                    $usuario = substr($usuario, 7, -2);
                }
                $usuario = json_decode($usuario);
                if (!Cache::has($usuario->nombre)) {
                    $tologin = true;
                } else {
                    $_usuario = Cache::pull($usuario->nombre);
                    if ($usuario->token != $_usuario->token) {
                        $tologin = true;
                    }
                }
            } else {
                if (!$request->cookie('initSession') && !$this->noSessionPath($route)) {
                    $tologin = true;
                }
            }
        } catch (Exception $e) {
            $tologin = true;
        }
        if ($tologin) {
            return redirect()->route('getLogin')->cookie(cookie('initSession', true))->cookie(cookie('usuario', null));
        } else {
            if ($usuario) {
                $usuario->token = Str::random(80);
                Cache::put($usuario->nombre, $usuario, $time*60);
                return $next($request)->cookie(cookie('usuario', Crypt::encrypt(json_encode($usuario))));
            } else {
                $response = $next($request);
                return $response->cookie(cookie('initSession', null));
            }
        }
    }

    private function noSessionPath($path){
        foreach (self::NOSESSIONPATHS as $value) {
            if ($path == $value) return true;
        }
    }
}
