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

Route::get('/login', 'UsuarioController@onGetLogin')->name('getLogin');
Route::post('/login', 'UsuarioController@onPostLogin')->name('postLogin');

Route::get('/layout', function(){
    return view('AwaitingConfirmation');
})->name('LA');
Route::get('/registro', 'UsuarioController@getRegistro')->name('registro');


Route::prefix('welcome')->group(function() {
    Route::get('/','Welcome@onGetWelcome')->name('getWelcome');
});

Route::get('/administrador', 'AdministradorController@index')->name('admin.getIndex');
Route::get('/administrador/crear_usuario', 'AdministradorController@getCreate')->name('admin.getCreate');
Route::post('/administrador/crear_usuario', 'AdministradorController@postCreate')->name('admin.postCreate');
Route::get('/administrador/usuarios', 'AdministradorController@getListUsuarios')->name('admin.getListUsuarios');
Route::get('/administrador/editar', 'AdministradorController@getEditar')->name('admin.getEdit');
Route::post('/administrador/editar', 'AdministradorController@postEditar')->name('admin.postEdit');


//Enrutado para hacer pruebas con las vistas, puede cambiarse cuando desee
Route::get('/test', function(){
    return view('Contents/Admin/indexAdmin');
})->name('test');