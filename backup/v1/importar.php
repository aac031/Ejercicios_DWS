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
    foreach ($xml as $contacto) {
        echo "DATO IMPORTADO: <br>";
        echo "Nombre: " . $contacto->nombre . "<br>";
        echo "Apellidos: " . $contacto->apellidos . "<br>";
        echo "Direccion: " . $contacto->direccion . "<br>";
        echo "Telefono: " . $contacto->telefono . "<br>";
        echo "Email: " . $contacto->email . "<br>";
        echo "<br>";
        $sql = "INSERT INTO contactos VALUES('', '$contacto->nombre', '$contacto->apellidos', '$contacto->direccion', '$contacto->telefono', '$contacto->email')";
        $resultado = mysqli_query($conexion, $sql);
    }
    if ($resultado) {
        echo "<script language='JavaScript'>
            alert('Contactos importados correctamente.');
            </script>";
    } else {
        echo "<script language='JavaScript'>
            alert('No se han podido importar los datos, ya existen o son erróneos.');
            </script>";
    }
    mysqli_close($conexion);
    ?>
</body>

</html>