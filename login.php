<?php

include 'conexion.php';

session_start();

error_reporting(0);

if (isset($_SESSION['nombre'])) {
    header("Location: menu.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM usuarios WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['nombre'] = $row['nombre'];
		header("Location: menu.php");
	} else {
		header("Location: login.php?error=El correo o la contraseña son incorrectos");
	}
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">

    <title>Login</title>
</head>
<body>
<div class="container">
		<form action="" method="POST" class="login-email">
			<h1 class="login-text" style="font-size: 2rem; font-weight: 800;">LOGIN</h1>

			<?php if(isset($_GET['error'])) { ?>
				<p class="error"><?php echo $_GET['error']; ?></p>
			<?php } ?>
            
			<br>
			<div class="input-group">
				<input type="email" placeholder="Correo electrónico" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Contraseña" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn btn__sucess">Iniciar Sesión</button>
			</div>
			<p class="login-register-text">No tiene una cuenta? <a href="registro.php">Regístrese Aquí</a>.</p>
		</form>
	</div>
    
</body>
</html>