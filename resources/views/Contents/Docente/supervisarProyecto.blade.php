@extends('/Templates/Docente/_LayoutDocente')
@section('contenido')
<!-- Para agregar nuevos alumnos al proyecto-->
<h1>Supervisando: {{$proyecto->nombre}}</h1>
<br>
<form action="{{route('docente.postAsignarAlumnoProyecto', $proyecto->id)}}" method="POST">
    @csrf
    <input type="hidden" name="id_proyecto" value="{{$proyecto->id}}">
    <div class="lista_estudiantes_sin_asignar">
        <div class="style=border:2px solid #ccc; width:500px; height: 400px; overflow-y: scroll;">
            <select name="id_alumnos[]" multiple>
                @foreach ($alumnos as $alumno)
                    <option value="{{$alumno->id}}"> <th>{{$alumno->nombres}}</th> -> <th>{{$alumno->username}}</th></option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Agregar</button>
    </div>
</form>

@endsection