<?php
require_once(__DIR__ . '/../modelo/ViajeModel.php');
require_once(__DIR__ . '/../modelo/TransportistaModel.php');
require_once(__DIR__ . '/../modelo/RutaModel.php');
require_once(__DIR__ . '/../vista/ViajeView.php');

class ViajeController
{
    private ViajeModel $model;
    private TransportistaModel $transportistaModel;
    private RutaModel $rutaModel;
    private ViajeView $view;

    public function __construct()
    {
        $this->model = new ViajeModel();
        $this->transportistaModel = new TransportistaModel();
        $this->rutaModel = new RutaModel();
        $this->view = new ViajeView();
    }

    public function listar(): void
    {
        $viajes = $this->model->listar();
        $transportistas = $this->transportistaModel->listar();
        $rutas = $this->rutaModel->listar();

        $viajesEnriquecidos = array_map(function ($v) use ($transportistas, $rutas) {
            $t = array_filter($transportistas, fn($t) => $t->getId() === $v->getTransportistaId());
            $r = array_filter($rutas, fn($r) => $r->getId() === $v->getRutaId());

            $nombreT = $t ? reset($t)->getNombre() . ' ' . reset($t)->getApellido() : "ID {$v->getTransportistaId()}";
            $nombreR = $r ? reset($r)->getNombre() : "ID {$v->getRutaId()}";

            return [
                'id' => $v->getId(),
                'tarifa' => $v->getTarifa(),
                'transportista' => "{$v->getTransportistaId()} - $nombreT",
                'ruta' => "{$v->getRutaId()} - $nombreR",
                'estado' => $v->getEstado(),
                'nota' => $v->getNota()
            ];
        }, $viajes);

        $this->view->mostrarViajes($viajesEnriquecidos);
    }

    public function agregar(): void
    {
        $transportistas = $this->transportistaModel->listarDisponibles();
        $rutas = $this->rutaModel->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = $_POST;
            $viaje = $this->model->crearYGuardar($datos);
            if ($viaje) {
                $this->view->mostrarResumen($viaje);
            } else {
                $this->view->showMessage("No se pudo registrar el viaje.");
            }
        } else {
            $this->view->formularioAgregar($transportistas, $rutas);
        }
    }

    public function eliminar(): void
    {
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $ok = $this->model->eliminar($id);
            $mensaje = $ok ? "Viaje eliminado correctamente." : "No se pudo eliminar el viaje.";
            $this->view->showMessage($mensaje);
        } else {
            $viajes = $this->model->listar();
            $this->view->mostrarViajesConEliminar($viajes);
        }
    }

    public function modificar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)$_POST['id'];
            $campo = $_POST['campo'] ?? '';
            $valor = $_POST['valor'] ?? '';

            if ($campo === 'tarifa') {
                $valor = (float)$valor;
            } elseif ($campo === 'transportista' || $campo === 'ruta') {
                $valor = (int)$valor;
            } elseif ($campo === 'nota' && $valor === '') {
                $valor = null;
            }

            $mapa = [
                'transportista' => 'transportistaId',
                'ruta' => 'rutaId',
                'estado' => 'estado',
                'tarifa' => 'tarifa',
                'nota' => 'nota'
            ];

            $clave = $mapa[$campo] ?? null;
            $ok = $clave ? $this->model->modificar($id, [$clave => $valor]) : false;

            $mensaje = $ok ? "Modificación realizada correctamente." : "No se pudo modificar el viaje.";
            $this->view->showMessage($mensaje);
        } elseif (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $viaje = $this->model->buscarPorId($id);
            if ($viaje) {
                $this->view->formularioModificar($viaje);
            } else {
                $this->view->showMessage("Viaje no encontrado.");
            }
        } else {
            $viajes = $this->model->listar();
            $transportistas = $this->transportistaModel->listar();
            $rutas = $this->rutaModel->listar();

            $viajesEnriquecidos = array_map(function ($v) use ($transportistas, $rutas) {
                $t = array_filter($transportistas, fn($t) => $t->getId() === $v->getTransportistaId());
                $r = array_filter($rutas, fn($r) => $r->getId() === $v->getRutaId());

                $nombreT = $t ? reset($t)->getNombre() . ' ' . reset($t)->getApellido() : "ID {$v->getTransportistaId()}";
                $nombreR = $r ? reset($r)->getNombre() : "ID {$v->getRutaId()}";

                return [
                    'id' => $v->getId(),
                    'tarifa' => $v->getTarifa(),
                    'transportista' => "{$v->getTransportistaId()} - $nombreT",
                    'ruta' => "{$v->getRutaId()} - $nombreR",
                    'estado' => $v->getEstado(),
                    'nota' => $v->getNota()
                ];
            }, $viajes);

            $this->view->mostrarViajesConModificar($viajesEnriquecidos);
        }
    }
}
