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
            <form action="{{route('postLogin')}}" method="POST">
                @csrf
				<h2 class="title">Crear Cuenta</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Nombres</h5>
           		   		<input type="text" class="input" name="nombre" id="nombre">
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                            <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                            <h5>Apellidos</h5>
                            <input type="text" class="input" name="apellido" id="apellido">
                  </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <div class="div">
                            <h5>Idenficación</h5>
                            <input type="number" class="input" name="identificacion" id="identificacion">
                   </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="box">
                        <select id="rol">
                          <option hidden ="Seleccione Rol">Seleccione Rol</option>
                          <option value ="Estudiante">Estudiante</option>
                          <option value ="Docente">Docente</option>
                          <option value ="Administrador">Administrador</option>
                        </select>
                      </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                            <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                            <h5>Correo</h5>
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
                <input type="submit" class="btn" value="Registrese">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="{{URL::asset('JS/LoginJS.js')}}"></script>  
</body>
</html>