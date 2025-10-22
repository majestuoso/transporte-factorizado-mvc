<?php



class TransportistaView 
{
    public function mostrarInicio(): void
    {
        echo "<h1>🚚 Módulo de Transportistas</h1>";
        echo "<ul>
                <li><a href='?path=transportistas/listar'>📋 Listar transportistas</a></li>
                <li><a href='?path=transportistas/agregar'>➕ Agregar nuevo transportista</a></li>
                <li><a href='?path=transportistas/modificar'>✏️ Modificar un transportista</a></li>
                <li><a href='?path=transportistas/eliminar'>🗑️ Eliminar un transportista</a></li>
              </ul>";
        $this->mostrarBotonVolver();
    }

    public function mostrarTransportistas(array $transportistas): void
    {
        echo "<h2>Listado de Transportistas</h2>";

        if (empty($transportistas)) {
            echo "<p><strong>No hay transportistas registrados.</strong></p>";
            $this->mostrarBotonVolver();
            return;
        }

        echo "<table border='1' cellpadding='6' cellspacing='0'>";
        echo "<thead><tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Vehículo</th>
                <th>Disponible</th>
                <th>Nota</th>
              </tr></thead><tbody>";

        foreach ($transportistas as $t) {
            $id = htmlspecialchars($t->getId());
            $nombre = htmlspecialchars($t->getNombre());
            $apellido = htmlspecialchars($t->getApellido());
            $vehiculo = htmlspecialchars($t->getVehiculo());
            $disponible = $t->isDisponible() ? '✅ Sí' : '❌ No';
            $nota = htmlspecialchars($t->getNota() ?? 'Sin nota');

            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$nombre</td>";
            echo "<td>$apellido</td>";
            echo "<td>$vehiculo</td>";
            echo "<td>$disponible</td>";
            echo "<td>$nota</td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
        $this->mostrarBotonVolver();
    }

    public function mostrarSelectorModificar(array $transportistas): void
    {
        echo "<h2>Seleccionar Transportista para Modificar</h2>";

        if (empty($transportistas)) {
            echo "<p><strong>No hay transportistas disponibles.</strong></p>";
            $this->mostrarBotonVolver();
            return;
        }

        $this->mostrarTransportistas($transportistas);

        echo <<<HTML
<br>
<form method="GET" action="index.php">
    <input type="hidden" name="path" value="transportistas/modificar">
    <label>ID a modificar: <input type="number" name="id" required></label>
    <button type="submit">Modificar</button>
</form>
HTML;

        $this->mostrarBotonVolver();
    }

    public function mostrarFormularioAgregar(): void
    {
        echo <<<HTML
<h2>Agregar Transportista</h2>
<form method="POST" action="?path=transportistas/agregar">
    <label>Nombre: <input type="text" name="nombre" required></label><br><br>
    <label>Apellido: <input type="text" name="apellido" required></label><br><br>
    <label>Vehículo: <input type="text" name="vehiculo" required></label><br><br>
    <label>Disponible:
        <select name="disponible">
            <option value="1">✅ Sí</option>
            <option value="0">❌ No</option>
        </select>
    </label><br><br>
    <label>Nota (opcional): <input type="text" name="nota"></label><br><br>
    <button type="submit">Guardar</button>
</form>
HTML;
        $this->mostrarBotonVolver();
    }

    public function mostrarFormularioModificar($t): void
    {
        $id = htmlspecialchars($t->getId());
        $nombre = htmlspecialchars($t->getNombre());
        $apellido = htmlspecialchars($t->getApellido());
        $vehiculo = htmlspecialchars($t->getVehiculo());
        $disponible = $t->isDisponible() ? '1' : '0';
        $nota = htmlspecialchars($t->getNota() ?? '');

        echo <<<HTML
<h2>Modificar Transportista #$id</h2>
<form method="POST" action="?path=transportistas/modificar">
    <input type="hidden" name="id" value="$id">
    <label>Nombre: <input type="text" name="nombre" value="$nombre" required></label><br><br>
    <label>Apellido: <input type="text" name="apellido" value="$apellido" required></label><br><br>
    <label>Vehículo: <input type="text" name="vehiculo" value="$vehiculo" required></label><br><br>
    <label>Disponible:
        <select name="disponible">
            <option value="1" {$this->selected($disponible, '1')}>✅ Sí</option>
            <option value="0" {$this->selected($disponible, '0')}>❌ No</option>
        </select>
    </label><br><br>
    <label>Nota: <input type="text" name="nota" value="$nota"></label><br><br>
    <button type="submit">Guardar cambios</button>
</form>
HTML;
        $this->mostrarBotonVolver();
    }

    private function selected(string $value, string $expected): string
    {
        return $value === $expected ? 'selected' : '';
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
    <input type="hidden" name="path" value="panel_personal">
    <button type="submit" class="btn btn-outline-light">🏠 Volver al Panel del Personal</button>
</form>
HTML;
}

    public function mostrarResumen($t): void
{
    echo "<h2>Transportista registrado exitosamente</h2>";
    echo "<ul>";
    echo "<li><strong>ID:</strong> " . htmlspecialchars($t->getId()) . "</li>";
    echo "<li><strong>Nombre:</strong> " . htmlspecialchars($t->getNombre()) . "</li>";
    echo "<li><strong>Apellido:</strong> " . htmlspecialchars($t->getApellido()) . "</li>";
    echo "<li><strong>Vehículo:</strong> " . htmlspecialchars($t->getVehiculo()) . "</li>";
    echo "<li><strong>Disponible:</strong> " . ($t->isDisponible() ? '✅ Sí' : '❌ No') . "</li>";
    echo "<li><strong>Nota:</strong> " . htmlspecialchars($t->getNota() ?? 'Sin nota') . "</li>";
    echo "</ul>";
    $this->mostrarBotonVolver();
}
    public function mostrarSelectorEliminar(array $transportistas): void
{
    echo "<h2>Seleccionar Transportista para Eliminar</h2>";

    if (empty($transportistas)) {
        echo "<p><strong>No hay transportistas disponibles.</strong></p>";
        $this->mostrarBotonVolver();
        return;
    }

    echo "<table border='1' cellpadding='6' cellspacing='0'>";
    echo "<thead><tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Vehículo</th>
            <th>Disponible</th>
            <th>Nota</th>
          </tr></thead><tbody>";

    foreach ($transportistas as $t) {
        $id = htmlspecialchars($t->getId());
        $nombre = htmlspecialchars($t->getNombre());
        $apellido = htmlspecialchars($t->getApellido());
        $vehiculo = htmlspecialchars($t->getVehiculo());
        $disponible = $t->isDisponible() ? '✅ Sí' : '❌ No';
        $nota = htmlspecialchars($t->getNota() ?? 'Sin nota');

        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$nombre</td>";
        echo "<td>$apellido</td>";
        echo "<td>$vehiculo</td>";
        echo "<td>$disponible</td>";
        echo "<td>$nota</td>";
        echo "</tr>";
    }

    echo "</tbody></table><br>";

    echo <<<HTML
<form method="GET" action="index.php" onsubmit="return confirm('¿Estás seguro de que querés eliminar este transportista?');">
    <input type="hidden" name="path" value="transportistas/eliminar">
    <label>ID a eliminar: <input type="number" name="id" required></label>
    <button type="submit">Eliminar</button>
</form>
HTML;

    $this->mostrarBotonVolver();
}

}
