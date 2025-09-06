<?php



require_once(__DIR__ . '/../db/DB.php');
require_once(__DIR__ . '/../modelo/Viaje.php');
require_once(__DIR__ . '/../modelo/Ruta.php');
require_once(__DIR__ . '/../modelo/Transportista.php');
require_once(__DIR__ . '/../vista/ViajeView.php');

class ViajeController
{
    private $db;
    private $view;

    public function __construct()
    {
        $this->db = DB::getInstance();
        $this->view = new ViajeView();
    }

    public function agregar()
    {
        $rutas = $this->db->getRutas();
        $transportistas = $this->db->getTransportistas();
        
        if (count($rutas) == 0 || count($transportistas) == 0) {
            $this->view->showMessage("No hay suficientes datos (rutas o transportistas) para crear un viaje.\n");
            return;
        }

        $data = $this->view->showAddForm($rutas, $transportistas);

        $rutaSeleccionada = $this->db->getRutaporId($data['ruta_id']);
        $transportistaSeleccionado = $this->db->getTransportistaPorId($data['transportista_id']);

        if (!$rutaSeleccionada || !$transportistaSeleccionado) {
            $this->view->showMessage("ID de ruta o transportista no válido.\n");
            return;
        }
        
        $viaje = new Viaje($rutaSeleccionada, $transportistaSeleccionado);
        $viaje->setTarifa($data['tarifa']);
        
        $this->db->agregarViaje($viaje);

        $this->view->showMessage("Viaje agregado correctamente.\n");
    }

    public function listar()
    {
        $viajes = $this->db->getViajes();
        $this->view->MostrarViajes($viajes);
    }
    public function eliminar()
    {
        $viajes = $this->db->getViajes();
        if (count($viajes) == 0) {
            $this->view->showMessage("No hay viajes registrados para eliminar.\n");
            return;
        }

        $this->view->MostrarViajes($viajes);
        $id = $this->view->promptForId();

        $viajeEncontrado = null;
        foreach ($viajes as $viaje) {
            if ($viaje->getId() == $id) {
                $viajeEncontrado = $viaje;
                break;
            }
        }

        if ($viajeEncontrado === null) {
            $this->view->showMessage("Viaje con ID '$id' no encontrado.\n");
            return;
        }

        $this->db->eliminarViaje($id);
        $this->view->showMessage("Viaje con ID '$id' eliminado correctamente.\n");
    }
}