<?php



require_once(__DIR__ . '/../modelo/TransportistaModel.php');
require_once(__DIR__ . '/../vista/TransportistaView.php');
require_once(__DIR__ . '/../modelo/Transportista.php');


class TransportistaController
{
    private TransportistaView $view;
    private TransportistaModel $model;

    public function __construct()
    {
        $this->view = new TransportistaView();
        $this->model = new TransportistaModel();
    }

    public function agregar(): void
    {
        $datos = $this->view->solicitarDatos();
        $t = $this->model->crearYGuardar($datos);

        if ($t) {
            $this->view->mostrarResumen($t);
        } else {
            $this->view->showMessage("Datos inválidos. No se pudo registrar el transportista.");
        }
    }



    public function listar(): void
    {
        $transportistas = $this->model->listar();

        if (empty($transportistas)) {
            $this->view->showMessage("No hay transportistas registrados.");
            return;
        }

        $this->view->mostrarTransportistas($transportistas);
    }

    public function agregarDesdeDatos(array $datos): void
    {
        $transportista = new Transportista($datos['nombre'], $datos['apellido']);
        $transportista->setDisponible($datos['disponible'] ?? false);
        $transportista->setVehiculo($datos['vehiculo'] ?? '');
        $transportista->setNota($datos['nota'] ?? null);

        DB::getInstance()->agregarTransportista($transportista);
    }
}
