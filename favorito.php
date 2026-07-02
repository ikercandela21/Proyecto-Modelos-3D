<?php
// favoritos.php
require 'conexionbd.php'; // Tu archivo de conexión mysqli

// Consulta para obtener los modelos favoritos
// Asumiendo que la tabla favoritos tiene: id_usuario, id_modelo
// y necesitamos hacer JOIN con la tabla modelados
$sql = "SELECT modelados.id, modelados.nombre, modelados.descripcion, modelados.imagen, modelados.precio, modelados.likes, modelados.num_descargas, favoritos.id AS id_favorito
        FROM favoritos
        INNER JOIN modelados ON favoritos.id_modelo = modelados.id
        WHERE favoritos.id_usuario = 1  
       /* ORDER BY favoritos.fecha_agregado DESC*/";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mis Favoritos - Modelos 3D</title>
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

    /* ------------------Título de Sección--------------------- */
    .page-title {
      text-align: center;
      padding: 40px 20px 20px;
      color: #eaeaea;
    }

    .page-title h2 {
      font-size: 2.5em;
      margin-bottom: 10px;
      background: linear-gradient(135deg, #6c63ff, #a906a9);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .page-title p {
      color: #a0a0a0;
      font-size: 1.1em;
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
      padding: 20px 40px 60px;
      margin: 0 auto;
    }

    .card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      overflow: hidden;
      transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
      position: relative;
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

    /* Botón eliminar favorito */
    .btn-eliminar {
      position: absolute;
      top: 10px;
      right: 10px;
      background: rgba(255, 75, 92, 0.9);
      color: white;
      border: none;
      border-radius: 50%;
      width: 35px;
      height: 35px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s ease;
      z-index: 10;
    }

    .btn-eliminar:hover {
      background: #ff4b5c;
      transform: scale(1.1);
    }

    .no-models {
      grid-column: 1 / -1;
      text-align: center;
      padding: 60px 40px;
      color: var(--text);
    }

    .no-models i {
      font-size: 4em;
      color: var(--subtext);
      margin-bottom: 20px;
    }

    .no-models h3 {
      font-size: 1.5em;
      margin-bottom: 10px;
    }

    .no-models p {
      color: var(--subtext);
      font-size: 1.1em;
      margin-bottom: 20px;
    }

    .btn-explorar {
      display: inline-block;
      padding: 12px 30px;
      background: var(--accent);
      color: white;
      border-radius: 25px;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-explorar:hover {
      background: #a906a9;
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(108, 99, 255, 0.3);
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

      .page-title h2 {
        font-size: 2em;
      }

      .card-container {
        padding: 20px 20px 30px;
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
                <a href="index.php">Todos</a>
                <a href="#">Modelos 3D</a>
                <a href="#">Impresión 3D</a>
                <a href="#">Texturas</a>
                <a href="#">Animaciones</a>
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
      <h2><i class="fas fa-heart"></i> Mis Favoritos</h2>
      <p>Tus modelos 3D guardados</p>
    </div>

    <div class="card-container">
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while($modelo = $result->fetch_assoc()): ?>
          <div class="card">
            <button class="btn-eliminar" onclick="eliminarFavorito(<?php echo htmlspecialchars($modelo['id_favorito']); ?>, this)">
              <i class="fas fa-times"></i>
            </button>
            
            <a href="modelo.php?id=<?php echo htmlspecialchars($modelo['id']); ?>">
              <img src="<?php echo htmlspecialchars($modelo['imagen']); ?>" 
                   alt="<?php echo htmlspecialchars($modelo['nombre']); ?>">
              
              <div class="card-content">
                <h3><?php echo htmlspecialchars($modelo['nombre']); ?></h3>
                <p><?php echo htmlspecialchars($modelo['descripcion']); ?></p>
                
                <?php if (!empty($modelo['precio'])): ?>
                  <p class="price"><?php echo htmlspecialchars($modelo['precio']); ?>€</p>
                <?php endif; ?>
              </div>
              
              <div class="card-footer">
                <div class="icon-group fav active">
                  <i class="fa-solid fa-heart"></i>
                  <span><?php echo htmlspecialchars($modelo['likes']); ?></span>
                </div>
                <div class="icon-group downloads">
                  <i class="fa-solid fa-download"></i>
                  <span><?php echo htmlspecialchars($modelo['num_descargas']); ?></span>
                </div>
              </div>
            </a>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="no-models">
          <i class="fas fa-heart-broken"></i>
          <h3>No tienes favoritos aún</h3>
          <p>Empieza a guardar tus modelos 3D favoritos para verlos aquí</p>
          <a href="index.php" class="btn-explorar">Explorar Modelos</a>
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
      });

      // Función para eliminar favorito
      function eliminarFavorito(idFavorito, btn) {
        if (confirm('¿Estás seguro de que quieres eliminar este modelo de tus favoritos?')) {
          // Hacer petición AJAX para eliminar
          fetch('eliminar_favorito.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'id_favorito=' + idFavorito
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              // Eliminar la card con animación
              const card = btn.closest('.card');
              card.style.transition = 'all 0.3s ease';
              card.style.opacity = '0';
              card.style.transform = 'scale(0.8)';
              
              setTimeout(() => {
                card.remove();
                
                // Si no quedan más cards, recargar la página para mostrar el mensaje de "sin favoritos"
                const cardsRestantes = document.querySelectorAll('.card').length;
                if (cardsRestantes === 0) {
                  location.reload();
                }
              }, 300);
            } else {
              alert('Error al eliminar el favorito. Inténtalo de nuevo.');
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('Error al eliminar el favorito.');
          });
        }
      }
    </script>
</body>

</html>