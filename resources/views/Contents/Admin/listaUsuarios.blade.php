@extends('Home-admin')
@section('contenido')
    <table class="table">
        <thead>
            <tr>
                <th>Nombre completo</th>
                <th>Identificacion</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{$usuario->nombres.' '.$usuario->apellidos}}</td>
                    <td>{{$usuario->identificacion}}</td>
                    <td>{{$usuario->e_mail}}</td>
                    <td>{{$usuario->abreviatura}}</td>
                    <td>
                        <a href="#">Ver</a>
                        <a href="#">Editar</a>
                        <a href="#">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection