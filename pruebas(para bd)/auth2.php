<?php

// require_once ("conexion.php");
session_start();
// $usuario = $_POST['usuario'];
// $password = $_POST['password'];

// $sql = "SELECT * FROM credenciales WHERE usuario = '" . $usuario . "'";

// $resultado = $conexion->query("$sql");

// $fila = mysqli_fetch_assoc($resultado);

// $passwordHash = $fila['password'];

// if(password_verify($password, $passwordHash)) {
//     $_SESSION['logueado'] = true;
//     header("Location: home.php");
// } else {
//     $_SESSION['logueado'] = false;
//     header("Location: login.php");
// }

if (isset($_POST['envio'])) {
    if (empty($_POST['usuario']) || empty($_POST['password'])) {
        echo "<script language='JavaScript'>
        alert('Usuario o Password no introducido.');
        location.assign('login.php');
        </script>";
    } else {
        include("conexion.php");
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $sql = "select * from credenciales where usuario='" . $usuario . "' and password='" . $password . "'";
        $resultado = mysqli_query($conexion, $sql);

        if ($fila = mysqli_fetch_assoc($resultado)) {
            $_SESSION['logueado'] = true;
            echo "<script language='JavaScript'>
             alert('Bienvenido...');
             location.assign('home.php');
            </script>";
        } else {
            $_SESSION['logueado'] = false;
            echo "<script language='JavaScript'>
            alert('Usuario o Password erróneos.');
            location.assign('login.php');
             </script>";
        }
    }
}
