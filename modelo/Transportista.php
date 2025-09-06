<?php
require_once(__DIR__ . '/../db/DB.php');

class Transportista
{
    private static $lastId = 0;
    private $id;
    private $nombre;
    private $vehiculo;

    public function __construct($nombre, $vehiculo)
    {
        $this->id = ++self::$lastId;
        $this->nombre = $nombre;
        $this->vehiculo = $vehiculo;
    }

    // Getters and Setters
    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getVehiculo() { return $this->vehiculo; }

    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setVehiculo($vehiculo) { $this->vehiculo = $vehiculo; }

    // New methods for persistence logic
    public function agregar()
    {
        $db = DB::getInstance();
        $db->agregarTransportista($this);
    }

    public function modificar($data)
    {
        if (!empty($data['nuevoNombre'])) {
            $this->setNombre($data['nuevoNombre']);
        }
        if (!empty($data['nuevoVehiculo'])) {
            $this->setVehiculo($data['nuevoVehiculo']);
        }
    }
    public function eliminar()
    {
        $db = DB::getInstance();
        $db->eliminarTransportista($this->id);
    }
    public function __toString()
    {
        return "ID: " . $this->id . ", Nombre: " . $this->nombre . ", Vehículo: " . $this->vehiculo;
    }   
}
?>