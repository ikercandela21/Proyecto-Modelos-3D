<?php
include "conexionbd.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();    
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];

    $_SESSION["usuario"] = $usuario;
    $_SESSION["contraseña"] = $contraseña;
    
    

    $sql = "SELECT * FROM usuarios WHERE nick = ? AND contraseña = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $contraseña);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            
            $tipo= $row['tipo'];
            $_SESSION["tipo"]=$tipo;
        }


        echo "Inicio de sesión exitoso";
        if ($tipo == 'admin') {
            header("Location: index.php");
            exit();
        } else {
            header("Location: usuario.php");
            exit();
        }
    } else {
        echo "Usuario o contraseña incorrectos";
        header("Location:index.php");
        exit();
    }

    $conexion->close();
}