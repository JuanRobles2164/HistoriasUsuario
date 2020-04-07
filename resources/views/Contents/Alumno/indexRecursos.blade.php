@extends('/Templates/Alumno/_LayoutAlumno')
@section('contenido')
    <br>
    <h3>Lista de recursos</h3>
    <br>
    
    <h5>Crear tipo de recurso</h5>
    <br>
    <form action="{{route('alumno.postCrearTipoRecurso')}}" method="POST">
        @csrf
        <label for="">nombre</label>
        <input type="text" name="nombre" id="">
        <br>
        <label for="">Descripcion:</label>
        <textarea type="text" name="descripcion" id=""></textarea>
        <br>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
    <a href="{{route('alumno.getCrearRecurso', array('id_modulo' => $id_modulo,'id_proyecto' => $id_proyecto,'id_fase' => $id_fase, 'id_actividad' => $id_actividad))}}" class="btn btn-dark">Crear recurso</a>
    <table class="table">
        <thead>
            <tr class="bg-warning">
                <th>Nombre</th>
                <th>$ Valor unitario</th>
                <th>Cantidad</th>
                <th>Tipo de recurso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recursos as $recurso)
                <tr>
                    <th>{{$recurso->nombre}}</th>
                    <th>{{$recurso->valor_unitario}}</th>
                    <th>{{$recurso->cantidad}}</th>
                    <th>{{$recurso->tipo_recurso}}</th>
                    <th>
                        <a href="{{route('alumno.getEditarRecurso', array('id_modulo' => $id_modulo,'id_proyecto' => $id_proyecto,'id_fase' => $id_fase, 'id_actividad' => $id_actividad, 'id_recurso' => $recurso->id))}}">Editar</a>
                        <a href="">Eliminar</a>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection