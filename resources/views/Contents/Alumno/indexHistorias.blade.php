@extends('/Templates/Alumno/_LayoutAlumno')
@section('contenido')
    <br>
    <h3>Historias de usuario</h3>
    <br>
    <!-- Formulacio para crear historias de usuario-->
    <h5>Agregar una historia de usuario</h5>
    <form action="" method="POST">
        @csrf
        
    </form>
    <!-- Formulacio para crear historias de usuario-->
@endsection