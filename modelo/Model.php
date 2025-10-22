<?php

require_once(__DIR__ . '/../db/DB.php');

/**
 * Clase base para todos los modelos del sistema.
 * Proporciona acceso a la conexión PDO de forma centralizada.
 */
abstract class Model
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = DB::getInstance()->getPDO();
    }
}
