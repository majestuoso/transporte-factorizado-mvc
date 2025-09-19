<?php


class ViajeModel extends Model
{


    public function crearYGuardar(array $datos): ?Viaje
{
    $rutaId = isset($datos['rutaId']) ? (int)$datos['rutaId'] : null;
    $transportistaId = isset($datos['transportistaId']) ? (int)$datos['transportistaId'] : null;
    $estado = isset($datos['estado']) ? trim($datos['estado']) : null;
    $tarifa = isset($datos['tarifa']) ? (float)$datos['tarifa'] : null;

    if (!$rutaId || !$transportistaId || $estado === '' || $tarifa === null) {
        return null;
    }

    $viaje = new Viaje($rutaId, $transportistaId, $estado, $tarifa);
    $this->db->agregarViaje($viaje);
    return $viaje;
}


    public function listar(): array
    {
        return $this->db->getViajes();
    }

     
    public function modificarTarifa(int $id, float $nuevaTarifa): bool
    {
        return $this->db->actualizarTarifaViaje($id, $nuevaTarifa);
    }



    public function modificarTransportista(int $id, int $nuevoTransportistaId): bool
    {
        return $this->db->actualizarTransportistaEnViaje($id, $nuevoTransportistaId);
    }


    public function modificarRuta(int $id, int $nuevaRutaId): bool
    {
        return $this->db->actualizarRutaEnViaje($id, $nuevaRutaId);
    }

    /**
     * Modifica el estado de un viaje.
     */
    public function modificarEstado(int $id, string $nuevoEstado): bool
    {
        return $this->db->actualizarEstadoViaje($id, $nuevoEstado);
    }

    /**
     * Elimina un viaje por ID.
     */
    public function eliminar(int $id): bool
    {
        return $this->db->eliminarViaje($id);
    }
}
