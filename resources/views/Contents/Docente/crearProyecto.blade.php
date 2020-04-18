@extends('Templates/Docente/_LayoutDocente')
@section('contenido')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
    <form action="{{route('docente.postCrearProyecto')}}" method="POST">
        <br>
        <div class="jumbotron jumbotron-fluid">
            <div class="container-fluid" style="margin:0px 80px;">
              <h2 class="display-4" style="margin:30px 220px"> <i class="fas fa-project-diagram"></i> Nuevo Proyecto</h2>
                <form>
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                          <label for="validationCustom01">Nombre</label>
                          <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">Descripción</label>
                            <input type="text" class="form-control" name="descripcion" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom03">Fecha inicial:</label>
                            <input type="date" class="form-control" name="fecha_inicial" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom04">Fecha límite:</label>
                            <input type="date" class="form-control" name="fecha_limite" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom05">Metodología</label>
                            <select class="custom-select" id="validationDefault05" name="id_metodologia" required>
                                @foreach ($metodologias as $metodologia)
                                    <option value="{{$metodologia->id}}">{{$metodologia->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="id_estado" value="1">
                </form>        
            </div>
            <br>
            <p class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">Crear</button>
            </p>  
        </div>
    </form>
@endsection