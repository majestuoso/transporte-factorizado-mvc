<?php

class DB
{
    private static ?DB $instance = null;

    private array $transportistas = [];
    private array $rutas = [];
    private array $viajes = [];

    public static function getInstance(): DB
    {
        if (self::$instance === null) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    private function __construct() {}

    // 🔹 Transportistas
    public function agregarTransportista(Transportista $t): void
    {
        $this->transportistas[] = $t;
    }

    public function getTransportistas(): array
    {
        return $this->transportistas;
    }

    public function getTransportistaPorId(int $id): ?Transportista
    {
        foreach ($this->transportistas as $t) {
            if ($t->getId() === $id) return $t;
        }
        return null;
    }

    public function getTransportistaPorNombre(string $nombre): ?Transportista
    {
        foreach ($this->transportistas as $t) {
            if ($t->getNombre() === $nombre) return $t;
        }
        return null;
    }

    public function transportistasDisponibles(): array
    {
        return array_filter($this->transportistas, fn($t) => $t->isDisponible());
    }

    public function turnoMenor(): ?Transportista
    {
        $disponibles = $this->transportistasDisponibles();
        usort($disponibles, fn($a, $b) => $a->getTurno() <=> $b->getTurno());
        return $disponibles[0] ?? null;
    }

    public function borrarTransportistaPorIndice(int $i): void
    {
        unset($this->transportistas[$i]);
        $this->transportistas = array_values($this->transportistas);
    }

    public function actualizarTransportista(Transportista $t): void
    {
        foreach ($this->transportistas as $i => $actual) {
            if ($actual->getId() === $t->getId()) {
                $this->transportistas[$i] = $t;
                return;
            }
        }
    }

    // 🔹 Rutas
    public function agregarRuta(Ruta $r): void
    {
        $this->rutas[] = $r;
    }

    public function getRutas(): array
    {
        return $this->rutas;
    }

    public function getRutaPorId(int $id): ?Ruta
    {
        foreach ($this->rutas as $r) {
            if ($r->getId() === $id) return $r;
        }
        return null;
    }

    public function getRutaPorNombre(string $nombre): ?Ruta
    {
        foreach ($this->rutas as $r) {
            if ($r->getNombre() === $nombre) return $r;
        }
        return null;
    }

    public function eliminarRuta(int $i): void
    {
        unset($this->rutas[$i]);
        $this->rutas = array_values($this->rutas);
    }

    // 🔹 Viajes
    public function agregarViaje(Viaje $v): void
    {
        $this->viajes[] = $v;
    }

    public function getViajes(): array
    {
        return $this->viajes;
    }

    public function getViajePorId(int $id): ?Viaje
    {
        foreach ($this->viajes as $v) {
            if ($v->getId() === $id) return $v;
        }
        return null;
    }

    public function actualizarTarifaViaje(int $id, float $tarifa): bool
    {
        foreach ($this->viajes as $i => $v) {
            if ($v->getId() === $id) {
                $v->setTarifa($tarifa);
                $this->viajes[$i] = $v;
                return true;
            }
        }
        return false;
    }

    public function actualizarTransportistaEnViaje(int $id, int $transportistaId): bool
    {
        foreach ($this->viajes as $i => $v) {
            if ($v->getId() === $id) {
                $v->setTransportistaId($transportistaId);
                $this->viajes[$i] = $v;
                return true;
            }
        }
        return false;
    }

    public function actualizarRutaEnViaje(int $id, int $rutaId): bool
    {
        foreach ($this->viajes as $i => $v) {
            if ($v->getId() === $id) {
                $v->setRutaId($rutaId);
                $this->viajes[$i] = $v;
                return true;
            }
        }
        return false;
    }

    public function actualizarEstadoViaje(int $id, string $estado): bool
    {
        foreach ($this->viajes as $i => $v) {
            if ($v->getId() === $id) {
                $v->setEstado($estado);
                $this->viajes[$i] = $v;
                return true;
            }
        }
        return false;
    }

    public function eliminarViaje(int $id): bool
    {
        foreach ($this->viajes as $i => $v) {
            if ($v->getId() === $id) {
                unset($this->viajes[$i]);
                $this->viajes = array_values($this->viajes);
                return true;
            }
        }
        return false;
    }
}
