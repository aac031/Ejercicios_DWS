<?php
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
    <title>Buscar contactos</title>
</head>

<body>
    <?php
    include "conexion.php";
    ?>
    <hr>
    <h1>Buscar contacto empresa: </h1>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <label>Nombre de empresa: </label>
        <input type="text" name="nombre">
        <input type="submit" name="envio2" value="Buscar">
    </form>
    <br>
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
            if (isset($_POST['envio2'])) {
                $nombre = $_POST['nombre'];

                if (empty($_POST['nombre'])) {
                    echo "<script language='JavaScript'>
                    alert('Introduce el nombre para la búsqueda.');
                    location.assign('buscar.php');
                    </script>";
                } else {
                    $sql = "SELECT * FROM contacto_empresa WHERE nombre like '%" . $nombre . "%'";
                }
                $resultado = mysqli_query($conexion, $sql);

                if (mysqli_num_rows($resultado) == 0) {
                    echo "<script language='JavaScript'>
                    alert('El nombre no existe en la base de datos.');
                    location.assign('buscar.php');
                    </script>";
                }
                while ($filas = mysqli_fetch_assoc($resultado)) {
            ?>
                    <tr>
                        <td><?php echo $filas['nombre'] ?></td>
                        <td><?php echo $filas['direccion'] ?></td>
                        <td><?php echo $filas['telefono'] ?></td>
                        <td><?php echo $filas['email'] ?></td>
                    </tr>
                <?php
                }
            } else {
                $sql = "SELECT * FROM contacto_empresa";
                $resultado = mysqli_query($conexion, $sql);
                while ($filas = mysqli_fetch_assoc($resultado)) {
                ?>
                    <tr>
                        <td><?php echo $filas['nombre'] ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
    <?php
    mysqli_close($conexion);
    ?>
</body>

</html>