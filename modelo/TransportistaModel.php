<?php

declare(strict_types=1);

require_once(__DIR__ . '/Model.php');
require_once(__DIR__ . '/Transportista.php');

class TransportistaModel extends Model
{
    public function crearYGuardar(array $datos): ?Transportista
    {
        if (empty($datos['nombre']) || empty($datos['apellido']) || empty($datos['vehiculo'])) {
            return null;
        }

        $transportista = new Transportista(
            $datos['nombre'],
            $datos['apellido'],
            $datos['vehiculo'],
            (bool)($datos['disponible'] ?? true),
            $datos['nota'] ?? null
        );

        $id = count($this->db->getTransportistas()) + 1;
        $transportista->setId($id);


        $transportistas = &$this->db->getTransportistas();
        $transportistas[$id] = $transportista;

        return $transportista;
    }

    public function listar(): array
    {
        return $this->db->getTransportistas();
    }

    public function buscarPorId(int $id): ?Transportista
    {
        return $this->db->getTransportistas()[$id] ?? null;
    }

    public function eliminar(int $id): bool
    {
        $transportistas = &$this->db->getTransportistas();
        if (!isset($transportistas[$id])) return false;

        unset($transportistas[$id]);
        return true;
    }

    public function modificarNombre(int $id, string $nombre): bool
    {
        $t = $this->buscarPorId($id);
        if (!$t) return false;
        $t->setNombre($nombre);
        return true;
    }

    public function modificarApellido(int $id, string $apellido): bool
    {
        $t = $this->buscarPorId($id);
        if (!$t) return false;
        $t->setApellido($apellido);
        return true;
    }

    public function modificarVehiculo(int $id, string $vehiculo): bool
    {
        $t = $this->buscarPorId($id);
        if (!$t) return false;
        $t->setVehiculo($vehiculo);
        return true;
    }

    public function modificarDisponibilidad(int $id, bool $estado): bool
    {
        $t = $this->buscarPorId($id);
        if (!$t) return false;
        $t->setDisponible($estado);
        return true;
    }

    public function modificarNota(int $id, string $nota): bool
    {
        $t = $this->buscarPorId($id);
        if (!$t) return false;
        $t->setNota($nota);
        return true;
    }
}
