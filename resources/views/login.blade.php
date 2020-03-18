<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<title>Iniciar sesión</title>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('CSS/styleLogin.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
	<img class="wave" src="{{URL::asset('Images/Backgrounds/wave.jpg')}}">
	<div class="container">
		<div class="img">
        	<img src="{{URL::asset('Images/Resources/logo-udi-web.png')}}">
		</div>
		<div class="login-content">
            <form action="{{route('postLogin')}}" method="POST">
                @csrf
            <img src="{{URL :: asset('Images/Icons/avatar.svg')}}">
				<h2 class="title">Bienvenido</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Usuario/Correo</h5>
           		   		<input type="text" class="input" name="username" id="username">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Contraseña</h5>
           		    	<input type="password" class="input" name="contrasenia" id="contrasenia">
            	   </div>
            	</div>
                <a href="{{route('registro')}}">Registrarse</a>
                <input type="submit" class="btn" value="Iniciar Sesión">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="{{URL::asset('JS/LoginJS.js')}}"></script>
</body>
</html>
