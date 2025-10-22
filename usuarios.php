<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);


require_once(__DIR__ . '/db/DB.php');

$pdo = DB::getInstance()->getPDO();


$claveCliente = password_hash('cliente123', PASSWORD_DEFAULT);
$pdo->prepare("INSERT INTO usuarios (usuario, clave, rol) VALUES (?, ?, ?)")
    ->execute(['cliente1', $claveCliente, 'cliente']);


$clavePersonal = password_hash('2323', PASSWORD_DEFAULT);
$pdo->prepare("INSERT INTO usuarios (usuario, clave, rol) VALUES (?, ?, ?)")
    ->execute(['david', $clavePersonal, 'personal']);

echo "Usuarios creados correctamente.";
