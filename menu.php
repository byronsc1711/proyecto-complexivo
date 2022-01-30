<?php
include_once 'conection.php';
session_start();

if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
}
    $sentencia_select=$con->prepare('SELECT *FROM crud3 ORDER BY id ASC');
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/cambios.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://kit.fontawesome.com/646c794df3.js"></script>

    <title>Menu</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <nav class="sidebar">
        <header>
        <div class="image-text">
            <span class="image">
                <img src="css/logo.png" alt="logo">
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
        <div class="contenedor">
            <h1>SABERES ANCESTRALES</h1>
            <br>
            <a href="crear.php">
            <button type="button" class="btn btn-success nuevo">AGREGAR NUEVO</button>
            </a>
            <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> ELIMINAR SABER ANCESTRAL </h5>
                </div>
                <form action="eliminar.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="delete_id" id="delete_id">
                        <h5>Quiere eliminar este saber ancestral?</h5>
                    </div>
                    <div class="modal-footer">
                        <a href="menu.php" class="btn btn-danger">NO</a>
                        <button type="submit" name="deletedata" class="btn btn-success"> SI </button>
                    </div>
                </form>
            </div>
            </div>
            </div>
            <br><br><br>
            <table>
			<tr class="head">
				<td>#</td>
				<td>TEMA</td>
				<td>DESCRIPCIÓN</td>
				<td>NACIONALIDAD O PUEBLO</td>
				<td colspan="2">ACCIONES</td>
			</tr>
			<?php foreach($resultado as $fila):?>
				<tr >
					<td><?php echo $fila['id']; ?></td>
					<td><?php echo $fila['titulo']; ?></td>
					<td><?php echo $fila['descripcion']; ?></td>
					<td><?php echo $fila['cultura']; ?></td>
					<td><a href="editar.php?id=<?php echo $fila['id']; ?>"><button type="button" class="btn btn-primary"> <i class="fas fa-pencil-alt"></button></a></td>
					<td><button type="button" class="btn btn-danger deletebtn"> <i class="fas fa-trash-alt"></button></td>
				</tr>
			<?php endforeach ?>

		</table>
        </div>
        <script>
        $(document).ready(function () {
            $('.deletebtn').on('click', function () {
                $('#deletemodal').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();
                console.log(data);
                $('#delete_id').val(data[0]);
            });
        });
        </script>
    </section>

    
    
</body>
</html>