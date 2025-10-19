<?php

require_once(__DIR__ . '/../db/DB.php');
require_once(__DIR__ . '/../modelo/RutaModel.php');
require_once(__DIR__ . '/../vista/RutaView.php');
require_once(__DIR__ . '/../modelo/Ruta.php');

class RutaController
{
    private RutaView $view;
    private RutaModel $model;

    public function __construct()
    {
        $this->view = new RutaView();
        $this->model = new RutaModel();
    }

    public function index(): void
    {
        $this->view->mostrarInicio();
    }

    public function listar(): void
    {
        $rutas = $this->model->listar();

        if (empty($rutas)) {
            $this->view->showMessage("No hay rutas registradas.");
            return;
        }

        $this->view->mostrarRutas($rutas);
    }

    public function agregar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = $_POST;
            $ruta = $this->model->crearYGuardar($datos);

            if ($ruta) {
                $this->view->mostrarResumen($ruta);
            } else {
                $this->view->showMessage("Datos inválidos. No se pudo registrar ninguna ruta.");
            }
        } else {
            $this->view->mostrarFormularioAgregar();
        }
    }

    public function modificar(): void
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $id = (int) $_POST['id'];
        $this->model->modificarDesdeFormulario($id, $_POST);
        $this->view->showMessage("Ruta modificada correctamente.");
    } elseif (isset($_GET['id'])) {
        $id = (int) $_GET['id'];
        $ruta = $this->model->buscarPorId($id);
        if ($ruta) {
            $this->view->mostrarFormularioModificar($ruta);
        } else {
            $this->view->showMessage("Ruta no encontrada.");
        }
    } else {
        $rutas = $this->model->listar();
        $this->view->mostrarSelectorModificar($rutas);
    }
}


   public function eliminar(): void
{
    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];
        $ruta = $this->model->buscarPorId($id);

        if ($ruta) {
            $this->model->eliminar($id);
            $this->view->showMessage("Ruta #$id eliminada correctamente.");
        } else {
            $this->view->showMessage("Ruta no encontrada.");
        }
    } else {
        $rutas = $this->model->listar();
        $this->view->mostrarSelectorEliminar($rutas);
    }
}

}
