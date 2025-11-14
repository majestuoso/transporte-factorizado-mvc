<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once(__DIR__ . '/db/DB.php');

$pdo = DB::getInstance()->getPDO();

// ---------------- Insertar en tabla personal ----------------
// Cliente por defecto
$claveCliente = password_hash('cliente123', PASSWORD_DEFAULT);
$pdo->prepare("INSERT INTO personal (usuario, clave, nombre, estado_id) VALUES (?, ?, ?, ?)")
    ->execute(['cliente1', $claveCliente, 'Cliente por defecto', 1]);

// Personal David
$claveDavid = password_hash('2323', PASSWORD_DEFAULT);
$pdo->prepare("INSERT INTO personal (usuario, clave, nombre, estado_id) VALUES (?, ?, ?, ?)")
    ->execute(['david', $claveDavid, 'David', 1]);

// ---------------- Insertar en tabla transportistas ----------------
// Transportista José
// Transportista José
$claveJose = password_hash('1234', PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO transportistas (usuario, clave, nombre, apellido, vehiculo, disponible, nota, estado_id) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->execute(['jose', $claveJose, 'José', 'Pérez', 'Camión Volvo', 1, 'Transportista inicial', 1]);

echo "Usuarios creados correctamente en personal y transportistas.";
