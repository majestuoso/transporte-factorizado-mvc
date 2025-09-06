<?php
require_once(__DIR__ . '/../librerias/Util.php');

class ViajeView
{
    public function showAddForm($rutas, $transportistas)
    {
        mostrar("Seleccione una ruta de la lista:\n");
        foreach ($rutas as $ruta) {
            mostrar("ID: " . $ruta->getId() . " | " . $ruta->getNombre() . " | " . $ruta->getDistancia() . "\n");
        }
        mostrar("Ingrese el ID de la ruta:");
        $ruta_id = trim(fgets(STDIN));

        mostrar("Seleccione un transportista de la lista:\n");
        foreach ($transportistas as $transportista) {
            mostrar("ID: " . $transportista->getId() . " | " . $transportista->getNombre() . " " . $transportista->getApellido() . "\n");
        }
        mostrar("Ingrese el ID del transportista:");
        $transportista_id = trim(fgets(STDIN));

        mostrar("Ingrese la tarifa del viaje:");
        $tarifa = trim(fgets(STDIN));

        return [
            'ruta_id' => $ruta_id,
            'transportista_id' => $transportista_id,
            'tarifa' => $tarifa
        ];
    }

    public function MostrarViajes($viajes)
    {
        if (count($viajes) == 0) {
            mostrar("No hay viajes registrados.\n");
        } else {
            foreach ($viajes as $viaje) {
                mostrar($viaje);
            }
        }
    }

    public function showMessage($message)
    {
        mostrar($message);
    }
    public function promptForId()
    {
        mostrar("Seleccione el ID del viaje:");
        return trim(fgets(STDIN));
    }
}