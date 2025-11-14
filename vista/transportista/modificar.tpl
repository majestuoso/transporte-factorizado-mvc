<?php
$isFormulario = isset($t) && $t instanceof Transportista;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Modificar Transportista</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #e3f2fd;
      padding: 40px;
      text-align: center;
    }

    h2 {
      color: #1565c0;
      margin-bottom: 30px;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      max-width: 1000px;
      margin: auto;
    }

    .card {
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      text-align: left;
    }

    .formulario {
      max-width: 600px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      text-align: left;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }

    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 16px;
    }

    select#id {
      width: 180px;
      padding: 8px;
      font-size: 16px;
      border-radius: 8px;
      border: 1px solid #ccc;
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
    }

    button:hover {
      background-color: #0d47a1;
    }

    .volver {
      margin-top: 40px;
      text-align: center;
    }

    .btn-volver {
      background-color: #00796b;
      color: white;
      padding: 16px 32px;
      font-size: 18px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-volver:hover {
      background-color: #004d40;
      transform: scale(1.05);
    }
  </style>
</head>
<body>

<?php if ($isFormulario): ?>
  <?php
    $id          = htmlspecialchars($t->getId());
    $nombre      = htmlspecialchars($t->getNombre());
    $apellido    = htmlspecialchars($t->getApellido());
    $direccion   = htmlspecialchars($t->getDireccion());
    $telefono    = htmlspecialchars($t->getTelefono());
    $obraSocial  = htmlspecialchars($t->getObraSocial());
    $vehiculo    = htmlspecialchars($t->getVehiculo());
    $disponible  = $t->getDisponible() == 1 ? '1' : '0';
    $nota        = htmlspecialchars($t->getNota() ?? '');
  ?>
  <div class="formulario">
    <h2>✏️ Modificar Transportista #<?= $id ?></h2>
    <form method="POST" action="?path=transportistas/modificar">
      <input type="hidden" name="id" value="<?= $id ?>">

      <label for="nombre">Nombre:</label>
      <input type="text" name="nombre" id="nombre" value="<?= $nombre ?>" required>

      <label for="apellido">Apellido:</label>
      <input type="text" name="apellido" id="apellido" value="<?= $apellido ?>" required>

      <label for="direccion">Dirección:</label>
      <input type="text" name="direccion" id="direccion" value="<?= $direccion ?>">

      <label for="telefono">Teléfono:</label>
      <input type="text" name="telefono" id="telefono" value="<?= $telefono ?>">

      <label for="obra_social">Obra Social:</label>
      <input type="text" name="obra_social" id="obra_social" value="<?= $obraSocial ?>">

      <label for="vehiculo">Vehículo:</label>
      <input type="text" name="vehiculo" id="vehiculo" value="<?= $vehiculo ?>" required>

      <label for="disponible">Estado:</label>
      <select name="disponible" id="disponible">
        <option value="1" <?= $disponible === '1' ? 'selected' : '' ?>>✅ Disponible</option>
        <option value="0" <?= $disponible === '0' ? 'selected' : '' ?>>❌ No disponible</option>
      </select>

      <label for="nota">Nota:</label>
      <textarea name="nota" id="nota" rows="3"><?= $nota ?></textarea>

      <button type="submit">Guardar cambios</button>
    </form>
  </div>

  <div class="volver">
    <form action="index.php" method="get">
      <input type="hidden" name="path" value="panel_personal">
      <button type="submit" class="btn-volver">🏠 Volver al Panel del Personal</button>
    </form>
  </div>

<?php else: ?>
  <h2>✏️ Seleccionar transportista a modificar</h2>

  <div class="grid">
    <?php foreach ($transportistas as $t): ?>
      <div class="card">
        <p><strong>ID:</strong> <?= htmlspecialchars($t->getId()) ?></p>
        <p><strong>Nombre:</strong> <?= htmlspecialchars($t->getNombre()) ?> <?= htmlspecialchars($t->getApellido()) ?></p>
        <p><strong>Vehículo:</strong> <?= htmlspecialchars($t->getVehiculo()) ?></p>
        <p><strong>Estado:</strong> <?= $t->getDisponible() == 1 ? '✅ Disponible' : '❌ No disponible' ?></p>
      </div>
    <?php endforeach; ?>
  </div>

  <form method="GET" action="index.php">
    <input type="hidden" name="path" value="transportistas/modificar">
    <label for="id">ID del transportista a modificar:</label>
    <select name="id" id="id" required>
      <?php foreach ($transportistas as $t): ?>
        <option value="<?= htmlspecialchars($t->getId()) ?>">
          <?= htmlspecialchars($t->getId()) ?> - <?= htmlspecialchars($t->getNombre()) ?> <?= htmlspecialchars($t->getApellido()) ?>
        </option>
      <?php endforeach; ?>
    </select>
    <button type="submit">Modificar</button>
  </form>

  <div class="volver">
    <form action="index.php" method="get">
      <input type="hidden" name="path" value="panel_personal">
      <button type="submit" class="btn-volver">🏠 Volver al Panel del Personal</button>
    </form>
  </div>
<?php endif; ?>

</body>
</html>
