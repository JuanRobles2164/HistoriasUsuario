@extends('Templates/Docente/_LayoutDocente')
@section('contenido')
<br>
<h3>Lista de metodologías</h3>
<br>
<center>
   <table class="table table-hover" style="line-height: 400px;">
      <thead class="thead-dark">
         <tr>
            <th scope="col" valign="middle" style="text-align: center">Nombre</th>
            <th scope="col" valign="middle" style="text-align: center">Descripcion</th>
            <th scope="col" valign="middle" style="text-align: center">Estado</th>
            <th scope="col" valign="middle" style="text-align: center">Acciones</th>
         </tr>
      </thead>
      @foreach ($metodologias as $metodologia)
      <tr style="border-color: black; border-radius: 1px; vertical-align:middle; height:100%">
         <td scope="row" valign="middle" align="center" style="line-height: 30px;">{{$metodologia->nombre}}</td>
         <td scope="row" valign="middle" align="center" style="line-height: 30px;">{{$metodologia->descripcion}}</td>
         @if($metodologia->estado == 0)
            <td scope="row" valign="middle" align="center" style="line-height: 30px;">Activo</td>
         @else
            <td scope="row" valign="middle" align="center" style="line-height: 30px;">Eliminado</td>
         @endif
         <td scope="row" valign="middle" align="center" style="line-height: 30px;">
            <a href="#" class="btn btn-info btn-sm">
               <i class="glyphicon glyphicon-zoom-in"></i>
            </a>
            <a href="#" <a class="btn btn-success btn-sm">
            <i class="glyphicon glyphicon-pencil"></i>
            </a>
            <a href="#" <a class="btn btn-warning btn-sm">
               <i class="glyphicon glyphicon-refresh"></i>
            </a>
            <a href="#" class="btn btn-danger btn-sm">
               <i class="glyphicon glyphicon-trash"></i>
            </a>
         </td>
      </tr>
      @endforeach
   </table>
</center>

@endsection