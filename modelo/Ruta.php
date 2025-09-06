<?php
require_once(__DIR__ . '/../db/DB.php');

class Ruta
{
    private static $lastId = 0;
    private $id;
    private $nombre;
    private $distancia;

    public function __construct($distancia, $nombre)
    {
        $this->id = ++self::$lastId;
        $this->nombre = $nombre;
        $this->distancia = $distancia;
    }

   
    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getDistancia() { return $this->distancia; }

    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setDistancia($distancia) { $this->distancia = $distancia; }

    // New method for persistence logic
    public function agregar()
    {
        $db = DB::getInstance();
        $db->agregarRuta($this);
    }

    public function modificar($data)
    {
        if (!empty($data['nuevoNombre'])) {
            $this->setNombre($data['nuevoNombre']);
        }

        if (!empty($data['nuevaDistancia'])) {
            if (!is_numeric($data['nuevaDistancia']) || $data['nuevaDistancia'] <= 0) {
                // Handle validation error, perhaps throw an exception or return false
            } else {
                $this->setDistancia($data['nuevaDistancia']);
            }
        }
    }

    /**
     * Define the string representation of the Ruta object.
     * This will be called when the object is treated as a string.
     * @return string
     */
    public function __toString(): string
    {
        return "Ruta ID: {$this->id}, Nombre: {$this->nombre}, Distancia: {$this->distancia} km";
    }
}
?>