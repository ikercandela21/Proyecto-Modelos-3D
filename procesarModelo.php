<?php
// Activar manejo de errores y capturarlos
error_reporting(E_ALL);
ini_set('display_errors', 0); // NO mostrar errores en pantalla
ini_set('log_errors', 1); // Guardar errores en log

// Iniciar sesión ANTES de cualquier output
session_start();
$_SESSION['usuario'] = 1; // PARA PRUEBAS: Simular usuario autenticado
// Asegurar que siempre se devuelva JSON
header('Content-Type: application/json; charset=utf-8');

// Capturar cualquier error y devolverlo como JSON
try {
    require_once 'conexionbd.php';
    require_once __DIR__ . '/api-google/vendor/autoload.php';

    // La RUTA al JSON de Google
    $KEY_FILE_LOCATION = __DIR__ . '/JSON/cargararchivos-466413-a70460ea0855.json';
    $DRIVE_FOLDER_ID = '11kz_Hukoe20GU1HjgstERZc_LQSB4WU1';

    // Verificar que el archivo JSON existe
    if (!file_exists($KEY_FILE_LOCATION)) {
        throw new Exception('No se encuentra el archivo de credenciales de Google Drive en: ' . $KEY_FILE_LOCATION);
    }

    // Verificar que el usuario esté autenticado
    if (!isset($_SESSION['usuario'])) {
        echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
        exit;
    }

    // Configuración de Google Drive
    // Configuración de Google Drive
function uploadToGoogleDrive($file, $KEY_FILE_LOCATION, $DRIVE_FOLDER_ID)
{
    try {
        $client = new Google_Client();
        $client->setAuthConfig($KEY_FILE_LOCATION);
        $client->setScopes([Google_Service_Drive::DRIVE]);
        $client->setApplicationName('Modelados Infinity');

        $service = new Google_Service_Drive($client);

        // Crear metadata del archivo
        $fileMetadata = new Google_Service_Drive_DriveFile([
            'name' => $file['name'],
            'parents' => [$DRIVE_FOLDER_ID]
        ]);

        // Cargar el contenido del archivo temporal
        $content = file_get_contents($file['tmp_name']); 

        // === SUBIDA FINAL CON supportsAllDrives ===
        $uploadedFile = $service->files->create($fileMetadata, [
            'data' => $content, // Usamos el contenido cargado en memoria
            'mimeType' => $file['type'],
            'uploadType' => 'multipart',
            'supportsAllDrives' => true // ¡Línea clave!
        ]);

        // Obtener el ID del archivo subido
        $fileId = $uploadedFile->id ?? (method_exists($uploadedFile, 'getId') ? $uploadedFile->getId() : null);

        // Hacer el archivo público
        $permission = new Google_Service_Drive_Permission([
            'type' => 'anyone',
            'role' => 'reader'
        ]);

        if ($fileId) {
            // Crear permiso público (soporta unidades compartidas)
            $service->permissions->create($fileId, $permission, ['supportsAllDrives' => true]);

            // Construir link de descarga / visualización público
            $downloadLink = 'https://drive.google.com/uc?id=' . $fileId . '&export=download';
        } else {
            throw new Exception('No se pudo obtener el ID del archivo subido a Google Drive');
        }

        return [
            'success' => true,
            'fileId' => $fileId,
            'downloadLink' => $downloadLink
        ];

    } catch (Exception $e) {
        return [
            'success' => false,
            'error' => $e->getMessage()
        ];
    }
}

    // Procesar formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Validar campos requeridos
        if (empty($_POST['modelName'])) {
            throw new Exception('El nombre del modelo es requerido');
        }
        if (empty($_POST['modelCategory'])) {
            throw new Exception('La categoría es requerida');
        }
        if (empty($_POST['modelPrice'])) {
            throw new Exception('El precio es requerido');
        }

        // Validar imagen de portada
        if (!isset($_FILES['coverImage'])) {
            throw new Exception('No se recibió la imagen de portada');
        }
        if ($_FILES['coverImage']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Error al subir la imagen de portada. Código: ' . $_FILES['coverImage']['error']);
        }

        // Validar archivo del modelo
        if (!isset($_FILES['modelFiles'])) {
            throw new Exception('No se recibió el archivo del modelo');
        }
        if ($_FILES['modelFiles']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Error al subir el archivo del modelo. Código: ' . $_FILES['modelFiles']['error']);
        }

        // ========== PROCESAR IMAGEN DE PORTADA ==========
        $coverImage = $_FILES['coverImage'];
        $allowedImageTypes = ['image/jpeg', 'image/png', 'image/webp'];

        if (!in_array($coverImage['type'], $allowedImageTypes)) {
            throw new Exception('Formato de imagen no válido. Solo JPG, PNG o WEBP');
        }

        // Crear carpeta de uploads si no existe
        $uploadDir = __DIR__ . '/uploads/images/';
        if (!file_exists($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                throw new Exception('No se pudo crear la carpeta de imágenes');
            }
        }

        // Generar nombre único para la imagen
        $imageExtension = pathinfo($coverImage['name'], PATHINFO_EXTENSION);
        $imageName = 'model_' . time() . '_' . uniqid() . '.' . $imageExtension;
        $imagePath = $uploadDir . $imageName;

        // Mover imagen al servidor
        if (!move_uploaded_file($coverImage['tmp_name'], $imagePath)) {
            throw new Exception('Error al guardar la imagen en el servidor');
        }

        // Ruta relativa para la base de datos
        $imagePathDB = 'uploads/images/' . $imageName;

        // ========== PROCESAR ARCHIVO ZIP (SUBIR A GOOGLE DRIVE) ==========
        $modelFile = $_FILES['modelFiles'];

        // Subir archivo a Google Drive
        $driveResult = uploadToGoogleDrive($modelFile, $KEY_FILE_LOCATION, $DRIVE_FOLDER_ID);

        if (!$driveResult['success']) {
            // Si falla Google Drive, eliminar la imagen
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            throw new Exception('Error al subir archivo a Google Drive: ' . $driveResult['error']);
        }

        // ========== PREPARAR DATOS PARA BASE DE DATOS ==========
        $nombre = $conn->real_escape_string($_POST['modelName']);
        $descripcion = isset($_POST['modelDescription']) ? $conn->real_escape_string($_POST['modelDescription']) : '';
        $imagen = $imagePathDB;
        $contenido = $driveResult['downloadLink'];
        $precio = floatval($_POST['modelPrice']);
        $tipo = $conn->real_escape_string($_POST['modelCategory']);
        $likes = 0;
        $num_descargas = 0;

        // ========== INSERTAR EN BASE DE DATOS ==========
        $sql = "INSERT INTO modelados (nombre, descripcion, imagen, contenido, precio, likes, num_descargas, tipo) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception('Error al preparar consulta: ' . $conn->error);
        }

        $stmt->bind_param("ssssdiss", $nombre, $descripcion, $imagen, $contenido, $precio, $likes, $num_descargas, $tipo);

        if ($stmt->execute()) {
            $modeloId = $conn->insert_id;

            echo json_encode([
                'success' => true,
                'message' => 'Modelo publicado exitosamente',
                'modelId' => $modeloId,
                'driveFileId' => $driveResult['fileId']
            ]);
        } else {
            // Si falla la inserción, eliminar imagen subida
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            throw new Exception('Error al guardar en la base de datos: ' . $stmt->error);
        }

        $stmt->close();
        $conn->close();
    } else {
        throw new Exception('Método no permitido');
    }
} catch (Exception $e) {
    // Capturar cualquier error y devolverlo como JSON
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ]);
} catch (Error $e) {
    // Capturar errores fatales de PHP
    echo json_encode([
        'success' => false,
        'message' => 'Error fatal: ' . $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ]);
}
