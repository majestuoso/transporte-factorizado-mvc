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

    public function modificar(): void
{
    $rutas = $this->db->getRutas();
    if (count($rutas) === 0) {
        $this->view->showMessage("No hay rutas registradas.");
        return;
    }

    $this->view->displayList($rutas);
    $id = $this->view->getInput("Ingrese el ID de la ruta a modificar:");

    foreach ($rutas as $r) {
        if ($r->getId() == (int)$id) {
            $nuevoNombre = $this->view->getInput("Nuevo nombre (actual: {$r->getNombre()}):");
            $nuevaDistancia = $this->view->getInput("Nueva distancia (actual: {$r->getDistancia()} km):");

            if (!empty($nuevoNombre)) $r->setNombre($nuevoNombre);
            if (is_numeric($nuevaDistancia) && $nuevaDistancia > 0) $r->setDistancia((float)$nuevaDistancia);

            $this->db->setRutas($rutas);
            $this->view->showMessage("Ruta modificada correctamente.");
            return;
        }
    }

    $this->view->showMessage("ID de ruta no encontrado.");
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