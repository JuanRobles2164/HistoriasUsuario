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
        <a href="#" class="btn btn-success" onclick="agregarFuenteMetodologia()">+</a>
    </div>

    <div id="listado_fuentes">
        @if(isset($fuentes))
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" valign="middle" align="center" style="text-align: center">URL</th>
                    <th scope="col" valign="middle" align="center" style="text-align: center">Descripcion</th>
                    <th scope="col" valign="middle" align="center" style="text-align: center">Acciones</th>
                </tr>
            </thead>
            <tbody id="tbody_container">
                <tr id="tr_no_elements">
                    <td scope=row valign=middle align=center id=td_url_no_element>NO HAY ELEMENTOS DISPONIBLES</td>
                    <td scope="row" valign="middle" align="center" id="td_descripcion_no_element">NO HAY ELEMENTOS DISPONIBLES</td>
                    <td scope="row" valign="middle" align="center" id="btnSectionFuente">
                        <a href="#" class="btn btn-warning" id="btnEditarFuente">Editar</a>
                        <a href="#" class="btn btn-danger" id="btnEliminarFuente">Eliminar</a>
                    </td>
                </tr>
            </tbody>
        </table>
        @else
            
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
                                <th scope="row">{{$fuente->url}}</th>
                                <th scope="row">{{$fuente->descripcion}}</th>
                                <th scope="row">
                                    <a href="#" class="btn btn-warning">Editar</a>
                                    <a href="{{route('docente.eliminarFuenteMetodologia', 'id='.$fuente->id)}}" class="btn btn-danger">Eliminar</a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        @endif
    </div>
    
</div>

@endsection