<?php



// Incluye las clases necesarias de las capas Modelo, Vista y la clase DB
// La ruta ahora va desde el controlador, sube un nivel (..), y entra a la carpeta 'db'.
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
        $data = $this->view->showAddForm();

        $ruta = new Rutas($data['distancia'], $data['nombre']);
        $this->db->agregarRuta($ruta);

        $this->view->showMessage("Ruta agregada: " . $ruta);
    }

    public function listar()
    {
        $rutas = $this->db->getRutas();
        $this->view->displayList($rutas);
    }

    public function modificar()
    {
        $rutas = $this->db->getRutas();
        if (count($rutas) == 0) {
            $this->view->showMessage("No hay rutas registradas para modificar.");
            return;
        }

        $this->view->displayList($rutas);
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

        $data = $this->view->showModificationForm();

        if (!empty($data['nuevoNombre'])) {
            $rutaEncontrada->setNombre($data['nuevoNombre']);
        }

        if (!empty($data['nuevaDistancia'])) {
            if (!is_numeric($data['nuevaDistancia']) || $data['nuevaDistancia'] <= 0) {
                $this->view->showMessage("La distancia debe ser un número positivo.\n");
                return;
            }
            $rutaEncontrada->setDistancia($data['nuevaDistancia']);
        }

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

        $this->view->displayList($rutas);
        $id = $this->view->getIdPrompt();

        $rutaEncontrada = false;
        foreach ($rutas as $indice => $t) {
            if ($t->getId() == $id) {
                $rutaEncontrada = true;
                $this->db->eliminarRuta($indice);
                break;
            }
        }

        if ($rutaEncontrada === false) {
            $this->view->showMessage("Ruta no encontrada.");
            return;
        }

        $this->view->showMessage("Ruta eliminada correctamente.");
    }
}