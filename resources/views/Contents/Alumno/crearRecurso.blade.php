@extends('/Templates/Alumno/_LayoutAlumno')
@section('contenido')
    <br>
    <h3></h3>
    <br>
    <form action="{{route('alumno.postCrearRecurso', array('id_modulo' => $id_modulo, 
        'id_proyecto' => $id_proyecto, 
        'id_fase' => $id_fase,
        'id_actividad' => $id_actividad,
        'id_recurso' => $id_recurso))}}" method="POST">
        @csrf
        <input type="hidden" name="id_proyecto" value="{{$id_proyecto}}">
        <input type="hidden" name="id_fase" value="{{$id_fase}}">
        <input type="hidden" name="id_modulo" value="{{$id_modulo}}">
        <input type="hidden" name="id_actividad" value="{{$id_actividad}}">
        <label for="">Nombre</label>
        <input type="text" name="nombre" id="">
        <br>
        <label for="">Descripcion</label>
        <textarea name="descripcion" id=""></textarea>
        <br>
        <label for="">Cantidad</label>
        <input type="number" name="cantidad" step="0.1" placeholder="$xx.xxx" min=0>
        <br>
        <label for="">Valor unitario</label>
        <input type="number" name="valor_unitario" step="0.1" min=0>
        <br>
        <select name="id_tipo_recurso" id="">
            @foreach ($tipos_recurso as $tipo_recurso)
                <option value="{{$tipo_recurso->id}}">{{$tipo_recurso->nombre}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-submit">Crear</button>
    </form>
@endsection
    