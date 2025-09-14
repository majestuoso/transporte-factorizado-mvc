<?php

require_once(__DIR__ . '/librerias/Menu.php');
require_once(__DIR__ . '/librerias/Util.php');
require_once(__DIR__ . '/db/DB.php');
require_once(__DIR__ . '/db/load.php'); 
require_once(__DIR__ . '/controlador/TransportistaController.php');
require_once(__DIR__ . '/controlador/ViajeController.php');
require_once(__DIR__ . '/controlador/RutaController.php');
require_once(__DIR__ . '/librerias/Opcion.php');


load();

// Encabezado con colores
mostrar("\n");
mostrar("\033[1;34m====================================\n");
mostrar("\033[1;31mSistema de Gestión de Transportistas\n");
mostrar("\033[1;34m====================================\n");
mostrar("\033[1;31m(C) 2025\n");
mostrar("\033[1;34m====================================\n");
mostrar("\n");

// Instancia de controladores
$transportistaController = new TransportistaController();
$rutaController = new RutaController();
$viajeController = new ViajeController();

// Función para ejecutar submenús
function ejecutarSubmenu($titulo, $opciones) {
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

// Opciones de submenús
$opciones_transportistas = [
    new Opcion('Listar Transportistas', [$transportistaController, 'listar']),
    new Opcion('Agregar Transportista', [$transportistaController, 'agregar']),
    new Opcion('Modificar Transportista', [$transportistaController, 'modificar']),
    new Opcion('Eliminar Transportista', [$transportistaController, 'eliminar']),
    new Opcion('Volver', function () {}),
];

$opciones_rutas = [
    new Opcion('Listar Rutas', [$rutaController, 'listar']),
    new Opcion('Agregar Ruta', [$rutaController, 'agregar']),
    new Opcion('Modificar Ruta', [$rutaController, 'modificar']),
    new Opcion('Eliminar Ruta', [$rutaController, 'eliminar']),
    new Opcion('Volver', function () {}),
];

$opciones_viajes = [
    new Opcion('Listar Viajes', [$viajeController, 'listar']),
    new Opcion('Agregar Viaje', [$viajeController, 'agregar']),
    new Opcion('Modificar Tarifa de Viaje', [$viajeController, 'modificar']),
    new Opcion('Modificar Transportista en Viaje', [$viajeController, 'modificarTransportistaEnViaje']),
    new Opcion('Modificar Ruta en Viaje', [$viajeController, 'modificarRutaEnViaje']),
    new Opcion('Modificar Estado de Viaje', [$viajeController, 'modificarEstado']), // ✅ NUEVA OPCIÓN
    new Opcion('Eliminar Viaje', [$viajeController, 'eliminar']),
    new Opcion('Volver', function () {})
];


// Menú principal
$menu = new Menu([
    new Opcion('Gestión de Transportistas', function () use ($opciones_transportistas) {
        ejecutarSubmenu('Gestión de Transportistas', $opciones_transportistas);
    }),
    new Opcion('Gestión de Rutas', function () use ($opciones_rutas) {
        ejecutarSubmenu('Gestión de Rutas', $opciones_rutas);
    }),
    new Opcion('Gestión de Viajes', function () use ($opciones_viajes) {
        ejecutarSubmenu('Gestión de Viajes', $opciones_viajes);
    }),
    new Opcion('Salir', function () {
        mostrar("\033[1;33mSaliendo del sistema.\033[0m\n");
    }),
]);

// Ejecución del menú principal
do {
    $opcion = $menu->elegir();

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
