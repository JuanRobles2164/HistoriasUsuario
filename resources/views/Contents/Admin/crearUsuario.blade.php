@extends('Home-admin')
@section('contenido')
    <form action="{{route('admin.postCreate')}}" method="POST">
        @csrf
        <div class="form-group">

            <label for="">Nombres</label>
            <input type="text" name="nombres">

            <label for="">Apellidos</label>
            <input type="text" name="apellidos">

            <label for="">Correo electrónico</label>
            <input type="text" name="email">

            <label for="">Identificacion</label>
            <input type="text" name="identificacion">

            <label for="">Contraseña</label>
            <input type="text" name="clave">
            
            <label for="">Seleccione el rol:</label>
            <select name="rol" id="">
                @foreach ($roles as $rol)
                    <option value="{{$rol->id}}"> {{$rol->abreviatura}}</option>
                @endforeach
            </select>
            <button type="submit">CREAR</button>
        </div>
    </form>
@endsection