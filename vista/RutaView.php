<?php
require_once(__DIR__ . '/../librerias/Util.php');

class RutaView
{
   public function displayList(array $rutas)
{
    if (count($rutas) === 0) {
        $this->showMessage("No hay rutas registradas.");
        return;
    }

    printf("\n\033[1;36m%-4s | %-25s | %-10s\033[0m\n", "ID", "Nombre", "Distancia (km)");
    printf("%'-45s\n", "");

    foreach ($rutas as $ruta) {
        printf(
            "%-4d | %-25s | %-10.2f\n",
            $ruta->getId(),
            $ruta->getNombre(),
            $ruta->getDistancia()
        );
    }
}
public function getInput(string $mensaje): string
    {
        echo "\n\033[1;36m$mensaje\033[0m ";
        return trim(fgets(STDIN));
    }

    public function showAddForm()
    {
        mostrar("Ingrese el nombre de la ruta:");
        $nombre = trim(fgets(STDIN));
        mostrar("Ingrese la distancia de la ruta (en km):");
        $distancia = trim(fgets(STDIN));
        
        return ['nombre' => $nombre, 'distancia' => $distancia];
    }
    public function showModificationForm()
    {
        mostrar("Ingrese el nuevo nombre de la ruta:");
        $nuevoNombre = trim(fgets(STDIN));
        mostrar("Ingrese la nueva distancia de la ruta (en km):");
        $nuevaDistancia = trim(fgets(STDIN));
        return ['nuevoNombre' => $nuevoNombre, 'nuevaDistancia' => $nuevaDistancia];
    }
    public function showMessage($message)
    {
        mostrar($message);
    }
    public function getIdPrompt()
    {
        mostrar("Seleccione el ID de la ruta:");
        return trim(fgets(STDIN));
    }
}