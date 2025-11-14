<?php
declare(strict_types=1);

require_once(__DIR__ . '/Model.php');
require_once(__DIR__ . '/Personal.php'); // Clase Personal con getters y setters

class PersonalModel extends Model
{
    // ---------------- LISTAR TODO EL PERSONAL ----------------
    public function listar(): array
    {
        $stmt = $this->db->query("SELECT id, usuario, clave, nombre, estado_id FROM personal");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $personalList = [];
        foreach ($rows as $row) {
            $personalList[] = $this->mapearPersonal($row);
        }

        return $personalList;
    }

    // ---------------- BUSCAR PERSONAL POR ID ----------------
    public function buscarPorId(int $id): ?Personal
    {
        $stmt = $this->db->prepare("SELECT id, usuario, clave, nombre, estado_id FROM personal WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? $this->mapearPersonal($row) : null;
    }

    // ---------------- BUSCAR PERSONAL POR NOMBRE ----------------
    public function buscarPorNombre(string $nombre): ?Personal
    {
        $stmt = $this->db->prepare("SELECT id, usuario, clave, nombre, estado_id FROM personal WHERE nombre = :nombre LIMIT 1");
        $stmt->execute(['nombre' => $nombre]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? $this->mapearPersonal($row) : null;
    }

    // ---------------- AGREGAR NUEVO PERSONAL ----------------
    public function agregar(array $data): ?int
    {
        if (empty($data['usuario']) || empty($data['clave']) || empty($data['nombre'])) {
            throw new InvalidArgumentException("⚠️ Faltan datos obligatorios: usuario, clave o nombre");
        }

        try {
            $sql = "INSERT INTO personal (usuario, clave, nombre, estado_id) 
                    VALUES (:usuario, :clave, :nombre, :estado_id)";
            $stmt = $this->db->prepare($sql);
            $ok = $stmt->execute([
                'usuario'   => $data['usuario'],
                'clave'     => password_hash($data['clave'], PASSWORD_DEFAULT),
                'nombre'    => $data['nombre'],
                'estado_id' => $data['estado_id'] ?? 1
            ]);

            return $ok ? (int)$this->db->lastInsertId() : null;
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                return null; // error por UNIQUE constraint
            }
            throw $e;
        }
    }

    // ---------------- MODIFICAR PERSONAL ----------------
    public function modificar(int $id, array $data): bool
    {
        $sql = "UPDATE personal 
                   SET usuario = :usuario,
                       nombre = :nombre,
                       clave = :clave,
                       estado_id = :estado_id
                 WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id'        => $id,
            'usuario'   => $data['usuario'] ?? '',
            'nombre'    => $data['nombre'] ?? '',
            'clave'     => password_hash($data['clave'] ?? '', PASSWORD_DEFAULT),
            'estado_id' => $data['estado_id'] ?? 1
        ]);
    }

    // ---------------- ELIMINAR PERSONAL ----------------
    public function eliminar(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM personal WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // ---------------- LOGIN POR USUARIO ----------------
    public function login(string $usuario, string $clave): ?Personal
    {
        $stmt = $this->db->prepare("SELECT * FROM personal WHERE usuario = :usuario LIMIT 1");
        $stmt->execute(['usuario' => $usuario]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($clave, $row['clave'])) {
            return $this->mapearPersonal($row);
        }
        return null;
    }

    // ---------------- LOGIN POR NOMBRE ----------------
    public function loginPorNombre(string $nombre, string $clave): ?Personal
    {
        $stmt = $this->db->prepare("SELECT * FROM personal WHERE nombre = :nombre LIMIT 1");
        $stmt->execute(['nombre' => $nombre]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($clave, $row['clave'])) {
            // 👇 Usamos mapearPersonal para inicializar todas las propiedades
            return $this->mapearPersonal($row);
        }
        return null;
    }

    // ---------------- MAPEAR ARRAY A OBJETO PERSONAL ----------------
    private function mapearPersonal(array $row): Personal
    {
        $p = new Personal();
        $p->setId((int)($row['id'] ?? 0));
        $p->setUsuario($row['usuario'] ?? '');
        $p->setClave($row['clave'] ?? '');
        $p->setNombre($row['nombre'] ?? '');
        $p->setEstadoId((int)($row['estado_id'] ?? 1));
        return $p;
    }

    // ---------------- BUSCAR POR USUARIO ----------------
    public function buscarPorUsuario(string $usuario): ?Personal
    {
        $stmt = $this->db->prepare("SELECT * FROM personal WHERE usuario = :usuario LIMIT 1");
        $stmt->execute(['usuario' => $usuario]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? $this->mapearPersonal($row) : null;
    }
}
