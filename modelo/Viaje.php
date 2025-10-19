<?php
class Viaje
{
    private int $id;
    private int $transportistaId;
    private int $rutaId;
    private string $estado;
    private float $tarifa;
    private string $nota;

    public static function desdeArray(array $data): self
    {
        $v = new self();
        $v->id = (int) $data['id'];
        $v->transportistaId = (int) $data['transportista_id'];
        $v->rutaId = (int) $data['ruta_id'];
        $v->estado = $data['estado'];
        $v->tarifa = (float) $data['tarifa'];
        $v->nota = $data['nota'] ?? '';
        return $v;
    }

    public function getId(): int { return $this->id; }
    public function getTransportistaId(): int { return $this->transportistaId; }
    public function getRutaId(): int { return $this->rutaId; }
    public function getEstado(): string { return $this->estado; }
    public function getTarifa(): float { return $this->tarifa; }
    public function getNota(): string { return $this->nota; }
}
