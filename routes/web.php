<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/login', 'Login@onGetLogin')->name('getLogin');
Route::post('/login', 'Login@onPostLogin')->name('postLogin');

Route::get('/layout', function(){
    return view('AwaitingConfirmation');
})->name('LA');
Route::get('/registro', 'UsuarioController@index')->name('registro');

Route::prefix('welcome')->group(function() {
    Route::get('/','Welcome@onGetWelcome')->name('getWelcome');
});
