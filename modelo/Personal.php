<?php
declare(strict_types=1);

class Personal
{
    private int $id;
    private string $usuario;
    private string $clave;
    private string $nombre;
    private int $estado_id;

    // ---------------- GETTERS ----------------
    public function getId(): int { return $this->id; }
    public function getUsuario(): string { return $this->usuario; }
    public function getClave(): string { return $this->clave; }
    public function getNombre(): string { return $this->nombre; }
    public function getEstadoId(): int { return $this->estado_id; }

    // ---------------- SETTERS ----------------
    public function setId(int $id): void { $this->id = $id; }
    public function setUsuario(string $usuario): void { $this->usuario = $usuario; }
    public function setClave(string $clave): void { $this->clave = $clave; }
    public function setNombre(string $nombre): void { $this->nombre = $nombre; }
    public function setEstadoId(int $estado_id): void { $this->estado_id = $estado_id; }

    // ---------------- CREAR DESDE ARRAY ----------------
    public static function desdeArray(array $row): Personal
    {
        $p = new Personal();
        $p->setId((int)($row['id'] ?? 0));
        $p->setUsuario($row['usuario'] ?? '');
        $p->setClave($row['clave'] ?? '');
        $p->setNombre($row['nombre'] ?? '');
        $p->setEstadoId((int)($row['estado_id'] ?? 1));
        return $p;
    }
}
