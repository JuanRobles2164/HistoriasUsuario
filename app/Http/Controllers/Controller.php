<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected static $JSON_SUCCESS = array('success' => true);
    protected static $JSON_FAIL = array('success' => false);
    protected static $ACTIVO = true;
    protected static $INACTIVO = false;
    protected function verifyRole(){
        
    }
}
