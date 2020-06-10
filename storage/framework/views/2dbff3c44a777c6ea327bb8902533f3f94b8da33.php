
<?php $__env->startSection('contenido'); ?>
    <form action="<?php echo e(route('admin.postEdit')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="container-fluid" style="margin:10px 110px;">
            <br>
            <form class="from-neon" autocomplete="off">
                <fieldset>
                    <legend style="margin:20px 310px;"> <i class="fas fa-user-edit"></i> &nbsp; Editar Iformación </legend>
                        <div class="form-row">
                            <div class="form-group">
                                <label for=""></label>
                                <input type="hidden" name="id" value="<?php echo e($usuario->id); ?>" id="id">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="">Nombres:</label>
                                <input type="text" class="form-control" name="nombres" id="" value="<?php echo e($usuario->nombres); ?>">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="">Apellidos:</label>
                                <input type="text" class="form-control" name="apellidos" id="" value="<?php echo e($usuario->apellidos); ?>">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="">Identificacion:</label>
                                <input type="text" class="form-control" name="identificacion" id="" value="<?php echo e($usuario->identificacion); ?>">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="">Nombre de usuario:</label>
                                <input type="text" class="form-control" name="username" id="" value="<?php echo e($usuario->username); ?>">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="">Correo electrónico:</label>
                                <input type="text" class="form-control" name="email" id="" value="<?php echo e($usuario->e_mail); ?>">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="">Contraseña:</label>
                                <input type="password" class="form-control" name="contrasenia" id="" value="<?php echo e($usuario->contrasenia); ?>">
                            </div>
                            <br>
                        </div>
                        <div style="margin:40px 390px;">
                            <button  type="submit" class="btn btn-outline-secondary btn-lg">Editar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Templates/Admin/_LayoutAdmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\paginasPHP\HistoriasUsuario\resources\views/Contents/Admin/editUsuario.blade.php ENDPATH**/ ?>