<?php 

$server = "localhost";
$user = "root";
$pass = "";
$database = "centro_documentacion";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Conexión Fallida.')</script>");
}

?>