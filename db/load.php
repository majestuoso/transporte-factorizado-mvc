<?php
declare(strict_types=1);

require_once __DIR__ . '/../db/DB.php';
require_once __DIR__ . '/../modelo/TransportistaModel.php';
require_once __DIR__ . '/../modelo/RutaModel.php';
require_once __DIR__ . '/../modelo/ViajeModel.php';

class Load
{
    public function load(): void
    {
        $pdo = DB::getInstance()->getPDO();

        // Verificar si ya hay datos en las tablas
        $hayDatos = $pdo->query("SELECT COUNT(*) FROM transportistas")->fetchColumn() > 0
                 || $pdo->query("SELECT COUNT(*) FROM rutas")->fetchColumn() > 0
                 || $pdo->query("SELECT COUNT(*) FROM viajes")->fetchColumn() > 0;

        if ($hayDatos) {
            echo "<p><strong>Ya hay datos cargados. No se ejecuta Load.</strong></p>";
            return;
        }

        echo "<h2>Cargando datos iniciales...</h2>";

        $transportistaModel = new TransportistaModel();
        $rutaModel = new RutaModel();
        $viajeModel = new ViajeModel();

        // === Transportistas con usuarios asociados ===
        // Juan
        $pdo->prepare("INSERT INTO usuarios (usuario, clave, rol) VALUES (?, ?, ?)")
            ->execute(['juan', '1234', 'transportista']);
        $usuarioJuanId = (int)$pdo->lastInsertId();

        $juan = $transportistaModel->crearYGuardar([
            'usuario_id' => $usuarioJuanId,
            'nombre'     => 'Juan',
            'apellido'   => 'Perez',
            'disponible' => true,
            'vehiculo'   => 'Mercedes 1114',
            'nota'       => 'Entrega de materiales peligrosos'
        ]);

        // Pablo
        $pdo->prepare("INSERT INTO usuarios (usuario, clave, rol) VALUES (?, ?, ?)")
            ->execute(['pablo', '1234', 'transportista']);
        $usuarioPabloId = (int)$pdo->lastInsertId();

        $pablo = $transportistaModel->crearYGuardar([
            'usuario_id' => $usuarioPabloId,
            'nombre'     => 'Pablo',
            'apellido'   => 'Gomez',
            'disponible' => false,
            'vehiculo'   => 'Scania 113',
            'nota'       => 'Entrega urgente'
        ]);

        // Pedro
        $pdo->prepare("INSERT INTO usuarios (usuario, clave, rol) VALUES (?, ?, ?)")
            ->execute(['pedro', '1234', 'transportista']);
        $usuarioPedroId = (int)$pdo->lastInsertId();

        $pedro = $transportistaModel->crearYGuardar([
            'usuario_id' => $usuarioPedroId,
            'nombre'     => 'Pedro',
            'apellido'   => 'Alvarez',
            'disponible' => true,
            'vehiculo'   => 'Fiat Tector 1123',
            'nota'       => 'Cuidado con las curvas, chofer novato'
        ]);

        echo "<h3>Transportistas creados:</h3><ul>";
        foreach ([$juan, $pablo, $pedro] as $t) {
            if ($t) {
                echo "<li>{$t->getId()}: {$t->getNombre()} - {$t()}</li>";
            } else {
                echo "<li>Error al crear transportista</li>";
            }
        }
        echo "</ul>";

        // === Rutas ===
        $numancia = $rutaModel->crearYGuardar([
            'nombre'    => 'La Numancia',
            'distancia' => 130,
            'nota'      => 'Ruta con muchas curvas'
        ]);

        $teros = $rutaModel->crearYGuardar([
            'nombre'    => 'Los Teros',
            'distancia' => 30,
            'nota'      => 'Ruta corta y directa'
        ]);

        $bonete = $rutaModel->crearYGuardar([
            'nombre'    => 'El Bonete',
            'distancia' => 120,
            'nota'      => 'Ruta con pendientes elevadas'
        ]);

        echo "<h3>Rutas creadas:</h3><ul>";
        foreach ([$numancia, $teros, $bonete] as $r) {
            if ($r) {
                echo "<li>{$r->getId()}: {$r->getNombre()} - {$r->getDistancia()} km</li>";
            } else {
                echo "<li>Error al crear ruta</li>";
            }
        }
        echo "</ul>";

        // === Viaje ===
        $viaje = $viajeModel->crearYGuardar([
            'transportistaId' => $pablo ? $pablo->getId() : null,
            'rutaId'          => $bonete ? $bonete->getId() : null,
            'estado'          => 'pendiente',
            'tarifa'          => 1500,
            'nota'            => 'Entrega de materiales peligrosos'
        ]);

        echo "<h3>Viaje creado:</h3>";
        if ($viaje) {
            echo "<p>ID: {$viaje->getId()} | Transportista: {$pablo->getNombre()} | Ruta: {$bonete->getNombre()} | Tarifa: {$viaje->getTarifa()} | Estado: {$viaje->getEstado()}</p>";
        } else {
            echo "<p>Error al crear el viaje.</p>";
        }

        echo "<p><strong>Carga inicial completada.</strong></p>";
    }
}
