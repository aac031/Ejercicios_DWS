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
    <title>Crear contacto de persona</title>
</head>

<body>
    <?php
    include "header.php";
    ?>
    <hr>
    <?php
    if (isset($_POST['envio'])) {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];

        include("conexion.php");
        $sql = "INSERT INTO contacto_persona(nombre, apellidos, direccion, telefono)
        VALUES('" . $nombre . "', '" . $apellidos . "', '" . $direccion . "', '" . $telefono . "')";

        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            echo "<script language='JavaScript'>
            alert('El contacto de persona fue agregado con éxito.');
            location.assign('home.php');
            </script>";
        } else {
            echo "<script language='JavaScript'>
            alert('Hubo un error al agregar el contacto.');
            location.assign('crear_persona.php');
            </script>";
        }
        mysqli_close($conexion);
    }
    ?>
    <h1>Añadir contacto de persona: </h1>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" required>
        <br><br>
        <label for="apellidos">Apellidos: </label>
        <input type="text" name="apellidos">
        <br><br>
        <label for="direccion">Dirección: </label>
        <input type="text" name="direccion">
        <br><br>
        <label for="telefono">Teléfono: </label>
        <input type="tel" name="telefono">
        <br><br>
        <input type="submit" name="envio" value="Enviar">
    </form>
</body>

</html>