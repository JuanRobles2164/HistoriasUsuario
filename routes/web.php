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

Route::get('/registro', 'UsuarioController@getRegistro')->name('registro');
Route::post('/registro', 'UsuarioController@postRegistro')->name('postRegistro');


Route::prefix('welcome')->group(function() {
    Route::get('/','Welcome@onGetWelcome')->name('getWelcome');
});

Route::get('/administrador', 'AdministradorController@index')->name('admin.getIndex');
Route::get('/administrador/editar_perfil', 'AdministradorController@getSelfEdit')->name('admin.getSelfEdit');
Route::post('/administrador/editar_perfil', 'AdministradorController@postSelfEdit')->name('admin.postSelfEdit');
Route::get('/administrador/crear_usuario', 'AdministradorController@getCreate')->name('admin.getCreate');
Route::post('/administrador/crear_usuario', 'AdministradorController@postCreate')->name('admin.postCreate');
Route::get('/administrador/usuarios', 'AdministradorController@getListUsuarios')->name('admin.getListUsuarios');
Route::get('/administrador/usuarios/restaurar_usuario', 'AdministradorController@restaurarUsuario')->name('admin.restaurarUsuario');
Route::get('/administrador/editar', 'AdministradorController@getEditar')->name('admin.getEdit');
Route::post('/administrador/editar', 'AdministradorController@postEditar')->name('admin.postEdit');
Route::get('/administrador/detalles_usuario', 'AdministradorController@detailsUsuario')->name('admin.getUsuarioAJAX');
Route::get('/administrador/estado_usuario', 'AdministradorController@eliminarUsuario')->name('admin.eliminarUsuario');


Route::get('/docente', 'DocenteController@index')->name('docente.getIndex');
Route::get('/docente/lista_metodologias', 'DocenteController@getListaMetodologias')->name('docente.getListaMetodologias');
Route::get('/docente/crear_metodologia', 'DocenteController@getCrearMetodologia')->name('docente.getCrearMetodologia');
Route::post('/docente/crear_metodologia', 'DocenteController@postCrearMetodologia')->name('docente.postCrearMetodologia');
Route::get('/docente/editar_metodologia', 'DocenteController@getEditarMetodologia')->name('docente.getEditarMetodologia');
Route::post('/docente/editar_metodologia', 'DocenteController@postEditarMetodologia')->name('docente.postEditarMetodologia');
Route::get('/docente/agregar_fuente_metodologia', 'DocenteController@agregarFuenteMetodologiaAJAX')->name('docente.agregarFuenteMetodlogiaAJAX');
Route::get('/docente/eliminar_fuente', 'DocenteController@eliminarFuenteMetodologia')->name('docente.eliminarFuenteMetodologia');
/*Route::get('', '')->name('');
Route::get('', '')->name('');
Route::get('', '')->name('');
Route::get('', '')->name('');
Route::get('', '')->name('');*/


//Enrutado para hacer pruebas con las vistas, puede cambiarse cuando desee
Route::get('/test', function(){
    return view('Contents/Docente/crearMetodologia');
})->name('test');