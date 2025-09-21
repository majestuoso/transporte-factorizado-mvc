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

    public function agregar(): void
    {
        $datos = $this->view->solicitarDatos();
        $t = $this->model->crearYGuardar($datos);

        if ($t) {
            $this->view->mostrarResumen($t);
        } else {
            $this->view->showMessage("❌ Datos inválidos. No se pudo registrar el transportista.");
        }
    }

    public function listar(): void
    {
        $transportistas = $this->model->listar();

        if (empty($transportistas)) {
            $this->view->showMessage("⚠️ No hay transportistas registrados.");
            return;
        }

        $this->view->mostrarTransportistas($transportistas);
    }

    public function eliminar(): void
    {
        $transportistas = $this->model->listar();
        if (empty($transportistas)) {
            $this->view->showMessage("⚠️ No hay transportistas registrados.");
            return;
        }

        $this->view->mostrarTransportistas($transportistas);

        $id = (int) $this->view->getInput("Ingrese el ID del transportista a eliminar:");
        $resultado = $this->model->eliminar($id);

        $mensaje = $resultado
            ? "✅ Transportista eliminado correctamente."
            : "❌ No se encontró el transportista con ID $id.";

        $this->view->showMessage($mensaje);
    }

    public function modificar(): void
    {
        $transportistas = $this->model->listar();
        if (empty($transportistas)) {
            $this->view->showMessage("⚠️ No hay transportistas registrados.");
            return;
        }

        $this->view->mostrarTransportistas($transportistas);

        $id = (int) $this->view->getInput("ID del transportista a modificar:");
        $transportista = $this->model->buscarPorId($id);

        if (!$transportista) {
            $this->view->showMessage("❌ No se encontró el transportista con ID $id.");
            return;
        }

        $this->view->showMessage("✏️ Modificando transportista #$id");

        $nuevoNombre = $this->view->getInput("Nuevo nombre (Enter para mantener actual):");
        if ($nuevoNombre !== '') {
            $this->model->modificarNombre($id, $nuevoNombre);
        }

        $nuevoApellido = $this->view->getInput("Nuevo apellido (Enter para mantener actual):");
        if ($nuevoApellido !== '') {
            $this->model->modificarApellido($id, $nuevoApellido);
        }

        $nuevoVehiculo = $this->view->getInput("Nuevo vehículo (Enter para mantener actual):");
        if ($nuevoVehiculo !== '') {
            $this->model->modificarVehiculo($id, $nuevoVehiculo);
        }

        $estado = $this->view->getInput("Disponibilidad (1 disponible, 0 no disponible, Enter para mantener):");
        if ($estado === '1' || $estado === '0') {
            $this->model->modificarDisponibilidad($id, $estado === '1');
        }

        $nota = $this->view->getInput("Nueva nota (Enter para mantener actual):");
        if ($nota !== '') {
            $this->model->modificarNota($id, $nota);
        }

        $this->view->showMessage("✅ Modificación finalizada.");
    }
}
