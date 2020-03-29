@extends('Templates/Docente/_LayoutDocente')
@section('contenido')
    <form action="{{route('docente.postEditarProyecto')}}" method="POST">
        @csrf
        <input type="hidden" value="{{$proyecto->id}}" name="id">
        <label for=""></label>
        <input type="text" name="nombre" value="{{$proyecto->nombre}}">
        <br>
        <label for=""></label>
        <input type="text" name="descripcion" value="{{$proyecto->descripcion}}">
        <br>
        <label for="">Agregar o quitar días de trabajo al proyecto:</label>
        <input type="text" name="dias_extra" value="0">
        <br>
        <label for="" id="label_fecha_limite">La fecha actual de finalización del proyecto es: {{$proyecto->fecha_limite}}</label>
        <input type="hidden" id="fecha_limite_element" value="{{$proyecto->fecha_limite}}">
        <br>
        <button type="submit" class="btn btn-warning">Editar</button>
    </form>
@endsection