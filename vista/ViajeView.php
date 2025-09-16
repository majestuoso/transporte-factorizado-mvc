<?php


class ViajeView
{
    public function solicitarDatos(): array
    {
        echo "Ingrese ID de ruta: ";
        $rutaId = trim(readline());

        echo "Ingrese ID de transportista: ";
        $transportistaId = trim(readline());

        echo "Ingrese estado del viaje (pendiente, en curso, finalizado): ";
        $estado = trim(readline());

        return [
            'rutaId' => $rutaId,
            'transportistaId' => $transportistaId,
            'estado' => $estado
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
