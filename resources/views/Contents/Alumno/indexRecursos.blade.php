@extends('/Templates/Alumno/_LayoutAlumno')
@section('contenido')
<input type="hidden" value="{{route('alumno.getEditarRecurso')}}" name="api_route_get_recurso" id="api_route_get_recurso">
<input type="hidden" name="web_editar_recurso" id="web_editar_recurso" value="{{route('alumno.postEditarRecurso')}}">
    <div class="card border-warning shadow-lg p-3 mb-5 bg-white rounded">
        <div class="card-header p-3 mb-2 bg-warning text-dark">
            <h3>Lista de Recursos</h3>
        </div>
        <div class="card-body">
        <h5 class="card-title">Crear Tipo de Recurso</h5>
            <form action="{{route('alumno.postCrearTipoRecurso')}}" method="POST">
                @csrf
                <div class="d-flex justify-content-around">
                    <div class="form-group col-md-4">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Descripción</label>
                        <textarea class="form-control" name="descripcion" id=""></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Crear</button>
            </form>
            <br>
            <button  class="btn btn-outline-primary" data-toggle="modal" data-target="#modalRecurso">
                Crear Recurso
            </button>
        </div>
    </div>
    <table class="table table-hover">
        <thead>
            <tr class="bg-warning">
                <th>Nombre</th>
                <th>$ Valor unitario</th>
                <th>Cantidad</th>
                <th>Tipo de recurso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recursos as $recurso)
                <tr>
                    <th>{{$recurso->nombre}}</th>
                    <th>{{$recurso->valor_unitario}}</th>
                    <th>{{$recurso->cantidad}}</th>
                    <th>{{$recurso->tipo_recurso}}</th>
                    <th>
                        <button type="submit" class="btn btn-warning" data-toggle="modal" data-target="#modalEditarRecurso"  onclick="consultandoRecurso({{$recurso->id}})">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
<input type="hidden" name="route_alumno_post_crear_recurso" value="{{route('alumno.postCrearRecurso')}}" id="route_alumno_post_crear_recurso">
@endsection

@section('modal_crear_recurso')
    <div class="modal fade" id="modalRecurso" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Crear Recurso</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{route('alumno.postCrearRecurso')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id_proyecto" value="{{$id_proyecto}}">
                    <input type="hidden" name="id_fase" value="{{$id_fase}}">
                    <input type="hidden" name="id_modulo" value="{{$id_modulo}}">
                    <input type="hidden" name="id_actividad" value="{{$id_actividad}}">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="" required>
                    </div>
                    <div class="form-group">
                        <label for="">Descripcion</label>
                        <textarea  class="form-control" name="descripcion" id="" required></textarea>
                    </div>
                    <div class="d-flex justify-content-around">
                        <div class="form-group col-md-6">
                            <label for="">Cantidad</label>
                            <input type="number" class="form-control" name="cantidad" step="1" min=0 required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Valor unitario</label>
                            <input type="number" class="form-control" name="valor_unitario" step="0.1" placeholder="$00.00" min=0 required>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="id_tipo_recurso" id="">
                            @foreach ($tipos_recurso as $tipo_recurso)
                                <option value="{{$tipo_recurso->id}}">{{$tipo_recurso->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </form>
        </div>
        </div>
    </div>
@endsection

@section('modal_editar_recurso') 
  <div class="modal fade" id="modalEditarRecurso" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Editando Recurso</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" onclick="limpiarSelect()">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form>
                <input type="hidden" name="id_proyecto" id="id_proyecto_modal">
                <input type="hidden" name="id_fase" id="id_fase_modal">
                <input type="hidden" name="id_modulo" id="id_modulo_modal">
                <input type="hidden" name="id_actividad" id="id_actividad_modal">
                <input type="hidden" name="id" id="id_recurso_modal">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre_recurso_modal">
                <br>
                <label for="descripcion">Descripcion</label>
                <textarea  class="form-control" name="descripcion" id="descripcion_recurso_modal"></textarea>
                <br>
                <div class="d-flex justify-content-around">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" class="form-control" name="cantidad" id="cantidad_recurso_modal" step="0.1">
                    </div>
                    <div class="form-group">
                        <label for="valor_unitario">Valor Unitario</label>
                        <input type="number" class="form-control" name="valor_unitario" id="valor_unitario_recurso_modal" step="0.1">
                    </div>
                </div>
                <label for="tipo_recurso">Tipo de recurso</label>
                <select class="form-control" name="id_tipo_recurso" id="tipo_recurso_modal">
                    <option value="" selected hidden>Seleccione un opcion</option>
                </select>
                <br>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="limpiarSelect()" data-dismiss="modal">Cerrar</button>
                    <a type="submit" class="btn btn-primary" onclick="editarRecurso()">Editar</a>
                </div>
            </form>
      </div>
    </div>
  </div>
@endsection