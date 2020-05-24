<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    private static $LEIDO = true;
    private static $SIN_LEER = false;
    public function getAllNotificationsByAlumno(Request $request)
    {
        
    }
    public function getMarkAsReaded(Request $request){

    }
}
