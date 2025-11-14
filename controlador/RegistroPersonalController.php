<?php
require_once(__DIR__ . '/../modelo/PersonalModel.php');
require_once(__DIR__ . '/../vista/View.php');

class RegistroPersonalController
{
    private PersonalModel $personalModel;

    public function __construct()
    {
        $this->personalModel = new PersonalModel();
    }

    public function registrar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $view = new View();
            $view->render('registro.tpl');
            return;
        }

        $usuario = trim($_POST['usuario'] ?? '');
        $nombre  = trim($_POST['nombre'] ?? '');
        $clave   = trim($_POST['clave'] ?? '');

        if (empty($usuario) || empty($nombre) || empty($clave)) {
            $mensaje = "⚠️ Usuario, nombre y clave son obligatorios.";
            $view = new View();
            $view->render('registro.tpl', ['mensaje' => $mensaje]);
            return;
        }

        try {
            $id = $this->personalModel->agregar([
                'usuario'   => $usuario,
                'clave'     => $clave, // el modelo hace el hash
                'nombre'    => $nombre,
                'estado_id' => 1
            ]);

            if ($id) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                $_SESSION['nombre']  = ucfirst($nombre);
                $_SESSION['rol']     = 'personal';
                header("Location: ?path=panel_personal");
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
