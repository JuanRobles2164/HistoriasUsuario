@extends('Templates/Docente/_LayoutDocente')
@section('contenido')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
    <form action="{{route('docente.postCrearProyecto')}}" method="POST">
        @csrf
        <label for="">Nombre</label>
        <input type="text" name="nombre">
        <br>
        <label for="">Descripcion</label>
        <input type="text" name="descripcion">
        <br>
        <label for="fecha_limite">Fecha inicial:</label>
        <input type="date" name="fecha_inicial">
        <br>
        <label for="fecha_limite">Fecha límite:</label>
        <input type="date" name="fecha_limite">
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