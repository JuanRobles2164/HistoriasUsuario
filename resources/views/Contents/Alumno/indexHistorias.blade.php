@extends('/Templates/Alumno/_LayoutAlumno')
@section('contenido')
<input type="hidden" name="api_route_get_modulos" id="api_route_get_modulos" value="{{route('alumno.select.getListaModulos')}}">
<input type="hidden" name="api_route_get_actividades" id="api_route_get_actividades" value="{{route('alumno.select.getListaActividades')}}">
<div class="card text-center shadow-lg p-3 mb-5 bg-white rounded">
    <div class="card-header">
      <ul class="nav nav-pills card-header-pills">
          <li class="nav-item">
            <a class="nav-link disabled text-warning" href="#" tabindex="-1" aria-disabled="true">Historias de usuario</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-select-tab" data-toggle="pill" href="#pills-select" role="tab" aria-controls="pills-select" aria-selected="false"><i class="fas fa-user-plus fa-lg"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-user-plus fa-lg"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fas fa-address-card fa-lg"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fas fa-table fa-lg"></i></a>
          </li>
      </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade" id="pills-select" role="tabpanel" aria-labelledby="pills-select-tab">
                <!-- Formulacio para crear historias de usuario-->
                <h5>Gestionar Historia de Usuario</h5>
                <!--Este es el form para agregar a un usuario entrevistado-->
                    @csrf
                    <div class="d-flex justify-content-center">
                        <div class="form-group col-md-4">
                            <label for="">Fase</label>
                            <select class="form-control" id="id_fase">
                                <option value="0"> Seleccione</option>
                                @foreach($fases as $fase)
                                    <option value="{{$fase->id}}">{{$fase->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Modelo</label>
                            <select class="form-control" id="id_modulo">

                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="form-group col-md-4">
                            <label for="">Actividad</label>
                            <select class="form-control" id="id_actividad">

                            </select>
                        </div>
                    </div>
                    <br>
            </div>
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <!-- Formulacio para crear historias de usuario-->
                <h5>Agregar Usuario</h5>
                <!--Este es el form para agregar a un usuario entrevistado-->
                <form action="{{route('alumno.postCrearUsuarioEntrevistado', array('id_proyecto' => $id_proyecto, 'id_fase' => $id_fase,'id_modulo' => $id_modulo, 'id_actividad' => $id_actividad))}}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-center">
                        <div class="form-group col-md-4">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" name="nombre_usuario_entrevistado" id="nombre_usuario_entrevistado" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email_usuario_entrevistado" id="email_usuario_entrevistado" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="form-group col-md-4">
                            <label for="">Telefono</label>
                            <input type="text" class="form-control" name="telefono_usuario_entrevistado" id="telefono_usuario_entrevistado">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Cargo</label>
                            <input type="text" class="form-control" name="cargo_usuario_entrevistado" id="cargo_usuario_entrevistado">
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-outline-primary btn-lg">Crear</button>
                </form>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <h5>Agregar Historia de Usuario</h5>
                <form action="{{route('alumno.postCrearHistoriaUsuario', array('id_modulo' => $id_modulo, 
                    'id_proyecto' => $id_proyecto, 
                    'id_fase' => $id_fase,
                    'id_actividad' => $id_actividad))}}" method="POST">
                    @csrf
                    <input type="hidden" name="id_proyecto" value="{{$id_proyecto}}">
                    <input type="hidden" name="id_modulo" value="{{$id_modulo}}">
                    <input type="hidden" name="id_proyecto" value="{{$id_proyecto}}">
                    <input type="hidden" name="id_fase" value="{{$id_fase}}">
                    <input type="hidden" name="id_actividad" value="{{$id_actividad}}">
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
                            <select class="custom-select" name="usuario_entrevistado">
                                <option selected disabled value="">Seleccione una opción</option>
                                @foreach ($usuarios_entrevistados as $usuario_entrevistado)
                                    <option value="{{$usuario_entrevistado->id}}">{{$usuario_entrevistado->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Descripción</label>
                            <textarea class="form-control" name="descripcion"></textarea>
                        </div>
                        <div class="form group col-md-3">
                            <label for="">Estado</label>
                            <input type="text" class="form-control" name="estado" id="">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="form-group col-md-3">
                            <label for="">Fecha de inicio</label>
                            <input type="date" class="form-control" name="fecha_inicio" id="">
                        </div>
                        <div class="from-group col-md-3">
                            <label for="">Fecha de finalización</label>
                            <input type="date" class="form-control" name="fecha_fin" id="">
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-around">
                        <div class="form-group">
                            <label for="" class="text-info font-weight-bold">Compromisos </label>
                            <a class="btn btn-info btn-lg" id="btnAgregarCompromiso"><i class="fas fa-plus"></i></a>
                        </div>
                        <div class="form-group">
                            <label for="" class="text-info font-weight-bold">Evidencias </label>
                            <a class="btn btn-info btn-lg" id="btn_agregar_evidencia"><i class="fas fa-plus"></i></a>
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
                    <br>
                    <button type="submit" class="btn btn-outline-primary btn-lg">Crear</button>
                </form>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <table class="table">
                    <thead class="bg-warning">
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Telefono</th>
                            <th>Cargo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios_entrevistados as $usuario_entrevistado)
                            <tr>
                                <td>{{$usuario_entrevistado->nombre}}</td>
                                <td>{{$usuario_entrevistado->e_mail}}</td>
                                <td>{{$usuario_entrevistado->telefono}}</td>
                                <td>{{$usuario_entrevistado->cargo}}</td>
                                <td>
                                    <a href="#" class="btn btn-warning">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
@endsection

@section('modals')
    
@endsection

@section('custom_scripts')
    <script src="{{URL::asset('JS/AJAX/alumno/historias.js')}}"></script>
@endsection