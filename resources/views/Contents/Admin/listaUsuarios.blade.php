@extends('Home-admin')
@section('contenido')
<br>
<h3>Lista de usuarios</h3>
<br>
    <table class="table">
        <thead class="thead-dark">
            <tr >
                <th scope="col">Nombre completo</th>
                <th scope="col">Identificacion</th>
                <th scope="col">Correo</th>
                <th scope="col">Rol</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr style="border-color: black; border-radius: 1px;">
                    <td scope="row">{{$usuario->nombres.' '.$usuario->apellidos}}</td>
                    <td scope="row">{{$usuario->identificacion}}</td>
                    <td scope="row">{{$usuario->e_mail}}</td>
                    <td scope="row">{{$usuario->abreviatura}}</td>
                    <td scope="row">
                        <a href="#">Ver</a>|
                        <a href="{{route('admin.getEdit', 'id='.$usuario->id)}}">Editar</a>|
                        <a href="#">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection