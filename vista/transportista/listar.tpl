<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Transportistas</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <style>
    body {
      background: #e3f2fd; /* fondo celeste pastel */
      font-family: 'Segoe UI', sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    h2 {
      text-align: center;
      margin: 30px 0;
      font-weight: bold;
      color: #1565c0; /* azul fuerte */
    }

    .table-container {
      flex: 1; /* ocupa todo el espacio disponible */
    }

    .table {
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .table thead {
      background-color: #81d4fa; /* celeste pastel */
      color: #2c3e50;
      font-size: 1.1rem;
    }

    .table tbody tr:nth-child(odd) {
      background-color: #e1f5fe; /* celeste muy suave */
    }

    .table tbody tr:nth-child(even) {
      background-color: #ffffff;
    }

    .btn-pastel {
      background-color: #a5d6a7; /* verde pastel */
      color: #2c3e50;
      border: none;
      border-radius: 8px;
      padding: 14px 28px;
      font-size: 18px;
      font-weight: bold;
      transition: 0.3s;
    }
    .btn-pastel:hover {
      background-color: #81c784;
      color: #fff;
    }

    .footer {
      text-align: center;
      margin-top: 40px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

  <div class="table-container container">
    <h2>🚚 Listado de Transportistas</h2>

    <div class="table-responsive">
      <table class="table table-lg table-hover align-middle">
        <thead>
          <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Vehículo</th>
            <th>Estado</th>
            <th>Nota</th>
          </tr>
        </thead>
        <tbody>
          {foreach $transportistas as $t}
            <tr>
              <td>{$t->getId()}</td>
              <td class="text-uppercase fw-bold text-primary">{$t->getUsuario()}</td>
              <td>{$t->getNombre()}</td>
              <td>{$t->getApellido()}</td>
              <td>{$t->getVehiculo()}</td>
              <td>
                {if $t->isDisponible()}
                  <span class="badge bg-success">Disponible</span>
                {else}
                  <span class="badge bg-danger">No disponible</span>
                {/if}
              </td>
              <td>{$t->getNota()}</td>
            </tr>
          {/foreach}
        </tbody>
      </table>
    </div>
  </div>

  <!-- Botón bien abajo -->
  <div class="footer">
    <a href="?path=panel_personal" class="btn btn-lg btn-pastel">
      🏠 Volver al Panel del Personal
    </a>
  </div>

</body>
</html>
