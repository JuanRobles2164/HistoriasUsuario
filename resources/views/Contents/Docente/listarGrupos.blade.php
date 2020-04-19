@extends('Templates/Docente/_LayoutDocente')
@section('contenido')
<br>
<h3> <i class="fas fa-users"></i> Grupos: <!--{$proyecto->nombre}}--></h3>
<br>
<nav class="navbar navbar-expand-lg navbar-light bg-light">  
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a href="#" class="btn btn-success">Nuevo grupo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"> </a>
        </li>
        <li class="nav-item">
          <button type="submit" class="btn btn-warning">Observaci&oacute;n</button>
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
                <td style="text-align: center;">Nombre</td>
                <td style="text-align: center;">Progreso</td>
                <td style="text-align: center;">Integrantes</td>
                <td style="text-align: center;">Estado</td>
                <td style="text-align: center;">Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($grupos as $grupo)
                <tr>
                    <th style="text-align: center;">
                        <a href="#" class="btn btn-danger btn-sm">
                            <i class="far fa-trash-alt"></i>
                        </a>
                        <label for="">{{$grupo->nombre}}</label>
                    </th>
                    <th style="text-align: center;"> </th>
            }
                    <th style="text-align: center;">
                        
                        <!--<label for="">($grupo->Integrantes)}}</label> <br>-->
                    </th>
                    @if ($grupo->estado_activo == 1)
                        <th style="text-align: center;">
                            <a href="#'"&id_estado="" class="btn btn-success">Activo</a>
                        </th>
                    @else
                        <th style="text-align: center;">
                            <a href="#"&id_estado="" class="btn btn-danger">Inactivo</a>
                        </th>
                    @endif
                    <th style="text-align: center;">
                        <a href="#" a class="btn btn-success btn-sm">
                            <i class="<i class="fas fa-clipboard"></i>
                        </a>
                        <a href="#" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                         <a href="#" a class="btn btn-success btn-sm">
                            <i class="far fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-success" aria-placeholder="Detalles">Detalles</a>
                        <a href="#" class="btn btn-info" >Supervisar</a>
                        <a href="#" class="btn btn-warning" aria-placeholder="Editar">Editar</a>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection