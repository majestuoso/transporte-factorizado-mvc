<?php
class Ruta
{
    private int $id;
    private string $nombre;
    private int $distancia;
    private string $nota;

    public static function desdeArray(array $data): self
    {
        $ruta = new self();
        $ruta->id = (int) $data['id'];
        $ruta->nombre = $data['nombre'];
        $ruta->distancia = (int) $data['distancia'];
        $ruta->nota = $data['nota'] ?? '';
        return $ruta;
    }

    public function getId(): int { return $this->id; }
    public function getNombre(): string { return $this->nombre; }
    public function getDistancia(): int { return $this->distancia; }
    public function getNota(): string { return $this->nota; }
}
