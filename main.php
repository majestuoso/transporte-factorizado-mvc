<?php
declare(strict_types=1);

require_once(__DIR__ . '/librerias/Menu.php');
require_once(__DIR__ . '/librerias/Opcion.php');
require_once(__DIR__ . '/db/DB.php');
require_once(__DIR__ . '/db/load.php');
require_once(__DIR__ . '/controlador/TransportistaController.php');
require_once(__DIR__ . '/controlador/RutaController.php');
require_once(__DIR__ . '/controlador/ViajeController.php');

// 🔹 Carga inicial
load();

// 🔹 Encabezado visual
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

// 🔹 Instancia de controladores
$transportistaController = new TransportistaController();
$rutaController = new RutaController();
$viajeController = new ViajeController();

// 🔹 Submenú genérico
function ejecutarSubmenu(string $titulo, array $opciones): void
{
    $submenu = new Menu($opciones);
    do {
        mostrar("\n\033[1;36m--- $titulo ---\033[0m\n");
        $opcion = $submenu->elegir();

        if ($opcion !== null && $opcion->getNombre() !== 'Volver') {
            $funcion = $opcion->getFuncion();
            if (is_callable($funcion)) {
                call_user_func($funcion);
            }
        }
    } while ($opcion !== null && $opcion->getNombre() !== 'Volver');
}

// 🔹 Opciones de cada módulo
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
    new Opcion('Modificar Transportista en Viaje', [$viajeController, 'modificarTransportistaEnViaje']),
    new Opcion('Modificar Ruta en Viaje', [$viajeController, 'modificarRutaEnViaje']),
    new Opcion('Modificar Estado de Viaje', [$viajeController, 'modificarEstado']),
    new Opcion('Eliminar Viaje', [$viajeController, 'eliminar']),
    new Opcion('Volver', fn() => null),
];

// 🔹 Menú principal
$menuPrincipal = new Menu([
    new Opcion('🧍 Gestión de Transportistas', fn() => ejecutarSubmenu('Gestión de Transportistas', $opciones_transportistas)),
    new Opcion('🛣️ Gestión de Rutas', fn() => ejecutarSubmenu('Gestión de Rutas', $opciones_rutas)),
    new Opcion('🚚 Gestión de Viajes', fn() => ejecutarSubmenu('Gestión de Viajes', $opciones_viajes)),
    new Opcion('❌ Salir', fn() => mostrar("\033[1;33mSaliendo del sistema.\033[0m\n")),
]);

// 🔹 Ejecución principal
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

function mostrar($string)
{
    echo $string;
}
