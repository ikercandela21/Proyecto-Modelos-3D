<?php
// Configuración de la base de datos
require 'conexionbd.php';

// Establecer charset para evitar problemas con caracteres especiales
$conn->set_charset("utf8mb4");

// Obtener el ID del modelo desde la URL
$modelo_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Si no hay ID válido, redirigir o mostrar error
if ($modelo_id <= 0) {
    die("ID de modelo no válido");
}

// Consultar el modelo en la base de datos
$sql = "SELECT * FROM modelados WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $modelo_id);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si el modelo existe
if ($result->num_rows == 0) {
    die("Modelo no encontrado");
}

// Obtener los datos del modelo
$modelo = $result->fetch_assoc();

// Cerrar la consulta
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($modelo['nombre']); ?> - Modelo 3D</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
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
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .categorias {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            align-items: center;
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
            background-color: #580358;
            color: white;
        }

        .categorias a.active {
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

        .resultados-busqueda {
            position: absolute;
            top: calc(100% + 5px);
            left: 0;
            right: 0;
            background: #242424;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            max-height: 250px;
            overflow-y: auto;
            z-index: 1000;
            display: none;
        }

        .resultados-busqueda.active {
            display: block;
        }

        .resultado-item {
            padding: 12px 16px;
            border-bottom: 1px solid #333;
            cursor: pointer;
            transition: background 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .resultado-item:last-child {
            border-bottom: none;
        }

        .resultado-item:hover {
            background: #580358;
        }

        .resultado-item img {
            width: 40px;
            height: 40px;
            border-radius: 5px;
            object-fit: cover;
        }

        .resultado-info {
            flex: 1;
        }

        .resultado-info .nombre {
            color: white;
            font-weight: 500;
            font-size: 0.95em;
        }

        .resultado-info .precio {
            color: #6c63ff;
            font-size: 0.85em;
        }

        .no-resultados {
            padding: 20px;
            text-align: center;
            color: #888;
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

        .perfil-menu i {
            margin-right: 10px;
            width: 20px;
        }

        /*------------------End Header--------------------- */
        /* ------------------Main Content--------------------- */
        main {
            padding: 2em;
            max-width: 1400px;
            margin: 0 auto;
        }

        .selector-vista {
            text-align: center;
            margin-bottom: 2em;
        }

        .selector-vista button {
            background: #580358;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .selector-vista button:hover {
            background: #a906a9;
        }

        .selector-vista button.active {
            background: #a906a9;
        }

        /* ------------------Vista Vertical (Como el ejemplo)--------------------- */
        .container-vertical {
            max-width: 800px;
            background: #18181b;
            border-radius: 16px;
            padding: 30px;
            border: 1px solid #2c2c2f;
            margin: 0 auto;
        }

        .container-vertical img {
            width: 100%;
            border-radius: 12px;
            margin-bottom: 20px;
            object-fit: cover;
            max-height: 500px;
            background: #252529;
        }

        .container-vertical h2 {
            margin-bottom: 10px;
            font-size: 2em;
            color: white;
        }

        .container-vertical p {
            color: #aaa;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .container-vertical h3 {
            color: #6c63ff;
            font-size: 1.8em;
            margin-top: 20px;
        }

        .info-vertical {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #888;
            flex-wrap: wrap;
            gap: 10px;
        }

        .info-vertical div {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .info-vertical i {
            color: #6c63ff;
        }

        /* ------------------Vista Horizontal (Imagen izquierda, info derecha)--------------------- */
        .container-horizontal {
            background: #18181b;
            border-radius: 16px;
            padding: 30px;
            border: 1px solid #2c2c2f;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            align-items: start;
        }

        .imagen-seccion {
            width: 100%;
        }

        .imagen-seccion img {
            width: 100%;
            border-radius: 12px;
            object-fit: cover;
            max-height: 600px;
            background: #252529;
        }

        .info-seccion h2 {
            margin-bottom: 15px;
            font-size: 2em;
            color: white;
        }

        .info-seccion p {
            color: #aaa;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .info-seccion h3 {
            color: #6c63ff;
            font-size: 1.8em;
            margin-bottom: 20px;
        }

        .estadisticas {
            display: flex;
            gap: 30px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .estadisticas div {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #888;
        }

        .estadisticas i {
            color: #6c63ff;
            font-size: 1.2em;
        }

        /* ------------------Botones--------------------- */
        .download-btn {
            display: inline-block;
            background: #6c63ff;
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            text-decoration: none;
            margin-top: 25px;
            transition: background 0.3s;
            font-weight: 500;
            border: none;
            cursor: pointer;
            width: 100%;
            text-align: center;
        }

        .download-btn:hover {
            background: #5851db;
        }

        .favorito-btn {
            background: #242424;
            color: white;
            border: 2px solid #6c63ff;
            padding: 12px 24px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            width: 100%;
            font-weight: 500;
        }

        .favorito-btn:hover {
            background: #6c63ff;
        }

        .vista {
            display: none;
        }

        .vista.active {
            display: block;
        }

        .container-horizontal.active {
            display: grid;
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
            .container-horizontal {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .estadisticas {
                gap: 15px;
            }

            main {
                padding: 1em;
            }

            .selector-vista button {
                padding: 8px 15px;
                margin: 5px;
                font-size: 0.9em;
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
                        <a href="#">Contactanos</a>
                        <a href="#">Favoritos</a>
                        <a href="#">Mis compras</a>
                        <a href="#">Insertar Modelos</a>
                        <a href="#">Cerrar Sesión</a>
                        <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                    </div>
                    <div class="usuario">
                        <a href="#"><i class="fas fa-user"></i> <span>Usuario</span></a>
                    </div>
                </div>
            </div>

            <!-- Perfil desplegable (escritorio) -->
            <div class="perfil-container">
                <img src="https://i.pravatar.cc/150?img=12" alt="Perfil" class="perfil-img" onclick="togglePerfil()">
                <div class="perfil-menu" id="perfilMenu">
                    <a href="#"><i class="fas fa-user"></i> Mi Perfil</a>
                    <a href="#"><i class="fas fa-heart"></i> Favoritos</a>
                    <a href="#"><i class="fas fa-shopping-bag"></i> Mis Compras</a>
                    <a href="#"><i class="fas fa-cog"></i> Configuración</a>
                    <a href="#"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                </div>
            </div>
        </div>

        <!-- Categorías y Buscador -->
        <div class="categorias-buscador" style="justify-content:center;align-items:center;gap:20px;">
            <div class="categorias" style="justify-content:center;">
                <a href="index.php" class="active">Todos</a>
                <a href="#">Modelos 3D</a>
                <a href="#">Impresión 3D</a>
                <a href="#">Texturas</a>
                <a href="#">Animaciones</a>
            </div>
            <div class="buscador-container" style="margin-left:0;">
                <input type="text" id="buscadorInput" placeholder="Buscar modelos...">
                <button class="btn-buscar">
                    <i class="fas fa-search"></i>
                </button>
                <div class="resultados-busqueda" id="resultadosBusqueda"></div>
            </div>
        </div>
    </header>

    <main>
        <!-- Selector de vista -->
        <div class="selector-vista">
            <button class="active" onclick="cambiarVista('vertical')">Vista Vertical</button>
            <button onclick="cambiarVista('horizontal')">Vista Horizontal</button>
        </div>

        <!-- Vista Vertical -->
        <div id="vista-vertical" class="vista active">
            <div class="container-vertical">
                <img src="<?php echo htmlspecialchars($modelo['imagen']); ?>" alt="<?php echo htmlspecialchars($modelo['nombre']); ?>">
                <h2><?php echo htmlspecialchars($modelo['nombre']); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($modelo['descripcion'])); ?></p>
                <?php if (floatval($modelo['precio']) != 0): ?>
                    <h3><?php echo number_format($modelo['precio'], 2); ?> €</h3>
                <?php endif; ?>
                <div class="info-vertical">
                    <div><i class="fa-solid fa-heart"></i> <?php echo number_format($modelo['likes']); ?> Favoritos</div>
                    <div><i class="fa-solid fa-download"></i> <?php echo number_format($modelo['num_descargas']); ?> Descargas</div>
                </div>
                <button class="favorito-btn" onclick="agregarFavorito(<?php echo $modelo['id']; ?>)">
                    <i class="fa-solid fa-heart"></i> Añadir a Favoritos
                </button>
                <a href="<?php echo htmlspecialchars($modelo['contenido']); ?>" class="download-btn" download>Descargar</a>
            </div>
        </div>

        <!-- Vista Horizontal -->
        <div id="vista-horizontal" class="vista container-horizontal">
            <div class="imagen-seccion">
                <img src="<?php echo htmlspecialchars($modelo['imagen']); ?>" alt="<?php echo htmlspecialchars($modelo['nombre']); ?>">
            </div>
            <div class="info-seccion">
                <h2><?php echo htmlspecialchars($modelo['nombre']); ?></h2>
                <?php if (floatval($modelo['precio']) != 0): ?>
                    <h3><?php echo number_format($modelo['precio'], 2); ?> €</h3>
                <?php endif; ?>
                <p><?php echo nl2br(htmlspecialchars($modelo['descripcion'])); ?></p>

                <div class="estadisticas">
                    <div><i class="fa-solid fa-heart"></i> <strong><?php echo number_format($modelo['likes']); ?></strong> Favoritos</div>
                    <div><i class="fa-solid fa-download"></i> <strong><?php echo number_format($modelo['num_descargas']); ?></strong> Descargas</div>
                </div>

                <button class="favorito-btn" onclick="agregarFavorito(<?php echo $modelo['id']; ?>)">
                    <i class="fa-solid fa-heart"></i> Añadir a Favoritos
                </button>
                <a href="descargar.php?id=<?= $modelo['id'] ?>" class="download-btn" target="_blank">
                    <i class="fas fa-download"></i> Descargar Modelo
                </a>

            </div>
        </div>
    </main>

    <script>
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
                setTimeout(function() {
                    menu.style.transform = 'translateX(0%)';
                    menu.style.opacity = '1';
                    document.body.style.overflow = 'hidden';
                }, 10);
            } else {
                menu.style.transform = 'translateX(100%)';
                menu.style.opacity = '0';
                setTimeout(function() {
                    menu.style.display = 'none';
                    document.body.style.overflow = '';
                }, 300);
            }
        }

        function cambiarVista(vista) {
            document.querySelectorAll('.vista').forEach(v => v.classList.remove('active'));

            if (vista === 'vertical') {
                document.getElementById('vista-vertical').classList.add('active');
            } else {
                document.getElementById('vista-horizontal').classList.add('active');
            }

            document.querySelectorAll('.selector-vista button').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
        }

        function togglePerfil() {
            var menu = document.getElementById('perfilMenu');
            menu.classList.toggle('active');
        }

        // Cerrar menú de perfil al hacer clic fuera
        document.addEventListener('click', function(event) {
            var perfilContainer = document.querySelector('.perfil-container');
            var perfilMenu = document.getElementById('perfilMenu');

            if (perfilContainer && !perfilContainer.contains(event.target)) {
                perfilMenu.classList.remove('active');
            }

            // Cerrar resultados de búsqueda al hacer clic fuera
            var buscadorContainer = document.querySelector('.buscador-container');
            var resultados = document.getElementById('resultadosBusqueda');

            if (buscadorContainer && !buscadorContainer.contains(event.target)) {
                resultados.classList.remove('active');
            }
        });

        function agregarFavorito(modeloId) {
            // Aquí puedes implementar la lógica para agregar a favoritos
            // Por ejemplo, hacer una petición AJAX
            alert('Modelo agregado a favoritos (ID: ' + modeloId + ')');

            // Ejemplo de implementación con fetch:
            /*
            fetch('agregar_favorito.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ modelo_id: modeloId })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alert('¡Agregado a favoritos!');
                }
            });
            */
        }
    </script>
</body>

</html>