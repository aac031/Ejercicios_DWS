<?php
session_start();
if (!isset($_SESSION['logueado']) || !$_SESSION['logueado']) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Modificar contactos</title>
</head>

<body>
    <?php
    include "header.php";
    include "conexion.php";
    ?>
    <hr>
    <?php
    if (isset($_POST['envio'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];

        $sql = "UPDATE contacto_empresa SET nombre='" . $nombre . "', direccion='" . $direccion . "', 
        telefono='" . $telefono . "', email='" . $email . "' where id='" . $id . "'";
        $resultado = mysqli_query($conexion, $sql);
        if ($resultado) {
            echo "<script language='JavaScript'>
                alert('El contacto fue modificado con éxito.');
                location.assign('modificar.php');
                </script>";
        } else {
            echo "<script language='JavaScript'>
                alert('Hubo un error al modificar el contacto.');
                location.assign('modificar.php');
                </script>";
        }
        mysqli_close($conexion);
    } else {
        $id = $_GET['id'];
        $sql = "SELECT * FROM contacto_empresa WHERE id= '" . $id . "'";
        $resultado = mysqli_query($conexion, $sql);

        $fila = mysqli_fetch_assoc($resultado);
        $nombre = $fila['nombre'];
        $direccion = $fila['direccion'];
        $telefono = $fila['telefono'];
        $email = $fila['email'];

        mysqli_close($conexion);
    ?>
        <h2>Modificar contacto: </h2>
        <br>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" value="<?php echo $nombre; ?>">
            <br><br>
            <label for="direccion">Dirección: </label>
            <input type="text" name="direccion" value="<?php echo $direccion; ?>">
            <br><br>
            <label for="telefono">Teléfono: </label>
            <input type="tel" name="telefono" value="<?php echo $telefono; ?>">
            <br><br>
            <label for="email">Email: </label>
            <input type="email" name="email" value="<?php echo $email; ?>">
            <br><br>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="envio" value="Modificar">
        </form>
    <?php
    }
    ?>
</body>

</html>