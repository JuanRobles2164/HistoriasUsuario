@extends('/Templates/Alumno/_LayoutAlumno')
@section('contenido')
<input type="hidden" name="api_route_get_modulos" id="api_route_get_modulos" value="{{route('alumno.select.getListaModulos')}}">
<input type="hidden" name="api_route_get_actividades" id="api_route_get_actividades" value="{{route('alumno.select.getListaActividades')}}">
<input type="hidden" name="api_route_crear_fase" id="api_route_crear_fase" value="{{route('alumno.formsAgiles.postCrearFase', array('id_proyecto' => $id_proyecto))}}">
<input type="hidden" name="api_route_crear_modulo" id="api_route_crear_modulo" value="{{route('alumno.formsAgiles.postCrearModulo')}}">
<input type="hidden" name="api_route_crear_actividad" id="api_route_crear_actividad" value="{{route('alumno.formsAgiles.postCrearActividad')}}">
<div class="card text-center shadow-lg p-3 mb-5 bg-white rounded">
    <div class="card-header">
      <ul class="nav nav-pills card-header-pills">
          <li class="nav-item">
            <a class="nav-link disabled text-warning" href="#" tabindex="-1" aria-disabled="true">Historias de usuario</a>
          </li>
          <li class="nav-item">
            <a href="{{route('alumno.getListaProyectos')}}" class="nav-link">Volver</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" id="pills-select-tab" data-toggle="pill" href="#pills-select" role="tab" aria-controls="pills-select" aria-selected="true"><i class="fas fa-user-plus fa-lg"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fas fa-address-card fa-lg"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fas fa-table fa-lg"></i></a>
          </li>
      </ul>
    </div>
