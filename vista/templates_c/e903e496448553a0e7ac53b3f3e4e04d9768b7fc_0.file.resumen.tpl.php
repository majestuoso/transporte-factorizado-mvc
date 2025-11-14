<?php
/* Smarty version 3.1.48, created on 2025-11-13 22:53:07
  from '/opt/lampp/htdocs/transporte/vista/transportista/resumen.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_691653430798a2_19526786',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e903e496448553a0e7ac53b3f3e4e04d9768b7fc' => 
    array (
      0 => '/opt/lampp/htdocs/transporte/vista/transportista/resumen.tpl',
      1 => 1763070777,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_691653430798a2_19526786 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resumen del Transportista</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                  url('librerias/assets/neco.jpg') no-repeat center center fixed;
      background-size: cover;
      color: white;
      font-family: 'Segoe UI', sans-serif;
      padding: 2rem;
    }
    .card {
      background-color: rgba(255,255,255,0.9);
      color: #333;
      border-radius: 10px;
      padding: 1.5rem;
    }
    h2 {
      color: #0d6efd;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="card shadow">
      <h2>✅ Transportista actualizado exitosamente</h2>
      <ul class="list-group list-group-flush mt-3">
        <li class="list-group-item"><strong>ID:</strong> <?php echo $_smarty_tpl->tpl_vars['t']->value->getId();?>
</li>
        <li class="list-group-item"><strong>Nombre:</strong> <?php echo $_smarty_tpl->tpl_vars['t']->value->getNombre();?>
</li>
        <li class="list-group-item"><strong>Apellido:</strong> <?php echo $_smarty_tpl->tpl_vars['t']->value->getApellido();?>
</li>
        <li class="list-group-item"><strong>Vehículo:</strong> <?php echo $_smarty_tpl->tpl_vars['t']->value->getVehiculo();?>
</li>
        <li class="list-group-item">
          <strong>Disponible:</strong>
          <?php if ($_smarty_tpl->tpl_vars['t']->value->isDisponible()) {?>✅ Sí<?php } else { ?>❌ No<?php }?>
        </li>
        <li class="list-group-item"><strong>Nota:</strong> <?php echo (($tmp = @$_smarty_tpl->tpl_vars['t']->value->getNota())===null||$tmp==='' ? 'Sin nota' : $tmp);?>
</li>
      </ul>

      <div class="mt-4">
        <!-- 🔙 Botón corregido: siempre lleva al panel del transportista -->
        <a href="index.php?path=panel_transportista" class="btn btn-outline-primary">
          🏠 Volver al Panel del Transportista
        </a>
        <a href="index.php?path=transportistas/listar" class="btn btn-outline-secondary">
          📋 Volver al Listado
        </a>
      </div>
    </div>
  </div>
</body>
</html>
<?php }
}
