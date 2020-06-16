@extends('/Templates/Alumno/_LayoutAlumno')
@section('contenido')
    <br>
    <h3>Historias Usuario</h3>
    <br>
    <table class="table">
        <thead>
            <tr class="bg-warning">
                <td>Nombre</td>
                <td>Prioridad</td>
                <td>Descripcion</td>
                <td>Periodo de tiempo</td>
                <td>Usuario Entrevistado</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @if($historias == null)
                <tr>
                    <td>No</td>
                    <td>hay</td>
                    <td>Historias</td>
                    <td>de Usuario</td>
                    <td>disponibles</td>
                    <td>ahora</td>
                </tr>
            @else
                @foreach ($historias as $historia)
                    <tr>
                        <td>{{$historia->nombre}}</td>
                        <td>{{$historia->prioridad}}</td>
                        <td>{{$historia->Descripcion}}</td>
                        <td>{{$historia->fecha_inicio}} - {{$historia->fecha_fin}}</td>
                        <td>{{$historia->id_usuario_entrevistado}}</td>
                        <td>
                            <a href="#" class="btn btn-info">
                                <i class="fas fa-file-signature"></i>
                            </a>
                            <a href="#" class="btn btn-primary">
                                <i class="fas fa-file-signature"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection