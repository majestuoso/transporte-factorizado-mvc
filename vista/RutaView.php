<?php



class RutaView extends View

{ 

public function solicitarDatos(): array
{
    $nombre = $this->getInput("Nombre:");
    $apellido = $this->getInput("distancia:");
    $vehiculo = $this->getInput("Vehículo:");
    $nota = $this->getInput("Nota (opcional):");
    return compact('nombre', 'distancia', 'vehiculo', 'nota');
}


public function mostrarResumen(Ruta $t): void
{
    echo "\n\033[1;32mRuta registrada exitosamente:\033[0m\n";
    echo $t;    
}   


public function mostrarRutas(array $rutas): void
{
    echo "\n\033[1;33m--- Lista de Transportistas ---\033[0m\n";
    foreach ($rutas as $t) {
        echo $t;
    }
    echo "\n";          
}   
}
