<?php

require_once 'conexion.php';
session_start();

$usuario = $_POST['usuario'];
$password = $_POST['password'];

$sql = "SELECT * FROM credenciales WHERE usuario = '" . $usuario . "'";

$resultado = mysqli_query($conexion, $sql);

$fila = mysqli_fetch_assoc($resultado);

$passwordHash = $fila['password'];

if (password_verify($password, $passwordHash)) {
    $_SESSION['logueado'] = true;
    echo "<script language='JavaScript'>
    alert('Permiso concedido...');
    location.assign('home.php');
    </script>";
} else {
    $_SESSION['logueado'] = false;
    echo "<script language='JavaScript'>
    alert('Usuario o Password erróneos...');
    location.assign('login.php');
    </script>";
}
