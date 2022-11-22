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
    <title>Home</title>
</head>

<body>
    <?php
    include "header.php";
    ?>
    <hr>
    <h1>Bienvenido: </h1>
    <form action="importar_persona.php" method="POST">
        <label for="usuario">Importar contactos de personas: </label>
        <input type="submit" name="importar" value="Importar">
    </form>
    <br><br>
    <form action="importar_empresa.php" method="POST">
        <label for="usuario">Importar contactos de empresas: </label>
        <input type="submit" name="importar" value="Importar">
    </form>

    <?php
    include "conexion.php";
    $sql = "SELECT * FROM contacto_persona";
    $resultado = mysqli_query($conexion, $sql);

    $sql = "SELECT * FROM contacto_empresa";
    $resultado2 = mysqli_query($conexion, $sql);
    ?>

    <h2>Lista de contactos de personas:</h2>
    <table class="minimalistBlack">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Direccion</th>
                <th>Telefono</th>
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
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <br>
    <hr>
    <h2>Lista de contactos de empresas:</h2>
    <table class="minimalistBlack">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($filas = mysqli_fetch_assoc($resultado2)) {
            ?>
                <tr>
                    <td><?php echo $filas['nombre'] ?></td>
                    <td><?php echo $filas['direccion'] ?></td>
                    <td><?php echo $filas['telefono'] ?></td>
                    <td><?php echo $filas['email'] ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <?php
    mysqli_close($conexion);
    ?>
</body>

</html>