@extends('/Templates/Alumno/_LayoutAlumno')
@section('contenido')
<input type="hidden" name="api_route_get_notificacion" id="api_route_get_notificacion" value="{{route('alumno.getListarObservacionesLyS')}}">
    <br>
    <h3>Proyectos</h3>
    <br>
    <table class="table">
        <thead>
            <tr class="bg-warning">
                <td>Nombre</td>
                <td>Docente</td>
                <td>Metodologia</td>
                <td>Estado</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @if($proyectos == null)
                <tr>
                    <td>No</td>
                    <td>hay</td>
                    <td>proyectos</td>
                    <td>disponibles</td>
                    <td>ahora</td>
                </tr>
            @else
                @foreach ($proyectos as $proyecto)
                    <tr>
                        <td>{{$proyecto->nombre}}</td>
                        <td>{{$proyecto->docente}}</td>
                        <td>{{$proyecto->metodologia}}</td>
                        <td>
                            @if ($proyecto->id_estado == 1)
                                <a class="btn btn-success">Activo</a>
                            @else
                                <a class="btn btn-danger">Inactivo</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('alumno.getFasesProyecto', $proyecto->id)}}" class="btn btn-info">
                                <i class="fas fa-file-signature"></i>
                            </a>
                            <a href="{{route('alumno.formsAgiles.getCrearHistoriaUsuario', $proyecto->id)}}" class="btn btn-primary">
                                <i class="fas fa-file-signature"></i>
                            </a>
                            @foreach ($notificaciones->{$proyecto->id} as $notificacion)
                                @if ( $notificacion->estado  == 0)
                                    <a href="#" class="btn btn-outline-dark" data-toggle="modal" data-target="#modalObservacionDocente"  onclick="consultarObservaciones({{$proyecto->id}}),limpiarModal()">
                                        <i class="fas fa-box-open"></i>
                                    </a>
                                @else
                                    <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#modalObservacionDocente" onclick="consultarObservaciones({{$proyecto->id}}),limpiarModal()">
                                        <i class="fas fa-parachute-box"></i>
                                    </a>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
@section('modals')
<input type="hidden" name="web_observaciones" id="web_observaciones" value="{{route('alumno.postListarObservacionesLyS')}}">
<div class="modal fade" id="modalObservacionDocente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Observaciones del docente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" onclick="limpiarModal(), window.location.reload()">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link" id="nav-gabito-tab" data-toggle="tab" href="#nav-gabito" role="tab" aria-controls="nav-gabito" aria-selected="false">Vistas</a>
                    <a class="nav-item nav-link active" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Sin ver</a>
                </div>
            </nav>
            <input type="hidden" name="id_proyecto" id="id_proyecto">
            <input type="hidden" name="id_usuario" id="id_usuario">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade" id="nav-gabito" role="tabpanel" aria-labelledby="nav-gabito-tab">
                    <div class="jumbotron">
                        <br>
                            <div id="listado_fuentes">
                                <table class="table" id="leidas">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" valign="middle">Observacion</th>
                                            <th scope="col" valign="middle">Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <br>
                    <div id="listado_fuentes">
                        <table class="table" id="sinleer">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" valign="middle">Observacion</th>
                                    <th scope="col" valign="middle"></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_scripts')
    <script src="{{URL::asset('JS/AJAX/alumno/NotificacionObservacion.js')}}"></script>
@endsection