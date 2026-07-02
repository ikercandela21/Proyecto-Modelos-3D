<?php
// index.php
require 'conexionbd.php'; // Tu archivo de conexión mysqli

$sql = "SELECT * FROM modelados WHERE tipo = 'texturas'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modelos 3D</title>
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
    background: #6c63ff;
}
.perfil-menu #cerrarSesion:hover {
    background-color: #ff4b5c;
}

.perfil-menu i {
    margin-right: 10px;
    width: 20px;
}

    /* ------------------Cards Section--------------------- */
    :root {
      --bg: #0f0f10;
      --card-bg: #18181b;
      --text: #eaeaea;
      --subtext: #a0a0a0;
      --accent: #6c63ff;
      --radius: 16px;
      --border: #2c2c2f;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    .card-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2rem;
      width: 100%;
      max-width: 1200px;
      padding: 60px 40px;
      margin: 0 auto;
    }

    .card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      overflow: hidden;
      transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
    }

    .card:hover {
      transform: translateY(-6px);
      border-color: var(--accent);
      box-shadow: 0 8px 20px rgba(108, 99, 255, 0.1);
    }

    .card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-bottom: 1px solid var(--border);
    }

    .card-content {
      padding: 1.3em 1em 0.8em;
      text-align: center;
    }

    .card h3 {
      font-size: 1.1em;
      margin: 10px 0 5px;
      color: var(--text);
      font-weight: 600;
    }

    .card p {
      font-size: 0.9em;
      color: var(--subtext);
      margin: 3px 0;
    }

    .price {
      font-weight: 500;
      color: var(--accent);
      margin-top: 8px;
    }

    /* --- Footer con iconos --- */
    .card-footer {
      display: flex;
      justify-content: space-around;
      align-items: center;
      border-top: 1px solid var(--border);
      padding: 0.8em 0;
      font-size: 0.9em;
      color: var(--subtext);
    }

    .icon-group {
      display: flex;
      align-items: center;
      gap: 6px;
      cursor: pointer;
      transition: color 0.2s ease;
    }

    .icon-group:hover {
      color: var(--accent);
    }

    .icon-group i {
      font-size: 1.1em;
    }

    .fav.active {
      color: #ff4b5c;
    }

    .no-models {
      grid-column: 1 / -1;
      text-align: center;
      padding: 40px;
      color: var(--text);
      font-size: 1.1em;
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

      .card-container {
        padding: 30px 20px;
        gap: 1.5rem;
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
    /* ------------------Título de Sección--------------------- */
    .page-title {
      text-align: center;
      padding: 40px 20px 20px;
      color: #eaeaea;
    }

    .page-title h2 {
      color: #eaeaea;
      background: linear-gradient(135deg, #6c63ff, #a906a9);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    .page-title i {
      margin-right: 10px;
      color: red;
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
                        <a href="favoritos.php">Favoritos</a>
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
                    <a href="favoritos.php"><i class="fas fa-heart"></i> Favoritos</a>
                    <a href="#"><i class="fas fa-shopping-bag"></i> Mis Compras</a>
                    <a href="#"><i class="fas fa-upload"></i> Subir Modelos</a>
                    <a href="#"><i class="fas fa-cog"></i> Configuración</a>
                    <a href="#" id="cerrarSesion"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                </div>
            </div>
        </div>

        <!-- Categorías y Buscador -->
        <div class="categorias-buscador">
            <div class="categorias">
                <a href="index.php" class="active">Todos</a>
                <a href="modelos.php">Modelos 3D</a>
                <a href="impresiones.php">Impresión 3D</a>
                <a href="texturas.php">Texturas</a>
                <a href="animaciones.php">Animaciones</a>
            </div>
            <div class="buscador-container">
                <input type="text" id="buscadorInput" placeholder="Buscar modelos...">
                <button class="btn-buscar">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </header>
  <main>
    <div class="page-title">
      <h2><i class="fas fa-image"></i>Texturas</h2>
    </div>
    <div class="card-container">
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while($modelo = $result->fetch_assoc()): ?>
          <a href="modelo.php?id=<?php echo htmlspecialchars($modelo['id']); ?>" class="card">
            <img src="<?php echo htmlspecialchars($modelo['imagen']); ?>" 
                 alt="<?php echo htmlspecialchars($modelo['nombre']); ?>">
            
            <div class="card-content">
              <h3><?php echo htmlspecialchars($modelo['nombre']); ?></h3>
              <?php if (!empty($modelo['precio'])): ?>
                <p class="price"><?php echo htmlspecialchars($modelo['precio']); ?>€</p>
              <?php endif; ?>
            </div>
            
            <div class="card-footer">
              <div class="icon-group fav">
                <i class="fa-regular fa-heart"></i>
                <span><?php echo htmlspecialchars($modelo['likes']); ?></span>
              </div>
              <div class="icon-group downloads">
                <i class="fa-solid fa-download"></i>
                <span><?php echo htmlspecialchars($modelo['num_descargas']); ?></span>
              </div>
            </div>
          </a>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="no-models">
          <p>No se encontraron modelos disponibles.</p>
        </div>
      <?php endif; ?>
    </div>

    <?php
    // Cerramos la conexión a la BD
    if ($result) $result->free();
    $conn->close();
    ?>
  </main>

  <script>
      // Base de datos simulada de modelos
      const modelosDisponibles = [
        { id: 1, nombre: "Dragon Legendario", precio: "29.99", imagen: "https://images.unsplash.com/photo-1551103782-8ab07afd45c1?w=100&h=100&fit=crop" },
        { id: 2, nombre: "Dragón Medieval", precio: "24.99", imagen: "https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=100&h=100&fit=crop" },
        { id: 3, nombre: "Espada Dragon", precio: "15.99", imagen: "https://images.unsplash.com/photo-1589254065878-42c9da997008?w=100&h=100&fit=crop" },
        { id: 4, nombre: "Casa Moderna", precio: "34.99", imagen: "https://images.unsplash.com/photo-1605146769289-440113cc3d00?w=100&h=100&fit=crop" },
        { id: 5, nombre: "Coche Deportivo", precio: "39.99", imagen: "https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=100&h=100&fit=crop" },
        { id: 6, nombre: "Robot Futurista", precio: "44.99", imagen: "https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=100&h=100&fit=crop" },
      ];

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

      // Cerrar menú de perfil al hacer clic fuera
      document.addEventListener('click', function (event) {
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

      function buscarModelos() {
        const input = document.getElementById('buscadorInput').value.toLowerCase();
        const resultadosDiv = document.getElementById('resultadosBusqueda');

        if (input.trim() === '') {
          resultadosDiv.classList.remove('active');
          return;
        }

        // Filtrar modelos que coincidan con la búsqueda
        const resultados = modelosDisponibles.filter(modelo =>
          modelo.nombre.toLowerCase().includes(input)
        ).slice(0, 3); // Máximo 3 resultados

        if (resultados.length === 0) {
          resultadosDiv.innerHTML = '<div class="no-resultados">No se encontraron resultados</div>';
          resultadosDiv.classList.add('active');
          return;
        }

        // Mostrar resultados
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
          alert('Buscando: ' + input);
          // Aquí iría la lógica para ir a la página de resultados
          // window.location.href = 'busqueda.php?q=' + encodeURIComponent(input);
        }
      }

      function buscarEnter(event) {
        if (event.key === 'Enter') {
          realizarBusqueda();
        }
      }

      function irAModelo(id) {
        alert('Ir al modelo ID: ' + id);
        // Aquí iría la lógica para ir a la página del modelo
        // window.location.href = 'modelo.php?id=' + id;
      }
    </script>
</body>

</html>