<?php

declare(strict_types=1);

require_once(__DIR__ . '/../modelo/ViajeModel.php');
require_once(__DIR__ . '/../vista/ViajeView.php');
require_once(__DIR__ . '/../modelo/Viaje.php');

class ViajeController
{
    private ViajeModel $model;
    private ViajeView $view;

    public function __construct()
    {
        $this->model = new ViajeModel();
        $this->view = new ViajeView();
    }

    public function agregar(): void
    {
        $datos = $this->view->solicitarDatos();
        $viaje = $this->model->crearYGuardar($datos);

        if ($viaje) {
            $this->view->mostrarResumen($viaje);
        } else {
            $this->view->showMessage("Datos inválidos. No se pudo registrar el viaje.");
        }
    }

    public function listar(): void
    {
        $viajes = $this->model->listar();

        if (empty($viajes)) {
            $this->view->showMessage("No hay viajes registrados.");
            return;
        }

        $this->view->mostrarViajes($viajes);
    }

    public function modificar(): void
    {
        $id = $this->view->solicitarId();
        $nuevoValor = $this->view->solicitarTarifa();
        $resultado = $this->model->modificarTarifa($id, $nuevoValor);

        $this->view->showMessage($resultado ? "Tarifa modificada correctamente." : "No se pudo modificar la tarifa.");
    }

    public function modificarTransportistaEnViaje(): void
    {
        $id = $this->view->solicitarId();
        $nuevoTransportistaId = $this->view->solicitarTransportistaId();
        $resultado = $this->model->modificarTransportista($id, $nuevoTransportistaId);

        $this->view->showMessage($resultado ? "Transportista actualizado correctamente." : "No se pudo actualizar el transportista.");
    }

    public function modificarRutaEnViaje(): void
    {
        $id = $this->view->solicitarId();
        $nuevaRutaId = $this->view->solicitarRutaId();
        $resultado = $this->model->modificarRuta($id, $nuevaRutaId);

        $this->view->showMessage($resultado ? "Ruta actualizada correctamente." : "No se pudo actualizar la ruta.");
    }

    public function modificarEstado(): void
    {
        $id = $this->view->solicitarId();
        $nuevoEstado = $this->view->solicitarEstado();
        $resultado = $this->model->modificarEstado($id, $nuevoEstado);

        $this->view->showMessage($resultado ? "Estado actualizado correctamente." : "No se pudo actualizar el estado.");
    }

    public function eliminar(): void
    {
        $id = $this->view->solicitarId();
        $resultado = $this->model->eliminar($id);

        $this->view->showMessage($resultado ? "Viaje eliminado correctamente." : "No se pudo eliminar el viaje.");
    }
    public function agregarDesdeDatos(array $datos): void
    {
        $transportistaId = (int)($datos['transportistaId'] ?? 0);
        $rutaId = (int)($datos['rutaId'] ?? 0);
        $estado = trim($datos['estado'] ?? '');

        if ($transportistaId <= 0 || $rutaId <= 0 || $estado === '') return;

        $viaje = new Viaje($rutaId, $transportistaId, $estado);
        DB::getInstance()->agregarViaje($viaje);
    }
}
