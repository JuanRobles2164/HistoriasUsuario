@extends('/Templates/Docente/_LayoutDocente')
@section('contenido')
<!-- Para agregar nuevos alumnos al proyecto-->
<h1>Supervisando: {{$proyecto->nombre}}</h1>
<br>
<form action="{{route('docente.postAsignarAlumnoProyecto', $proyecto->id)}}" method="POST">
    @csrf
    <input type="hidden" name="id_proyecto" value="{{$proyecto->id}}">
    <div class="container">
        <fieldset>
            <legend>Seleccionar alumnos</legend>
            <input type="checkbox" id="check_all">
            <label for="check_all">Seleccionar todos</label>
            <br>
            <div name="cajaDePrueba">
                @foreach ($alumnos as $alumno)
                    <input type="checkbox" name="id_alumnos[]" value="{{$alumno->id}}">
                    <label for="">{{$alumno->e_mail}}</label>
                    <br>
                @endforeach
            </div>
            
        </fieldset>
        <button type="submit" class="btn btn-success">Agregar</button>
    </div>
</form>

@endsection