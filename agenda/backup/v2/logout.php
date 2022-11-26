<?php
session_start();
if (!isset($_SESSION['logueado']) || !$_SESSION['logueado']) {
    header("Location: login.php");
} else {
    unset($_SESSION['logueado']);
    header("Location: login.php");
}
