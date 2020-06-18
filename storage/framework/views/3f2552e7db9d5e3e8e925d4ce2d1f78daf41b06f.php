
<?php $__env->startSection('contenido'); ?>
<?php if(isset($msj)): ?>
   <div class="alert alert-danger alert-dismissible fade show" role="alert">
   <strong>¡<?php echo e($msj); ?>!</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
      </button>
   </div>
<?php endif; ?>
<input type="hidden" name="api_route_get_reinicio" id="api_route_get_reinicio" value="<?php echo e(route('admin.restaurarUsuario')); ?>">
<br>
<div class="d-flex bd-highlight mb-3">
   <div class="p-2 bd-highlight"><h3>Lista de usuarios</h3> </div>     
   <div class="p-2 bd-highlight">
      <input class="form-control mr-sm-2" type="search" name="criterio" id="criterio" placeholder="Cualquier campo..." aria-label="Search">
   </div>
   <div class="ml-auto p-2 bd-highlight">
      <div class="toast" role="alert" id="mitoast" aria-live="assertive" aria-atomic="true"  data-delay="5000">
         <div class="toast-header bg-success text-white">
           <strong class="mr-auto">Usuario Restablecido</strong>
           <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Cerrar" onclick="cerrarToast()">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="toast-body alert-success">
           El usuario <input type="text" style="background-color:transparent; border-width: 0;" style="width: fit-content" id="usuario_toast"> se ha restablecido por defecto.
         </div>
      </div>
   </div>
</div>
<table class="table" id="tabla">
   <thead class="thead-dark">
      <tr>
         <th scope="col" valign="middle" style="text-align: center"></th> 
         <th scope="col" valign="middle" style="text-align: center">Nombre completo</th>
         <th scope="col" valign="middle" style="text-align: center">Identificacion</th>
         <th scope="col" valign="middle" style="text-align: center">Correo</th>
         <th scope="col" valign="middle" style="text-align: center">Rol</th>
         <th scope="col" valign="middle" style="text-align: center">Estado</th>
         <th scope="col" valign="middle" style="text-align: center">Acciones</th>
      </tr>
   </thead>
   <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr style="border-color: black; border-radius: 1px; vertical-align:middle; height:100%">
         <td style="text-align: center" scope="row" valign="middle">
            <a href="<?php echo e(route('admin.eliminarUsuarioCascade', 'id='.$usuario->id)); ?>" class="btn btn-danger btn-sm" style="color: white;" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
               <i class="far fa-trash-alt"></i>
            </a>
         </td>
         <td style="text-align: center" scope="row" valign="middle"><?php echo e($usuario->nombres.' '.$usuario->apellidos); ?></td>
         <td style="text-align: center" scope="row" valign="middle"><?php echo e($usuario->identificacion); ?></td>
         <td style="text-align: center" scope="row" valign="middle"><?php echo e($usuario->e_mail); ?></td>
         <td style="text-align: center" scope="row" valign="middle"><?php echo e($usuario->abreviatura); ?></td>
         <?php if($usuario->estado_eliminado == 0): ?>
            <td scope="row" style="text-align: center" valign="middle">
               <a class="btn btn-success" href="<?php echo e(route('admin.eliminarUsuario', 'id='.$usuario->id.'&eliminado='.$usuario->estado_eliminado)); ?>"data-toggle="tooltip" data-placement="bottom" title="Cambiar estado">
                  Activos 
               </a>                     
            </td>
         <?php else: ?>
            <td scope="row" style="text-align: center" valign="middle">
               <a class="btn btn-danger" href="<?php echo e(route('admin.eliminarUsuario', 'id='.$usuario->id.'&eliminado='.$usuario->estado_eliminado)); ?>" data-toggle="tooltip" data-placement="bottom" title="Cambiar estado">
                  Inactivo
               </a>
            </td>
         <?php endif; ?>
         <td href="#" scope="row" style="text-align: center" valign="middle">      
            <a class="btn btn-info btn-sm" style="color: white;"  onclick="detallesUsuario(<?php echo e($usuario->id); ?>)" data-toggle="tooltip" data-placement="bottom" title="Detalles">
               <i class="fas fa-eye"></i>
            </a>
            <a href="<?php echo e(route('admin.getEdit', 'id='.$usuario->id)); ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar">
               <i class="fas fa-user-edit"></i>
            </a>
            <a onclick="mostrarToast(<?php echo e($usuario->id); ?>)" class="btn btn-warning btn-sm clase_btn_notificacion" style="color: white;" data-toggle="tooltip" data-placement="bottom" title="Restaurar">
               <i class="fas fa-sync-alt"></i>
            </a>
         </td>
      </tr>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
<div>
   <?php echo e($usuarios->links()); ?>

</div>
<footer class="blockquote-footer">
   <cite> © 2020 Copyright: GEA Software. </cite>
</footer>

<script>
   function mostrarToast(idUsuario) {
      const ruta = $('#api_route_get_reinicio').val();
      console.log(idUsuario);
        $.ajax({
          url: ruta,
          type: 'GET',
          async: true,
          data: {'id': idUsuario, 'legal':true},
          success: function(response){
            console.log(response);
            let data = JSON.parse(response);
            console.log(data);
            $('#usuario_toast').val(data.nombres +' '+data.apellidos);
            $('#usuario_toast').attr('disabled','disabled');
            var toast = document.getElementById("mitoast");
            toast.className = "mostrar";           
            setTimeout(function(){ toast.className = toast.className.replace("mostrar", ""); }, 5000);
          },
          error: function(response){
            console.log(response);
            alert("Algo salió mal... vuelve a intentarlo");
            response = null;
          }
        });   
   }

function cerrarToast() {
    var toast = document.getElementById("mitoast");
    toast.className = "cerrar";
    toast.className = toast.className.replace("cerrar", "");
}

$('clase_btn_notificacion').click(function(e){
   e.preventDefault();
});
</script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal_detalles'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_scripts'); ?>
   <script src="<?php echo e(URL::asset('JS/AJAX/admin/usuariosAJAX.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Templates/Admin/_LayoutAdmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\paginasPHP\HistoriasUsuario\resources\views/Contents/Admin/listaUsuarios.blade.php ENDPATH**/ ?>