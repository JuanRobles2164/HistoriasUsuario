<?php $__env->startSection('contenido'); ?>
   <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 50px;">
      <div class="toast" style="position: absolute; top: 0; right: 0;">
      <div class="toast-header">
         <img src="" class="rounded mr-2" alt="">
         <strong class="mr-auto">Notificación</strong>
         <small> just now </small>
         <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <div class="toast-body">
         Usuario Restablecido por Defecto.
      </div>
      </div>
   </div>
      <h3>Lista de usuarios</h3>
      <script>
         $(document).ready(function(){
         $('.myBtnXD').click(function(){
            $('.toast').toast({delay: 5000});
            $('.toast').toast('show');
         });
         });
      </script>
      
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
            <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <tr style="border-color: black; border-radius: 1px; vertical-align:middle; height:100%">
                  <td style="text-align: center" scope="row" valign="middle"><?php echo e($usuario->nombres.' '.$usuario->apellidos); ?></td>
                  <td style="text-align: center" scope="row" valign="middle"><?php echo e($usuario->identificacion); ?></td>
                  <td style="text-align: center" scope="row" valign="middle"><?php echo e($usuario->e_mail); ?></td>
                  <td style="text-align: center" scope="row" valign="middle"><?php echo e($usuario->abreviatura); ?></td>
                  <?php if($usuario->estado_eliminado == 0): ?>
                     <td scope="row" style="text-align: center" valign="middle">
                        <a class="btn btn-success" href="<?php echo e(route('admin.eliminarUsuario', 'id='.$usuario->id.'&eliminado='.$usuario->estado_eliminado)); ?>">
                           Activos 
                        </a>                     
                     </td>
                  <?php else: ?>
                     <td scope="row" style="text-align: center" valign="middle">
                        <a class="btn btn-danger" href="<?php echo e(route('admin.eliminarUsuario', 'id='.$usuario->id.'&eliminado='.$usuario->estado_eliminado)); ?>">
                           Inactivo
                        </a>
                     </td>
                  <?php endif; ?>
                  <td href="#" scope="row" style="text-align: center" valign="middle">      
                     <a class="btn btn-info btn-sm"  onclick="detallesUsuario(<?php echo e($usuario->id); ?>)">
                        <i class="fas fa-search-plus"></i>
                     </a>
                     <a href="<?php echo e(route('admin.getEdit', 'id='.$usuario->id)); ?>" a class="btn btn-success btn-sm">
                        <i class="far fa-edit"></i>
                     </a>
                     <a href="<?php echo e(route('admin.restaurarUsuario', 'id='.$usuario->id)); ?>" a class="btn btn-warning btn-sm myBtnXD">
                        <i class="fas fa-sync"></i>
                     </a>
                  </td>
               </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </table>
      </div>
      <footer class="blockquote-footer">
         <cite> © 2020 Copyright: GEA Software. </cite>
      </footer>
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

<?php echo $__env->make('Templates/Admin/_LayoutAdmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\paginasPHP\HistoriasUsuario\resources\views/Contents/Admin/listaUsuarios.blade.php ENDPATH**/ ?>