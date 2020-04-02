@extends('Templates/Docente/_LayoutDocente')
@section('contenido')
<br>
<h3>Editar una metodología</h3>
<br>
<form action="{{route('docente.postEditarMetodologia')}}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{$metodologia->id}}">
    <br>
    <label for="">Nombre</label>
    <input type="text" name="nombre" value="{{$metodologia->nombre}}">
    <br>
    <br>
    <label for="">Descripción</label>
    <input type="textarea" name="descripcion" value="{{$metodologia->descripcion}}">
    <br>
    <br>
    <button type="submit" class="btn btn-warning">Editar</button>
</form>

<div>
    <h5>Fuentes</h5>
    <div>
        <br>
        <label for="">URL</label>
        <input type="text" name="url" id="url_fuente">
        <br>
        <label for="">Descripcion</label>
        <textarea type="text" name="descripcion" id="descripcion_fuente"></textarea>
        <br>
        <input type="hidden" name="id_metodologia" value="{{$metodologia->id}}" id="id_metodologia">
        <a class="btn btn-success" onclick="agregarFuenteMetodologia()" id="btn_agregar_fuente">+</a>
    </div>

    <div id="listado_fuentes">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" valign="middle" align="center">URL</th>
                    <th scope="col" valign="middle" align="center">Descripcion</th>
                    <th scope="col" valign="middle" align="center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fuentes as $fuente)
                    <tr>
                        <th scope="row">
                            <a href="{{$fuente->url}}" target="_blank">Redirigir</a>
                        </th>
                        <th scope="row">{{$fuente->descripcion}}</th>
                        <th scope="row">
                            <a href="{{route('docente.eliminarFuenteMetodologia', 'id='.$fuente->id)}}" class="btn btn-danger">Eliminar</a>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>

@endsection