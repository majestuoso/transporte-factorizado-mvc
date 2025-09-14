<?php

// Incluye las clases necesarias de las capas Modelo, Vista y la clase DB
// La ruta ahora va desde el controlador, sube un nivel (..), y entra a la carpeta 'db'.
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
}