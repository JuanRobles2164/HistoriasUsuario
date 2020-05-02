@extends('/Templates/Alumno/_LayoutAlumno')
@section('contenido')
<div class="card border-warning text-center">
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
                        <div class="card h-300 w-300">
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
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                                        </div>
                                        <p>En desarrollo</p>
                                    </li>
                                @endif
                                <li class="list-group-item">
                                    <p>Fecha límite (AAAA/MM/dd): {{$modulo->fecha_limite}}</p>
                                </li>
                                <li class="list-group-item">
                                    <a href="#" class="btn btn-primary">Entregar</a>
                                    <a href="{{route('alumno.getEditarModulo', array('id_modulo' => $modulo->id, 'id_proyecto' => $id_proyecto, 'id_fase' => $id_fase))}}" class="btn btn-warning">Editar</a>
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