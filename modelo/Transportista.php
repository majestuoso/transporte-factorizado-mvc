<?php
declare(strict_types=1);

class Transportista
{
    private static int $ultimoId = 0;
    private static int $ultimoTurno = 0;

    private int $id;
    private string $nombre;
    private string $apellido;
    private string $vehiculo;
    private int $turno;
    private bool $disponible;
    private ?string $nota = null;

    public function __construct(
        string $nombre,
        string $apellido,
        string $vehiculo = '',
        bool $disponible = true,
        ?string $nota = null
    ) {
        self::$ultimoId++;
        self::$ultimoTurno++;

        $this->id = self::$ultimoId;
        $this->turno = self::$ultimoTurno;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->vehiculo = $vehiculo;
        $this->disponible = $disponible;
        $this->nota = $nota;
    }

    public function getId(): int { return $this->id; }
    public function getNombre(): string { return $this->nombre; }
    public function getApellido(): string { return $this->apellido; }
    public function getVehiculo(): string { return $this->vehiculo; }
    public function getTurno(): int { return $this->turno; }
    public function isDisponible(): bool { return $this->disponible; }
    public function getNota(): ?string { return $this->nota; }

   
    public function setId(int $id): self { $this->id = $id; return $this; }
    public function setNombre(string $nombre): self { $this->nombre = $nombre; return $this; }
    public function setApellido(string $apellido): self { $this->apellido = $apellido; return $this; }
    public function setVehiculo(string $vehiculo): self { $this->vehiculo = $vehiculo; return $this; }
    public function setTurno(int $turno): self { $this->turno = $turno; return $this; }
    public function setDisponible(bool $disponible): self { $this->disponible = $disponible; return $this; }
    public function setNota(?string $nota): self { $this->nota = $nota; return $this; }

    public function __toString(): string
    {
        return "🧍 ID: {$this->id} | Nombre: {$this->nombre} {$this->apellido} | Vehículo: {$this->vehiculo} | Turno: {$this->turno} | Disponible: " . ($this->disponible ? "Sí" : "No");
    }
}
