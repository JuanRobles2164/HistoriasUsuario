<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<title>Iniciar sesión</title>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('CSS/styleLogin.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	@isset($erroneos)
		<script>
			alert('Estos datos no coinciden con ningún usuario');
		</script>
	@endisset
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
				@error('username')
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>¡Hey!,</strong> necesitamos un correo
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@enderror
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Usuario/Correo</h5>
           		   		<input type="text" class="input" name="username" id="username">
           		   </div>
				   </div>
				@error('contrasenia')
				   <div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>¡Crack!,</strong> necesitamos tu clave
					   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					   <span aria-hidden="true">&times;</span>
					   </button>
				   </div>
			   @enderror
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
				@error('datosErroneos')
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>¡Datos erróneos!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@enderror
			</form>
        </div>
    </div>
	<script type="text/javascript" src="{{URL::asset('JS/LoginJS.js')}}"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
