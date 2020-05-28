<?php

namespace App\Http\Util;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;



class Utilities{
    /**
     * Undocumented function
     *
     * @param string $cookie_name
     * @return Cookie
     */
    public static function returnDecryptedCookieByName(string $cookie_name){
        try{
            return json_decode(Crypt::decrypt(Cookie::get($cookie_name)));
        }catch(Exception $e){
            throw new Exception($e);
        }
    }
    /**
     * Retorna la información almacenada en caché por su id/key
     *
     * @param string $key
     * @return Cache
     */
    public static function returnCacheDataByName(string $key){
        try{
            return Cache::get($key);
        }catch(Exception $e){
            throw new Exception($e);
        }
    }
    /**
     * Intenta eliminar un elemento de la caché por su id/key
     * true si la operación fué exitosa
     * false si hubo un error al borrar
     * @param string $key
     * @return bool
     */
    public static function flushCacheElement(string $key){
        $deleted = false;
        try{
            Cache::forget($key);
            $deleted = true;
        }catch(Exception $e){
            throw new Exception;
        } finally{
            return $deleted;
        }
    }
    public static function getCurrentDate($params = 'now'){
        return date('Y-m-d H:i:s', strtotime($params));
    }
}