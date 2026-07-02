<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Subir Modelos 3D</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background-color: #292828;
    color: #eaeaea;
    font-family: "Poppins", sans-serif;
    min-height: 100vh;
}

/* ------------------Header--------------------- */
header {
    background-color: #242424;
    width: 100%;
    padding: 1em;
    box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
}

.header-top {
    display: grid;
    grid-template-columns: auto 1fr auto;
    align-items: center;
    margin-bottom: 1em;
}

h1 {
    font-size: 2em;
    text-align: center;
    color: white;
    grid-column: 2;
}

.logo img {
    width: 3em;
    height: auto;
}

/* ------------------Menu------------------------------ */
.mobile-menu {
    display: block;
}

.mobile-menu .hamburger {
    z-index: 10000;
    position: relative;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 1.5em;
}

.mobile-menu-items {
    position: fixed;
    top: 0;
    right: 0;
    width: 70vw;
    height: 100vh;
    background: #666666;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 2rem;
}

.mobile-menu-items a {
    color: #222;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

.mobile-menu-items a:hover {
    color: white;
}

.mobile-menu-items .enlaces {
    padding: 3em;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 1rem;
}

.usuario {
    display: flex;
    justify-content: center;
    align-items: flex-end;
    font-weight: bold;
    position: absolute;
    bottom: 1%;
    left: 0;
    width: 100%;
}

.usuario i {
    padding: 1em;
}

.menu-escritorio {
    display: none;
    text-align: center;
}

.menu-escritorio a {
    color: white;
    text-decoration: none;
    margin: 0 15px;
    font-weight: bold;
    transition: color 0.3s ease;
}

.menu-escritorio a:hover {
    color: #a906a9;
}

/* ------------------Categorías y Buscador--------------------- */
.categorias-buscador {
    display: none;
    background-color: #242424;
    padding: 1em;
    border-radius: 10px;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.categorias {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
}

.categorias a {
    color: #eaeaea;
    text-decoration: none;
    font-weight: 500;
    padding: 8px 16px;
    border-radius: 8px;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.categorias a:hover {
    background-color: #6c63ff;
    color: white;
}

.buscador-container {
    display: flex;
    align-items: center;
    background-color: #292828;
    border-radius: 25px;
    padding: 8px 16px;
    min-width: 250px;
    position: relative;
}

.buscador-container input {
    background: transparent;
    border: none;
    outline: none;
    color: white;
    padding: 5px 10px;
    width: 100%;
    font-size: 0.95em;
}

.buscador-container input::placeholder {
    color: #888;
}

.buscador-container i {
    color: #888;
    font-size: 1.1em;
    cursor: pointer;
}

.buscador-container .btn-buscar {
    background: transparent;
    border: none;
    color: #888;
    cursor: pointer;
    padding: 0;
    margin-left: 5px;
}

/* ------------------Perfil Desplegable--------------------- */
.perfil-container {
    position: relative;
    display: none;
}

.perfil-img {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    object-fit: cover;
    cursor: pointer;
    border: 2px solid #6c63ff;
    transition: border-color 0.3s ease;
}

.perfil-img:hover {
    border-color: #a906a9;
}

.perfil-menu {
    position: absolute;
    top: 60px;
    right: 0;
    background: #242424;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
    min-width: 200px;
    overflow: hidden;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 1000;
}

.perfil-menu.active {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.perfil-menu a {
    display: block;
    padding: 12px 20px;
    color: white;
    text-decoration: none;
    transition: background 0.3s ease;
    border-bottom: 1px solid #333;
}

.perfil-menu a:last-child {
    border-bottom: none;
}

.perfil-menu a:hover {
    background: #580358;
}

.perfil-menu #cerrarSesion:hover {
    background-color: #ff4b5c;
}

.perfil-menu i {
    margin-right: 10px;
    width: 20px;
}

/* ------------------Main Content--------------------- */
main {
    max-width: 900px;
    margin: 40px auto;
    padding: 0 20px;
}

.upload-container {
    background: #242424;
    border: 1px solid #2c2c2f;
    border-radius: 16px;
    padding: 2em;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.page-title {
    font-size: 1.8em;
    color: white;
    margin-bottom: 0.5em;
    text-align: center;
}

.page-subtitle {
    color: #a0a0a0;
    text-align: center;
    margin-bottom: 2em;
    font-size: 0.95em;
}

/* ------------------Image Upload Zone--------------------- */
.image-upload-section {
    margin-bottom: 2em;
}

.image-upload-zone {
    border: 2px dashed #6c63ff;
    border-radius: 12px;
    padding: 2em;
    text-align: center;
    background: #18181b;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.image-upload-zone:hover {
    border-color: #a906a9;
    background: #1f1f23;
}

.image-upload-zone.has-image {
    padding: 0;
    border: 2px solid #6c63ff;
}

.image-preview-container {
    position: relative;
    display: none;
}

.image-preview-container.active {
    display: block;
}

.image-preview {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 10px;
}

.image-remove {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #ff4b5c;
    color: white;
    border: none;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    cursor: pointer;
    font-size: 1.2em;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    z-index: 10;
}

.image-remove:hover {
    background: #ff1f38;
    transform: scale(1.1);
}

.image-upload-content {
    display: block;
}

.image-upload-zone.has-image .image-upload-content {
    display: none;
}

.upload-icon-image {
    font-size: 2.5em;
    color: #6c63ff;
    margin-bottom: 0.5em;
}

.image-upload-zone h3 {
    color: white;
    margin-bottom: 0.5em;
    font-size: 1.1em;
}

.image-upload-zone p {
    color: #a0a0a0;
    font-size: 0.9em;
}

.image-upload-zone .file-types {
    color: #6c63ff;
    font-size: 0.85em;
    margin-top: 0.5em;
}

#imageInput {
    display: none;
}

/* ------------------Upload Zone--------------------- */
.upload-zone {
    border: 2px dashed #6c63ff;
    border-radius: 12px;
    padding: 3em 2em;
    text-align: center;
    background: #18181b;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-bottom: 2em;
}

.upload-zone:hover {
    border-color: #a906a9;
    background: #1f1f23;
}

.upload-zone.dragover {
    border-color: #a906a9;
    background: #252529;
    transform: scale(1.02);
}

.upload-icon {
    font-size: 3em;
    color: #6c63ff;
    margin-bottom: 0.5em;
}

.upload-zone h3 {
    color: white;
    margin-bottom: 0.5em;
    font-size: 1.2em;
}

.upload-zone p {
    color: #a0a0a0;
    font-size: 0.9em;
}

.upload-zone .file-types {
    color: #6c63ff;
    font-size: 0.85em;
    margin-top: 0.5em;
}

#fileInput {
    display: none;
}

/* ------------------File Preview--------------------- */
.file-preview {
    display: none;
    background: #18181b;
    border-radius: 12px;
    padding: 1.5em;
    margin-bottom: 2em;
}

.file-preview.active {
    display: block;
}

.file-item {
    display: flex;
    align-items: center;
    gap: 1em;
    padding: 1em;
    background: #242424;
    border-radius: 8px;
    margin-bottom: 1em;
}

.file-item:last-child {
    margin-bottom: 0;
}

.file-icon {
    font-size: 2em;
    color: #6c63ff;
    min-width: 50px;
    text-align: center;
}

.file-info {
    flex: 1;
}

.file-name {
    color: white;
    font-weight: 500;
    margin-bottom: 0.3em;
}

.file-size {
    color: #a0a0a0;
    font-size: 0.85em;
}

.file-remove {
    background: transparent;
    border: none;
    color: #ff4b5c;
    cursor: pointer;
    font-size: 1.3em;
    padding: 0.5em;
    transition: transform 0.2s ease;
}

.file-remove:hover {
    transform: scale(1.2);
}

/* ------------------Form Fields--------------------- */
.form-section {
    margin-bottom: 1.5em;
}

.form-section label {
    display: block;
    color: white;
    font-weight: 500;
    margin-bottom: 0.5em;
    font-size: 0.95em;
}

.form-section input,
.form-section textarea,
.form-section select {
    width: 100%;
    background: #18181b;
    border: 1px solid #2c2c2f;
    border-radius: 8px;
    padding: 0.8em;
    color: white;
    font-family: inherit;
    font-size: 0.95em;
    transition: border-color 0.3s ease;
}

.form-section input:focus,
.form-section textarea:focus,
.form-section select:focus {
    outline: none;
    border-color: #6c63ff;
}

.form-section textarea {
    resize: vertical;
    min-height: 100px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1em;
}

/* ------------------Tags Input--------------------- */
.tags-container {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5em;
    padding: 0.5em;
    background: #18181b;
    border: 1px solid #2c2c2f;
    border-radius: 8px;
    min-height: 45px;
}

.tags-container input {
    flex: 1;
    min-width: 150px;
    background: transparent;
    border: none;
    color: white;
    padding: 0.3em;
}

.tags-container input:focus {
    outline: none;
}

.tag {
    background: #6c63ff;
    color: white;
    padding: 0.4em 0.8em;
    border-radius: 20px;
    font-size: 0.85em;
    display: flex;
    align-items: center;
    gap: 0.5em;
}

.tag-remove {
    cursor: pointer;
    font-weight: bold;
    transition: transform 0.2s ease;
}

.tag-remove:hover {
    transform: scale(1.2);
}

/* ------------------Buttons--------------------- */
.button-group {
    display: flex;
    gap: 1em;
    margin-top: 2em;
}

.btn {
    flex: 1;
    padding: 1em 2em;
    border: none;
    border-radius: 8px;
    font-size: 1em;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: inherit;
}

.btn-primary {
    background: #6c63ff;
    color: white;
}

.btn-primary:hover {
    background: #5a52d5;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(108, 99, 255, 0.3);
}

.btn-primary:disabled {
    background: #3d3d3d;
    color: #666;
    cursor: not-allowed;
    transform: none;
}

.btn-secondary {
    background: transparent;
    color: #a0a0a0;
    border: 1px solid #2c2c2f;
}

.btn-secondary:hover {
    background: #18181b;
    color: white;
}

/* ------------------Progress Bar--------------------- */
.progress-container {
    display: none;
    margin-top: 1em;
}

.progress-container.active {
    display: block;
}

.progress-bar {
    width: 100%;
    height: 8px;
    background: #18181b;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 0.5em;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #6c63ff, #a906a9);
    width: 0%;
    transition: width 0.3s ease;
}

.progress-text {
    text-align: center;
    color: #a0a0a0;
    font-size: 0.9em;
}

/* ------------------Success Message--------------------- */
.success-message {
    display: none;
    background: #18181b;
    border: 2px solid #00d084;
    border-radius: 12px;
    padding: 2em;
    text-align: center;
    margin-top: 2em;
}

.success-message.active {
    display: block;
}

.success-icon {
    font-size: 3em;
    color: #00d084;
    margin-bottom: 0.5em;
}

.success-message h3 {
    color: white;
    margin-bottom: 0.5em;
}

.success-message p {
    color: #a0a0a0;
}

/* ------------------Responsive--------------------- */
@media screen and (min-width: 769px) {
    .mobile-menu {
        display: none;
    }
    
    .header-top {
        margin-bottom: 1em;
    }
    
    .perfil-container {
        display: block;
    }
    
    .categorias-buscador {
        display: flex;
    }
}

@media screen and (max-width: 768px) {
    h1 {
        font-size: 1.5em;
    }
    
    .upload-container {
        padding: 1.5em;
    }
    
    .page-title {
        font-size: 1.5em;
    }
    
    .upload-zone {
        padding: 2em 1em;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .button-group {
        flex-direction: column;
    }
    
    .file-item {
        flex-direction: column;
        text-align: center;
    }
    
    .categorias-buscador {
        flex-direction: column;
        align-items: stretch;
    }
    
    .categorias {
        justify-content: center;
    }
    
    .buscador-container {
        width: 100%;
    }
    
    .image-preview {
        height: 200px;
    }
}
</style>
</head>
<body>
    <header>
        <div class="header-top">
            <div class="logo">
                <img src="img/logo.png" alt="Logo de Modelados Infinity">
            </div>
            <h1>Modelados Infinity</h1>

            <!-- Menu desplegable móvil -->
            <div class="mobile-menu">
                <div class="hamburger" onclick="toggleMenu()">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="mobile-menu-items" id="mobileMenuItems" style="display: none;">
                    <div class="enlaces">
                        <a href="index.php">Inicio</a>
                        <a href="contactanos.php">Contactanos</a>
                        <a href="favoritos.php">Favoritos</a>
                        <a href="">Mis compras</a>
                        <a href="insertarModelo.php">Insertar Modelos</a>
                        <a href="logout.php">Cerrar Sesión</a>
                        <a href="carrito.php"><i class="fa-solid fa-cart-shopping"></i></a>
                    </div>
                    <div class="usuario">
                        <a href="comprobarAutentificacion.php">
                            <i class="fas fa-user"></i>
                            <?php
                            session_start();
                            if (isset($_SESSION["usuario"]) && $_SESSION["usuario"]) {
                                echo "<span>" . htmlspecialchars($_SESSION["usuario"]) . "</span>";
                            } else {
                                echo "<span>Iniciar Sesion</span>";
                            }
                            ?>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Perfil desplegable (escritorio) -->
            <div class="perfil-container">
                <img src="https://i.pravatar.cc/150?img=12" alt="Perfil" class="perfil-img" onclick="togglePerfil()">
                <div class="perfil-menu" id="perfilMenu">
                    <a href="comprobarAutentificacion.php"><i class="fas fa-user"></i> Mi Perfil</a>
                    <a href="favoritos.php"><i class="fas fa-heart"></i> Favoritos</a>
                    <a href=""><i class="fas fa-shopping-bag"></i> Mis Compras</a>
                    <a href="insertarModelo.php"><i class="fas fa-upload"></i> Subir Modelos</a>
                    <a href=""><i class="fas fa-cog"></i> Configuración</a>
                    <a href="logout.php" id="cerrarSesion"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                </div>
            </div>
        </div>

        <!-- Categorías y Buscador -->
        <div class="categorias-buscador">
            <div class="categorias">
                <a href="index.php">Todos</a>
                <a href="">Modelos 3D</a>
                <a href="">Impresión 3D</a>
                <a href="">Texturas</a>
                <a href="" class="active">Animaciones</a>
            </div>
            <div class="buscador-container">
                <input type="text" id="buscadorInput" placeholder="Buscar modelos..." oninput="buscarModelos()" onkeypress="buscarEnter(event)">
                <button class="btn-buscar" onclick="realizarBusqueda()">
                    <i class="fas fa-search"></i>
                </button>
                <div class="resultados-busqueda" id="resultadosBusqueda"></div>
            </div>
        </div>
    </header>
    

    <main>
        <div class="upload-container">
            <h2 class="page-title">Subir Nuevo Modelo 3D</h2>
            <p class="page-subtitle">Comparte tus creaciones con la comunidad</p>

            <!-- Sección de imagen de portada -->
            <div class="image-upload-section">
                <div class="form-section">
                    <label>Imagen de Portada *</label>
                </div>
                <div class="image-upload-zone" id="imageUploadZone">
                    <div class="image-preview-container" id="imagePreviewContainer">
                        <img id="imagePreview" class="image-preview" alt="Vista previa">
                        <button type="button" class="image-remove" onclick="removeImage()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="image-upload-content">
                        <div class="upload-icon-image">
                            <i class="fas fa-image"></i>
                        </div>
                        <h3>Haz clic para subir la imagen de portada</h3>
                        <p>o arrastra y suelta aquí</p>
                        <p class="file-types">Formatos: JPG, PNG, WEBP (Max. 5MB)</p>
                    </div>
                    <input type="file" id="imageInput" accept="image/jpeg,image/png,image/webp">
                </div>
            </div>

            <!-- Zona de carga de archivos 3D -->
            <div class="form-section">
                <label>Archivos del Modelo 3D *</label>
            </div>
            <div class="upload-zone" id="uploadZone">
                <div class="upload-icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <h3>Arrastra y suelta tus archivos aquí</h3>
                <p>o haz clic para seleccionar</p>
                <p class="file-types">Formatos aceptados: .obj, .fbx, .stl, .blend, .gltf, .glb, .zip, .rar, .7z</p>
                <input type="file" id="fileInput" multiple accept=".obj,.fbx,.stl,.blend,.gltf,.glb,.zip,.rar,.7z">
            </div>

            <!-- Vista previa de archivos -->
            <div class="file-preview" id="filePreview"></div>

            <!-- Formulario de detalles -->
            <form id="uploadForm">
                <div class="form-section">
                    <label for="modelName">Nombre del Modelo *</label>
                    <input type="text" id="modelName" placeholder="Ej: Dragon Medieval" required>
                </div>

                <div class="form-section">
                    <label for="modelDescription">Descripción</label>
                    <textarea id="modelDescription" placeholder="Describe tu modelo, características, uso recomendado..."></textarea>
                </div>

                <div class="form-row">
                    <div class="form-section">
                        <label for="modelCategory">Categoría *</label>
                        <select id="modelCategory" required>
                            <option value="">Seleccionar categoría</option>
                            <option value="modelos3d">Modelos 3D</option>
                            <option value="impresion3d">Impresión 3D</option>
                            <option value="texturas">Texturas</option>
                            <option value="animaciones">Animaciones</option>
                        </select>
                    </div>

                    <div class="form-section">
                        <label for="modelPrice">Precio (€) *</label>
                        <input type="number" id="modelPrice" placeholder="0.00" step="0.01" min="0" required>
                    </div>
                </div>

                <div class="form-section">
                    <label for="modelTags">Etiquetas</label>
                    <div class="tags-container" id="tagsContainer">
                        <input type="text" id="tagInput" placeholder="Añade etiquetas y presiona Enter...">
                    </div>
                </div>

                <!-- Barra de progreso -->
                <div class="progress-container" id="progressContainer">
                    <div class="progress-bar">
                        <div class="progress-fill" id="progressFill"></div>
                    </div>
                    <p class="progress-text" id="progressText">Subiendo... 0%</p>
                </div>

                <!-- Botones -->
                <div class="button-group">
                    <button type="button" class="btn btn-secondary" onclick="cancelarSubida()">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-upload"></i> Publicar Modelo
                    </button>
                </div>
            </form>

            <!-- Mensaje de éxito -->
            <div class="success-message" id="successMessage">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3>¡Modelo publicado con éxito!</h3>
                <p>Tu modelo ha sido subido y está disponible en la galería</p>
            </div>
        </div>
    </main>

<script>
// Base de datos simulada de modelos
const modelosDisponibles = [
    { id: 1, nombre: "Dragon Legendario", precio: "29.99", imagen: "img/dragon1.jpg" },
    { id: 2, nombre: "Dragón Medieval", precio: "24.99", imagen: "img/dragon2.jpg" },
    { id: 3, nombre: "Espada Dragon", precio: "15.99", imagen: "img/espada.jpg" },
];

const uploadZone = document.getElementById('uploadZone');
const fileInput = document.getElementById('fileInput');
const filePreview = document.getElementById('filePreview');
const uploadForm = document.getElementById('uploadForm');
const progressContainer = document.getElementById('progressContainer');
const progressFill = document.getElementById('progressFill');
const progressText = document.getElementById('progressText');
const successMessage = document.getElementById('successMessage');
const submitBtn = document.getElementById('submitBtn');
const tagInput = document.getElementById('tagInput');
const tagsContainer = document.getElementById('tagsContainer');

// Variables para imagen de portada
const imageUploadZone = document.getElementById('imageUploadZone');
const imageInput = document.getElementById('imageInput');
const imagePreviewContainer = document.getElementById('imagePreviewContainer');
const imagePreview = document.getElementById('imagePreview');
let selectedImage = null;

let selectedFiles = [];
let tags = [];

// ========== IMAGEN DE PORTADA ==========
// Click en zona de carga de imagen
imageUploadZone.addEventListener('click', (e) => {
    if (!e.target.closest('.image-remove')) {
        imageInput.click();
    }
});

// Selección de imagen
imageInput.addEventListener('change', (e) => {
    handleImageFile(e.target.files[0]);
});

// Drag and drop para imagen
imageUploadZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    imageUploadZone.style.borderColor = '#a906a9';
    imageUploadZone.style.background = '#252529';
});

imageUploadZone.addEventListener('dragleave', (e) => {
    e.preventDefault();
    imageUploadZone.style.borderColor = '#6c63ff';
    imageUploadZone.style.background = '#18181b';
});

imageUploadZone.addEventListener('drop', (e) => {
    e.preventDefault();
    imageUploadZone.style.borderColor = '#6c63ff';
    imageUploadZone.style.background = '#18181b';
    
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        handleImageFile(file);
    }
});

