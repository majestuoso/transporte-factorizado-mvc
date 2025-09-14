<?php

require_once(__DIR__ . '/../db/DB.php');

class Rutas
{
    private static $ultimoId = 0;
    private $id;
    private $distancia;
    private $nombre;
    private $tarifa;

    function __construct($distancia, $nombre)
    {
        rutas::$ultimoId++;
        $this->id = rutas::$ultimoId;
        $this->nombre = $nombre;
        $this->distancia = $distancia;
        $this->tarifa = null;
    }

    function getDistancia()
    {
        return $this->distancia;
    }
    function setTarifa($tarifa)
    {
        $this->tarifa = $tarifa;
    }
    function getId()
    {
        return $this->id;
    }
    function getNombre()
    {
        return $this->nombre;
    

        $this->distancia = $distancia;
    }
    public function setDistancia(float $distancia): void {
        $this->distancia = $distancia;
    }
    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    function __toString()
    {
        return 
        "ID: " . $this->getId() . " 
        | Nombre: " . $this->getNombre() . " 
        | Distancia: " . $this->getDistancia() . " \n";
    }
}