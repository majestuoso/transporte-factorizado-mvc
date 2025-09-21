<?php

require_once(__DIR__ . '/../modelo/ViajeModel.php');
require_once(__DIR__ . '/../vista/ViajeView.php');

class ViajeController
{
    private ViajeModel $model;
    private ViajeView $view;

    public function __construct()
    {
        $this->model = new ViajeModel();
        $this->view = new ViajeView();
    }

    public function crear(): void
    {
        $datos = $this->view->solicitarDatos();
        if (empty($datos)) return;

        $viaje = $this->model->crearYGuardar($datos);
        if ($viaje) {
            $this->view->mostrarResumen($viaje);
        } else {
            $this->view->showMessage("❌ No se pudo registrar el viaje.");
        }
    }

    public function listar(): void
    {
        $viajes = $this->model->listar();
        $this->view->mostrarViajes($viajes);
    }

    public function eliminar(): void
    {
        echo "\n\033[1;34m🗑️ Eliminación de viaje\033[0m\n";

        $this->listar();
  
        $id = $this->view->solicitarId();
        $ok = $this->model->eliminar($id);

        $mensaje = $ok ? "✅ Viaje eliminado." : "❌ No se pudo eliminar el viaje.";
        $this->view->showMessage($mensaje);
    }

    public function modificar(): void
    {
        echo "\n\033[1;34m🔧 Entrando a modificación de viaje...\033[0m\n";

        $this->listar();

        $id = $this->view->solicitarId();
        $viaje = $this->model->buscarPorId($id);

        if (!$viaje) {
            $this->view->showMessage("❌ Viaje no encontrado.");
            return;
        }
        $this->view->mostrarResumen($viaje);
        echo "\n\033[1;33m🛠️ Opciones de modificación:\033[0m\n";
        echo " \033[1;32m[1]\033[0m 💰 Modificar Tarifa de Viaje\n";
        echo " \033[1;32m[2]\033[0m 🧍 Modificar Transportista en Viaje\n";
        echo " \033[1;32m[3]\033[0m 🛣️  Modificar Ruta en Viaje\n";
        echo " \033[1;32m[4]\033[0m 📌 Modificar Estado de Viaje\n";
        echo " \033[1;32m[5]\033[0m 🗒️  Modificar Nota de Viaje\n";

        $opcion = (int)trim(readline("Seleccione opción: "));
        $ok = false;

        switch ($opcion) {
            case 1:
                $tarifa = $this->view->solicitarTarifa();
                $ok = $this->model->modificarTarifa($id, $tarifa);
                break;
            case 2:
                $tid = $this->view->solicitarTransportistaId();
                $ok = $this->model->modificarTransportista($id, $tid);
                break;
            case 3:
                $rid = $this->view->solicitarRutaId();
                $ok = $this->model->modificarRuta($id, $rid);
                break;
            case 4:
                $estado = $this->view->solicitarEstado();
                $ok = $this->model->modificarEstado($id, $estado);
                break;
            case 5:
                $nota = trim(readline("Ingrese nueva nota del viaje: "));
                $viaje->setNota($nota !== '' ? $nota : null);
                $ok = true;
                break;
            default:
                $this->view->showMessage("❌ Opción inválida.");
                return;
        }

        $mensaje = $ok ? "✅ Modificación realizada." : "❌ No se pudo modificar.";
        $this->view->showMessage($mensaje);
    }
}
