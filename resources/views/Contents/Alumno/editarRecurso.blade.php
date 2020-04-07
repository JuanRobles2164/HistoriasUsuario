@extends('/Templates/Alumno/_LayoutAlumno')
@section('contenido')
    <br>
    <h3>Editando recurso</h3>
    <br>
    <form action="{{route('alumno.postEditarRecurso', array('id_proyecto' => $id_proyecto, 
        'id_fase' => $id_fase,
        'id_modulo' => $id_modulo,
        'id_actividad' => $id_actividad,
        'id_recurso' => $id_recurso))}}" method="POST">
        @csrf
        <input type="hidden" name="id_proyecto" value="{{$id_proyecto}}">
        <input type="hidden" name="id_fase" value="{{$id_fase}}">
        <input type="hidden" name="id_modulo" value="{{$id_modulo}}">
        <input type="hidden" name="id_actividad" value="{{$id_actividad}}">
        <input type="hidden" name="id" value={{$recurso->id}}>
        <label for="">Nombre:</label>
        <input type="text" name="nombre" id="" value="{{$recurso->nombre}}">
        <br>
        <label for="">Descripcion</label>
        <textarea type="text" name="descripcion" id="">{{$recurso->descripcion}}</textarea>
        <br>
        <label for="">Cantidad</label>
        <input type="number" name="cantidad" id="" step="0.1" value="{{$recurso->cantidad}}">
        <br>
        <label for=""></label>
        <input type="number" name="valor_unitario" id="" step="0.1" value="{{$recurso->valor_unitario}}">
        <br>
        <label for="">Tipo de recurso</label>
        <select name="id_tipo_recurso" id="">
            @foreach ($tipos_recursos as $tipo_recurso)
                <option value="{{$tipo_recurso->id}}">{{$tipo_recurso->nombre}}</option>
            @endforeach
        </select>
        <br>
        <button type="submit" class="btn btn-warning">Editar</button>
    </form>
@endsection