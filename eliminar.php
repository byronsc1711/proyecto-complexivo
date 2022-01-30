<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'practicas');

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM crud3 WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo '<script> alert("Datos Eliminados"); </script>';
        header("Location:menu.php");
    }
    else
    {
        echo '<script> alert("Datos no eliminados"); </script>';
    }
}

?>