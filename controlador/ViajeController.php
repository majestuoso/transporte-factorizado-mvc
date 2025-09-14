<?php

require_once(__DIR__ . '/../db/DB.php');
require_once(__DIR__ . '/../modelo/Viaje.php');
require_once(__DIR__ . '/../modelo/Ruta.php');
require_once(__DIR__ . '/../modelo/Transportista.php');
require_once(__DIR__ . '/../vista/ViajeView.php');

class ViajeController
{
    private DB $db;
    private ViajeView $view;

    public function __construct()
    {
        $this->db = DB::getInstance();
        $this->view = new ViajeView();
    }

    public function agregar(): void
    {
        $rutas = $this->db->getRutas();
        $transportistas = $this->db->getTransportistas();
        $viajes = $this->db->getViajes();

        if (count($rutas) === 0) {
            $this->view->showMessage("No hay rutas disponibles para crear un viaje.");
            return;
        }

        $ocupados = array_map(fn($v) => $v->getTransportista()->getId(), array_filter($viajes, fn($v) => $v->getEstado() === 'En curso'));
        $disponibles = array_filter($transportistas, fn($t) =>
            $t->isDisponible() && !in_array($t->getId(), $ocupados)
        );

        if (count($disponibles) === 0) {
            $this->view->showMessage("No hay transportistas disponibles.");
            return;
        }

        usort($disponibles, fn($a, $b) => $a->getTurno() <=> $b->getTurno());

        $this->view->mostrarTransportistas($disponibles);
        $transportistaSeleccionado = $disponibles[0];
        $this->view->showMessage("Se seleccionó automáticamente el transportista con menor turno: {$transportistaSeleccionado->getNombre()} {$transportistaSeleccionado->getApellido()}");

        $this->view->mostrarRutas($rutas);
        $rutaId = $this->view->getInput("Ingrese el ID de la ruta deseada:");
        $rutaSeleccionada = $this->db->getRutaPorId((int)$rutaId);

        if (!$rutaSeleccionada) {
            $this->view->showMessage("Ruta no encontrada.");
            return;
        }

        $tarifa = $this->view->getInput("Ingrese la tarifa del viaje:");
        if (!is_numeric($tarifa) || $tarifa <= 0) {
            $this->view->showMessage("Tarifa inválida.");
            return;
        }

        $viaje = new Viaje($rutaSeleccionada, $transportistaSeleccionado);
        $viaje->setTarifa((float)$tarifa);
        $viaje->setEstado('En curso');
        $this->db->agregarViaje($viaje);

        $transportistaSeleccionado->setDisponible(false);
        $this->db->actualizarTransportista($transportistaSeleccionado);

        $this->view->mostrarResumenViaje($viaje);
    }

    public function listar(): void
    {
        $viajes = $this->db->getViajes();
        $this->view->displayListViajes($viajes);
    }

    public function eliminar(): void
    {
        $viajes = $this->db->getViajes();
        if (count($viajes) === 0) {
            $this->view->showMessage("No hay viajes registrados para eliminar.");
            return;
        }

        $this->view->displayListViajes($viajes);
        $id = $this->view->getInput("Ingrese el ID del viaje a eliminar:");

        foreach ($viajes as $index => $v) {
            if ($v->getId() == (int)$id) {
                $this->db->eliminarViaje($index);
                $this->view->showMessage("Viaje eliminado correctamente.");
                return;
            }
        }

        $this->view->showMessage("ID de viaje no encontrado.");
    }

    public function modificar(): void
    {
        $viajes = $this->db->getViajes();
        if (count($viajes) === 0) {
            $this->view->showMessage("No hay viajes registrados para modificar.");
            return;
        }

        $this->view->displayListViajes($viajes);
        $id = $this->view->getInput("Ingrese el ID del viaje a modificar:");

        foreach ($viajes as $v) {
            if ($v->getId() == (int)$id) {
                $tarifa = $this->view->getInput("Ingrese nueva tarifa (actual: {$v->getTarifa()}):");
                if (is_numeric($tarifa) && $tarifa > 0) {
                    $v->setTarifa((float)$tarifa);
                    $this->db->setViajes($viajes);
                    $this->view->showMessage("Tarifa actualizada correctamente.");
                } else {
                    $this->view->showMessage("Tarifa inválida.");
                }
                return;
            }
        }

        $this->view->showMessage("ID de viaje no encontrado.");
    }

    public function modificarEstado(): void
{
    $viajes = $this->db->getViajes();
    if (count($viajes) === 0) {
        $this->view->showMessage("No hay viajes registrados.");
        return;
    }

    $this->view->displayListViajes($viajes);
    $id = $this->view->getInput("Ingrese el ID del viaje a modificar estado:");

    foreach ($viajes as $v) {
        if ($v->getId() == (int)$id) {
            $estadoActual = $v->getEstado();
            $nuevoEstado = $this->view->getInput("Estado actual: $estadoActual. Ingrese nuevo estado:");

            $v->setEstado($nuevoEstado);
            $this->db->setViajes($viajes);

            // ✅ Si el estado es "Finalizado", liberar al chofer
            if (strtolower($nuevoEstado) === 'finalizado' || strtolower($nuevoEstado) === 'terminado') {
                $chofer = $v->getTransportista();
                $chofer->setDisponible(true);
                $this->db->actualizarTransportista($chofer);
                $this->view->showMessage("Estado actualizado a '$nuevoEstado' y chofer liberado.");
            } else {
                $this->view->showMessage("Estado actualizado a '$nuevoEstado'.");
            }
            return;
        }
    }

    $this->view->showMessage("ID de viaje no encontrado.");
}

    

    public function modificarTransportistaEnViaje(): void
    {
        $viajes = $this->db->getViajes();
        $transportistas = $this->db->getTransportistas();

        if (count($viajes) === 0) {
            $this->view->showMessage("No hay viajes registrados.");
            return;
        }

        $this->view->displayListViajes($viajes);
        $id = $this->view->getInput("Ingrese el ID del viaje a modificar transportista:");

        foreach ($viajes as $v) {
            if ($v->getId() == (int)$id) {
                $viajesEnCurso = array_filter($this->db->getViajes(), fn($vj) => $vj->getEstado() === 'En curso');
                $ocupados = array_map(fn($vj) => $vj->getTransportista()->getId(), $viajesEnCurso);

                $disponibles = array_filter($transportistas, fn($t) =>
                    $t->isDisponible() && !in_array($t->getId(), $ocupados)
                );

                if (count($disponibles) === 0) {
                    $this->view->showMessage("No hay transportistas disponibles para reasignar.");
                    return;
                }

                $this->view->mostrarTransportistas($disponibles);
                $nuevoId = $this->view->getInput("Ingrese el ID del nuevo transportista:");
                $nuevoTransportista = $this->db->getTransportistaPorId((int)$nuevoId);

                if ($nuevoTransportista && !in_array($nuevoTransportista->getId(), $ocupados)) {
                    $v->setTransportista($nuevoTransportista);
                    $this->db->setViajes($viajes);

                    $nuevoTransportista->setDisponible(false);
                    $this->db->actualizarTransportista($nuevoTransportista);

                    $this->view->showMessage("Transportista actualizado correctamente.");
                } else {
                    $this->view->showMessage("ID de transportista no válido o está ocupado.");
                }
                return;
            }
        }

        $this->view->showMessage("ID de viaje no encontrado.");
    }
}
