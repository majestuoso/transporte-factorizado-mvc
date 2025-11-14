<?php
/* Smarty version 3.1.48, created on 2025-11-13 16:51:07
  from '/opt/lampp/htdocs/transporte/vista/registro.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6915fe6b708997_00454331',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '986342cce941bf9ce0024f236cdc5a503fca81de' => 
    array (
      0 => '/opt/lampp/htdocs/transporte/vista/registro.tpl',
      1 => 1763048857,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6915fe6b708997_00454331 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Usuario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      overflow: hidden;
    }

    .carousel-item img {
      object-fit: cover;
      height: 100vh;
      width: 100%;
      filter: brightness(0.4);
    }

    .overlay {
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: flex-start;
      padding: 2rem;
      z-index: 10;
    }

    .form-box {
      background-color: rgba(0, 0, 0, 0.6);
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 0 15px rgba(0,0,0,0.6);
      width: 100%;
      max-width: 400px;
      color: white;
    }

    .form-box h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      font-weight: bold;
      color: #f8f9fa;
    }

    .form-box label {
      font-weight: 500;
      margin-top: 1rem;
    }

    .form-box input {
      background-color: rgba(255,255,255,0.2);
      border: none;
      color: white;
    }

    .form-box input::placeholder {
      color: #ccc;
    }

    .form-box .btn {
      width: 100%;
      margin-top: 1.5rem;
    }

    .nav-tabs .nav-link {
      color: #fff;
    }
    .nav-tabs .nav-link.active {
      background-color: #0d6efd;
      border: none;
    }
  </style>
</head>
<body>

  <!-- 🎞️ Carrusel de fondo -->
  <div id="carouselRegistro" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="librerias/assets/joly.jpg" class="d-block w-100" alt="Joly">
      </div>
      <div class="carousel-item">
        <img src="librerias/assets/chule.jpg" class="d-block w-100" alt="Chule">
      </div>
      <div class="carousel-item">
        <img src="librerias/assets/anto.jpg" class="d-block w-100" alt="Anto">
      </div>
    </div>
  </div>

  <!-- 🧾 Panel de registro lateral -->
  <div class="overlay">
    <div class="form-box">
      <h2>📝 Registro</h2>

      <!-- Tabs -->
      <ul class="nav nav-tabs" id="registroTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab">Personal</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="transportista-tab" data-bs-toggle="tab" data-bs-target="#transportista" type="button" role="tab">Transportista</button>
        </li>
      </ul>

      <!-- Contenido de pestañas -->
      <div class="tab-content mt-3">
        <!-- Formulario Personal -->
        <div class="tab-pane fade show active" id="personal" role="tabpanel">
          <form method="post" action="?path=registro_personal">
            <label for="usuario_personal">👤 Usuario</label>
            <input type="text" name="usuario" id="usuario_personal" class="form-control" placeholder="Usuario personal" required>

            <label for="clave_personal">🔒 Clave</label>
            <input type="password" name="clave" id="clave_personal" class="form-control" placeholder="Contraseña" required>

            <label for="nombre_personal">📛 Nombre</label>
            <input type="text" name="nombre" id="nombre_personal" class="form-control" placeholder="Nombre" required>

            <button type="submit" class="btn btn-primary">✅ Registrar Personal</button>
          </form>
        </div>

        <!-- Formulario Transportista -->
        <div class="tab-pane fade" id="transportista" role="tabpanel">
          <form method="post" action="?path=registro_transportista">
            <label for="usuario_trans">👤 Usuario</label>
            <input type="text" name="usuario" id="usuario_trans" class="form-control" placeholder="Usuario transportista" required>

            <label for="clave_trans">🔒 Clave</label>
            <input type="password" name="clave" id="clave_trans" class="form-control" placeholder="Contraseña" required>

            <label for="nombre_trans">📛 Nombre</label>
            <input type="text" name="nombre" id="nombre_trans" class="form-control" placeholder="Nombre" required>

            <label for="apellido_trans">📛 Apellido</label>
            <input type="text" name="apellido" id="apellido_trans" class="form-control" placeholder="Apellido" required>

            <label for="vehiculo_trans">🚚 Vehículo</label>
            <input type="text" name="vehiculo" id="vehiculo_trans" class="form-control" placeholder="Ej: Volvo FH" required>

            <label for="nota_trans">📝 Nota</label>
            <input type="text" name="nota" id="nota_trans" class="form-control" placeholder="Observaciones">

            <button type="submit" class="btn btn-success">✅ Registrar Transportista</button>
          </form>
        </div>
      </div>

      <!-- Botón volver -->
      <a href="?path=inicio" class="btn btn-outline-light mt-3">🔙 Volver</a>
    </div>
  </div>

  <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
