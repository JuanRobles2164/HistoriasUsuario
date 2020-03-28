<?php $__env->startSection('contenido'); ?>
<br>
<h3>Editar una metodología</h3>
<br>
<form action="<?php echo e(route('docente.postEditarMetodologia')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="id" value="<?php echo e($metodologia->id); ?>">
    <br>
    <label for="">Nombre</label>
    <input type="text" name="nombre" value="<?php echo e($metodologia->nombre); ?>">
    <br>
    <br>
    <label for="">Descripción</label>
    <input type="textarea" name="descripcion" value="<?php echo e($metodologia->descripcion); ?>">
    <br>
    <br>
    <button type="submit" class="btn btn-warning">Editar</button>
</form>

<div>
    <h5>Fuentes</h5>
    <div>
        <br>
        <label for="">URL</label>
        <input type="text" name="url" id="url_fuente">
        <br>
        <label for="">Descripcion</label>
        <textarea type="text" name="descripcion" id="descripcion_fuente"></textarea>
        <br>
        <input type="hidden" name="id_metodologia" value="<?php echo e($metodologia->id); ?>" id="id_metodologia">
        <a class="btn btn-success" onclick="agregarFuenteMetodologia()" id="btn_agregar_fuente">+</a>
    </div>

    <div id="listado_fuentes">
        <?php if($fuentes == null): ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" valign="middle" align="center" style="text-align: center">URL</th>
                    <th scope="col" valign="middle" align="center" style="text-align: center">Descripcion</th>
                    <th scope="col" valign="middle" align="center" style="text-align: center">Acciones</th>
                </tr>
            </thead>
            <tbody id="tbody_container">
                <tr id="tr_no_elements">
                    <td scope=row valign=middle align=center id=td_url_no_element>NO HAY ELEMENTOS DISPONIBLES</td>
                    <td scope="row" valign="middle" align="center" id="td_descripcion_no_element">NO HAY ELEMENTOS DISPONIBLES</td>
                    <td scope="row" valign="middle" align="center" id="btnSectionFuente">
                        <a href="#" class="btn btn-warning" id="btnEditarFuente">Editar</a>
                        <a href="#" class="btn btn-danger" id="btnEliminarFuente">Eliminar</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php else: ?>
            
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" valign="middle" align="center">URL</th>
                            <th scope="col" valign="middle" align="center">Descripcion</th>
                            <th scope="col" valign="middle" align="center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $fuentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fuente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row">
                                    <a href="<?php echo e($fuente->url); ?>" target="_blank">Redirigir</a>
                                </th>
                                <th scope="row"><?php echo e($fuente->descripcion); ?></th>
                                <th scope="row">
                                    <a href="<?php echo e(route('docente.eliminarFuenteMetodologia', 'id='.$fuente->id)); ?>" class="btn btn-danger">Eliminar</a>
                                </th>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
        <?php endif; ?>
    </div>
    
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Templates/Docente/_LayoutDocente', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\paginasPHP\HistoriasUsuario\resources\views/Contents/Docente/editarMetodologia.blade.php ENDPATH**/ ?>