<?php 

include_once 'conexion.php';

error_reporting(0);

session_start();

if (isset($_SESSION['nombre'])) {
    header("Location: login.php");
}

if (isset($_POST['submit'])) {
	$nombre = $_POST['nombre'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM usuarios WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO usuarios (nombre, email, password)
					VALUES ('$nombre', '$email', '$password')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				header("Location: registro.php?alert=Registro exitoso");
				$nombre = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				header("Location: registro.php?error=Algo salió mal");
			}
		} else {
			header("Location: registro.php?error=El correo ya existe");
		}
		
	} else {
		header("Location: registro.php?error=La contraseña no coincide");
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	
	<title>Formulario de Registro</title>
</head>
<body>
	<div class="container">
		<form id ="signupform" role ="form" action="<?php $_SERVER['PHP_SELF']?>" method="POST" class="login-email">
            <h1 class="login-text" style="font-size: 2rem; font-weight: 800;">REGISTRARSE</h1>

			<?php if(isset($_GET['error'])) { ?>
				<p class="error"><?php echo $_GET['error']; ?></p>
			<?php } ?>
			<br>
			<?php if(isset($_GET['alert'])) { ?>
				<p class="alert"><?php echo $_GET['alert']; ?></p>
			<?php } ?>
			<br>

			<div class="input-group">
				<input type="text" class="form-control" placeholder="Nombre" name="nombre" value="<?php echo $nombre; ?>" required>
			</div>

			<div class="input-group">
				<input type="email" class="form-control" placeholder="Correo electrónico" name="email" value="<?php echo $email; ?>" required>
			</div>

			<div class="input-group">
				<input type="password" class="form-control" placeholder="Contraseña" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>

            <div class="input-group">
				<input type="password" class="form-control" placeholder="Confirmar contraseña" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>

			<div class="input-group">
				<button name="submit" class="btn btn__danger">Registrar</button>
			</div>

			<p class="login-register-text">Tiene una cuenta? <a href="login.php">Iniciar Sesión</a>.</p>
		</form>
	</div>
</body>
</html>