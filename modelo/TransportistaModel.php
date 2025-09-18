<?php

class TransportistaModel extends Model
{

    public function obtenerProximoTurno(): int
    {
        $transportistas = $this->db->getTransportistas();
        $turnos = array_map(fn($t) => $t->getTurno(), $transportistas);
        return empty($turnos) ? 1 : max($turnos) + 1;
    }

    public function crearYGuardar(array $datos): ?Transportista
    {
        $turno = $this->obtenerProximoTurno();

        if (trim($datos['nombre']) === '' || trim($datos['apellido']) === '' || trim($datos['vehiculo']) === '') {
            return null;
        }

        $t = new Transportista($datos['nombre'], $datos['apellido']);
        $t->setVehiculo($datos['vehiculo']);
        $t->setTurno($turno);
        $t->setDisponible(true);
        $t->setNota($datos['nota'] ?? null);

        $this->db->agregarTransportista($t);
        return $t;
    }
    public function listar(): array
    {
        return $this->db->getTransportistas();
    }
}
