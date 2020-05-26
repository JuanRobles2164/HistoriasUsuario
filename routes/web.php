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

Route::get('/administrador', 'AdministradorController@index')->name('admin.getIndex')->middleware('CheckRole');
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


Route::get('/docente', 'DocenteController@index')->name('docente.getIndex')->middleware('CheckRole');
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
Route::get('/docente/proyectos/{id_proyecto}/grupos', 'DocenteController@getListaGrupos')->name('docente.getListaGrupos');
Route::get('/docente/proyectos/{id_proyecto}/grupos/crear_grupo', 'DocenteController@getCrearGrupo')->name('docente.getCrearGrupo');
Route::post('/docente/proyectos/{id_proyecto}/grupos/crear_grupo', 'DocenteController@postCrearGrupo')->name('docente.postCrearGrupo');
Route::get('/docente/proyectos/{id_proyecto}/grupos/{id_grupo}/asignar_alumno', 'DocenteController@getAsignarAlumnoGrupo')->name('docente.getAsignarAlumnoGrupo');
Route::post('/docente/proyectos/{id_proyecto}/grupos/{id_grupo}/asignar_alumno', 'DocenteController@postAsignarAlumnoGrupo')->name('docente.postAsignarAlumnoGrupo');
Route::get('/docente/proyectos/{id_proyecto}/grupos/alternar_estado', 'DocenteController@getAlternarEstadoGrupo')->name('docente.getAlternarEstadoGrupo');
Route::get('/docente/proyectos/{id_proyecto}/grupos/observacion', 'DocenteController@getObservacionAlumnosProyecto')->name('docente.getObservacionAlumnosProyecto');
Route::post('/docente/proyectos/{id_proyecto}/grupos/observacion', 'DocenteController@postObservacionAlumnosProyecto')->name('docente.postObservacionAlumnosProyecto');
Route::get('/docente/proyectos/{id_proyecto}/grupos/{id_grupo}/historias_de_usuario', 'DocenteController@getSupervisarGrupo')->name('docente.getSupervisarGrupo');
Route::get('/docente/proyectos/{id_proyecto}/grupos/{id_grupo}/ObservacionGrupo','DocenteController@getCrearObservacionGrupo')->name('docente.getCrearObservacionGrupo');
Route::post('/docente/ObservacionGrupo','DocenteController@postCrearObservacionGrupo')->name('docente.postCrearObservacionGrupo');
/*


Route::get('', '')->name('');
Route::get('', '')->name('');*/

Route::get('/alumno', 'AlumnoController@index')->name('alumno.getIndex');
Route::get('/alumno/editar_perfil', 'AlumnoController@getSelfEdit')->name('alumno.getSelfEdit');
Route::post('/alumno/editar_perfil', 'AlumnoController@postSelfEdit')->name('alumno.postSelfEdit');
Route::get('/alumno/proyectos', 'AlumnoController@getListaProyectos')->name('alumno.getListaProyectos');
Route::get('/alumno/proyectos/{id_proyecto}', 'AlumnoController@getFasesProyecto')->name('alumno.getFasesProyecto');
Route::post('/alumno/proyectos/{id_proyecto}/agregar_fase', 'AlumnoController@postAgregarFase')->name('alumno.postAgregarFase');

Route::get('/alumno/get_editar_fase','AlumnoController@getEditarFase')->name('alumno.getEditarFase');
Route::post('/alumno/proyectos/{id_proyecto}/post_editar_fase','AlumnoController@postEditarFase')->name('alumno.postEditarFase');

Route::post('/alumno/fases/editar_crear_objetivo','AlumnoController@postEditarCrearObjetivo')->name('alumno.postEditarCrearObjetivo');
Route::get('/alumno/proyectos/{id_proyecto}/fases/{id_fase}/modulos','AlumnoController@getTrabajarEnFaseModulos')->name('alumno.getTrabajarEnFaseModulos');
Route::post('/alumno/modulos/crear_modulo','AlumnoController@postCrearModulo')->name('alumno.postCrearModulo');

Route::get('/alumno/get_editar_modulo','AlumnoController@getEditarModulo')->name('alumno.getEditarModulo');
Route::post('/alumno/modulos/post_editar_modulo','AlumnoController@postEditarModulo')->name('alumno.postEditarModulo');

Route::get('/alumno/proyectos/{id_proyecto}/fases/{id_fase}/modulos/{id_modulo}/actividades','AlumnoController@getActividadesByModulo')->name('alumno.getActividadesByModulo');

Route::post('/alumno/actividad/crear_actividad','AlumnoController@postCrearActividad')->name('alumno.postCrearActividad');
Route::get('/alumno/actividad/eliminar_actividad','AlumnoController@getEliminarActividad')->name('alumno.getEliminarActividad');
Route::get('/alumno/actividad/entregar','AlumnoController@getEntregarActividad')->name('alumno.getEntregarActividad');
Route::get('/alumno/proyectos/{id_proyecto}/fases/{id_fase}/modulos/{id_modulo}/actividades/{id_actividad}/recursos','AlumnoController@getRecursosByActividad')->name('alumno.getRecursosByActividad');
Route::get('/alumno/get_editar_recurso','AlumnoController@getEditarRecurso')->name('alumno.getEditarRecurso');
Route::get('/alumno/recursos/post_editar_recurso','AlumnoController@postEditarRecurso')->name('alumno.postEditarRecurso');
Route::get('/alumno/proyectos/{id_proyecto}/fases/{id_fase}/modulos/{id_modulo}/actividades/{id_actividad}/recursos/crear_recurso','AlumnoController@getCrearRecurso')->name('alumno.getCrearRecurso');
Route::post('/alumno/recursos/crear_recurso','AlumnoController@postCrearRecurso')->name('alumno.postCrearRecurso');
Route::post('/alumno/tipo_recurso/crear','AlumnoController@postCrearTipoRecurso')->name('alumno.postCrearTipoRecurso');
Route::get('/alumno/proyectos/{id_proyecto}/fases/{id_fase}/modulos/{id_modulo}/actividades/{id_actividad}/historias','AlumnoController@getHistoriasUsuarioByActividadId')->name('alumno.getHistoriasUsuarioByActividadId');
Route::post('/alumno/proyectos/{id_proyecto}/fases/{id_fase}/modulos/{id_modulo}/actividades/{id_actividad}/historias/crear_usuario_entrevistado','AlumnoController@postCrearUsuarioEntrevistado')->name('alumno.postCrearUsuarioEntrevistado');
Route::post('/alumno/proyectos/{id_proyecto}/fases/{id_fase}/modulos/{id_modulo}/actividades/{id_actividad}/historias/crear_historia_usuario','AlumnoController@postCrearHistoriaUsuario')->name('alumno.postCrearHistoriaUsuario');
//Route::get('/alumno/historias_de_usuario')->name('alumno.getListaHistorias');
//Route::get('','')->name('');

//Enrutado para hacer pruebas con las vistas, puede cambiarse cuando desee
Route::get('/test', function(){
    
    $fase = date('Y-m-d H:i:s', strtotime('now - 4 hours'));
    return json_encode($fase);
})->name('test');


//Para sacar el listado de rutas
Route::get('rutas', function() {
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