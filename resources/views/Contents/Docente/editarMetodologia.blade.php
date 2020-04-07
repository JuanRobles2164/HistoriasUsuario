@extends('Templates/Docente/_LayoutDocente')
@section('contenido')
    <br>
    <h3> <i class="fas fa-pen-square"></i> Editar una Metodología</h3>
    <br>
    <form action="{{route('docente.postEditarMetodologia')}}" method="POST">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Editar</a>
              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Fuentes</a>
              <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Listado de Fuentes</a>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="jumbotron">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <input type="hidden" name="id" value="{{$metodologia->id}}">
                            <span class="input-group-text" id="basic-addon3" name="nombre" value="{{$metodologia->nombre}}">Nombre</span>
                        </div>
                        <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" name="descripcion" value="{{$metodologia->descripcion}}">Descripción</span>
                        </div>
                        <textarea class="form-control" aria-label="With textarea"></textarea>
                    </div>
                    <hr class="my-4">
                    <a class="btn btn-primary btn-lg btn-block" type="submit">Editar</a>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="jumbotron">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <input type="hidden" name="id" value="{{$metodologia->id}}">
                            <span class="input-group-text" name="url" id="url_fuente">URL</span>
                        </div>
                        <input type="text" class="form-control" aria-describedby="basic-addon3">
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" name="descripcion" id="descripcion_fuente">Descripción</span>
                        </div>
                        <textarea class="form-control" aria-label="With textarea"></textarea>
                    </div>
                    <hr class="my-4">
                    <a class="btn btn-primary btn-lg btn-block" type="submit" onclick="agregarFuenteMetodologia()" id="btn_agregar_fuente">
                        Agregar
                        <input type="hidden" name="id_metodologia" value="{{$metodologia->id}}" id="id_metodologia">
                    </a>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <br>
                <div id="listado_fuentes">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" valign="middle">URL</th>
                                <th scope="col" valign="middle">Descripcion</th>
                                <th scope="col" valign="middle">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fuentes as $fuente)
                                <tr>
                                    <th scope="row">
                                        <a href="{{$fuente->url}}" target="_blank">Redirigir</a>
                                    </th>
                                    <th scope="row">{{$fuente->descripcion}}</th>
                                    <th scope="row">
                                        <a href="{{route('docente.eliminarFuenteMetodologia', 'id='.$fuente->id)}}" class="btn btn-danger">Eliminar</a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
    </form>
@endsection