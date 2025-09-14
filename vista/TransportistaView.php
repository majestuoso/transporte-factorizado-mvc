<?php
require_once(__DIR__ . '/../librerias/Util.php');

class TransportistaView
{
    public function displayList($transportistas)
    {
        if (count($transportistas) == 0) {
            mostrar("No hay transportistas registrados.\n");
        } else {
            foreach ($transportistas as $transportista) {
                mostrar($transportista);
            }
        }
    }

    public function showAddForm()
    {
        mostrar("\033[1;33m Ingrese el nombre del transportista: ");
        $nombre = trim(fgets(STDIN));
        mostrar("\033[1;33m Ingrese el apellido del transportista: ");
        $apellido = trim(fgets(STDIN));
        mostrar("\033[1;33m Ingrese el vehículo: ");
        $vehiculo = trim(fgets(STDIN));
        mostrar("\033[1;33m ¿Está disponible el transportista? (s/n): ");
        $disponibleInput = trim(fgets(STDIN));
        $disponible = strtolower($disponibleInput) === 's' ? true : false;
        return ['nombre' => $nombre, 'apellido' => $apellido, 'vehiculo' => $vehiculo, 'disponible' => $disponible];
    }

    public function showModificationForm($transportista)
    {
        mostrar("Modificando transportista: " . $transportista->getNombre() . " " . $transportista->getApellido());
        mostrar("Ingrese el nuevo nombre del transportista (dejar en blanco para mantener '" . $transportista->getNombre() . "'): ");
        $nuevoNombre = trim(fgets(STDIN));
        mostrar("Ingrese el nuevo apellido del transportista (dejar en blanco para mantener '" . $transportista->getApellido() . "'): ");
        $nuevoApellido = trim(fgets(STDIN));
        mostrar("Desea cambiar la disponibilidad del transportista? (s/n, actual: " . ($transportista->isDisponible() ? 'Sí' : 'No') . "): ");
        $cambiarDisponibilidad = trim(fgets(STDIN));
        mostrar("Desea cambiar el tipo de vehículo? (s/n, actual: '" . $transportista->getVehiculo() . "'): ");
        mostrar("Ingrese el nuevo vehiculo del transportista (dejar en blanco para mantener  ");
        $nuevoVehiculo = trim(fgets(STDIN));
        return ['nombre' => $nuevoNombre, 'apellido' => $nuevoApellido, 'cambiarDisponibilidad' => $cambiarDisponibilidad, 'nuevoVehiculo' => $nuevoVehiculo];
    }
    public function showMessage($message)
    {
        mostrar($message);
    }
    public function getIdPrompt()
    {
        mostrar("Seleccione el ID del transportista:");
        return trim(fgets(STDIN));
    }
}