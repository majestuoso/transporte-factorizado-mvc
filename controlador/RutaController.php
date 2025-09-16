<?php



require_once(__DIR__ . '/../db/DB.php');
require_once(__DIR__ . '/../modelo/RutaModel.php');
require_once(__DIR__ . '/../vista/RutaView.php');
require_once(__DIR__ . '/../main.php');
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

    public function agregar(): void
    {
        $datos = $this->view->solicitarDatos();
        $t = $this->model->crearYGuardar($datos);

        if ($t) {
            $this->view->mostrarResumen($t);
        } else {
            $this->view->showMessage("Datos inválidos. No se pudo registrar ninguna ruta.");
        }
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
    public function agregarDesdeDatos(array $datos): void
{
    $nombre = trim($datos['nombre'] ?? '');
    $distanciaTexto = trim($datos['distancia'] ?? '');

    if ($nombre === '' || $distanciaTexto === '') return;

    $distancia = (float)filter_var($distanciaTexto, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    if ($distancia <= 0) return;

    $ruta = new Ruta($distancia, $nombre);
    DB::getInstance()->agregarRuta($ruta);
}

}
