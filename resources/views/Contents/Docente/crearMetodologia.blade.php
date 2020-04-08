@extends('Templates/Docente/_LayoutDocente')
@section('contenido')
<br>
    <form action="{{route('docente.postCrearMetodologia')}}" method="POST">
        @csrf
        <div class="jumbotron">
            <h1 class="display-4"><i class="fas fa-brain"></i> Crear una Metodología</h1>
            <br>
            @error('nombre')
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>¡Hey!,</strong> necesitamos el nombre de la metodolog&iacute;a
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @enderror
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Nombre</span>
                </div>
                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="nombre">
            </div>
            @error('descripcion')
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>¡Hey!,</strong> necesitamos una descripci&oacute;n de la metodolog&iacute;a
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @enderror
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Descripción</span>
                </div>
                <textarea class="form-control" aria-label="With textarea" name="descripcion"></textarea>
              </div>
            <hr class="my-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Crear</button>
          </div>
    </form>
@endsection