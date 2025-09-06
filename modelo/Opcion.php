<?php

require_once(__DIR__ . '/../db/DB.php');

class Opcion
{
    private $nombre;
    private $funcion;

    function __construct($nombre, $funcion)
    {
        $this->nombre = $nombre;
        $this->funcion = $funcion;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getFuncion()
    {
        return $this->funcion;
    }
}