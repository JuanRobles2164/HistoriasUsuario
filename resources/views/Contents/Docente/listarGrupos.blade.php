@extends('Templates/Docente/_LayoutDocente')
@section('contenido')
@if(isset($msj))
   <div class="alert alert-danger alert-dismissible fade show" role="alert">
   <strong>¡{{$msj}}!</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
      </button>
   </div>
@endif
<input type="hidden" name="api_route_get_grupo" id="api_route_get_grupo" value="{{route('docente.getdetallesGrupos')}}">
<input type="hidden" name="api_route_get_edit_grupo" id="api_route_get_edit_grupo" value="{{route('docente.geteditarGrupos')}}">
<input type="hidden" name="api_route_get_delete" id="api_route_get_delete" value="{{route('docente.geteliminarIntegrante')}}">
<input type="hidden" name="api_route_get_observacion" id="api_route_get_observacion" value="{{route('docente.getCrearObservacionGrupo')}}">
<input type="hidden" name="api_route_get_notificacion" id="api_route_get_notificacion" value="{{route('docente.getListarObservacionesLyS')}}">
<br>
<form>
    <div class="row">
      <div class="col">
        <h3>Grupos</h3>
      </div>
      <div class="col" align="right" valign="top">
        <h4 style="color:gray; align-items: center;">
            Proyecto: {{$proyecto->nombre}}
        </h4>
      </div>
    </div>
</form>
<p></p>
<nav class="navbar navbar-expand-lg navbar-light bg-light">  
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a href="{{route('docente.getCrearGrupo', $proyecto->id)}}" class="btn btn-success">Nuevo grupo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"> </a>
        </li>
        <li class="nav-item">
            <a href="{{route('docente.getObservacionAlumnosProyecto', $proyecto->id)}}" class="btn btn-secondary">Observaci&oacute;n</a>
        </li>
      </ul>
    </div>
  </nav>
  <br>
    <table class="table">
        <thead>
            <tr class="bg-primary">
                <td style="text-align: center;"></td>
                <td style="text-align: center;">Nombre</td>
                <td style="text-align: center;">Progreso</td>
                <td style="text-align: center;">Integrantes</td>
                <td style="text-align: center;">Estado</td>
                <td style="text-align: center;">Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($grupos as $grupo)
                <tr style="line-height:50px;">
                    <th style="text-align: center;">
                        <a href="{{route('docente.getEliminarGrupo', array('id_proyecto' => $grupo->id_proyecto, 'id_grupo' => $grupo->id) )}}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </th>
                    <th style="text-align: center;">
                        <label for="">{{$grupo->nombre}}</label>
                    </th>
                    <th style="text-align: center;display: table-cell;vertical-align: middle;"> 
                        <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" 
                        style="width: {{ $progreso_grupo->{$grupo->id} }}%; line-height:50px;" aria-valuenow="@php $progreso_grupo->{$grupo->id}@endphp" aria-valuemin="0" aria-valuemax="100">
                        @php
                          $progreso_grupo->{$grupo->id}
                        @endphp %</div>
                        </div>
                    </th>
                    <th style="text-align: center; display: table-cell;vertical-align: middle;">
                        <div class="">
                        @foreach ($integrantes->{$grupo->id} as $integrante)
                            <p style="font-size:12px;  line-height:5px;" > {{$integrante->nombres}}</p> 
                        @endforeach
                        </div>
                    </th>
                    @if ($grupo->estado_activo == 1)
                        <th style="text-align: center;">
                            <a href="{{route('docente.getAlternarEstadoGrupo',  array('id_proyecto' => $grupo->id_proyecto, 'id' => $grupo->id, 'id_estado' => $grupo->estado_activo))}}" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Cambiar estado">Activo</a>
                        </th>
                    @else
                        <th style="text-align: center;">
                            <a href="{{route('docente.getAlternarEstadoGrupo',  array('id_proyecto' => $grupo->id_proyecto, 'id' => $grupo->id, 'id_estado' => $grupo->estado_activo))}}" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cambiar estado">Inactivo</a>
                        </th>
                    @endif
                    <th style="text-align: center;">
                        <a href="{{route('docente.getSupervisarGrupo', array('id_proyecto' => $grupo->id_proyecto, 'id_grupo' => $grupo->id))}}" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="bottom" title="Supervisar">
                            <i class="fas fa-clipboard"></i>
                        </a>
                        <a href="#" class="btn btn-outline-secondary btn-sm"  data-toggle="modal" data-target="#modalComentario"  onclick="consultaGrupo({{$grupo->id}})" data-toggle="tooltip" data-placement="bottom" title="Agregar comentario">
                            <i class="fas fa-comment-medical"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modalObservacionDocente"  onclick="consultarObs({{$grupo->id}})" data-toggle="tooltip" data-placement="bottom" title="Ver comentarios">
                            <i class="far fa-comments"></i>
                        </a>
                        <a class="btn btn-info btn-sm" style="color: white" onclick="consultandogrupos({{$grupo->id}})" data-toggle="tooltip" data-placement="bottom" title="Detalles">
                            <i class="fas fa-eye"></i>
                        </a>
                         <a href="#" class="btn btn-warning  btn-sm" data-toggle="modal" data-target="#modaleditargrupos"  onclick="Grupo({{$grupo->id}})" data-toggle="tooltip" data-placement="bottom" title="Editar">
                            <i class="far fa-edit"></i>
                        </a>
                        <a href="{{route('docente.getAsignarAlumnoGrupo', array('id_proyecto' => $grupo->id_proyecto, 'id_grupo' => $grupo->id) )}}" a class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="bottom" title="Agregar integrantes">
                            <i class="fas fa-user-plus"></i>
                        </a>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('modals')
