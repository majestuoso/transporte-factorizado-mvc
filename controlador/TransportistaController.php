<?php

require_once(__DIR__ . '/../db/DB.php');
require_once(__DIR__ . '/../modelo/Transportista.php');
require_once(__DIR__ . '/../vista/TransportistaView.php');

class TransportistaController
{
    private $db;
    private $view;

    public function __construct()
    {
        $this->db = DB::getInstance();
        $this->view = new TransportistaView();
    }

    public function agregar(): void
    {
        $data = $this->view->showAddForm();

        $transportista = new Transportista($data['nombre'], $data['apellido']);
        $transportista->setDisponible($data['disponible']);
        $transportista->setVehiculo($data['vehiculo']);
        $transportista->setNota($data['nota']);

        $this->db->agregarTransportista($transportista);

        $this->view->showMessage("\n\033[1;32mTransportista agregado:\033[0m");
        $this->view->imprimirEncabezado();
        $this->view->imprimirFilaTransportista($transportista);
    }

    public function listar(): void
    {
        $transportistas = $this->db->getTransportistas();

        if (count($transportistas) === 0) {
            $this->view->showMessage("No hay transportistas registrados.");
            return;
        }

        $this->view->showMessage("\n\033[1;36mListado de Transportistas:\033[0m");
        $this->view->imprimirEncabezado();
        foreach ($transportistas as $t) {
            $this->view->imprimirFilaTransportista($t);
        }
    }

    public function modificar(): void
    {
        $transportistas = $this->db->getTransportistas();
        if (count($transportistas) === 0) {
            $this->view->showMessage("No hay transportistas registrados.");
            return;
        }

        $this->listar();
        $id = $this->view->getInput(str_pad("Ingrese el ID del chofer a modificar:", 40));

        foreach ($transportistas as $t) {
            if ($t->getId() == (int)$id) {
                $nuevoNombre = $this->view->getInput(str_pad("Nuevo nombre (actual: {$t->getNombre()}):", 40));
                $nuevoApellido = $this->view->getInput(str_pad("Nuevo apellido (actual: {$t->getApellido()}):", 40));
                $nuevoVehiculo = $this->view->getInput(str_pad("Nuevo vehículo (actual: {$t->getVehiculo()}):", 40));
                $nuevoDisponible = $this->view->getInput(str_pad("¿Disponible? (sí/no, actual: " . ($t->isDisponible() ? 'sí' : 'no') . "):", 40));
                $nuevaNota = $this->view->getInput(str_pad("Nota (actual: " . ($t->getNota() ?? 'ninguna') . "):", 40));

                if (!empty($nuevoNombre)) $t->setNombre($nuevoNombre);
                if (!empty($nuevoApellido)) $t->setApellido($nuevoApellido);
                if (!empty($nuevoVehiculo)) $t->setVehiculo($nuevoVehiculo);
                if (strtolower($nuevoDisponible) === 'sí') $t->setDisponible(true);
                elseif (strtolower($nuevoDisponible) === 'no') $t->setDisponible(false);
                if (!empty($nuevaNota)) $t->setNota($nuevaNota);

                $this->db->setTransportistas($transportistas);
                $this->view->showMessage("\n\033[1;32mChofer modificado correctamente:\033[0m");
                $this->view->imprimirEncabezado();
                $this->view->imprimirFilaTransportista($t);
                return;
            }
        }

        $this->view->showMessage("ID de chofer no encontrado.");
    }

    public function eliminar(): void
    {
        $transportistas = $this->db->getTransportistas();
        if (count($transportistas) === 0) {
            $this->view->showMessage("No hay transportistas registrados para eliminar.");
            return;
        }

        $this->listar();
        $id = $this->view->getInput(str_pad("Ingrese el ID del chofer a eliminar:", 40));

        foreach ($transportistas as $indice => $t) {
            if ($t->getId() == (int)$id) {
                $this->db->borrarTransportistaPorIndice($indice);
                $this->view->showMessage("\033[1;31mTransportista eliminado correctamente.\033[0m");
                return;
            }
        }

        $this->view->showMessage("Transportista no encontrado.");
    }

    public function listarDisponibles(): void
    {
        $transportistas = $this->db->getTransportistas();
        $disponibles = array_filter($transportistas, fn($t) => $t->isDisponible());

        if (count($disponibles) === 0) {
            $this->view->showMessage("No hay transportistas disponibles.");
            return;
        }

        $this->view->showMessage("\n\033[1;36mTransportistas disponibles:\033[0m");
        $this->view->imprimirEncabezado();
        foreach ($disponibles as $t) {
            $this->view->imprimirFilaTransportista($t);
        }
    }
}
