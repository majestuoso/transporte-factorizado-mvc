<?php
declare(strict_types=1);

require_once(__DIR__ . '/../db/DB.php');
require_once(__DIR__ . '/Transportista.php');

class TransportistaModel
{
    private PDO $pdo;

    public function __construct()
    {
        // Usar correctamente el patrón Singleton
        $this->pdo = DB::getInstance()->getPDO();
    }

    public function listar(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM transportistas ORDER BY id ASC");
        $transportistas = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $transportistas[] = Transportista::desdeArray($row);
        }
        return $transportistas;
    }

    public function crearYGuardar(array $data): ?Transportista
    {
        if (empty($data['nombre']) || empty($data['apellido']) || empty($data['vehiculo'])) {
            return null;
        }

        $stmt = $this->pdo->prepare("
            INSERT INTO transportistas (nombre, apellido, vehiculo, disponible, nota)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['nombre'],
            $data['apellido'],
            $data['vehiculo'],
            isset($data['disponible']) ? 1 : 0,
            $data['nota'] ?? ''
        ]);

        $id = (int) $this->pdo->lastInsertId();
        return $this->buscarPorId($id);
    }

    public function buscarPorId(int $id): ?Transportista
    {
        $stmt = $this->pdo->prepare("SELECT * FROM transportistas WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? Transportista::desdeArray($row) : null;
    }

    public function modificarDesdeFormulario(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE transportistas
            SET nombre = ?, apellido = ?, vehiculo = ?, disponible = ?, nota = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['nombre'],
            $data['apellido'],
            $data['vehiculo'],
            isset($data['disponible']) ? (int)$data['disponible'] : 0,

            $data['nota'] ?? '',
            $id
        ]);
    }

    public function eliminar(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM transportistas WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function recargar(): void
    {
        // Método reservado para lógica futura
    }

    public function listarDisponibles(): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM transportistas WHERE disponible = 1 ORDER BY id ASC");
        $stmt->execute();
        $transportistas = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $transportistas[] = Transportista::desdeArray($row);
        }
        return $transportistas;
    }
}