<form action="{{ route('alumno.formsAgiles.postCrearHistoriaFormAgil', array('id_proyecto' => $id_proyecto) ) }}" method="POST">
    <div class="card-body">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane active show fade" id="pills-select" role="tabpanel" aria-labelledby="pills-select-tab">
                <!-- Formulacio para crear historias de usuario-->
                <h5>Gestionar Historia de Usuario</h5>
                <br>
                <!--Este es el form para agregar a un usuario entrevistado-->
                    @csrf
                    <div class="d-flex justify-content-center">
                        <div class="form-inline">
                            <label class="my-1 mr-3" for="fase">Fase</label>
                            <div class="form-group">
                               
                                <select class="form-control" id="id_fase" name="id_fase">
                                    <option value="0" selected> Seleccione</option>
                                    @foreach($fases as $fase)
                                        <option value="{{$fase->id}}" onclick="traerFases({{$fase->id}})">{{$fase->nombre}}</option>
                                    @endforeach
                                </select>
                                <div class="col-auto">
                                    <a class="btn btn-info" data-toggle="modal" data-target="#modalfases" data-toggle="tooltip" data-placement="bottom" title="Agregar">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>                     
                        </div>
                        <div class="form-inline">
                            <label class="my-1 mr-3" for="">Modulo</label>
                            <div class="form-group">
                                <select class="form-control" id="id_modulo" name="id_modulo">
                                    <option value="0" selected> Seleccione</option>
                                </select>
                                <div class="col-auto">
                                     <a class="btn btn-info" data-toggle="modal" data-target="#modalmodulos" data-toggle="tooltip" data-placement="bottom" title="Agregar">
                                        <i class="fas fa-plus"></i>
                                     </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-inline">
                            <label class="my-1 mr-3" for="">Actividad</label>
                            <div class="form-group">
                                <select class="form-control" id="id_actividad" name="id_actividad">
                                    <option value="0" selected> Seleccione</option>
                                </select>
                                <div class="col-auto">
                                    <a class="btn btn-info" data-toggle="modal" data-target="#modalactividades" data-toggle="tooltip" data-placement="bottom" title="Agregar">
                                        <i class="fas fa-plus"></i>
                                     </a>
                                </div>
                            </div>
                       </div>
                    </div>
                
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <h5>Agregar Historia de Usuario</h5>
                    <div class="d-flex justify-content-center">
                        <div class="form-group col-md-4">
                            <label for="">Secuencia</label>
                            <input type="text" class="form-control" name="secuencia" id="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="prioridad">Prioridad:</label>
                        <div class="alert alert-info" role="alert" id="indicador_prioridad">
                            Media
                        </div>
                        <input type="range" name="prioridad" id="desplazamiento_bar" max="5" min="1" value="3" class="custom-range">
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        <div class="form-group col-md-3">
                            <label for="">Usuario entrevistado</label>
                            <select class="custom-select" name="usuario_entrevistado" id="usuario_entrevistado">
                                <option selected value="0">Seleccione una opción</option>
                                @foreach ($usuarios_entrevistados as $usuario_entrevistado)
                                    <option value="{{$usuario_entrevistado->id}}">{{$usuario_entrevistado->nombre}}</option>
                                @endforeach
                                <option onclick="abrirModal()" value="">CREAR NUEVO USUARIO</option>
                            </select>
                        </div>
                        <div class="form group col-md-3">
                            <label for="">Estado</label>
                            <select name="estado" id="" class="form-control">
                                <option value="En proceso" selected>En proceso</option>
                                <option value="Aceptada">Aceptada</option>
                                <option value="Rechazada">Rechazada</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Fecha de inicio</label>
                            <input type="date" class="form-control" name="fecha_inicio" id="">
                        </div>
                        <div class="from-group col-md-3">
                            <label for="">Fecha de finalización</label>
                            <input type="date" class="form-control" name="fecha_fin" id="">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="form-group">
                            <label for="">Descripción</label>
                            <textarea class="form-control" name="descripcion"></textarea>
                        </div>
                    </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="d-flex justify-content-around">
                    <div class="form-group">
                        <label for="" class="text-info font-weight-bold">Compromisos </label>
                        <a class="btn btn-info btn-lg" id="btnAgregarCompromiso" data-toggle="tooltip" data-placement="bottom" title="Agregar"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="form-group">
                        <label for="" class="text-info font-weight-bold">Evidencias </label>
                        <a class="btn btn-info btn-lg" id="btn_agregar_evidencia" data-toggle="tooltip" data-placement="bottom" title="Agregar"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="from-group col-md-6">
                        <table class="table table-sm">
                            <thead class="bg-primary">
                                <tr>
                                    <th>Compromiso</th>
                                </tr>
                            </thead>
                            <tbody id="contenedor">
                                <tr>
                                    <td>
                                        <textarea class="form-control" name="compromisos[]"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="from-group col-md-6">
                        <table class="table table-sm">
                            <thead class="bg-primary">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Archivo</th>
                                </tr>
                            </thead>
                            <tbody id="contenedor_evidencia">
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name='nombre_evidencia[]'>
                                    </td>
                                    <td>
                                        <input type="file" class="form-control-file" name='foto_evidencia[]'>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-around">
                    <div class="form-group">
                        <label for="" class="text-info font-weight-bold">Criterios de aceptacion</label>
                        <a class="btn btn-info btn-lg" id="btnAgregarCriterio"><i class="fas fa-plus" data-toggle="tooltip" data-placement="bottom" title="Agregar"></i></a>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="from-group">
                        <table class="table table-sm">
                            <thead class="bg-primary">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Contexto</th>
                                    <th>Evento</th>
                                    <th>Resultado</th>
                                    <th>¿Cumple?</th>
                                </tr>
                            </thead>
                            <tbody id="contenedor_criterio">
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name='nombre_criterio[]'>
                                    </td>
                                    <td>
                                        <textarea class="form-control" name='contexto_criterio[]'></textarea>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name='evento_criterio[]'>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name='resultado_criterio[]'>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-control" name='cumple_criterio[]' value="0">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary btn-lg">Crear</button>
            </div>
        
        </div>  
    </div>
    </div>
</form>
@endsection

