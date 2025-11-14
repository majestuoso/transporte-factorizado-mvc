<?php
declare(strict_types=1);

class TransportistaView
{
    // 🏠 Inicio
    public function mostrarInicio(): void
    {
        echo "<h1>🚚 Módulo de Transportistas</h1>";
        echo "<ul>
                <li><a href='?path=transportistas/listar'>📋 Listar transportistas</a></li>
                <li><a href='?path=transportistas/agregar'>➕ Agregar nuevo transportista</a></li>
                <li><a href='?path=transportistas/editar'>✏️ Modificar transportistas</a></li>
                <li><a href='?path=transportistas/eliminar'>🗑️ Eliminar un transportista</a></li>
              </ul>";
        $this->mostrarBotonVolver();
    }

    // 📋 Listado
    public function mostrarTransportistas(array $transportistas): void
    {
        $view = new View();
        $view->render('transportista/listar.tpl', [
            'transportistas' => $transportistas
        ]);
    }

    // ✏️ Formulario de edición de UN transportista
    public function mostrarFormularioModificar(Transportista $t): void
    {
        $view = new View();
        $view->render('transportista/modificar.tpl', [
            't' => $t
        ]);
    }

    // ✏️ Formulario de edición de TODOS los transportistas
    public function mostrarFormularioEditarTodos(array $transportistas): void
    {
        $view = new View();
        $view->render('modificartodos.tpl', [
            'transportistas' => $transportistas
        ]);
    }

    // ➕ Formulario de alta
    public function mostrarFormularioAgregar(): void
    {
        $view = new View();
        $view->render('transportista/agregar.tpl');
    }

    // 🗑️ Selector para eliminar
    public function mostrarSelectorEliminar(array $transportistas): void
    {
        $view = new View();
        $view->render('transportista/selector_eliminar.tpl', [
            'transportistas' => $transportistas
        ]);
    }

    // ✅ Mensajes
    public function showMessage(string $mensaje): void
    {
        echo "<p><strong>" . htmlspecialchars($mensaje) . "</strong></p>";
        $this->mostrarBotonVolver();
    }

    // 📄 Resumen tras alta o modificación
    public function mostrarResumen(Transportista $t): void
    {
        $view = new View();
        $view->render('transportista/resumen.tpl', [
            't' => $t
        ]);
    }

    // 🏠 Botón volver
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
