<?php
session_start();
if (!isset($_SESSION['logueado']) || !$_SESSION['logueado']) {
    header("Location: login.php");
} else {
    require "conexion.php";
    $xml = simplexml_load_file("bd/agenda.xml");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Contactos importados</title>
</head>

<body>
    <?php
    include "header.php";
    ?>
    <hr>
    <h2>Los contactos han sido importados con éxito. </h2>
    <br>
    <?php
    foreach ($xml->contacto as $datos) {
        $atributo = $datos->attributes();
        if ($atributo['tipo'] == 'persona') {
            echo "DATO IMPORTADO: <br>";
            echo "Nombre: " . $datos->nombre . "<br>";
            echo "Apellidos: " . $datos->apellidos . "<br>";
            echo "Direccion: " . $datos->direccion . "<br>";
            echo "Telefono: " . $datos->telefono . "<br>";
            echo "<br>";
            $sql = "INSERT INTO contacto_persona VALUES('', '$datos->nombre', '$datos->apellidos', '$datos->direccion', '$datos->telefono')";
            $resultado = mysqli_query($conexion, $sql);
        }
    }
    if ($resultado) {
        echo "<script language='JavaScript'>
            alert('Contactos importados correctamente.');
            </script>";
    } else {
        echo "<script language='JavaScript'>
            alert('No se han podido importar los datos, ya existen o son erróneos.');
            location.assign('home.php');
            </script>";
    }
    mysqli_close($conexion);
    ?>
    <br><br>
    <form action="home.php" method="POST">
        <input type="submit" name="voler" value="Volver">
    </form>
</body>

</html>