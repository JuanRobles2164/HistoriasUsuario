<?php $__env->startSection('contenido'); ?>
    <form action="<?php echo e(route('admin.postCreate')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group">

            <label for="">Nombres</label>
            <input type="text" name="nombres">

            <label for="">Apellidos</label>
            <input type="text" name="apellidos">

            <label for="">Correo electrónico</label>
            <input type="text" name="email">

            <label for="">Identificacion</label>
            <input type="text" name="identificacion">

            <label for="">Contraseña</label>
            <input type="text" name="clave">
            
            <label for="">Seleccione el rol:</label>
            <select name="rol" id="">
                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($rol->id); ?>"> <?php echo e($rol->abreviatura); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <button type="submit">CREAR</button>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Templates/Admin/_LayoutAdmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\paginasPHP\HistoriasUsuario\resources\views/Contents/Admin/crearUsuario.blade.php ENDPATH**/ ?>