<?php $__env->startSection('contenido'); ?>
    <form action="<?php echo e(route('admin.postEdit')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <label for=""></label>
        <input type="hidden" name="id" value="<?php echo e($usuario->id); ?>" id="id">

        <label for="">Nombres:</label>
        <input type="text" name="nombres" id="" value="<?php echo e($usuario->nombres); ?>">

        <label for="">Apellidos</label>
        <input type="text" name="apellidos" id="" value="<?php echo e($usuario->apellidos); ?>">

        <label for="">Identificacion</label>
        <input type="text" name="identificacion" id="" value="<?php echo e($usuario->identificacion); ?>">

        <label for="">Nombre de usuario:</label>
        <input type="text" name="username" id="" value="<?php echo e($usuario->username); ?>">

        <label for="">Correo electrónico</label>
        <input type="text" name="email" id="" value="<?php echo e($usuario->e_mail); ?>">

        <label for="">Contraseña:</label>
        <input type="password" name="contrasenia" id="" value="<?php echo e($usuario->contrasenia); ?>">

        <button type="submit">Editar</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Templates/Admin/_LayoutAdmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\paginasPHP\HistoriasUsuario\resources\views/Contents/Admin/editUsuario.blade.php ENDPATH**/ ?>