// Manejar archivo de imagen
function handleImageFile(file) {
    if (!file) return;
    
    // Validar tipo de archivo
    const validTypes = ['image/jpeg', 'image/png', 'image/webp'];
    if (!validTypes.includes(file.type)) {
        alert('Por favor, selecciona una imagen válida (JPG, PNG o WEBP)');
        return;
    }
    
    // Validar tamaño (5MB máximo)
    if (file.size > 5 * 1024 * 1024) {
        alert('La imagen no debe superar los 5MB');
        return;
    }
    
    selectedImage = file;
    
    // Mostrar vista previa
    const reader = new FileReader();
    reader.onload = (e) => {
        imagePreview.src = e.target.result;
        imagePreviewContainer.classList.add('active');
        imageUploadZone.classList.add('has-image');
    };
    reader.readAsDataURL(file);
}

// Eliminar imagen
function removeImage() {
    selectedImage = null;
    imagePreview.src = '';
    imagePreviewContainer.classList.remove('active');
    imageUploadZone.classList.remove('has-image');
    imageInput.value = '';
}

// ========== ARCHIVOS 3D ==========
// Click en zona de carga
uploadZone.addEventListener('click', () => fileInput.click());

// Selección de archivos
fileInput.addEventListener('change', (e) => {
    handleFiles(e.target.files);
});

