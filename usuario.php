<?php
include 'conexionbd.php';
session_start();
if (!isset($_SESSION["usuario_nombre"])) {
    // El usuario no ha iniciado sesión, redirigir al formulario de inicio de sesión
    header("Location: login.php");
    exit;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION["usuario_nombre"]); ?></h1>
   <p><a href="logout.php">Cerrar sesión</a></p>
</body>
</html>