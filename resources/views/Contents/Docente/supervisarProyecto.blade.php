@extends('/Templates/Docente/_LayoutDocente')
@section('contenido')
<!-- Para agregar nuevos alumnos al proyecto-->
<h1>Supervisando: {{$proyecto->nombre}}</h1>
<br>
    <div class="listado_estudiantes">
        
    </div>
@endsection