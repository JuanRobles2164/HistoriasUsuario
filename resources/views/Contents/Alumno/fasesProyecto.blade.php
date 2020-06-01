@extends('/Templates/Alumno/_LayoutAlumno')
@section('contenido')
    <input type="hidden" value="{{route('alumno.getEditarFase')}}" name="api_route_get_fase" id="api_route_get_fase">
    <br>
    <form action="{{route('alumno.postAgregarFase', $proyecto->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card text-center">
            <div class="card-header">
                <h3>Trabajando en las fases del proyecto: {{$proyecto->nombre}}</h3>
            </div>
            <div class="card-body">
              <p class="card-text">
                <input type="hidden" name="id_metodologia" value="{{$proyecto->id_metodologia}}">
                <input type="hidden" name="id_proyecto" value="{{$proyecto->id}}">
                <div class="row justify-content-center">
                    <div class="form-row">
                        <div class="col">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                        </div>
    
                        <div class="col">
                            <label for="descripcion_fase">Descripcion</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion_fase" placeholder="Descripcion" required>
                        </div>
                        <div class="col">
                            <label for="fecha_inicio">Fecha inicio</label>
                            <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" placeholder="Fecha inicio" required>
                        </div>
                        <div class="col">
                            <label for="fecha_limite">Fecha limite</label>
                            <input type="date" class="form-control" name="fecha_limite" id="fecha_limite" placeholder="Fecha límite" required>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col">
                        <label for="miniatura_fase">Imagen...</label>
                        <input type="file" name="miniatura_fase" id="miniatura_fase">
                    </div>
                </div>
              </p>
              <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-plus"></i></button>
            </div>
            <div class="card-footer text-muted"><br></div>
        </div>
    </form>
    <br>
    @if ($fases != null)
        @foreach ($fases->chunk(3) as $chunk)
            <div class="card-deck">
                @foreach ($chunk as $fase)
                    <div class="col mb-4">
                        <div class="card border-warning" style="width: 25rem;">
                            <img src="{{URL::asset('Images/ejemplo.jpg')}}" class="card-img-top" alt="imagen de ejemplo">
                            <div class="card-body">
                                <h5 class="card-title">{{$fase->nombre}}</h5>
                                <p class="card-text">{{$fase->descripcion}}</p>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a class="btn btn-outline-warning btn_editar_modal"
                                    data-toggle="modal" 
                                    data-target="#modalfases"  
                                    onclick="consultarFase({{$fase->id}})">
                                        Fase
                                    </a>
                                    <button type="button" class="btn btn-outline-warning" disabled><i class="fas fa-cog"></i></button>
                                    <a class="btn btn-outline-warning" data-toggle="modal" data-target="#modalobjetivo">
                                        Objetivo
                                    </a>
                                  </div>
                                  <a href="{{route('alumno.getTrabajarEnFaseModulos', array('id_proyecto' => $fase->id_proyecto, 'id_fase' =>$fase->id))}}" class="btn btn-outline-dark">Trabajar</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    @endif       
@endsection

@section('modals')
    <div class="modal fade" id="modalfases" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">
                        Editando la fase:
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
                            <div class="form-group">
                                <label for="imagenactual">Imagen actual:</label>
                                <img src="..." alt="" height="150">
                                <input type="hidden" name="miniatura_hidden">
                            </div>
                            <div class="form-group">
                                <label for="asignarimagen">Asignar Una Imagen</label>
                                <input type="file" name="miniatura_fase" id="miniatura_fase_modal">
                            </div>
                            <div class="form-group">
                                <label for="eliminarimagen">¿Eliminar imagen?</label>
                                <input type="checkbox" name="eliminar_miniatura" id="">
                            </div>
                        <a type="submit" class="btn btn-warning btn-lg" onclick="editarFase()">Editar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<div class="modal fade" id="modalobjetivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Objetivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            @if($proyecto != null)
                <h4>Crear el objetivo</h4>
                <form action="{{route('alumno.postEditarCrearObjetivo')}}" method="POST">
                    @csrf
                    <form>
                        <div class="form-group">
                            <input type="hidden" name="id_proyecto">
                            <input type="hidden" name="id_fase">
                            <label for="nombre" class="col-form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre">
                        </div>
                        <div class="form-group">
                            <label for="descripcion" class="col-form-label">Descripcion</label>
                            <textarea class="form-control" name="descripcion" id="descipcion"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Crear</button>
                    </form>
                </form>
            @else
                <h4>Editar el objetivo</h4>
                <form action="{{route('alumno.postEditarCrearObjetivo')}}" method="POST">
                    @csrf
                    <form>
                        <div class="form-group">
                            <input type="hidden" name="id_fase">
                            <label for="nombre" class="col-form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="id_proyecto">
                            <label for="descripcion" class="col-form-label">descripcion</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion">
                        </div>
                        <button type="submit" class="btn btn-warning">Editar</button>
                    </form>
                </form>
            @endif
        </div>
    </div>
    </div>
</div>
@endsection


@section('custom_scripts')
    <script src="{{URL::asset('JS/AJAX/alumno/fasesAJAX.js')}}"></script>    
@endsection


