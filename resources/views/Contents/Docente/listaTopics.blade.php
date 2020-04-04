@extends('/Templates/Docente/_LayoutDocente')
@section('contenido')
    <br>
    <h3>Temas de historias de usuario</h3>
    <br>
    <table class="table">
        <thead>
            <tr class="bg-warning">
                <td>Nombre</td>
                <td>Estado</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($temas as $tema)
                <tr>
                    <td>{{$tema->nombre}}</td>
                    @if($tema->estado_eliminado == 0)
                        <td>
                            <a href="" class="btn btn-danger">Inactivo</a>
                        </td>
                    @else
                        <td>
                            <a href="" class="btn btn-success">Activo</a>
                        </td>
                    @endif
                    <td><a href="#">Editar</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection