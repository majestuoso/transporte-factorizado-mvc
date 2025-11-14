<?php
declare(strict_types=1);

class DB
{
    private static ?DB $instancia = null;
    private PDO $pdo;

    private function __construct()
    {
        // Ruta relativa: el archivo transporte.sqlite estará en la misma carpeta que DB.php
        $rutaBD = __DIR__ . '/transporte.sqlite';

        // Conexión PDO
        $this->pdo = new PDO('sqlite:' . $rutaBD);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Crear tablas si no existen
        $this->crearTablas();
    }

    public static function getInstance(): DB
    {
        if (self::$instancia === null) {
            self::$instancia = new DB();
        }
        return self::$instancia;
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }

    private function crearTablas(): void
    {
        // ---------------- Tabla de personal ----------------
        $this->pdo->exec(
            "CREATE TABLE IF NOT EXISTS personal (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                usuario TEXT NOT NULL UNIQUE,
                clave TEXT NOT NULL,
                nombre TEXT NOT NULL,
                estado_id INTEGER DEFAULT 1
            )"
        );

        // ---------------- Tabla de transportistas ----------------
        $this->pdo->exec(
            "CREATE TABLE IF NOT EXISTS transportistas (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                usuario TEXT NOT NULL UNIQUE,
                clave TEXT NOT NULL,
                nombre TEXT NOT NULL,
                apellido TEXT,
                vehiculo TEXT,
                disponible INTEGER NOT NULL DEFAULT 1,
                nota TEXT,
                estado_id INTEGER DEFAULT 1
            )"
        );

        // ---------------- Tabla de rutas ----------------
        $this->pdo->exec(
            "CREATE TABLE IF NOT EXISTS rutas (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nombre TEXT NOT NULL,
                distancia INTEGER NOT NULL,
                nota TEXT
            )"
        );

        // ---------------- Tabla de viajes ----------------
        $this->pdo->exec(
            "CREATE TABLE IF NOT EXISTS viajes (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                transportista_id INTEGER NOT NULL,
                ruta_id INTEGER NOT NULL,
                estado TEXT NOT NULL DEFAULT 'pendiente',
                tarifa REAL NOT NULL,
                nota TEXT,
                FOREIGN KEY (transportista_id) REFERENCES transportistas(id),
                FOREIGN KEY (ruta_id) REFERENCES rutas(id)
            )"
        );
    }
}
