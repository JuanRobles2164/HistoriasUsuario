<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Crypt;
use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if($request->hasCookie('usuario')){
            $usuario = json_decode(Crypt::decrypt($request->cookie('usuario')));
            $route = Route::getRoutes()->match($request)->uri();
            
            if(strpos(strtolower($usuario->rol), $route)){
                return $next($request);
            }else{
                return redirect()->route('getLogin');
            }
        }
    }
}
