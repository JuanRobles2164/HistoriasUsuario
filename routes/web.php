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
Route::get('/docente/editar_perfil', 'DocenteController@getSelfEdit')->name('docente.getSelfEdit');
Route::post('/docente/editar_perfil', 'DocenteController@postSelfEdit')->name('docente.postSelfEdit');
Route::get('/docente/metodologias', 'DocenteController@getListaMetodologias')->name('docente.getListaMetodologias');
Route::get('/docente/crear_metodologia', 'DocenteController@getCrearMetodologia')->name('docente.getCrearMetodologia');
Route::post('/docente/crear_metodologia', 'DocenteController@postCrearMetodologia')->name('docente.postCrearMetodologia');
Route::get('/docente/editar_metodologia', 'DocenteController@getEditarMetodologia')->name('docente.getEditarMetodologia');
Route::post('/docente/editar_metodologia', 'DocenteController@postEditarMetodologia')->name('docente.postEditarMetodologia');
Route::get('/docente/agregar_fuente_metodologia', 'DocenteController@agregarFuenteMetodologiaAJAX')->name('docente.agregarFuenteMetodologiaAJAX');
Route::get('/docente/eliminar_fuente', 'DocenteController@eliminarFuenteMetodologia')->name('docente.eliminarFuenteMetodologia');
Route::get('/docente/proyectos', 'DocenteController@getListaProyectos')->name('docente.getListaProyectos');
Route::get('/docente/proyectos/crear_proyecto', 'DocenteController@getCrearProyecto')->name('docente.getCrearProyecto');
Route::post('/docente/proyectos/crear_proyecto', 'DocenteController@postCrearProyecto')->name('docente.postCrearProyecto');
Route::get('/docente/proyectos/alternar_estado', 'DocenteController@getAlternarEstadoProyecto')->name('docente.getAlternarEstadoProyecto');
Route::get('/docente/proyectos/editar', 'DocenteController@getEditarProyecto')->name('docente.getEditarProyecto');
Route::post('/docente/proyectos/editar', 'DocenteController@postEditarProyecto')->name('docente.postEditarProyecto');
Route::get('/docente/proyectos/{id_proyecto}', 'DocenteController@getSupervisarProyecto')->name('docente.getSupervisarProyecto');
Route::post('/docente/proyectos/{id_proyecto}/asignar_alumno', 'DocenteController@postAsignarAlumnoProyecto')->name('docente.postAsignarAlumnoProyecto');
/*


Route::get('', '')->name('');
Route::get('', '')->name('');*/

Route::get('/alumno', 'AlumnoController@index')->name('alumno.getIndex');
Route::get('/alumno/editar_perfil', 'AlumnoController@getSelfEdit')->name('alumno.getSelfEdit');
Route::post('/alumno/editar_perfil', 'AlumnoController@postSelfEdit')->name('alumno.postSelfEdit');
Route::get('/alumno/proyectos', 'AlumnoController@getListaProyectos')->name('alumno.getListaProyectos');
Route::get('/alumno/proyectos/{id_proyecto}', 'AlumnoController@getFasesProyecto')->name('alumno.getFasesProyecto');
Route::post('/alumno/proyectos/{id_proyecto}/agregar_fase', 'AlumnoController@postAgregarFase')->name('alumno.postAgregarFase');

//Enrutado para hacer pruebas con las vistas, puede cambiarse cuando desee
Route::get('/test', function(){
    
    $fase = date('Y-m-d H:i:s', strtotime('now - 4 hours'));
    return json_encode($fase);
})->name('test');


//Para sacar el listado de rutas
Route::get('routes', function() {
    $routeCollection = Route::getRoutes();
    
    echo "<table style='width:100%'>";
        echo "<tr>";
            echo "<td width='10%'><h4>HTTP Method</h4></td>";
            echo "<td width='10%'><h4>Ruta</h4></td>";
            echo "<td width='10%'><h4>Nombre</h4></td>";
            echo "<td width='70%'><h4>Acción correspondiente</h4></td>";
        echo "</tr>";
        foreach ($routeCollection as $value) {
            echo "<tr>";
                echo "<td>" . $value->methods()[0] . "</td>";
                echo "<td>" . $value->uri() . "</td>";
                echo "<td>" . $value->getName() . "</td>";
                echo "<td>" . $value->getActionName() . "</td>";
            echo "</tr>";
        }
    echo "</table>";
    });