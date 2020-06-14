@extends('Templates/Docente/_LayoutDocente')
@section('contenido')
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <p>{{$error}}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
    @endforeach
@endif
    <form action="{{route('docente.postEditarProyecto')}}" method="POST">
        <br>
        <div class="jumbotron jumbotron-fluid">
            <div class="container-fluid" style="margin:0px 80px">
                    @csrf
                    <input type="hidden" value="{{$proyecto->id}}" name="id">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                          <label for="validationCustom01">Nombre</label>
                          <input type="text" class="form-control" name="nombre" value="{{$proyecto->nombre}}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">Descripción</label>
                            <input type="text" class="form-control" name="descripcion" value="{{$proyecto->descripcion}}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom03">Fecha inicial:</label>
                            <input type="date" class="form-control" name="fecha_inicial" value="{{$proyecto->fecha_inicial}}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom04">Fecha límite:</label>
                            <input type="date" class="form-control" name="fecha_limite" value="{{$proyecto->fecha_limite}}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom05">Metodología</label>
                            <select class="custom-select" id="validationDefault05" name="id_metodologia" required>
                                @foreach ($metodologias as $metodologia)
                                    @if($proyecto->id_metodologia == $metodologia->id)
                                        <option selected="selected" value="{{$metodologia->id}}">{{$metodologia->nombre}}</option>
                                    @endif
                                    <option value="{{$metodologia->id}}">{{$metodologia->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5 mb-3">
                            <label class="text-danger" id="label_fecha_limite">La fecha actual de finalización del proyecto es: {{$proyecto->fecha_limite}}</label>
                            <input type="hidden" id="fecha_limite_element" value="{{$proyecto->fecha_limite}}">
                        </div>
                    </div>        
            </div>
            <p class="text-center">
                <button type="submit" class="btn btn-warning btn-lg">Editar</button>
            </p>
        </div>
    </form>
@endsection