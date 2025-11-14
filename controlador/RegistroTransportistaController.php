<?php
require_once(__DIR__ . '/../modelo/TransportistaModel.php');
require_once(__DIR__ . '/../vista/View.php');

class RegistroTransportistaController
{
    private TransportistaModel $transportistaModel;

    public function __construct()
    {
        $this->transportistaModel = new TransportistaModel();
    }

    public function registrar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $view = new View();
            $view->render('registro.tpl');
            return;
        }

        $usuario   = trim($_POST['usuario'] ?? '');
        $nombre    = trim($_POST['nombre'] ?? '');
        $apellido  = trim($_POST['apellido'] ?? '');
        $vehiculo  = trim($_POST['vehiculo'] ?? '');
        $nota      = trim($_POST['nota'] ?? '');
        $clave     = trim($_POST['clave'] ?? '');

        if (empty($usuario) || empty($nombre) || empty($apellido) || empty($vehiculo) || empty($clave)) {
            $mensaje = "⚠️ Usuario, nombre, apellido, vehículo y clave son obligatorios.";
            $view = new View();
            $view->render('registro.tpl', ['mensaje' => $mensaje]);
            return;
        }

        try {
            $id = $this->transportistaModel->agregar([
                'usuario'   => $usuario,
                'clave'     => $clave, // el modelo hace el hash
                'nombre'    => $nombre,
                'apellido'  => $apellido,
                'vehiculo'  => $vehiculo,
                'nota'      => $nota,
                'estado_id' => 1
            ]);

            if ($id) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                $_SESSION['nombre']  = ucfirst($nombre);
                $_SESSION['rol']     = 'transportista';
                header("Location: ?path=panel_transportista");
                exit;
            } else {
                $mensaje = "⚠️ El usuario ya existe, elige otro.";
                $view = new View();
                $view->render('registro.tpl', ['mensaje' => $mensaje]);
            }
        } catch (Exception $e) {
            $mensaje = "❌ Error inesperado: " . $e->getMessage();
            $view = new View();
            $view->render('registro.tpl', ['mensaje' => $mensaje]);
        }
    }
}
