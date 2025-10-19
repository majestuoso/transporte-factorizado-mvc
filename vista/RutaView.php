<?php


class RutaView 
{
    public function mostrarInicio(): void
    {
        echo "<h1>🛣️ Módulo de Rutas</h1>";
        echo "<ul>
                <li><a href='?path=rutas/listar'>📋 Listar rutas</a></li>
                <li><a href='?path=rutas/agregar'>➕ Agregar nueva ruta</a></li>
              </ul>";

        // Formulario para modificar
        echo <<<HTML
<h3>✏️ Modificar una ruta</h3>
<form method="GET" action="index.php">
    <input type="hidden" name="path" value="rutas/modificar">
    <label>ID de la ruta: <input type="number" name="id" required></label>
    <button type="submit">Modificar</button>
</form>
HTML;

        // Formulario para eliminar
        echo <<<HTML
<h3>🗑️ Eliminar una ruta</h3>
<form method="GET" action="index.php" onsubmit="return confirm('¿Eliminar esta ruta?');">
    <input type="hidden" name="path" value="rutas/eliminar">
    <label>ID de la ruta: <input type="number" name="id" required></label>
    <button type="submit">Eliminar</button>
</form>
HTML;

        $this->mostrarBotonVolver();
    }

    public function mostrarRutas(array $rutas): void
    {
        echo "<h2>Listado de Rutas</h2>";

        if (empty($rutas)) {
            echo "<p><strong>No hay rutas registradas.</strong></p>";
            $this->mostrarBotonVolver();
            return;
        }

        echo "<table border='1' cellpadding='6' cellspacing='0'>";
        echo "<thead><tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Distancia (km)</th>
                <th>Nota</th>
              </tr></thead><tbody>";

        foreach ($rutas as $r) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($r->getId()) . "</td>";
            echo "<td>" . htmlspecialchars($r->getNombre()) . "</td>";
            echo "<td>" . htmlspecialchars($r->getDistancia()) . "</td>";
            echo "<td>" . htmlspecialchars($r->getNota() ?? 'Sin nota') . "</td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
        $this->mostrarBotonVolver();
    }

    public function mostrarResumen(Ruta $r): void
    {
        echo "<h2>Ruta registrada exitosamente</h2>";
        echo "<ul>";
        echo "<li><strong>ID:</strong> " . htmlspecialchars($r->getId()) . "</li>";
        echo "<li><strong>Nombre:</strong> " . htmlspecialchars($r->getNombre()) . "</li>";
        echo "<li><strong>Distancia:</strong> " . htmlspecialchars($r->getDistancia()) . " km</li>";
        echo "<li><strong>Nota:</strong> " . htmlspecialchars($r->getNota() ?? 'Sin nota') . "</li>";
        echo "</ul>";
        $this->mostrarBotonVolver();
    }

    public function mostrarFormularioAgregar(): void
    {
        echo <<<HTML
<h2>Agregar Ruta</h2>
<form method="POST" action="?path=rutas/agregar">
    <label>Nombre: <input type="text" name="nombre" required></label><br><br>
    <label>Distancia (km): <input type="number" name="distancia" step="0.1" required></label><br><br>
    <label>Nota (opcional): <input type="text" name="nota"></label><br><br>
    <button type="submit">Guardar</button>
</form>
HTML;
        $this->mostrarBotonVolver();
    }

    public function mostrarFormularioModificar(Ruta $ruta): void
    {
        $id = htmlspecialchars($ruta->getId());
        $nombre = htmlspecialchars($ruta->getNombre());
        $distancia = htmlspecialchars((string) $ruta->getDistancia());
        $nota = htmlspecialchars($ruta->getNota() ?? '');

        echo <<<HTML
<h2>Modificar Ruta #$id</h2>
<form method="POST" action="?path=rutas/modificar">
    <input type="hidden" name="id" value="$id">
    <label>Nombre: <input type="text" name="nombre" value="$nombre" required></label><br><br>
    <label>Distancia (km): <input type="number" name="distancia" step="0.1" value="$distancia" required></label><br><br>
    <label>Nota: <input type="text" name="nota" value="$nota"></label><br><br>
    <button type="submit">Guardar cambios</button>
</form>
HTML;
        $this->mostrarBotonVolver();
    }

    public function showMessage(string $mensaje): void
    {
        echo "<p><strong>" . htmlspecialchars($mensaje) . "</strong></p>";
        $this->mostrarBotonVolver();
    }

    private function mostrarBotonVolver(): void
    {
        echo <<<HTML
<br><br>
<form action="index.php" method="get">
    <button type="submit">🏠 Volver al menú principal</button>
</form>
HTML;
    }
    public function mostrarSelectorModificar(array $rutas): void
{
    echo "<h2>Seleccionar Ruta para Modificar</h2>";

    if (empty($rutas)) {
        echo "<p><strong>No hay rutas disponibles.</strong></p>";
        $this->mostrarBotonVolver();
        return;
    }

    echo "<table border='1' cellpadding='6' cellspacing='0'>";
    echo "<thead><tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Distancia (km)</th>
            <th>Nota</th>
          </tr></thead><tbody>";

    foreach ($rutas as $r) {
        $id = htmlspecialchars($r->getId());
        $nombre = htmlspecialchars($r->getNombre());
        $distancia = htmlspecialchars($r->getDistancia());
        $nota = htmlspecialchars($r->getNota() ?? 'Sin nota');

        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$nombre</td>";
        echo "<td>$distancia</td>";
        echo "<td>$nota</td>";
        echo "</tr>";
    }

    echo "</tbody></table><br>";

    echo <<<HTML
<form method="GET" action="index.php">
    <input type="hidden" name="path" value="rutas/modificar">
    <label>ID a modificar: <input type="number" name="id" required></label>
    <button type="submit">Modificar</button>
</form>
HTML;

    $this->mostrarBotonVolver();
}
    public function mostrarSelectorEliminar(array $rutas): void
{
    echo "<h2>Seleccionar Ruta para Eliminar</h2>";

    if (empty($rutas)) {
        echo "<p><strong>No hay rutas disponibles.</strong></p>";
        $this->mostrarBotonVolver();
        return;
    }

    echo "<table border='1' cellpadding='6' cellspacing='0'>";
    echo "<thead><tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Distancia (km)</th>
            <th>Nota</th>
          </tr></thead><tbody>";

    foreach ($rutas as $r) {
        $id = htmlspecialchars($r->getId());
        $nombre = htmlspecialchars($r->getNombre());
        $distancia = htmlspecialchars($r->getDistancia());
        $nota = htmlspecialchars($r->getNota() ?? 'Sin nota');

        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$nombre</td>";
        echo "<td>$distancia</td>";
        echo "<td>$nota</td>";
        echo "</tr>";
    }

    echo "</tbody></table><br>";

    echo <<<HTML
<form method="GET" action="index.php" onsubmit="return confirm('¿Estás seguro de que querés eliminar esta ruta?');">
    <input type="hidden" name="path" value="rutas/eliminar">
    <label>ID a eliminar: <input type="number" name="id" required></label>
    <button type="submit">Eliminar</button>
</form>
HTML;

    $this->mostrarBotonVolver();
}

}
