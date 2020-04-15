<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Closure;
use App\Http\Middleware\CheckRoleHelper;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    const NOSESSIONPATHS = [
        'login',
        'registro',
        'test',
        'rutas',
    ];
    public function handle($request, Closure $next, ...$guards)
    {
        /*$route = Route::getRoutes()->match($request)->uri();
        if(!$this->noSessionPath($route)){
            if($request->hasCookie('usuario')){
                if(CheckRoleHelper::checkCookieRole($request, $route)){
                    return $next($request);
                }else{
                    return redirect()->route('getLogin');
                }
            }
        }*/
        return $next($request);
    }
    private function noSessionPath($path){
        foreach (self::NOSESSIONPATHS as $value) {
            if ($path == $value) return true;
        }
    }
}
