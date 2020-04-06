<?php $__env->startSection('contenido'); ?>
    <form action="<?php echo e(route('admin.postEdit')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="container-fluid">
            <form class="from-neon" autocomplete="off">
                <fieldset>
                    <legend> <i class="fas fa-user-edit"></i> &nbsp; Editar Iformación </legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-offset-2 col-lg-4">
                                <div class="from-group">
                                    <label for=""></label>
                                    <input type="hidden" name="id" value="<?php echo e($usuario->id); ?>" id="id">
                                </div>

                                <div class="from-group">
                                    <label for="">Nombres:</label>
                                    <input type="text" class="form-control" name="nombres" id="" value="<?php echo e($usuario->nombres); ?>">
                                </div>

                                <div class="from-group">
                                    <label for="">Apellidos:</label>
                                    <input type="text" class="form-control" name="apellidos" id="" value="<?php echo e($usuario->apellidos); ?>">
                                </div>

                                <div class="from-group">
                                    <label for="">Identificacion:</label>
                                    <input type="text" class="form-control" name="identificacion" id="" value="<?php echo e($usuario->identificacion); ?>">
                                </div>

                                <div class="from-group">
                                    <label for="">Nombre de usuario:</label>
                                    <input type="text" class="form-control" name="username" id="" value="<?php echo e($usuario->username); ?>">
                                </div>

                                <div class="from-group">
                                    <label for="">Correo electrónico:</label>
                                    <input type="text" class="form-control" name="email" id="" value="<?php echo e($usuario->e_mail); ?>">
                                </div>

                                <div class="from-group">
                                    <label for="">Contraseña:</label>
                                    <input type="password" class="form-control" name="contrasenia" id="" value="<?php echo e($usuario->contrasenia); ?>">
                                </div>
                                <br>
                                <div class="from-group">
                                    <button  type="submit" class="btn btn-outline-secondary">Editar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Templates/Admin/_LayoutAdmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\master-php\JuanRobles2164\HistoriasUsuario\resources\views/Contents/Admin/editUsuario.blade.php ENDPATH**/ ?>