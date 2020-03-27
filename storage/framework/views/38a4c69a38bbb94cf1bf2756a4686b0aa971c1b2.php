<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrese</title>
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('CSS/styleLogin.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('CSS/styleRegister.css')); ?>">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
    <img class="wave" src="<?php echo e(URL::asset('Images/Backgrounds/panel-1.png')); ?>">
	<div class="container">
		<div class="img">
            <img src="<?php echo e(URL::asset('Images/Resources/registrese.png')); ?>">
		</div>
		<div class="login-content">
            <form action="<?php echo e(route('postRegistro')); ?>" method="POST">
                <h2 class="title">Crear Cuenta</h2>
                <?php echo csrf_field(); ?>
                <input type="hidden" name="rol" value="<?php echo e($rol->id); ?>">
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Nombres</h5>
           		   		<input type="text" class="input" name="nombres" id="nombre">
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                            <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                            <h5>Apellidos</h5>
                            <input type="text" class="input" name="apellidos" id="apellido">
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
                            <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                            <h5>Correo</h5>
                            <input type="text" class="input" name="email" id="email">
                    </div>
                </div>
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
    <script type="text/javascript" src="<?php echo e(URL::asset('JS/LoginJS.js')); ?>"></script>  
</body>
</html><?php /**PATH C:\xampp\htdocs\paginasPHP\HistoriasUsuario\resources\views/Contents/Registro.blade.php ENDPATH**/ ?>