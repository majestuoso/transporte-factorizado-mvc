<?php
declare(strict_types=1);

require_once(__DIR__ . '/../db/DB.php');
require_once(__DIR__ . '/Transportista.php'); // Clase Transportista con getters y setters

class TransportistaModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DB::getInstance()->getPDO();
    }

    // ---------------- LISTAR TODOS ----------------
    public function listar(): array
    {
        $stmt = $this->db->query("SELECT * FROM transportistas ORDER BY id ASC");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lista = [];
        foreach ($rows as $row) {
            $lista[] = Transportista::desdeArray($row);
        }
        return $lista;
    }

    // ---------------- AGREGAR NUEVO TRANSPORTISTA ----------------
    public function agregar(array $data): ?int
    {
        if (empty($data['usuario']) || empty($data['clave']) || empty($data['nombre']) 
            || empty($data['apellido']) || empty($data['vehiculo'])) {
            throw new InvalidArgumentException("⚠️ Faltan datos obligatorios: usuario, clave, nombre, apellido o vehículo");
        }

        try {
            $sql = "INSERT INTO transportistas 
                        (usuario, clave, nombre, apellido, vehiculo, disponible, nota, estado_id) 
                    VALUES 
                        (:usuario, :clave, :nombre, :apellido, :vehiculo, :disponible, :nota, :estado_id)";
            $stmt = $this->db->prepare($sql);
            $ok = $stmt->execute([
                'usuario'    => $data['usuario'],
                'clave'      => password_hash($data['clave'], PASSWORD_DEFAULT),
                'nombre'     => $data['nombre'],
                'apellido'   => $data['apellido'],
                'vehiculo'   => $data['vehiculo'],
                'disponible' => $data['disponible'] ?? 1,
                'nota'       => $data['nota'] ?? '',
                'estado_id'  => $data['estado_id'] ?? 1
            ]);

            return $ok ? (int)$this->db->lastInsertId() : null;
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                return null; // usuario duplicado
            }
            throw $e;
        }
    }

    // ---------------- BUSCAR POR ID ----------------
    public function buscarPorId(int $id): ?Transportista
    {
        $stmt = $this->db->prepare("SELECT * FROM transportistas WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? Transportista::desdeArray($row) : null;
    }

    // ---------------- BUSCAR POR USUARIO ----------------
    public function buscarPorUsuario(string $usuario): ?Transportista
    {
        $stmt = $this->db->prepare("SELECT * FROM transportistas WHERE usuario = :usuario LIMIT 1");
        $stmt->execute(['usuario' => $usuario]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? Transportista::desdeArray($row) : null;
    }

    // ---------------- LOGIN TRANSPORTISTA ----------------
    public function login(string $usuario, string $clave): ?Transportista
    {
        $stmt = $this->db->prepare("SELECT * FROM transportistas WHERE usuario = :usuario LIMIT 1");
        $stmt->execute(['usuario' => $usuario]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($clave, $row['clave'])) {
            return Transportista::desdeArray($row);
        }
        return null;
    }

    // ---------------- MODIFICAR ----------------
    public function modificar(int $id, array $data): bool
    {
        $sql = "UPDATE transportistas 
                   SET usuario = :usuario,
                       clave = :clave,
                       nombre = :nombre,
                       apellido = :apellido,
                       vehiculo = :vehiculo,
                       disponible = :disponible,
                       nota = :nota,
                       estado_id = :estado_id
                 WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id'         => $id,
            'usuario'    => $data['usuario'] ?? '',
            'clave'      => password_hash($data['clave'] ?? '', PASSWORD_DEFAULT),
            'nombre'     => $data['nombre'] ?? '',
            'apellido'   => $data['apellido'] ?? '',
            'vehiculo'   => $data['vehiculo'] ?? '',
            'disponible' => $data['disponible'] ?? 1,
            'nota'       => $data['nota'] ?? '',
            'estado_id'  => $data['estado_id'] ?? 1
        ]);
    }

    // ---------------- ELIMINAR ----------------
    public function eliminar(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM transportistas WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // ---------------- LISTAR DISPONIBLES ----------------
    public function listarDisponibles(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM transportistas WHERE disponible = 1 ORDER BY id ASC");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lista = [];
        foreach ($rows as $row) {
            $lista[] = Transportista::desdeArray($row);
        }
        return $lista;
    }
 public function crearYGuardar(array $datos): ?Transportista {
    // Verificar si el usuario ya existe
    $check = $this->db->prepare("SELECT COUNT(*) FROM transportistas WHERE usuario = :usuario");
    $check->execute([':usuario' => $datos['usuario']]);
    if ($check->fetchColumn() > 0) {
        // Usuario duplicado
        return null;
    }

    // Insertar si no existe
    $sql = "INSERT INTO transportistas 
            (nombre, apellido, vehiculo, nota, usuario, clave, disponible) 
            VALUES (:nombre, :apellido, :vehiculo, :nota, :usuario, :clave, :disponible)";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([
        ':nombre'     => $datos['nombre'],
        ':apellido'   => $datos['apellido'],
        ':vehiculo'   => $datos['vehiculo'],
        ':nota'       => $datos['nota'] ?? null,
        ':usuario'    => $datos['usuario'],
        ':clave'      => password_hash($datos['clave'], PASSWORD_DEFAULT),
        ':disponible' => $datos['disponible']
    ]);

    $id = (int)$this->db->lastInsertId();

    return new Transportista(
        $id,
        $datos['usuario'],
        password_hash($datos['clave'], PASSWORD_DEFAULT),
        $datos['nombre'],
        $datos['apellido'],
        $datos['vehiculo'],
        (int)$datos['disponible'],
        $datos['nota'] ?? null,
        null
    );
}

public function loginPorUsuario(string $usuario, string $clave): ?Transportista {
    $stmt = $this->db->prepare("SELECT * FROM transportistas WHERE usuario = :usuario LIMIT 1");
    $stmt->execute(['usuario' => $usuario]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && password_verify($clave, $row['clave'])) {
        return Transportista::desdeArray($row);
    }
    return null;
}


public function actualizar(int $id, array $data): bool
{
    $stmt = $this->db->prepare(
        "UPDATE transportistas 
         SET nombre     = :nombre,
             apellido   = :apellido,
             vehiculo   = :vehiculo,
             nota       = :nota,
             disponible = :disponible
         WHERE id = :id"
    );

    return $stmt->execute([
        'id'        => $id,
        'nombre'    => $data['nombre'],
        'apellido'  => $data['apellido'],
        'vehiculo'  => $data['vehiculo'],
        'nota'      => $data['nota'],
        'disponible'=> $data['disponible']
    ]);
}




}
