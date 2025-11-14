<?php
require_once __DIR__ . '/db/DB.php';

// Al pedir la instancia, se dispara el constructor y se crean las tablas
DB::getInstance();

echo "Base de datos SQLite creada en /home/david/Escritorio/htdocs_lampp/transporte/db/transporte.sqlite con sus tablas.\n";
