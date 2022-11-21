<?php
session_start();
if (!isset($_SESSION['logueado']) || !$_SESSION['logueado']) {
    header("Location: login.php");
}
?>
<?php
include "conexion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Buscar contacto</title>
</head>

<body>
    <?php
    include "header.php";
    ?>
    <hr>
    <h1>Buscar contacto: </h1>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <table>
            <h2>Lista de contactos:</h2>

            <label>Nombre: </label>
            <input type="text" name="nombre">
            <input type="submit" name="envio" value="Buscar">
    </form>
    <br><br>
    <table class="minimalistBlack">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_POST['envio'])) {
                $nombre = $_POST['nombre'];

                if (empty($_POST['nombre'])) {
                    echo "<script language='JavaScript'>
                    alert('Introduce el nombre para la búsqueda.');
                    location.assign('buscar.php');
                    </script>";
                } else {
                    $sql = "SELECT * FROM contactos WHERE nombre like '%" . $nombre . "%'";
                }
                $resultado = mysqli_query($conexion, $sql);

                while ($filas = mysqli_fetch_assoc($resultado)) {
            ?>
                    <tr>
                        <td><?php echo $filas['nombre'] ?></td>
                        <td><?php echo $filas['apellidos'] ?></td>
                        <td><?php echo $filas['direccion'] ?></td>
                        <td><?php echo $filas['telefono'] ?></td>
                        <td><?php echo $filas['email'] ?></td>
                    </tr>
                <?php
                }
            } else {
                $sql = "SELECT * FROM contactos";
                $resultado = mysqli_query($conexion, $sql);
                while ($filas = mysqli_fetch_assoc($resultado)) {
                ?>
                    <tr>
                        <td><?php echo $filas['nombre'] ?></td>
                        <td><?php echo $filas['apellidos'] ?></td>
                        <td><?php echo $filas['direccion'] ?></td>
                        <td><?php echo $filas['telefono'] ?></td>
                        <td><?php echo $filas['email'] ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>