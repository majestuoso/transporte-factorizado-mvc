<?php
declare(strict_types=1);

require_once(__DIR__ . '/librerias/Menu.php');
require_once(__DIR__ . '/librerias/Opcion.php');
require_once(__DIR__ . '/db/DB.php');
require_once(__DIR__ . '/db/load.php');
require_once(__DIR__ . '/controlador/TransportistaController.php');
require_once(__DIR__ . '/controlador/RutaController.php');
require_once(__DIR__ . '/controlador/ViajeController.php');

// Función global simple para imprimir
function mostrar(string $texto): void
{
    echo $texto;
}

function mostrarEncabezado(): void
{
    mostrar("\n");
    mostrar("\033[1;34m====================================\n");
    mostrar("\033[1;31m   Sistema de Gestión de Transporte\n");
    mostrar("\033[1;34m====================================\n");
    mostrar("\033[1;32m        (C) 2025 - Tandil, Argentina\n");
    mostrar("\033[1;34m====================================\n");
    mostrar("\n");
}

mostrarEncabezado();

$loader = new Load();
$loader->load();

$transportistaController = new TransportistaController();
$rutaController = new RutaController();
$viajeController = new ViajeController();

function ejecutarSubmenu(string $titulo, array $opciones): void
{
    mostrar("\n\033[1;36m--- $titulo ---\033[0m\n");
    $submenu = new Menu($opciones);
    do {
        $opcion = $submenu->elegir();

        if ($opcion !== null && $opcion->getNombre() !== 'Volver') {
            $funcion = $opcion->getFuncion();
            if (is_callable($funcion)) {
                call_user_func($funcion);
            }
        }
    } while ($opcion !== null && $opcion->getNombre() !== 'Volver');
}

$opciones_transportistas = [
    new Opcion('Listar Transportistas', [$transportistaController, 'listar']),
    new Opcion('Agregar Transportista', [$transportistaController, 'agregar']),
    new Opcion('Modificar Transportista', [$transportistaController, 'modificar']),
    new Opcion('Eliminar Transportista', [$transportistaController, 'eliminar']),
    new Opcion('Volver', fn() => null),
];

$opciones_rutas = [
    new Opcion('Listar Rutas', [$rutaController, 'listar']),
    new Opcion('Agregar Ruta', [$rutaController, 'agregar']),
    new Opcion('Modificar Ruta', [$rutaController, 'modificar']),
    new Opcion('Eliminar Ruta', [$rutaController, 'eliminar']),
    new Opcion('Volver', fn() => null),
];

$opciones_viajes = [
    new Opcion('Listar Viajes', [$viajeController, 'listar']),
    new Opcion('Agregar Viaje', [$viajeController, 'agregar']),
    new Opcion('Modificar Tarifa de Viaje', [$viajeController, 'modificar']),
    new Opcion('Eliminar Viaje', [$viajeController, 'eliminar']),
    new Opcion('Volver', fn() => null),
];

$menuPrincipal = new Menu([
    new Opcion('🧍 Gestión de Transportistas', fn() => ejecutarSubmenu('Gestión de Transportistas', $opciones_transportistas)),
    new Opcion('🛣️ Gestión de Rutas', fn() => ejecutarSubmenu('Gestión de Rutas', $opciones_rutas)),
    new Opcion('🚚 Gestión de Viajes', fn() => ejecutarSubmenu('Gestión de Viajes', $opciones_viajes)),
    new Opcion('❌ Salir', fn() => salirDelSistema()),
]);

do {
    $opcion = $menuPrincipal->elegir();

    if ($opcion !== null && $opcion->getNombre() !== 'Salir') {
        $funcion = $opcion->getFuncion();
        if (is_callable($funcion)) {
            call_user_func($funcion);
        }
    }
} while ($opcion !== null && $opcion->getNombre() !== 'Salir');

if ($opcion === null) {
    mostrar("\033[1;31mOpción no válida. Por favor, elige una opción correcta.\033[0m\n");
}

function salirDelSistema(): void
{
    mostrar("\n\033[1;31m❌ Cerrando sesión...\033[0m\n");
    mostrar("\033[1;34mGracias por usar el Sistema de Gestión de Transporte.\033[0m\n");
    mostrar("\033[1;32mHasta pronto 👋\033[0m\n");
    exit(0);
}
