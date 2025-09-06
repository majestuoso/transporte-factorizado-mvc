<?php




require_once('./librerias/Menu.php');
require_once('./librerias/Util.php');
require_once('./db/DB.php');
require_once('./db/load.php');
require_once('./controlador/TransportistaController.php');
require_once('./controlador/RutaController.php');
require_once('./controlador/ViajeController.php');

load();

// Muestra el encabezado del sistema.
mostrar("\n");
mostrar("\033[1;34m====================================\n");
mostrar("\033[1;31mSistema de Gestión de Transportistas\n");
mostrar("\033[1;34m====================================\n");
mostrar("\033[1;31m(C) 2025\n");
mostrar("\033[1;34m====================================\n");
mostrar("\n");

// 3. Instancia los controladores. Esto es fundamental.
$transportistaController = new TransportistaController();
$rutaController = new RutaController();
$viajeController = new ViajeController();


$opciones_transportistas = [
    new Opcion('Listar Transportistas', [$transportistaController, 'listar']),
    new Opcion('Agregar Transportista', [$transportistaController, 'agregar']),
    new Opcion('Modificar Transportista', [$transportistaController, 'modificar']),
    new Opcion('Eliminar Transportista', [$transportistaController, 'eliminar']),
    new Opcion('Volver', function() { /* No hace nada, solo regresa al menú superior */ }),
];

$opciones_rutas = [
    new Opcion('Listar Rutas', [$rutaController, 'listar']),
    new Opcion('Agregar Ruta', [$rutaController, 'agregar']),
    new Opcion('Modificar Ruta', [$rutaController, 'modificar']),
    new Opcion('Eliminar Ruta', [$rutaController, 'eliminar']),
    new Opcion('Volver', function() { /* No hace nada, solo regresa al menú superior */ }),
];

$opciones_viajes = [
    new Opcion('Listar Viajes', [$viajeController, 'listar']),
    new Opcion('Agregar Viaje', [$viajeController, 'agregar']),
    new Opcion('Eliminar Viaje', [$viajeController, 'eliminar']),
    new Opcion('Volver', function() { /* No hace nada, solo regresa al menú superior */ }),
];


$menu = new Menu([
    new Opcion('Gestión de Transportistas', Menu::getMenu($opciones_transportistas)),
    new Opcion('Gestión de Rutas', Menu::getMenu($opciones_rutas)),
    new Opcion('Gestión de Viajes', Menu::getMenu($opciones_viajes)),
    new Opcion('Salir', function () {
        mostrar("Saliendo del sistema.\n");
    }),
]);


$opcion = $menu->elegir();
while ($opcion !== null && $opcion->getNombre() != 'Salir') {
    $funcion = $opcion->getFuncion();
    
    if (is_callable($funcion)) {
        call_user_func($funcion);
    }
    
    $opcion = $menu->elegir();
}

if ($opcion === null) {
    echo "Opción no válida. Por favor, elige una opción correcta.\n";
}