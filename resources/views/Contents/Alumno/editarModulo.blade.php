@extends('/Templates/Alumno/_LayoutAlumno')
@section('contenido')
    <br>
    <h3>Editando módulo</h3>
    <br>
    <form action="{{route('alumno.postEditarModulo', array('id_proyecto' => $id_proyecto, 'id_fase' => $id_fase, 'id_modulo' => $modulo->id))}}" method="POST">
        @csrf
        <input type="hidden" name="id_proyecto" value="{{$id_proyecto}}">
        <input type="hidden" name="id_fase" value="{{$id_fase}}">
        <input type="hidden" name="id" value="{{$modulo->id}}">
        <br>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="{{$modulo->nombre}}">
        <br>
        <label for="descripcion">Descripcion:</label>
        <input type="text" name="descripcion" value="{{$modulo->descripcion}}">
        <br>
        <label for="">Fecha límite:</label>
        <input type="date" name="fecha_limite" id="fecha_limite" value="{{$modulo->fecha_limite}}">
        <br>
        <button type="submit" class="btn btn-warning">Editar</button>
        <br>
    </form>
@endsection
