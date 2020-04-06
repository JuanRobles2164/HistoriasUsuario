@extends('Templates/Admin/_LayoutAdmin')
@section('contenido')
      <br>
      <h3>Lista de usuarios</h3>
      <br>
      <div class="center">
         <table class="table">
            <thead class="thead-dark">
               <tr>
                  <th scope="col" valign="middle" style="text-align: center">Nombre completo</th>
                  <th scope="col" valign="middle" style="text-align: center">Identificacion</th>
                  <th scope="col" valign="middle" style="text-align: center">Correo</th>
                  <th scope="col" valign="middle" style="text-align: center">Rol</th>
                  <th scope="col" valign="middle" style="text-align: center">Estado</th>
                  <th scope="col" valign="middle" style="text-align: center">Acciones</th>
               </tr>
            </thead>
            @foreach ($usuarios as $usuario)
               <tr style="border-color: black; border-radius: 1px; vertical-align:middle; height:100%">
                  <td style="text-align: center" scope="row" valign="middle">{{$usuario->nombres.' '.$usuario->apellidos}}</td>
                  <td style="text-align: center" scope="row" valign="middle">{{$usuario->identificacion}}</td>
                  <td style="text-align: center" scope="row" valign="middle">{{$usuario->e_mail}}</td>
                  <td style="text-align: center" scope="row" valign="middle">{{$usuario->abreviatura}}</td>
                  @if($usuario->estado_eliminado == 0)
                     <td scope="row" style="text-align: center" valign="middle">
                        <a class="btn btn-success" href="{{route('admin.eliminarUsuario', 'id='.$usuario->id.'&eliminado='.$usuario->estado_eliminado)}}">
                           Activos 
                        </a>                     
                     </td>
                  @else
                     <td scope="row" style="text-align: center" valign="middle">
                        <a class="btn btn-danger" href="{{route('admin.eliminarUsuario', 'id='.$usuario->id.'&eliminado='.$usuario->estado_eliminado)}}">
                           Inactivo
                        </a>
                     </td>
                  @endif
                  <td href="#" scope="row" style="text-align: center" valign="middle">      
                     <a class="btn btn-info btn-sm"  onclick="detallesUsuario({{$usuario->id}})">
                        <i class="fas fa-search-plus"></i>
                     </a>
                     <a href="{{route('admin.getEdit', 'id='.$usuario->id)}}" a class="btn btn-success btn-sm">
                        <i class="far fa-edit"></i>
                     </a>
                     <a href="{{route('admin.restaurarUsuario', 'id='.$usuario->id)}}" a class="btn btn-warning btn-sm">
                        <i class="fas fa-sync"></i>
                     </a>
                  </td>
               </tr>
            @endforeach
         </table>
      </div>
      <footer class="blockquote-footer">
         <cite> © 2020 Copyright: GEA Software. </cite>
      </footer>
@endsection

@section('modal_detalles')
<div class="modal" tabindex="-1" role="dialog" id="modalDetalles">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title">Detalles</h5>
       </div>
       <div class="modal-body">
          <!--Información del usuario, desplegada-->
         <form>
            <div class="form-row align-items-center">
               <div class="col-auto">
                  <label for="nombresUsuario">Nombres: </label>
                  <input for="" class="form-control mb-2" id="nombresUsuario">
               </div>
               <br>
               <div class="col-auto">
                  <label for="apellidosUsuario">Apellidos: </label>
                  <input for="" class="form-control mb-2" id="apellidosUsuario">
               </div>
               <br>
               <div class="col-auto">
                  <label for="identificacionUsuario">Identificacion: </label>
                  <input for="" class="form-control mb-2" id="identificacionUsuario">
               </div>
               <br>
               <div class="col-6">
                  <label for="emailUsuario">Correo electrónico: </label>
                  <input for="" class="form-control mb-2" id="emailUsuario">
               </div>
               <br>
               <div class="col-auto">
                     <label for="usernameUsuario">Nombre de usuario: </label>
                     <input for="" class="form-control mb-2" id="usernameUsuario">
               </div>
            </div>
         </form>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCierraModalDetallesUsuario">Cerrar</button>
       </div>
     </div>
   </div>
 </div>
@endsection