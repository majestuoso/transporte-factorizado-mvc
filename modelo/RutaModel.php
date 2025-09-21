<?php

require_once(__DIR__ . '/../modelo/Model.php');
require_once(__DIR__ . '/../modelo/Ruta.php');

class RutaModel extends Model
{
    public function crearYGuardar(array $datos): ?Ruta
    {
        $nombre = trim($datos['nombre'] ?? '');
        $distancia = (float)filter_var($datos['distancia'] ?? '', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $nota = trim($datos['nota'] ?? '');

        if ($nombre === '' || $distancia <= 0) return null;

        $ruta = new Ruta($nombre, $distancia, $nota ?: null);
        $this->db->agregarRuta($ruta);
        return $ruta;
    }

    public function listar(): array
    {
        return $this->db->getRutas();
    }

    public function buscarPorId(int $id): ?Ruta
    {
        return $this->db->getRutaPorId($id);
    }

    public function modificarNombre(int $id, string $nuevoNombre): bool
    {
        $ruta = $this->buscarPorId($id);
        if (!$ruta || trim($nuevoNombre) === '') return false;
        $ruta->setNombre(trim($nuevoNombre));
        return true;
    }

    public function modificarDistancia(int $id, float $nuevaDistancia): bool
    {
        $ruta = $this->buscarPorId($id);
        if ($ruta) {
            $ruta->setDistancia($nuevaDistancia);
            return true;
        }
        return false;
    }

    public function modificarNota(int $id, ?string $nuevaNota): bool
    {
        $ruta = $this->buscarPorId($id);
        if ($ruta) {
            $ruta->setNota($nuevaNota);
            return true;
        }
        return false;
    }

    public function modificar(int $id, array $cambios): bool
    {
        $ruta = $this->buscarPorId($id);
        if (!$ruta) return false;

        if (isset($cambios['nombre'])) {
            $ruta->setNombre(trim($cambios['nombre']));
        }
        if (isset($cambios['distancia'])) {
            $distancia = (float)filter_var($cambios['distancia'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            if ($distancia > 0) $ruta->setDistancia($distancia);
        }
        if (array_key_exists('nota', $cambios)) {
            $ruta->setNota(trim($cambios['nota']) ?: null);
        }

        return true;
    }

    public function eliminar(int $id): bool
    {
        return $this->db->eliminarRuta($id);
    }
}
