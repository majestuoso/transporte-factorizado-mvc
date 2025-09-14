<?php


require_once(__DIR__ . '/../db/DB.php');

class Transportista
{
    static $ultimoId = 0;
    static $ultimoTurno = 0;
    private $id;
    private $nombre;
    private $apellido;
    private $turno = 0;
    private $disponible;
    private $vehiculo;

    function __construct($nombre, $apellido)
    {
        Transportista::$ultimoId++;
        Transportista::$ultimoTurno++;
        $this->turno = Transportista::$ultimoTurno;
        $this->id = Transportista::$ultimoId;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->disponible = false;
        $this->vehiculo = '';
    }

    public function getTurno()
    {
        return $this->turno;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getApellido()
    {
        return $this->apellido;
    }
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }
    public function isDisponible()
    {
        return $this->disponible;
    }
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;
    }
    public function getVehiculo()
    {
        return $this->vehiculo;
    }
    private ?string $nota = null; 

public function setNota(?string $nota): void
{
    $this->nota = $nota;
}

public function getNota(): ?string
{
    return $this->nota;
}

    public function setVehiculo($vehiculo)
    {
        $this->vehiculo = $vehiculo;
        return $this;
    }
    public function __toString()
    {
        return
        "ID: " . $this->getId() . "
        | Nombre: " . $this->getNombre() . "  |  Apellido: " . $this->getApellido() ."
        | Disponible: " . ($this->isDisponible() ? "Sí" : "No") . "  | Turno: " . $this->turno ."
        | Vehiculo: " . $this->getVehiculo() ."\n";
    }
}