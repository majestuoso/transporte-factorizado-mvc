<?php

require_once(__DIR__ . '/../modelo/Transportista.php');
require_once(__DIR__ . '/../modelo/Ruta.php');
require_once(__DIR__ . '/../modelo/Viaje.php');
require_once(__DIR__ . '/DB.php');


function agregaTransportista($db, $nombre, $apellido, $disponible, $vehiculo)
{
    $t1 = new Transportista($nombre, $apellido);
    $t1->setDisponible($disponible);
    $t1->setVehiculo($vehiculo);
    $db->agregaTransportista($t1);
}

function agregaRuta($db, $nombre, $distancia, $tarifa)
{
    $r1 = new Rutas($distancia,$nombre);
    $r1->setTarifa($tarifa);
    $db->agregaRuta($r1);
}

function agregaViaje($db,$distancia, $tarifa, $transportista, $ruta)
{
    $v1 = new Viaje($ruta,$transportista);
    $v1->setTarifa($tarifa);
    $v1->setDistancia($distancia);
    $db->agregarViaje($v1);
}

function load()
{
    $db = DB::getInstance();

   
    agregaTransportista($db, 'Juan', 'Perez', true, 'mercedez 1114');
    agregaTransportista($db, 'Pablo', 'Gomez', true, 'scania 113');
    agregaTransportista($db, 'Pedro', 'Alvarez', true, 'fiat tector 1123');
    //agregaTransportista($db, 'Luis', 'Zen', true, 'wolskwagen 310');
   
    agregaRuta($db, 'la numancia', '130km', '120$');
    agregaRuta($db, 'los teros', '30km', '134$');
    agregaRuta($db, 'el bonete', '130km', '50$');

    $transportista = $db->getTransportistaPorNombre('Juan');
    $ruta = $db->getRutaporId(1);
    agregaViaje($db, '130km', '120$', $transportista, $ruta);
} 

load();