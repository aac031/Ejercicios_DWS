<?php
//Si se quiere subir una imagen
if (isset($_POST['subir_usuario'])) {
    //Recogemos el archivo enviado por el formulario
    $archivo = $_FILES['archivo']['name'];
    //Si el archivo contiene algo y es diferente de vacio
    if (isset($archivo) && $archivo != "") {
        //Obtenemos algunos datos necesarios sobre el archivo
        $tipo = $_FILES['archivo']['type'];
        $tamano = $_FILES['archivo']['size'];
        $temp = $_FILES['archivo']['tmp_name'];
        //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
        if (!((strpos($tipo, "png") || strpos($tipo, "jpg") || strpos($tipo, "pdf")) && ($tamano <= 50000000))) {
            echo "<script language='JavaScript'>
                    alert('La extensión o tamaño de la imagen no es correcta.');
                    location.assign('imagen.php');
                    </script>";
        } else {
            //Si la imagen es correcta en tamaño y tipo
            //Se intenta subir al servidor
            if (move_uploaded_file($temp, 'uploads/' . $archivo)) {
                //Mostramos el mensaje de que se ha subido co éxito
                echo "<script language='JavaScript'>
                    alert('Se ha subido la imagen correctamente.');
                    location.assign('imagen.php');
                    </script>";
            } else {
                //Si no se ha podido subir la imagen, mostramos un mensaje de error
                echo "<script language='JavaScript'>
                    alert('Hubo un error al subir la imagen.');
                    location.assign('imagen.php');
                    </script>";
            }
        }
    }
}

if (isset($_POST['subir_empresa'])) {
    //Recogemos el archivo enviado por el formulario
    $archivo = $_FILES['archivo']['name'];
    //Si el archivo contiene algo y es diferente de vacio
    if (isset($archivo) && $archivo != "") {
        //Obtenemos algunos datos necesarios sobre el archivo
        $tipo = $_FILES['archivo']['type'];
        $tamano = $_FILES['archivo']['size'];
        $temp = $_FILES['archivo']['tmp_name'];
        //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
        if (!((strpos($tipo, "png") || strpos($tipo, "jpg") || strpos($tipo, "pdf")) && ($tamano <= 50000000))) {
            echo "<script language='JavaScript'>
                    alert('La extensión o tamaño del logo no es correcto.');
                    location.assign('imagen.php');
                    </script>";
        } else {
            //Si la imagen es correcta en tamaño y tipo
            //Se intenta subir al servidor
            if (move_uploaded_file($temp, 'uploads/' . $archivo)) {
                //Mostramos el mensaje de que se ha subido co éxito
                echo "<script language='JavaScript'>
                    alert('Se ha subido el logo correctamente.');
                    location.assign('imagen.php');
                    </script>";
            } else {
                //Si no se ha podido subir la imagen, mostramos un mensaje de error
                echo "<script language='JavaScript'>
                    alert('Hubo un error al subir el logo.');
                    location.assign('imagen.php');
                    </script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Subir imagen o logo</title>
</head>

<body>
    <?php
    include "header.php";
    ?>
    <hr>
    <br>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" method="POST">
        <label>Añadir imagen a usuario:</label>
        <input name="archivo" id="archivo" type="file">
        <input type="submit" name="subir_usuario" value="Subir imagen">
    </form>
    <br><br>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" method="POST">
        <label>Añadir logo a empresa:</label>
        <input name="archivo" id="archivo" type="file">
        <input type="submit" name="subir_empresa" value="Subir imagen">
    </form>
</body>

</html>