<?php
class DB
{
    private static ?DB $instancia = null;
    private PDO $pdo;

    private function __construct()
    {
        $rutaBD = __DIR__ . '/transporte.sqlite';
        $this->pdo = new PDO('sqlite:' . $rutaBD);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS transportistas (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nombre TEXT NOT NULL,
                apellido TEXT NOT NULL,
                vehiculo TEXT NOT NULL,
                disponible INTEGER NOT NULL DEFAULT 1,
                nota TEXT
            );

            CREATE TABLE IF NOT EXISTS rutas (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nombre TEXT NOT NULL,
                distancia INTEGER NOT NULL,
                nota TEXT
            );

            CREATE TABLE IF NOT EXISTS viajes (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                transportista_id INTEGER NOT NULL,
                ruta_id INTEGER NOT NULL,
                estado TEXT NOT NULL DEFAULT 'pendiente',
                tarifa REAL NOT NULL,
                nota TEXT,
                FOREIGN KEY (transportista_id) REFERENCES transportistas(id),
                FOREIGN KEY (ruta_id) REFERENCES rutas(id)
            );
        ");
    }
}
