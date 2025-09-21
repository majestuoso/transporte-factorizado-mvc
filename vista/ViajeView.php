<?php

require_once(__DIR__ . '/../db/DB.php');
require_once(__DIR__ . '/../modelo/Model.php');

class ViajeView extends Model
{
    public function solicitarDatos(): array
    {
        $rutas = $this->db->getRutas();
        if (empty($rutas)) {
            mostrar("\033[1;31mNo hay rutas disponibles.\033[0m\n");
            return [];
        }

        mostrar("\n\033[1;36m📍 Rutas disponibles:\033[0m\n");
        foreach ($rutas as $ruta) {
            mostrar("🛣️ ID: {$ruta->getId()} | Nombre: {$ruta->getNombre()} | Distancia: {$ruta->getDistancia()} km\n");
        }

        $rutaId = (int)trim(readline("Ingrese ID de ruta: "));
        $ruta = $this->db->getRutaPorId($rutaId);
        if (!$ruta) {
            mostrar("\033[1;31mRuta no encontrada.\033[0m\n");
            return [];
        }

        $transportistas = $this->db->transportistasDisponibles();
        if (empty($transportistas)) {
            mostrar("\033[1;31mNo hay transportistas disponibles.\033[0m\n");
            return [];
        }

        mostrar("\n\033[1;36m🧍 Transportistas disponibles:\033[0m\n");
        foreach ($transportistas as $t) {
            mostrar("🧍 ID: {$t->getId()} | Nombre: {$t->getNombre()} {$t->getApellido()} | Vehículo: {$t->getVehiculo()} | Turno: {$t->getTurno()}\n");
        }

        $mejor = $this->db->turnoMenor();
        if ($mejor) {
            mostrar("\n\033[1;33m✅ Disponible con menor turno: {$mejor->getNombre()} {$mejor->getApellido()} (ID {$mejor->getId()}, Turno {$mejor->getTurno()})\033[0m\n");
        }

        $transportistaId = (int)trim(readline("Ingrese ID de transportista: "));
        $transportista = $this->db->getTransportistaPorId($transportistaId);
        if (!$transportista || !$transportista->isDisponible()) {
            mostrar("\033[1;31mTransportista no disponible.\033[0m\n");
            return [];
        }

        $estado = trim(readline("Ingrese estado del viaje (pendiente, en curso): "));
        if ($estado === '') {
            mostrar("\033[1;31mEstado inválido.\033[0m\n");
            return [];
        }

        $tarifaTexto = trim(readline("Ingrese tarifa del viaje (ej: 15000.50): "));
        $tarifa = (float)filter_var($tarifaTexto, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        if ($tarifa <= 0) {
            mostrar("\033[1;31mTarifa inválida.\033[0m\n");
            return [];
        }

        $nota = trim(readline("Ingrese nota del viaje (opcional): "));
        $notaFinal = $nota !== '' ? $nota : null;

        return [
            'rutaId' => $rutaId,
            'transportistaId' => $transportistaId,
            'estado' => $estado,
            'tarifa' => $tarifa,
            'nota' => $notaFinal
        ];
    }

    public function solicitarId(): int
    {
        echo "Ingrese el ID del viaje: ";
        return (int)trim(readline());
    }

    public function solicitarTarifa(): float
    {
        echo "Ingrese la nueva tarifa: ";
        return (float)trim(readline());
    }

    public function solicitarTransportistaId(): int
    {
        echo "Ingrese el nuevo ID de transportista: ";
        return (int)trim(readline());
    }

    public function solicitarRutaId(): int
    {
        echo "Ingrese el nuevo ID de ruta: ";
        return (int)trim(readline());
    }

    public function solicitarEstado(): string
    {
        echo "Ingrese el nuevo estado del viaje: ";
        return trim(readline());
    }

    public function mostrarResumen(Viaje $viaje): void
    {
        echo "\n\033[1;32mViaje registrado correctamente:\033[0m\n";
        echo $viaje . "\n";
    }

    public function mostrarViajes(array $viajes): void
    {
        $db = DB::getInstance();

        echo "\n\033[1;35m📦 Listado de Viajes:\033[0m\n";
        printf("\033[1m%-4s | %-15s | %-20s | %-10s | %-8s | %-30s\033[0m\n", "ID", "Transportista", "Ruta", "Estado", "Tarifa", "Nota");
        echo str_repeat("-", 110) . "\n";

        foreach ($viajes as $v) {
            $transportista = $db->getTransportistaPorId($v->getTransportistaId());
            $ruta = $db->getRutaPorId($v->getRutaId());

            $nombreTransportista = $transportista ? $transportista->getNombre() . ' ' . $transportista->getApellido() : "ID {$v->getTransportistaId()}";
            $nombreRuta = $ruta ? $ruta->getNombre() : "ID {$v->getRutaId()}";
            $tarifaFormateada = rtrim(rtrim(number_format($v->getTarifa(), 2, '.', ''), '0'), '.');
            $notaViaje = $v->getNota() ?? "Sin nota";
            $notaColor = "\033[0;32m{$notaViaje}\033[0m";

            printf(
                "%-4d | %-15s | %-20s | %-10s | $%-7s | %-30s\n",
                $v->getId(),
                $nombreTransportista,
                $nombreRuta,
                $v->getEstado(),
                $tarifaFormateada,
                $notaColor
            );
        }

        echo str_repeat("-", 110) . "\n";
    }

    public function showMessage(string $mensaje): void
    {
        echo "\n\033[1;34m{$mensaje}\033[0m\n";
    }
}
