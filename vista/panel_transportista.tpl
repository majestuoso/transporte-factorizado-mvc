<!DOCTYPE html>
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

<h1>👋 Bienvenido, {$usuario}</h1>

<div class="container">
  <div class="row">
    <!-- Datos actuales -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">📝 Datos actuales</div>
        <div class="card-body">
          <p><strong>Nombre:</strong> {$datos->getNombre()}</p>
          <p><strong>Apellido:</strong> {$datos->getApellido()}</p>
          <p><strong>Vehículo:</strong> {$datos->getVehiculo()}</p>
          <p><strong>Disponible:</strong> {if $datos->getDisponible() == 1}✅ Sí{else}❌ No{/if}</p>
          <p><strong>Nota:</strong> {$datos->getNota()}</p>
        </div>
      </div>
    </div>

    <!-- Formulario de edición -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">✏️ Modificar perfil</div>
        <div class="card-body">
          <form method="post" action="index.php?path=transportistas/modificar">
            <input type="hidden" name="id" value="{$datos->getId()}">

            <div class="mb-3">
              <label class="form-label">Nombre</label>
              <input type="text" class="form-control" name="nombre" value="{$datos->getNombre()}" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Apellido</label>
              <input type="text" class="form-control" name="apellido" value="{$datos->getApellido()}" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Vehículo</label>
              <input type="text" class="form-control" name="vehiculo" value="{$datos->getVehiculo()}" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Nota</label>
              <input type="text" class="form-control" name="nota" value="{$datos->getNota()}">
            </div>

            <div class="mb-3">
              <label class="form-label">Disponible</label>
              <select class="form-select" name="disponible">
                <option value="1" {if $datos->getDisponible() == 1}selected{/if}>✅ Disponible</option>
                <option value="0" {if $datos->getDisponible() == 0}selected{/if}>❌ No disponible</option>
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
          {if $viajes}
            <table class="table table-striped table-hover">
              <thead class="table-primary">
                <tr>
                  <th>Fecha</th><th>Ruta</th><th>Origen</th><th>Destino</th>
                  <th>Tarifa</th><th>Estado</th><th>Nota</th>
                </tr>
              </thead>
              <tbody>
                {foreach $viajes as $v}
                  <tr>
                    <td>{$v.fecha}</td>
                    <td>{$v.ruta_nombre}</td>
                    <td>{$v.origen}</td>
                    <td>{$v.destino}</td>
                    <td>{$v.tarifa}</td>
                    <td>{$v.estado}</td>
                    <td>{$v.nota}</td>
                  </tr>
                {/foreach}
              </tbody>
            </table>
          {else}
            <p class="text-muted">No se encontraron viajes registrados.</p>
          {/if}
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
