<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <title>Inicio</title>
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
      <!-- jQuery V3.4.1 -->
      <script src="<?php echo e(URL::asset('JS/jquery-3.4.1.min.js')); ?>"></script>
      <!-- Normalize V8.0.1 -->
      <link rel="stylesheet" href="<?php echo e(URL::asset('CSS/normalize.css')); ?>">
      <!-- Bootstrap V4.3 -->
      <link rel="stylesheet" href="<?php echo e(URL::asset('CSS/bootstrap.min.css')); ?>">
      <!-- Font Awesome V5.9.0 -->
      <link rel="stylesheet" href="<?php echo e(URL::asset('CSS/all.css')); ?>">
      <!-- Sweet Alerts V8.13.0 CSS file -->
      <link rel="stylesheet" href="<?php echo e(URL::asset('CSS/sweetalert2.min.css')); ?>">
      <!-- jQuery Custom Content Scroller V3.1.5 -->
      <link rel="stylesheet" href="<?php echo e(URL::asset('CSS/jquery.mCustomScrollbar.css')); ?>">
      <!-- General Styles -->
      <link rel="stylesheet" href="<?php echo e(URL::asset('CSS/styleDocente.css')); ?>">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

      
      <link href="<?php echo e(URL::asset('JS/fullcalendar/packages/core/main.css')); ?>" rel='stylesheet' />
      <link href="<?php echo e(URL::asset('JS/fullcalendar/packages/daygrid/main.css')); ?>" rel='stylesheet' />
  
   <script src="<?php echo e(URL::asset('JS/fullcalendar/packages/core/main.js')); ?>"></script>
   <script src=<?php echo e(URL::asset('JS/fullcalendar/packages/daygrid/main.js')); ?>></script>
   <script src=<?php echo e(URL::asset('JS/fullcalendar/es.js')); ?>></script>

   </head>
   <body>
      <input type="hidden" name="" id="log_out_route" value="<?php echo e(route('getLogin')); ?>">
      <!-- centenedor de menu -->
      <main class="full-box main-container">
         <!-- Navbar lateral -->
         <section class="full-box nav-lateral">
            <div class="full-box nav-lateral-bg show-nav-lateral"></div>
            <div class="full-box nav-lateral-content">
               <figure class="full-box nav-lateral-avatar">
                  <i class="far fa-times-circle show-nav-lateral"></i>
                  <img src="<?php echo e(URL::asset('Images/Icons/avatar-3.Svg')); ?>" class="img-fluid" alt="Avatar">
                  <figcaption class="roboto-medium text-center">
                     <?php echo e(json_decode(Crypt::decrypt((Cookie::get('usuario'))))->nombre); ?>

                     <br><small class="roboto-condensed-light">Docente</small>
                  </figcaption>
               </figure>
               <div class="full-box nav-lateral-bar"></div>
               <nav class="full-box nav-lateral-menu">
                  <script>
                     const valo = "<?php echo e(json_decode(Crypt::decrypt((Cookie::get('usuario'))))->id); ?>";
                     console.log(valo);
                  </script>
                  <ul>
                     <li>
                        <a href="<?php echo e(route('docente.getIndex')); ?>"><i class="fas fa-store-alt"></i> &nbsp; Inicio</a>
                     </li>
                     <li>
                        <a href="#" class="nav-btn-submenu"><i class="fas fa-folder-open"></i> &nbsp; Metodologías <i class="fas fa-chevron-down"></i></a>
                        <ul>
                           <li>
                              <a href="<?php echo e(route('docente.getCrearMetodologia')); ?>"><i class="fas fa-plus fa-fw"></i> &nbsp; Nueva metodología</a>
                           </li>
                           <li>
                              <a href="<?php echo e(route('docente.getListaMetodologias')); ?>"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de metodologías</a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" class="nav-btn-submenu"><i class="fas fa-folder-open"></i> &nbsp; Proyectos <i class="fas fa-chevron-down"></i></a>
                        <ul>
                           <li>
                              <a href="<?php echo e(route('docente.getCrearProyecto')); ?>"><i class="fas fa-plus fa-fw"></i> &nbsp; Nuevo proyecto</a>
                           </li>
                           <li>
                           <a href="<?php echo e(route('docente.getListaProyectos')); ?>"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de proyectos</a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </nav>
            </div>
         </section>
         <!-- navbar superior -->
         <section class="full-box page-content">
            <nav class="full-box navbar-info">
               <a href="#" class="float-left show-nav-lateral">
               <i class="fas fa-bars"></i>
               </a>
                  <a href="<?php echo e(route('docente.getSelfEdit')); ?>">
               <i class="fas fa-user-cog"></i>
               </a>
                  <a href="<?php echo e(route('getLogin')); ?>" class="btn-exit-system">
               <i class="fas fa-power-off"></i>
               </a>
            </nav>
            <div class="container">
               <?php echo $__env->yieldContent('contenido'); ?>
               <?php echo $__env->yieldContent('modals'); ?>
            </div>
            <!-- Contenido -->
            <div class="full-box tile-container">
            </div>
            <footer class="blockquote-footer">
               <cite> © 2020 Copyright: GEA Software. </cite>
            </footer>
         </section>
      </main>
      <!-- Sweet Alert V8.13.0 JS file-->
      <script src="<?php echo e(URL::asset('JS/sweetalert2.min.js')); ?>"></script>
      <!-- jQuery V3.4.1 -->
      <script src="<?php echo e(URL::asset('JS/jquery-3.4.1.min.js')); ?>"></script>
      <!-- popper -->
      <script src="<?php echo e(URL::asset('JS/popper.min.js')); ?>"></script>
      <!-- Bootstrap V4.3 -->
      <script src="<?php echo e(URL::asset('JS/bootstrap.min.js')); ?>"></script>
      <!-- jQuery Custom Content Scroller V3.1.5 -->
	   <script src="<?php echo e(URL::asset('JS/jquery.mCustomScrollbar.concat.min.js')); ?>"></script>
      <!-- Bootstrap Material Design V4.0 -->
      <script src="<?php echo e(URL::asset('JS/bootstrap-material-design.min.js')); ?>" ></script>
      <script>
         $(document).ready(function() { $('body').bootstrapMaterialDesign();});
         $('.alert').alert();
      </script>
      <script src="<?php echo e(URL::asset('JS/main.js')); ?>"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

      <?php echo $__env->yieldContent('custom_scripts'); ?>

   </body>
</html>
<?php /**PATH C:\xampp\htdocs\paginasPHP\HistoriasUsuario\resources\views/Templates/Docente/_LayoutDocente.blade.php ENDPATH**/ ?>