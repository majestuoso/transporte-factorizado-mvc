<?php
/* Smarty version 3.1.48, created on 2025-11-13 19:28:11
  from '/opt/lampp/htdocs/transporte/vista/panel_transportista.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6916233b52b905_57829413',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0a190ec9bb44946820542339a6dbd905c95f7ff4' => 
    array (
      0 => '/opt/lampp/htdocs/transporte/vista/panel_transportista.tpl',
      1 => 1763058486,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6916233b52b905_57829413 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel del Transportista</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #2196f3, #21cbf3);
      font-family: 'Segoe UI', sans-serif;
      color: #333;
    }
    .card {
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      margin-bottom: 20px;
    }
    .card-header {
      font-weight: 600;
      font-size: 1.2rem;
      background: #0288d1;
      color: #fff;
      border-radius: 12px 12px 0 0;
    }
    .btn-custom {
      border-radius: 8px;
      font-weight: 500;
      transition: 0.3s;
    }
    .btn-custom:hover {
      transform: scale(1.05);
    }
    h1 {
      color: #fff;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
      margin: 20px 0;
      text-align: center;
    }
  </style>
</head>
<body>

<h1>👋 Bienvenido, <?php echo $_smarty_tpl->tpl_vars['usuario']->value;?>
</h1>

<div class="container">
  <div class="row">
    <!-- Datos actuales -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">📝 Datos actuales</div>
        <div class="card-body">
          <p><strong>Nombre:</strong> <?php echo $_smarty_tpl->tpl_vars['datos']->value->getNombre();?>
</p>
          <p><strong>Apellido:</strong> <?php echo $_smarty_tpl->tpl_vars['datos']->value->getApellido();?>
</p>
          <p><strong>Vehículo:</strong> <?php echo $_smarty_tpl->tpl_vars['datos']->value->getVehiculo();?>
</p>
          <p><strong>Disponible:</strong> <?php if ($_smarty_tpl->tpl_vars['datos']->value->getDisponible() == 1) {?>✅ Sí<?php } else { ?>❌ No<?php }?></p>
          <p><strong>Nota:</strong> <?php echo $_smarty_tpl->tpl_vars['datos']->value->getNota();?>
</p>
        </div>
      </div>
    </div>

    <!-- Formulario de edición -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">✏️ Modificar perfil</div>
        <div class="card-body">
          <form method="post" action="index.php?path=transportistas/modificar">
            <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['datos']->value->getId();?>
">

            <div class="mb-3">
              <label class="form-label">Nombre</label>
              <input type="text" class="form-control" name="nombre" value="<?php echo $_smarty_tpl->tpl_vars['datos']->value->getNombre();?>
" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Apellido</label>
              <input type="text" class="form-control" name="apellido" value="<?php echo $_smarty_tpl->tpl_vars['datos']->value->getApellido();?>
" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Vehículo</label>
              <input type="text" class="form-control" name="vehiculo" value="<?php echo $_smarty_tpl->tpl_vars['datos']->value->getVehiculo();?>
" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Nota</label>
              <input type="text" class="form-control" name="nota" value="<?php echo $_smarty_tpl->tpl_vars['datos']->value->getNota();?>
">
            </div>

            <div class="mb-3">
              <label class="form-label">Disponible</label>
              <select class="form-select" name="disponible">
                <option value="1" <?php if ($_smarty_tpl->tpl_vars['datos']->value->getDisponible() == 1) {?>selected<?php }?>>✅ Disponible</option>
                <option value="0" <?php if ($_smarty_tpl->tpl_vars['datos']->value->getDisponible() == 0) {?>selected<?php }?>>❌ No disponible</option>
              </select>
            </div>

            <button type="submit" class="btn btn-success btn-custom">💾 Guardar cambios</button>
            <a href="index.php?path=logout" class="btn btn-danger btn-custom">🔒 Cerrar sesión</a>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabla de viajes -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">📊 Tus viajes recientes</div>
        <div class="card-body">
          <?php if ($_smarty_tpl->tpl_vars['viajes']->value) {?>
            <table class="table table-striped table-hover">
              <thead class="table-primary">
                <tr>
                  <th>Fecha</th><th>Ruta</th><th>Origen</th><th>Destino</th>
                  <th>Tarifa</th><th>Estado</th><th>Nota</th>
                </tr>
              </thead>
              <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['viajes']->value, 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
                  <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['v']->value['fecha'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['v']->value['ruta_nombre'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['v']->value['origen'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['v']->value['destino'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['v']->value['tarifa'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['v']->value['estado'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['v']->value['nota'];?>
</td>
                  </tr>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </tbody>
            </table>
          <?php } else { ?>
            <p class="text-muted">No se encontraron viajes registrados.</p>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
<?php }
}
