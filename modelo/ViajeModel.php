<?php
declare(strict_types=1);

require_once(__DIR__ . '/../db/DB.php');
require_once(__DIR__ . '/Viaje.php');

class ViajeModel
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::getInstance()->getPDO();
    }

    public function listar(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM viajes ORDER BY id ASC");
        $viajes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $viajes[] = Viaje::desdeArray($row);
        }
        return $viajes;
    }

    public function crearYGuardar(array $data): ?Viaje
    {
        if (empty($data['transportistaId']) || empty($data['rutaId']) || empty($data['tarifa'])) {
            return null;
        }

        $stmt = $this->pdo->prepare("
            INSERT INTO viajes (transportista_id, ruta_id, estado, tarifa, nota)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            (int) $data['transportistaId'],
            (int) $data['rutaId'],
            $data['estado'] ?? 'pendiente',
            (float) $data['tarifa'],
            $data['nota'] ?? ''
        ]);

        $id = (int) $this->pdo->lastInsertId();
        return $this->buscarPorId($id);
    }

    public function buscarPorId(int $id): ?Viaje
    {
        $stmt = $this->pdo->prepare("SELECT * FROM viajes WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? Viaje::desdeArray($row) : null;
    }

    public function modificarDesdeFormulario(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE viajes
            SET transportista_id = ?, ruta_id = ?, estado = ?, tarifa = ?, nota = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            (int) $data['transportistaId'],
            (int) $data['rutaId'],
            $data['estado'] ?? 'pendiente',
            (float) $data['tarifa'],
            $data['nota'] ?? '',
            $id
        ]);
    }

    public function modificar(int $id, array $data): bool
    {
        $campos = [];
        $valores = [];

        foreach ($data as $clave => $valor) {
            $campos[] = "$clave = ?";
            $valores[] = $valor;
        }

        $valores[] = $id;
        $sql = "UPDATE viajes SET " . implode(', ', $campos) . " WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($valores);
    }

    public function eliminar(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM viajes WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function recargar(): void
    {
        // Método reservado para lógica futura
    }
    public function listarPorTransportista(){
        
    }
}
