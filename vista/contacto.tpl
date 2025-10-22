<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
  <div class="container-fluid">
    <a class="navbar-brand" href="?path=inicio">🚍 Transporte</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="?path=servicios">Servicios</a></li>
        <li class="nav-item"><a class="nav-link" href="?path=nosotros">Nosotros</a></li>
        <li class="nav-item"><a class="nav-link" href="?path=noticias">Noticias</a></li>
        <li class="nav-item"><a class="nav-link active" href="?path=contacto">Contacto</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container py-5">
  <h2 class="text-danger">Contáctanos</h2>

  <div class="row mb-4">
    <div class="col-md-6">
      <h5>📍 Dirección</h5>
      <p>Av. del Transporte 123, Tandil, Buenos Aires, Argentina</p>

      <h5>📞 Teléfono</h5>
      <p>+54 9 249 400-1234</p>

      <h5>📧 Correo electrónico</h5>
      <p>contacto@transporteinstitucional.com</p>
    </div>

    <div class="col-md-6">
      <h5>🌐 Redes sociales</h5>
      <ul class="list-unstyled">
        <li><a href="https://facebook.com/transporteinstitucional" target="_blank">Facebook</a></li>
        <li><a href="https://instagram.com/transporteinstitucional" target="_blank">Instagram</a></li>
        <li><a href="https://twitter.com/transporteinst" target="_blank">Twitter</a></li>
        <li><a href="https://linkedin.com/company/transporteinstitucional" target="_blank">LinkedIn</a></li>
      </ul>
    </div>
  </div>

  <form method="POST" action="?path=contacto">
    <div class="mb-3">
      <label for="nombre" class="form-label">Tu nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <div class="mb-3">
      <label for="mensaje" class="form-label">Tu mensaje</label>
      <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
    </div>
    <button type="submit" class="btn btn-danger">Enviar mensaje</button>
  </form>

  <div class="text-center mt-4">
    <a href="?path=inicio" class="btn btn-outline-danger">⬅ Volver al inicio</a>
  </div>
</div>
