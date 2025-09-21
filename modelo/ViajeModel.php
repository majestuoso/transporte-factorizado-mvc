<?php
require_once(__DIR__ . '/../modelo/Viaje.php');


class ViajeModel extends Model
{

    public function crearYGuardar(array $datos): ?Viaje
    {
        $rutaId = isset($datos['rutaId']) ? (int)$datos['rutaId'] : null;
        $transportistaId = isset($datos['transportistaId']) ? (int)$datos['transportistaId'] : null;
        $estado = isset($datos['estado']) ? trim($datos['estado']) : null;
        $tarifa = isset($datos['tarifa']) ? (float)$datos['tarifa'] : null;
        $nota = isset($datos['nota']) ? trim($datos['nota']) : null;

        if (!$rutaId || !$transportistaId || $estado === '' || $tarifa === null) {
            return null;
        }

        $viaje = new Viaje($rutaId, $transportistaId, $estado, $tarifa, $nota);
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
    public function modificarNota(int $id, string $nota): bool
    {
        $viaje = $this->db->getViajePorId($id);
        if (!$viaje) return false;
        $viaje->setNota($nota);
        return true;
    }

    public function modificarTransportista(int $id, int $nuevoTransportistaId): bool
    {
        return $this->db->actualizarTransportistaEnViaje($id, $nuevoTransportistaId);
    }


    public function modificarRuta(int $id, int $nuevaRutaId): bool
    {
        return $this->db->actualizarRutaEnViaje($id, $nuevaRutaId);
    }

    public function modificarEstado(int $id, string $nuevoEstado): bool
    {
        return $this->db->actualizarEstadoViaje($id, $nuevoEstado);
    }

    public function eliminar(int $id): bool
    {
        return $this->db->eliminarViaje($id);
    }
    public function buscarPorId(int $id): ?Viaje
    {
        return $this->db->getViajePorId($id);
    }
}
