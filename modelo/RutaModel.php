<?php
declare(strict_types=1);

require_once(__DIR__ . '/../db/DB.php');
require_once(__DIR__ . '/Ruta.php');

class RutaModel
{
    private PDO $pdo;

    public function __construct()
    {
        // CORREGIDO: usar Singleton en lugar de new DB()
        $this->pdo = DB::getInstance()->getPDO();
    }

    public function listar(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM rutas ORDER BY id ASC");
        $rutas = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rutas[] = Ruta::desdeArray($row);
        }
        return $rutas;
    }

    public function crearYGuardar(array $data): ?Ruta
    {
        if (empty($data['nombre']) || !isset($data['distancia'])) {
            return null;
        }

        $stmt = $this->pdo->prepare("
            INSERT INTO rutas (nombre, distancia, nota)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([
            $data['nombre'],
            (int) $data['distancia'],
            $data['nota'] ?? ''
        ]);

        $id = (int) $this->pdo->lastInsertId();
        return $this->buscarPorId($id);
    }

    public function buscarPorId(int $id): ?Ruta
    {
        $stmt = $this->pdo->prepare("SELECT * FROM rutas WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? Ruta::desdeArray($row) : null;
    }

    public function modificarDesdeFormulario(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE rutas
            SET nombre = ?, distancia = ?, nota = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['nombre'],
            (int) $data['distancia'],
            $data['nota'] ?? '',
            $id
        ]);
    }

    public function eliminar(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM rutas WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function recargar(): void
    {
        // Método reservado para lógica futura
    }
}
