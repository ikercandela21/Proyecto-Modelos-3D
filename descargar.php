<?php
session_start();
require_once 'conexionbd.php';

if (!isset($_GET['id'])) exit("ID no especificado");

$modeloId = intval($_GET['id']);

$sql = "SELECT contenido FROM modelados WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $modeloId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) exit("Modelo no encontrado");

$driveUrl = $result->fetch_assoc()['contenido'];

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>

<script>
        // Incrementar descargas y redirigir
        setTimeout(() => {
            // Hacer petición para incrementar contador
            fetch('incrementaDescarga.php?id=<?= $modeloId ?>')
                .then(() => {
                    // Redirigir a Google Drive
                    window.location.href = '<?= $modelo['contenido'] ?>';
                });
        }, 2000);
// Abre Drive en nueva pestaña
window.open("<?php echo $driveUrl; ?>", "_blank");

// Cierra esta pestaña (solo funciona si fue abierta con target="_blank")
window.close();
</script>

</body>
</html>
