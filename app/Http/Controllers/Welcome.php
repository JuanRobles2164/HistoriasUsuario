<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Welcome extends Controller
{
    public function onGetWelcome(Request $request){
        return view('welcome');
    }
}
