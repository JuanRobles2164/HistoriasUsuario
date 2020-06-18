@extends('Templates/Docente/_LayoutDocente')
@section('contenido')
<input type="hidden" name="api_route_get_observacion" id="api_route_get_observacion" value="{{route('docente.getObservacionesProyectos')}}">
<br>
<h3>Proyectos</h3>
<br>
<p>Aquí estarán los proyectos que usted alguna vez creó o que actualmente está supervisando</p>
<br>
    <table class="table">
        <thead>
            <tr class="bg-primary">
                <td style="text-align: center;">Nombre</td>
                <td style="text-align: center;">Fecha límite (YYYY-MM-dd)</td>
                <td style="text-align: center;">Días restantes</td>
                <td style="text-align: center;">Estado</td>
                <td style="text-align: center;">Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($proyectos as $proyecto)
                <tr>
                    <th style="text-align: center;">{{$proyecto->nombre}}</th>
                    <th style="text-align: center;">{{$proyecto->fecha_limite}}</th>
                    <th style="text-align: center;">{{date('d', (strtotime("$proyecto->fecha_limite") - strtotime('now')))}}</th>
                    @if ($proyecto->id_estado == 1)
                        <th style="text-align: center;">
                            <a href="{{route('docente.getAlternarEstadoProyecto', 'id='.$proyecto->id."&id_estado=".$proyecto->id_estado)}}" class="btn btn-success">Activo</a>
                        </th>
                    @else
                        <th style="text-align: center;">
                            <a href="{{route('docente.getAlternarEstadoProyecto', 'id='.$proyecto->id."&id_estado=".$proyecto->id_estado)}}" class="btn btn-danger">Inactivo</a>
                        </th>
                    @endif
                    <th style="text-align: center;">
                        <!-- Propongo que en el botón de "detalles" salgan reportes del proyecto-->
                        <!-- Por ejemplo: Cantidad de grupos en el proyecto... numero de alumnos por grupo-->
                        <!-- Y cosas así XD -->
                        <a href="#" class="btn btn-secondary"  data-toggle="modal" data-target="#modalObservacionDocente"  onclick="consultarObs({{$proyecto->id}})">
                          Observaciones
                        </a>
                        <a class="btn btn-success" onclick="consultandoproyectos({{$proyecto->id}})">
                            Detalles
                        </a>
                        <a href="{{route('docente.getListaGrupos', $proyecto->id)}}" class="btn btn-info" >Supervisar</a>
                        <a href="{{route('docente.getEditarProyecto', 'id='.$proyecto->id)}}" class="btn btn-warning" aria-placeholder="Editar">Editar</a>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('modals')
<div class="modal fade" tabindex="-1" role="dialog" id="modalproyectos">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detalles Proyecto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="nombre_proyecto" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" id="nombre_proyecto">
            </div>
            <div class="form-group">
              <label for="descripcion_proyecto" class="col-form-label">Descripción:</label>
              <textarea class="form-control" id="descripcion_proyecto"></textarea>
            </div>
            <div class="row">
                <div class="col">
                    <label for="fecha_inicio_proyecto" class="col-form-label">fecha Incio:</label>
                    <input type="text" class="form-control" id="fecha_inicio_proyecto">
                </div>
                <div class="col">
                    <label for="fecha_fin_proyecto" class="col-form-label">fecha Final:</label>
                    <input type="text" class="form-control" id="fecha_fin_proyecto">
                </div>
            </div>
            <div class="form-group">
                <label for="metodologia_proyecto" class="col-form-label">Metodología:</label>
                <input type="text" class="form-control" id="metodologia_proyecto">
            </div>  
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCierramodalmetodologia">Cerrar</button>
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
              <th scope="col" valign="middle">Usuario observado</th>
            </tr>
          </thead>
          <tbody>
                                     
          </tbody>
        </table>
      </div>
    </div>
  </div> 
</div>
@endsection

@section('custom_scripts')
   <script src="{{URL::asset('JS/AJAX/docente/historiasListaAJAX.js')}}"></script>
   <script src="{{URL::asset('JS/AJAX/docente/proyecto.js')}}"></script>
@endsection