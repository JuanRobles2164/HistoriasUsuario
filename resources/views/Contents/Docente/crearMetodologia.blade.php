@extends('Templates/Docente/_LayoutDocente')
@section('contenido')
<br>
<h3>Crear una metodología</h3>
<br>
    <form action="{{route('docente.postCrearMetodologia')}}" method="POST">
        @csrf
        <div>
            <label for="">Nombre</label>
            <input type="text" name="nombre">
            <br>
            <label for="">Descripcion</label>
            <textarea type="textarea" name="descripcion"></textarea>
            <br>
            <button type="submit">Crear</button>
        </div>
    </form>
    <br>

@endsection