// Drag and drop
uploadZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadZone.classList.add('dragover');
});

uploadZone.addEventListener('dragleave', () => {
    uploadZone.classList.remove('dragover');
});

uploadZone.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadZone.classList.remove('dragover');
    handleFiles(e.dataTransfer.files);
});

// Manejar archivos
function handleFiles(files) {
    selectedFiles = Array.from(files);
    displayFiles();
}

// Mostrar archivos seleccionados
function displayFiles() {
    if (selectedFiles.length === 0) {
        filePreview.classList.remove('active');
        return;
    }

    filePreview.classList.add('active');
    filePreview.innerHTML = '';

    selectedFiles.forEach((file, index) => {
        const fileItem = document.createElement('div');
        fileItem.className = 'file-item';
        
        const icon = getFileIcon(file.name);
        const size = formatFileSize(file.size);

        fileItem.innerHTML = `
            <div class="file-icon">
                <i class="${icon}"></i>
            </div>
            <div class="file-info">
                <div class="file-name">${file.name}</div>
                <div class="file-size">${size}</div>
            </div>
            <button type="button" class="file-remove" onclick="removeFile(${index})">
                <i class="fas fa-times"></i>
            </button>
        `;

        filePreview.appendChild(fileItem);
    });
}

// Eliminar archivo
function removeFile(index) {
    selectedFiles.splice(index, 1);
    displayFiles();
}

