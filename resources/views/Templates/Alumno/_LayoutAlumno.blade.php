<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<title>Inicio</title>
		<!-- jQuery V3.4.1 -->
		<script src="{{URL::asset('JS/jquery-3.4.1.min.js')}}"></script>
		<!-- Normalize V8.0.1 -->
		<link rel="stylesheet" href="{{ URL::asset('CSS/normalize.css') }}">
		<!-- Bootstrap V4.3 -->
		<link rel="stylesheet" href="{{ URL::asset('CSS/bootstrap.min.css') }}">
		<!-- Font Awesome V5.9.0 -->
		<link rel="stylesheet" href="{{ URL::asset('CSS/all.css') }}">
		<!-- Sweet Alerts V8.13.0 CSS file -->
		<link rel="stylesheet" href="{{ URL::asset('CSS/sweetalert2.min.css') }}">
		<!-- jQuery Custom Content Scroller V3.1.5 -->
		<link rel="stylesheet" href="{{ URL::asset('CSS/jquery.mCustomScrollbar.css') }}">
		<!-- General Styles -->
		<link rel="stylesheet" href="{{ URL::asset('CSS/styleAlumno.css') }}">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
		<meta name="csrf-token" content="{{ csrf_token() }}" />
   </head>
<body>
	<input type="hidden" name="" id="log_out_route" value="{{route('getLogin')}}">
	<!-- centenedor de menu -->
	<main class="full-box main-container">
		<!-- Navbar lateral -->
		<section class="full-box nav-lateral">
			<div class="full-box nav-lateral-bg show-nav-lateral"></div>
			<div class="full-box nav-lateral-content">
				<figure class="full-box nav-lateral-avatar">
					<i class="far fa-times-circle show-nav-lateral"></i>
					<img src="{{URL::asset('Images/Icons/avatar.svg')}}" class="img-fluid" alt="Avatar">
					<figcaption class="roboto-medium text-center">
						{{json_decode(Crypt::decrypt(Cookie::get('usuario')))->nombre }} 
						<br><small class="roboto-condensed-light">Alumno</small>
					</figcaption>
				</figure>
				<div class="full-box nav-lateral-bar"></div>
				<nav class="full-box nav-lateral-menu">
					<ul>
						<li>
							<a href="{{route('alumno.getIndex')}}"><i class="fas fa-store-alt"></i> &nbsp; Inicio</a>
                        </li>
                        
						<li>
							<a href="#" class="nav-btn-submenu"><i class="fas fa-folder-open"></i> &nbsp; Proyectos <i class="fas fa-chevron-down"></i></a>
							<ul>
								<li>
									<a href="{{route('alumno.getListaProyectos')}}"><i class="fas fa-tasks"></i> &nbsp; Proyectos Activos</a>
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
				<a href="{{route('alumno.getSelfEdit')}}">
					<i class="fas fa-user-cog"></i>
				</a>
				<a href="{{route('getLogin')}}" class="btn-exit-system">
					<i class="fas fa-power-off"></i>
				</a>
			</nav>
			<!-- Contenido -->
			<div class="full-box tile-container">
				@yield('contenido')
			</div>
        </section>
	</main>
	@yield('modals')
    <!-- Sweet Alert V8.13.0 JS file-->
    <script src="{{URL::asset('JS/sweetalert2.min.js')}}"></script>
    <!-- popper -->
    <script src="{{URL::asset('JS/popper.min.js')}}"></script>
    <!-- Bootstrap V4.3 -->
    <script src="{{URL::asset('JS/bootstrap.min.js')}}"></script>
    <!-- jQuery Custom Content Scroller V3.1.5 -->
	<script src="{{URL::asset('JS/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <!-- Bootstrap Material Design V4.0 -->
	<script src="{{URL::asset('JS/bootstrap-material-design.min.js')}}" ></script>
	<script>
		$(document).ready(function() { $('body').bootstrapMaterialDesign();});
        $('.alert').alert();
	</script>
	<script src="{{URL::asset('JS/main.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	@yield('custom_scripts')
</body>
</html>