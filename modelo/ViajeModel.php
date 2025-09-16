<?php

class ViajeModel
{
    private DB $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    /**
     * Crea un viaje validado y lo guarda en la base de datos.
     */
    public function crearYGuardar(array $datos): ?Viaje
    {
        $rutaId = isset($datos['rutaId']) ? (int)$datos['rutaId'] : null;
        $transportistaId = isset($datos['transportistaId']) ? (int)$datos['transportistaId'] : null;
        $estado = isset($datos['estado']) ? trim($datos['estado']) : null;

        if (!$rutaId || !$transportistaId || $estado === '') {
            return null;
        }

        $viaje = new Viaje($rutaId, $transportistaId, $estado);
        $this->db->agregarViaje($viaje);
        return $viaje;
    }

    /**
     * Devuelve todos los viajes registrados.
     */
    public function listar(): array
    {
        return $this->db->getViajes();
    }

    /**
     * Modifica la tarifa de un viaje.
     */
    public function modificarTarifa(int $id, float $nuevaTarifa): bool
    {
        return $this->db->actualizarTarifaViaje($id, $nuevaTarifa);
    }

    /**
     * Modifica el transportista asignado a un viaje.
     */
    public function modificarTransportista(int $id, int $nuevoTransportistaId): bool
    {
        return $this->db->actualizarTransportistaEnViaje($id, $nuevoTransportistaId);
    }

    /**
     * Modifica la ruta asignada a un viaje.
     */
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
