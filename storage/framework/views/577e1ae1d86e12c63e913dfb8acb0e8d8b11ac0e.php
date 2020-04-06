<?php $__env->startSection('contenido'); ?>
    <form action="<?php echo e(route('admin.postCreate')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="container-fluid" style="margin:50px 150px;">
            <form class="from-neon" autocomplete="off">
                <fieldset>
                    <legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
                    <div class="container-fluid">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <?php $__errorArgs = ['nombres'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>¡Hey!,</strong> debe ingresar su nombre
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <div class="form-group mb-3">
                                        <label for="usuario_nombre">Nombres</label>
                                        <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,45}" class="form-control" name="nombres" id="usuario_nombre" maxlength="45">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <?php $__errorArgs = ['apellidos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>¡Hey!,</strong> debe ingresar su apellido
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <div class="form-group mb-3">
                                            <label for="usuario_apellido">Apellidos</label>
                                            <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,45}" class="form-control" name="apellidos" id="usuario_apellido" maxlength="45">
                                        </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <?php $__errorArgs = ['identificacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>¡Hey!,</strong> debe ingresar su identificaci&oacute;n o una que no este en uso
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <div class="form-group mb-3">
                                        <label for="usuario_cc">Identificacion</label>
                                        <input type="text" pattern="[a-zA-Z0-9-]{1,35}" class="form-control" name="identificacion" id="usuario_cc" maxlength="35">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>¡Hey!,</strong> debe ingresar un email o uno que no este en uso
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <div class="form-group mb-3">
                                        <label for="usuario_email">Correo electrónico</label>
                                        <input type="email" class="form-control" name="email" id="usuario_email" maxlength="70">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <?php $__errorArgs = ['contrasenia'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>¡Hey!,</strong> debe ingresar una contraseña
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <div class="form-group mb-3">
                                        <label for="usuario_password">Contraseña</label>
                                        <input type="password" class="form-control" name="clave" id="contrasenia" maxlength="150">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <?php $__errorArgs = ['rol_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>¡Hey!,</strong> seleccione un rol
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <div class="form-group mb-3">
                                        <label for="usuario_rol">Seleccioné el Rol</label>
                                        <select class="form-control" name="rol">
                                            <option hidden>Seleccione una opción</option>
                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($rol->id); ?>"><?php echo e($rol->abreviatura); ?></option>    
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </fieldset>
                <p class="text-center" style="margin-top: 10px;">
                <div class="form-group col-md-4" style="margin: 40px 230px">
                    <button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
                    &nbsp;
                    <button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
                </div>
            </form>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Templates/Admin/_LayoutAdmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\master-php\JuanRobles2164\HistoriasUsuario\resources\views/Contents/Admin/crearUsuario.blade.php ENDPATH**/ ?>