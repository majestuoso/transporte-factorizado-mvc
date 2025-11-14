<?php
declare(strict_types=1);

// Mostrar errores, pero ocultar los deprecados (ideal para Smarty 3.1.x en PHP 8.2+)
ini_set('display_errors', '1');
error_reporting(E_ALL & ~E_DEPRECATED);

require_once(__DIR__ . '/db/DB.php');
require_once(__DIR__ . '/db/load.php');
ob_start();
(new Load())->load();
ob_end_clean();

require_once(__DIR__ . '/librerias/Router.php'); 
require_once(__DIR__ . '/controlador/TransportistaController.php');
require_once(__DIR__ . '/controlador/RutaController.php');
require_once(__DIR__ . '/controlador/ViajeController.php');
require_once(__DIR__ . '/controlador/LoginController.php');
require_once(__DIR__ . '/controlador/PanelController.php');
require_once(__DIR__ . '/controlador/RegistroPersonalController.php');
require_once(__DIR__ . '/controlador/RegistroTransportistaController.php');

$router = new Router();

// ---------------- TRANSPORTISTAS ----------------
$router->add('transportistas/listar', 'TransportistaController', 'listar');
$router->add('transportistas/agregar', 'TransportistaController', 'agregar');
// 👇 nueva ruta para mostrar formulario de edición
$router->add('transportistas/editar', 'TransportistaController', 'editar');
// 👇 ruta para procesar el POST y guardar cambios
$router->add('transportistas/modificar', 'TransportistaController', 'modificar');
$router->add('transportistas/eliminar', 'TransportistaController', 'eliminar');
$router->add('transportistas/editar', 'TransportistaController', 'editar');   // GET → mostrar formulario
$router->add('transportistas/modificar', 'TransportistaController', 'modificar'); // POST → guardar cambios

// ---------------- RUTAS ----------------
$router->add('rutas/listar', 'RutaController', 'listar');
$router->add('rutas/agregar', 'RutaController', 'agregar');
$router->add('rutas/modificar', 'RutaController', 'modificar');
$router->add('rutas/eliminar', 'RutaController', 'eliminar');

// ---------------- VIAJES ----------------
$router->add('viajes/listar', 'ViajeController', 'listar');
$router->add('viajes/agregar', 'ViajeController', 'agregar');
$router->add('viajes/modificar', 'ViajeController', 'modificar');
$router->add('viajes/eliminar', 'ViajeController', 'eliminar');

// ---------------- LOGIN ----------------
$router->add('login_personal', 'LoginController', 'loginPersonal');
$router->add('login_transportista', 'LoginController', 'loginTransportista');
$router->add('logout', 'LoginController', 'logout');

// ---------------- PANELES ----------------
$router->add('panel_personal', 'PanelController', 'personal');
$router->add('panel_transportista', 'PanelController', 'transportista');

// ---------------- REGISTRO ----------------
$router->add('registro_personal', 'RegistroPersonalController', 'registrar');
$router->add('registro_transportista', 'RegistroTransportistaController', 'registrar');

// ---------------- PÁGINAS ESTÁTICAS ----------------
$router->add('servicios', 'PanelController', 'servicios');
$router->add('nosotros', 'PanelController', 'nosotros');
$router->add('noticias', 'PanelController', 'noticias');
$router->add('contacto', 'PanelController', 'contacto');

// ---------------- DESPACHO ----------------
$uri = $_GET['path'] ?? 'inicio';

if ($uri === 'inicio') {
    echo <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Transporte</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div id="carouselFondo" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="librerias/assets/camion.jpg" alt="Camión">
      </div>
      <div class="carousel-item">
        <img src="librerias/assets/fotos.jpg" alt="Fotos">
      </div>
      <div class="carousel-item">
        <img src="librerias/assets/neco.jpg" alt="Transporte">
      </div>
    </div>
  </div>

  <div class="overlay">
    <div class="titulo">
      <h1>Gestión de Transporte</h1>
      <p>Sistema de gestión de viajes, turnos y choferes.</p>
    </div>

    <div class="panel">
      <h2>Ingreso al sistema</h2>

      <label class="form-label">Tipo de ingreso</label>
      <select id="tipoIngreso" class="form-select mb-3" onchange="mostrarFormulario()">
        <option value="">Seleccionar...</option>
        <option value="personal">Personal</option>
        <option value="transportista">Transportista</option>
      </select>

      <!-- Login Personal -->
      <form id="formPersonal" method="POST" action="?path=login_personal" style="display:none;">
        <div class="mb-3">
          <label class="form-label">Usuario</label>
          <input type="text" name="usuario" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Contraseña</label>
          <input type="password" name="clave" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Ingresar como Personal</button>
      </form>

      <!-- Login Transportista -->
      <form id="formTransportista" method="POST" action="?path=login_transportista" style="display:none;">
        <div class="mb-3">
          <label class="form-label">Usuario</label>
          <input type="text" name="usuario" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Contraseña</label>
          <input type="password" name="clave" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Ingresar como Transportista</button>
      </form>

      <div class="text-center mb-3">
        <a href="?path=registro_personal" class="btn btn-outline-primary btn-sm">📝 Registrar Personal</a>
        <a href="?path=registro_transportista" class="btn btn-outline-success btn-sm">📝 Registrar Transportista</a>
      </div>

      <hr>
      <div class="nav-links">
        <a href="?path=servicios">Servicios</a>
        <a href="?path=nosotros">Quiénes somos</a>
        <a href="?path=noticias">Noticias</a>
        <a href="?path=contacto">Contáctanos</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function mostrarFormulario() {
      const tipo = document.getElementById('tipoIngreso').value;
      document.getElementById('formPersonal').style.display = tipo === 'personal' ? 'block' : 'none';
      document.getElementById('formTransportista').style.display = tipo === 'transportista' ? 'block' : 'none';
    }
  </script>
</body>
</html>
HTML;
} else {
    $router->dispatch($uri);
}
