@extends('/Templates/Alumno/_LayoutAlumno')
@section('contenido')
<input type="hidden" value="{{route('alumno.getEditarModulo')}}" name="api_route_get_modulo" id="api_route_get_modulo">
<div class="card text-center">
    <div class="card-header">
        <h3>Administrando los Módulos</h3>
    </div>
    <div class="card-body">
      <p class="card-text">
        <form action="{{route('alumno.postCrearModulo')}}" method="POST">
            @csrf
            <input type="hidden" name="id_fase" value="{{$id_fase}}">
            <div class="d-flex justify-content-center">
                <div class="form-group row">
                    <label for="nombre" class="col-sm-4 col-form-label">Nombre:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nombre" id="nombre" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="descripcion" class="col-sm-4 col-form-label">Descripción</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" name="descripcion" id="descripcion" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fecha_limite" class="col-sm-5 col-form-label">Fecha limite:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" name="fecha_limite" id="fecha_limite" required>
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-outline-success btn-lg">Crear</button>
        </form>
      </p>
    </div>
    <div class="card-footer text-muted"></div>
  </div>
<br>
    @if($modulos != null)   
        @foreach ($modulos->chunk(3) as $chunk)
            <div class="row">
                @foreach ($chunk as $modulo)
                    <div class="col mb-4">
                        <div class="card border-warning h-300 w-300">
                            <div class="card-body">
                            <h5 class="card-title">Modulo: {{$modulo->nombre}}</h5>
                            <p class="card-text">Descripcion: {{$modulo->descripcion}}</p>
                            <ul class="list-group list-group-flush">
                                @if($modulo->estado != 'En desarrollo' && $modulo->estado != 'Entregado')
                                    <li class="list-group-item">
                                        <h5 class="card-title">
                                            Observación del docente:
                                        </h5>
                                        <p>
                                            {{$modulo->observacion}}
                                        </p>
                                    </li>
                                    <li class="list-group-item">
                                        @switch($modulo->estado)
                                            @case("Rechazado")
                                                <div class="alert alert-danger" role="alert">
                                                    Rechazado
                                                </div>
                                                @break
                                            @case("Aprobado")
                                                <div class="alert alert-success" role="alert">
                                                    Aprobado
                                                </div>
                                                @break
                                            @case("En espera")
                                                <div class="alert alert-dark" role="alert">
                                                    En espera
                                                </div>
                                                @break
                                        @endswitch
                                    </li>
                                @else
                                    <li class="list-group-item">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                                        </div>
                                        <p>En desarrollo</p>
                                    </li>
                                @endif
                                <li class="list-group-item">
                                    <p class="font-weight-bold text-danger">Fecha límite (AAAA/MM/dd): {{$modulo->fecha_limite}}</p>
                                </li>
                                <li class="list-group-item">
                                    <a href="#" class="btn btn-primary">Entregar</a>
                                    <a class="btn btn-warning btn_editar_modal"
                                    data-toggle="modal" 
                                    data-target="#modalmodulo"  
                                    onclick="consultarModulo({{$modulo->id}})"> Editar</a>
                                    <a href="{{route('alumno.getActividadesByModulo', array('id_modulo' => $modulo->id, 'id_proyecto' => $id_proyecto, 'id_fase' => $id_fase) )}}" class="btn btn-info">Trabajar</a>
                                    <a href="#" class="btn btn-danger">Eliminar</a>
                                </li>
                            </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    @endif
@endsection

@section('modal_modulo')
        <input type="hidden" value="{{route('alumno.postEditarModulo')}}" id="web_editar_modulo" name="web_editar_modulo">
    <div class="modal fade" id="modalmodulo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Editando Módulo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnCierraModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" name="id_proyecto" id="id_proyecto_modal">
                            <input type="hidden" name="id_fase" id="id_fase_modal">
                            <input type="hidden" name="id" id="id_modulo_modal">
                            <label for="nombre" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre_modulo_modal">
                        </div>
                        <div class="form-group">
                            <label for="descripcion" class="col-form-label">Descripción:</label>
                            <textarea class="form-control" id="descripcion_modulo_modal"></textarea>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="form-group">
                                <label for="fecha_limite" class="col-form-Label">Fecha Límite:</label>
                                <input type="date" class="form-control" id="fecha_limite_modulo_modal">
                            </div>
                        </div>
                        <br>
                        <a class="btn btn-warning btn-lg" onclick="editarModulo()">Editar</a>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection