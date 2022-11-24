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
    <title>Modificar contacto</title>
</head>

<body>
    <?php
    include "header.php";
    ?>
    <hr>
    <h1>Eliminar contacto: </h1>
    <?php
    include "conexion.php";
    $sql = "SELECT * FROM contactos";
    $resultado = mysqli_query($conexion, $sql);
    ?>
    <h2>Lista de Contactos:</h2>
    <table class="minimalistBlack">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($filas = mysqli_fetch_assoc($resultado)) {
            ?>
                <tr>
                    <td><?php echo $filas['nombre'] ?></td>
                    <td><?php echo $filas['apellidos'] ?></td>
                    <td><?php echo $filas['direccion'] ?></td>
                    <td><?php echo $filas['telefono'] ?></td>
                    <td><?php echo $filas['email'] ?></td>
                    <td>
                        <?php echo "<a href='modificar_2.php?id=" . $filas['id'] . "'>Modificar contacto</a>"; ?>
                    </td>
                </tr>
            <?php
            }
            ?>
    </table>
    <?php
    mysqli_close($conexion);
    ?>
</body>

</html>