@section('modals')
<div class="modal fade" id="modalfases" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">
                    Agregar fase
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnCierraModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" name="id_fase" id="id_fase_modal">
                            <label for="nombre" class="col-form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre_fase_modal">
                        </div>
                        <div class="form-group">
                            <label for="descripcion" class="col-form-label">Descripcion</label>
                            <textarea class="form-control" name="descripcion" id="descripcion_fase_modal"></textarea>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="form-group">
                                <label for="ffechainicio" >Fecha inicio</label>
                                <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio_fase_modal">
                            </div>
                            <div class="form-group">
                                <label for="fechalimite" >Fecha límite</label>
                                <input type="date" class="form-control" name="fecha_limite" id="fecha_limite_fase_modal">
                            </div>
                        </div>
                    <a type="submit" class="btn btn-warning btn-lg" onclick="agregarFaseRapido({{$id_proyecto}})">Agregar</a>
                </form>
            </div>
        </div>
    </div>
</div> 
<div class="modal fade" id="modalmodulos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">
                    Agregar modulo
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnCierraModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" name="id_fase" id="id_fase_modal">
                            <label for="nombre" class="col-form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre_modulo_modal">
                        </div>
                        <div class="form-group">
                            <label for="descripcion" class="col-form-label">Descripcion</label>
                            <textarea class="form-control" name="descripcion" id="descripcion_modulo_modal"></textarea>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="form-group">
                                <label for="ffechainicio" >Fecha inicio</label>
                                <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio_modulo_modal">
                            </div>
                            <div class="form-group">
                                <label for="fechalimite" >Fecha límite</label>
                                <input type="date" class="form-control" name="fecha_limite" id="fecha_limite_modulo_modal">
                            </div>
                        </div>
                    <a type="submit" class="btn btn-warning btn-lg" onclick="agregarModuloRapido()">Agregar</a>
                </form>
            </div>
        </div>
    </div>
</div> 
<div class="modal fade" id="modalactividades" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">
                    Agregar actividad
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnCierraModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" name="id_fase" id="id_actividad_modal">
                            <label for="nombre" class="col-form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre_actividad_modal">
                        </div>
                        <div class="form-group">
                            <label for="descripcion" class="col-form-label">Descripcion</label>
                            <textarea class="form-control" name="descripcion" id="descripcion_actividad_modal"></textarea>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="form-group col-md-8">
                                <label for="prioridad" class="font-weight-bold text-warning">Prioridad</label>
                                <div class="alert alert-info" role="alert" id="indicador_prioridad_modal">
                                    Media
                                </div>
                                <input type="range" name="prioridad" id="desplazamiento_bar_modal" value="3" max="5" min="1" class="custom-range">  
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="form-group">
                                <label for="ffechainicio" >Fecha inicio</label>
                                <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio_actividad_modal">
                            </div>
                            <div class="form-group">
                                <label for="fechalimite" >Fecha límite</label>
                                <input type="date" class="form-control" name="fecha_limite" id="fecha_limite_actividad_modal">
                            </div>
                        </div>
                    <a type="submit" class="btn btn-warning btn-lg" onclick="agregarActividadRapido()">Agregar</a>
                </form>
            </div>
        </div>
    </div>
</div> 

<div class="modal fade" id="usuarioEntrevistado" tabindex="-1" role="dialog" aria-labelledby="usuarioEntrevistadoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Usuario entrevistado</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div>
            <input type="hidden" name="" id="api_route_crear_usuario_form_agil" value="{{route('alumno.formsAgiles.postCrearUsuarioEntrevistadoAJAX')}}">
              <div class="form-group">
                  <label for="usuario_nombre">Nombre</label>
                  <div>
                    <input type="text" name="usuario_nombre" id="usuario_nombre" class="form-control">
                  </div>
              </div>
              <div class="form-group">
                  <label for="">Correo electrónico</label>
                <div>
                    <input type="text" name="usuario_e_mail" id="usuario_e_mail" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="usuario_telefono">Telefono</label>
                <div>
                    <input type="text" name="usuario_telefono" id="usuario_telefono" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="usuario_cargo">Cargo</label>
                <div>
                    <input type="text" name="usuario_cargo" id="usuario_cargo" class="form-control">
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" onclick="crearUsuarioFast()">Crear</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('custom_scripts')
    <script src="{{URL::asset('JS/AJAX/alumno/historiasFormAgil.js')}}"></script>
@endsection