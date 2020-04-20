@extends('Templates/Docente/_LayoutDocente')
@section('contenido')
<br>
<form>
    <div class="row">
      <div class="col">
        <h3>Grupos  </h3>
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
          <button type="submit" class="btn btn-secondary">Observaci&oacute;n</button>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Buscar Grupo">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i> Buscar</button>
      </form>
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
                        <a href="#" class="btn btn-danger btn-sm">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </th>
                    <th style="text-align: center;">
                        <label for="">{{$grupo->nombre}}</label>
                    </th>
                    <th style="text-align: center;display: table-cell;vertical-align: middle;"> 
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 25%;line-height:50px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                        </div>
                    </th>
                    <th style="text-align: center; center;display: table-cell;vertical-align: middle;">
                        <div class="">
                        @foreach ($integrantes->{$grupo->id} as $integrante)
                            <p style="font-size:12px;  line-height:5px;" > {{$integrante->nombres}}</p> 
                        @endforeach
                        </div>
                    </th>
                    @if ($grupo->estado_activo == 1)
                        <th style="text-align: center;">
                            <a href="{{route('docente.getAlternarEstadoGrupo',  array('id_proyecto' => $grupo->id_proyecto, 'id' => $grupo->id, 'id_estado' => $grupo->estado_activo))}}" class="btn btn-success">Activo</a>
                        </th>
                    @else
                        <th style="text-align: center;">
                            <a href="{{route('docente.getAlternarEstadoGrupo',  array('id_proyecto' => $grupo->id_proyecto, 'id' => $grupo->id, 'id_estado' => $grupo->estado_activo))}}" class="btn btn-danger">Inactivo</a>
                        </th>
                    @endif
                    <th style="text-align: center;">
                        <a href="#" a class="btn btn-dark btn-sm">
                            <i class="fas fa-clipboard"> </i>
                        </a>
                        <a href="#" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                         <a href="#" a class="btn btn-warning  btn-sm">
                            <i class="far fa-edit"></i>
                        </a>
                        <a href="{{route('docente.getAsignarAlumnoGrupo', array('id_proyecto' => $grupo->id_proyecto, 'id_grupo' => $grupo->id) )}}" a class="btn btn-light btn-sm">
                            <i class="fas fa-user-plus"></i>
                        </a>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection