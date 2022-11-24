<?php
// Comprobamos la existencia de la sesión, si no existe lo enviamos a login.
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
    // Llamamos a conexion.php para realizar las consultas en la base de datos.
    include "conexion.php";
    ?>
    <hr>
    <!-- Usamos la variable predefinida $_SERVER['PHP_SELF'] para que envie la información a sí misma. -->
    <h1>Buscar contacto empresa: </h1>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <label>Nombre de empresa: </label>
        <input type="text" name="nombre">
        <input type="submit" name="envio2" value="Buscar">
    </form>
    <br>
    <!-- Creamos una tabla en la cual mostraremos todos los contactos con sus respectivos datos. -->
    <h2>Lista de contactos de empresas:</h2>
    <!-- A la tabla se le asignará una clase que afectará en su estilo. -->
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
            // Comprobamos si la informacion ha sido enviada
            if (isset($_POST['envio2'])) {
                // Asignamos una variable a la información recibida
                $nombre = $_POST['nombre'];

                // Si la información está vacía se mostrará un mensaje al usuario
                if (empty($_POST['nombre'])) {
                    echo "<script language='JavaScript'>
                    alert('Introduce el nombre para la búsqueda.');
                    location.assign('buscar.php');
                    </script>";
                } else {
                    // Buscaremos en la base de datos los contactos de las empresas por su nombre
                    $sql = "SELECT * FROM contacto_empresa WHERE nombre like '%" . $nombre . "%'";
                }
                // Ejecutamos la consulta
                $resultado = mysqli_query($conexion, $sql);

                // Si el resultado de la consulta es 0, significa que no existe ese nombre en la base de datos.
                // Mostramos un mensaje al usuario de que no existe ese nombre en la base de datos.
                if (mysqli_num_rows($resultado) == 0) {
                    echo "<script language='JavaScript'>
                    alert('El nombre no existe en la base de datos.');
                    location.assign('buscar.php');
                    </script>";
                }
                // En la tabla creada anteriormente, se mostrará siempre los datos que se encuentren en la base de datos.
                // Si no hay datos, en la base simplemente estará vacía la tabla.
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
                // Mostramos al usuario la lista de contactos de empresas, el cual solo mostrará el nombre, si quiere ver mas datos tendrá
                // que buscar su nombre en la base de datos.
                $sql = "SELECT * FROM contacto_empresa";
                // Ejecutamos la sentencia.
                $resultado = mysqli_query($conexion, $sql);
                // En la tabla creada, se mostrará siempre los datos que se encuentren en la base de datos.
                // Si no hay datos, en la base simplemente estará vacía la tabla.
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
    // Cerramos la conexion con la base de datos.
    mysqli_close($conexion);
    ?>
</body>

</html>