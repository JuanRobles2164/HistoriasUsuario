@extends('Templates/Docente/_LayoutDocente')
@section('contenido')
    <form action="" method="POST">
        @csrf
        <label for="">Nombre</label>
        <input type="text" name="nombre">
        <br>
        <label for="">Descripcion</label>
        <input type="text" name="descripcion">
        <br>
        <label for="">Días para el desarrollo</label>
        <input type="text" name="fecha_limite">
        <br>
        <label for="">Metodologia</label>
        <select name="id_metodologia" id="">
            @foreach ($metodologias as $metodologia)
                <option value="{{$metodologia->id}}">{{$metodologia->nombre}}</option>
            @endforeach
        </select>
        <br>
        <input type="hidden" name="id_estado" value="1">
        <br>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
@endsection