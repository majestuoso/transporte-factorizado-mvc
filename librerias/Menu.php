<?php

require_once(__DIR__ . '/Opcion.php');
require_once(__DIR__ . '/Util.php');

class Menu
{
    private $opciones;

    function __construct(array $opciones)
    {
        $this->opciones = $opciones;
    }

    public static function getMenu(array $opciones)
    {
        return new Menu($opciones);
    }
    
    function elegir()
    {
        mostrar("\n");
        $opcion = null;
        $valida = false;
        while (!$valida) {
            $this->mostrar();
            mostrar("Ingrese la opción deseada (1-" . count($this->opciones) . "): ");
            $entrada = trim(fgets(STDIN));
            if (is_numeric($entrada) && $entrada > 0 && $entrada <= count($this->opciones)) {
                $opcion = $this->opciones[$entrada - 1];
                if ($opcion->getFuncion() instanceof Menu) {
                    $opcion = $opcion->getFuncion()->elegir();
                }
                $valida = true;
            } else {
                mostrar("Opción no válida. Por favor, intente de nuevo.\n");
            }
        }
        return $opcion;
    }

    function mostrar()
    {
        $i = 1;
        foreach ($this->opciones as $opcion) {
            mostrar("$i) " . $opcion->getNombre() . "\n");
            $i++;
        }
    }
}