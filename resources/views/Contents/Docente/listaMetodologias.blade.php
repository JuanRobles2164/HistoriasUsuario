@extends('Templates/Docente/_LayoutDocente')
@section('contenido')
<br>
<h3>Lista de metodologías</h3>
<br>
<div style="text-align:center">
   <table class="table table-hover">
      <thead class="bg-primary">
         <tr>
            <th scope="col" valign="middle" style="text-align: center">Nombre</th>
            <th scope="col" valign="middle" style="text-align: center">Descripción</th>
            <th scope="col" valign="middle" style="text-align: center">Estado</th>
            <th scope="col" valign="middle" style="text-align: center">Acciones</th>
         </tr>
      </thead>
      @foreach ($metodologias as $metodologia)
         <tr style="border-color: black; border-radius: 1px; vertical-align:middle; height:100%">
            <td scope="row" valign="middle">{{$metodologia->nombre}}</td>
            <td scope="row" valign="middle">{{$metodologia->descripcion}}</td>
            @if($metodologia->estado_eliminado == 0)
               <td scope="row" valign="middle">Activa</td>
            @else
               <td scope="row" valign="middle">Eliminada</td>
            @endif
            <td scope="row" valign="middle">
               <a href="#" class="btn btn-info btn-sm">
                  <i class="fas fa-eye"></i>
               </a>
               <a href="{{route('docente.getEditarMetodologia', 'id='.$metodologia->id)}}" a class="btn btn-success btn-sm">
                  <i class="far fa-edit"></i>
               </a>
               <a href="#" class="btn btn-danger btn-sm">
                  <i class="far fa-trash-alt"></i>
               </a>
            </td>
         </tr>
      @endforeach
   </table>
</div>

@endsection