<?php

declare(strict_types=1);

require_once(__DIR__ . '/../db/DB.php');

class Viaje
{
    private static int $ultimoId = 0;

    private int $id;
    private int $rutaId;
    private int $transportistaId;
    private string $estado;
    private float $tarifa = 0.0;
    private ?string $nota = null;

    public function __construct(
        int $rutaId,
        int $transportistaId,
        string $estado,
        float $tarifa,
        ?string $nota = null
    ) {
        self::$ultimoId++;
        $this->id = self::$ultimoId;
        $this->rutaId = $rutaId;
        $this->transportistaId = $transportistaId;
        $this->estado = $estado;
        $this->tarifa = $tarifa;
        $this->nota = $nota;
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }
    public function getRutaId(): int
    {
        return $this->rutaId;
    }
    public function getTransportistaId(): int
    {
        return $this->transportistaId;
    }
    public function getEstado(): string
    {
        return $this->estado;
    }
    public function getTarifa(): float
    {
        return $this->tarifa;
    }
    public function getNota(): ?string
    {
        return $this->nota;
    }

    // Setters
    public function setRutaId(int $rutaId): void
    {
        $this->rutaId = $rutaId;
    }
    public function setTransportistaId(int $transportistaId): void
    {
        $this->transportistaId = $transportistaId;
    }
    public function setEstado(string $estado): void
    {
        $this->estado = $estado;
    }
    public function setTarifa(float $tarifa): void
    {
        $this->tarifa = $tarifa;
    }
    public function setNota(?string $nota): void
    {
        $this->nota = $nota;
    }

    public function __toString(): string
    {
        $db = DB::getInstance();

        $transportista = $db->getTransportistaPorId($this->transportistaId);
        $ruta = $db->getRutaPorId($this->rutaId);

        $datosTransportista = $transportista
            ? "ID: {$transportista->getId()} | Nombre: {$transportista->getNombre()} {$transportista->getApellido()} | Vehículo: {$transportista->getVehiculo()} | Disponible: " . ($transportista->isDisponible() ? "Sí" : "No")
            : "Transportista no encontrado";

        $datosRuta = $ruta
            ? "ID: {$ruta->getId()} | Nombre: {$ruta->getNombre()} | Distancia: {$ruta->getDistancia()} km"
            : "Ruta no encontrada";

        $tarifaFormateada = rtrim(rtrim(number_format($this->tarifa, 2, '.', ''), '0'), '.');
        $notaFormateada = $this->nota ? $this->nota : "Sin nota";

        return "\n🧾 Viaje ID: {$this->id}\n"
            . "📍 Ruta → {$datosRuta}\n"
            . "🧍 Transportista → {$datosTransportista}\n"
            . "💰 Tarifa: \${$tarifaFormateada}\n"
            . "🗒️ Nota: {$notaFormateada}\n"
            . "📌 Estado: {$this->estado}\n";
    }
}
