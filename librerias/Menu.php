<?php

require_once(__DIR__ . '/Opcion.php');

class Menu
{
    private array $opciones;

    public function __construct(array $opciones)
    {
        $this->opciones = $opciones;
    }

    public static function getMenu(array $opciones): Menu
    {
        return new Menu($opciones);
    }

    public function elegir()
    {
        $this->mostrarTexto("\n");
        $opcion = null;
        $valida = false;
        while (!$valida) {
            $this->mostrar();
            $this->mostrarTexto("Ingrese la opción deseada (1-" . count($this->opciones) . "): ");
            $entrada = trim(fgets(STDIN));
            if (is_numeric($entrada) && $entrada > 0 && $entrada <= count($this->opciones)) {
                $opcion = $this->opciones[$entrada - 1];
                if ($opcion->getFuncion() instanceof Menu) {
                    $opcion = $opcion->getFuncion()->elegir();
                }
                $valida = true;
            } else {
                $this->mostrarTexto("Opción no válida. Por favor, intente de nuevo.\n");
            }
        }
        return $opcion;
    }

    public function mostrar()
    {
        foreach ($this->opciones as $i => $opcion) {
            $this->mostrarTexto(($i + 1) . ") " . $opcion->getNombre() . "\n");
        }
    }

    private function mostrarTexto(string $texto): void
    {
        echo $texto;
    }
}
