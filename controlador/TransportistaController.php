<?php
declare(strict_types=1);

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

    // 🏠 Inicio
    public function index(): void
    {
        $this->view->mostrarInicio();
    }

    // 📋 Listar
    public function listar(): void
    {
        $transportistas = $this->model->listar();
        $transportistas = array_filter($transportistas, fn($t) => $t instanceof Transportista);

        if (empty($transportistas)) {
            $this->view->showMessage("No hay transportistas registrados.");
            return;
        }

        $this->view->mostrarTransportistas($transportistas);
    }

    // ➕ Agregar
    public function agregar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = $_POST;

            if ($this->validar($datos)) {
                $t = $this->model->crearYGuardar($datos);
                if ($t instanceof Transportista) {
                    $this->view->mostrarResumen($t);
                } else {
                    $this->view->showMessage("Error interno. No se pudo registrar el transportista.");
                }
            } else {
                $this->view->showMessage("Datos inválidos. No se pudo registrar el transportista.");
            }
        } else {
            $this->view->mostrarFormularioAgregar();
        }
    }

    // 🔎 Validación básica
    private function validar(array $data): bool
    {
        return isset($data['nombre'], $data['apellido'], $data['vehiculo']) &&
               trim($data['nombre']) !== '' &&
               trim($data['apellido']) !== '' &&
               trim($data['vehiculo']) !== '';
    }

    // ✏️ Mostrar formulario de edición
  // ✏️ Mostrar formulario de edición
public function editar(): void
{
    session_start();
    if ($_SESSION['rol'] !== 'personal') {
        header("Location: ?path=inicio");
        exit;
    }

    $id = (int)($_GET['id'] ?? 0);

    if ($id > 0) {
        $t = $this->model->buscarPorId($id);
        if ($t instanceof Transportista) {
            $this->view->mostrarFormularioModificar($t);
        } else {
            $this->view->showMessage("Transportista no encontrado.");
        }
    } else {
        // 👉 En vez de mostrar listado, renderizamos modificartodos.tpl
        $transportistas = $this->model->listar();
        $this->view->mostrarFormularioEditarTodos($transportistas);
    }
}


    // 💾 Procesar modificación (POST)
   public function modificar(): void
{
    session_start();
    if (!in_array($_SESSION['rol'], ['transportista','personal'])) {
        header("Location: ?path=inicio");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id        = (int)($_POST['id'] ?? 0);
        $nombre    = trim($_POST['nombre'] ?? '');
        $apellido  = trim($_POST['apellido'] ?? '');
        $vehiculo  = trim($_POST['vehiculo'] ?? '');
        $nota      = trim($_POST['nota'] ?? '');
        $disponible= (int)($_POST['disponible'] ?? 1);

        // Actualizar en BD
        $this->model->actualizar($id, [
            'nombre'     => $nombre,
            'apellido'   => $apellido,
            'vehiculo'   => $vehiculo,
            'nota'       => $nota,
            'disponible' => $disponible
        ]);

        // Volver a obtener datos actualizados
        $t = $this->model->buscarPorId($id);

        if ($t instanceof Transportista) {
            $this->view->mostrarResumen($t);
        } else {
            $this->view->showMessage("Error al modificar transportista.");
        }
    } else {
        header("Location: ?path=transportistas/listar");
        exit;
    }
}


    // 🗑️ Eliminar
    public function eliminar(): void
    {
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
            $transportista = $this->model->buscarPorId($id);

            if ($transportista instanceof Transportista) {
                $this->model->eliminar($id);
                $this->view->showMessage("Transportista #$id eliminado correctamente.");
            } else {
                $this->view->showMessage("Transportista no encontrado.");
            }
        } else {
            $transportistas = $this->model->listar();
            $transportistas = array_filter($transportistas, fn($t) => $t instanceof Transportista);
            $this->view->mostrarSelectorEliminar($transportistas);
        }
    }
}
