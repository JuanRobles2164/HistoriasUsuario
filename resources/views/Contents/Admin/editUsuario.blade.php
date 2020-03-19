@extends('Home-admin')
@section('contenido')
    <form action="{{route('admin.postEdit')}}" method="POST">
        @csrf
        <label for=""></label>
        <input type="hidden" name="id" value="{{$usuario->id}}" id="id">

        <label for="">Nombres:</label>
        <input type="text" name="nombres" id="" value="{{$usuario->nombres}}">

        <label for="">Apellidos</label>
        <input type="text" name="apellidos" id="" value="{{$usuario->apellidos}}">

        <label for="">Identificacion</label>
        <input type="text" name="identificacion" id="" value="{{$usuario->identificacion}}">

        <label for="">Nombre de usuario:</label>
        <input type="text" name="username" id="" value="{{$usuario->username}}">

        <label for="">Correo electrónico</label>
        <input type="text" name="email" id="" value="{{$usuario->e_mail}}">

        <label for="">Contraseña:</label>
        <input type="password" name="contrasenia" id="" value="{{$usuario->contrasenia}}">

        <button type="submit">Editar</button>
    </form>
@endsection