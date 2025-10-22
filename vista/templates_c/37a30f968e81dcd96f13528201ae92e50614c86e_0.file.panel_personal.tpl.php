<?php
/* Smarty version 3.1.48, created on 2025-10-22 18:01:55
  from '/opt/lampp/htdocs/transporte_refactorizado/vista/panel_personal.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_68f8fff398d8f7_95439106',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '37a30f968e81dcd96f13528201ae92e50614c86e' => 
    array (
      0 => '/opt/lampp/htdocs/transporte_refactorizado/vista/panel_personal.tpl',
      1 => 1761148913,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68f8fff398d8f7_95439106 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
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
      <p>Bienvenido, <strong><?php echo $_smarty_tpl->tpl_vars['usuario']->value;?>
</strong>.</p>
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
      
        <?php if ((isset($_smarty_tpl->tpl_vars['subvista']->value))) {?>
          <?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['subvista']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
          <div class="volver-btn">
            <a href="index.php?path=panel_personal" class="btn btn-outline-light">🏠 Volver al Panel del Personal</a>
          </div>
        <?php }?>
      </div>
    </div>
  </div>

  <?php echo '<script'; ?>
>
    function toggleMenu(box) {
      document.querySelectorAll('.menu-box').forEach(el => {
        if (el !== box) el.classList.remove('active');
      });
      box.classList.toggle('active');
    }
  <?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
