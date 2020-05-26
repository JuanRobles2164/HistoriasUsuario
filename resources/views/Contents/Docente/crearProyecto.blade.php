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
                        <div class="col-md-4 mb-3">
                            <div class="form-group two-fields">
                                <label for="validationCustom05">Metodología</label>
                                <div class="input-group">
                                    <select class="custom-select" id="validationDefault05" name="id_metodologia" required>
                                        @foreach ($metodologias as $metodologia)
                                            <option value="{{$metodologia->id}}">{{$metodologia->nombre}}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModalCenter">
                                        Agregar
                                    </button>
                                </div>
                            </div>
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

@section('modals')
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Agregar Metodología <i class="fas fa-brain"></i></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <label for="recipient-name" class="col-form-label text-info">Desde aca tambien puedes crear una metodología, solo es una acceso rápido.</label>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Descripción:</label>
              <textarea class="form-control" id="message-text"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Crear</button>
        </div>
      </div>
    </div>
  </div>
@endsection