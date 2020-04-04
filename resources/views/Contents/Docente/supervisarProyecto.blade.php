@extends('/Templates/Docente/_LayoutDocente')
@section('contenido')
<!-- Para agregar nuevos alumnos al proyecto-->
<h1>Supervisando: {{$proyecto->nombre}}</h1>
<br>
<ul class="nav nav-tabs" id="tabSupervisionGrupo" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="listadoAvanceGrupos" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Avances</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
    </li>
  </ul>
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
<br>

<div>
    <a class="btn btn-primary">Nuevo grupo</a>
</div>
@endsection