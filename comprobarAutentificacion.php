<?php
session_start();
if (isset($_SESSION["usuario"]) && $_SESSION["usuario"]) {
    // El usuario ya ha iniciado sesión
    header("Location: usuario.php");
    exit;
}else{
    // El usuario no ha iniciado sesión, redirigir al formulario de inicio de sesión
    header("Location: login.php");
    exit;
}
?>