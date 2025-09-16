<?php

class RutaModel
{
    private DB $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    /**
     * Crea una ruta validada y la guarda en la base de datos.
     * Espera un array con claves: nombre, distancia.
     */
    public function crearYGuardar(array $datos): ?Ruta
    {
        $nombre = trim($datos['nombre']);
        $distanciaTexto = trim($datos['distancia']);

        if ($nombre === '' || $distanciaTexto === '') {
            return null;
        }

        $distancia = (float)filter_var($distanciaTexto, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        if ($distancia <= 0) {
            return null;
        }

        $ruta = new Ruta($distancia, $nombre);
        $this->db->agregarRuta($ruta);
        return $ruta;
    }

    /**
     * Devuelve todas las rutas registradas.
     */
    public function listar(): array
    {
        return $this->db->getRutas();
    }
}
