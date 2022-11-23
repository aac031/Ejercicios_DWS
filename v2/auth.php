<?php
include 'conexion.php';
session_start();

if (isset($_POST['usuario']) && isset($_POST['password'])) {
  $usuario = $_POST['usuario'];
  $password = $_POST['password'];
  
  $sql = "SELECT * FROM credenciales WHERE usuario = '" . $usuario . "'";
  
  $resultado = mysqli_query($conexion, $sql);
  
  $fila = mysqli_fetch_assoc($resultado);
  
  $passwordCifrada = $fila['password'];
  
  if (password_verify($password, $passwordCifrada)) {
      $_SESSION['logueado'] = true;
  
      //Sentencias creacion tabla para contactos de personas
      $sql_drop_persona = "DROP TABLE IF EXISTS `contacto_persona`";
      $drop_persona = mysqli_query($conexion, $sql_drop_persona);
  
      $sql_create_persona = "CREATE TABLE IF NOT EXISTS `contacto_persona` (
          `id` int(200) NOT NULL,
          `nombre` varchar(200) NOT NULL,
          `apellidos` varchar(200) NOT NULL,
          `direccion` varchar(200) NOT NULL,
          `telefono` varchar(200) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
      $create_persona = mysqli_query($conexion, $sql_create_persona);
  
      $sql_alter_persona = "ALTER TABLE `contacto_persona`
      ADD PRIMARY KEY (`id`)";
      $alter_persona = mysqli_query($conexion, $sql_alter_persona);
  
      $sql_modify_persona = "ALTER TABLE `contacto_persona`
      MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1";
      $modify_persona = mysqli_query($conexion, $sql_modify_persona);
  
      //Sentencias creacion tabla para contactos de empresas
      $sql_drop_empresa = "DROP TABLE IF EXISTS `contacto_empresa`";
      $drop_empresa = mysqli_query($conexion, $sql_drop_empresa);
  
      $sql_create_empresa = " CREATE TABLE IF NOT EXISTS `contacto_empresa` (
        `id` int(200) NOT NULL,
        `nombre` varchar(200) NOT NULL,
        `direccion` varchar(200) NOT NULL,
        `telefono` varchar(200) NOT NULL,
        `email` varchar(200) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
      $create_empresa = mysqli_query($conexion, $sql_create_empresa);
  
      $sql_alter_empresa = "ALTER TABLE `contacto_empresa`
      ADD PRIMARY KEY (`id`)";
      $alter_empresa = mysqli_query($conexion, $sql_alter_empresa);
  
      $sql_modify_empresa = "ALTER TABLE `contacto_empresa`
      MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1";
      $modify_empresa = mysqli_query($conexion, $sql_modify_empresa);
  
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
} else {
  header("Location: login.php");
}

