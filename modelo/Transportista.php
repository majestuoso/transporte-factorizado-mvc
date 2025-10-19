<?php
class Transportista
{
    private int $id;
    private string $nombre;
    private string $apellido;
    private string $vehiculo;
    private bool $disponible;
    private string $nota;

    public static function desdeArray(array $data): self
    {
        $t = new self();
        $t->id = (int) $data['id'];
        $t->nombre = $data['nombre'];
        $t->apellido = $data['apellido'];
        $t->vehiculo = $data['vehiculo'];
        $t->disponible = (bool) $data['disponible'];
        $t->nota = $data['nota'] ?? '';
        return $t;
    }

    public function getId(): int { return $this->id; }
    public function getNombre(): string { return $this->nombre; }
    public function getApellido(): string { return $this->apellido; }
    public function getVehiculo(): string { return $this->vehiculo; }
    public function isDisponible(): bool { return $this->disponible; }
    public function getNota(): string { return $this->nota; }

    public function getNombreCompleto(): string
    {
        return $this->nombre . ' ' . $this->apellido;
    }
}
