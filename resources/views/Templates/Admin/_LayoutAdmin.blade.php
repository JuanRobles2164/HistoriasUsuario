<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <title>Inicio</title>
      <!-- Normalize V8.0.1 -->
      <link rel="stylesheet" href="{{ URL::asset('CSS/normalize.css') }}">
      <!-- Bootstrap V4.3 -->
      <link rel="stylesheet" href="{{ URL::asset('CSS/bootstrap.min.css') }}">
      <!-- Font Awesome V5.9.0 -->
      <link rel="stylesheet" href="{{ URL::asset('CSS/all.css') }}">
      <!-- Sweet Alerts V8.13.0 CSS file -->
      <link rel="stylesheet" href="{{ URL::asset('CSS/sweetalert2.min.css') }}">
      <!-- Sweet Alert V8.13.0 JS file-->
      <script src="{{URL::asset('JS/sweetalert2.min.js')}}"></script>
      <!-- jQuery Custom Content Scroller V3.1.5 -->
      <link rel="stylesheet" href="{{ URL::asset('CSS/jquery.mCustomScrollbar.css') }}">
      <!-- General Styles -->
      <link rel="stylesheet" href="{{ URL::asset('CSS/Style.css') }}">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
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
                  <img src="{{URL::asset('Images/Icons/avatar-1.svg')}}" class="img-fluid" alt="Avatar">
                  <figcaption class="roboto-medium text-center">
					{{json_decode(Crypt::decrypt((Cookie::get('usuario'))))->nombre}}
                	<br><small class="roboto-condensed-light">Administrador</small>
                  </figcaption>
               </figure>
               <div class="full-box nav-lateral-bar"></div>
               <nav class="full-box nav-lateral-menu">
                  <ul>
                     <li>
                        <a href="{{route('admin.getIndex')}}"><i class="fas fa-store-alt"></i> &nbsp; Inicio</a>
                     </li>
                     <li>
                        <a href="#" class="nav-btn-submenu"><i class="fas fa-users"></i> &nbsp; Usuarios <i class="fas fa-chevron-down"></i></a>
                        <ul>
                           <li>
                              <a href="{{route('admin.getCreate')}}"><i class="fas fa-plus fa-fw"></i> &nbsp; Nuevo usuario</a>
                           </li>
                           <li>
                              <a href="{{route('admin.getListUsuarios')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de usuarios</a>
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
			<a href="{{route('admin.getSelfEdit')}}">
               <i class="fas fa-user-cog"></i>
               </a>
            <a class="btn-exit-system" href="{{route('getLogin')}}">
               <i class="fas fa-power-off"></i>
            </a>
            </nav>
            <!-- cabezera -->
            <div class="container">
               @yield('contenido')
            </div>
            <!-- Contenido -->
            <div class="full-box tile-container">
            </div>
            
            @yield('modal_detalles')
         </section>
      </main>
      <!-- jQuery V3.4.1 -->
      <script src="{{URL::asset('JS/jquery-3.4.1.min.js')}}"></script>
      <!-- popper -->
      <script src="{{URL::asset('JS/popper.min.js')}}"></script>
      <!-- Bootstrap V4.3 -->
      <script src="{{URL::asset('JS/bootstrap.min.js')}}"></script>
      <!-- jQuery Custom Content Scroller V3.1.5 -->
      <script src="{{URL::asset('JS/jquery.mCustomScrollbar.concat.min.js')}}"></script>
      <!-- Bootstrap Material Design V4.0 -->
      <script src="{{URL::asset('JS/bootstrap-material-design.min.js')}}"></script>
      <script>
         $(document).ready(function() {
             $('body').bootstrapMaterialDesign();
         });
      </script>
      <script src="{{URL::asset('JS/main.js')}}"></script>
      <script src="{{URL::asset('JS/AJAX/AdministradorAJAX.JS') }}"></script>
   </body>
</html>