// Obtener icono según extensión
function getFileIcon(filename) {
    const ext = filename.split('.').pop().toLowerCase();
    const icons = {
        'obj': 'fas fa-cube',
        'fbx': 'fas fa-cube',
        'stl': 'fas fa-cube',
        'blend': 'fas fa-cube',
        'gltf': 'fas fa-cube',
        'glb': 'fas fa-cube',
        'zip': 'fas fa-file-archive',
        'rar': 'fas fa-file-archive',
        '7z': 'fas fa-file-archive'
    };
    return icons[ext] || 'fas fa-file';
}

// Formatear tamaño de archivo
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
}

// ========== ETIQUETAS ==========
tagInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        e.preventDefault();
        const value = tagInput.value.trim();
        if (value && !tags.includes(value)) {
            tags.push(value);
            addTagElement(value);
            tagInput.value = '';
        }
    }
});

function addTagElement(tagText) {
    const tag = document.createElement('span');
    tag.className = 'tag';
    tag.innerHTML = `
        ${tagText}
        <span class="tag-remove" onclick="removeTag('${tagText}')">×</span>
    `;
    tagsContainer.insertBefore(tag, tagInput);
}

function removeTag(tagText) {
    tags = tags.filter(t => t !== tagText);
    const tagElements = tagsContainer.querySelectorAll('.tag');
    tagElements.forEach(el => {
        if (el.textContent.includes(tagText)) {
            el.remove();
        }
    });
}

