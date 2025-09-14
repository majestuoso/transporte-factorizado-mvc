<?php
// Usamos __DIR__ para que las rutas sean absolutas y no dependan de la ubicación de ejecución.
// Incluye las clases necesarias de las capas Modelo, Vista y la clase DB
// La ruta ahora va desde el controlador, sube un nivel (..), y entra a la carpeta 'db'.
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
        $data = $this->view->showAddForm();

        $transportista = new Transportista($data['nombre'], $data['apellido']);
        $transportista->setDisponible($data['disponible']);
        $transportista->setVehiculo($data['vehiculo']);

        $this->db->agregarTransportista($transportista);

        $this->view->showMessage("\033[1;35mTransportista agregado correctamente.\n");
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
            $this->view->showMessage("Transportista con ID '$id' no encontrado.");
            return;
        }

        $data = $this->view->showModificationForm($transportistaEncontrado);

        if (!empty($data['nombre'])) {
            $transportistaEncontrado->setNombre($data['nombre']);
        }
        if (!empty($data['apellido'])) {
            $transportistaEncontrado->setApellido($data['apellido']);
        }
        if (strtolower($data['cambiarDisponibilidad']) === 's') {
            $this->view->showMessage("Ingrese la nueva disponibilidad (s/n): ");
            $nuevaDisponibilidad = trim(fgets(STDIN));
            $disponible = strtolower($nuevaDisponibilidad) === 's' ? true : false;
            $transportistaEncontrado->setDisponible($disponible);
        }
        if (!empty($data['nuevoVehiculo'])) {
            $transportistaEncontrado->setVehiculo($data['nuevoVehiculo']);
        }

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

        $transportistaEncontrado = false;
        foreach ($transportistas as $indice => $t) {
            if ($t->getId() == $id) {
                $transportistaEncontrado = true;
                $this->db->borrarTransportistaPorIndice($indice);
                break;
            }
        }

        if ($transportistaEncontrado === false) {
            $this->view->showMessage("Transportista no encontrado.");
            return;
        }

        $this->view->showMessage("Transportista eliminado correctamente.");
    }
}