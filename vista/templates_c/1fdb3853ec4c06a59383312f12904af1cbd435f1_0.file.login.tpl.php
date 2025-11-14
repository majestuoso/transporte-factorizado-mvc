<?php
/* Smarty version 3.1.48, created on 2025-11-13 18:02:56
  from '/opt/lampp/htdocs/transporte/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_69160f405b8919_92122333',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1fdb3853ec4c06a59383312f12904af1cbd435f1' => 
    array (
      0 => '/opt/lampp/htdocs/transporte/login.tpl',
      1 => 1763053305,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69160f405b8919_92122333 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
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
          <label class="form-label">Nombre</label>
          <input type="text" name="nombre" class="form-control" required>
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
          <label class="form-label">Nombre</label>
          <input type="text" name="nombre" class="form-control" required>
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

  <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
>
    function mostrarFormulario() {
      const tipo = document.getElementById('tipoIngreso').value;
      document.getElementById('formPersonal').style.display = tipo === 'personal' ? 'block' : 'none';
      document.getElementById('formTransportista').style.display = tipo === 'transportista' ? 'block' : 'none';
    }
  <?php echo '</script'; ?>
>
</body>
</html><?php }
}
