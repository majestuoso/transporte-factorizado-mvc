<?php
declare(strict_types=1);

require_once(__DIR__ . '/../modelo/PersonalModel.php');
require_once(__DIR__ . '/../modelo/TransportistaModel.php');
require_once(__DIR__ . '/../vista/View.php');

class LoginController
{
    private PersonalModel $personalModel;
    private TransportistaModel $transportistaModel;

    public function __construct()
    {
        $this->personalModel = new PersonalModel();
        $this->transportistaModel = new TransportistaModel();
    }

    // ---------------- LOGIN PERSONAL ----------------
    public function loginPersonal(): void
    {
        session_start();
        $nombre = $_POST['nombre'] ?? '';
        $clave  = $_POST['clave'] ?? '';

        $datos = $this->personalModel->loginPorNombre($nombre, $clave);

        if ($datos) {
            $_SESSION['usuario'] = $datos->getNombre(); // aquí guardamos el nombre como identificador
            $_SESSION['nombre']  = ucfirst($datos->getNombre());
            $_SESSION['id']      = $datos->getId();
            $_SESSION['rol']     = 'personal';
            header("Location: ?path=panel_personal");
            exit;
        } else {
            $view = new View();
            $view->render('login.tpl', [
                'mensaje' => "⚠️ Nombre o contraseña incorrectos"
            ]);
        }
    }

    // ---------------- LOGIN TRANSPORTISTA ----------------
     public function loginTransportista(): void
    {
        session_start();
        $usuario = $_POST['usuario'] ?? '';
        $clave   = $_POST['clave'] ?? '';

        $datos = $this->transportistaModel->loginPorUsuario($usuario, $clave);

        if ($datos) {
            $_SESSION['usuario'] = $datos->getUsuario();
            $_SESSION['nombre']  = ucfirst($datos->getNombre());
            $_SESSION['id']      = $datos->getId();
            $_SESSION['rol']     = 'transportista';
            header("Location: ?path=panel_transportista");
            exit;
        } else {
            $view = new View();
            $view->render('login.tpl', [
                'mensaje' => "⚠️ Usuario o contraseña incorrectos"
            ]);
        }
    }

    // ---------------- LOGOUT ----------------
    public function logout(): void
{
    session_start();
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
    header("Location: ?path=inicio");
    exit;
}

}