// ========== ENVÍO DEL FORMULARIO ==========
uploadForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    // Validar imagen de portada
    if (!selectedImage) {
        alert('Por favor, selecciona una imagen de portada');
        return;
    }

    // Validar archivos del modelo
    if (selectedFiles.length === 0) {
        alert('Por favor, selecciona al menos un archivo del modelo');
        return;
    }

    submitBtn.disabled = true;
    progressContainer.classList.add('active');

    // Crear FormData
    const formData = new FormData();
    
    // Agregar imagen de portada
    formData.append('coverImage', selectedImage);
    
    // Agregar primer archivo (asumiendo que es el ZIP principal)
    formData.append('modelFiles', selectedFiles[0]);
    
    // Agregar datos del formulario
    formData.append('modelName', document.getElementById('modelName').value);
    formData.append('modelDescription', document.getElementById('modelDescription').value);
    formData.append('modelCategory', document.getElementById('modelCategory').value);
    formData.append('modelPrice', document.getElementById('modelPrice').value);
    formData.append('tags', JSON.stringify(tags));

    try {
        // Simular progreso mientras se sube
        let progress = 0;
        const progressInterval = setInterval(() => {
            progress += Math.random() * 10;
            if (progress >= 90) {
                clearInterval(progressInterval);
            }
            progressFill.style.width = progress + '%';
            progressText.textContent = `Subiendo... ${Math.round(progress)}%`;
        }, 300);

        // Enviar datos al servidor
        const response = await fetch('procesarModelo.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        
        clearInterval(progressInterval);
        progressFill.style.width = '100%';
        progressText.textContent = 'Subiendo... 100%';

        if (result.success) {
            setTimeout(() => {
                progressContainer.classList.remove('active');
                uploadForm.style.display = 'none';
                successMessage.classList.add('active');
                
                // Redirigir después de 3 segundos
                setTimeout(() => {
                    window.location.href = 'index.php';
                }, 3000);
            }, 500);
        } else {
            alert('Error: ' + result.message);
            submitBtn.disabled = false;
            progressContainer.classList.remove('active');
        }

    } catch (error) {
    console.error('Error completo:', error);
    
    // Intentar obtener el texto de respuesta
    const response = await fetch('procesarModelo.php', {
        method: 'POST',
        body: formData
    });
    
    const responseText = await response.text();
    console.log('Respuesta del servidor:', responseText);
    
    alert('Error al subir el modelo. Revisa la consola para más detalles.');
    submitBtn.disabled = false;
    progressContainer.classList.remove('active');
}
});


