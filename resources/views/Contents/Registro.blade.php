<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrese</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('CSS/styleLogin.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('CSS/styleRegister.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
    <img class="wave" src="{{URL::asset('Images/Backgrounds/panel-1.png')}}">
	<div class="container">
		<div class="img">
            <img src="{{URL::asset('Images/Resources/registrese.png')}}">
		</div>
		<div class="login-content">
            <form action="{{route('postRegistro')}}" method="POST">
                <h2 class="title">Crear Cuenta</h2>
                @csrf
                <input type="hidden" name="rol" value="{{$rol->id}}">
                @error('nombres')
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>¡Hey!,</strong> debe ingresar su nombre
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
           		   		<h5>Nombres</h5>
           		   		<input type="text" class="input" name="nombres" id="nombre">
                    </div>
                </div>
                @error('apellidos')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>¡Hey!,</strong> debe ingresar su apellido
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
                            <h5>Apellidos</h5>
                            <input type="text" class="input" name="apellidos" id="apellido">
                  </div>
                </div>
                @error('identificacion')
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>¡Hey!,</strong> debe ingresar su identificaci&oacute;n o una que no este en uso
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @enderror
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <div class="div">
                            <h5>Idenficación</h5>
                            <input type="number" class="input" name="identificacion" id="identificacion">
                   </div>
                </div>
                @error('email')
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>¡Hey!,</strong> debe ingresar un email o uno que no este en uso
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
                            <h5>Correo</h5>
                            <input type="text" class="input" name="email" id="email">
                    </div>
                </div>
                @error('contrasenia')
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>¡Hey!,</strong> debe ingresar una contraseña
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
           		    	<input type="password" class="input" name="clave" id="clave">
            	   </div>
            	</div>
                <input type="submit" class="btn" value="Registrese">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="{{URL::asset('JS/LoginJS.js')}}"></script>  
</body>
</html>