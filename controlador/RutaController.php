<?php
require_once(__DIR__ . '/../db/DB.php');
require_once(__DIR__ . '/../modelo/Ruta.php');
require_once(__DIR__ . '/../vista/RutaView.php');

class RutaController
{
    private $db;
    private $view;

    public function __construct()
    {
        $this->db = DB::getInstance();
        $this->view = new RutaView();
    }

    public function agregar()
    {
        $data = $this->view->MostrarAgregarRuta();
        $ruta = new Ruta($data['distancia'], $data['nombre']);
        $ruta->agregar(); // Let the model handle its own persistence
        $this->view->showMessage("Ruta agregada: " . $ruta->getNombre() . " con distancia " . $ruta->getDistancia() . " km.\n");
    }

    public function listar()
    {
        $rutas = $this->db->getRutas();
        $this->view->MostrarLista($rutas);
    }

    public function modificar()
    {
        $rutas = $this->db->getRutas();
        if (count($rutas) == 0) {
            $this->view->showMessage("No hay rutas registradas para modificar.");
            return;
        }

        $this->view->MostrarLista($rutas);
        $id = $this->view->getIdPrompt();

        $rutaEncontrada = null;
        foreach ($rutas as $ruta) {
            if ($ruta->getId() == $id) {
                $rutaEncontrada = $ruta;
                break;
            }
        }

        if ($rutaEncontrada === null) {
            $this->view->showMessage("Ruta no encontrada.");
            return;
        }

        $data = $this->view->MostrarModificarRuta();

        // Let the model handle its own modification logic
        $rutaEncontrada->modificar($data);
        $this->db->setRutas($rutas);
        $this->view->showMessage("Ruta modificada correctamente.");
    }

    public function eliminar()
    {
        $rutas = $this->db->getRutas();
        if (count($rutas) == 0) {
            $this->view->showMessage("No hay rutas registradas para eliminar.");
            return;
        }

        $this->view->mostrarLista($rutas);
        $id = $this->view->getIdPrompt();

        $rutaEncontrada = null;
        foreach ($rutas as $indice => $t) {
            if ($t->getId() == $id) {
                $rutaEncontrada = $t;
                $this->db->eliminarRuta($indice);
                break;
            }
        }

        if ($rutaEncontrada === null) {
            $this->view->showMessage("Ruta no encontrada.");
            return;
        }

        $this->view->showMessage("Ruta eliminada correctamente.");
    }
}
?>