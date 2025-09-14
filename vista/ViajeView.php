<?php

class ViajeView
{
    public function showMessage(string $mensaje): void
    {
        echo "\n\033[1;33m$mensaje\033[0m\n";
    }

    public function getInput(string $mensaje): string
    {
        echo "\n\033[1;36m$mensaje\033[0m ";
        return trim(fgets(STDIN));
    }

    public function mostrarRutas(array $rutas): void
    {
        if (count($rutas) === 0) {
            $this->showMessage("No hay rutas disponibles.");
            return;
        }

        echo "\n\033[1;36mListado de Rutas:\033[0m\n";
        echo "ID   | Nombre                     | Distancia (km)\n";
        echo str_repeat('-', 50) . "\n";

        foreach ($rutas as $r) {
            printf("%-4d | %-25s | %-14.2f\n", $r->getId(), $r->getNombre(), $r->getDistancia());
        }
    }

    public function mostrarTransportistas(array $transportistas): void
    {
        echo "\n\033[1;36mTransportistas disponibles:\033[0m\n";
        echo "ID   | Nombre           | Apellido         | Vehículo            | Turno | Nota\n";
        echo str_repeat('-', 100) . "\n";

        foreach ($transportistas as $t) {
            $nota = $t->getNota() ?? '';
            $notaColor = "\033[1;31m$nota\033[0m";

            printf(
                "%-4s | %-16s | %-16s | %-20s | %-5s | %s\n",
                $t->getId(),
                $t->getNombre(),
                $t->getApellido(),
                $t->getVehiculo(),
                $t->getTurno(),
                $notaColor
            );
        }
    }
    public function displayListViajes(array $viajes): void
{
    if (count($viajes) === 0) {
        echo "\033[1;33mNo hay viajes registrados.\033[0m\n";
        return;
    }

    echo "\n\033[1;36mListado de Viajes:\033[0m\n";
    $this->imprimirEncabezadoViaje();

    foreach ($viajes as $v) {
        $this->imprimirFilaViaje($v);
    }
}
    private function imprimirFilaViaje(Viaje $viaje): void
    {
        printf(
            "%-6s | %-20s | %-20s | %-15.2f | %-10.2f | %-10s | %-10s\n",
            $viaje->getId(),
            $viaje->getTransportista()->getNombre() . ' ' . $viaje->getTransportista()->getApellido(),
            $viaje->getRuta()->getNombre(),
            $viaje->getDistancia(),
            $viaje->getTarifa(),
            $viaje->getEstado(),
            $viaje->getTransportista()->getTurno()
        );
    }
    private function imprimirEncabezadoViaje(): void
    {
        echo str_repeat('-', 100) . "\n";
        printf(
            "%-6s | %-20s | %-20s | %-15s | %-10s | %-10s | %-10s\n",
            "ID",
            "Transportista",
            "Ruta",
            "Distancia (km)",
            "Tarifa",
            "Estado",
            "Turno"
        );
        echo str_repeat('-', 100) . "\n";
    }

    public function mostrarResumenViaje(Viaje $viaje): void
    {
        echo "\n\033[1;32m--- Viaje creado exitosamente ---\033[0m\n";
        printf("Transportista: %s %s\n", $viaje->getTransportista()->getNombre(), $viaje->getTransportista()->getApellido());
        printf("Ruta: %s\n", $viaje->getRuta()->getNombre());
        printf("Distancia: %.2f km\n", $viaje->getDistancia());
        printf("Tarifa: %.2f\n", $viaje->getTarifa());
        echo "-----------------------------------\n";
    }
}