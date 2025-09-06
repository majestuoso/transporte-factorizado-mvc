<?php

require_once(__DIR__ . '/../db/DB.php');
require_once(__DIR__ . '/Ruta.php');
require_once(__DIR__ . '/Transportista.php');
class Viaje
{
    private static $ultimoId = 0;

    private $id;
    private $distancia;
    private $tarifa;
    private $transportista;
    private $ruta;
    private $db;

    public function completar(Rutas $ruta, Transportista $transportista)
    {
        Viaje::$ultimoId++;
        $this->id = Viaje::$ultimoId;
        $this->ruta = $ruta;
        $this->transportista = $transportista;
        $this->distancia = $ruta->getDistancia(); // Asigna la distancia de la ruta
        $this->tarifa = null; // Se establecerá más tarde
    }
    function _construct()
    {
        $this->db = DB::getInstance();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDistancia()
    {
        return $this->distancia;
    }

    public function setDistancia($distancia)
    {
        $this->distancia = $distancia;
    }

    public function getTarifa()
    {
        return $this->tarifa;
    }

    public function setTarifa($tarifa)
    {
        $this->tarifa = $tarifa;
    }

    public function getTransportista()
    {
        return $this->transportista;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    public function __toString()
    {
        return 
        "ID Viaje: " . $this->getId() . " 
        | Ruta: " . $this->getRuta()->getNombre() . " 
        | Transportista: " . $this->getTransportista()->getNombre() . " 
        | Distancia: " . $this->getDistancia() . " 
        | Tarifa: " . $this->getTarifa() . "\n";
    }
}