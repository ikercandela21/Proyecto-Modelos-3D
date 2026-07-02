<?php
session_start();
require_once 'conexionbd.php';

if (isset($_GET['id'])) {
    $modeloId = intval($_GET['id']);
    $sql = "UPDATE modelados SET num_descargas = num_descargas + 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $modeloId);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>