<?php
declare(strict_types=1);

require_once(__DIR__ . '/../modelo/TransportistaModel.php');
require_once(__DIR__ . '/../vista/TransportistaView.php');
require_once(__DIR__ . '/../modelo/Transportista.php');

class TransportistaController
{
    private TransportistaView $view;
    private TransportistaModel $model;

    public function __construct()
    {
        $this->view = new TransportistaView();
        $this->model = new TransportistaModel();
    }

    public function index(): void
    {
        $this->model->recargar();
        $this->view->mostrarInicio();
    }

    public function listar(): void
    {
        $this->model->recargar();
        $transportistas = $this->model->listar();

        // Validar que todos sean instancias válidas
        $transportistas = array_filter($transportistas, fn($t) => $t instanceof Transportista);

        if (empty($transportistas)) {
            $this->view->showMessage("No hay transportistas registrados.");
            return;
        }

        $this->view->mostrarTransportistas($transportistas);
    }

    public function agregar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = $_POST;

            if ($this->validar($datos)) {
                $t = $this->model->crearYGuardar($datos);
                if ($t instanceof Transportista) {
                    $this->view->mostrarResumen($t);
                } else {
                    $this->view->showMessage("Error interno. No se pudo registrar el transportista.");
                }
            } else {
                $this->view->showMessage("Datos inválidos. No se pudo registrar el transportista.");
            }
        } else {
            $this->view->mostrarFormularioAgregar();
        }
    }

    private function validar(array $data): bool
    {
        return isset($data['nombre'], $data['apellido'], $data['vehiculo']) &&
               trim($data['nombre']) !== '' &&
               trim($data['apellido']) !== '' &&
               trim($data['vehiculo']) !== '';
    }

    public function modificar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = (int) $_POST['id'];
            $this->model->modificarDesdeFormulario($id, $_POST);
            $this->view->showMessage("Transportista modificado correctamente.");
        } elseif (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
            $transportista = $this->model->buscarPorId($id);
            if ($transportista instanceof Transportista) {
                $this->view->mostrarFormularioModificar($transportista);
            } else {
                $this->view->showMessage("Transportista no encontrado.");
            }
        } else {
            $transportistas = $this->model->listar();
            $transportistas = array_filter($transportistas, fn($t) => $t instanceof Transportista);
            $this->view->mostrarSelectorModificar($transportistas);
        }
    }

    public function eliminar(): void
    {
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
            $transportista = $this->model->buscarPorId($id);

            if ($transportista instanceof Transportista) {
                $this->model->eliminar($id);
                $this->view->showMessage("Transportista #$id eliminado correctamente.");
            } else {
                $this->view->showMessage("Transportista no encontrado.");
            }
        } else {
            $transportistas = $this->model->listar();
            $transportistas = array_filter($transportistas, fn($t) => $t instanceof Transportista);
            $this->view->mostrarSelectorEliminar($transportistas);
        }
    }
}
