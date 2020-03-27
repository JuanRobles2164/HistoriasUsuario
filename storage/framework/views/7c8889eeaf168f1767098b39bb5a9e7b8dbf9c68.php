<?php $__env->startSection('contenido'); ?>
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
      <?php $__currentLoopData = $metodologias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metodologia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <tr style="border-color: black; border-radius: 1px; vertical-align:middle; height:100%">
            <td scope="row" valign="middle" align="center" style="line-height: 30px;"><?php echo e($metodologia->nombre); ?></td>
            <td scope="row" valign="middle" align="center" style="line-height: 30px;"><?php echo e($metodologia->descripcion); ?></td>
            <?php if($metodologia->estado_eliminado == 0): ?>
               <td scope="row" valign="middle" align="center" style="line-height: 30px;">Activa</td>
            <?php else: ?>
               <td scope="row" valign="middle" align="center" style="line-height: 30px;">Eliminada</td>
            <?php endif; ?>
            <td scope="row" valign="middle" align="center" style="line-height: 30px;">
               <a href="#" class="btn btn-info btn-sm">
                  <i class="glyphicon glyphicon-zoom-in"></i>
               </a>
               <a href="<?php echo e(route('docente.getEditarMetodologia', 'id='.$metodologia->id)); ?>" <a class="btn btn-success btn-sm">
               <i class="glyphicon glyphicon-pencil"></i>
               </a>
               <a href="#" class="btn btn-danger btn-sm">
                  <i class="glyphicon glyphicon-trash"></i>
               </a>
            </td>
         </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   </table>
</center>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Templates/Docente/_LayoutDocente', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\paginasPHP\HistoriasUsuario\resources\views/Contents/Docente/listaMetodologias.blade.php ENDPATH**/ ?>