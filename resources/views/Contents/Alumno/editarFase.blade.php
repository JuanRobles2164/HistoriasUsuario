@extends('/Templates/Alumno/_LayoutAlumno')
@section('contenido')
    <br>
    <h3>Editando la fase: {{$fase->nombre}}</h3>
    <br>
    <form action="{{route('alumno.postEditarFase')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$fase->id}}">
        <input type="hidden" name="id_proyecto" value="{{$fase->id_proyecto}}">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="{{$fase->nombre}}">
        <br>
        <label for="descripcion">Descripcion:</label>
        <textarea name="descripcion" id="descripcion" cols="30" rows="10">{{$fase->descripcion}}</textarea>
        <br>
        <label for="">Fecha límite?</label>
        <input type="date" name="fecha_limite" id="" value="{{$fase->fecha_limite}}">
        <br>
        <label for="">Imagen actual:</label>
        <img src="{{asset('storage').'/'.$fase->miniatura_fase}}" alt="" height="150">
        <input type="hidden" name="miniatura_hidden" value="{{$fase->miniatura_fase}}">
        <br>
        <label for="">AsignarUnaImagen</label>
        <input type="file" name="miniatura_fase" id="">
        <br>
        <label for="">¿Eliminar imagen?</label>
        <input type="checkbox" name="eliminar_miniatura" id="">
        <br>
        <button type="submit" class="btn btn-warning">Editar</button>
    </form>
    <br>
    <br>
    <br>
    @if($objetivo == null)
        <h4>Crear el objetivo</h4>
        <form action="{{route('alumno.postEditarCrearObjetivo')}}" method="POST">
            @csrf
            <input type="hidden" name="id_proyecto" value="{{$fase->id_proyecto}}">
            <input type="hidden" name="id_fase" value="{{$fase->id}}">
            <label for="nombre">nombre</label>
            <input type="text" name="nombre" id="nombre">
            <br>
            <label for="descripcion">descripcion</label>
            <input type="text" name="descripcion" id="descripcion">
            <br>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    @else
        <h4>Editar el objetivo</h4>
        <form action="{{route('alumno.postEditarCrearObjetivo')}}" method="POST">
            @csrf
            <input type="hidden" name="id_fase" value="{{$objetivo->id_fase}}">
            <label for="nombre">nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{$objetivo->nombre}}">
            <br>
            <label for="descripcion">descripcion</label>
            <input type="text" name="descripcion" id="descripcion" value="{{$objetivo->descripcion}}">
            <input type="hidden" name="id_proyecto" value="{{$fase->id_proyecto}}">
            <button type="submit" class="btn btn-warning">Editar</button>
        </form>
    @endif
@endsection