<?php
require_once(__DIR__ . '/../librerias/Util.php');

class RutaView
{
    public function displayList($rutas)
    {
        if (count($rutas) == 0) {
            mostrar("No hay rutas registradas.\n");
        } else {
            foreach ($rutas as $ruta) {
                mostrar($ruta);
            }
        }
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