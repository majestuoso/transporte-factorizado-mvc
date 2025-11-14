<?php
/* Smarty version 3.1.48, created on 2025-11-14 00:32:00
  from '/opt/lampp/htdocs/transporte/vista/modificartodos.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_69166a704e87c5_36641390',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2a16b8ed8ab24161629db0d66e1142929d9869ad' => 
    array (
      0 => '/opt/lampp/htdocs/transporte/vista/modificartodos.tpl',
      1 => 1763076716,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69166a704e87c5_36641390 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>✏️ Modificar Transportistas</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f9fafb;
      padding: 40px;
    }

    h2 {
      color: #1565c0;
      text-align: center;
      margin-bottom: 25px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    thead {
      background-color: #1565c0;
      color: #fff;
    }

    th, td {
      padding: 12px;
      text-align: center;
    }

    tbody tr:nth-child(even) {
      background-color: #f1f5f9;
    }

    input, select, textarea {
      width: 95%;
      padding: 8px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 14px;
    }

    textarea {
      resize: vertical;
    }

    button {
      margin-top: 20px;
      background-color: #1565c0;
      color: white;
      padding: 12px 24px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    button:hover {
      background-color: #0d47a1;
    }

    .volver {
      margin-top: 30px;
      text-align: center;
    }

    .btn-volver {
      background-color: #00796b;
      color: white;
      padding: 12px 24px;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    .btn-volver:hover {
      background-color: #004d40;
    }
  </style>
</head>
<body>

<h2>✏️ Modificar Transportistas</h2>

<form method="POST" action="index.php?path=transportistas/modificarTodos">
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Vehículo</th>
        <th>Estado</th>
        <th>Nota</th>
      </tr>
    </thead>
    <tbody>
      <?php echo '<?php ';?>
foreach ($transportistas as $t): <?php echo '?>';?>

      <tr>
        <td>
          <?php echo '<?=';?>
 htmlspecialchars($t->getId()) <?php echo '?>';?>

          <input type="hidden" name="id[]" value="<?php echo '<?=';?>
 (int)$t->getId() <?php echo '?>';?>
">
        </td>
        <td>
          <input type="text" name="nombre[]" value="<?php echo '<?=';?>
 htmlspecialchars($t->getNombre() ?? '') <?php echo '?>';?>
">
        </td>
        <td>
          <input type="text" name="apellido[]" value="<?php echo '<?=';?>
 htmlspecialchars($t->getApellido() ?? '') <?php echo '?>';?>
">
        </td>
        <td>
          <input type="text" name="vehiculo[]" value="<?php echo '<?=';?>
 htmlspecialchars($t->getVehiculo() ?? '') <?php echo '?>';?>
">
        </td>
        <td>
          <select name="disponible[]">
            <option value="1" <?php echo '<?=';?>
 $t->getDisponible()==1 ? 'selected' : '' <?php echo '?>';?>
>✅ Disponible</option>
            <option value="0" <?php echo '<?=';?>
 $t->getDisponible()==0 ? 'selected' : '' <?php echo '?>';?>
>❌ No disponible</option>
          </select>
        </td>
        <td>
          <textarea name="nota[]"><?php echo '<?=';?>
 htmlspecialchars($t->getNota() ?? '') <?php echo '?>';?>
</textarea>
        </td>
      </tr>
      <?php echo '<?php ';?>
endforeach; <?php echo '?>';?>

    </tbody>
  </table>

  <button type="submit">Guardar todos</button>
</form>

<div class="volver">
  <form action="index.php" method="get">
    <input type="hidden" name="path" value="panel_personal">
    <button type="submit" class="btn-volver">🏠 Volver al Panel del Personal</button>
  </form>
</div>

</body>
</html>
<?php }
}
