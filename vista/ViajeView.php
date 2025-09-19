<?php


class ViajeView extends Model
{
   public function solicitarDatos(): array
{
    // Mostrar rutas disponibles
    $rutas = $this->db->getRutas();
    if (empty($rutas)) {
        mostrar("\033[1;31mNo hay rutas disponibles.\033[0m\n");
        return [];
    }

    mostrar("\n\033[1;36m📍 Rutas disponibles:\033[0m\n");
    foreach ($rutas as $ruta) {
        mostrar("🛣️ ID: {$ruta->getId()} | Nombre: {$ruta->getNombre()} | Distancia: {$ruta->getDistancia()} km\n");
    }

    echo "\nIngrese ID de ruta: ";
    $rutaId = (int)trim(readline());

    // Mostrar transportistas disponibles
    $transportistas = $this->db->getTransportistas();
    if (empty($transportistas)) {
        mostrar("\033[1;31mNo hay transportistas disponibles.\033[0m\n");
        return [];
    }

    mostrar("\n\033[1;36m🧍 Transportistas disponibles:\033[0m\n");
    foreach ($transportistas as $t) {
        mostrar("🧍 ID: {$t->getId()} | Nombre: {$t->getNombre()} {$t->getApellido()} | Vehículo: {$t->getVehiculo()} | Disponible: " . ($t->isDisponible() ? "Sí" : "No") . "\n");
    }

    echo "\nIngrese ID de transportista: ";
    $transportistaId = (int)trim(readline());

    echo "Ingrese estado del viaje (pendiente, en curso, finalizado): ";
    $estado = trim(readline());

    echo "Ingrese tarifa del viaje (ej: 15000.50): ";
    $tarifa = (float)trim(readline());

    return [
        'rutaId' => $rutaId,
        'transportistaId' => $transportistaId,
        'estado' => $estado,
        'tarifa' => $tarifa
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
        echo "\n\033[1;36mListado de viajes:\033[0m\n";
        foreach ($viajes as $v) {
            echo $v . "\n";
        }
    }

    public function showMessage(string $mensaje): void
    {
        echo "\n\033[1;34m{$mensaje}\033[0m\n";
    }
}
