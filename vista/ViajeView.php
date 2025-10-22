<?php

require_once(__DIR__ . '/../modelo/Viaje.php');

class ViajeView
{
   public function mostrarViajes(array $viajes): void
{
    echo "<h2>Lista de Viajes</h2>";

    if (empty($viajes)) {
        echo "<p><strong>No hay viajes registrados.</strong></p>";
        $this->mostrarBotonVolver();
        return;
    }

    echo "<table border='1' cellpadding='6' cellspacing='0'>";
    echo "<thead><tr>
            <th>ID</th>
            <th>Tarifa</th>
            <th>Transportista</th>
            <th>Ruta</th>
            <th>Estado</th>
            <th>Nota</th>
          </tr></thead><tbody>";

    foreach ($viajes as $v) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($v['id']) . "</td>";
        echo "<td>" . htmlspecialchars($v['tarifa']) . "</td>";
        echo "<td>" . htmlspecialchars($v['transportista']) . "</td>";
        echo "<td>" . htmlspecialchars($v['ruta']) . "</td>";
        echo "<td>" . htmlspecialchars($v['estado']) . "</td>";
        echo "<td>" . htmlspecialchars($v['nota'] ?? 'Sin nota') . "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
    $this->mostrarBotonVolver();
}


   public function mostrarViajesConEliminar(array $viajes): void
{
    echo "<h2>Eliminar Viaje</h2>";

    if (empty($viajes)) {
        echo "<p>No hay viajes para eliminar.</p>";
    } else {
        echo "<table border='1' cellpadding='5' cellspacing='0'>
                <tr>
                    <th>ID</th>
                    <th>Tarifa</th>
                    <th>ID Transportista</th>
                    <th>ID Ruta</th>
                    <th>Estado</th>
                    <th>Nota</th>
                    <th>Acción</th>
                </tr>";
        foreach ($viajes as $v) {
            echo "<tr>
                    <td>{$v->getId()}</td>
                    <td>{$v->getTarifa()}</td>
                    <td>{$v->getTransportistaId()}</td>
                    <td>{$v->getRutaId()}</td>
                    <td>{$v->getEstado()}</td>
                    <td>{$v->getNota()}</td>
                    <td><a href='?path=viajes/eliminar&id={$v->getId()}'>Eliminar</a></td>
                  </tr>";
        }
        echo "</table>";
    }

    $this->mostrarBotonVolver();
}

    public function mostrarViajesConModificar(array $viajes): void
{
    echo "<h2>Modificar Viaje</h2>";

    if (empty($viajes)) {
        echo "<p>No hay viajes para modificar.</p>";
    } else {
        echo "<table border='1' cellpadding='5' cellspacing='0'>
                <tr>
                    <th>ID</th>
                    <th>Tarifa</th>
                    <th>Transportista</th>
                    <th>Ruta</th>
                    <th>Estado</th>
                    <th>Nota</th>
                </tr>";
        foreach ($viajes as $v) {
            echo "<tr>
                    <td>{$v['id']}</td>
                    <td>{$v['tarifa']}</td>
                    <td>{$v['transportista']}</td>
                    <td>{$v['ruta']}</td>
                    <td>{$v['estado']}</td>
                    <td>{$v['nota']}</td>
                  </tr>";
        }
        echo "</table><br>";

        echo <<<HTML
<form method="GET" action="">
    <input type="hidden" name="path" value="viajes/modificar">
    <label>ID a modificar:</label>
    <input type="number" name="id" required>
    <button type="submit">Modificar</button>
</form>
HTML;
    }

    $this->mostrarBotonVolver();
}


    public function formularioAgregar(array $transportistas, array $rutas): void
    {
        echo "<h2>Agregar Viaje</h2>";
        echo '<form method="POST">';

        echo '<label>Tarifa:</label><br>';
        echo '<input type="number" step="0.01" name="tarifa" required><br><br>';

        echo '<label>Transportista:</label><br>';
        echo '<select name="transportistaId" required>';
        foreach ($transportistas as $t) {
            echo "<option value='{$t->getId()}'>{$t->getNombreCompleto()} (ID {$t->getId()})</option>";
        }
        echo '</select><br><br>';

        echo '<label>Ruta:</label><br>';
        echo '<select name="rutaId" required>';
        foreach ($rutas as $r) {
            echo "<option value='{$r->getId()}'>{$r->getNombre()} (ID {$r->getId()})</option>";
        }
        echo '</select><br><br>';

        echo '<label>Estado:</label><br>';
        echo '<select name="estado">
                <option value="pendiente">Pendiente</option>
                <option value="en curso">En curso</option>
                <option value="completado">Completado</option>
              </select><br><br>';

        echo '<label>Nota (opcional):</label><br>';
        echo '<input type="text" name="nota"><br><br>';

        echo '<button type="submit">Guardar</button>';
        echo '</form>';
        $this->mostrarBotonVolver();
    }

    public function formularioModificar(Viaje $v): void
    {
        echo "<h2>Modificar Viaje #{$v->getId()}</h2>";
        echo <<<HTML
<form method="POST">
    <input type="hidden" name="id" value="{$v->getId()}">

    <label>Campo a modificar:</label><br>
    <select name="campo" required>
        <option value="tarifa">Tarifa</option>
        <option value="transportista">ID Transportista</option>
        <option value="ruta">ID Ruta</option>
        <option value="estado">Estado</option>
        <option value="nota">Nota</option>
    </select><br><br>

    <label>Nuevo valor:</label><br>
    <input type="text" name="valor" required><br><br>

    <button type="submit">Modificar</button>
</form>
HTML;
        $this->mostrarBotonVolver();
    }

    public function mostrarResumen(Viaje $v): void
    {
        echo "<h2>Resumen del Viaje</h2>";
        echo "<ul>
                <li>ID: {$v->getId()}</li>
                <li>Tarifa: {$v->getTarifa()}</li>
                <li>ID Transportista: {$v->getTransportistaId()}</li>
                <li>ID Ruta: {$v->getRutaId()}</li>
                <li>Estado: {$v->getEstado()}</li>
                <li>Nota: {$v->getNota()}</li>
              </ul>";
        $this->mostrarBotonVolver();
    }

    public function showMessage(string $mensaje): void
    {
        echo "<p><strong>{$mensaje}</strong></p>";
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


}
