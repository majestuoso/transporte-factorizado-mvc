<?php



require_once(__DIR__ . '/../db/DB.php');
require_once(__DIR__ . '/../modelo/RutaModel.php');
require_once(__DIR__ . '/../vista/RutaView.php');
require_once(__DIR__ . '/../main.php');
require_once(__DIR__ . '/../modelo/Ruta.php');

class RutaController
{
    private RutaView $view;
    private RutaModel $model;

    public function __construct()
    {
        $this->view = new RutaView();
        $this->model = new RutaModel();
    }

    public function agregar(): void
    {
        $datos = $this->view->solicitarDatos();
        $t = $this->model->crearYGuardar($datos);

        if ($t) {
            $this->view->mostrarResumen($t);
        } else {
            $this->view->showMessage("Datos inválidos. No se pudo registrar ninguna ruta.");
        }
    }

    public function listar(): void
    {
        $rutas = $this->model->listar();

        if (empty($rutas)) {
            $this->view->showMessage("No hay rutas registradas.");
            return;
        }

        $this->view->mostrarRutas($rutas);
    }
    public function modificar(): void
    {
        $rutas = $this->model->listar();

        if (empty($rutas)) {
            $this->view->showMessage("⚠️ No hay rutas registradas.");
            return;
        }

        // Mostrar tabla de rutas antes de pedir ID
        echo "\n\033[1;33m📍 Rutas disponibles:\033[0m\n";
        printf("\033[1m%-4s | %-20s | %-10s | %-30s\033[0m\n", "ID", "Nombre", "Distancia", "Nota");
        echo str_repeat("-", 70) . "\n";

        foreach ($rutas as $r) {
            printf(
                "%-4d | %-20s | %-10.2f | %-30s\n",
                $r->getId(),
                $r->getNombre(),
                $r->getDistancia(),
                $r->getNota() ?: "Sin nota"
            );
        }

        echo str_repeat("-", 70) . "\n";

        // Solicitar ID
        $id = (int) $this->view->getInput("Ingrese el ID de la ruta a modificar: ");
        $ruta = $this->model->buscarPorId($id);

        if (!$ruta) {
            $this->view->showMessage("❌ No se encontró la ruta con ID $id.");
            return;
        }

        $this->view->showMessage("✏️ Modificando ruta #$id");

        $nuevoNombre = $this->view->getInput("Nuevo nombre (Enter para mantener actual): ");
        if ($nuevoNombre !== '') {
            $this->model->modificarNombre($id, $nuevoNombre);
        }

        $nuevaDistancia = $this->view->getInput("Nueva distancia en km (Enter para mantener actual): ");
        if ($nuevaDistancia !== '') {
            $distancia = (float)filter_var($nuevaDistancia, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            if ($distancia > 0) {
                $this->model->modificarDistancia($id, $distancia);
            } else {
                $this->view->showMessage("⚠️ Distancia inválida. Se mantiene la actual.");
            }
        }

        $nuevaNota = $this->view->getInput("Nueva nota (Enter para mantener actual): ");
        if ($nuevaNota !== '') {
            $this->model->modificarNota($id, $nuevaNota);
        }

        $this->view->showMessage("✅ Modificación finalizada.");
    }
    public function eliminar(): void
    {
        $rutas = $this->model->listar();

        if (empty($rutas)) {
            $this->view->showMessage("⚠️ No hay rutas registradas.");
            return;
        }

        // Mostrar tabla de rutas antes de pedir ID
        echo "\n\033[1;33m📍 Rutas disponibles:\033[0m\n";
        printf("\033[1m%-4s | %-20s | %-10s | %-30s\033[0m\n", "ID", "Nombre", "Distancia", "Nota");
        echo str_repeat("-", 70) . "\n";

        foreach ($rutas as $r) {
            printf(
                "%-4d | %-20s | %-10.2f | %-30s\n",
                $r->getId(),
                $r->getNombre(),
                $r->getDistancia(),
                $r->getNota() ?: "Sin nota"
            );
        }

        echo str_repeat("-", 70) . "\n";

        // Solicitar ID
        $id = (int) $this->view->getInput("Ingrese el ID de la ruta a eliminar: ");
        $ruta = $this->model->buscarPorId($id);

        if (!$ruta) {
            $this->view->showMessage("❌ No se encontró la ruta con ID $id.");
            return;
        }

        // Confirmar eliminación
        $confirmacion = strtolower($this->view->getInput("¿Está seguro que desea eliminar la ruta '{$ruta->getNombre()}'? (s/n): "));
        if ($confirmacion === 's') {
            $resultado = $this->model->eliminar($id);
            if ($resultado) {
                $this->view->showMessage("✅ Ruta eliminada correctamente.");
            } else {
                $this->view->showMessage("❌ No se pudo eliminar la ruta con ID $id.");
            }
        } else {
            $this->view->showMessage("❌ Eliminación cancelada.");
        }
    }
}
