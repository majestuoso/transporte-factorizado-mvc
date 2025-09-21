<?php

require_once __DIR__ . '/../modelo/Model.php';
require_once __DIR__ . '/../modelo/TransportistaModel.php';
require_once __DIR__ . '/../modelo/RutaModel.php';
require_once __DIR__ . '/../modelo/ViajeModel.php';

class Load extends Model
{
    public function load()
    {
        $transportistaController = new TransportistaModel();
        $rutaController = new RutaModel();
        $viajeController = new ViajeModel();

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
            'disponible' => false,
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


        $rutaController->crearYGuardar([
            'nombre' => 'la numancia',
            'distancia' => '130',
            'nota' => 'Ruta con muchas curvas',
        ]);

        $rutaController->crearYGuardar([
            'nombre' => 'los teros',
            'distancia' => '30',
            'nota' => 'Ruta corta y directa',
        ]);

        $rutaController->crearYGuardar([
            'nombre' => 'el bonete',
            'distancia' => '120',
            'nota' => 'Ruta con pendientes elevadas',
        ]);


        $viajeModel = new ViajeModel();

        $transportistaPablo = $this->db->getTransportistaPorNombre('Pablo');
        $rutaBonete = $this->db->getRutaPorNombre('el bonete');

        if ($transportistaPablo && $rutaBonete) {
            $viajeModel->crearYGuardar([
                'transportistaId' => $transportistaPablo->getId(),
                'rutaId' => $rutaBonete->getId(),
                'estado' => 'pendiente',
                'tarifa' => 1500,
                'nota' => 'Entrega de materiales peligrosos'
            ]);
        }
    }
}
