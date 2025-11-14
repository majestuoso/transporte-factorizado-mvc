<?php
declare(strict_types=1);

class Transportista
{
    private int $id;
    private string $usuario;
    private string $clave;
    private string $nombre;
    private string $apellido;
    private string $vehiculo;
    private int $disponible;
    private ?string $nota;
    private ?int $estado_id;

    // --- Constructor ---
    public function __construct(
        int $id,
        string $usuario,
        string $clave,
        string $nombre,
        string $apellido,
        string $vehiculo,
        int $disponible,
        ?string $nota = null,
        ?int $estado_id = null
    ) {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->vehiculo = $vehiculo;
        $this->disponible = $disponible;
        $this->nota = $nota;
        $this->estado_id = $estado_id;
    }

    // --- Getters ---
    public function getId(): int { return $this->id; }
    public function getUsuario(): string { return $this->usuario; }
    public function getClave(): string { return $this->clave; }
    public function getNombre(): string { return $this->nombre; }
    public function getApellido(): string { return $this->apellido; }
    public function getVehiculo(): string { return $this->vehiculo; }
    public function getDisponible(): int { return $this->disponible; }
    public function getNota(): ?string { return $this->nota; }
    public function getEstadoId(): ?int { return $this->estado_id; }

    // --- Setters ---
    public function setId(int $id): void { $this->id = $id; }
    public function setUsuario(string $usuario): void { $this->usuario = $usuario; }
    public function setClave(string $clave): void { $this->clave = $clave; }
    public function setNombre(string $nombre): void { $this->nombre = $nombre; }
    public function setApellido(string $apellido): void { $this->apellido = $apellido; }
    public function setVehiculo(string $vehiculo): void { $this->vehiculo = $vehiculo; }
    public function setDisponible(int $disponible): void { $this->disponible = $disponible; }
    public function setNota(?string $nota): void { $this->nota = $nota; }
    public function setEstadoId(?int $estado_id): void { $this->estado_id = $estado_id; }

    // --- Método booleano para la vista ---
    public function isDisponible(): bool {
        return $this->disponible === 1;
    }

    // --- Constructor desde array ---
    public static function desdeArray(array $row): Transportista {
        return new Transportista(
            (int)($row['id'] ?? 0),
            $row['usuario'] ?? '',
            $row['clave'] ?? '',
            $row['nombre'] ?? '',
            $row['apellido'] ?? '',
            $row['vehiculo'] ?? '',
            (int)($row['disponible'] ?? 1),
            $row['nota'] ?? null,
            isset($row['estado_id']) ? (int)$row['estado_id'] : null
        );
    }
}
