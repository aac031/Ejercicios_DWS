<?php

require_once 'conexion.php';
session_start();

$usuario = $_POST['usuario'];
$password = $_POST['password'];

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO credenciales VALUES (";
$sql .= "'".$usuario."', '".$passwordHash."')";

if($conexion->query($sql)) {
    $_SESSION['resultado'] = true;
} else {
    $_SESSION['resultado'] = false;
}

header("Location: home.php");