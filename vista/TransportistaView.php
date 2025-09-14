<?php

class TransportistaView
{
    public function displayList(array $transportistas): void
    {
        if (count($transportistas) === 0) {
            echo "\033[1;33mNo hay transportistas registrados.\033[0m\n";
            return;
        }

        echo "\n\033[1;36mListado de Transportistas:\033[0m\n";
        $this->imprimirEncabezado();
        foreach ($transportistas as $t) {
            $this->imprimirFilaTransportista($t);
        }
    }

    public function mostrarTransportistas(array $transportistas): void
    {
        if (count($transportistas) === 0) {
            echo "\033[1;33mNo hay transportistas disponibles.\033[0m\n";
            return;
        }

        echo "\n\033[1;36mTransportistas disponibles:\033[0m\n";
        $this->imprimirEncabezado();
        foreach ($transportistas as $t) {
            $this->imprimirFilaTransportista($t);
        }
    }

    public function showAddForm(): array
    {
        echo "\n\033[1;34m--- Agregar nuevo transportista ---\033[0m\n";

        $nombre     = $this->getInput(str_pad("Nombre:", 25));
        $apellido   = $this->getInput(str_pad("Apellido:", 25));
        $vehiculo   = $this->getInput(str_pad("Vehículo:", 25));
        $disponible = strtolower($this->getInput(str_pad("¿Disponible? (sí/no):", 25))) === 'sí';
        $nota       = $this->getInput(str_pad("Nota (opcional):", 25));

        return [
            'nombre'     => $nombre,
            'apellido'   => $apellido,
            'vehiculo'   => $vehiculo,
            'disponible' => $disponible,
            'nota'       => $nota
        ];
    }

    public function showMessage(string $mensaje): void
    {
        echo "\n$mensaje\n";
    }

    public function getInput(string $mensaje): string
    {
        echo "$mensaje ";
        return trim(fgets(STDIN));
    }

    public function getIdPrompt(): int
    {
        $id = $this->getInput("Ingrese el ID:");
        return (int)$id;
    }

    public function imprimirEncabezado(): void
    {
        echo "ID  | Nombre           | Apellido         | Disp. | Vehículo            | Turno | Nota\n";
        echo str_repeat('-', 100) . "\n";
    }

    public function imprimirFilaTransportista(Transportista $t): void
{
    $nota = $t->getNota() ?? '';
    $notaColor = "\033[1;31m$nota\033[0m"; // rojo fijo

    printf(
        "%-4s| %-16s | %-16s | %-6s | %-20s | %-5s | %s\n",
        $t->getId(),
        $t->getNombre(),
        $t->getApellido(),
        $t->isDisponible() ? 'Sí' : 'No',
        $t->getVehiculo(),
        $t->getTurno(),
        $notaColor
    );
}
}
