<?php
declare(strict_types=1);

ini_set('display_errors', '1');
error_reporting(E_ALL);

// Carga inicial silenciosa
require_once(__DIR__ . '/db/DB.php');
require_once(__DIR__ . '/db/load.php');
ob_start();
(new Load())->load();
ob_end_clean();

// Cargar Router y controladores
require_once(__DIR__ . '/librerias/Router.php'); 
require_once(__DIR__ . '/controlador/TransportistaController.php');
require_once(__DIR__ . '/controlador/RutaController.php');
require_once(__DIR__ . '/controlador/ViajeController.php');

// Crear instancia del router
$router = new Router();

// Registrar rutas
$router->add('transportistas/listar', 'TransportistaController', 'listar');
$router->add('transportistas/agregar', 'TransportistaController', 'agregar');
$router->add('transportistas/modificar', 'TransportistaController', 'modificar');
$router->add('transportistas/eliminar', 'TransportistaController', 'eliminar');

$router->add('rutas/listar', 'RutaController', 'listar');
$router->add('rutas/agregar', 'RutaController', 'agregar');
$router->add('rutas/modificar', 'RutaController', 'modificar');
$router->add('rutas/eliminar', 'RutaController', 'eliminar');

$router->add('viajes/listar', 'ViajeController', 'listar');
$router->add('viajes/agregar', 'ViajeController', 'agregar');
$router->add('viajes/modificar', 'ViajeController', 'modificar');
$router->add('viajes/eliminar', 'ViajeController', 'eliminar');

// Obtener URI
$uri = $_GET['path'] ?? 'inicio';

// Si es inicio, mostrar menú
if ($uri === 'inicio') {
    echo <<<HTML
<h1>Sistema de Gestión de Transporte</h1>

<h2>🧍 Transportistas</h2>
<ul>
  <li><a href="?path=transportistas/listar">📋 Listar</a></li>
  <li><a href="?path=transportistas/agregar">➕ Agregar</a></li>
  <li><a href="?path=transportistas/modificar">✏️ Modificar</a></li>
  <li><a href="?path=transportistas/eliminar">🗑️ Eliminar</a></li>
</ul>

<h2>🛣️ Rutas</h2>
<ul>
  <li><a href="?path=rutas/listar">📋 Listar</a></li>
  <li><a href="?path=rutas/agregar">➕ Agregar</a></li>
  <li><a href="?path=rutas/modificar">✏️ Modificar</a></li>
  <li><a href="?path=rutas/eliminar">🗑️ Eliminar</a></li>
</ul>

<h2>🚚 Viajes</h2>
<ul>
  <li><a href="?path=viajes/listar">📋 Listar</a></li>
  <li><a href="?path=viajes/agregar">➕ Agregar</a></li>
  <li><a href="?path=viajes/modificar">✏️ Modificar</a></li>
  <li><a href="?path=viajes/eliminar">🗑️ Eliminar</a></li>
</ul>
HTML;
} else {
    // Despachar la ruta
    $router->dispatch($uri);
}
