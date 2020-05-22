<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<title>Iniciar sesión</title>
	<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('CSS/styleLogin.css')); ?>">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<?php if(isset($erroneos)): ?>
		<script>
			alert('Estos datos no coinciden con ningún usuario');
		</script>
	<?php endif; ?>
	<img class="wave" src="<?php echo e(URL::asset('Images/Backgrounds/wave.jpg')); ?>">
	<div class="container">
		<div class="img">
        	<img src="<?php echo e(URL::asset('Images/Resources/logo-udi-web.png')); ?>">
		</div>
		<div class="login-content">
            <form action="<?php echo e(route('postLogin')); ?>" method="POST">
                <?php echo csrf_field(); ?>
            <img src="<?php echo e(URL :: asset('Images/Icons/avatar.svg')); ?>">
				<h2 class="title">Bienvenido</h2>
				<?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>¡Hey!,</strong> necesitamos un correo
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Usuario/Correo</h5>
           		   		<input type="text" class="input" name="username" id="username">
           		   </div>
				   </div>
				<?php $__errorArgs = ['contrasenia'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
				   <div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>¡Crack!,</strong> necesitamos tu clave
					   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					   <span aria-hidden="true">&times;</span>
					   </button>
				   </div>
			   <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Contraseña</h5>
           		    	<input type="password" class="input" name="contrasenia" id="contrasenia">
            	   </div>
            	</div>
                <a href="<?php echo e(route('registro')); ?>">Registrarse</a>
				<input type="submit" class="btn" value="Iniciar Sesión">
				<?php $__errorArgs = ['datosErroneos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>¡Datos erróneos!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
			</form>
        </div>
    </div>
	<script type="text/javascript" src="<?php echo e(URL::asset('JS/LoginJS.js')); ?>"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
<?php /**PATH C:\wamp64\www\master-php\JuanRobles2164\HistoriasUsuario\resources\views/Login.blade.php ENDPATH**/ ?>