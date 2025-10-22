<?php
require_once(__DIR__ . '/../modelo/UsuarioModel.php');
require_once(__DIR__ . '/../vista/View.php');

class LoginController
{
    public function loginCliente(): void
    {
        $this->procesarLogin('cliente');
    }

    public function loginPersonal(): void
    {
        $this->procesarLogin('personal');
    }

    private function procesarLogin(string $rolEsperado): void
    {
        session_start();
        $usuario = $_POST['usuario'] ?? '';
        $clave = $_POST['clave'] ?? '';

        $model = new UsuarioModel();
        $datos = $model->buscarPorUsuario($usuario);

        if ($datos && password_verify($clave, $datos['clave']) && $datos['rol'] === $rolEsperado) {
            $_SESSION['usuario'] = ucfirst($datos['usuario']);
            $_SESSION['rol'] = $datos['rol'];
            header("Location: ?path=panel_" . $rolEsperado);
            exit;
        } else {
            echo "<p style='color:red;'>Usuario o contraseña incorrectos</p>";
            echo "<a href='?path=inicio'>🔙 Volver</a>";
        }
    }

    public function registro(): void
    {
        $view = new View();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_POST['usuario'] ?? '';
            $clave = $_POST['clave'] ?? '';
            $rol = $_POST['rol'] ?? '';

            if ($usuario && $clave && in_array($rol, ['cliente', 'personal'])) {
                $claveHash = password_hash($clave, PASSWORD_DEFAULT);
                $model = new UsuarioModel();
                $exito = $model->crear($usuario, $claveHash, $rol);

                if ($exito) {
                    $mensaje = "✅ Usuario creado correctamente. Ahora podés iniciar sesión.";
                    $view->render('registro.tpl', ['mensaje' => $mensaje]);
                    return;
                } else {
                    $mensaje = "⚠️ El usuario ya existe.";
                }
            } else {
                $mensaje = "⚠️ Datos incompletos.";
            }

            $view->render('registro.tpl', ['mensaje' => $mensaje]);
        } else {
            $view->render('registro.tpl');
        }
    }

    public function logout(): void
    {
        session_start();
        session_destroy();
        header("Location: ?path=inicio");
        exit;
    }

    public function mostrarFormularioRegistro(): void
    {
        $view = new View();
        $view->render('registro.tpl');
    }
}
