<?php
class DB
{

    static $instance = null;

    private $transportistas = [];
    private $rutas = [];
    private $viajes = [];


    static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    function __construct()
    {
        $this->transportistas = [];
        $this->rutas = [];
        $this->viajes = [];
    }
    function transportistasDisponibles()
    {
        $disponibles = [];
        foreach ($this->transportistas as $transportista) {
            if ($transportista->isDisponible() == true)
                array_push($disponibles, $transportista);
        }
        return $disponibles;
    }
    function TurnoMenor()
    {
        $turnomenor = null;

        foreach ($this->transportistasDisponibles() as $transportista) {
            if ($turnomenor === null || (isset($turnomenor->turno) && $transportista->turno < $turnomenor->turno)) {
                $turnomenor = $transportista;
            }
        }
        return $turnomenor;
    }
    function borrarTransportistaPorIndice($indice)
    {

        unset($this->transportistas[$indice]);
    }
    function getTransportistas()
    {
        return $this->transportistas;
    }
    function getTransportistaPorId($id)
    {
        foreach ($this->transportistas as $transportista) {
            if ($transportista->getId() == $id) {
                return $transportista;
            }
        }
        return null;
    }
    function setTransportistas($transportistas)
    {
        $this->transportistas = $transportistas;
    }
    function agregaTransportista($transportista)
    {
        array_push($this->transportistas, $transportista);
    }
    function agregarTransportista($transportista)
    {
        array_push($this->transportistas, $transportista);
    }

    function agregaRuta($ruta)
    {
        array_push($this->rutas, $ruta);
    }
    function agregarRuta($ruta)
    {
        array_push($this->rutas, $ruta);
    }
    function getTurnotransportista($id)
    {
        foreach ($this->transportistas as $transportista) {
            if ($transportista->getId() == $id) {
                return $transportista->getTurno();
            }
        }
        return null;
    }
    function getRutaporId($id)
    {
        foreach ($this->rutas as $ruta) {
            if ($ruta->getId() == $id) {
                return $ruta;
            }
        }
        return null;
    }
    function setRutas($rutas)
    {
        $this->rutas = $rutas;
    }

    function getRutas()
    {
        return $this->rutas;
    }
    function getRutaporNombre($nombre)
    {
        foreach ($this->rutas as $ruta) {
            if ($ruta->getNombre() == $nombre) {
                return $ruta;
            }
        }
    }
    function eliminarRuta($indice)
    {
        unset($this->rutas[$indice]);
    }
    function eliminarViaje($indice)
    {
        unset($this->viajes[$indice]);
    }
    
    function setViajes($viaje)
    {
        $this->viajes = $viaje;
    }

    function agregarViaje($viaje)
    {
        array_push($this->viajes, $viaje);
    }

    function getViajePorId($id)
    {
        foreach ($this->viajes as $viaje) {
            if ($viaje->getId() == $id) {
                return $viaje;
            }
        }
        return null;
    }
    function getViajes()
    {
        return $this->viajes;
    }
    function getTransportistaPorNombre($nombre)
    {
        foreach ($this->transportistas as $transportista) {
            if ($transportista->getNombre() == $nombre) {
                return $transportista;
            }
        }
    }
    function actualizarTransportista(Transportista $transportista): void
    {
        foreach ($this->transportistas as $index => $t) {
            if ($t->getId() === $transportista->getId()) {
                $this->transportistas[$index] = $transportista;
                return;
            }
        }
    }
}
