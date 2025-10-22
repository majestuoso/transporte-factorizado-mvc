<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel del Personal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('librerias/assets/neco.jpg') no-repeat center center fixed;
      background-size: cover;
      color: white;
      overflow: hidden;
    }

    .logout-top {
      position: absolute;
      top: 20px;
      right: 30px;
      z-index: 10;
    }

    .panel-contenido {
      padding: 80px 2rem 2rem 2rem;
      height: 100%;
      box-sizing: border-box;
    }

    .titulo h1 {
      font-size: 2.5rem;
      margin-bottom: 0.5rem;
      font-weight: bold;
    }

    .titulo p {
      font-size: 1.2rem;
      margin-bottom: 0.5rem;
    }

    .menu-columna {
      display: flex;
      flex-direction: row;
      gap: 2rem;
      height: calc(100% - 160px);
    }

    .menu-lateral {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .menu-box {
      width: 220px;
      background-color: rgba(255,255,255,0.9);
      border-radius: 10px;
      transition: transform 0.3s ease;
      position: relative;
      color: #333;
    }

    .menu-box:hover {
      transform: scale(1.03);
    }

    .menu-header {
      padding: 1rem;
      font-weight: bold;
      font-size: 1.2rem;
      text-align: center;
      background-color: #0d6efd;
      color: white;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      cursor: pointer;
    }

    .menu-content {
      position: absolute;
      top: 0;
      left: 100%;
      width: 200px;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 10px;
      display: none;
      flex-direction: column;
      padding: 1rem;
      z-index: 100;
    }

    .menu-content a {
      text-decoration: none;
      color: #0d6efd;
      margin-bottom: 0.5rem;
      font-weight: 500;
    }

    .menu-box.active .menu-content {
      display: flex;
    }

    .contenido-info {
      flex-grow: 1;
      padding: 2rem;
      background-color: rgba(255,255,255,0.1);
      border-radius: 10px;
      overflow-y: auto;
    }

    .volver-btn {
      margin-top: 2rem;
    }
  </style>
</head>
<body>
  <!-- 🔒 Botón de cerrar sesión -->
  <div class="logout-top">
    <a href="?path=logout" class="btn btn-outline-light btn-sm">🔒 Cerrar sesión</a>
  </div>

  <!-- 🧭 Contenido principal -->
  <div class="container-fluid panel-contenido">
    <div class="titulo text-center mb-4">
      <h1>Panel del Personal</h1>
      <p>Bienvenido, <strong>{$usuario}</strong>.</p>
      <p class="mt-3 text-white-50">Seleccioná una opción del menú para gestionar el sistema.</p>
    </div>

    <div class="menu-columna">
      <!-- 📦 Menú lateral -->
      <div class="menu-lateral">
        <!-- 🚚 Transportistas -->
        <div class="menu-box" onclick="toggleMenu(this)">
          <div class="menu-header">🚚 Transportistas</div>
          <div class="menu-content">
            <a href="?path=transportistas/listar">📋 Listar</a>
            <a href="?path=transportistas/agregar">➕ Agregar</a>
            <a href="?path=transportistas/modificar">✏️ Modificar</a>
            <a href="?path=transportistas/eliminar">🗑️ Eliminar</a>
          </div>
        </div>

        <!-- 🛣️ Rutas -->
        <div class="menu-box" onclick="toggleMenu(this)">
          <div class="menu-header">🛣️ Rutas</div>
          <div class="menu-content">
            <a href="?path=rutas/listar">📋 Listar</a>
            <a href="?path=rutas/agregar">➕ Agregar</a>
            <a href="?path=rutas/modificar">✏️ Modificar</a>
            <a href="?path=rutas/eliminar">🗑️ Eliminar</a>
          </div>
        </div>

        <!-- 🚌 Viajes -->
        <div class="menu-box" onclick="toggleMenu(this)">
          <div class="menu-header">🚌 Viajes</div>
          <div class="menu-content">
            <a href="?path=viajes/listar">📋 Listar</a>
            <a href="?path=viajes/agregar">➕ Agregar</a>
            <a href="?path=viajes/modificar">✏️ Modificar</a>
            <a href="?path=viajes/eliminar">🗑️ Eliminar</a>
          </div>
        </div>
      </div>

      <!-- 📄 Área de contenido lateral -->
      
        {if isset($subvista)}
          {include file=$subvista}
          <div class="volver-btn">
            <a href="index.php?path=panel_personal" class="btn btn-outline-light">🏠 Volver al Panel del Personal</a>
          </div>
        {/if}
      </div>
    </div>
  </div>

  <script>
    function toggleMenu(box) {
      document.querySelectorAll('.menu-box').forEach(el => {
        if (el !== box) el.classList.remove('active');
      });
      box.classList.toggle('active');
    }
  </script>
</body>
</html>
