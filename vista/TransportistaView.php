<?php

require_once(__DIR__ . '/View.php');

class TransportistaView extends View

{ 

public function solicitarDatos(): array
{
    $nombre = $this->getInput("Nombre:");
    $apellido = $this->getInput("Apellido:");
    $vehiculo = $this->getInput("Vehículo:");
    $nota = $this->getInput("Nota (opcional):");
    return compact('nombre', 'apellido', 'vehiculo', 'nota');
}


public function mostrarResumen(Transportista $t): void
{
    echo "\n\033[1;32mTransportista registrado exitosamente:\033[0m\n";
    echo $t;    
}   


public function mostrarTransportistas(array $transportistas): void
{
    echo "\n\033[1;36m📋 Listado de Transportistas:\033[0m\n";

    foreach ($transportistas as $t) {
        echo "🧍 ID: {$t->getId()} | Nombre: {$t->getNombre()} {$t->getApellido()} | Vehículo: {$t->getVehiculo()} | Disponible: " . ($t->isDisponible() ? "Sí" : "No") . "\n";

        // Mostrar nota en color amarillo si existe
        $nota = $t->getNota();
        if ($nota) {
            echo "🗒️ \033[1;33mNota:\033[0m {$nota}\n";
        } else {
            echo "🗒️ \033[1;30mSin nota registrada\033[0m\n";
        }

        echo str_repeat("-", 60) . "\n";
    }
}

}
