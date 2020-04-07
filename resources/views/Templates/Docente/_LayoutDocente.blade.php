<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <title>Inicio</title>
          <!-- Normalize V8.0.1 -->
    <link rel="stylesheet" href="{{ URL::asset('CSS/normalize.css') }}">
    <!-- Bootstrap V4.3 -->
    <link rel="stylesheet"  href="{{ URL::asset('CSS/bootstrap.min.css') }}">
    <!-- Font Awesome V5.9.0 -->
    <link rel="stylesheet"  href="{{ URL::asset('CSS/all.css') }}">
    <!-- Sweet Alerts V8.13.0 CSS file -->
    <link rel="stylesheet"  href="{{ URL::asset('CSS/sweetalert2.min.css') }}">
    <!-- Sweet Alert V8.13.0 JS file-->
    <script src="{{URL::asset('JS/sweetalert2.min.js')}}" ></script>
    <!-- General Styles -->
    <link rel="stylesheet" href="{{ URL::asset('CSS/StyleDocente.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
   </head>
   <body>
      <!-- centenedor de menu -->
      <main class="full-box main-container">
         <!-- Navbar lateral -->
         <section class="full-box nav-lateral">
            <div class="full-box nav-lateral-bg show-nav-lateral"></div>
            <div class="full-box nav-lateral-content">
               <figure class="full-box nav-lateral-avatar">
                  <i class="far fa-times-circle show-nav-lateral"></i>
                  <img src="{{URL::asset('Images/Icons/avatar-3.svg')}}" class="img-fluid" alt="Avatar">
                  <figcaption class="roboto-medium text-center">
                     {{json_decode(Crypt::decrypt((Cookie::get('usuario'))))->nombre}}
                     <br><small class="roboto-condensed-light">Docente</small>
                  </figcaption>
               </figure>
               <div class="full-box nav-lateral-bar"></div>
               <nav class="full-box nav-lateral-menu">
                  <ul>
                     <li>
                        <a href="{{route('docente.getIndex')}}"><i class="fas fa-store-alt"></i> &nbsp; Inicio</a>
                     </li>
                     <li>
                        <a href="#" class="nav-btn-submenu"><i class="fas fa-folder-open"></i> &nbsp; Metodologías <i class="fas fa-chevron-down"></i></a>
                        <ul>
                           <li>
                              <a href="{{route('docente.getCrearMetodologia')}}"><i class="fas fa-plus fa-fw"></i> &nbsp; Nueva metodología</a>
                           </li>
                           <li>
                              <a href="{{route('docente.getListaMetodologias')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de metodologías</a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" class="nav-btn-submenu"><i class="fas fa-folder-open"></i> &nbsp; Proyectos <i class="fas fa-chevron-down"></i></a>
                        <ul>
                           <li>
                              <a href="{{route('docente.getCrearProyecto')}}"><i class="fas fa-plus fa-fw"></i> &nbsp; Nuevo proyecto</a>
                           </li>
                           <li>
                           <a href="{{route('docente.getListaProyectos')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de proyectos</a>
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
                  <a href="{{route('docente.getSelfEdit')}}">
               <i class="fas fa-user-cog"></i>
               </a>
                  <a href="{{route('getLogin')}}" class="btn-exit-system">
               <i class="fas fa-power-off"></i>
               </a>
            </nav>
            <div class="container">
               @yield('contenido')
            </div>
            <!-- Contenido -->
            <div class="full-box tile-container">
            </div>
            <footer class="blockquote-footer">
               <cite> © 2020 Copyright: GEA Software. </cite>
            </footer>
         </section>
      </main>
      <!-- jQuery V3.4.1 -->
      <script src="{{URL::asset('JS/jquery-3.4.1.min.js')}}"></script>
      <!-- popper -->
      <script src="{{URL::asset('JS/popper.min.js')}}"></script>
      <!-- Bootstrap V4.3 -->
      <script src="{{URL::asset('JS/bootstrap.min.js')}}"></script>
      <!-- Bootstrap Material Design V4.0 -->
      <script src="{{URL::asset('JS/bootstrap-material-design.min.js')}}" ></script>
      <script src="{{URL::asset('JS/main.js')}}"></script>
      <script src="{{URL::asset('JS/AJAX/DocenteAJAX.JS')}}"></script>
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   </body>
</html>
