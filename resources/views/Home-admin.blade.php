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

	<!-- Bootstrap Material Design V4.0 -->
	<link rel="stylesheet"  href="{{ URL::asset('bootstrap-material-design.min.css') }}">

	<!-- Font Awesome V5.9.0 -->
	<link rel="stylesheet"  href="{{ URL::asset('CSS/all.css') }}">

	<!-- Sweet Alerts V8.13.0 CSS file -->
	<link rel="stylesheet"  href="{{ URL::asset('CSS/sweetalert2.min.css') }}">

	<!-- Sweet Alert V8.13.0 JS file-->
	<script src="{{URL::asset('JS/sweetalert2.min.js')}}" ></script>

	<!-- jQuery Custom Content Scroller V3.1.5 -->
	<link rel="stylesheet" href="{{ URL::asset('CSS/jquery.mCustomScrollbar.css') }}">
	
	<!-- General Styles -->
	<link rel="stylesheet" href="{{ URL::asset('CSS/style.css') }}">

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
					<img src="./assets/avatar/avatar.svg" class="img-fluid" alt="Avatar">
					<figcaption class="roboto-medium text-center">
						Gabriel Alexander Castro <br><small class="roboto-condensed-light">Administrador</small>
					</figcaption>
				</figure>
				<div class="full-box nav-lateral-bar"></div>
				<nav class="full-box nav-lateral-menu">
					<ul>
						<li>
							<a href="home.html"><i class="fas fa-store-alt"></i> &nbsp; Inicio</a>
						</li>

						<li>
							<a href="#" class="nav-btn-submenu"><i class="fas fa-users"></i> &nbsp; Usuarios <i class="fas fa-chevron-down"></i></a>
							<ul>
								<li>
									<a href="user-new.html"><i class="fas fa-plus fa-fw"></i> &nbsp; Nuevo usuario</a>
								</li>
								<li>
									<a href="user-list.html"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de usuarios</a>
								</li>
								<li>
									<a href="user-search.html"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar usuario</a>
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
				<a href="#">
					<i class="fas fa-user-cog"></i>
				</a>
				<a href="#" class="btn-exit-system">
					<i class="fas fa-power-off"></i>
				</a>
			</nav>

			<!-- cabezera de pagina -->
			<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fas fa-store-alt"></i> INICIO
				</h3>
				<p class="text-justify">
					Hola, bienvenido aca podras administrar cómodamente los parámetros y usuarios que asi desee. © 2020 Copyright: GEA Software
				</p>
			</div>
			
			<!-- Contenido -->
			<div class="full-box tile-container">
				
			</div>
			
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
	<script src="{{URL::asset('JS/bootstrap-material-design.min.js')}}" ></script>
	<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>

	<script src="{{URL::asset('JS/main.js')}}"></script>
</body>

</html>