<?php
include 'conexionbd.php';
session_start();
$id = $_POST['id_modelado'];
$sqlModelo = "SELECT * FROM modelados WHERE id = ?";
$stmtModelo = $conn->prepare($sqlModelo);
$stmtModelo->bind_param("i", $id);
$stmtModelo->execute();
$resultModelo = $stmtModelo->get_result();
if ($resultModelo->num_rows > 0) {
    $modelo = $resultModelo->fetch_assoc();

    $nombre = $modelo['nombre'];
    $descripcion = $modelo['descripcion'];
    $precio = $modelo['precio'];
    $contenido = $modelo['contenido'];
    $imagen = $modelo['imagen'];
} else {
    echo "Modelo no encontrado.";
    exit;
}
$sqlFavoritos = "SELECT * FROM favoritos WHERE id = ? ";
$stmtFavoritos = $conn->prepare($sqlFavoritos);
$stmtFavoritos->bind_param("i", $id);
$stmtFavoritos->execute();
if ($stmtFavoritos->get_result()->num_rows > 0) {
    // Ya existe el modelo en favoritos
    echo "El modelo ya está en favoritos.";
    ?>
    <script>
        alert("El modelo ya está en favoritos.");
        window.location.href = "index.php";
    </script>
    <?php
    exit;
} else {
    $sql = "INSERT INTO favoritos (id, nombre, descripcion, precio, contenido, imagen) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ississ", $id, $nombre, $descripcion, $precio, $contenido, $imagen);
    $stmt->execute();
    header("Location: index.php");
    exit;
}
