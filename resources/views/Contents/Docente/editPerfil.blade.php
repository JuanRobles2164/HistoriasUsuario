@extends('Templates/Docente/_LayoutDocente')
@section('contenido')
<div class="full-box page-header">
   <h3 class="text-left">
      <i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR SU INFORMACIÓN
   </h3>
   <p class="text-justify">
      Actualice sus datos personales y contraseña. 
   </p>
</div>
<!-- Content -->
<div class="full-box tile-container">
<form class="form-neon" autocomplete="off" action="{{route('docente.postSelfEdit')}}" method="POST">
   @csrf
   <input type="hidden" value="{{$usuario->id}}" name="id">
      <fieldset>
         <legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
         <div class="container-fluid">
            <div class="row">
               <div class="col-12 col-md-4">
                  <div class="form-group">
                     <label for="usuario_nombre">Nombres</label>
                  <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="nombres" id="usuario_nombre" maxlength="35" value="{{$usuario->nombres}}">
                  </div>
               </div>
               <div class="col-12 col-md-4">
                  <div class="form-group">
                     <label for="usuario_apellido">Apellidos</label>
                  <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="apellidos" id="usuario_apellido" maxlength="35" value="{{$usuario->apellidos}}">
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label for="usuario_cc">Identificación</label>
                  <input type="text" pattern="[0-9-]{1,20}" class="form-control" name="identificacion" id="identificacion" maxlength="10" value="{{$usuario->identificacion}}">
                  </div>
               </div>
            </div>
         </div>
      </fieldset>
      <br><br><br>
      <fieldset>
         <legend><i class="fas fa-user-lock"></i> &nbsp; Información de la cuenta</legend>
         <div class="container-fluid">
            <div class="row">
               <div class="col-12 col-md-6">
                  <div class="form-group">
                     <label for="usuario_username">Nombre de usuario</label>
                  <input type="text" pattern="[a-zA-Z0-9]{1,35}" class="form-control" name="username" id="username" maxlength="35" value="{{$usuario->username}}">
                  </div>
               </div>
               <div class="col-12 col-md-6">
                  <div class="form-group">
                     <label for="usuario_email">Correo</label>
                     <input type="email" class="form-control" name="email" id="email" maxlength="70" value="{{$usuario->e_mail}}">
                  </div>
               </div>
               <div class="col-12">
                  <legend style="margin-top: 40px;"><i class="fas fa-lock"></i> &nbsp; Nueva contraseña</legend>
                  <p>Para actualizar la contraseña de esta cuenta ingrese una nueva y vuelva a escribirla. En caso que no desee actualizarla, no escriba nada.</p>
               </div>
               <div class="col-12 col-md-6">
                  <div class="form-group">
                     <label for="usuario_clave_nueva_1">Contraseña</label>
                     <input type="password" class="form-control" name="contrasenia" id="contrasenia" maxlength="200" value="{{$usuario->contrasenia}}">
                  </div>
               </div>
               <div class="col-12 col-md-6">
                  <div class="form-group">
                     <label for="usuario_clave_nueva_2">Repetir contraseña</label>
                     <input type="password" class="form-control" name="usuario_clave_nueva_2" id="usuario_clave_nueva_2" maxlength="200" value="{{$usuario->contrasenia}}">
                  </div>
               </div>
            </div>
         </div>
      </fieldset>
      <p class="text-center" style="margin-top: 40px;">
         <button type="submit" class="btn btn-raised btn-success btn-sm"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
      </p>
   </form>
</div>
@endsection