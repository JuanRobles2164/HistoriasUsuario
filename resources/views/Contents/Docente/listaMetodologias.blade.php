@extends('Templates/Docente/_LayoutDocente')
@section('contenido')
@if(isset($msj))
   <div class="alert alert-danger alert-dismissible fade show" role="alert">
   <strong>¡{{$msj}}!</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
      </button>
   </div>
@endif
<br>
<h3>Lista de metodologías</h3>
<br>
<div style="text-align:center">
   <table class="table">
      <thead class="bg-primary">
         <tr>
            <td scope="col" valign="middle" style="text-align: center">Nombre</td>
            <td scope="col" valign="middle" style="text-align: center">Descripción</td>
            <td scope="col" valign="middle" style="text-align: center">Estado</td>
            <td scope="col" valign="middle" style="text-align: center">Acciones</td>
         </tr>
      </thead>
      <tbody>
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
                  <a class="btn btn-info btn-sm" style="color: white;" onclick="consultandometodologia({{$metodologia->id}})">
                     <i class="fas fa-eye"></i>
                  </a>
                  <a href="{{route('docente.getEditarMetodologia', 'id='.$metodologia->id)}}" a class="btn btn-success btn-sm">
                     <i class="far fa-edit"></i>
                  </a>
                  <a href="{{route('docente.getEliminarMetodologia', 'id='.$metodologia->id)}}" class="btn btn-danger btn-sm">
                     <i class="far fa-trash-alt"></i>
                  </a>
               </td>
            </tr>
         @endforeach
      </tbody>
    </table>
</div>
@endsection

@section('modals')
<div class="modal fade" tabindex="-1" role="dialog" id="modalmetodologia">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detalles Metodología</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form>
            <div class="form-group">
              <label for="nombre_metodologia" class="col-form-label">Nombre:</label>
              <input disabled type="text" class="form-control" id="nombre_metodologia">
            </div>
            <div class="form-group">
              <label for="descripcion_metodologia" class="col-form-label">Descripción:</label>
              <textarea disabled class="form-control" id="descripcion_metodologia"></textarea>
            </div>
         </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCierramodalmetodologia">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('custom_scripts')
   <script src="{{URL::asset('JS/AJAX/docente/historiasListaAJAX.js')}}"></script>
@endsection