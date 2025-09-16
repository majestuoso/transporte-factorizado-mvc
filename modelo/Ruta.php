

<?php

require_once(__DIR__ . '/../db/DB.php');

class Ruta
{
    private static int $ultimoId = 0;

    private int $id;
    private string $nombre;
    private float $distancia;
    private ?string $nota = null;

    public function __construct(float $distancia, string $nombre)
    {
        self::$ultimoId++;
        $this->id = self::$ultimoId;
        $this->nombre = $nombre;
        $this->distancia = $distancia;
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getDistancia(): float
    {
        return $this->distancia;
    }

    public function getNota(): ?string
    {
        return $this->nota;
    }

    // Setters
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setDistancia(float $distancia): void
    {
        $this->distancia = $distancia;
    }

    public function setNota(?string $nota): void
    {
        $this->nota = $nota;
    }

    // Representación en texto
    public function __toString(): string
    {
        return
            "ID: {$this->id}
        | Nombre: {$this->nombre}
        | Distancia: {$this->distancia} km
        | Nota: " . ($this->nota ? $this->nota : "Sin nota") . "\n";
    }
}

