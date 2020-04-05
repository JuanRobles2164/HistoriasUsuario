@extends('/Templates/Alumno/_LayoutAlumno')
@section('contenido')
    <br>
    <h3>Proyectos</h3>
    <br>
    <table class="table">
        <thead>
            <tr class="bg-warning">
                <td>Nombre</td>
                <td>Docente</td>
                <td>Metodologia</td>
                <td>Estado</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @if($proyectos == null)
                <tr>
                    <td>No</td>
                    <td>hay</td>
                    <td>proyectos</td>
                    <td>disponibles</td>
                    <td>ahora</td>
                </tr>
            @else
                @foreach ($proyectos as $proyecto)
                    <tr>
                        <td>{{$proyecto->nombre}}</td>
                        <td>{{$proyecto->docente}}</td>
                        <td>{{$proyecto->metodologia}}</td>
                        <td>
                            @if ($proyecto->id_estado == 1)
                                <a class="btn btn-success">Activo</a>
                            @else
                                <a class="btn btn-danger">Inactivo</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('alumno.getFasesProyecto', $proyecto->id)}}" class="btn btn-info">Trabajar</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection