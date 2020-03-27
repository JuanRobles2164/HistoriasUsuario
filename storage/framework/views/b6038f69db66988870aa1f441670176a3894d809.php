<?php $__env->startSection('contenido'); ?>
<br>
<h3>Crear una metodología</h3>
<br>
    <form action="<?php echo e(route('docente.postCrearMetodologia')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div>
            <label for="">Nombre</label>
            <input type="text" name="nombre">
            <br>
            <label for="">Descripcion</label>
            <textarea type="textarea" name="descripcion"></textarea>
            <br>
            <button type="submit">Crear</button>
        </div>
    </form>
    <br>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Templates/Docente/_LayoutDocente', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\paginasPHP\HistoriasUsuario\resources\views/Contents/Docente/crearMetodologia.blade.php ENDPATH**/ ?>