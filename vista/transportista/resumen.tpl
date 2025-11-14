<!DOCTYPE html>
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
        <li class="list-group-item"><strong>ID:</strong> {$t->getId()}</li>
        <li class="list-group-item"><strong>Nombre:</strong> {$t->getNombre()}</li>
        <li class="list-group-item"><strong>Apellido:</strong> {$t->getApellido()}</li>
        <li class="list-group-item"><strong>Vehículo:</strong> {$t->getVehiculo()}</li>
        <li class="list-group-item">
          <strong>Disponible:</strong>
          {if $t->isDisponible()}✅ Sí{else}❌ No{/if}
        </li>
        <li class="list-group-item"><strong>Nota:</strong> {$t->getNota()|default:'Sin nota'}</li>
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