// ========== MENÚS ==========
function toggleMenu() {
    var menu = document.getElementById('mobileMenuItems');
    if (!menu.style.transition) {
        menu.style.transition = 'transform 0.3s ease, opacity 0.3s ease';
        menu.style.transform = 'translateX(100%)';
        menu.style.opacity = '0';
        menu.style.display = 'block';
    }
    if (menu.style.display === 'none' || menu.style.opacity === '0') {
        menu.style.display = 'block';
        setTimeout(function () {
            menu.style.transform = 'translateX(0%)';
            menu.style.opacity = '1';
            document.body.style.overflow = 'hidden';
        }, 10);
    } else {
        menu.style.transform = 'translateX(100%)';
        menu.style.opacity = '0';
        setTimeout(function () {
            menu.style.display = 'none';
            document.body.style.overflow = '';
        }, 300);
    }
}

function togglePerfil() {
    var menu = document.getElementById('perfilMenu');
    menu.classList.toggle('active');
}

// Cerrar menús al hacer clic fuera
document.addEventListener('click', function(event) {
    var perfilContainer = document.querySelector('.perfil-container');
    var perfilMenu = document.getElementById('perfilMenu');
    
    if (perfilContainer && !perfilContainer.contains(event.target)) {
        perfilMenu.classList.remove('active');
    }

    var buscadorContainer = document.querySelector('.buscador-container');
    var resultados = document.getElementById('resultadosBusqueda');
    
    if (buscadorContainer && !buscadorContainer.contains(event.target)) {
        resultados.classList.remove('active');
    }
});

