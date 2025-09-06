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

    public function agregar()
    {
        $data = $this->view-> showAddForm();
        $transportista = new Transportista($data['nombre'], $data['vehiculo']);
        $transportista->agregar();
        $this->view->showMessage("Transportista agregado: " . $transportista->getNombre() . " con vehículo " . $transportista->getVehiculo() . ".\n");
    }

    public function listar()
    {
        $transportistas = $this->db->getTransportistas();
        $this->view->displayList($transportistas);
    }

    public function modificar()
    {
        $transportistas = $this->db->getTransportistas();
        if (count($transportistas) == 0) {
            $this->view->showMessage("No hay transportistas registrados para modificar.");
            return;
        }

        $this->view->displayList($transportistas);
        $id = $this->view->getIdPrompt();

        $transportistaEncontrado = null;
        foreach ($transportistas as $transportista) {
            if ($transportista->getId() == $id) {
                $transportistaEncontrado = $transportista;
                break;
            }
        }

        if ($transportistaEncontrado === null) {
            $this->view->showMessage("Transportista no encontrado.");
            return;
        }

        $data = $this->view->showModificationForm($transportista);
        
        
        $transportistaEncontrado->modificar($data);
        $this->db->setTransportistas($transportistas);
        $this->view->showMessage("Transportista modificado correctamente.");
    }

    public function eliminar()
    {
        $transportistas = $this->db->getTransportistas();
        if (count($transportistas) == 0) {
            $this->view->showMessage("No hay transportistas registrados para eliminar.");
            return;
        }

        $this->view->displayList($transportistas);
        $id = $this->view->getIdPrompt();

        $transportistaEncontrado = null;
        foreach ($transportistas as $indice => $t) {
            if ($t->getId() == $id) {
                $transportistaEncontrado = $t;
                $this->db->eliminarTransportista($indice);
                break;
            }
        }

        if ($transportistaEncontrado === null) {
            $this->view->showMessage("Transportista no encontrado.");
            return;
        }

        $this->view->showMessage("Transportista eliminado correctamente.");
    }
}
?>