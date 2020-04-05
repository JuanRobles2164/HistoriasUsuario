<?php $__env->startSection('contenido'); ?>
      <br>
      <h3>Lista de usuarios</h3>
      <br>
      <center>
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
               <td scope="row" valign="middle" align="center"><?php echo e($usuario->nombres.' '.$usuario->apellidos); ?></td>
               <td scope="row" valign="middle" align="center"><?php echo e($usuario->identificacion); ?></td>
               <td scope="row" valign="middle" align="center"><?php echo e($usuario->e_mail); ?></td>
               <td scope="row" valign="middle" align="center"><?php echo e($usuario->abreviatura); ?></td>
               <?php if($usuario->estado_eliminado == 0): ?>
                  <td scope="row" valign="middle" align="center">
                     <a class="btn btn-success" href="<?php echo e(route('admin.eliminarUsuario', 'id='.$usuario->id.'&eliminado='.$usuario->estado_eliminado)); ?>">
                        Activo
                     </a>                     
                  </td>
               <?php else: ?>
                  <td scope="row" valign="middle" align="center">
                     <a class="btn btn-danger" href="<?php echo e(route('admin.eliminarUsuario', 'id='.$usuario->id.'&eliminado='.$usuario->estado_eliminado)); ?>">
                        Inactivo
                     </a>
                  </td>
               <?php endif; ?>
               <td scope="row" valign="middle" align="center">
                  <a href="#" class="btn btn-info btn-sm" onclick="detallesUsuario(<?php echo e($usuario->id); ?>)">
                     <i class="glyphicon glyphicon-zoom-in"></i>
                  </a>
                  <a href="<?php echo e(route('admin.getEdit', 'id='.$usuario->id)); ?>" <a class="btn btn-success btn-sm">
                  <i class="glyphicon glyphicon-pencil"></i>
                  </a>
                  <a href="<?php echo e(route('admin.restaurarUsuario', 'id='.$usuario->id)); ?>" <a class="btn btn-warning btn-sm">
                     <i class="fas fa-trash"></i>
                  </a>
               </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </table>
      </center>
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
         <div class="container">
            <br>
            <label for="nombresUsuario">Nombres: </label>
            <input for="" id="nombresUsuario"></input>
            <br>
            <label for="apellidosUsuario">Apellidos: </label>
            <input for="" id="apellidosUsuario"></input>
            <br>
            <label for="identificacionUsuario">Identificacion: </label>
            <input for="" id="identificacionUsuario"></input>
            <br>
            <label for="emailUsuario">Correo electrónico: </label>
            <input for="" id="emailUsuario"></input>
            <br>
            <label for="usernameUsuario">Nombre de usuario: </label>
            <input for="" id="usernameUsuario"></input>
            <br>
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCierraModalDetallesUsuario">Cerrar</button>
       </div>
     </div>
   </div>
 </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Templates/Admin/_LayoutAdmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\paginasPHP\HistoriasUsuario\resources\views/Contents/Admin/listaUsuarios.blade.php ENDPATH**/ ?>