// ========== BUSCADOR ==========
function buscarModelos() {
    const input = document.getElementById('buscadorInput').value.toLowerCase();
    const resultadosDiv = document.getElementById('resultadosBusqueda');
    
    if (input.trim() === '') {
        resultadosDiv.classList.remove('active');
        return;
    }

    const resultados = modelosDisponibles.filter(modelo => 
        modelo.nombre.toLowerCase().includes(input)
    ).slice(0, 3);

    if (resultados.length === 0) {
        resultadosDiv.innerHTML = '<div class="no-resultados">No se encontraron resultados</div>';
        resultadosDiv.classList.add('active');
        return;
    }

    let html = '';
    resultados.forEach(modelo => {
        html += `
            <div class="resultado-item" onclick="irAModelo(${modelo.id})">
                <img src="${modelo.imagen}" alt="${modelo.nombre}">
                <div class="resultado-info">
                    <div class="nombre">${modelo.nombre}</div>
                    <div class="precio">${modelo.precio} €</div>
                </div>
            </div>
        `;
    });

    resultadosDiv.innerHTML = html;
    resultadosDiv.classList.add('active');
}

function realizarBusqueda() {
    const input = document.getElementById('buscadorInput').value;
    if (input.trim() !== '') {
        window.location.href = 'busqueda.php?q=' + encodeURIComponent(input);
    }
}

function buscarEnter(event) {
    if (event.key === 'Enter') {
        realizarBusqueda();
    }
}

function irAModelo(id) {
    window.location.href = 'modelo.php?id=' + id;
}
</script>
</body>
</html>