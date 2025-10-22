<!DOCTYPE html>
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
      background-color: rgba(0, 0, 0, 0.5);
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 0 15px rgba(0,0,0,0.6);
      width: 100%;
      max-width: 350px;
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

    .form-box input,
    .form-box select {
      background-color: rgba(255,255,255,0.2);
      border: none;
      color: white;
    }

    .form-box input::placeholder {
      color: #ccc;
    }

    .form-box .btn-primary {
      width: 100%;
      margin-top: 1.5rem;
    }

    .form-box .btn-outline-light {
      width: 100%;
      margin-top: 0.5rem;
    }

    .form-box .alert {
      margin-top: 1rem;
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
      <form method="post" action="?path=registro">
        <label for="usuario">👤 Usuario</label>
        <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Tu nombre" required>

        <label for="clave">🔒 Clave</label>
        <input type="password" name="clave" id="clave" class="form-control" placeholder="Contraseña" required>

        <label for="rol">🎯 Rol</label>
        <select name="rol" id="rol" class="form-select">
          <option value="cliente">Cliente</option>
          <option value="personal">Personal</option>
        </select>

        <button type="submit" class="btn btn-primary">✅ Registrar</button>
      </form>

      {if isset($mensaje)}
        <div class="alert alert-danger text-center">{$mensaje}</div>
      {/if}

      <!-- 🔙 Botón Volver -->
      <a href="?path=inicio" class="btn btn-outline-light">🔙 Volver</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
