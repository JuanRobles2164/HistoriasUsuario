@extends('Templates/Docente/_LayoutDocente')
@section('contenido')
<input type="hidden" name="api_route_get_fase" id="api_route_get_fase" value="{{route('alumno.getEditarFase')}}">
<input type="hidden" name="api_route_get_historia" id="api_route_get_historia" value="{{route('docente.getHistoriaUsuario')}}">
<br>
<h3>Supervisando avances del grupo: {{$id_grupo}}</h3>

<br>
<h4><a target="_blank" href="{{route('docente.getCronogramaByGrupoId', [
    'id_proyecto' => $id_proyecto,
    'id_grupo' => $id_grupo
])}}">Cronograma del grupo</a></h4>
<ul class="nav nav-tabs" id="myNavTabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="fases-tab" data-toggle="tab" href="#fases" role="tab" aria-controls="fases" aria-selected="true">Fases</a>
    </li>
    <li class="nav-item"> 
        <a class="nav-link" id="modulos-tab" data-toggle="tab" href="#modulos" role="tab" aria-controls="modulos" aria-selected="true">Módulos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="actividades-tab" data-toggle="tab" href="#actividades" role="tab" aria-controls="actividades" aria-selected="true">Actividades</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="historias-tab" data-toggle="tab" href="#historias" role="tab" aria-controls="historias" aria-selected="true">Historias</a>
    </li>
  </ul>
  <div class="tab-content" id="fasesTabContent">
    <div class="tab-pane fade show active" id="fases" role="tabpanel" aria-labelledby="fases-tab">
        <table class="table">
            <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Inicio</td>
                    <td>Fin</td>
                    <td>Días</td>
                    <td>Estado</td>
                    <td>Detalles</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($fases as $fase)
                <tr>
                    <td>{{$fase->nombre}}</td>
                    <td>{{$fase->created_at}}</td>
                    <td>{{$fase->fecha_limite}}</td>
                    <td>
                        {{ gmdate('d',(strtotime($fase->fecha_inicio) - strtotime($fase->fecha_limite))) }}
                    </td>
                    <td>
                        @if ($fase->id_estado == 1)
                        <a href="{{route('docente.getAlternarEstadoFase',[
                            'id_fase' => $fase->id,
                            'id_estado' => $fase->id_estado
                        ])}}" class="btn btn-dark">
                            Activo
                        </a>
                        @else
                        <a href="{{route('docente.getAlternarEstadoFase',[
                            'id_fase' => $fase->id,
                            'id_estado' => $fase->id_estado
                        ])}}" class="btn btn-light">
                            Inactivo
                        </a>
                        @endif
                        
                    </td>
                    <td>
                        <button href="#" onclick="consultarFase({{$fase->id}})" type="button" data-toggle="modal" data-target="#modalFasesDetalles" class="btn btn-primary">
                            Ver
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade show" id="modulos" role="tabpanel" aria-labelledby="modulos-tab">
        <table class="table">
            <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Inicio</td>
                    <td>Fin</td>
                    <td>Días</td>
                    <td>Estado</td>
                </tr>
            </thead>
            <tbody>
                @foreach($modulos as $modulosArray)
                    @foreach ($modulosArray as $modulo)
                    <tr>
                        <td>{{$modulo->nombre}}</td>
                        <td>{{$modulo->created_at}}</td>
                        <td>{{$modulo->fecha_limite}}</td>
                        <td>{{ gmdate('d',(strtotime($modulo->fecha_inicio) - strtotime($modulo->fecha_limite))) }}</td>
                        <td>
                            @if ($modulo->estado == "En desarrollo")
                            <a href="{{route('docente.getAlternarEstadoModulo',[
                                'id_modulo' => $modulo->id,
                                'estado' => $modulo->estado
                            ])}}" class="btn btn-dark">
                                    En desarrollo
                                </a>
                            @else
                                <a href="{{route('docente.getAlternarEstadoModulo',[
                                    'id_modulo' => $modulo->id,
                                    'estado' => $modulo->estado
                                ])}}" class="btn btn-light">
                                    Concluido
                                </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade show" id="actividades" role="tabpanel" aria-labelledby="actividades-tab">
        <table class="table">
            <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Inicio</td>
                    <td>Finaliza</td>
                    <td>Días</td>
                    <td>Costo</td>
                    <td>Estado</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($actividades as $actividadesStack)
                        @foreach ($actividadesStack as $actividad)
                        <tr>
                            <td>{{ $actividad->nombre}}</td>
                        <td>{{ $actividad->created_at}}</td>
                        <td>{{ $actividad->fecha_limite}}</td>
                        <td>{{ gmdate('d',(strtotime($actividad->created_at) - strtotime($actividad->fecha_limite)))}}</td>
                        <td>
                            {{ $costo_actividad->{$actividad->id} }}
                        </td>
                        <td>
                            @if ($actividad->estado_finalizado == 1)
                                <a href="{{route('docente.getAlternarEstadoActividad',[
                                    'id_actividad' => $actividad->id,
                                    'estado_finalizado' => $actividad->estado_finalizado
                                ])}}" class="btn btn-light">
                                    Finalizada
                                </a>
                            @else
                                <a href="{{route('docente.getAlternarEstadoActividad',[
                                    'id_actividad' => $actividad->id,
                                    'estado_finalizado' => $actividad->estado_finalizado
                                ])}}" class="btn btn-dark">
                                    Activa
                                </a>
                            @endif    
                        </td>
                        </tr>
                        
                    @endforeach
                @endforeach
            </tbody>
        </table>
        <label for="">Costo total hasta el momento: {{$costo_total}}</label>
    </div>
    <div class="tab-pane fade show" id="historias" role="tabpanel" aria-labelledby="historias-tab">
        <table class="table">
            <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Inicio</td>
                    <td>Finaliza</td>
                    <td>Días</td>
                    <td>Estado</td>
                    <td>Detalles</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($historias as $historia)
                    <tr>
                        <td>{{$historia->nombre}}</td>
                        <td>{{$historia->fecha_inicio}}</td>
                        <td>{{$historia->fecha_fin}}</td>
                        <td>{{gmdate('d',(strtotime($historia->fecha_fin) - strtotime($historia->fecha_inicio)))}}</td>
                        <td>
                            {{$historia->estado}}
                        </td>
                        <td>
                            <a href="{{route('docente.generarPdf.getHistoriaPdfById',
                            [
                                'id_proyecto' => $id_proyecto,
                                'id_grupo' => $id_grupo,
                                'id_historia' => $historia->id
                            ])}}" class="btn btn-success">PDF</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <input type="hidden" name="api_route_get_historias_graficas" 
                id="api_route_get_historias_graficas" 
                value="{{route('docente.graficas.getHistoriasEstadosData', 
                array('id_grupo' => $id_grupo))}}">


            <div class="container-sm">
                <canvas id="estados_historias_grafica" class="chartjs-render-monitor" height="75"></canvas>
            </div>
        
    </div>
  </div>
@endsection

@section('modals')
<div class="modal fade" id="modalFasesDetalles" tabindex="-1" role="dialog" aria-labelledby="modalFasesDetalles" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Fase</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
              <div class="form-group">
                <label for="nombreFaseModal">Nombre:</label>
                <div class="col-sm-6">
                    <label for="" id="nombreFaseModal"></label>
                </div>
              </div>
              <div class="form-group">
                <label for="descripcionFaseModal">Descripcion:</label>
                <div class="col-xl-12">
                    <p id="descripcionFaseModal"></p>
                </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('custom_scripts')
    <script src="{{URL::asset('JS/AJAX/docente/historiasListaAJAX.js')}}"></script>
    <script src="{{URL::asset('JS/AJAX/docente/graficas/estadosHistorias.js')}}"></script>
@endsection