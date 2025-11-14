<?php
/* Smarty version 3.1.48, created on 2025-11-13 21:22:05
  from '/opt/lampp/htdocs/transporte/vista/transportista/agregar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_69163ded9480f6_33913803',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd4e7f208188efbfebf7a895c72a51fbea4dee5e7' => 
    array (
      0 => '/opt/lampp/htdocs/transporte/vista/transportista/agregar.tpl',
      1 => 1763065322,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69163ded9480f6_33913803 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Transportista</title>
  <style>
    body { font-family: 'Segoe UI', sans-serif; background: #e3f2fd; padding: 40px; text-align: center; }
    h2 { color: #0d47a1; margin-bottom: 30px; }
    .formulario {
      max-width: 600px; margin: auto; background: #fff; padding: 30px;
      border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); text-align: left;
    }
    label { display: block; margin-top: 15px; font-weight: bold; }
    input, select {
      width: 100%; padding: 10px; margin-top: 5px;
      border-radius: 8px; border: 1px solid #ccc; font-size: 16px;
    }
    button {
      margin-top: 20px; background-color: #0d47a1; color: white;
      padding: 12px 24px; border: none; border-radius: 8px; font-size: 16px; cursor: pointer;
    }
    button:hover { background-color: #08306b; }
    .volver { margin-top: 40px; text-align: center; }
    .btn-volver {
      background-color: #00796b; color: white;
      padding: 12px 24px; border: none; border-radius: 8px; font-size: 16px; cursor: pointer;
    }
    .btn-volver:hover { background-color: #004d40; }
  </style>
</head>
<body>

  <h2>Agregar Nuevo Transportista</h2>

  <div class="formulario">
    <form method="POST" action="?path=transportistas/agregar">
      <label for="nombre">Nombre:</label>
      <input type="text" name="nombre" id="nombre" required>

      <label for="apellido">Apellido:</label>
      <input type="text" name="apellido" id="apellido" required>

      <label for="direccion">Dirección:</label>
      <input type="text" name="direccion" id="direccion">

      <label for="telefono">Teléfono:</label>
      <input type="text" name="telefono" id="telefono">

      <label for="vehiculo">Vehículo:</label>
      <input type="text" name="vehiculo" id="vehiculo" required>

      <label for="nota">Nota (opcional):</label>
      <input type="text" name="nota" id="nota">

      <label for="usuario">Nombre de Usuario:</label>
      <input type="text" name="usuario" id="usuario" required>

      <label for="clave">Contraseña:</label>
      <input type="password" name="clave" id="clave" required>

      <label for="disponible">¿Está disponible?</label>
      <select name="disponible" id="disponible" required>
        <option value="1">Sí</option>
        <option value="0">No</option>
      </select>

      <button type="submit">Guardar Transportista</button>
    </form>
  </div>

  <div class="volver">
    <form action="index.php" method="get">
      <input type="hidden" name="path" value="panel_personal">
      <button type="submit" class="btn-volver">Volver al Panel del Personal</button>
    </form>
  </div>

</body>
</html>
<?php }
}
