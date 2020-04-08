@extends('/Templates/Alumno/_LayoutAlumno')
@section('contenido')
    <br>
    <h3>Actividades</h3>
    <br>
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <form action="{{route('alumno.postCrearActividad')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id_modulo" value="{{$id_modulo}}">
                    <label for="nombre">nombre</label>
                    <input type="text" name="nombre" id="nombre">
                    <br>
                    <label for="descripcion">descripcion</label>
                    <textarea type="text" name="descripcion" id="descripcion"></textarea>
                    <br>
                    <label for="fecha_limite">Fecha límite</label>
                    <input type="date" name="fecha_limite" id="fecha_limite">
                    <br>
                    <label for="prioridad">prioridad</label>
                    <div class="alert alert-info" role="alert" id="indicador_prioridad">
                        Media
                    </div>
                    <input type="range" name="prioridad" id="desplazamiento_bar" max="5" min="1" class="custom-range">
                    <br>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </form>
            </div>
        </div>
    </div>
    <br>
    @if($actividades != null)
        @foreach ($actividades->chunk(3) as $chunk)
            <div class="row">
                @foreach ($chunk as $actividad)
                <div class="col-sm-4">
                        @switch($actividad->prioridad)
                            @case(1)
                    <div class="card bg-light">
                                @break
                            @case(2)
                    <div class="card bg-dark text-white h-300 w-300">
                                @break
                            @case(3)
                    <div class="card bg-info text-white h-300 w-300">
                                @break
                            @case(4)
                    <div class="card bg-warning text-white h-300 w-300">
                                @break
                            @default
                    <div class="card bg-danger text-white h-300 w-300">
                                @break
                        @endswitch
                        
                            <div class="card-title">
                                {{$actividad->nombre}}
                            </div>
                            <div class="card-body">
                                <div class="card-text">
                                    {{$actividad->descripcion}}
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        @if($actividad->estado_finalizado == 0)
                                            <div class="alert alert-info" role="alert">
                                                En proceso
                                            </div>
                                        @else
                                            <div class="alert alert-success" role="alert">
                                                Finalizado
                                            </div>
                                        @endif
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{route('alumno.getRecursosByActividad', array('id_modulo' => $id_modulo,'id_proyecto' => $id_proyecto,'id_fase' => $id_fase, 'id_actividad' => $actividad->id))}}" class="btn btn-outline-info">Recursos</a>
                                        <a href="{{route('alumno.getHistoriasUsuarioByActividadId', array('id_modulo' => $id_modulo,'id_proyecto' => $id_proyecto,'id_fase' => $id_fase, 'id_actividad' => $actividad->id))}}" class="btn btn-outline-dark">Historias</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{route('alumno.getEliminarActividad', 'id='.$actividad->id)}}" class="btn btn-outline-danger">Eliminar</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{route('alumno.getEntregarActividad', 'id='.$actividad->id)}}" class="btn btn-outline-primary">Entregar</a>
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