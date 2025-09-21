<?php

class Ruta
{
    private static int $ultimoId = 0;

    private int $id;
    private string $nombre;
    private float $distancia;
    private ?string $nota = null;

    public function __construct(string $nombre, float $distancia, ?string $nota = null)
    {
        self::$ultimoId++;
        $this->id = self::$ultimoId;
        $this->nombre = $nombre;
        $this->distancia = $distancia;
        $this->nota = $nota;
    }

    
    public function getId(): int { return $this->id; }
    public function getNombre(): string { return $this->nombre; }
    public function getDistancia(): float { return $this->distancia; }
    public function getNota(): ?string { return $this->nota; }

   
    public function setId(int $id): void { $this->id = $id; }
    public function setNombre(string $nombre): void { $this->nombre = $nombre; }
    public function setDistancia(float $distancia): void { $this->distancia = $distancia; }
    public function setNota(?string $nota): void { $this->nota = $nota; }

    
    public function __toString(): string
    {
        return
            "🛣️ ID: {$this->id} | Nombre: {$this->nombre} | Distancia: {$this->distancia} km\n" .
            "🗒️ " . ($this->nota ? "Nota: {$this->nota}" : "Sin nota registrada") . "\n" .
            str_repeat("-", 60) . "\n";
    }
}
