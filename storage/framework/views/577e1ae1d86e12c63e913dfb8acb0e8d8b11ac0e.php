<?php $__env->startSection('contenido'); ?>
    <form action="<?php echo e(route('admin.postCreate')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="container-fluid">
            <form class="from-neon" autocomplete="off">
                <fieldset>
                    <legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div cass="col-12 col-md-6">
                                <div class="from-group">
                                    <label for="usuario_nombre">Nombres</label>
                                    <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,45}" class="form-control" name="usuario_nombre" id="usuario_nombre" maxlength="45">
                                </div>

                                <div class="from-group">
                                    <label for="usuario_apellido">Apellidos</label>
                                    <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,45}" class="form-control" name="usuario_apellido" id="usuario_apellido" maxlength="45">
                                </div>

                                <div class="from-group">
                                    <label for="usuario_cc">Identificacion</label>
                                    <input type="text" pattern="[a-zA-Z0-9-]{1,35}" class="form-control" name="usuario_cc" id="usuario_cc" maxlength="35">
                                </div>

                                <div class="from-group">
                                    <label for="usuario_email">Correo electrónico</label>
                                    <input type="email" class="form-control" name="usuario_email" id="usuario_email" maxlength="70">
                                </div>

                                <div class="from-group">
                                    <label for="usuario_password">Contraseña</label>
                                    <input type="password" class="form-control" name="contrasenia" id="contrasenia" maxlength="150">
                                </div>

                                <div class="form-group">
                                    <label for="usuario_rol">Seleccioné el Rol</label>
                                    <select class="form-control" name="usuario_rol">
                                        <option hidden>Seleccione una opción</option>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($rol->id); ?>"><?php echo e($rol->abreviatura); ?></option>    
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <p class="text-center" style="margin-top: 40px;">
                    <button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
                    <button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
                </p>
            </form>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Templates/Admin/_LayoutAdmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\master-php\JuanRobles2164\HistoriasUsuario\resources\views/Contents/Admin/crearUsuario.blade.php ENDPATH**/ ?>