<input type="hidden" name="web_crear_observacion" id="web_crear_observacion" value="{{route('docente.postCrearObservacionGrupo')}}">
<div class="modal fade" id="modalComentario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Crear Observacion Grupo: 
              <label name="nombre_grupo" id="nombre_grupo"> </label>
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form>
                <input type="hidden" name="id_grupo" id="id_grupo_observacion">
                <label for="observacion">Observacion</label>
                <textarea  class="form-control" name="observacion" id="observacion_grupo"></textarea>
                <br>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <a type="submit" class="btn btn-primary" onclick="crearObservacion()">Crear</a>
                </div>
            </form>
      </div>
    </div>
  </div>
<div class="modal fade" tabindex="-1" role="dialog" id="modalgrupos">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Grupo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="modal_nombre_grupo" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" id="modal_nombre_grupo">
            </div>
            <div class="form-group">
              <label for="descripcion_grupo" class="col-form-label">Descripcion:</label>
              <textarea class="form-control" id="descripcion_grupo"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCierramodal">Cerrar</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="modalObservacionDocente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Observaciones realizadas al grupo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" onclick="limpiarModal()">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table" id="obser">
            <thead class="thead-dark">
              <tr>
                <th scope="col" valign="middle">Observacion</th>
                <th scope="col" valign="middle">Fecha</th>
                <th scope="col" valign="middle">Estado</th>
                <th scope="col" valign="middle">Visto por</th>
              </tr>
            </thead>
            <tbody>
                                       
            </tbody>
          </table>
        </div>
      </div>
    </div> 
</div>
<input type="hidden" name="web_editar_grupos" id="web_editar_grupos" value="{{route('docente.posteditarGrupos')}}">
<div class="modal fade" tabindex="-1" role="dialog" id="modaleditargrupos">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Grupo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" onclick="limpiarModal()">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_grupo" id="id_grupo">
          <form>
            <div class="form-group">
              <label for="modal_nombre_grupo" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" id="nombre_grupo_editar">
            </div>
            <div class="form-group">
              <label for="descripcion_grupo" class="col-form-label">Descripcion:</label>
              <textarea class="form-control" id="descripcion_grupo_editar"></textarea>
            </div>
            <table class="table" id="integrantes">
            <thead class="thead-dark">
              <tr>
                <th scope="col" valign="middle">Integrante</th>
                <th scope="col" valign="middle"> </th>
              </tr>
            </thead>
            <tbody id="lista-integrantes">
                                       
            </tbody>
          </table>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCierramodal">Cerrar</button>
          <button type="submit" class="btn btn-primary" onclick="EditarGrupo()">Editar</button>
        </div>
      </div>
    </div>
</div>    
@endsection

@section('custom_scripts')
    <script src="{{URL::asset('JS/AJAX/docente/grupos.js')}}"></script>
    <script src="{{URL::asset('JS/AJAX/docente/observacion.js')}}"></script>
@endsection