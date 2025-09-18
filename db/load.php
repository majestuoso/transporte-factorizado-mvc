<?php

function load()
{
    $db = DB::getInstance();
    $transportistaController = new TransportistaModel();
    $rutaController = new RutaController();
    $viajeController = new ViajeController();

    // Transportistas
    $transportistaController->crearYGuardar([
        'nombre' => 'Juan',
        'apellido' => 'Perez',
        'disponible' => true,
        'vehiculo' => 'mercedez 1114',
        'nota' => 'Entrega de materiales peligrosos'
    ]);

    $transportistaController->crearYGuardar([
        'nombre' => 'Pablo',
        'apellido' => 'Gomez',
        'disponible' => true,
        'vehiculo' => 'scania 113',
        'nota' => 'Entrega urgente'
    ]);

    $transportistaController->crearYGuardar([
        'nombre' => 'Pedro',
        'apellido' => 'Alvarez',
        'disponible' => true,
        'vehiculo' => 'fiat tector 1123',
        'nota' => 'Cuidado con las curvas, chofer novato'
    ]);

    // Rutas
    $rutaController->agregarDesdeDatos([
        'nombre' => 'la numancia',
        'distancia' => '130'
    ]);

    $rutaController->agregarDesdeDatos([
        'nombre' => 'los teros',
        'distancia' => '30'
    ]);

    $rutaController->agregarDesdeDatos([
        'nombre' => 'el bonete',
        'distancia' => '120'
    ]);

    // Viaje
    $transportista = $db->getTransportistaPorNombre('Juan');
    $ruta = $db->getRutaPorId(1);

    if ($transportista && $ruta) {
        $viajeController->agregarDesdeDatos([
            'transportistaId' => $transportista->getId(),
            'rutaId' => $ruta->getId(),
            'estado' => 'pendiente'
        ]);
    }
}
