<?php
require_once 'conection.php';

session_start();

if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
}
//editar datos
if(!empty($_POST["save_record"])) {
	$pdo_statement=$con->prepare("UPDATE crud3 set titulo='" . $_POST[ 'titulo' ] . "', descripcion='" . $_POST[ 'descripcion' ]. "', cultura='" . $_POST[ 'cultura' ]. "' WHERE id=" . $_GET["id"]);
	$result = $pdo_statement->execute();
	if($result) {
		header('location:menu.php');
	}
}
$pdo_statement = $con->prepare("SELECT * FROM crud3 where id=" . $_GET["id"]);
$pdo_statement->execute();
$result = $pdo_statement->fetchAll();


if (($_FILES['my_file']['name']!="")){
        $target_dir = "archivos/";
        $file = $_FILES['my_file']['name'];
        $path = pathinfo($file);
        $filename = $path['filename'];
        $ext = $path['extension'];
        $temp_name = $_FILES['my_file']['tmp_name'];
        $path_filename_ext = $target_dir.$filename.".".$ext;
     
    if (file_exists($path_filename_ext)) {
     echo "Lo siento, Los archivos existen.";
     }else{
     move_uploaded_file($temp_name,$path_filename_ext);
     }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/formulario.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <title>Menu</title>
</head>
<body>
    <nav class="sidebar">
        <header>
        <div class="image-text">
            <span class="image">
                <img src="logo.png" alt="logo">
            </span>

            <div class="text header-text">
                <span class="name"> <?php echo "<h6>" . $_SESSION['nombre'] . "</h6>"; ?></span>
                <span class="profession">Administrador</span>
            </div>
        </div>
        </header>
        <br>
        <div class="menu-bar">
            <div class="bottom-content">
                <li class="nav-link">
                    <a href="menu.php">
                        <i class="bx bx-archive-out icon"></i>
                        <span class="text nav-text">Archivos</span>
                    </a>
                </li>
           </div>

            <div class="bottom-content">
                <li class="nav-link">
                    <a href="cierre.php">
                        <i class="bx bx-log-out icon"></i>
                        <span class="text nav-text">Cerrar Sesión</span>
                    </a>
                </li>
            </div>

        </div>
    </nav>

    <section class="home">
    <form name="form" method="post" enctype="multipart/form-data" class="form-register">
        <div class="content">
            <div class="header">
            <h2>Editar Saber Ancestral</h2> 
            </div>
            <br>
            <div class="body">
                <div class="form-group">
                <label class="form-label required">Ingrese el Tema:</label>
                <br>
                <input type="text" name="titulo" value="<?php echo $result[0]['titulo']; ?>" class="form-control required" required>
                </div>

                <div class="form-group">
                <label class="form-label required">Ingrese una Descripción:</label>
                <br>
                <textarea type="text" name="descripcion" rows="4" class="form-control required" required><?php echo $result[0]['descripcion']; ?></textarea>
                </div>

                <div class="form-group">
                <label class="form-label required">Elija la Nacionalidad o Pueblo:</label>
                <br>
                <select id="cultura" class="form-control required" name="cultura" value="<?php echo $result[0]['cultura']; ?>">
                <option value="Nacionalidad Achuar">Nacionalidad Achuar</option>
                <option value="Nacionalidad Andoa">Nacionalidad Andoa</option>
                <option value="Nacionalidad Awá">Nacionalidad Awá</option>
                <option value="Nacionalidad Chachi">Nacionalidad Chachi</option>
                <option value="Nacionalidad Cofán">Nacionalidad Cofán</option>
                <option value="Nacionalidad Éperara Siapidara">Nacionalidad Éperara Siapidara</option>
                <option value="Nacionalidad Kichwa">Nacionalidad Kichwa</option>
                <option value="Nacionalidad Sápara">Nacionalidad Sápara</option>
                <option value="Nacionalidad Sekoya">Nacionalidad Sekoya</option>
                <option value="Nacionalidad Shiwiar">Nacionalidad Shiwiar</option>
                <option value="Nacionalidad Shuar">Nacionalidad Shuar</option>
                <option value="Nacionalidad Siona">Nacionalidad Siona</option>
                <option value="Nacionalidad Tsáchila">Nacionalidad Tsáchila</option>
                <option value="Nacionalidad Waorani">Nacionalidad Waorani</option>
                <option value="Pueblo Afroecuatoriano">Pueblo Afroecuatoriano</option>
                <option value="Pueblo Huancavilca">Pueblo Huancavilca</option>
                <option value="Pueblo Manta">Pueblo Manta</option>
                <option value="Pueblo Montuvio">Pueblo Montuvios</option>
                </select>	
                </div>

                <div class="mb-3">
                <label class="form-label required">Ingrese los archivos:</label>
                <br>
                <input type="file" id="my_file" name="my_file" value="<?php echo $result[0]['my_file']; ?>"  class="form-control required">
                </div>

            </div>

            <div class="footer">
                <a href="menu.php" class="btn btn-danger cancelar">CANCELAR</a>
				<input type="submit" name="save_record" value="GUARDAR" class="btn btn-success guardar">
            </div>
        </div>
    </form>
    </section>
    
</body>
</html>